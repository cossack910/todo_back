<?php

namespace App\Const;

/**
 * 認証回周りの定数を定義したクラス
 */
class LoginConst
{
    const RESULTCODE_SUCCESS = 0;

    const RESULTCODE_FAILED  = 9;

    const MESSAGE_SUCCESS = "Login successful! Welcome back.";

    const MESSAGE_FAILED  = "Invalid username or password. Please try again.";
}
