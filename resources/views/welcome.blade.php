@extends('layouts.app')

@section('content')
@guest
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
@endguest
@endsection
