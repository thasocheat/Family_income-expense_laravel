<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Qs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChildController extends Controller
{
    public function child_dashboard(){

        $data = [];

        if (Qs::userIsCount()) {
            // Retrieve income categories, income records, children, and more specific to the parent
            $data['incomeCategories'] = auth()->user()->incomeCategories;
            $data['expenseCategories'] = auth()->user()->expenseCategories;            
            $data['incomes'] = auth()->user()->incomes;
            $data['parent'] = auth()->user()->parent;
            // Add more data you want to retrieve here

            return view('pages.child_dashboard',$data);

        }

        return view('pages.child_dashboard',$data);

    }
}
