@extends('layouts.front')

@section('title', 'Home')

@section('content')

<div class="row front">

    <div class="col-12">
        <h2>
            {{ $category->name }}
        </h2>
        <hr>
    </div>

    @forelse ($category->product as $key => $product)

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
                Nenhum produto encontrado para esta categoria!
            </h3>        
        </div>
    @endforelse

</div>


@endsection