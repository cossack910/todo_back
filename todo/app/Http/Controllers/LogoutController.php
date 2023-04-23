<?php

namespace App\Http\Controllers;

use  App\Http\Request\LogoutRequest;
use  App\Services\LogoutService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{

    private $logoutService;

    public function __construct(LogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    /**
     * ログアウト
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        $res = $this->logoutService->logout($request);
        if ($res) {
            return response()->json(['message' => 'Logout successful'], 200);
        }
    }
}
