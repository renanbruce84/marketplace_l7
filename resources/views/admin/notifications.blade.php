@extends('layouts.app')

@section('title', 'Notificações')

@section('content')

<div class="row">
    <div class="col-12">
        <a href="{{ route('admin.notifications.read.all') }}" class="btn btn-success mt-2 mb-2">Marcar todas como
            lidas</a>
        <hr>
    </div>
</div>

<table class="table table-striped table-sm">
    <thead class="thead-dark">
        <tr>
            <th>NotificaçãoNome</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

        {{-- @if ($products)                 --}}
        {{-- @foreach ($unreadNotifications as $n) --}}
        {{-- @endforeach --}}
        {{-- @endif --}}
        @forelse ($unreadNotifications as $n)        
            <tr>
                <td>{{ $n->data['message'] }}</td>
                <td>{{ $n->created_at->locale('pt')->diffForHumans() }}</td>

                <td>
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm"
                            href="{{ route('admin.notifications.read', ['notification'=>$n->id]) }}">
                            Marcar como lida.
                        </a>
                    </div>

                </td>
            </tr>        
        @empty
            <tr>
                <td colspan="3">
                    <div class="alert alert-warning">Nenhuma notificação encontrada!</div>
                </td>
            </tr>
            
        @endforelse
        
    </tbody>
</table>

@endsection