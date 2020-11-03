@extends('layouts.app')

@section('title', 'Criar Produtos')

@section('content')
<h1>Criar produtos</h1>
<form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    {{-- Name --}}
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" id="name"
            value="{{old('name')}}">
        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    {{-- Description --}}
    <div class="form-group">
        <label for="description">Descrição</label>
        <input type="text" class="form-control @error('description')is-invalid @enderror" name="description"
            id="description" value="{{old('description')}}">
        @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    {{-- Body --}}
    <div class="form-group">
        <label for="body">Conteúdo</label>
        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30" rows="10"
            value="{{old('body')}}"></textarea>
        @error('body')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    {{-- Price --}}
    <div class="form-group">
        <label for="price">Preço</label>
        <input type="text" class="form-control @error('price')is-invalid @enderror" name="price" id="price"
            value="{{old('price')}}">
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
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('categories')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>

    {{-- Photos --}}
    <div class="form-group">
        <label for="photos">Fotos</label>
        <input name="photos[]" type="file" class="form-control-file @error('photos.*') is-invalid @enderror" multiple>
        @error('photos.*')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div>
        <button class="btn btn-success btn-lg" type="submit">Criar Produto</button>
    </div>
</form>
@endsection