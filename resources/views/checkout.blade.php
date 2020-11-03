@extends('layouts.front')

@section('title', 'Checkout')

@section('stylesheets')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')


<div class="container">
    <div class="col-md-6">
        {{-- Menssagem de erro --}}
        <div class="row">
            <div class="col-md-12 msg"></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2>Dados para o pagamento</h2>
                <hr>
            </div>
        </div>

        <form action="#" method="post">
            @csrf

            <div class="row">
                <div class="form-group col-md-8">
                    <label for="card_name">Nome no Cartão:</label>
                    <input class="form-control" type="text" name="card_name" id="name">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-8">
                    <label for="card_number">Número do Cartão:
                        <span class="brand text-uppercase"></span>
                    </label>
                    <input class="form-control" type="text" name="card_number" id="card_number">
                    <input type="hidden" name="card_brand">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="card_month">Mes de Expiração</label>
                    <input class="form-control" type="text" name="card_month" id="card_month">
                </div>

                <div class="form-group col-md-3">
                    <label for="card_year">Ano de Expiração</label>
                    <input class="form-control" type="text" name="card_year" id="card_year">
                </div>
            </div>

            <div class="row">

                <div class="form-group col-md-5">
                    <label for="card_cvv">Código de segurança</label>
                    <input class="form-control" type="text" name="card_cvv" id="card_cvv">
                </div>
                {{--  Installments  --}}
                <div class="col-md-12 installments form-group"></div>

            </div>

            <button class="btn btn-success btn-lg proccessCheckout">Efetuar Pagamento</button>

        </form>
    </div>
</div>

@endsection


{{-- Script do pagseguro --}}
@section('scripts_head')
{{-- Importando o script do pagseguro --}}

@endsection


@section('scripts')
<script type="text/javascript"
    src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
{{-- Toastr --}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // recupera e seta o valor do ID recebido da sessao pagseguro_session_code
    const sessionId = '{{ session()->get('pagseguro_session_code') }}';        
    
    const urlThanks = '{{ route("checkout.thanks") }}';
    const urlProccess = '{{route("checkout.process")}}';
    const csrf = '{{csrf_token()}}';
    
    const amountTransaction = '{{ $cartItems }}';
    
    PagSeguroDirectPayment.setSessionId(sessionId);
</script>


<script src="{{ asset('js/pagseguro_events.js') }}"></script>
<script src="{{ asset('js/pagseguro_functions.js') }}"></script>

@endsection