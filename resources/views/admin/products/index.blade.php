@extends('layouts.app')

@section('title', 'Todas os Produtos')

@section('content')

<a href="{{route('admin.products.create')}}" class="btn btn-success mt-2 mb-2">Criar Produtos</a>

<table class="table table-striped table-sm">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        
        {{-- @if ($products)                 --}}
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>            
            {{-- <td>{{ number_format($product->price, 2, ',', '.') }}</td>             --}}
            <td>{{ $product->price }}</td>            
            <td>{{ $product->store->name }}</td>
            <td>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-primary btn-sm"
                    href="{{ route('admin.products.edit', ['product'=>$product->id] ) }} ">Editar</a>
                    
                    <form action="{{ route('admin.products.destroy', ['product'=>$product->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Remover</button>
                    </form>
                </div>
                
            </td>
        </tr>
        @endforeach
        {{-- @endif --}}
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>
@endsection