<?php

namespace App\Common;

class RegisterUtil
{
    /**
     * ユーザー登録のjson返却メソッド
     *
     * @param integer $resultcode
     * @param string $message
     * @return array
     */
    public static function retJsonArr(int $resultcode, string $message): array
    {
        return array(
            "resultcode" => $resultcode,
            "message" => $message
        );
    }
}
