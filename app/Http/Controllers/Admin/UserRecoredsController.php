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
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRecoredsController extends Controller
{
    protected $user;

    public function __construct(UserRepo $user)
    {
        // $this->middleware('teamPA', ['only' => ['store', 'edit', 'update','reset_pass'] ]);

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

        // $data = $req->except(Qs::getStaffRecord());
        $data['name'] = ucwords($req->name);
        $data['user_type'] = $user_type;
        $data['photo'] = Qs::getDefaultUserImage();
        $data['code'] = strtoupper(Str::random(10));
        $data['email'] = $req->email;
        $data['dob'] = $req->dob;
        $data['address'] = $req->address;


        $user_is_teamPA = in_array($user_type, Qs::getTeamPA());

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

        } catch (HttpResponseException $req) {
            // Log or handle the exception
            return back()->with('error', 'Failed to upload the file. Please try again.');
        }



        /* Ensure that both username and Email are not blank*/
        if(!$uname && !$req->email){
            return back()->with('error', __('msg.user_invalid'));
        }

        $user = $this->user->create($data); // Create User



        $notification = array(
            'message' => 'User Store Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);
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

        $user_id = Qs::decodeHash($id);


        $user = $this->user->find($id);
        // $user = User::findOrFail($user_id);

        if(!$user){
            $notification = array(
                'message' => 'User not found',
                'alert-type' => 'error'
            );
        return back()->with($notification);

        }

        $user_type = $user ? $user->user_type : null;

        // Validate and update user data
        $data = [
            'name' => ucwords($req->name),
            'dob' => $req->dob,
            'code' => strtoupper(Str::random(10)),
            'address' => $req->address,
            'email' => $req->email,
            'phone' => $req->phone,
            'phone2' => $req->phone2,
            'gender' => $req->gender,
        ];

        $user_is_teamPA = in_array($user_type, Qs::getTeamPA());

        // Update the username based on user type
        $data['username'] = ($user_is_teamPA) ? $req->username : $req->username;


        // Update the password if a new password is provided
        if($req->has('password')){
            $data['password'] = Hash::make($req->password);
        }

        if($req->hasFile('photo')) {

            if($req->hasFile('photo')){
                // Get the old photo path
                $oldPhotoPath = public_path($user->photo);

                // Delete the old photo if it exists
                if(file_exists($oldPhotoPath)){
                    unlink($oldPhotoPath);
                }
            }


            // Upload and store the new photo
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = $data['code'] .'.'. $f['ext'];
            $f['path'] = $photo->storeAs(Qs::getUploadPath($user_type), $f['name'], 'public');
            $data['photo'] = 'storage/' . $f['path'];



        }


        // $user->update($data);   /* UPDATE USER RECORD */
        $this->user->update($id, $data);   /* UPDATE USER RECORD */


        $notification = array(
            'message' => 'User Update Successfully',
            'alert-type' => 'success'
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
