<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Request\LoginRequest;
use App\Models\User;
use App\Common\LoginUtil;
use App\Const\AuthConst;
use Exception;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $token = User::userAuth($request);
            if (null === $token) {
                throw new Exception("ログイン認証失敗");
            }
            Log::info("ログイン認証成功");
        } catch (Exception $e) {
            Log::info($e);
            return response()->json(
                LoginUtil::retJsonArr(
                    AuthConst::RESULTCODE_FAILED,
                    AuthConst::MESSAGE_FAILED,
                    ""
                ),
                400
            );
        }

        return response()->json(
            LoginUtil::retJsonArr(
                AuthConst::RESULTCODE_SUCCESS,
                AuthConst::MESSAGE_SUCCESS,
                $token
            ),
            201
        );
    }
}
