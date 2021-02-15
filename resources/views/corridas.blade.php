@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-middle">
        <div class="col-md-12 text-center"><h4>CORRIDAS</h4></div>
    </div>
    <br>
    <br>
    <button type="button" class="btn btn-dark" onclick="incluir()" title="Incluir tipo" data-toggle="modal" data-target="#mccin">Novo</button>
    <div class="row justify-content-center align-middle font-weight-bold" style="font-size: 10px;">
        <div class="col-md-1">Id</div>
        <div class="col-md-7">Corrida</div>
        <div class="col-md-2">Data</div>
        <div class="col-md-2 text-center">Ações</div>
    </div>
    <hr class="espver6" />
    @foreach($provas as $prova)
    <div class="row justify-content-center align-middle">
        <div class="col-md-1">{{$prova->id}}</div>
        <div class="col-md-7">{{$prova->tipo_prova->tipo}} km</div>
        <div class="col-md-2">{{\Carbon\Carbon::parse($prova->data)->format('d/m/Y')}}</div>
        <div class="col-md-2 text-center">
            <a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" value="{{$prova->id}}" data-toggle="modal" data-target="#mccin" onclick="edit('{{$prova->id}}','{{$prova->tipo_prova->tipo}}','{{\Carbon\Carbon::parse($prova->data)->format('d/m/Y')}}')"><i class="fas fa-edit" style="cursor: pointer" title="Editar prova"></i></a>&nbsp;&nbsp;
            <a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" value="{{$prova->id}}" data-toggle="modal" data-target="#mccex" onclick="del({{$prova->id}})"><i class="fas fa-eraser" style="cursor: pointer" title="Excluir prova"></i></a>&nbsp;&nbsp;
        </div>
    </div>
    <hr class="espver0" />
    @endforeach
    <div class="row justify-content-center align-middle">
        <div class="col-md-1"></div>
        <div class="col-md-9 text-center">{{$provas->links()}}</div>
        <div class="col-md-2"></div>
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
                        <label for="Empresa" class="text-justify">Tipo</label>
                        <select class="InputHome text-center text-md-left" name="tipo_prova_id" id="id_tipo_prova_id" placeholder="Selecione o tipo" title="Favor selecionar o tipo" required>
                            @foreach($tiposprova as $tipoprova)
                            <option value="{{$tipoprova->id}}" name="tipo">{{$tipoprova->tipo}} km</option>
                            @endforeach
                        </select>
                    </p>
                    <p class="text-justify"><label>Data&nbsp;&nbsp;</label><input class="form-control" type="text"  id="id_data" value="" pattern="^([0-9]{2}[\/]?[0-9]{2}[\/]?[0-9]{4})$" title="Favor preencher corretamente o campo DATA" aria-label="DATA" required></p><br>
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
</div>
<script>
$(document).ready(function() {
    $("#id_data").mask("00/00/0000");
})
</script>

<script>
var delid;
var editid;
var operacao;

function incluir() {
    operacao = 'inclusao';
}

function prosseguir_inclusao() {
    var tipo_prova_id = $('#id_tipo_prova_id').val();
    var data = $('#id_data').val();
    if (tipo_prova_id == null || tipo_prova_id == '' || data == null || data == '') {
        alert('Campo obrigatório');
    } else {

    if (operacao == 'inclusao') {
        var baseUrl = getBaseUrl();
        var string = baseUrl.concat('/api/corridas/');
        var params = { '_token': '{{auth::user()->token}}', 'tipo_prova_id': tipo_prova_id, 'data': data };
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
        var baseUrl = getBaseUrl();
        var string = baseUrl.concat('/api/corridas/',editid);
        var params = { '_token': '{{auth::user()->token}}', 'tipo_prova_id': tipo_prova_id, 'data': data };
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

function edit(id, tipo_prova_id, data) {
    operacao = 'alteracao';
    editid = id;

}

function del(id) {
    delid = id;
}

function prosseguir_exclusao() {
    var baseUrl = getBaseUrl();
    var string = baseUrl.concat('/api/corridas/',delid);
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
