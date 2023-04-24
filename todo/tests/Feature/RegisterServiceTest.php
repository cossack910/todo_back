<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\RegisterService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_create()
    {
        // RegisterService インスタンスを生成
        $registerService = new RegisterService();

        // ダミーのリクエストデータを作成
        $request = new \stdClass();
        $request->username = 'testuser';
        $request->email = 'testuser@example.com';
        $request->password = 'password123';

        // userCreate メソッドを実行
        $user = $registerService->userCreate($request);

        // ユーザーが正しく登録されていることを確認
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('testuser', $user->username);
        $this->assertEquals('testuser@example.com', $user->email);
        $this->assertTrue(Hash::check('password123', $user->password));
    }
}
