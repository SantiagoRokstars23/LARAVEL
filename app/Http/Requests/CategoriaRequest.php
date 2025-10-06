<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        'nombre' => 'required|max:255',
        'descripcion' => 'nullable',
        'status' => 'required|boolean',
        ];
    }

     public function messages(): array
  {
    return [
        'nombre.required' => 'El nombre es obligatorio.',
       
        'status.required' => 'Debe seleccionar un estado.',
    ];
   }
}
