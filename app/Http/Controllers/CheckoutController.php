<?php

namespace App\Http\Controllers;

use App\Store;
use App\UserOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;

class CheckoutController extends Controller
{
    public function index()
    {

        try {

            if (!Auth::check()) return redirect()->route('login');

            if (!session()->has('cart')) return redirect()->route('home');

            $this->makePagSeguroSession();
            $total = 0;

            $cartItems = array_map(function ($line) {
                return $line['amount'] * priceToDatabase($line['price']);
            }, session()->get('cart'));

            $cartItems = array_sum($cartItems);
        } catch (\Exception $e) {
            session()->forget('pagseguro_session_code');
            redirect()->route('checkout.index');
        }

        return view('checkout', compact('cartItems'));
    }

    public function process(Request $request)
    {
        try {
            $user = auth()->user();
            $dataPost = $request->all();
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            $reference = (string)Str::uuid();

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
            $result = $creditCardPayment->doPayment();

            $userOrder = [
                'reference' => $reference,
                'pagseguro_status' => $result->getStatus(),
                'pagseguro_code' => $result->getCode(),
                'items' => serialize($cartItems),
                // 'store_id' => 11
            ];

            $userOrder = $user->orders()->create($userOrder);
            $userOrder->stores()->sync($stores);

            // Notificar loja de novo pedido
            $store = (new Store())->notifyStoreOwners($stores);

            // Remove as chaves do cart da sessão
            // session()->forget('cart');
            // session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido criado com sucesso',
                    'order' => $reference
                ]
            ]);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? simplexml_load_string($e->getMessage()) : 'Erro ao processar o pedido';
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function notification()
    {
        try {

            $notification = new Notification();
            $notification = $notification->getTransaction();

            // Atualizar o pedido do usuario
            $reference = base64_decode($notification->getReference());
            $userOrder = UserOrder::whereReference($reference);

            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);

            // Comentários sobre o pedido pago
            if ($notification->getStatus() == 3) {
                // Liberar o pedido do usuário
                // Atualizar o status do pedido para em separação
                // Atualizar o usuário que o pedido foi pago
                // Notificar a loja da confirmação do pedido
            }
            return response()->json([], 204);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : '';
            return response()->json(['error' => $message], 500);
        }
    }

    // PAGSEGURO_SESSION_CODE, informações obre a sessão
    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
