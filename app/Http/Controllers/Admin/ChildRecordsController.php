<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Qs;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Repositories\UserRepo;
use App\Repositories\ChildRepo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChildRecordCreate;

class ChildRecordsController extends Controller
{
    protected $user, $child;

    public function __construct(UserRepo $user, ChildRepo $child)
    {
        $this->middleware('teamPAT', ['only' => ['edit','update', 'reset_pass', 'create', 'store'] ]);
        $this->middleware('admin', ['only' => ['edit','update', 'reset_pass', 'create', 'store','destroy',] ]);


            $this->user = $user;
            $this->child = $child;
    }

    public function create()
    {
        $data['parents'] = $this->user->getUserByType('parent');
        return view('admin.childs.add', $data);
    }

    public function store(ChildRecordCreate $req)
    {
        $data =  $req->only(Qs::getUserRecord());
        $sr =  $req->only(Qs::getChildData());



         $data['user_type'] = 'child';
         $data['name'] = ucwords($req->name);
         $data['code'] = strtoupper(Str::random(10));
         $data['password'] = Hash::make('123');
         $data['photo'] = Qs::getDefaultUserImage();

         if($req->hasFile('photo')) {
             $photo = $req->file('photo');
             $f = Qs::getFileMetaData($photo);
             $f['name'] = 'photo.' . $f['ext'];
             $f['path'] = $photo->storeAs(Qs::getUploadPath('child').$data['code'], $f['name']);
             $data['photo'] = asset('storage/' . $f['path']);
         }

         $user = $this->user->create($data); // Create User

         $sr['user_id'] = $user->id;

         $this->child->createRecord($sr); // Create Child
         return Qs::jsonStoreOk();
    }

    public function show($sr_id)
    {
        $sr_id = Qs::decodeHash($sr_id);
        if(!$sr_id){return Qs::goWithDanger();}

        $data['sr'] = $this->child->getRecord(['id' => $sr_id])->first();

        /* Prevent Other Students/Parents from viewing Profile of others */
        if(Auth::user()->id != $data['sr']->user_id && !Qs::userIsTeamPAT() && !Qs::userIsMyChild($data['sr']->user_id, Auth::user()->id)){
            return redirect(route('dashboard'))->with('pop_error', __('msg.denied'));
        }

        return view('admin.childs.show', $data);
    }
}
