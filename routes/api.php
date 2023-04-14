<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ValidateEmailController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Requests\EmailVerificationCustomRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/email/verify/{id}/{hash}', ValidateEmailController::class)->middleware(['signed'])->name('verification.verify');

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class)->name('login');
Route::post('logout', LogoutController::class)->middleware('auth:sanctum');

Route::post('/password/forgot',[PasswordController::class, 'forgot']);
Route::post('/password/reset',[PasswordController::class, 'reset'])->name('password.reset');

Route::group(['prefix' => '/user', 'middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => '/me'], function () {
        Route::get('/', MeController::class);
        Route::put('/', [UserController::class, 'update']);
        Route::put('/password', [UserController::class, 'changePassword']);
    });
});


// Admin Routes
Route::group(['prefix' => '/admin'], function () {
    Route::get('/users', [AdminUserController::class, 'index']);
});

Route::group(['prefix' => '/public'], function () {
    Route::get('/stats', [IndexController::class, 'getIndexStats']);
});
