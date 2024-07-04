<?php

use App\Http\Controllers\SocialController;

Route::get('login-facebook', [App\Http\Controllers\Auth\LoginSocialController::class,'redirect_facebook']);
Route::get('facebook-callback-url', [App\Http\Controllers\Auth\LoginSocialController::class,'callback_facebook']);

//Login with GitHub
Route::get('login-github', [App\Http\Controllers\Auth\LoginSocialController::class,'redirect_github']);
Route::get('github-callback-url', [App\Http\Controllers\Auth\LoginSocialController::class,'callback_github']);

//Login with Google
Route::get('login-google', [App\Http\Controllers\Auth\LoginSocialController::class,'redirect_google']);
Route::get('google-callback-url', [App\Http\Controllers\Auth\LoginSocialController::class,'callback_google']);