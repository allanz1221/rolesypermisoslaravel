<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Material;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{

    private $validStates = ['Pendiente', 'Aprobado', 'Vigente', 'Vencido', 'Concluido', 'Rechazado', 'Cancelado'];

    public function changeStatus(HttpRequest $httpRequest, Request $request, $newStatus)
    {
        // Verificar si el nuevo estado es válido
        if (!in_array($newStatus, $this->validStates)) {
            return redirect()->back()->with('error', 'Estado no válido.');
        }

        // Verificar si el usuario tiene permiso para cambiar el estado
        if (!Auth::user()->hasPermissionToChangeStatus($newStatus)) {
            return redirect()->back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $request->update([
            'status' => $newStatus,
            'last_modified_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', "La solicitud ha sido cambiada a estado: {$newStatus}.");
    }

    public function index()
    {
        $user = Auth::user();
        if($user->rol == "Admin" || $user->rol == "Laboratorio"){
            $requests = Request::orderBy('created_at', 'desc')->get();
        } else {
            $requests = Request::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }
        return view('requests.index', compact('requests'));
    }


    public function create()
{
    $requests = Request::all();
    $materials = Material::all();
    return view('requests.create', compact('materials','requests'));
}

    public function edit(Request $requests)
    {
        return view('requests.edit', compact('requests'));
    }

    public function actualiza(Request $requests,$id)
    {
        $requests = Request::get($id);
        
        return view('requests.edit', compact('requests'));
    }

public function store(HttpRequest $request)
{
    $validated = $request->validate([
        'materials' => 'required|array',
        'materials.*.id' => 'required|exists:materials,id',
        'materials.*.quantity' => 'required|integer|min:1',
    ]);

    $requestModel = Request::create([
        'user_id' => Auth::id(),
        'status' => 'Pendiente',
        'materia' => $request->materia,
    ]);

    foreach ($validated['materials'] as $material) {
        $requestModel->materials()->attach($material['id'], ['quantity' => $material['quantity']]);
    }

    return redirect()->route('requests.index')->with('success', 'Solicitud creada con éxito');
}

}