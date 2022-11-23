<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\Email;
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

Route::get('/', [LoginController::class, 'create']);
Route::post('/email_validate', [LoginController::class, 'email_validate'])->name('emailValidate');
Route::post('/input', [LoginController::class, 'input']);
Route::post('/input/value', [LoginController::class, 'value']);
Route::get('/thankyou', [LoginController::class, 'comment']);
Route::post('/artist/otp_verify', [ArtistDataController::class, 'SMSAPI'])->name('ArtistOTP');
Route::post('/otp_validate', [LoginController::class, 'otp_validate'])->name('otpvalidate');