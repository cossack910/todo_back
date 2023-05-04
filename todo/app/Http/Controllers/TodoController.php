<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Resources\TodoShowResource;
use App\Http\Resources\TodoCreateResource;
use App\Http\Request\TodoCreateRequest;

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
        return (new TodoShowResource((object) ['status' => 'success', 'tasks' => $tasks]))->response()->setStatusCode(200);
    }

    public function create(TodoCreateRequest $requests)
    {
        try {
            $task = $this->todoService->createTask($requests);
            return (new TodoCreateResource((object) ['status' => 'success', 'task' => $task]))->response()->setStatusCode(200);
        } catch (\Exception $e) {
            Log::info($e);
            return (new TodoCreateResource((object) ['status' => 'error']))->response()->setStatusCode(400);
        }
    }

    public function delete()
    {
    }

    public function edit()
    {
    }
}
