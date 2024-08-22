<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        // Cambia esto a true si deseas permitir que todos los usuarios realicen esta solicitud.
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplicarán a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'noserie' => 'nullable|string|max:255',
            'noactivo' => 'nullable|string|max:255',
            'numfactura' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'costo' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'ocupado' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer|min:0',
        ];
    }
}
