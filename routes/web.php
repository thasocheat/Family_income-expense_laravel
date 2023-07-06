<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserRecoredsController;

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

    Route::group(['prefix' => 'Admin'], function(){
        // User route

        Route::get('/view/users/', [App\Http\Controllers\Admin\UserRecoredsController::class, 'index'])->name('users.index');
        Route::get('/show/uers/{user_id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'show'])->name('users.show');


        Route::get('/create/users', [App\Http\Controllers\Admin\UserRecoredsController::class, 'create'])->name('users.create');
        Route::get('/edit/uers/{user_id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'edit'])->name('users.edit');



        Route::post('/store/users', [App\Http\Controllers\Admin\UserRecoredsController::class, 'store'])->name('users.store');


        Route::put('/update/users/{id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'update'])->name('users.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'destroy'])->name('users.destroy');
        // Route::delete('/users/{id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'destroy'])->name('users.destroy');




        // Route::get('/view/incomes', [App\Http\Controllers\Admin\IncomeController::class, 'index'])->name('incomes.index');




        Route::get('/view/childs', [App\Http\Controllers\Admin\ChildRecordsController::class, 'show'])->name('childs.show');

        Route::get('/create/childs', [App\Http\Controllers\Admin\ChildRecordsController::class, 'create'])->name('childs.create');


        Route::put('/store/childs', [App\Http\Controllers\Admin\ChildRecordsController::class, 'store'])->name('childs.store');



    });








    /*************** Users *****************/
    Route::group(['prefix' => 'users'], function(){
        Route::get('reset_pass/{id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'reset_pass'])->name('users.reset_pass');
    });

});
