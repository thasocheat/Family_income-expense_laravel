<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepo;
use App\Http\Requests\UserUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserChangePass;
use Illuminate\Support\Facades\Storage;


class UserAccountController extends Controller
{
    protected $user;
    public function __construct(UserRepo $user)
    {
        $this->user = $user;
    }

    // Edit profile function
    public function edit_profile(){
        // $id = Qs::decodeHash($id);
        // $user = $this->user->find($id);
        // $userType = $user->user_type;
        // $folderName = Qs::getUploadPath($userType);
        // $data = [
        //     'user' => $user,
        //     'users' => $this->user->getPTAUsers(),
        //     'folderName' => $folderName,
        // ];

        $profile_edit['pro_edit'] = Auth::user();

        return view('pages.account_user',$profile_edit);
    }


    // Change password method or function
    public function change_pass(UserChangePass $req){

        $user_id = Auth::user()->id;
        $my_pass = Auth::user()->password;
        $old_pass = $req->current_password;
        $new_pass = $req->password;

        // Check if the password if correct than return the success, if not error
        if(password_verify($old_pass, $my_pass)){
            //
            $data['password'] = Hash::make($new_pass);
            $this->user->update($user_id, $data);

            $notification = array(
                'message' => 'Password changed successfully.',
                'alert-type' => 'success'
            );

            return back()->with($notification);
            // Debugging
        // dd($old_pass, $my_pass);

        }else{
            $notificationrest = array(
                'message' => 'You have fail to change the password!',
                'alert-type' => 'error'
            );
            return back()->with($notificationrest);
            // dd($old_pass, $my_pass);
        }

        


    }

    // Update profile function
    public function update_profile(UserUpdate $req){

        $user = Auth::user();
        $user_id = $user->id;
        

        // Empty array for data updates
        $data = [];

        // Check if the username field is provided in the request
        if ($req->has('username')) {
            $data['username'] = $req->input('username');
        }

        // Check if the email field is provided in the request
        if ($req->has('email')) {
            $data['email'] = $req->input('email');
        }

        // Add other fields you want to update in a similar manner
        if ($req->has('gender')) {
            $data['gender'] = $req->input('gender');
        }

        if ($req->has('phone')) {
            $data['phone'] = $req->input('phone');
        }

        if ($req->has('address')) {
            $data['address'] = $req->input('address');
        }

        if ($req->has('phone2')) {
            $data['phone2'] = $req->input('phone2');
        }

        if ($req->has('photo')) {
            $data['photo'] = $req->input('photo');
        }


        if($req->hasFile('photo') && $req->file('photo')->isValid()){
            
            // Delete the old image
            if(!empty($user->photo)){
                // Extract the file name from the url and delete the file
                $oldFileName = $user->photo;
                Storage::delete($oldFileName);
            }
            
            
            
            $photo = $req->file('photo');
            $user_type = $user->user_type;
            $code = $user->code;
            $f = Qs::getFileMetaData($photo);
            $f['name'] = $code .'.'. $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type), $f['name'], 'public');
            $data['photo'] = 'storage/' . $f['path'];


        }


         
        //  If have any change the return the sucessfull message
         if (!empty($data)){
            $this->user->update($user_id, $data);
            $notification = array(
                'message' => 'Profile Updated Successfully',
                'alert-type' => 'success'
            );

        }else{
            // If no change the return into message
            $notification = array(
                'message' => 'No changes made to the profile.',
                'alert-type' => 'info'
            );
        }
        // return back()->with('flash_success',__('msg.update_ok'));
        return back()->with($notification);


    }
}
