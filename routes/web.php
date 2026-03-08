<?php

use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskEntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');
});

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->get('/appsettings', [AppSettingsController::class, 'index'])->name('appsettings');
Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::middleware(['auth'])->prefix('office')->name('office.')->group(function () {

    Route::get('/', [OfficeController::class, 'index'])->name('index');

    // Task Managers
    Route::get('/create', [OfficeController::class, 'create'])->name('create');
    Route::post('/', [OfficeController::class, 'store'])->name('store');

    Route::get('/{task_manager}/edit', [OfficeController::class, 'edit'])->name('task_managers.edit');

    Route::patch('/{task_manager}', [OfficeController::class, 'update'])->name('task_managers.update');

    Route::delete('/{task_manager}', [OfficeController::class, 'destroy'])->name('task_managers.destroy');

    Route::get('/{task_manager}', [OfficeController::class, 'showTaskManager'])->name('task_managers.show');

    // Tasks
    Route::get('/{task_manager}/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/{task_manager}/tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::get('/{task_manager}/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    Route::patch('/{task_manager}/{task}', [TaskController::class, 'update'])->name('tasks.update');

    Route::delete('/{task_manager}/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/{task_manager}/{task}', [TaskController::class, 'show'])->name('tasks.show');

    // Task Entry
    Route::post('/{task_manager}/{task}/entry', [TaskEntryController::class, 'store'])->name('tasks.entries.store');

    Route::patch('/{task_manager}/{task}/entry/{entry}', [TaskEntryController::class, 'update'])->name('tasks.entries.update');

    Route::delete('/{task_manager}/{task}/entry/{entry}', [TaskEntryController::class, 'destroy'])->name('tasks.entries.destroy');

    // tags
    Route::get('/{task_manager}/{task}/tags', [TagController::class, 'index'])->name('tags.index');

    Route::post('/{task_manager}/{task}/tags', [TagController::class, 'store'])->name('tags.store');

    Route::patch('/{task_manager}/{task}/tags/{tag}', [TagController::class, 'update'])->name('tags.update');

    Route::delete('/{task_manager}/{task}/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
});

Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');

})->middleware('auth')->name('logout');

require __DIR__.'/settings.php';
