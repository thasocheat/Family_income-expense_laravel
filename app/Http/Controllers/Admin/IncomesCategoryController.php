<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Qs;
use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreIncomeCategory;
use App\Http\Requests\UpdateIncomeCategory;

class IncomesCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['in_category'] = IncomeCategory::all();

        // Check if user is admin then he can view all category
        if (auth()->user()->user_type === 'admin') {
            $data['in_category'] = IncomeCategory::all();
        } else {
            // But if parent and child user then they can see only they category
            $data['in_category'] = auth()->user()->incomeCategories;
        }

        return view('admin.incomeCategories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.incomeCategories.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncomeCategory $req)
    {
        // $data['incomeCategory'] = IncomeCategory::create($req->all());
        // Create the income category and associate it with the authenticated user
        $data['incomeCategory'] = auth()->user()->incomeCategories()->create($req->all());

        $notification = array(
            'message' => 'Category Save Successfully',
            'alert-type' => 'success'
        );

        // return Redirect()->back()->with($notification);

        return redirect()->route('in_category.create',$data)->with($notification);
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

        $category = IncomeCategory::findOrFail($decodeCateId);


        return view('admin.incomeCategories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncomeCategory $req, $category_id)
    {
        $decodeCateId = Qs::decodeHash($category_id);

        $category = IncomeCategory::findOrFail($decodeCateId);

        $category->update($req->all());

        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('in_category.edit', ['category_id' => Qs::hash($category->id)])->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category_id)
    {
        $decodeCateId = Qs::decodeHash($category_id);

        $category = IncomeCategory::findOrFail($decodeCateId);

        // Check if the user that create the income category data or is admin then
        if(Auth::user()->user_type === 'admin' || $category->create_by_id === Auth::id()){
            $category->delete();

            $notification = array(
                'message' => 'Category Delete Successfully',
                'alert-type' => 'success'
            );


            return redirect()->route('in_category.index')->with($notification);
        } else{
            abort(404, 'Unauthorized');
        }
    }
}
