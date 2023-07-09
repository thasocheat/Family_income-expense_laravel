<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Models\ExpenseCategory;
use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Repositories\UserRepo;

class HomeController extends Controller
{
    protected $user;
    // public function __construct(UserRepo $user)
    // {
    //     $this->user = $user;
    // }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepo $user)
    {
        $this->user = $user;
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('pages.dashboard');

        // check the user login
        if(auth()->user()->user_type === 'admin'){
            // If admin user then show admin dashboard
            return redirect()->route('dashboard');

        }elseif(auth()->user()->user_type === 'parent'){

            return redirect()->route('parent_dashboard');

        }elseif(auth()->user()->user_type === 'child'){

            return redirect()->route('child_dashboard');

        }

    }

    public function dashboard(){

        /* Get all the user with user type and diplay count
         dashboard page
        */
        $data=[];
        if(Qs::userIsCount()){
            $data['users'] = $this->user->getAll();

        }
        // if (auth()->user()->user_type === 'admin') {
            $data['incomeCategories'] = IncomeCategory::all();
            $data['expenseCategories'] = ExpenseCategory::all();

            $data['incomes'] = Income::all();
        // }
        return view('pages.dashboard',$data);

    }





}
