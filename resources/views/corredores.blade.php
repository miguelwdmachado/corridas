@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-middle">
        <div class="col-md-12 text-center"><h4>CORREDORES</h4></div>
    </div>
    <br>
    <br>
    <button type="button" class="btn btn-dark" onclick="incluir()" title="Incluir tipo" data-toggle="modal" data-target="#mccin">Novo</button>
    <div class="row justify-content-center align-middle font-weight-bold" style="font-size: 10px;">
        <div class="col-md-1">Id</div>
        <div class="col-md-5">Nome</div>
        <div class="col-md-2">Cpf</div>
        <div class="col-md-3">Data de Nascimento</div>
        <div class="col-md-1 text-center">Ações</div>
    </div>
    <hr class="espver6" />
    @foreach($corredores as $corredor)
    <div class="row justify-content-center align-middle">
        <div class="col-md-1">{{$corredor->id}}</div>
        <div class="col-md-5">{{$corredor->nome}}</div>
        <div class="col-md-2">{{$corredor->cpf}}</div>
        <div class="col-md-3">{{\Carbon\Carbon::parse($corredor->dt_nascimento)->format('d/m/Y')}}</div>
        <div class="col-md-1 text-center">
            <a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" value="{{$corredor->id}}" data-toggle="modal" data-target="#mccin" onclick="edit('{{$corredor->id}}','{{$corredor->nome}}','{{$corredor->cpf}}','{{\Carbon\Carbon::parse($corredor->dt_nascimento)->format('d/m/Y')}}')"><i class="fas fa-edit" style="cursor: pointer" title="Editar corredor"></i></a>&nbsp;&nbsp;
            <a class="text-center" style="margin-top: 0px; padding-top: 0px; font-size: 16px; align-self: baseline;" value="{{$corredor->id}}" data-toggle="modal" data-target="#mccex" onclick="del({{$corredor->id}})"><i class="fas fa-eraser" style="cursor: pointer" title="Excluir corredor"></i></a>&nbsp;&nbsp;
        </div>
    </div>
    <hr class="espver0" />
    @endforeach
    <div class="row justify-content-center align-middle">
        <div class="col-md-1"></div>
        <div class="col-md-9 text-center">{{$corredores->links()}}</div>
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
                    <p class="text-justify"><label>Nome&nbsp;&nbsp;</label><input class="form-control" type="text" name="nome" id="iid_nome" value="{{ old('nome') }}" title="Favor preencher corretamente o campo NOME" aria-label="NOME" required></p>
                    <p class="text-justify"><label>Cpf&nbsp;&nbsp;</label><input class="form-control" type="text" name="cpf" id="iid_cpf" value="{{ old('cpf') }}" pattern="^([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})$" title="Favor preencher corretamente o campo CPF" aria-label="Seu CPF" size="11" onblur="validaCPF(this.value)" required></p>
                    <p class="text-justify"><label>Data de Nascimento&nbsp;&nbsp;</label><input class="form-control" type="text" name="dt_nascimento" id="iid_dt_nascimento" value="" pattern="^([0-9]{2}[\/]?[0-9]{2}[\/]?[0-9]{4})$" title="Favor preencher corretamente o campo DATA DE NASCIMENTO" aria-label="DATA DE NASCIMENTO" onblur="calcula_idade()" required></p>
                    <input type="hidden" name="idade" id='id_idade' value=""><br>
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
    $("#iid_cpf").mask("000.000.000-00");
    $("#iid_dt_nascimento").mask("00/00/0000");
})
</script>

<script>
var delid;
var editid;
var operacao;

