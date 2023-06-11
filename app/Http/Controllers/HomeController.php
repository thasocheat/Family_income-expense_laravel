<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use Illuminate\Http\Request;
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
        return redirect()->route('dashboard');

    }

    public function dashboard(){

        /* Get all the user with user type and diplay count
         dashboard page
        */
        $count=[];
        if(Qs::userIsCount()){
            $count['users'] = $this->user->getAll();
        }
        return view('pages.dashboard',$count);

    }

}
