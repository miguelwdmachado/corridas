@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center align-middle">
        <div class="col-md-12 text-center"><h4>COMPETIÇÕES</h4></div>
    </div>
    <br>
    <br>
    <button type="button" class="btn btn-dark" onclick="incluir()" title="Incluir participante" data-toggle="modal" data-target="#mccin">Novo</button>
    <div class="row justify-content-center align-middle font-weight-bold" style="font-size: 10px;">
        <div class="col-md-1">Id</div>
        <div class="col-md-1">Prova</div>
        <div class="col-md-1">Data</div>
        <div class="col-md-4">Corredor</div>
        <div class="col-md-1">Largada</div>
        <div class="col-md-1">Chegada</div>
        <div class="col-md-1">Tempo</div>
        <div class="col-md-2 text-center">Ações</div>
    </div>
    <hr class="espver6" />
    @foreach($corredoresprovas as $corredorprova)
    <div class="row justify-content-center align-middle">
        <div class="col-md-1">{{$corredorprova->id}}</div>
        <div class="col-md-1">{{$corredorprova->prova->tipo_prova->tipo}} km</div>
        <div class="col-md-1">{{\Carbon\Carbon::parse($corredorprova->prova->data)->format('d/m/Y')}}</div>
        <div class="col-md-4">{{$corredorprova->corredor['nome']}}</div>
        @if($corredorprova->h_inicio != NULL)
            <div class="col-md-1">{{\Carbon\Carbon::parse($corredorprova->h_inicio)->format('H:i:s')}}</div>
            <div class="col-md-1">{{\Carbon\Carbon::parse($corredorprova->h_fim)->format('H:i:s')}}</div>
            <div class="col-md-1">{{\Carbon\Carbon::parse($corredorprova->tempo)->format('H:i:s')}}</div>
        @else
            <div class="col-md-3"></div>
        @endif
        <div class="col-md-2 text-center">
            <a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" value="{{$corredorprova->id}}" data-toggle="modal" data-target="#mccin" onclick="edit('{{$corredorprova->id}}','{{$corredorprova->corredor_id}}','{{$corredorprova->prova_id}}')"><i class="fas fa-edit" style="cursor: pointer" title="Editar participante"></i></a>&nbsp;&nbsp;
            <a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" value="{{$corredorprova->id}}" data-toggle="modal" data-target="#mccex" onclick="del({{$corredorprova->id}})"><i class="fas fa-eraser" style="cursor: pointer" title="Excluir participante"></i></a>&nbsp;&nbsp;
            <a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" value="{{$corredorprova->id}}" data-toggle="modal" data-target="#mccre" onclick="relat('{{$corredorprova->id}}','Prova: {{$corredorprova->prova->tipo_prova->tipo}}','{{\Carbon\Carbon::parse($corredorprova->prova->data)->format('d/m/Y')}}','{{$corredorprova->corredor['nome']}}')"><i class="fas fa-trophy" style="cursor: pointer" title="Lançar resultado"></i></a>&nbsp;&nbsp;
        </div>
    </div>
    <hr class="espver0" />
    @endforeach
    <div class="row justify-content-center align-middle">
        <div class="col-md-1"></div>
        <div class="col-md-10 text-center">{{$corredoresprovas->links()}}</div>
        <div class="col-md-1"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="mccex" tabindex="-1" role="dialog" aria-labelledby="confirmacao_exclusao" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmacao_exclusao">Confirmar Esclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center"><i class="fas fa-exclamation-triangle fa-2x" style="color: red" alt="Atenção!" title="Atenção!"></i>
                    <strong>Caso deseje prosseguir, clique no botão "Prosseguir com a exclusão".</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="prosseguir_exclusao()">Prosseguir com a exclusão</button>
                    <button type="button" class="btn btn-secondary-active" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Incluir-->
    <div class="modal fade" id="mccin" tabindex="-1" role="dialog" aria-labelledby="confirmacao_inclusao" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmacao_inclusao">Confirmar Operação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="TextoAzul" style="padding-top: 10px;">
                    <label for="prova" class="text-justify">Prova Tipo</label>
                    <select class="InputHome text-center text-md-left" name="prova_id" id="id_prova_id" placeholder="Selecione o tipo" title="Favor selecionar o tipo" onchange="pega_data()" required>
                    <option value=""></option>
                    @foreach($provas as $prova)
                    <option value="{{$prova->id}},{{$prova->data}}" name="tipo">{{$prova->tipo_prova->tipo}} km - Data: {{\Carbon\Carbon::parse($prova->data)->format('d/m/Y')}}</option>
                    @endforeach
                    </select>
                    <input type="hidden" name="grupo_id" id='id_grupo_id' value="">
                    <input type="hidden" name="data" id='id_dprova' value="">
                    </p>
                    <p class="text-justify"><label>Nome&nbsp;&nbsp;</label>
                    <select class="InputHome text-center text-md-left" name="corredor_id" id="id_corredor_id" placeholder="Selecione o corredor" title="Favor selecionar o corredor" onchange="calcula_idade()" required>
                    <option value=""></option>
                    @foreach($corredores as $corredor)
                    <option value="{{$corredor->id}},{{$corredor->dt_nascimento}}" name="tipo">{{$corredor->nome}}</option>
                    @endforeach
                    </select>
                    <input type="hidden" name="grupo" id='id_grupo' value="">
                    <input type="hidden" name="idade" id='id_idade' value="">
                    </p><br>
                    <p class="text-center"><i class="fas fa-exclamation-triangle fa-2x" style="color: red" alt="Atenção!" title="Atenção!"></i>
                    <strong>Caso deseje prosseguir, clique no botão "Prosseguir com a inclusão".</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="prosseguir_inclusao()">Prosseguir com a inclusão/alteração</button>
                    <button type="button" class="btn btn-secondary-active" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Resultado-->
    <div class="modal fade" id="mccre" tabindex="-1" role="dialog" aria-labelledby="confirmacao_inclusao" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="top"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-justify"><label>Horário de Início&nbsp;&nbsp;</label><input class="form-control" type="text" name="h_inicio" id="id_h_inicio" value="{{ old('h_inicio') }}" title="Horário de Início" aria-label="Horário de Início" required></p>
                    <p class="text-justify"><label>Horário de Finalização&nbsp;&nbsp;</label><input class="form-control" type="text" name="h_fim" id="id_h_fim" value="{{ old('h_fim') }}" title="Horário de Início" aria-label="Horário de Início" required></p><br>
                    <p class="text-center"><i class="fas fa-exclamation-triangle fa-2x" style="color: red" alt="Atenção!" title="Atenção!"></i>
                    <strong>Caso deseje prosseguir, clique no botão "Prosseguir com lançamento".</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="prosseguir_resultado()">Prosseguir com lançamento</button>
                    <button type="button" class="btn btn-secondary-active" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var delid;
