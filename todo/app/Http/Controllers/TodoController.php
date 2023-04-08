<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    //
    public function show()
    {
        $tasks_model = new Task();
        $tasks = $tasks_model->all();
        return response()->json($tasks);
    }
}
