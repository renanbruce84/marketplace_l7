<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L7 - @yield('title')</title>
    {{-- Bootstrap --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Font-Awesome --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheets')
    @yield('scripts_head')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">

        {{-- Menu navabar right --}}
        <a class="navbar-brand" href="{{route('home')}}">Marketplace L7</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>

                {{-- Exibe as Categorias na barra do navBar --}}
                @foreach ($categories as $category)
                    <li class="nav-item  @if(request()->is('category/'.$category->slug)) active @endif">
                        <a class="nav-link" href="{{ route('category.single', ['slug' => $category->slug]) }}">
                            {{ $category->name }}
                        </a>
                    </li>                    
                @endforeach
            </ul>

            {{-- @auth --}}
            {{-- Menu navabar center --}}
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                    <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                    <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                </li>
                <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                    <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
                </li>
            </ul>

            {{-- Menu navabar left --}}
            <div class="my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">  
                    @auth
                        <li class="nav-item @if(request()->is('my-orders')) active @endif">
                            <a href="{{ route('user.orders') }}" class="nav-link">Meus Pedidos</a>
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
                    @endauth

                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link" data-toggle="tooltip"
                            data-placement="bottom" title="Carrinho">
                            @if (session()->has('cart'))
                                {{-- Faz a contagem dos produtos --}}
                                <span class="badge badge-danger">{{ count(session()->get('cart')) }}</span>
                                {{-- Faz o somatório geral de todos os itens --}}
                                {{-- <span class="badge badge-danger">{{ array_sum(array_column(session()->get('cart'), 'amount')) }}</span>
                                --}}
                            @endif
                            <i class="fa fa-shopping-cart fa-lg"></i>
                        </a>
                    </li>

                </ul>
            </div>
            {{-- @endauth --}}

        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')

        @yield('scripts')
    </div>

    {{-- Para utilizar o ajax é necessáio usar o jquery NÃO slim --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>