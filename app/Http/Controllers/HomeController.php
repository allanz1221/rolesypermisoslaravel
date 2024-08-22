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
  $sections = [
            ['title' => 'Manuales', 'description' => 'Accede a manuales y guías.', 'link' => route('manuales')],
            ['title' => 'Tutorías', 'description' => 'Encuentra tutorías disponibles.', 'link' => route('tutorias')],
            ['title' => 'PASA', 'description' => 'Información sobre PASA.', 'link' => route('pasa')],
            ['title' => 'Egresados', 'description' => 'Recursos para egresados.', 'link' => route('egresados')],
            ['title' => 'Impresoras 3D', 'description' => 'Accede a recursos de impresión 3D.', 'link' => route('impresoras3d')],
            ['title' => 'Horarios', 'description' => 'Consulta los horarios.', 'link' => route('horarios')],
            ['title' => 'Servicio Social', 'description' => 'Información sobre el servicio social.', 'link' => route('servicio-social')],
            ['title' => 'Prácticas Profesionales', 'description' => 'Recursos para prácticas profesionales.', 'link' => route('practicas-profesionales')],
            ['title' => 'Notas', 'description' => 'Consulta las notas.', 'link' => route('notas')],
            ['title' => 'Prácticas de Campo', 'description' => 'Recursos para prácticas de campo.', 'link' => route('practicas-de-campo')],
            ['title' => 'Mercado Libre', 'description' => 'Accede a recursos de Mercado Libre.', 'link' => route('mercado-libre')],
            ['title' => 'Solicitudes de Material de Laboratorio', 'description' => 'Solicita materiales de laboratorio.', 'link' => route('requests.index')],
        ];
        return view('index', compact('sections'));
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
