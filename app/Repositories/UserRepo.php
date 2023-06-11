<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserType;


class UserRepo{

    // Update the user, password or something else
    public function update($id, $data){
        return User::find($id)->update($data);
    }



    // Find user id
    public function find($id){
        return User::find($id);
    }

    // Get user by they type function
    public function getAllUserByType($type){
        return User::where(['user_type' => $type])->orderBy('name','asc')->get();
    }

    // Get all the users
    public function getAllTypes(){
        return UserType::all();
    }

    // Get all
    public function getAll(){
        return User::orderBy('name','asc')->get();
    }
}
