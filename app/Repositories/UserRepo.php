<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserType;
use App\Models\StaffRecord;


class UserRepo{

    // Update the user, password or something else
    public function update($id, $data){
        return User::find($id)->update($data);
    }

    public function delete($id)
    {
        return User::destroy($id);
    }

    public function create($data)
    {
        return User::create($data);
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


     // Get the user as child
     public function getPTAUsers()
     {
         return User::where('user_type', '<>', 'child')->orderBy('name', 'asc')->get();
     }

    //  Find user type by id
    public function findType($id)
    {
        return UserType::find($id);
    }


     /********** STAFF RECORD ********/
     public function createStaffRecord($data)
     {
         return StaffRecord::create($data);
     }

     public function updateStaffRecord($where, $data)
     {
         return StaffRecord::where($where)->update($data);
     }
}
