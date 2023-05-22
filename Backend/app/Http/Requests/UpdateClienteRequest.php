<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:clients,id|numeric',
            'nom' => 'required|max:50',
            'cognoms' => 'required|max:150',
            'email' => 'required|max:100|email',
            'telefon' => 'required|regex:/^[0-9]{9}$/'
        ];
    }
}
