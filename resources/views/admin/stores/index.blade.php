@extends('layouts.app')

@section('title', 'Todas as Lojas')

@section('content')

<a href="{{route('admin.stores.create')}}" class="btn btn-success mt-2 mb-2 @if($store) disabled @endif">Criar Loja</a>

<table class="table table-striped table-sm">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Loja</th>
            <th>Total de produtos</th>
            <th>Ações</th>
        </tr>
    </thead>
    @if ($store)
    <tbody>
        <tr>
            <td>{{ $store->id }}</td>
            <td>{{ $store->name }}</td>
            <td>{{ $store->product->count() }}</td>
            <td>
                <div class="d-flex">
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.stores.edit', ['store'=>$store->id] ) }} ">Editar</a>
                    
                    <form action="{{ route('admin.stores.destroy', ['store'=>$store->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Remover</button>
                    </form>
                </div>
            </td>
        </tr>
    </tbody>
    @endif
</table>

@endsection