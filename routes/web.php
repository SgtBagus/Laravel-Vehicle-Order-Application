<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VehicleController;


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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


// /*--------------------------------------------------------------------------------------
// All Normal Users Routes List
// ----------------------------------------------------------------------------------------*/
// Route::middleware(['auth', 'user-access:user'])->group(function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });


/*--------------------------------------------------------------------------------------
All Admin Routes List
----------------------------------------------------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.home');
    Route::resource('admin/users', UsersController::class);
    Route::resource('admin/vehicle', VehicleController::class);
});


/*--------------------------------------------------------------------------------------
All Approval Routes List
----------------------------------------------------------------------------------------*/
Route::middleware(['auth', 'user-access:approval'])->group(function () {
    Route::get('/approval', [DashboardController::class, 'approvalHome'])->name('approval.home');
});

 