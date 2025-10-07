<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_dueno' => 'required|string|max:100',
            'nombre_mascota' => 'required|string|max:100',
            'servicio' => 'required|string|max:50',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'motivo' => 'required|string|max:255',
           // 'telefono' => 'required|string|max:20',
           // 'correo' => 'required|email|max:100',
        ];
    }
}
