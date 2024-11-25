<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Specify the table name if it's not 'tasks' (default is plural of model name)
    protected $table = 'task_mgmt';

    // Define which attributes are mass-assignable
    protected $fillable = [
        'description', 'due_date', 'priority', 'user_id', 'completed'
    ];
}
