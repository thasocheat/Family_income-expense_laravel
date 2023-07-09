<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Qs;
use App\Models\User;
use App\Models\ChildRecord;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\UserRepo;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRecoredsController extends Controller
{
    protected $user;

    public function __construct(UserRepo $user)
    {
        $this->middleware('teamPA', ['only' => ['store', 'edit', 'update','reset_pass'] ]);

        $this->middleware('admin', ['only' => ['destroy'] ]);

        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ut = $this->user->getAllTypes();

        $ut2 = $ut->where('level', '>=', 1);



        $d['user_types'] = Qs::userIsAdmin() ? $ut2 : $ut;
        $d['users'] = $this->user->getPTAUsers();


        return view('admin.users.user_list', $d);

    }

    public function reset_pass($id)
    {
        // Redirect if Making Changes to Head of Super Admins
        if(Qs::headA($id)){
            $notification = array(
                'message' => 'Access denied!',
                'alert-type' => 'warning'
            );

            return Redirect()->back()->with($notification);
            // return back()->with('flash_danger', __('msg.denied'));
        }

        $data['password'] = Hash::make('user');
        $this->user->update($id, $data);

        $notification = array(
            'message' => 'Access denied!',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
        // return back()->with('flash_success', __('msg.pu_reset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $ut = $this->user->getAllTypes();

        $ut2 = $ut->where('level', '>=', 1);

        $d['user_types'] = Qs::userIsAdmin() ? $ut2 : $ut;
        $d['users'] = $this->user->getPTAUsers();
        return view('admin.users.create', $d);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $req)
    {
        $user_type = $this->user->findType($req->user_type)->title;

        $data = $req->except(Qs::getStaffRecord());
        $data['name'] = ucwords($req->name);
        $data['user_type'] = $user_type;
        $data['photo'] = Qs::getDefaultUserImage();
        $data['code'] = strtoupper(Str::random(10));
        // $data['dob'] = ;


        $user_is_staff = in_array($user_type, Qs::getStaff());
        $user_is_teamPA = in_array($user_type, Qs::getTeamPA());

        // $staff_id = Qs::getAppCode().'/STAFF/'.date('Y/m', strtotime($req->emp_date)).'/'.mt_rand(1000, 9999);
        $staff_id = strtoupper(Str::random(10));
        // $data['username'] = $uname = ($user_is_teamPA) ? $req->username : $staff_id;
        $data['username'] = $uname = ($user_is_teamPA) ? $req->username : $req->username;


        $pass = $req->password ?: $user_type;
        $data['password'] = Hash::make($pass);

        try {
            // File upload logic here
            if($req->hasFile('photo')) {
                $photo = $req->file('photo'); // Validation photo field
                $f = Qs::getFileMetaData($photo);
                $f['name'] = $data['code'] .'.'. $f['ext']; // PhotoName.jpg or .png
                $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type), $f['name'], 'public'); // Photo directory
                $data['photo'] = 'storage/' . $f['path']; // Directory to save into database

            }
            // else {
            //     // If photo is not present, assign the default photo path
            //     $data['photo'] = 'storage/uploads/default-photo.png';
            // }
        } catch (HttpResponseException $req) {
            // Log or handle the exception
            return back()->with('flash_error', 'Failed to upload the file. Please try again.');
        }




        /* Ensure that both username and Email are not blank*/
        if(!$uname && !$req->email){
            return back()->with('pop_error', __('msg.user_invalid'));
        }

        $user = $this->user->create($data); // Create User

        /* CREATE STAFF RECORD */
        if($user_is_staff){
            $d2 = $req->only(Qs::getStaffRecord());
            $d2['user_id'] = $user->id;
            $d2['code'] = $staff_id;
            $this->user->createStaffRecord($d2);
        }

        $notification = array(
            'message' => 'User Store Successfully',
            'alert-type' => 'success'
        );

        // return back()->with('flash_success', 'Data save successfully.');
        return Redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $user_id = Qs::decodeHash($user_id);

        if(!$user_id){return back();}

        $data['user'] = $this->user->find($user_id);

        $user= $this->user->find($user_id);
        $userType = $user->user_type;
        $imageName = $user->photo;

        $data = [
            'user' => $user,
            'userType' => $userType,
            'imageName' => $imageName,
        ];

        /* Prevent Other Students from viewing Profile of others*/
        if(Auth::user()->id != $user_id && !Qs::userIsTeamPAT() && !Qs::userIsMyChild(Auth::user()->id, $user_id)){
            $notification = array(
                'message' => 'User Store Successfully',
                'alert-type' => 'success'
            );

            return back()->with($notification);
            // return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        return view('admin.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Qs::decodeHash($id);


        $user = $this->user->find($id);
        $userType = $user->user_type;
        $imageName = $user->photo;

        $data = [
            'user' => $user,
            'users' => $this->user->getPTAUsers(),
            'userType' => $userType,
            'imageName' => $imageName,
        ];

        return view('admin.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $req, $id)
    {
        $id = Qs::decodeHash($id);
        $user_id = intval($id);



        // Redirect if Making Changes to Head of Super Admins
        if(Qs::headA($user_id)){
            return Qs::json(__('msg.denied'), FALSE);
        }

        $user = $this->user->find($id);

        $user_type = $user ? $user->user_type : null;

        $user_is_staff = in_array($user_type, Qs::getStaff());
        $user_is_teamPA = in_array($user_type, Qs::getTeamPA());

        $data = $req->except(Qs::getStaffRecord());
        $data['name'] = ucwords($req->name);

        if (!$user_is_staff || $user_is_teamPA) {
            unset($data['email']);
        }

        // if (!$user) {
        //     $notification = array(
        //         'message' => 'User not found',
        //         'alert-type' => 'error'
        //     );
        //    return back()->with($notification);
        // }

        if($user_is_staff && !$user_is_teamPA){
        $data['username'] = $uname = ($user_is_teamPA) ? $user->username : $user->username;

            // $data['username'] = Qs::getAppCode().'/STAFF/'.date('Y/m', strtotime($req->emp_date)).'/'.mt_rand(1000, 9999);
            // $data['username'] = Qs::getAppCode();

        }
        else {
            // $data['username'] = $user->username;
            if (!$user) {
                // $data['username'] = $user->username; // Retain the old username value
            $data['username'] = $uname = ($user_is_teamPA) ? $user->username : $user->username;

            }
        }


        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = $data['code'] .'.'. $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type), $f['name'], 'public');
            $data['photo'] = 'storage/' . $f['path'];
        }

        $this->user->update($id, $data);   /* UPDATE USER RECORD */

        /* UPDATE STAFF RECORD */
        if(in_array($user_type, Qs::getStaff())){
            $d2 = $req->only(Qs::getStaffRecord());
            $d2['code'] = $data['username'];
            $this->user->updateStaffRecord(['user_id' => $id], $d2);
        }

        $notification = array(
            'message' => 'User Update Successfully',
            'alert-type' => 'info'
        );

        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $old_image = $user->photo;

       // Extract the relative path from the storage link
        $relativePath = str_replace('storage/', '', $old_image);

        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }

        if ($user) {
            $user->child_record()->delete(); // Delete the related child records
            $user->forceDelete(); // Delete the user record
        }

        // // $this->user->delete($user->id);
        // $user->delete();

        $notification = array(
            'message' => 'User Delete Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
        // return dd($old_image);

    }
}
