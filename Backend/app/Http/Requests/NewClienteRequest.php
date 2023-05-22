<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewClienteRequest extends FormRequest
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
            'nom' => 'required|max:50',
            'cognoms' => 'required|max:150',
            'email' => 'required|max:100|email',
            'telefon' => 'required|regex:/^[0-9]{9}$/'
        ];
    }
}
