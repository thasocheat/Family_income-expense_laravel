<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Qs;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\UserRepo;
use App\Repositories\ChildRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChildRecordCreate;
use App\Http\Requests\ChildRecordUpdate;

class ChildRecordsController extends Controller
{
    protected $user, $child;

    public function __construct(UserRepo $user, ChildRepo $child)
    {
        $this->middleware('teamPA', ['only' => ['edit','update', 'reset_pass'] ]);
        $this->middleware('admin', ['only' => ['edit','update', 'reset_pass','destroy',] ]);


            $this->user = $user;
            $this->child = $child;
    }

    public function create()
    {

        $loggedInUser = Auth::user(); // Hold the value from the user model and pass to $loggedInUser


        // Check if the user is admin then can choose all the parent user
        if ($loggedInUser->user_type === 'admin') {
            $data['parents'] = $this->user->getUserByType('parent');

        } else {
            // If the user is parent then can choose only himself
            $data['parents'] = collect([$loggedInUser]);
        }
        return view('admin.childs.add', $data);
    }

    public function store(ChildRecordCreate $req)
    {
        $data =  $req->only(Qs::getUserRecord());
        $cr =  $req->only(Qs::getChildData());



         $data['user_type'] = 'child';
         $data['name'] = ucwords($req->name);
         $data['code'] = strtoupper(Str::random(10));
         $data['password'] = Hash::make('123');
         $data['photo'] = Qs::getDefaultUserImage();

         if($req->hasFile('photo')) {
             $photo = $req->file('photo');
             $f = Qs::getFileMetaData($photo);
            $f['name'] = $data['code'] .'.'. $f['ext']; // PhotoName.jpg or .png

            $f['path'] = $photo->storeAs(Qs::getUploadPath('child'), $f['name'], 'public'); // Photo directory
            $data['photo'] = 'storage/' . $f['path']; // Directory to save into database


         }

         $user = $this->user->create($data); // Create User

         $cr['user_id'] = $user->id;

         $this->child->createRecord($cr); // Create Child

         $notification = array(
            'message' => 'Child Create Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
        //  return Qs::jsonStoreOk();
    }

    public function show($cr_id)
    {
        $cr_id = Qs::decodeHash($cr_id);

        if(!$cr_id){return Qs::goWithDanger();}

        $data['cr'] = $this->child->getRecord(['id' => $cr_id])->first();

        // Generate the URL with the cr_id parameter
        // $url = route('childs.show', ['cr_id' => $cr_id]);


        /* Prevent Other Childs/Parents from viewing Profile of others */
        if(Auth::user()->id != $data['cr']->user_id && !Qs::userIsTeamPAT() && !Qs::userIsMyChild($data['cr']->user_id, Auth::user()->id)){
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }
         // Pass the $url value to be used
        //  $data['url'] = $url;

        return view('admin.childs.child_info', $data);
        // return dd($data['url']);
    }

    public function listByParent($parent_id)
    {
        // $data['my_class'] = $mc = $this->my_class->getMC(['id' => $class_id])->first();
        // $data['students'] = $this->student->findStudentsByClass($class_id);
        // $data['sections'] = $this->my_class->getClassSections($class_id);

        // return is_null($mc) ? Qs::goWithDanger() : view('admin.childs.list', $data);
    }

    public function edit($cr_id)
    {
        $cr_id = Qs::decodeHash($cr_id);
        if(!$cr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->child->getRecord(['id' => $cr_id])->first();
        $data['parents'] = $this->user->getUserByType('parent');
        return view('admin.childs.edit', $data);
    }

    public function update(ChildRecordUpdate $req, $cr_id)
    {
        $cr_id = Qs::decodeHash($cr_id);
        if(!$cr_id){return Qs::goWithDanger();}

        $cr = $this->child->getRecord(['id' => $cr_id])->first();
        $d =  $req->only(Qs::getUserRecord());
        $d['name'] = ucwords($req->name);

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = $d['code'] .'.'. $f['ext']; // PhotoName.jpg or .png

            $f['path'] = $photo->storeAs(Qs::getUploadPath('child'), $f['name'], 'public'); // Photo directory
            $d['photo'] = 'storage/' . $f['path']; // Update directory to save into database

        }

        $this->user->update($cr->user->id, $d); // Update User Details

        $crec = $req->only(Qs::getchildData());

        $this->child->updateRecord($cr_id, $crec); // Update Child Rec



        $notification = array(
            'message' => 'Child Create Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function destroy($c_id)
    {
        $c_id = Qs::decodeHash($c_id);
        if(!$c_id){return Qs::goWithDanger();}

        $cr = $this->child->getRecord(['user_id' => $c_id])->first();
        $path = Qs::getUploadPath('child').$cr->user->code;
        Storage::exists($path) ? Storage::deleteDirectory($path) : false;
        $this->user->delete($cr->user->id);

        return back()->with('flash_success', __('msg.del_ok'));
    }
}
