<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Request\RegisterRequest;
use App\Models\User;
use App\Common\Util;
use App\Const\AuthConst;
use Exception;



class RegisterController extends Controller
{

    public function regist(RegisterRequest $request)

    {
        try {
            //トランザクション開始
            DB::beginTransaction();

            $user_info = User::userCreate($request);
            Log::info("入力されたユーザー情報");
            Log::info($user_info);

            //コミット
            DB::commit();
        } catch (Exception $e) {
            //ロールバック
            DB::rollBack();
            Log::alert("不正な値が入力されました。");
            // エラーレスポンスを返す
            return response()->json(
                Util::retJsonArr(
                    AuthConst::RESULTCODE_FAILED,
                    AuthConst::MESSAGE_FAILED
                ),
                400
            );
        }

        return response()->json(
            Util::retJsonArr(
                AuthConst::RESULTCODE_SUCCESS,
                AuthConst::MESSAGE_SUCCESS
            ),
            201
        );
    }
}
