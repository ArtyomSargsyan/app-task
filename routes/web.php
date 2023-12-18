<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/' , [ProjectController::class, 'index'])->name('dashboard');
    Route::get('create-project', [ProjectController::class, 'create'])->name('create.project');
    Route::post('create-project', [ProjectController::class, 'store'])->name('project.store');
    Route::get('project-edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('proect-update/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::get('delete-project/{id}', [ProjectController::class, 'destroy'])->name('project.delete');


    Route::get('/search-tasks/{projectId}', [SearchController::class, 'searchTask'])->name('search.tasks');
    Route::get('task-filter/{projectId}', [SearchController::class, 'filterStatusTask'])->name('task.filter');
    Route::get('/search', [SearchController::class, 'searchProject'])->name('search');

    Route::get('create-task/{projectId}', [TaskController::class, 'create'])->name('create.task');
    Route::get('/project/{id}', [TaskController::class, 'index'])->name('project.show');
    Route::post('/tasks/update-status', [TaskController::class, 'updateStatus']);
    Route::post('task-store/{projectId}', [TaskController::class, 'store'])->name('task.store');
    Route::get('task-edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('task-update/{taskId}', [TaskController::class, 'update'])->name('task.update');
    Route::get('task-delete/{id}', [TaskController::class, 'destroy'])->name('task.delete');
    Route::post('/tasks/attach-user', [TaskController::class, 'attachUser']);
    Route::post('/tasks/start/{taskId}', [TaskController::class, 'startTask'])->name('tasks.start');
    Route::post('/tasks/stop/{taskId}', [TaskController::class, 'stopTask'])->name('tasks.stop');


    Route::get('comments/{id}',  [CommentController::class, 'index'])->name('task.comment');
    Route::post('comment-store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('comment-replay', [CommentController::class, 'replayComment'])->name('comment.replay');
    Route::get('/comment-delete/{id}', [CommentController::class, 'destroy']);
});



