@extends('layouts.front')

@section('title', 'Home')

@section('content')

<div class="row front">

    {{-- logotipo da loja --}}
    <div class="col-4 d-flex justify-content-center">
        @if ($store->logo)
            <img src="{{ asset('storage/'. $store->logo) }}" alt="Logo da loja {{ $store->name }}" class="img-fluid" style="max-height: 100px">                
        @else
            <img src="https://via.placeholder.com/250x100.png?text=logo" alt="Logo da loja {{ $store->name }}" class="img-fluid" style="max-height: 100px">                
        @endif
    </div>
    {{-- Informações da loja --}}
    <div class="col-8">  
        <h2> {{ $store->name }} </h2>
        <p> {{ $store->description }} </p>
        <p>
            <strong>Contatos:</strong>
            <span>
                {{ $store->phone }} | {{ $store->mobile_phone }}
            </span>
        </p>
    </div>

    <div class="col-12">
        <hr>
        <h3 style="margin-bottom: 30px;">Produtos desta loja</h3>        
    </div>

    @forelse ($store->product as $key => $product)

        <div class="col-md-4">
            <div class="card" style="width: 100%">
                @if ($product->photos->count())
                    <img src="{{ asset('storage/' . $product->photos->first()->image) }}" alt="" class="card-img-top">
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
        
    @empty        
        <div class="col-23">
            <h3 class="alert alert-warning">
                Nenhum produto encontrado para esta loja!
            </h3>        
        </div>
    @endforelse

</div>


@endsection