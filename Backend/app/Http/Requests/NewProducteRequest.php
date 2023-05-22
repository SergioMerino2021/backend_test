<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
class NewProducteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'descripcion' => 'required|string',
            'codigo_producto' => 'required|string|unique:productes,codigo_producto',
            'activo' => 'required|boolean',

            'tipo_producto' => 'required|string|in:pc_sobremesa,portatil',
            'gaming' => 'nullable|boolean',
            'potencia_fuente' => 'nullable|integer',
            'capacidad_bateria' => 'nullable|integer',
            'amperaje_cargador' => 'nullable|integer',
        ];
    }
}
