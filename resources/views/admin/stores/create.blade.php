@extends('layouts.app')
@section('title', 'Criar Loja')

@section('content')
<h1>Criar loja</h1>
<form action="{{ route('admin.stores.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" id="name"
            value="{{old('name')}}">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Descrição</label>
        <input type="text" class="form-control @error('description')is-invalid @enderror" name="description"
            id="description" value="{{old('description')}}">
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">Telefone</label>
        <input type="text" class="form-control @error('phone')is-invalid @enderror" name="phone" id="phone" value="{{old('phone')}}">
        @error('phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="mobile_phone">Celular</label>
        <input type="text" class="form-control @error('mobile_phone')is-invalid @enderror" name="mobile_phone"
            id="mobile_phone" value="{{old('mobile_phone')}}">
        @error('mobile_phone')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

      {{-- Imagem do Logotipo --}}
      <div class="form-group">
        <label for="logo">Fotos</label>
        <input name="logo" type="file" class="form-control-file @error('logo') is-invalid @enderror">
        @error('logo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" id="slug">
    </div>

    <div>
        <button class="btn btn-success btn-lg" type="submit">Criar Loja</button>
    </div>

</form>
@endsection

{{-- SELECT u.name, COUNT(s.id) as QtdLojas FROM users u INNER JOIN stores s ON u.id = s.user_id GROUP BY u.id --}}