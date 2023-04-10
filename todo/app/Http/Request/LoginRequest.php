<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:5| max:15',
            'password' => 'required|string|min:8',
        ];
    }
}
