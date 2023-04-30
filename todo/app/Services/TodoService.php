<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TodoService
{
    /**
     * ユーザーのすべてのタスクを表示するメソッド
     *
     * @return void
     */
    public function showAllTask($requests)
    {
        $user_id = $this->getUserId($requests);
        return Task::where([
            ['user_id', '=', $user_id],
            ['completed', '=', 0],
        ])
            ->orderBy('due_date', 'asc')
            ->orderBy('priority', 'asc')
            ->get();
    }

    /**
     * ユーザーIDを取得するメソッド
     *
     * @return int|null
     */
    private function getUserId($requests): int|null
    {
        // 認証済みユーザーを取得
        return $requests->user()->id;
    }
}
