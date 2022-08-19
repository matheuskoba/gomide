<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SearchRequest; 

class NotasController extends Controller
{
    public function index(Request $request)
    {
        $mY = $request->month;
        \Log::info($mY);
        $mes_ano = date('m/Y', strtotime($mY));

        if ($mY !== null) 
        {
        $notas = DB::table('notas')
            ->where('mes_ano', $mes_ano)
            ->orderBy('mes_ano', 'DESC')
            ->get();

        } else 
        {
        $notas = DB::table('notas')
            ->where('mes_ano',date('m/Y'))
            ->orderBy('mes_ano', 'DESC')
            ->get();
        }

        return view('notas',compact('notas'));
    }

    public function search(SearchRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = $request->all();
            
            $notas = DB::table('notas')
            ->where('UF', $data['pesquisa'])
            ->orWhere('emitente', 'LIKE', '%'.$data['pesquisa'].'%')
            ->orWhere('serie', $data['pesquisa'])
            ->orWhere('n', $data['pesquisa'])
            ->orWhere('valor', $data['pesquisa'])
            ->orWhere('emissao', $data['pesquisa'])
            ->orderBy('mes_ano', 'DESC')
            ->get();

            return view('notas',compact('notas'));
        }
    }
}
