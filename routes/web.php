<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\forgetPasswordController;
use App\Http\Controllers\AdminController;

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
Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

// Route::get('/adminhome', function(){
//     return view('adminhome');

// })->middleware(['auth'])->name('adminhome');
//Route::get('/adminhome', [AdminController::class, 'adadmin'])->name('adminhome');

Route::get('/register', [UserController::class, 'registration'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'signin'])->name('login');
//forget password and reset route
Route::get('/forget-password', [forgetPasswordController::class, 'forgetpasswordview'])->name('forgetpasswordview');
Route::post('/forget-password', [forgetPasswordController::class, 'forgetpassword'])->name('forgetpassword');
Route::get('/resetpassword{token}', [forgetPasswordController::class, 'resetpasswordview'])->name('resetpasswordview');
Route::post('/resetpassword', [forgetPasswordController::class, 'resetpassword'])->name('resetpassword');

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);
Route::delete('/logout', [UserController::class, 'logout'])->name('logout');
