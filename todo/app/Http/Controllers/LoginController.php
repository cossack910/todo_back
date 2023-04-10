<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Request\LoginRequest;
use App\Models\User;
use App\Common\LoginUtil;
use App\Const\LoginConst;
use Exception;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            //ユーザー認証
            $token = User::userAuth($request);
            if ("failed" === $token) {
                throw new Exception("ログイン認証失敗");
            }
        } catch (Exception $e) {
            //ログイン認証失敗
            Log::info($e);
            return response()->json(
                LoginUtil::LoginFailedRetJsonArr(
                    LoginConst::RESULTCODE_FAILED,
                    LoginConst::MESSAGE_FAILED
                ),
                400
            );
        }

        Log::info("ログイン認証成功");
        return response()->json(
            LoginUtil::LoginSuccessRetJsonArr(
                LoginConst::RESULTCODE_SUCCESS,
                LoginConst::MESSAGE_SUCCESS,
                $token
            ),
            201
        );
    }
}
