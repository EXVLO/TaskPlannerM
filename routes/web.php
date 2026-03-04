<?php

use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->get('/appsettings', [AppSettingsController::class, 'index'])->name('appsettings');
Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::middleware(['auth'])->prefix('office')->name('office.')->group(function () {
    Route::get('/', [OfficeController::class, 'index'])->name('index');

    // Task managers
    Route::get('/create', [OfficeController::class, 'create'])->name('create');
    Route::post('/', [OfficeController::class, 'store'])->name('store');

    Route::get('/{task_manager}', [OfficeController::class, 'showTaskManager'])->name('task_managers.show');

    // Tasks (create + store)
    Route::get('/{task_manager}/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/{task_manager}/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Task details
    Route::get('/{task_manager}/{task}', [TaskController::class, 'show'])->name('tasks.show');
});

require __DIR__.'/settings.php';
