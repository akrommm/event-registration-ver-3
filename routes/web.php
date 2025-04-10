<?php

use App\Http\Controllers\Admin\RegistrasiController;
use App\Http\Controllers\Admin\UserRegistrasiController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect('login');
});

// login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginProcess']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('regis', [AuthController::class, 'showRegis']);
Route::post('regis', [AuthController::class, 'store']);

Route::prefix('admin')->middleware(['auth'])->group(function () {
    include "_/admin.php";
});

Route::resource('registrasi', UserRegistrasiController::class);
Route::get('/registrasi/success/{id}', [UserRegistrasiController::class, 'success'])->name('user.registrasi.success');
Route::get('/download/idcard/{id_peserta}', [RegistrasiController::class, 'downloadIdCard'])->name('download.idcard');
