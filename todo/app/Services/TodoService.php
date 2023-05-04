<?php

namespace App\Services;

use App\Models\Task;

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
     * タスクを作製するメソッド
     * 
     * @return array
     */
    public function createTask($requests)
    {
        $user_id = $this->getUserId($requests);
        return Task::create([
            'user_id' => $user_id,
            'title' => $requests->title,
            'description' => $requests->description,
            'category' => $requests->category,
            'priority' => $requests->priority,
            'due_date' => $requests->due_date,
            'completed' => false
        ]);
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
