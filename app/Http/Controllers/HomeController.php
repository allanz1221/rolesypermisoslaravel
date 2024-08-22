<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Http\Requests\MaterialRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $term = $request->input('q');
        $materials = Material::where('name', 'LIKE', "%$term%")->get();
        
        return $materials->map(function($material) {
            return ['id' => $material->id, 'text' => $material->name];
        });
    }
}
