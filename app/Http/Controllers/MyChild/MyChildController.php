<?php

namespace App\Http\Controllers\MyChild;

use Illuminate\Http\Request;
use App\Repositories\ChildRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyChildController extends Controller
{
    protected $child;
    public function __construct(ChildRepo $child)
    {
        $this->child = $child;
    }

    public function children()
    {
        // $data['childs'] = $this->child->getRecord(['my_parent_id' => Auth::user()->id])->with(['my_class', 'section'])->get();
        $data['childs'] = $this->child->getRecord(['my_parent_id' => Auth::user()->id])->get();


        return view('admin.childs.show', $data);
    }
}
