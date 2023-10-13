<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\SubmissionListController;


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
Route::resource('/', HomeController::class);


/*--------------------------------------------------------------------------------------
All Admin Routes List
----------------------------------------------------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('admin', [DashboardController::class, 'index'])->name('admin.home');
    Route::resource('admin/users', UsersController::class);
    Route::resource('admin/vehicle', VehicleController::class);
    Route::resource('admin/submission-list', SubmissionListController::class);
});


/*--------------------------------------------------------------------------------------
All Approval Routes List
----------------------------------------------------------------------------------------*/
Route::middleware(['auth', 'user-access:approval'])->group(function () {
    Route::get('approval', [DashboardController::class, 'approvalHome'])->name('approval.home');
    Route::resource('approval/submission-list-approval', SubmissionListController::class);
});

 