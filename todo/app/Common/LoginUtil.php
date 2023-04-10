<?php

namespace App\Common;

class LoginUtil
{
    /**
     * ログイン認証成功時のjson返却メソッド
     *
     * @param integer $resultcode
     * @param string $message
     * @param stirng $token
     * 
     * @return array
     */
    public static function LoginSuccessRetJsonArr(int $resultcode, string $message, string $token): array
    {
        return array(
            "resultcode" => $resultcode,
            "message" => $message,
            "token" => $token
        );
    }

    /**
     * ログイン認証失敗時のjson返却メソッド
     *
     * @param integer $resultcode
     * @param string $message
     * 
     * @return array
     */
    public static function LoginFailedRetJsonArr(int $resultcode, string $message): array
    {
        return array(
            "resultcode" => $resultcode,
            "message" => $message
        );
    }
}
