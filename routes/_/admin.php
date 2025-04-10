<?php

use App\Http\Controllers\Admin\CheckInController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\ManageIDCardController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RegistrasiController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class);
Route::resource('event', EventController::class);
Route::resource('registration', RegistrasiController::class);
Route::resource('check-in', CheckInController::class);
Route::resource('manage-idcard', ManageIDCardController::class);
Route::resource('profile', ProfileController::class);
Route::resource('logo-idcard', LogoController::class);
Route::resource('pengumuman', PengumumanController::class);
Route::get('/manage-idcard/success/{id}', [ManageIDCardController::class, 'success'])->name('admin.manage-idcard.success');
// Route::get('registrasi/success', [RegistrasiController::class, 'success'])->name('admin.registrasi.success');
Route::get('/registrasi/success/{id}', [RegistrasiController::class, 'success'])->name('admin.registrasi.success');

Route::post('/check-in/validate', [CheckInController::class, 'validateCheckIn'])->name('admin.check-in.validate');
Route::get('/download/idcard/{id_peserta}', [RegistrasiController::class, 'downloadIdCard'])->name('admin.download.idcard');
Route::get('/export-peserta-pdf/{id}', [RegistrasiController::class, 'exportPDF'])->name('admin.export-peserta-pdf');
Route::get('/get-participant/{id_peserta}', [CheckInController::class, 'getParticipant'])->name('admin.get-participant');

Route::delete('/delete-peserta/{id}', [RegistrasiController::class, 'deletePeserta']);
