@extends('layouts.front')

@section('title', 'Home')

@section('content')

{{-- Lista de Produtos --}}
<div class="row front">
    @foreach ($products as $key => $product)
    <div class="col-md-4">
        <div class="card" style="width: 100%">
            @if ($product->photos->count())
                <img src="{{ asset('storage/' . $product->thumb) }}" alt="" class="card-img-top">
                @else
                    <img src="{{ asset('assets/img/no-photo.jpg') }}" alt="no photo" class="card-img-top">
                
            @endif
            <span class="card-body">
                <h2 class="card-title">{{$product->name}}</h2>
                <p class="card-text">{{$product->description}}</p>
                <h5 class="card-text">R$ {{$product->price}}</h5>
            </span>
            <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-success">
                Ver produto
            </a>
        </div>
    </div>

    @if (($key + 1) % 3 == 0 )
        </div>
        <div class="row front">
    @endif

    @endforeach
</div>

{{-- Lojas Destaques --}}
<div class="row">
    <div class="col-12">
        <h2>Lojas Destaque</h2>
        <hr>
    </div>

    @foreach ($stores as $store)        
        <div class="col-4">
            {{-- logotipo da loja --}}
            @if ($store->logo)
                <img src="{{ asset('storage/'. $store->logo) }}" alt="Logo da loja {{ $store->name }}" class="img-fluid" style="max-height: 100px">                
            @else
                <img src="https://via.placeholder.com/250x100.png?text=logo" alt="Logo da loja {{ $store->name }}" class="img-fluid" style="max-height: 100px">                
            @endif

            <h3>{{ $store->name }}</h3>
            <p>{{ $store->description }}</p>

            <a href="{{ route('store.single', ['slug' => $store->slug]) }}" class="btn btn-sm btn-success">
                Ver Loja
            </a>

        </div>
    @endforeach
    
</div>

@endsection