<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCreateCorredoresRequest;
use App\Models\Corredores;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CorredoresController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function getAllCorredores()
    {
        $corredores = Corredores::paginate(20);
        return view('corredores')
        ->with('corredores', $corredores);
    }
    /**
    * Display a resource.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function getCorredores(Request $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if (Corredores::where('id', $id)->exists()) {
                $corredor = Corredores::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
                return response($corredor, 200);
            } else {
                return response()->json(
                    "Corredor não existe"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Create a new resource in createCorredores.
    *
    * @param  \App\Http\Requests\UpdateCreateCorredoresRequest $request
    * @return \Illuminate\Http\Response
    */
    public function createCorredores(Request $request) {
        if (User::where('token', $request->_token)->first()) {
            $ccount = DB::table('corredores')->where('nome', mb_strtoupper($request->nome, 'UTF-8'))->where('cpf', $request->cpf)->count();
            if ($ccount > 0) {
                return response()->json(
                    "Corredor já existe"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
            $corredor = new Corredores;
            $corredor->nome = mb_strtoupper($request->nome, 'UTF-8');
            $corredor->cpf = $request->cpf;
            $corredor->dt_nascimento = Carbon::createFromFormat('d/m/Y', $request->dt_nascimento)->format('Y-m-d');
            $corredor->save();

            return response()->json(
                "Corredor criado"
            , 201,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Update a resource in updateCorredores.
    *
    * @param  \App\Http\Requests\UpdateCreateCorredoresRequest $request
    * @return \Illuminate\Http\Response
    */
    public function updateCorredores(Request $request, $id) {
        if (User::where('token', $request->_token)->first() and $request->nome) {
            if (Corredores::where('id', $id)->exists()) {
                $corredor = Corredores::find($id);
                $corredor->nome = mb_strtoupper($request->nome, 'UTF-8');
                $corredor->cpf = $request->cpf;
                $corredor->dt_nascimento = Carbon::createFromFormat('d/m/Y', $request->dt_nascimento)->format('Y-m-d');
                $corredor->save();

                return response()->json(
                    "Registro alterado com sucesso"
                , 200,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(
                    "Corredor não encontrado"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Delete a resource in deleteCorredores.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function deleteCorredores (Request $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if(Corredores::where('id', $id)->exists()) {
                $corredor = Corredores::find($id);
                $corredor->delete();

                return response()->json(
                    "Registro deletado"
                , 202,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(
                    "Corredor não encontrado"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
