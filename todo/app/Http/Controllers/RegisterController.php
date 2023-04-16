<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{Log, DB};
use App\Http\Request\RegisterRequest;
use App\Services\RegisterService;
use App\Http\Resources\RegisterResource;
use Exception;

class RegisterController extends Controller
{
    private $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function regist(RegisterRequest $request)
    {
        try {
            Log::info($request);
            //トランザクション開始
            DB::beginTransaction();
            //ユーザー登録
            $this->registerService->userCreate($request);
            //コミット
            DB::commit();
        } catch (Exception $e) {
            //ロールバック
            DB::rollBack();
            Log::alert("不正な値が入力されました。");
            // エラーレスポンスを返す
            return (new RegisterResource((object) ['status' => 'error']))->response()->setStatusCode(400);
        }
        return (new RegisterResource((object) ['status' => 'success']))->response()->setStatusCode(200);
    }
}
