<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\Request;
use App\Http\Resources\TodoShowResource;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    private $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function show(Request $requests)
    {
        $tasks = $this->todoService->showAllTask($requests);
        Log::info($tasks);
        return (new TodoShowResource((object) ['status' => 'success', 'tasks' => $tasks]))->response()->setStatusCode(200);
    }
}
