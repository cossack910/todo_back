<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogoutService
{
    /**
     * ログアウトを行うメソッド
     *
     * @param Request $request
     * @return boolean
     */
    public function logout($request): bool
    {
        // トークン情報を削除して無効化
        return $request->user()->currentAccessToken()->delete();
    }
}
