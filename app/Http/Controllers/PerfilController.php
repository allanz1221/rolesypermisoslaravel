<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;

class PerfilController extends Controller
{

    public function index(){
        $perfil = Perfil::all();
        return view('perfil.index', compact('perfil'));
    }


    public function create(){
        return view('perfil.create');
    }

    public function edit(Perfil $perfil){
        $results = [];
        $array1 = $perfil->tags->pluck('name');
        foreach($array1 as $key => $arg){
            $results[] = $arg;
        }
        $tags = implode(',',$results);
        return view('perfil.edit', compact('perfil','tags'));
    }


    public function update(Request $request, $perfil){
        $perfil = Perfil::find($perfil);
        $perfil->update($request->all());
        $tags = explode(',', $request->tags);
        $perfil->syncTags($tags);
        return redirect()->route('perfil.index');
    }


    public function store(Request $request){
        $perfil = Perfil::create($request->all());
        $tags = explode(',',$request->tags);
        $perfil->attachTags($tags);
        return redirect()->route('perfil.index');
    }

    
}
