<?php

namespace App\Http\Controllers;

use App\Services\TodoService;
use Illuminate\Http\Request;
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
        $res = $this->todoService->showAllTask($requests);
        return response()->json($res);
    }
}