var editid;
var relid;
var operacao;
var trel;
var data;
var dt_nascimento;
var prova_id;
var corredor_id;
var icorredor;
var grupo;
$(document).ready(function() {
    $("#iid_cpf").mask("000.000.000-00");
    $("#iid_data").mask("00/00/0000");
    $("#id_h_inicio").mask("00:00:00");
    $("#id_h_fim").mask("00:00:00");
})
</script>

<script>

function calcula_idade() {
    var valor = $('#id_corredor_id').val();
    var avalor = valor.split(",");
    corredor_id = avalor[0];
    dt_javascript = avalor[1];
    icorredor = idade(dt_javascript.substring(0,4), dt_javascript.substring(4,2), dt_javascript.substring(6,2));
    $('#id_idade').val(icorredor);
    if (icorredor > 17 && icorredor <= 25)
        grupo = '18 – 25 anos';
    if (icorredor > 25 && icorredor <= 35)
        grupo = '25 – 35 anos';
    if (icorredor > 35 && icorredor <= 45)
        grupo = '35 – 45 anos';
    if (icorredor > 45 && icorredor <= 55)
        grupo = '45 – 55 anos';
    if (icorredor > 55)
        grupo = 'Acima de 55 anos';
    $('#id_grupo').val(grupo);

}

function idade(ano_aniversario, mes_aniversario, dia_aniversario) {
    var d = new Date,
        ano_atual = d.getFullYear(),
        mes_atual = d.getMonth() + 1,
        dia_atual = d.getDate(),

        ano_aniversario = +ano_aniversario,
        mes_aniversario = +mes_aniversario,
        dia_aniversario = +dia_aniversario,

        quantos_anos = ano_atual - ano_aniversario;

    if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
        quantos_anos--;
    }

    return quantos_anos < 0 ? 0 : quantos_anos;
}

