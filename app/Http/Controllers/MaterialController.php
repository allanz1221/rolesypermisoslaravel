<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Requests\MaterialRequest;
use Illuminate\Http\Request; // Asegúrate de tener esta línea
use Illuminate\Support\Facades\Auth; // También esta línea para el manejo de autenticación

/**
 * Class MaterialController
 * @package App\Http\Controllers
 */
class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */

 public function __construct()
    {
        // Aplica la verificación de rol a todas las rutas
        $this->middleware(function ($request, $next) {
            if (!in_array(Auth::user()->rol, ['Admin', 'Laboratorio'])) {
                return redirect()->route('home')->with('error', 'No tienes permiso para acceder a esta sección.');
            }
            return $next($request);
        });
    }

    
    public function index()
    {
        $materials = Material::all();

        return view('material.index', compact('materials'))
            ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $material = new Material();
        return view('material.create', compact('material'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialRequest $request)
    {
        Material::create($request->validated());

        return redirect()->route('materials.index')
            ->with('success', 'Material created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $material = Material::find($id);

        return view('material.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $material = Material::find($id);

        return view('material.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialRequest $request, Material $material)
    {
        $material->update($request->validated());

        return redirect()->route('materials.index')
            ->with('success', 'Material updated successfully');
    }

    public function destroy($id)
    {
        Material::find($id)->delete();

        return redirect()->route('materials.index')
            ->with('success', 'Material deleted successfully');
    }


}
