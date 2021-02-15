@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-middle">
        <div class="col-md-12 text-center"><h4>TIPO DE PROVA</h4></div>
    </div>
    <br>
    <br>
    <button type="button" class="btn btn-dark" onclick="incluir()" title="Incluir tipo" data-toggle="modal" data-target="#mctcin">Novo</button>
    <div class="row justify-content-center align-middle font-weight-bold" style="font-size: 10px;">
        <div class="col-md-1">Id</div>
        <div class="col-md-9">Tipo</div>
        <div class="col-md-2 text-center">Ações</div>
    </div>
    <hr class="espver6" />
    @foreach($tipo_provas as $tipo_prova)
    <div class="row justify-content-center align-middle">
        <div class="col-md-1">{{$tipo_prova->id}}</div>
        <div class="col-md-9">{{$tipo_prova->tipo}} km</div>
        <div class="col-md-2 text-center">
            <a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" value="{{$tipo_prova->id}}" data-toggle="modal" data-target="#mctcin" onclick="edit('{{$tipo_prova->id}}','{{$tipo_prova->tipo}}')"><i class="fas fa-edit" style="cursor: pointer" title="Editar tipo"></i></a>&nbsp;&nbsp;
            <a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" value="{{$tipo_prova->id}}" data-toggle="modal" data-target="#mctcex" onclick="del({{$tipo_prova->id}})"><i class="fas fa-eraser" style="cursor: pointer" title="Excluir tipo"></i></a>&nbsp;&nbsp;
        </div>
    </div>
    <hr class="espver0" />
    @endforeach
    <div class="row justify-content-center align-middle">
        <div class="col-md-1"></div>
        <div class="col-md-9 text-center">{{$tipo_provas->links()}}</div>
        <div class="col-md-2"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="mctcex" tabindex="-1" role="dialog" aria-labelledby="confirmacao_exclusao" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmacao_exclusao">Confirmar Exclusão</h5>
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
    <div class="modal fade" id="mctcin" tabindex="-1" role="dialog" aria-labelledby="confirmacao_inclusao" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmacao_inclusao">Confirmar Operação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-justify"><label>Tipo</label><input class="form-control" type="number" name="tipo" id="itipo_prova_id" value="{{ old('tipo') }}" required>
                    </p>
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
var delid;
var editid;
var operacao;
function incluir() {
    operacao = 'inclusao';
}

function prosseguir_inclusao() {
    var tipo = $('#itipo_prova_id').val();
    if (tipo == null || tipo == '') {
        alert('Campo obrigatório');
    } else {
    if (operacao == 'inclusao') {
        var baseUrl = getBaseUrl();
        var string = baseUrl.concat('/api/tiposprova/');
        var params = { '_token': '{{auth::user()->token}}', 'tipo': tipo};
        const http = new XMLHttpRequest()
        http.open('POST', string)
        http.setRequestHeader('Content-type', 'application/json; charset=utf-8')
        http.send(JSON.stringify(params)) // Make sure to stringify
        http.onload = function() {
            // Do whatever with response
            alert(http.response.replace(/"/g,""));
            $('.modal.close').click();
            window.location.reload
        }
    } else {
        var baseUrl = getBaseUrl();
        var string = baseUrl.concat('/api/tiposprova/',editid);
        var params = { '_token': '{{auth::user()->token}}', 'tipo': tipo};
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

function edit(id, tipo) {
    operacao = 'alteracao';
    editid = id;
    $('#itipo_prova_id').val(tipo);
}

function del(id) {
    delid = id;
}

function prosseguir_exclusao() {
    var baseUrl = getBaseUrl();
    var string = baseUrl.concat('/api/tiposprova/',delid);
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
