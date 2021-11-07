<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/dashboard', function () {
    return "Authenticated";
});

//Route::prefix('v1')->apiResources('guild/card/');
