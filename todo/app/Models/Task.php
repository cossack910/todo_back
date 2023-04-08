<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    //use HasFactory;
    protected $table = 'task';
    protected $primaryKey = 'id';
    protected $title = 'title'; //値はカラム名
    protected $is_done = 'is_done';
    protected $created_at = 'created_at';
    protected $updated_at = 'updated_at';
}
