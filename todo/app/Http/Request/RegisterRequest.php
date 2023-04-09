<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:5| max:15',
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ];
    }
}
