<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('register',[RegisterController::class,'index']);
Route::post('register',[RegisterController::class,'store'])->name('register');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('tasks', TaskController::class);
    Route::get('create_task', [TaskController::class,'create'])->name('create');
    Route::get('/tasks/{task}/edit', [TaskController::class,'edit'])->name('tasks.edit');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/tasks/{task}/assign', [TaskController::class,'assign_view'])->name('assign_view');
    Route::put('/assign_task', [TaskController::class, 'assign_task'])->name('assign');
    Route::post('search',[TaskController::class,'search'])->name('search');
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');
});