function calcula_idade() {
    var valor = $('#iid_dt_nascimento').val();
    var dt_javascript = valor; //21/07/1999

    icorredor = idade(dt_javascript.substr(6,4), dt_javascript.substr(3,2), dt_javascript.substr(0,2));

    $('#id_idade').val(icorredor);
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

function validaCPF(val)
{
    var element = $("#iid_cpf");
    if (val.length == 14) {
        var cpf = val.trim();

        cpf = cpf.replace(/[^\d]+/g,'');
        if (
            cpf == '00000000000' ||
            cpf == '11111111111' ||
            cpf == '22222222222' ||
            cpf == '33333333333' ||
            cpf == '44444444444' ||
            cpf == '55555555555' ||
            cpf == '66666666666' ||
            cpf == '77777777777' ||
            cpf == '88888888888' ||
            cpf == '99999999999'
        ) {
            element.val('');
            element.focus();
            return false;
        }
        cpf = cpf.split('');

        var v1 = 0;
        var v2 = 0;
        var aux = false;

        for (var i = 1; cpf.length > i; i++) {
            if (cpf[i - 1] != cpf[i]) {
                aux = true;
            }
        }

        if (aux == false) {
            element.val('');
            element.focus();
            return false;
        }

        for (var i = 0, p = 10; (cpf.length - 2) > i; i++, p--) {
            v1 += cpf[i] * p;
        }

        v1 = ((v1 * 10) % 11);

        if (v1 == 10) {
            v1 = 0;
        }

        if (v1 != cpf[9]) {
            element.val('');
            element.focus();
            return false;
        }

        for (var i = 0, p = 11; (cpf.length - 1) > i; i++, p--) {
            v2 += cpf[i] * p;
        }

        v2 = ((v2 * 10) % 11);

        if (v2 == 10) {
            v2 = 0;
        }

        if (v2 != cpf[10]) {
            element.val('');
            element.focus();
            return false;
        } else {
            return true;
        }
    } else if (val.length == 18) {
        var cnpj = val.trim();

        cnpj = cnpj.replace(/\./g, '');
        cnpj = cnpj.replace('-', '');
        cnpj = cnpj.replace('/', '');
        cnpj = cnpj.split('');

        var v1 = 0;
        var v2 = 0;
        var aux = false;

        for (var i = 1; cnpj.length > i; i++) {
            if (cnpj[i - 1] != cnpj[i]) {
                aux = true;
            }
        }

        if (aux == false) {
            element.val('');
            element.focus();
            return false;
        }

        for (var i = 0, p1 = 5, p2 = 13; (cnpj.length - 2) > i; i++, p1--, p2--) {
            if (p1 >= 2) {
                v1 += cnpj[i] * p1;
            } else {
                v1 += cnpj[i] * p2;
            }
        }

        v1 = (v1 % 11);

        if (v1 < 2) {
            v1 = 0;
        } else {
            v1 = (11 - v1);
        }

        if (v1 != cnpj[12]) {
            element.val('');
            element.focus();
            return false;
        }

        for (var i = 0, p1 = 6, p2 = 14; (cnpj.length - 1) > i; i++, p1--, p2--) {
            if (p1 >= 2) {
                v2 += cnpj[i] * p1;
            } else {
                v2 += cnpj[i] * p2;
            }
        }

        v2 = (v2 % 11);

        if (v2 < 2) {
            v2 = 0;
        } else {
            v2 = (11 - v2);
        }

        if (v2 != cnpj[13]) {
            element.val('');
            element.focus();
            return false;
        } else {
            return true;
        }
    } else {
        element.val('');
        element.focus();
        return false;
    }
}

function incluir() {
    operacao = 'inclusao';
}

function prosseguir_inclusao() {
    var nome = $('#iid_nome').val();
    var cpf = $('#iid_cpf').val();
    var dt_nascimento = $('#iid_dt_nascimento').val();
    var idade = $('#id_idade').val();
    if (nome == null || nome == '' || cpf == null || cpf == '' || dt_nascimento == null || dt_nascimento == '') {
        alert('Campo obrigatório');
    } else {
    if (idade < 18) {
        alert('O Corredor deve ter mais de 18 anos!');
    } else  {
    if (operacao == 'inclusao') {
        var baseUrl = getBaseUrl();
        var string = baseUrl.concat('/api/corredores/');
        var params = { '_token': '{{auth::user()->token}}', 'nome': nome, 'cpf': cpf, 'dt_nascimento': dt_nascimento};
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
        var string = baseUrl.concat('/api/corredores/',editid);
        var params = { '_token': '{{auth::user()->token}}', 'nome': nome, 'cpf': cpf, 'dt_nascimento': dt_nascimento};
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

function edit(id, nome, cpf, dt_nascimento) {
    operacao = 'alteracao';
    editid = id;
    $('#iid_nome').val(nome);
    $('#iid_cpf').val(cpf);
    $('#iid_dt_nascimento').val(dt_nascimento);
}

function del(id) {
    delid = id;
}

function prosseguir_exclusao() {
    var baseUrl = getBaseUrl();
    var string = baseUrl.concat('/api/corredores/',delid);
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
