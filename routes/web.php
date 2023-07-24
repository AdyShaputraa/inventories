<?php

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PasswordController;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\AutoCompleteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/login', 301);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/login/forgot-password', [LoginController::class, 'ForgotPassword'])->name('password.request');
Route::post('/login/forgotpasswordstore', [LoginController::class, 'ForgetPasswordStore'])->name('password.email');
Route::get('/login/reset-password/{token}', [LoginController::class, 'ResetPassword'])->name('password.reset');
Route::post('/login/reset-password', [LoginController::class, 'ResetPasswordStore'])->name('password.update');
Route::post('/login/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/barang/exportpdf', [BarangController::class,'exportpdf']);
    Route::get('/barang/exportexcel', [BarangController::class,'exportexcel']);
    Route::post('/barang/importexcel', [BarangController::class,'importexcel']);

    Route::resource('/barang', BarangController::class);
    
    Route::get('/kerusakan/exportpdf', [KerusakanController::class,'exportpdf']);
    Route::get('/kerusakan/exportexcel', [KerusakanController::class,'exportexcel']);
    Route::get('/kerusakan/id/activity-log', [KerusakanController::class, 'showActivityLog'])->name('kerusakan.showActivityLog');
    Route::get('/kerusakan/filter', [KerusakanController::class,'filter']);

    Route::get('/kerusakan/create', [UserController::class, 'create']);
    Route::get('/kerusakan/{id}/edit_transaksi', [UserController::class,'edit_transaksi']);
    Route::put('/kerusakan/{id}/transaksi', [KerusakanController::class,'transaksi']);
    Route::put('/kerusakan/{id}/showActivityLog', [KerusakanController::class,'showActivityLog']);
    Route::resource('/kerusakan', KerusakanController::class);

    Route::get('/user/exportpdf', [UserController::class,'exportpdf']);
    Route::get('/user/exportexcel', [UserController::class,'exportexcel']);
    Route::post('/user/importexcel', [UserController::class,'importexcel']);
    Route::get('/user/profile', [UserController::class,'profile']);
    Route::put('/user/updateprofile/{id}', [UserController::class,'updateprofile']);
    Route::get('/user/{id}/changephoto', [UserController::class,'changephoto']);
    Route::put('/user/{id}/updatephoto', [UserController::class,'updatephoto']);
    Route::get('/user/filter', [UserController::class,'filter']);
    Route::get('/editpassword', [PasswordController::class,'edit'])->name('user.password.edit');
    Route::patch('/update', [PasswordController::class,'update'])->name('user.password.update');
    Route::post('/user/upload', [UserController::class, 'uploadFileTemp']);
    Route::resource('/user', UserController::class);
});

