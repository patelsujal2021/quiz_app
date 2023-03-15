<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;

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


Route::group(['prefix'=>'admin'],function() {
    Route::get('/', [AuthController::class, 'adminLoginPage'])->name('admin.login.page');
    Route::post('/login', [AuthController::class, 'adminLoginProcess'])->name('admin.login');
    Route::get('/logout', [AuthController::class, 'adminLogoutProcess'])->name('admin.logout');

    Route::group(['middleware'=>['auth:admin']],function() {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('/question', QuestionController::class);
    });
});


Route::group(['prefix'=>'user'],function() {
    Route::get('/', [AuthController::class, 'loginPage'])->name('auth.login.page');
    Route::post('/login', [AuthController::class, 'loginProcess'])->name('auth.login');
    Route::get('/logout', [AuthController::class, 'logoutProcess'])->name('auth.logout');
    Route::get('/register',[AuthController::class,'registrationPage'])->name('auth.register.page');
    Route::post('/register',[AuthController::class,'registrationProcess'])->name('auth.register');

    Route::group(['middleware'=>['auth']],function() {
        Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    });
});
