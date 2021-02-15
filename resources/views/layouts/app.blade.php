<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Corridas') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
      integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Corridas') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                            </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tiposprova') }}">{{ __('Tipo de Corrida') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('corridas') }}">{{ __('Corridas') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('corredores') }}">{{ __('Corredores') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('competicoes') }}">{{ __('Corredores Participantes') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('clgeral') }}">{{ __('Classificação Geral') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('clpidade') }}">{{ __('Classificação por Idade') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @guest
                @if ( Route::has('register') or Route::has('login') )
                  @yield('content')
                @else
                <div class="container">
                    <div class="row justify-content-center align-middle"
                        style="min-height: 600px; justify-content: center; align-items: center">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                          <p class="text-justify">
                            <h4>SEJA BEM VINDO A NOSSO SITE. PARA TER ACESSO A NOSSA API, É NECESSÁRIO FAZER O CADASTRO NO MENU ACIMA.<br>
                                AO LOGAR NO SITE, VOCÊ TERÁ ACESSO AO SEU CONTEÚDO.</h4>
                          </p>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                @endif
            @else
            @yield('content')
            @endguest
        </main>
    </div>

<script>
$(document).ready( function() {
    $('.dropdown-toggle').dropdown();
});
function getBaseUrl() {
    // Nome do host
    var hostName = location.hostname;

    if (hostName === "localhost") {
        // Endereço após o domínio do site
        pathname = window.location.pathname;
        // Separa o pathname com uma barra transformando o resultado em um array
        splitPath = pathname.split('/');

        // Obtém o segundo valor do array, que é o nome da pasta do servidor local
        path = splitPath[1];

        baseUrl = "http://" + hostName + "/" + path;
    } else {
        baseUrl = "http://" + hostName;
    }

    return baseUrl;
}
</script>
</body>
</html>
