<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Auth\RegisterController;
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

// Route::get('/home', function () {
//     return view('/');
// });
// Route::middleware(['guest'])->group(function () {
//     // Rute untuk halaman login

// Route to show the registration form


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route to handle the registration process
Route::post('register', [RegisterController::class, 'register'])->name('register.post');
Route::get('login', function () {
    return view('login');
})->name('login');


Route::get('/login', [SesiController::class, 'index'])->name('login');
Route::post('/login', [SesiController::class, 'login']);
// });
Route::post('/logout', [SesiController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/customer/index', [SesiController::class, 'customer'])->name('customer.index');
    Route::get('/customer/index', [CustomersController::class, 'customers'])->name('customer.index');
    Route::get('/tampilan', [VideoController::class, 'show'])->name('tampilan');


    // routes/web.php


    Route::get('admin/customers/index', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('admin/customers/tambah', [CustomersController::class, 'tambah'])->name('customers.tambah');
    Route::post('admin/customers', [CustomersController::class, 'store'])->name('customers.store');
    Route::get('admin/customers/{id}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::put('admin/customers/{id}', [CustomersController::class, 'update'])->name('customers.update');
    Route::delete('/admin/customers/{id}', [CustomersController::class, 'hapus'])->name('customers.hapus');
    Route::get('/admin/customers/index', [CustomersController::class, 'index'])->name('admin.customers.index');

    // routes/web.php


    Route::get('admin/video/index', [VideoController::class, 'index'])->name('video.index');
    Route::get('admin/video/tambah', [VideoController::class, 'tambah'])->name('video.tambah');
    Route::post('admin/video', [VideoController::class, 'store'])->name('video.store');
    Route::post('admin/video', [VideoController::class, 'store'])->name('video.store');
    Route::get('admin/video/{id}/edit', [VideoController::class, 'edit'])->name('video.edit');
    Route::put('admin/video/{id}/update', [VideoController::class, 'update'])->name('video.update');
    Route::delete('admin/video/{id}/delete', [VideoController::class, 'destroy'])->name('video.destroy');
    Route::get('/admin/video/index', [VideoController::class, 'index'])->name('admin.video.index');


    Route::post('/request-access/{video}', [VideoController::class, 'requestAccess'])->name('request-access');

    Route::resource('admin/video', VideoController::class);
    Route::post('/admin/customers/request-access/{id}', 'CustomersController@requestAccess')->name('admin.customers.request-access');
    Route::put('/admin/customers/approve-access/{id}', 'CustomersController@approveAccess')->name('admin.customers.approve-access');
    Route::put('/admin/customers/update-akses-video/{id}', 'CustomersController@updateAksesVideo')->name('admin.customers.update-akses-video');


    // routes/web.php


    Route::get('videos', [VideoController::class, 'index'])->name('videos.index');
    Route::post('videos/request/{id}', [VideoController::class, 'requestVideo'])->name('videos.request');
    Route::get('admin/video-requests', [VideoController::class, 'viewRequests'])->name('admin.video.requests');
    Route::post('admin/video-requests/approve/{id}', [VideoController::class, 'approveRequest'])->name('admin.video.requests.approve');
    Route::get('videos/{id}', [VideoController::class, 'showVideo'])->name('videos.show');
});

Route::get('/',  [VideoController::class, 'tampil'])->name('index');
