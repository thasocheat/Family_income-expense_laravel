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

        return view('Pages.account_user',$profile_edit);
    }


    // Change password method or function
    public function change_pass(UserChangePass $req){

        $user_id = Auth::user()->id;
        $my_pass = Auth::user()->password;
        $old_pass = $req->current_passwrod;
        $new_pass = $req->password;

        // Check if the password
        if(password_verify($old_pass, $my_pass)){
            //
            $data['password'] = Hash::make($new_pass);
            $this->user->update($user_id, $data);

            return back()->with('pop_success',__('msg.p_reset'));
        }
        return back()->with('pop_error',__('msg.p_reset_fail'));


    }

    // Update profile function
    public function update_profile(UserUpdate $req){

        $user = Auth::user();

        // Update user data on specific user data
        $data = $user->username ? $req->only(['email','gender','phone','phone2','address','photo']) : $req->only(['email','gender','phone','phone2','address','username','photo']);

        // Check if required fields are missing
        $requiredFields = ['username', 'email'];
        $missingFields = array_filter($requiredFields, function ($field) use ($req){
            return empty($req->{$field});
        });

        if(count($missingFields) === count($requiredFields)){
            $notification = array(
                'message' => 'Please enter your username and email.',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        // if(!$user->username && !$req->username && $req->email){
        //     $notification = array(
        //         'message' => 'Please enter your username and email.',
        //         'alert-type' => 'error'
        //     );
        //     return back()->with($notification);
        // }

        $user_type = $user->user_type;
        $code = $user->code;


        if($req->hasFile('photo')){
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = $code .'.'. $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type), $f['name'], 'public');
            $data['photo'] = 'storage/' . $f['path'];


        }

        $this->user->update($user->id, $data);

         // Check if the form is submitted without any changes
         $isDataChanged = false;
         foreach($data as $field => $value){
            if($user->{$field} !== $value){
                $isDataChanged = true;
                break;
            }
         }
        //  If have any change the return the sucessfull message
         if ($isDataChanged){
            $this->user->update($user->id, $data);
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
