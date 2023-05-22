<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProducteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:productes,id',
            'descripcion' => 'required|string',
            'codigo_producto' => 'required|string',
            'activo' => 'required|boolean',

            'tipo_producto' => 'required|string|in:pc_sobremesa,portatil',
            'gaming' => 'nullable|boolean',
            'potencia_fuente' => 'nullable|integer',
            'capacidad_bateria' => 'nullable|integer',
            'amperaje_cargador' => 'nullable|integer',
        ];
    }
}
