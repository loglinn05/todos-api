<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoListController extends Controller
{
    public function index(Request $request)
    {
        try {
            return TodoList::latest()->get();
        } catch (e) {
            Log::error(e);
        }
    }

    public function create(Request $request)
    {
        try {
            $todoList = new TodoList();
            $todoList->name = $request->get('todoListName');
            $todoList->save();
        } catch (e) {
            Log::error(e);
        }
    }

    public function delete(Request $request)
    {
        try {
            $removedTodoListId = $request->get('removedTodoListId');
            Todo::where('todo_list_id', $removedTodoListId)->delete();
            $todoList = TodoList::find($removedTodoListId);
            $todoList->delete();
        } catch (e) {
            Log::error(e);
        }
    }

    public function markAsActive(Request $request) {
        try {
            TodoList::where('active', 1)->update(['active' => 0]);
            $activatedTodoListId = $request->get('activatedTodoListId');
            $activatedTodoList = TodoList::find($activatedTodoListId);
            $activatedTodoList->active = true;
            $activatedTodoList->update();
        } catch (e) {
            Log::error(e);
        }
    }

    public function edit(Request $request)
    {
        try {
            $todoListId = $request->get('todoListId');
            $todoList = TodoList::find($todoListId);
            $todoList->name = $request->get('todoListName');
            $todoList->update();
        } catch (e) {
            Log::error(e);
        }

    }
}
