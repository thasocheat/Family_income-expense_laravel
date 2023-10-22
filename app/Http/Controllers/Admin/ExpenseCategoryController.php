<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Qs;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreExpenseCategory;
use App\Http\Requests\UpdateExpenseCategory;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['in_category'] = IncomeCategory::all();

        // Check if user is admin then he can view all category
        if (auth()->user()->user_type === 'admin') {
            $data['ex_category'] = ExpenseCategory::all();
        } else {
            // But if parent and child user then they can see only they category
            $data['ex_category'] = auth()->user()->expenseCategories;
        }

        return view('admin.expenseCategories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.expenseCategories.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseCategory $req)
    {
        // $data['ExpenseCategory'] = ExpenseCategory::create($req->all());
        // Create the income category and associate it with the authenticated user
        $data['expenseCategory'] = auth()->user()->expenseCategories()->create($req->all());

        $notification = array(
            'message' => 'Category Save Successfully',
            'alert-type' => 'success'
        );

        // return Redirect()->back()->with($notification);

        return redirect()->route('ex_category.create',$data)->with($notification);
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
    public function edit($category)
    {
        $decodeCateId = Qs::decodeHash($category);

        $category = ExpenseCategory::findOrFail($decodeCateId);


        return view('admin.expenseCategories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseCategory $req, $category_id)
    {
        $decodeCateId = Qs::decodeHash($category_id);

        $category = ExpenseCategory::findOrFail($decodeCateId);

        $category->update($req->all());

        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('ex_category.edit', ['category_id' => Qs::hash($category->id)])->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        $decodeCateId = Qs::decodeHash($category_id);

        $category = ExpenseCategory::findOrFail($decodeCateId);

        // Check if the user that create the income category data or is admin then
        if(Auth::user()->user_type === 'admin' || $category->create_by_id === Auth::id()){
            $category->delete();

            $notification = array(
                'message' => 'Category Delete Successfully',
                'alert-type' => 'success'
            );
    
    
            return redirect()->route('ex_category.index')->with($notification);
        } else{
            abort(404, 'Unauthorized');
        }
    }
}
