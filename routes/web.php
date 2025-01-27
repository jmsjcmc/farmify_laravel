<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\LaborerController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Auth;

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

// Routes For Consumer
Route::group(['middleware' => ['role:Consumer']], function () {
    // GET Routes
    Route::get('/consumer-dashboard', [ConsumerController::class, 'viewDashboard'])->name('consumer.dashboard');
    Route::get('/consumer-setting', [ConsumerController::class, 'viewSetting'])->name('consumer.setting');
    Route::get('/consumer-account', [ConsumerController::class, 'viewAccount'])->name('consumer.account');
    Route::get('/consumer-register-farm-owner', [ConsumerController::class, 'viewRegisterFarmOwner'])->name('consumer.register-farm-owner');
    Route::get('/consumer-jobs', [ConsumerController::class, 'viewJobs'])->name('consumer.jobs');
    Route::get('/jobs/{job}', [ConsumerController::class, 'showJob'])->name('consumer.jobs.show');
    Route::get('/consumer-farms', [ConsumerController::class, 'viewFarms'])->name('consumer.farms');

    // POST Routes
    Route::post('/consumer-register-farm-owner', [ConsumerController::class, 'registerFarmOwner'])->name('consumer.register-farm-owner.store');
    Route::post('/consumer/jobs/{job}/apply', [ConsumerController::class, 'applyJob'])->name('consumer.jobs.apply');
    Route::post('notifications/mark-as-read', function() {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    });
});
// End Of Consumer Routes

// Routes For Admin
Route::group(['middleware' => ['role:Admin']], function () {
    Route::get('/admin-dashboard', [AdminController::class, 'viewDashboard'])->name('admin.dashboard');
    Route::get('/admin-user-management', [AdminController::class, 'viewUserManagement'])->name('admin.user-management');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.edit-user');
    Route::get('/admin-owner-management', [AdminController::class, 'viewOwnerManagement'])->name('admin.owner-management');
    Route::post('/admin/users', [AdminController::class, 'addUser'])->name('admin.add-user');
    Route::post('/admin/farm-owners/{farmOwner}/approve', [AdminController::class, 'approveFarmOwner'])->name('admin.approve-farm-owner');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.update-user');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
});
// End Of Admin Routes

// Routes For Farm Owners
Route::group(['middleware' => ['role:Farm Owner']], function () {
    // All GET routes
    Route::get('/owner-dashboard', [OwnerController::class, 'viewDashboard'])->name('owner.dashboard');
    Route::get('/owner-farm-management', [OwnerController::class, 'viewFarmManagement'])->name('owner.farm-management');
    Route::get('/owner-job-management', [OwnerController::class, 'viewJobManagement'])->name('owner.job-management');
    Route::get('/owner/applications/resume/{application}', [OwnerController::class, 'viewResume'])->name('owner.applications.resume');
    Route::get('/owner/applications/{application}', [OwnerController::class, 'getApplicationDetails'])->name('owner.applications.show');

    // All POST routes
    Route::post('/owner/jobs', [OwnerController::class, 'addJobForFManager'])->name('owner.jobs.store');
    Route::post('/owner/applications/{application}/schedule', [OwnerController::class, 'updateInterviewDate'])->name('owner.applications.schedule');
    // All PATCH routes
    Route::patch('/owner/jobs/{job}/status', [OwnerController::class, 'updateStatus'])->name('owner.jobs.update-status');
    Route::patch('/owner/applications/{application}/status', [OwnerController::class, 'updateApplicationStatus'])->name('owner.applications.update-status');
});
// End Of Farm Owner Routes

// Routes For Laborers
Route::group(['middleware' => ['role:Laborer']], function () {
    Route::get('/laborer-dashboard', [LaborerController::class, 'viewDashboard'])->name('laborer.dashboard');
});
// End Of Laborer Routes

// Routes For Managers
Route::group(['middleware' => ['role:Manager']], function () {
    Route::get('/manager-dashboard', [ManagerController::class, 'viewDashboard'])->name('manager.dashboard');
});
// End Of Manager Routes

require __DIR__ . '/auth.php';
