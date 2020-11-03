@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Pedidos Recebidos</h2>
        <hr>
    </div>
</div>

<div class="col-12">

    {{-- Arcordeão --}}
    <div class="accordion" id="accordionExample">

        @forelse ($orders as $key => $order)
            
            <div class="card">

                <div class="card-header" id="heading{{ $key }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $key }}"
                            aria-expanded="true" aria-controls="collapse{{ $key }}">
                            Pedido n° {{ $order->reference }}
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $key }}" class="collapse @if($key == 0)show @endif" aria-labelledby="heading{{ $key }}" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>            
                            @php
                                $items = unserialize($order->items);
                            @endphp           

                           @foreach (filtersItemsByStoreId($items, auth()->user()->store->id) as $item)
                                <li>{{ $item['name'] }} | R$ {{ number_format(priceToDatabase($item['price']) * $item['amount'], 2, ',', '.') }}</li>                                
                                {{-- <li>{{ $item['name'] }} | R$ {{ number_format($item['real_price'] * $item['amount'], 2, ',', '.') }}</li>                                 --}}
                                Quantidade pedida: {{ $item['amount'] }}
                                
                           @endforeach
                       </ul>
                    </div>
                </div>

            </div>

        @empty

        <div class="alert alert-warning">
            Nenhum pedido recebido!
        </div>
            
        @endforelse

    </div>

    <div class="col-12">
        <hr>
        {{ $orders->links() }}
    </div>

</div>

</div>
@endsection