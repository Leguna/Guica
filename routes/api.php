<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\EmailVerifyController;
use App\Models\User;
use App\Notifications\RequestTaken;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return [
        "name" => "Guica",
        "version" => "1.0",
        "createdAt" => "14/11/2021",
        "author" => "Ahmad Tuflihun",
    ];
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name("login");


// Send Mail
Route::post('/reset-password', [AuthController::class, "resetPassword"])->name('reset-password');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function () {
        return auth()->user();
    })->middleware('verified');
    Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'verify'])->name('verification.verify');
    Route::post('/email/verify/notif', [EmailVerifyController::class, 'verifyNotif'])->name('verification.send');

    Route::get('/email/verify', [EmailVerifyController::class, 'verifyEmailView'])->name('verification.notice');

    Route::post('/logout', [AuthController::class, 'logout']);
});
