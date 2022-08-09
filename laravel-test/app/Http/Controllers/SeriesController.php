<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request) 
    {
        
        $series = Serie::query()->orderBy('nome')->get();
       
        $mensagemSucesso = session('mensagem.sucesso'); 
            
        return view('series.index')->with('series', $series)
        ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create (Request $request) 
    {
        return view ('series.create');
        
    }

    public function store(Request $request)
    {
        
        $serie = Serie::create($request->all());        
        $request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
        return redirect()->route('series.index');   

    }

    public function destroy (Serie $series, Request $request) 
    {
        
        $series->delete();
        $request->session()->flash('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
        
        return redirect()->route('series.index');

        // dd($request->serie); Consultar o ID da serie 
    }
}
