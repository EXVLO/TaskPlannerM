<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TaskController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/appsettings', [AppSettingsController::class, 'index'])->name('appsettings');
Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::prefix('office')->name('office.')->group(function () {
    Route::get('/', [OfficeController::class, 'index'])->name('index');
    Route::get('/{task_manager}', [OfficeController::class, 'showTaskManager'])->name('task_managers.show');
    Route::get('/{task_manager}/{task}', [TaskController::class, 'show'])->name('tasks.show');
});

require __DIR__.'/settings.php';
