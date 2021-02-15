<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCreateCorredoresProvasRequest;
use App\Models\CorredoresProvas;
use App\Models\Corredores;
use App\Models\Provas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CorredoresProvasController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function getAllCorredoresProvas()
    {
        $corredores = Corredores::all();
        $provas = Provas::all();
        $corredoresprovas = CorredoresProvas::paginate(20);
        return view('competicoes')
        ->with('corredores', $corredores)
        ->with('provas', $provas)
        ->with('corredoresprovas', $corredoresprovas);
    }
    /**
    * Display a resource.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function getCorredoresProvas(Request $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if (CorredoresProvas::where('id', $id)->exists()) {
                $corredoresprovas = CorredoresProvas::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
                return response($corredoresprovas, 200);
            } else {
                return response()->json(
                    "Corredor não existe"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Create a new resource in createCorredoresProvas.
    *
    * @param  \App\Http\Requests\UpdateCreateCorredoresProvasRequest $request
    * @return \Illuminate\Http\Response
    */
    public function createCorredoresProvas(UpdateCreateCorredoresProvasRequest $request) {
        if (User::where('token', $request->_token)->first()) {
            $ccount = DB::table('corredores_provas')->where('corredor_id', $request->corredor_id)->where('prova_id', $request->prova_id)->count();
            if ($ccount > 0) {
                return response()->json(
                    "Corredor já cadastrado na Prova"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
            $selcorredores = CorredoresProvas::where('corredor_id', $request->corredor_id)->get();
            foreach($selcorredores as $selcorredor) {
                $selprova = Provas::where('id', $request->prova_id)->first();
                if ($selcorredor->prova->data == $selprova->data) {
                return response()->json(
                    "Corredor não pode participar de mais de uma corrida na mesma data"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
                }
            }
            $corredoresprovas = new CorredoresProvas;
            $corredoresprovas->corredor_id = $request->corredor_id;
            $corredoresprovas->prova_id = $request->prova_id;
            $corredoresprovas->data = Carbon::createFromFormat('Y-m-d', $request->data);
            $corredoresprovas->grupo = $request->grupo;
            $corredoresprovas->save();

            return response()->json(
                "Corredor cadastrado na Prova com sucesso"
            , 201,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Update a resource in updateCorredoresProvas.
    *
    * @param  \App\Http\Requests\UpdateCreateCorredoresProvasRequest $request
    * @return \Illuminate\Http\Response
    */
    public function updateCorredoresProvas(UpdateCreateCorredoresProvasRequest $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if (CorredoresProvas::where('id', $id)->exists()) {
                $corredoresprovas = CorredoresProvas::find($id);
                $corredoresprovas->corredor_id = $request->corredor_id;
                $corredoresprovas->prova_id = $request->prova_id;
                $corredoresprovas->save();

                return response()->json(
                    "Registro alterado com sucesso"
                , 200,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(
                    "Registro não encontrado"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Update a resource in incluirResultadoCorredoresProvas.
    *
    * @param  \App\Http\Requests\UpdateCreateCorredoresProvasRequest $request
    * @return \Illuminate\Http\Response
    */
    public function incluirResultadoCorredoresProvas(Request $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if (CorredoresProvas::where('id', $id)->exists()) {
                $corredoresprovas = CorredoresProvas::find($id);
                $corredoresprovas->h_inicio = $request->h_inicio;
                $corredoresprovas->h_fim = $request->h_fim;

                $hini = Carbon::CreateFromTimeString($request->h_inicio, 'America/Sao_Paulo');
                $hfim  = Carbon::CreateFromTimeString($request->h_fim, 'America/Sao_Paulo');

                $corredoresprovas->tempo = gmdate("H:i:s", $hini->diffInSeconds($hfim));
                $corredoresprovas->save();
                return response()->json(
                    "Resultado lançado com sucesso"
                , 200,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(
                    "Registro não encontrado"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Delete a resource in deleteCorredoresProvas.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function deleteCorredoresProvas(Request $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if (CorredoresProvas::where('id', $id)->exists()) {
                $corredoresprovas = CorredoresProvas::find($id);
                $corredoresprovas->delete();

                return response()->json(
                    "Registro deletado"
                , 202,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(
                    "Registro não encontrado"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * List resources in listaResultadoGeral.
    *
    * @return \Illuminate\Http\Response
    */
    public function listaResultadoGeral(Request $request) {
        $listagrupada = [];
        $cl = 0;
        $lista = CorredoresProvas::whereNotNull('tempo')->first();
        $ld = $lista->data;
        $provas = Provas::get()->sortBy('data');
        foreach($provas as $prova) {
            $p = $prova->data;
            if($p <> $ld) {
                $cl = 0;
            }
            $listas = CorredoresProvas::whereNotNull('tempo')->where('prova_id', $prova->id)->get()->sortBy('tempo');
            foreach($listas as $lista) {
            $cl++;
            $ld = $lista->data;
            $lista->cl = $cl.'º Lugar';
            array_push($listagrupada,$lista);
            }
        }
        return view('resultados')
        ->with('listagrupada', $listagrupada);
    }
    /**
    * List resources in listaResultadoGeral.
    *
    * @return \Illuminate\Http\Response
    */
    public function listaResultadoIdade(Request $request) {
        $cl = 0;
        $lista = CorredoresProvas::whereNotNull('tempo')->first();
        $ld = $lista->grupo;
        $listas = CorredoresProvas::whereNotNull('tempo')->get()->sortBy(array('tempo','data','grupo'));

        foreach($listas as $lista) {
            $p = $lista->grupo;
            if($p <> $ld) {
                $cl = 0;
            }
        $cl++;
        $ld = $lista->grupo;
        $lista->cl = $cl.'º Lugar';
        }
        return view('resultadosporidade')
        ->with('listagrupada', $listas);
    }

}
