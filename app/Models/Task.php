<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    const TODO="TODO";
    const DOING="DOING";
    const DONE="DONE";

    protected $table = "tasks";
    protected  $primaryKey = 'id';
    protected $fillable = ['title',"description","status",'user_id'];
    
    public function assignedUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sortByStatus(){
        $tasks=Task::orderBy("title")->get();
        $order = array( 'DOING','TODO', 'DONE');
            
        $edit = $tasks->sort(function ($a, $b) use ($order) {
            $pos_a = array_search($a->status, $order);
            $pos_b = array_search($b->status, $order);
            return $pos_a - $pos_b;
          });

        return $edit ;
    }


 
}
