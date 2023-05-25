<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Get all user data to view
    public function ViewUser(){

        // This can take one data from database only
        // $alldata = User::all();
        // return view('backend.user.view_user',compact($alldata));


        // This can take all and put into one variable
        $data['alldata'] = User::all();
        $data['all_user_type_data'] = User::all();

        // return view('pages.backend.user.view_user',compact($data));
        return view('pages.backend.user.view_user',$data);

    }

    // Add new user
    public function AddUser(){

        return view('pages.backend.user.add_user');

    }

    // // To show photo from databse
    // public function showUserPhoto($filename){
    //     // Check if image is exist or not
    //     $isExists = Storage::disk('public')->exists('/'.$filename);

    //     if($isExists){
    //         // Get content of image
    //         $content = Storage::get('public/'.$filename);

    //         // Get mime type of image
    //         $mime = Storage::get('public/'.$filename);

    //         // Prepare response with image content and response code
    //         $response = Response::make($content,200);

    //         // Set header
    //         $response->header("Content-Type",$mime);

    //         // Return response
    //         return $response;

    //     }else{
    //         abort(404);
    //     }
    // }
}
