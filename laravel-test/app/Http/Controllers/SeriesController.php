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
        $mensagemSucesso = $request->session()->get('mensagem.sucesso'); 
        // $request->session()->forget('mensagem.sucesso'); Desnecessário pois estou usando o FLASH em vez do PUT
        
        return view('series.index')->with('series', $series)
        ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create () 
    {
        return view ('series.create');
    }

    public function store(Request $request)
    {
        
        Serie::create($request->all());
       
        return redirect()->route('series.index');   

    }

    public function destroy (Request $request) 
    {
        
        Serie::destroy($request->series);
        $request->session()->flash('mensagem.sucesso', 'Série removida com sucesso');
        
        return redirect()->route('series.index');

        // dd($request->serie); Consultar o ID da serie 
    }
}
