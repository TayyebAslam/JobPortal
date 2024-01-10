<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\employer\EmployerController;
use App\Http\Controllers\employer_listing\EmployerListingController;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login_view')->name('login');
    Route::post('/', 'login');
    Route::get('register', 'register_view')->name('register');
    Route::post('register', 'register');

    Route::post('logout', 'logout')->name('logout');

});

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index')->name('dashboard');
});

Route::controller(EmployerController::class)->group(function () {
    Route::get('employerdashboard', 'index')->name('employerdashboard');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('show', 'index')->name('adminprofile');
    Route::patch('details', 'update')->name('admindetails');
    Route::patch('password', 'password')->name('adminpassword');
    Route::patch('picture', 'picture')->name('adminpicture');
});

Route::controller(EmployerListingController::class)->group(function(){
    Route::get('showlist', 'index')->name('showlisting');
    Route::get('create','create')->name('createlisting');
});
