<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Iluminate\Routing\Route;//PARA VALIDADR UNIQUE MENOS EL REGISTRO A VERIFICAR
use Iluminate\Http\Requests\Request;//PARA VALIDADR UNIQUE MENOS EL REGISTRO A VERIFICAR

class UserUpdateRequest extends FormRequest
{
    public function _construc(Route $route){
        $this->route=$route;//TRaE EL ID DEL REGISTRO
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->route('user'),
            'password' => 'nullable|string|min:6',
            'direccion'=>'required',
            'telefono'=>'nullable|numeric',
            'pais_id'=>'required',
            'departamento_id'=>'required',
            'municipio_id'=>'required',
        ];
    }
}
