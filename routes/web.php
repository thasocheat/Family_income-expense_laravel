<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;

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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.index');
    })->name('dashboard');
});

// Admin all route

Route::get('admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');


// Group Route Users all route

Route::prefix('users')->group(function(){

    Route::get('/view', [UserController::class, 'ViewUser'])->name('view.user');

    Route::get('/add', [UserController::class, 'AddUser'])->name('add.users');

});

// Photo route
// Route::prefix('image')->group(function(){
//     Route::get('profile-photos/{filename}','UserController@showUserPhoto');
// });

