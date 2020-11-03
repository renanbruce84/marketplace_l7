<?php

namespace App\Http\Controllers;

use App\Traits\RealPriceTrait as realPrice;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use realPrice;

    /***
     * Index
     ***/
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];        
        return view('cart', compact('cart'));
    }

    /** 
     * Add
     ***/
    public function add(Request $request)
    {
        $productData = $request->get('product');

        $product = \App\Product::whereSlug($productData['slug']);

        
        // Verifica se existe produto e se a quantidade == 0 no formulario 
        if (!$product->count() || $productData['amount'] <= 0)
        return redirect()->route('home');
        
        $productData['real_price'] = $this->realPrice($productData['price']);

        // SEGURANÇA !!! Compara os dois arrays e sobreescreve mundaças feitas no front-end sobre os dados do produto
        $product = array_merge(
            $productData,
            $product->first(
                [
                    'id',
                    'name',
                    'price',                    
                    'store_id'
                ]
            )->toArray()

            
        );

        // verificar se existe sessáo para o produto
        if (session()->has('cart')) {

            $products = session()->get('cart');
            $productsSlug = array_column($products, 'slug');

            if (in_array($product['slug'], $productsSlug)) {
                $products = $this->productsIncrement($product['slug'], $product['amount'], $products);
                // Existindo o produto na sessão, apenas atualiza a lista da sessão
                session()->put('cart', $products);
            } else {
                // Existindo a sessão, deve-se adicionar os produtos na sessão existente
                session()->push('cart', $product);
            }
        } else {
            // não existindo a sessão, devemos criar a sessão com o primeiro produto             
            $products[] = $product;
            session()->put('cart', $products);
        }

        flash('Produto adicionado com sucesso')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    /**
     * Remove
     ***/
    public function remove($slug)
    {
        if (!session()->has('cart'))
            return redirect()->route('cart.index');

        $products = session()->get('cart');

        // array_filter - Quando retorna false, o array key é removido do array
        $products = array_filter($products, function ($line) use ($slug) {
            return $line['slug'] != $slug;
        });
        // Atualiza a session a key cart
        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }

    /**
     * Cancel
     ***/
    public function cancel()
    {
        session()->forget('cart');

        flash('Desistência da compra realizada com sucesso')->success();
        return redirect()->route('cart.index');
    }

    /**
     * Product Increment
     ***/
    public function productsIncrement($slug, $amount, $products)
    {
        $products = array_map(function ($line) use ($slug, $amount) {
            if ($slug == $line['slug']) {
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }
}
