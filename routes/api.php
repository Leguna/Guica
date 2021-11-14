<?php

use App\Http\Controllers\API\AuthController;
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


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

        $request->fulfill();

        return redirect('/');
    })->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            "status" => true,
            "message" => "Verification link sent!"
        ]);
    })->name('verification.send');

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});
