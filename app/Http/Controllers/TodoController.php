<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    private $activeTodoListId = 0;

    public function __construct()
    {
        $activeTodoList = TodoList::select('id')->where('active', 1)->first();
        if ($activeTodoList) {
            $this->activeTodoListId = TodoList::select('id')->where('active', 1)->first()->id;
        }
    }

    public function index(Request $request)
    {
        try {
            $todos = [];
            if ($this->activeTodoListId) {
                $todos = Todo::where('todo_list_id', $this->activeTodoListId)->latest()->get();
            }
            return [$this->activeTodoListId, $todos];
        } catch (e) {
            Log::error(e);
        }
    }

    public function create(Request $request)
    {
        try {
            $todo = new Todo();
            $todo->text = $request->get('todoText');
            $todo->todo_list_id = $this->activeTodoListId;
            $todo->save();
        } catch (e) {
            Log::error(e);
        }
    }

    public function delete(Request $request)
    {
        try {
            $removedTodoId = $request->get('removedTodoId');
            $todo = Todo::find($removedTodoId);
            $todo->delete();
        } catch (e) {
            Log::error(e);
        }
    }

    public function markAsDone(Request $request)
    {
        try {
            $todoId = $request->get('todoId');
            $todo = Todo::find($todoId);
            $todo->done = true;
            $todo->update();
        } catch (e) {
            Log::error(e);
        }
    }

    public function markAsUndone(Request $request)
    {
        try {
            $todoId = $request->get('todoId');
            $todo = Todo::find($todoId);
            $todo->done = false;
            $todo->update();
        } catch (e) {
            Log::error(e);
        }
    }

    public function edit(Request $request)
    {
        try {
            $todoId = $request->get('todoId');
            $todo = Todo::find($todoId);
            $todo->text = $request->get('todoText');
            $todo->update();
        } catch (e) {
            Log::error(e);
        }

    }
}
