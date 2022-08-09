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
        
        return view('series.index', compact('series'));
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
        Serie::destroy($request->serie);
        
        return redirect()->route('series.index');

        // dd($request->serie); Consultar o ID da serie 
    }
}
