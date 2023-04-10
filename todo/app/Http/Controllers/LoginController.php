<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Models\User;
use App\Common\LoginUtil;
use App\Const\AuthConst;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $token = User::userAuth($request);
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
