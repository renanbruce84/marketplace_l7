<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L7 - @yield('title')</title>
    
    {{-- Font-Awesome --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        .d-flex form {
            height: 0;
        }
    </style>


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">

        {{-- logotipo --}}
        <a class="navbar-brand" href="{{ route('home') }}">Marketplace L7</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
            aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar --}}
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            @auth
            <ul class="navbar-nav mr-auto">

                <li class="nav-item @if (request()->is('admin/orders*') ) active @endif">
                    <a class="nav-link" href="{{ route('admin.orders.my') }}">Meus Pedidos</a>
                </li>
                <li class="nav-item @if (request()->is('admin/stores*') ) active @endif">
                    <a class="nav-link" href="{{ route('admin.stores.index') }}">Loja</a>
                </li>
                <li class="nav-item  @if (request()->is('admin/products*')) active @endif">
                    <a class=" nav-link" href="{{ route('admin.products.index') }}">Produtos</a>
                </li>
                <li class="nav-item  @if (request()->is('admin/categories*')) active @endif">
                    <a class=" nav-link" href="{{ route('admin.categories.index') }}">Categorias</a>
                </li>
            </ul>

            <div class="my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a href="{{ route('admin.notifications.index') }}" class="nav-link">
                            <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                            <i class="fa fa-bell"></i>
                        </a>
                    </li>

                    {{-- Logout --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="
                            event.preventDefault();
                            document.querySelector('form.logout').submit()">Sair</a>

                        <form action="{{ route('logout') }}" class="logout d-none" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link text-white-50">Sair</button>
                        </form>
                    </li>

                    <li class="nav-item ml-1">
                        <span class="nav-link">Olá, {{ auth()->user()->name }}</span>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>