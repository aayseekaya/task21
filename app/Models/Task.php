<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";
    protected  $primaryKey = 'id';
    protected $fillable = ['title',"description","status",'user_id'];
    
    public function assignedUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sortByStatus(Task $task){

    return Task::rderBy('status', 'asc')->get();
    }
    
}
