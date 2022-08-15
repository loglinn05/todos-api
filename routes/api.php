<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TodoController;
use \App\Http\Controllers\TodoListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('todos')->group(function () {
    Route::controller(TodoController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/create', 'create');
        Route::post('/delete', 'delete');
        Route::post('/mark-as-done', 'markAsDone');
        Route::post('/mark-as-undone', 'markAsUndone');
        Route::post('/edit', 'edit');
    });
});

Route::prefix('todo-lists')->group(function () {
    Route::controller(TodoListController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/create', 'create');
        Route::post('/delete', 'delete');
        Route::post('/mark-as-active', 'markAsActive');
        Route::post('/edit', 'edit');
    });
});
