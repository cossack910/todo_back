<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\LoginService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    use RefreshDatabase;

    protected LoginService $loginService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loginService = new LoginService();
    }

    public function testUserAuthSuccessful()
    {
        $user = User::create([
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => Hash::make('testpassword'),
        ]);

        $token = $this->loginService->userAuth((object)[
            'username' => 'testuser',
            'password' => 'testpassword',
        ]);

        $this->assertIsString($token);
    }

    public function testUserAuthFailure()
    {
        $user = User::create([
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => Hash::make('testpassword'),
        ]);

        $result = $this->loginService->userAuth((object)[
            'username' => 'testuser',
            'password' => 'wrongpassword',
        ]);

        $this->assertFalse($result);
    }
}
