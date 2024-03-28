<?php

use App\Http\Controllers\ProfileController;

// GUEST
use App\Http\Controllers\Guest\HomeController as GuestHomeController;
use App\Http\Controllers\Guest\ProfileController as GuestProfileController;
use App\Http\Controllers\Guest\ProjectController as GuestProjectController;

//ADMIN
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;

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




Route::get('/', GuestHomeController::class)->name('guest.home');
Route::get('guest/profile', GuestProfileController::class)->name('guest.profile');
Route::get('guest/projects', [GuestProjectController::class, 'index'])->name('guest.projects.index');
Route::get('guest/projects/{project}', [GuestProjectController::class, 'show'])->name('guest.projects.show');


Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('', AdminHomeController::class)->name('home');
    Route::get('profile', AdminProfileController::class)->name('profile');
    Route::resource('projects', AdminProjectController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
