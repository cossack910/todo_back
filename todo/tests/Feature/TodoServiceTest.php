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

    /**
     * Test createTask method.
     *
     * @return void
     */
    public function testCreateTask($request)
    {
        // テストユーザーを作成
        $user = User::factory()->create();

        // リクエストインスタンスを作成し、ユーザーを認証状態にする
        $request = new Request();
        $request->setUserResolver(fn () => $user);

        $todoService = new TodoService();
        $task = $todoService->createTask($request);

        // 作成されたタスクがデータベースに存在し、期待される属性を持っていることを確認します。
        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id,
            'title' => 'test',
            'description' => 'テスト用のタスクなんでもいい',
            'category' => 'テスト',
            'priority' => 1,
            'due_date' => '2023-07-07',
            'completed' => 0,
        ]);

        // タスクオブジェクトが期待される属性を持っていることを確認します。
        $this->assertEquals($user->id, $task->user_id);
        $this->assertEquals('test', $task->title);
        $this->assertEquals('テスト用のタスクなんでもいい', $task->description);
        $this->assertEquals('テスト', $task->category);
        $this->assertEquals(1, $task->priority);
        $this->assertEquals('2023-07-07', $task->due_date);
        $this->assertEquals(0, $task->completed);
    }
}