function pega_data() {
    var valor = $('#id_prova_id').val();
    var avalor = valor.split(",");
    $('#id_dprova').val(avalor[1]);
    prova_id = avalor[0];
}

function incluir() {
    operacao = 'inclusao';
}

function edit(id, corredor_id, prova_id) {
    operacao = 'alteracao';
    editid = id;
    $('#id_corredor_id').val(corredor_id);
    $('#id_prova_id').val(prova_id);
}

function del(id) {
    delid = id;
}

function relat(id, pro, pdat, pno) {
    relid = id;
    $('#top').text(pro.concat(' km - ',pdat,' - ',pno));
}

function prosseguir_inclusao() {
    var data = $('#id_dprova').val();
    var idade = $('#id_idade').val();
    var grupo = $('#id_grupo').val();
    if (corredor_id == null || corredor_id == '' || prova_id == null || prova_id == '' || data == null || data == '' || grupo == null || grupo == '') {
        alert('Campo obrigatório');
    } else {

    if (idade < 18) {
        alert('O Corredor deve ter mais de 18 anos!');
    } else  {
    if (operacao == 'inclusao') {
        var baseUrl = getBaseUrl();
        var string = baseUrl.concat('/api/competicoes/');
        var params = { '_token': '{{auth::user()->token}}', 'corredor_id': corredor_id, 'prova_id': prova_id, 'data': data, 'grupo': grupo };
        const http = new XMLHttpRequest()
        http.open('POST', string)
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8')
        http.send(JSON.stringify(params)) // Make sure to stringify
        http.onload = function() {
            // Do whatever with response
            alert(http.response.replace(/"/g,""));
            $('.modal.close').click();
            window.location.reload();
        }
    } else {
        var data = $('#id_dprova').val();
        var idade = $('#id_idade').val();
        var grupo = $('#id_grupo').val();
        if (idade < 18) {
            alert('O Corredor deve ter mais de 18 anos!');
        } else { // 4º else
        if (corredor_id == null || corredor_id == '' || prova_id == null || prova_id == '' || data == null || data == '' || grupo == null || grupo == '') {
            alert('Campo obrigatório');
        } else {
        var baseUrl = getBaseUrl();
        var string = baseUrl.concat('/api/competicoes/',editid);
        var params = { '_token': '{{auth::user()->token}}', 'corredor_id': corredor_id, 'prova_id': prova_id, 'data': data };
        const http = new XMLHttpRequest()
        http.open('PUT', string)
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8')
        http.send(JSON.stringify(params)) // Make sure to stringify
        http.onload = function() {
            // Do whatever with response
            alert(http.response.replace(/"/g,""));
            $('.modal.close').click();
            window.location.reload();
        }
    }
    }
    }
    }
    }

}

function prosseguir_resultado() {
    var h_inicio = $('#id_h_inicio').val();
    var h_fim = $('#id_h_fim').val();
    if (h_inicio == null || h_inicio == '' || h_fim == null || h_fim == '') {
        alert('Campo obrigatório');
    } else {
        var baseUrl = getBaseUrl();
        var string = baseUrl.concat('/api/resultado/',relid);
        var params = { '_token': '{{auth::user()->token}}', 'h_inicio': h_inicio, 'h_fim': h_fim };
        const http = new XMLHttpRequest()
        http.open('PUT', string)
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8')
        http.send(JSON.stringify(params)) // Make sure to stringify
        http.onload = function() {
            // Do whatever with response
            alert(http.response.replace(/"/g,""));
            $('.modal.close').click();
            window.location.reload();
        }
    }
}

function prosseguir_exclusao() {
    var baseUrl = getBaseUrl();
    var string = baseUrl.concat('/api/competicoes/',delid);
    var params = { '_token': '{{auth::user()->token}}' };
    const http = new XMLHttpRequest()
    http.open('DELETE', string)
    http.setRequestHeader('Content-type', 'application/json')
    http.send(JSON.stringify(params)) // Make sure to stringify
    http.onload = function() {
        // Do whatever with response
        alert(http.response.replace(/"/g,""));
        $('.modal.close').click();
        window.location.reload();
    }
}
</script>

@endsection
