<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserType;
use App\Models\StaffRecord;
use Illuminate\Support\Facades\Auth;


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

    public function getAllUser($user_type,$photo){
        return User::get()->all();
    }

    // Get user by they type function
    public function getAllUserByType($type){
        return User::where(['user_type' => $type])->orderBy('name','asc')->get();
    }

    // Get user by type
    public function getUserByType($type)
    {
        return User::where(['user_type' => $type])->orderBy('name', 'asc')->get();
    }

    // Get all the users
    public function getAllTypes(){
        return UserType::all();
    }

    // Get all
    public function getAll(){
        return User::orderBy('name','asc')->get();
    }

    // Get the parent by login
    public function getUserByTypeAndLoggedInParent($type)
{
    $loggedInUser = Auth::user();

    if ($loggedInUser->type === 'admin') {

        return $this->getUserByType($type);
    }

    // Assuming the 'my_parent_id' field represents the relationship between parent and child
    // return $this->getUserByType($type)->where('id', $loggedInUser->my_parent_id)->get();
    return $this->getUserByType($type)->where('id', $loggedInUser)->get();

}


     // Get the user to be show on table
     public function getPTAUsers()
     {
        //  return User::where('user_type', '=', 'child')->orderBy('name', 'asc')->get();
         return User::orderBy('name', 'asc')->get();

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
