<?php

namespace App\Http\Controllers\Admin;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreIncomes;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateIncomes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $incomes = Income::all();
         // Check if user is admin then he can view all incomes
         if (auth()->user()->user_type === 'admin') {
            $data['incomes'] = Income::with('income_category')->get();
        } else {
            // But if parent and child user then they can see only they incomes
            $data['incomes'] = auth()->user()->incomes;
        }
        

        // foreach($incomes as $income){
        //     // Dump the category object for each income
        //     dump($income->income_category);
        // }

        return view('admin.incomes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categories = IncomeCategory::all();

       return view('admin.incomes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomes $req)
    {
        $income = new Income();
        $income->entry_date = $req->input('entry_date');
        $income->amount = $req->input('amount');
        $income->description = $req->input('description');
        $income->income_category_id = $req->input('income_category_id');
        
        // Assign the id of the authentication user
        $income->created_by_id = Auth::id();

        $income->save();

        $notification = array(
            'message' => 'Income Create Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('incomes.index')->with($notification);

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
    public function edit(Income $income)
    {
        $categories = IncomeCategory::all();

        return view('admin.incomes.edit', compact('income','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncomes $req, Income $income)
    {
        $income->entry_date = $req->input('entry_date');
        $income->amount = $req->input('amount');
        $income->description = $req->input('description');
        $income->income_category_id = $req->input('income_category_id');
        $income->save();

        $notification = array(
            'message' => 'Child Create Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('incomes.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        // Check if the user that create the income data or is admin then
        if(Auth::user()->user_type === 'admin' || $income->create_by_id === Auth::id()){
            $income->delete();


            $notification = array(
                'message' => 'Income Delete Successfully',
                'alert-type' => 'success'
            );
    
    
            return redirect()->route('incomes.index')->with($notification);
        } else{
            abort(404, 'Unauthorized');
        }
    }
}
