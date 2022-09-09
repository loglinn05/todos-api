<?php

namespace App\Models;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    public function todoList()
    {
        return $this->belongsTo(TodoList::class);
    }
}
