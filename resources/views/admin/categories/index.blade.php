@extends('layouts.app')

@section('title', 'Todas as Categorias')

@section('content')

    <a href="{{route('admin.categories.create')}}" class="btn btn-lg btn-success">Criar Categoria</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td width="15%">                
                        <div class="d-flex justify-content-start">
                            <a class="btn btn-primary btn-sm"
                                href="{{ route('admin.categories.edit', ['category'=>$category->id] ) }} ">Editar</a>
        
                            <form action="{{ route('admin.categories.destroy', ['category'=>$category->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Remover</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection