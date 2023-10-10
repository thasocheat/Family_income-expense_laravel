<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreExpense;
use App\Http\Requests\StoreIncomes;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateExpense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdateExpenses;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\ExpenseController;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $$expenses = Expense::all();
         // Check if user is admin then he can view all expense
         if (auth()->user()->user_type === 'admin') {
            $data['expenses'] = Expense::with('expense_category')->get();
        } else {
            // But if parent and child user then they can see only they expense
            $data['expenses'] = auth()->user()->expenses;
        }


        foreach($data['expenses'] as $expense){
            // Concatenate amount and currency_code
            $expense->amount_with_curency = $expense->amount . ' '. $expense->currency_code;
        }

        return view('admin.expenses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenses = ExpenseCategory::all();
        return view('admin.expenses.add',compact('expenses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpense $req)
    {
        $expense = new Expense();
        $expense->entry_date = $req->input('entry_date');
        $expense->amount = $req->input('amount');
        $expense->currency_code = $req->input('currency_code');

        $expense->description = $req->input('description');
        $expense->expense_category_id = $req->input('expense_category_id');

        // Assign the id of the authentication user
        $expense->created_by_id = Auth::id();

        $expense->save();

        $notification = array(
            'message' => 'Expense Created Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('expenses.create')->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = ExpenseCategory::all();

        return view('admin.expenses.edit', compact('expense','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenses $req, Expense $expense)
    {
        $expense->entry_date = $req->input('entry_date');
        $expense->amount = $req->input('amount');
        $expense->currency_code = $req->input('currency_code');

        $expense->description = $req->input('description');
        $expense->expense_category_id = $req->input('expense_category_id');
        $expense->save();

        $notification = array(
            'message' => 'Expense Update Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('expenses.index')->with($notification);
    }


    /**
     * Remove the specified resource from storage.
     */
    // $expense: ជាឈ្មោះ uri id ដែលបានកំណត់នៅក្នុង route file, Route::get('/destroy/expense/{expense},....);
    public function destroy(Expense $expense)
    {
        // Check if the user that create the expense data or is admin then
        // if(Auth::user()->user_type === 'admin' || $expense->create_by_id === Auth::id()){
        if(Auth::user()->user_type === 'admin' || Auth::user()->user_type === 'parent' || Auth::user()->user_type === 'child'){
            $expense->delete();


            $notification = array(
                'message' => 'Expense Delete Successfully',
                'alert-type' => 'success'
            );


            return redirect()->route('expenses.index')->with($notification);
        } else{
            abort(404, 'Unauthorized');
        }
    }
}
