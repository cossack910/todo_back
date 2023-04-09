<?php

namespace App\Common;

use Illuminate\Support\Facades\Facade;

class Util extends Facade
{
    /**
     * ユーザー認証周りのjson返却クラス
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
