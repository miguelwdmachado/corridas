@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-middle">
        <div class="col-md-12 text-center"><h4>RESULTADO POR IDADE</h4></div>
    </div>
    <br>
    <div class="row justify-content-center align-middle font-weight-bold" style="font-size: 10px;">
        <div class="col-md-1">Id</div>
        <div class="col-md-1">Tipo</div>
        <div class="col-md-2">Data da Prova</div>
        <div class="col-md-1">Id Corredor</div>
        <div class="col-md-2">Idade</div>
        <div class="col-md-3">Nome do Corredor</div>
        <div class="col-md-2">Posição</div>
    </div>
    <hr class="espver6" />
    @foreach($listagrupada as $corredorprova)
    <div class="row justify-content-center align-middle" style="font-size: 12px">
        <div class="col-md-1">{{$corredorprova->prova_id}}</div>
        <div class="col-md-1">{{$corredorprova->prova->tipo_prova->tipo}} km</div>
        <div class="col-md-2">{{\Carbon\Carbon::parse($corredorprova->data)->format('d/m/Y')}}</div>
        <div class="col-md-1">{{$corredorprova->corredor_id}}</div>
        <div class="col-md-2">{{$corredorprova->grupo}}</div>
        <div class="col-md-3">{{$corredorprova->corredor['nome']}}</div>
        <div class="col-md-2">{{$corredorprova->cl}}</div>
    </div>
    <hr class="espver0" />
    @endforeach
</div>

@endsection
