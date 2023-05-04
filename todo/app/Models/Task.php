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
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'priority',
        'due_date',
        'completed',
        'created_at',
        'updated_at'
    ];
}
