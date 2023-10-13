<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\UserRecoredsController;
use App\Http\Controllers\Frontpage\FrontPageController;

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
    return view('frontpages.layout.master_frontpage');
});

// This route is redirect to login page when seit is load
// Route::redirect('/', '/login');

Auth::routes();

// Backend language switch route
//for switching language route
Route::get('/lang/{locale}', function ($locale) {
	Session::put('locale', $locale);
	return redirect()->back();
});

// ==========================//
// FRONTEND FOR FAMILY PAGE //
// =========================//
Route::group(['prefix' => 'frontpage'], function(){

    Route::get('/', [App\Http\Controllers\Frontpage\FrontPageController::class, 'index'])->name('frontpage.index');

    // Route::get('/out-story',[FrontPageController::class,'our_story'])->name('frontpage.out_story');

    // Route::get('/events',[FrontPageController::class,'event'])->name('frontpage.events');

    Route::get('/about',[FrontPageController::class,'about'])->name('frontpage.about');

    Route::get('/contact',[FrontPageController::class,'contact'])->name('frontpage.contact');

});



Route::group(['middleware' => 'auth'], function () {

    // Home route
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Admin dashboard route
    Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');



    // Account profile route group

    Route::group(['prefix' => 'account_user'], function(){
        Route::get('/', [App\Http\Controllers\UserAccountController::class, 'edit_profile'])->name('account_user');

        // Change password route
        Route::put('/change_password', [App\Http\Controllers\UserAccountController::class, 'change_pass'])->name('account_user.change_pass');

        // Update route
        Route::put('/change_profile', [App\Http\Controllers\UserAccountController::class, 'update_profile'])->name('account_user.update');



        // Start Income route
        // Route::get('/view/incomes', [App\Http\Controllers\Admin\IncomeController::class, 'index'])->name('income_view');

        // End income route






    });

    Route::group(['prefix' => 'Admin'], function(){
        // User route

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');


        Route::get('/view/users/', [App\Http\Controllers\Admin\UserRecoredsController::class, 'index'])->name('users.index');
        Route::get('/show/users/{user_id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'show'])->name('users.show');


        Route::get('/create/users', [App\Http\Controllers\Admin\UserRecoredsController::class, 'create'])->name('users.create');
        Route::get('/edit/users/{user_id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'edit'])->name('users.edit');



        Route::post('/store/users', [App\Http\Controllers\Admin\UserRecoredsController::class, 'store'])->name('users.store');


        Route::put('/update/users/{id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'update'])->name('users.update');
        // Route::get('/destroy/{id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/{id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'destroy'])->name('users.destroy');




        // Route::get('/view/incomes', [App\Http\Controllers\Admin\IncomeController::class, 'index'])->name('incomes.index');




        //=========== Member Profile Setting =============//

        Route::get('/view/members/', [MembersController::class, 'mem_index'])->name('members.index');

        Route::get('/create/members', [MembersController::class, 'mem_create'])->name('members.create');
        Route::post('/store/members', [MembersController::class, 'mem_store'])->name('members.store');

        Route::get('/show/members/{id}', [MembersController::class, 'mem_show'])->name('members.show');

        Route::get('/edit/members/{id}', [MembersController::class, 'mem_edit'])->name('members.edit');
        Route::put('/update/members/{id}', [MembersController::class, 'mem_update'])->name('members.update');


        Route::get('/destroy/{id}', [MembersController::class, 'mem_destroy'])->name('members.destroy');




    });

    Route::group(['prefix' => 'parent'], function(){
        // User route

        // Parent dashboard route
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\ParentController::class, 'parent_dashboard'])->name('parent_dashboard');


        Route::get('/view/childs/{cr_id}', [App\Http\Controllers\Admin\ChildRecordsController::class, 'show'])->name('childs.show');

        Route::get('/edit/childs/{cr_id}', [App\Http\Controllers\Admin\ChildRecordsController::class, 'edit'])->name('childs.edit');


        Route::get('/create/childs', [App\Http\Controllers\Admin\ChildRecordsController::class, 'create'])->name('childs.create');


        Route::put('/store/childs', [App\Http\Controllers\Admin\ChildRecordsController::class, 'store'])->name('childs.store');



    });

    Route::group(['prefix' => 'child'], function(){
        // User route


        // Child dashboard route
        Route::get('/dashboard', [App\Http\Controllers\Dashboard\ChildController::class, 'child_dashboard'])->name('child_dashboard');





    });




    /*************** Users *****************/
    Route::group(['prefix' => 'users'], function(){
        Route::get('reset_pass/{id}', [App\Http\Controllers\Admin\UserRecoredsController::class, 'reset_pass'])->name('users.reset_pass');


         // Income Category route

         Route::get('/view/incomes_category', [App\Http\Controllers\Admin\IncomesCategoryController::class, 'index'])->name('in_category.index');

         Route::get('/create/incomes_category', [App\Http\Controllers\Admin\IncomesCategoryController::class, 'create'])->name('in_category.create');

         Route::get('/edit/incomes_category/{category}', [App\Http\Controllers\Admin\IncomesCategoryController::class, 'edit'])->name('in_category.edit');

         Route::put('/update/incomes_category/{category_id}', [App\Http\Controllers\Admin\IncomesCategoryController::class, 'update'])->name('in_category.update');

         Route::get('/destroy/incomes_category/{category_id}', [App\Http\Controllers\Admin\IncomesCategoryController::class, 'destroy'])->name('in_category.destroy');

         Route::post('/store/incomes_category', [App\Http\Controllers\Admin\IncomesCategoryController::class, 'store'])->name('in_category.store');






         // Income route

         Route::get('/view/counts', [App\Http\Controllers\Admin\IncomesController::class, 'countData'])->name('incomes.counts');

         Route::get('/view/incomes', [App\Http\Controllers\Admin\IncomesController::class, 'index'])->name('incomes.index');

         Route::get('/create/incomes', [App\Http\Controllers\Admin\IncomesController::class, 'create'])->name('incomes.create');

         Route::get('/edit/incomes/{income}', [App\Http\Controllers\Admin\IncomesController::class, 'edit'])->name('incomes.edit');

         Route::put('/update/incomes/{income}', [App\Http\Controllers\Admin\IncomesController::class, 'update'])->name('incomes.update');

         Route::get('/destroy/incomes/{income}', [App\Http\Controllers\Admin\IncomesController::class, 'destroy'])->name('incomes.destroy');

         Route::post('/store/incomes', [App\Http\Controllers\Admin\IncomesController::class, 'store'])->name('incomes.store');






         // Expense Category route

         Route::get('/view/expense_category', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'index'])->name('ex_category.index');

         Route::get('/create/expense_category', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'create'])->name('ex_category.create');

         Route::post('/store/expense_category', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'store'])->name('ex_category.store');


         Route::get('/edit/expense_category/{category}', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'edit'])->name('ex_category.edit');

         Route::put('/update/expense_category/{category_id}', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'update'])->name('ex_category.update');

         Route::get('/destroy/expense_category/{category_id}', [App\Http\Controllers\Admin\ExpenseCategoryController::class, 'destroy'])->name('ex_category.destroy');



         // Expense  route

         Route::get('/view/expenses', [App\Http\Controllers\Admin\ExpenseController::class, 'index'])->name('expenses.index');

         Route::get('/create/expenses', [App\Http\Controllers\Admin\ExpenseController::class, 'create'])->name('expenses.create');
         Route::post('/store/expenses', [App\Http\Controllers\Admin\ExpenseController::class, 'store'])->name('expenses.store');

         Route::get('/edit/expenses/{expense}', [App\Http\Controllers\Admin\ExpenseController::class, 'edit'])->name('expenses.edit');
         Route::put('/update/expenses/{expense}', [App\Http\Controllers\Admin\ExpenseController::class, 'update'])->name('expenses.update');

                                    // បោះ id expense table ទៅចូល controller to delete.
         Route::get('/destroy/expenses/{expense}', [App\Http\Controllers\Admin\ExpenseController::class, 'destroy'])->name('expenses.destroy');






        // Report route
        Route::get('/show/weekly/report', [App\Http\Controllers\Admin\ReportsController::class, 'view_weekly_index'])->name('show.weekly');
        Route::get('/view/weekly/report', [App\Http\Controllers\Admin\ReportsController::class, 'weekly_index'])->name('view.weekly');
        Route::get('/get/weekly/expense/report', [App\Http\Controllers\Admin\ReportsController::class, 'get_weekly_expense'])->name('view.weekly.expense');

        // Monthly report
        Route::get('/show/monthly/report', [App\Http\Controllers\Admin\ReportsController::class, 'view_monthly_report'])->name('show.monthly');
        Route::get('/get/monthly/report', [App\Http\Controllers\Admin\ReportsController::class, 'get_monthly'])->name('view.monthly');
        Route::get('/get/monthly/expense/report', [App\Http\Controllers\Admin\ReportsController::class, 'get_monthly_expense'])->name('view.monthly.expense');

        // Yearly report
        Route::get('/get/yearly/report', [App\Http\Controllers\Admin\ReportsController::class, 'get_yearly'])->name('view.yearly');





    });

});

Route::group(['namespace' => 'MyChild','middleware' => 'my_child',], function(){

    Route::get('/my_children', 'MyChildController@children')->name('my_children');

});
