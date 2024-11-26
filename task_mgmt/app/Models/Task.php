<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'task_mgmt';
    protected $fillable =['user_id','title','description','due_date','priority','is_completed'];
    
    //A task belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }
}