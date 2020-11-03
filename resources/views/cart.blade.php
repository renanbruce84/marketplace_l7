@extends('layouts.front')

@section('title', 'Cart')

@section('content')

<div class="row">
    <div class="col-12">
        <h2>Carrinho de compras</h2>        
    </div>
    <div class="col-12">
        @if ($cart)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ação</th>
                </tr>
            </thead>
            @php
                $total = 0;
            @endphp

            <tbody>
                @foreach ($cart as $c)
                    <tr>
                        <td class="align-middle">{{ $c['name'] }}</td>
                        <td class="align-middle">R$ {{ $c['price'] }}</td>
                        <td class="align-middle">{{ $c['amount'] }}</td>
                        @php                            
                            $subtotal = priceToDatabase($c['price']) * $c['amount'];                            
                            $total += $subtotal;
                        @endphp
                        <td class="align-middle">R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('cart.remove', ['slug' => $c['slug']]) }}" class="btn btn-danger btn-lg">
                                Remover</a>                                
                        </td>
                        
                    </tr>
                @endforeach
                <tr class="table-secondary">
                    <td colspan="3">Total: </td>
                    <td colspan="2">R$ {{ number_format($total, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>


        <div class="col-md-12">
            <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg float-right">Concluir compra</a>
            <a href="{{ route('cart.cancel') }}" class="btn btn-danger btn-lg float-left">Cancelar compra</a>
        </div>

        @else
            <div class="alert alert-warning">Carrinho vazio</div>
        @endif
    </div>
</div>

@endsection