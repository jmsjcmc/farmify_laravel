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
    Route::get('/consumer-account', [ConsumerController::class, 'viewAccount'])->name('consumer.account');
    Route::get('/consumer-register-farm-owner', [ConsumerController::class, 'viewRegisterFarmOwner'])->name('consumer.register-farm-owner');
    Route::get('/consumer-jobs', [ConsumerController::class, 'viewJobs'])->name('consumer.jobs');
    Route::get('/consumer-farms', [ConsumerController::class, 'viewFarms'])->name('consumer.farms');
    Route::post('/consumer-register-farm-owner', [ConsumerController::class, 'registerFarmOwner'])->name('consumer.register-farm-owner.store');
});

Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/admin-dashboard', [AdminController::class, 'viewDashboard'])->name('admin.dashboard');
    Route::get('/admin-user-management', [AdminController::class, 'viewUserManagement'])->name('admin.user-management');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.edit-user');
    Route::get('/admin-owner-management', [AdminController::class, 'viewOwnerManagement'])->name('admin.owner-management');
    Route::post('/admin/users', [AdminController::class, 'addUser'])->name('admin.add-user');
    Route::post('/admin/farm-owners/{farmOwner}/approve', [AdminController::class, 'approveFarmOwner'])-> name('admin.approve-farm-owner');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.update-user');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');

});

Route::group(['middleware' => ['role:Farm Owner']], function () {
    Route::get('/owner-dashboard', [OwnerController::class, 'viewDashboard'])->name('owner.dashboard');
    Route::get('/owner-farm-management', [OwnerController::class, 'viewFarmManagement'])->name('owner.farm-management');
    Route::get('/owner-job-management', [OwnerController::class, 'viewJobManagement'])->name('owner.job-management');
});

Route::group(['middleware' => ['role:Laborer']], function () {
    Route::get('/laborer-dashboard', [LaborerController::class, 'viewDashboard'])->name('laborer.dashboard');
});

Route::group(['middleware' => ['role:Manager']], function () {
    Route::get('/manager-dashboard', [ManagerController::class, 'viewDashboard'])->name('manager.dashboard');
});

require __DIR__.'/auth.php';
