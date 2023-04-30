<?php

namespace Tests\Feature;

use App\Services\TodoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use Tests\TestCase;

class TodoServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $todoService;

    public function setUp(): void
    {
        parent::setUp();
        $this->todoService = new TodoService();
    }

    /** @test */
    public function show_all_tasks_for_authenticated_user()
    {
        // テストユーザーを作成
        $user = User::factory()->create();

        // テストタスクを作成
        $tasks = Task::factory()->count(5)->create([
            'user_id' => $user->id,
            'completed' => 0,
        ]);

        // リクエストインスタンスを作成し、ユーザーを認証状態にする
        $request = new Request();
        $request->setUserResolver(fn () => $user);

        // showAllTask メソッドを実行し、タスクを取得
        $fetchedTasks = $this->todoService->showAllTask($request);

        // 取得したタスクがユーザーのものであることを確認
        $this->assertCount(5, $fetchedTasks);
        $fetchedTasks->each(function ($task) use ($user) {
            $this->assertEquals($user->id, $task->user_id);
        });
    }
}
