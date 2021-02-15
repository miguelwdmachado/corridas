<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCreateTipoProvaRequest;
use App\Models\TipoProva;
use Illuminate\Http\Request;

class TipoProvaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function getAllTipoProva()
    {
        $tiposprova = TipoProva::paginate(20);
        return view('tipocorrida')
        ->with('tipo_provas', $tiposprova);
    }
    /**
    * Display a resource.
    *
    * @param \Illuminate\Http\Response
    * @return \Illuminate\Http\Response
    */
    public function getTipoProva(Request $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if (TipoProva::where('id', $id)->exists()) {
                $tipoprova = TipoProva::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
                return response($tipoprova, 200);
            } else {
                return response()->json(
                    "Tipo de Prova não existe"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Create a new resource in createTipoProva.
    *
    * @param  \App\Http\Requests\UpdateCreateTipoProvaRequest $request
    * @return \Illuminate\Http\Response
    */
    public function createTipoProva(UpdateCreateTipoProvaRequest $request) {
        if (User::where('token', $request->_token)->first()) {
            $tipoprova = new TipoProva;
            $tipoprova->tipo = $request->tipo;
            $tipoprova->save();

            return response()->json(
                "Tipo de Prova criado"
            , 201,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
        }
    }
    /**
    * Update a resource in updateTipoProva.
    *
    * @param  \App\Http\Requests\UpdateCreateTipoProvaRequest $request
    * @return \Illuminate\Http\Response
    */
    public function updateTipoProva(UpdateCreateTipoProvaRequest $request, $id) {
        if (User::where('token', $request->_token)->first() and $request->tipo) {
            if (TipoProva::where('id', $id)->exists()) {
                $tipoprova = TipoProva::find($id);
                $tipoprova->tipo = $request->tipo;
                $tipoprova->save();

                return response()->json(
                    "Registro alterado com sucesso"
                , 200,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(
                    "Tipo de Prova não encontrado"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Delete a resource in deleteTipoProva.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function deleteTipoProva (Request $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if(TipoProva::where('id', $id)->exists()) {
                $tipoprova = TipoProva::find($id);
                $tipoprova->delete();

                return response()->json(
                    "Registro deletado"
                , 202,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(
                    "Tipo de Prova não encontrado"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
