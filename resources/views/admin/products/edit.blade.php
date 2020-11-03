@extends('layouts.app')
@section('title', 'Editar Loja')

@section('content')
<h1>Atualizar produtos</h1>
<form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Name --}}
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
            value="{{$product->name}}">
        @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    {{-- Description --}}
    <div class="form-group">
        <label for="description">Descrição</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" name=" description"
            id="description" value="{{$product->description}}">
        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    {{-- Body --}}
    <div class="form-group">
        <label for="body">Conteúdo</label>
        <textarea class="form-control @error('body') is-invalid @enderror" name=" body" id="body" cols="30" rows="10">{{$product->body}}
        </textarea>
        @error('body')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    {{-- Price --}}
    <div class="form-group">
        <label for="price">Preço</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" name=" price" id="price"
            {{-- value="{{ number_format($product->price, 2, ',', '.') }}">    --}}
            value="{{ $product->price }}">   
                      
        @error('price')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    {{-- Categories --}}
    <div class="form-group">
        <label for="categories">Categorias</label>
        <select name="categories[]" class="form-control @error('categories') is-invalid @enderror" id="categories" multiple>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" @if($product->category->contains($category)) selected @endif >
                {{ $category->name }}
            </option>
            @endforeach
        </select>                
        @error('categories')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    {{-- Fotos --}}
    <div class="form-group">
        <label for="photos">Fotos do produto</label>     
        <input name="photos[]" type="file" class="form-control-file @error('photos.*') is-invalid @enderror" multiple>
        @error('photos.*')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div>
        <button class="btn btn-success btn-lg" type="submit">Atualizar Produto</button>
    </div>
</form>

<hr>

<div class="row">
    @foreach ($product->photos as $photo)
    <br>
    <div class="col-4 text-center">
        <img src="{{ asset('storage/'. $photo->image) }}" alt="" class="img-fluid">
            <form action=" {{ route('admin.photo.remove', ['image' => Str::of($photo->image)->basename()] ) }}"            
            method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-lg btn-danger">Remover</button>
        </form>
    </div>
    @endforeach
</div>

@endsection