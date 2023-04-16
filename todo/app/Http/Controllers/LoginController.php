<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Request\LoginRequest;
use App\Services\LoginService;
use App\Http\Resources\LoginResource;
use Exception;

class LoginController extends Controller
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        try {
            //ユーザー認証
            $token = $this->loginService->userAuth($request);
            if (!$token) {
                throw new Exception("ログイン認証失敗");
            }
        } catch (Exception $e) {
            //ログイン認証失敗
            Log::info($e);
            return (new LoginResource((object) ['status' => 'error']))->response()->setStatusCode(400);
        }
        Log::info("ログイン認証成功");
        return (new LoginResource((object) ['status' => 'success', 'token' => $token]))->response()->setStatusCode(200);
    }
}
