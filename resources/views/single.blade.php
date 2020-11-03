@extends('layouts.front')

@section('title', 'Single')   

@section('content')

    <div class="row">

        {{-- imagem --}}
        <div class="col-4" > 
            @if ($product->photos->count())
                <img src="{{ asset('storage/' . $product->thumb) }}" class="card-img-top thumb" style="width: 85%"  alt="">
                <div class="row mt-3">
                    @foreach ($product->photos as $photo)
                        <div class="col-4">
                            <img src="{{ asset('storage/'. $photo->image) }}" alt="" class="img-fluid img-small" alt="">
                        </div>
                    @endforeach
                </div>    
            @else
                <img src="{{ asset('assets/img/no-photo.jpg') }}" class="card-img-top" style="width: 85%">                
            @endif
            
        </div>        

        {{-- Informações --}}
        <div class="col-8">            
            <div class="col">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <h3>R$ {{ $product->price }}</h3>
                <span> <strong>Loja:</strong> {{ $product->store->name }}</span>
            </div>
            
            {{-- @auth --}}
            <div class="product-add col">
                <hr>
                <form action="{{ route('cart.add') }}" method="post">
                    @csrf

                    <input type="hidden" name="product[name] " value="{{ $product->name }}">
                    <input type="hidden" name="product[price] " value="{{ $product->price }}">
                    <input type="hidden" name="product[slug] " value="{{ $product->slug }}">                    
                    
                    <div class="form-group">
                        <label for="amount">Quantidade</label>
                        <input type="number"  class="form-control col-md-2" value="1" name="product[amount]" id="amount">
                    </div>
                    
                    <button class="btn btn-danger btn-lg">Comprar</button>
                    
                </form>
            </div>
            {{-- @endauth  --}}
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{ $product->body }}
        </div>
    </div>
    
@endsection

{{-- Substitui a imagem grande ao clicar nas imagens menores --}}
@section('scripts')
    <script>
        let thumb = document.querySelector('img.thumb');
        let imgSmall = document.querySelectorAll('img.img-small');

        imgSmall.forEach(function(el){
            el.addEventListener('click', function(){
                thumb.src =  el.src;
            });
        });

    </script>
    
@endsection