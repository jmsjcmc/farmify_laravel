<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\LaborerController;
use App\Http\Controllers\ManagerController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['role:Consumer']], function () {
    Route::get('/consumer-dashboard', [ConsumerController::class, 'viewDashboard'])->name('consumer.dashboard');
    Route::get('/consumer-setting', [ConsumerController::class, 'viewSetting'])->name('consumer.setting');
});

Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/admin-dashboard', [AdminController::class, 'viewDashboard'])->name('admin.dashboard');
});

Route::group(['middleware' => ['role:Owner']], function () {
    Route::get('/owner-dashboard', [OwnerController::class, 'viewDashboard'])->name('owner.dashboard');
});

Route::group(['middleware' => ['role:Laborer']], function () {
    Route::get('/laborer-dashboard', [LaborerController::class, 'viewDashboard'])->name('laborer.dashboard');
});

Route::group(['middleware' => ['role:Manager']], function () {
    Route::get('/manager-dashboard', [ManagerController::class, 'viewDashboard'])->name('manager.dashboard');
});

require __DIR__.'/auth.php';
