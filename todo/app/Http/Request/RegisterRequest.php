<?php

namespace App\Http\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|min:5| max:15',
            'email'    => 'required|email',
            'password' => 'required|string|min:8',
        ];
    }

    //カスタムレスポンス
    // protected function failedValidation(Validator $validator)
    // {
    //     $response = new JsonResponse([
    //         'status' => 'error',
    //         'message' => 'Validation failed',
    //         'errors' => $validator->errors()
    //     ], 422);

    //     throw new HttpResponseException($response);
    // }
}
