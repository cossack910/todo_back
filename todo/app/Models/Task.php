<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    //use HasFactory;
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $user_id = 'user_id';
    protected $title = 'title'; //値はカラム名
    protected $description = 'description';
    protected $category = 'category';
    protected $priority = 'priority';
    protected $due_date = 'due_date';
    protected $completed = 'completed';
    protected $created_at = 'created_at';
    protected $updated_at = 'updated_at';
}
