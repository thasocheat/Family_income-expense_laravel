<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// This route is redirect to login page when seit is load
Route::redirect('/', '/login');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // Home route
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Dashboard route
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

    // Account profile route group

    Route::group(['prefix' => 'account_user'], function(){
        Route::get('/', [App\Http\Controllers\UserAccountController::class, 'edit_profile'])->name('account_user');

        // Change password route
        Route::put('/change_password', [App\Http\Controllers\UserAccountController::class, 'change_pass'])->name('account_user.change_pass');

        // Update route
        Route::put('/', [App\Http\Controllers\UserAccountController::class, 'update_profile'])->name('account_user.update');



        // Start Income route
        Route::get('/view/incomes', [App\Http\Controllers\Admin\IncomeController::class, 'index'])->name('income_view');

        // End income route


    });



});
