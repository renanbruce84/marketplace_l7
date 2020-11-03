@extends('layouts.app')
@section('title', 'Editar Loja')

@section('content')
<h1>Editar loja</h1>
<form action=" {{ route('admin.stores.update', ['store'=>$store->id]) }} " method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $store->name }}">
    </div>

    <div class="form-group">
        <label for="description">Descrição</label>
        <input type="text" class="form-control" name="description" id="description" value="{{ $store->description }}">
    </div>

    <div class="form-group">
        <label for="phone">Telefone</label>
        <input type="text" class="form-control" name="phone" id="phone" value="{{ $store->phone }}">
    </div>

    <div class="form-group">
        <label for="mobile_phone">Celular</label>
        <input type="text" class="form-control" name="mobile_phone" id="mobile_phone"
            value="{{ $store->mobile_phone }}">
    </div>

    {{-- Input da imagem do Logotipo --}}
    <div class="form-group">
        <label for="logo">Imagem Logotipo</label>
        <input name="logo" type="file" class="form-control-file @error('logo') is-invalid @enderror">
        @error('logo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>
    
     {{-- Mostra a imagem que esta armazenada no  disco --}}
    <div class="form-group">
        <p>
            <img src="{{ asset('storage/' . $store->logo) }}" style="max-width: 300px" alt="">
        </p>
    </div>

    <div>
        <button class="btn btn-primary btn-lg" type="submit">Atualizar Loja</button>
    </div>
</form>
@endsection