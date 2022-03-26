<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        return Todo::latest()->get();
    }

    public function create(Request $request)
    {
        $todo = new Todo();
        $todo->text = $request->get('todoText');
        $todo->save();
    }

    public function delete(Request $request)
    {
        $removedTodoId = $request->get('removedTodoId');
        $todo = Todo::find($removedTodoId);
        $todo->delete();
    }

    public function markAsDone(Request $request)
    {
        $todoId = $request->get('todoId');
        $todo = Todo::find($todoId);
        $todo->done = true;
        $todo->update();
    }

    public function markAsUndone(Request $request)
    {
        $todoId = $request->get('todoId');
        $todo = Todo::find($todoId);
        $todo->done = false;
        $todo->update();
    }

    public function edit(Request $request)
    {
        $todoId = $request->get('todoId');
        $todo = Todo::find($todoId);
        $todo->text = $request->get('todoText');
        $todo->update();
    }
}
