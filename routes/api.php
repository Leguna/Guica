<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return [
        "name" => "Guica",
        "version" => "1.0",
        "createdAt" => "14/11/2021",
        "author" => "Ahmad Tuflihun",
    ];
});

//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout']);
});
