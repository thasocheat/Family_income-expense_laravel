<?php

namespace App\Http\Controllers\Admin;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    public function index()
    {

        $incomes = Income::all();

        return view('admin.incomes.index', compact('incomes'));
    }
}
