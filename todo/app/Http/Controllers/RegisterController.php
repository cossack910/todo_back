<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\User;
use App\Common\Util;
use App\Const\AuthConst;


class RegisterController extends Controller
{
    public function regist(Request $request)
    {
        try {
            //トランザクション開始
            DB::beginTransaction();

            $request->validate([
                'username' => 'required|string|min:5|max:15',
                'email' => 'required|email',
                'password' => 'required|string|min:8'
            ]);

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Log::info("入力されたユーザー情報");
            Log::info($user);

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
