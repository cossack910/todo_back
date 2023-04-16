<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    /**
     * ユーザー登録を行うメソッド
     *
     * @param RegisterRequest $request
     * @return void
     */
    public function userCreate($request)
    {
        return User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
