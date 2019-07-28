<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($estado_id)
    {
        $cidades = Cidade::where('estado_id','=',$estado_id)->get();
        return Response::json($cidades);
    }
}
