<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    /**
     * ログイン認証を行うメソッド
     *
     * @param LoginRequest $request
     * @return stirng|false
     */
    public function userAuth($request): string|false
    {
        $user = User::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return false;
        }
        return $user->createToken('auth_token')->plainTextToken;
    }
}
