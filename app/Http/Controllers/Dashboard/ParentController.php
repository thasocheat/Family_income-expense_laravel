<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Qs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParentController extends Controller
{
    public function parent_dashboard(){

        $data = [];

        if (Qs::userIsCount()) {
            // Retrieve income categories, income records, children, and more specific to the parent
            $data['incomeCategories'] = auth()->user()->incomeCategories;
            $data['expenseCategories'] = auth()->user()->expenseCategories;            
            $data['incomes'] = auth()->user()->incomes;
            $data['children'] = auth()->user()->children;
            // Add more data you want to retrieve here

            return view('pages.parent_dashboard', $data);
        }

        return view('pages.parent_dashboard',$data);

    }
}
