<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    // Logout
    public function Logout(){
        // Use Auth to check if user is logout
        Auth::logout();
        // Then redirect to login page
        return Redirect()->route('login');
    }
}
