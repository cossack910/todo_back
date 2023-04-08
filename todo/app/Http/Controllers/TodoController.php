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
        return response()->json($tasks_model->all());
    }
}
