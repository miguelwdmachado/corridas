<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCreateProvaRequest;
use App\Models\TipoProva;
use App\Models\Provas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProvasController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function getAllProvas()
    {
        $tiposprova = TipoProva::all();
        $provas = Provas::paginate(20);
        return view('corridas')
        ->with('tiposprova', $tiposprova)
        ->with('provas', $provas);
    }
    /**
    * Display a resource.
    *
    * @param \Illuminate\Http\Response
    * @return \Illuminate\Http\Response
    */
    public function getProvas(Request $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if (Provas::where('id', $id)->exists()) {
                $corredor = Provas::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
                return response($corredor, 200);
            } else {
                return response()->json(
                    "Prova não existe"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Create a new resource in createProvas.
    *
    * @param  \App\Http\Requests\UpdateCreateProvaRequest $request
    * @return \Illuminate\Http\Response
    */
    public function createProvas(UpdateCreateProvaRequest $request) {
        if (User::where('token', $request->_token)->first()) {
            $ccount = DB::table('provas')->where('tipo_prova_id', $request->tipo_prova_id)->where('data', Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d'))->count();
            if ($ccount > 0) {
                return response()->json(
                    "Prova já existe"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
            $corredor = new Provas;
            $corredor->tipo_prova_id = $request->tipo_prova_id;
            $corredor->data = Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d');
            $corredor->save();

            return response()->json(
                "Prova criado"
            , 201,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Update a resource in updateProvas.
    *
    * @param  \App\Http\Requests\UpdateCreateProvaRequest $request
    * @return \Illuminate\Http\Response
    */
    public function updateProvas(UpdateCreateProvaRequest $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if (Provas::where('id', $id)->exists()) {
                $corredor = Provas::find($id);
                $corredor->tipo_prova_id = $request->tipo_prova_id;
                $corredor->data = Carbon::createFromFormat('d/m/Y', $request->data)->format('Y-m-d');
                $corredor->save();

                return response()->json(
                    "Registro alterado com sucesso"
                , 200,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(
                    "Prova não encontrada"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
    * Delete a resource in deleteProvas.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function deleteProvas (Request $request, $id) {
        if (User::where('token', $request->_token)->first()) {
            if(Provas::where('id', $id)->exists()) {
                $corredor = Provas::find($id);
                $corredor->delete();

                return response()->json(
                    "Registro deletado"
                , 202,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            } else {
                return response()->json(
                    "Prova não encontrada"
                , 404,['Content-type'=>'application/json;charset=utf-8'],JSON_UNESCAPED_UNICODE);
            }
        }
    }

}
