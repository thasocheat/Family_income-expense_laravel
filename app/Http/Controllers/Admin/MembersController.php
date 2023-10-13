<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Qs;
// use Illuminate\Support\Str;
use App\Models\Member;
// use App\Repositories\UserRepo;
use App\Models\Members;
// use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{
    protected $member;
    
    /**
     * Display a listing of the resource.
     */
    public function mem_index()
    {

        // variable = ModelNme::method()
        $members = Members::get();

        // dd($members);
        return view('admin.settings.member_list', compact('members'));

    }

    public function mem_create()
    {

        return view('admin.settings.create');

    }


    public function mem_store(Request $request)
    {
        $request->validate([
            'photo' => 'required|mimes:png,jpg,jpeg,gif,png|max:5048',
            'name' => 'required',
            'description' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'github' => 'required'
        ]);

        // get data from input
        // varGetFromInput=requestParameter->filedInputName
        $name = $request->name;
        $description = $request->description;
        $facebook = $request->facebook;
        $instagram = $request->instagram;
        $github = $request->github;

        // check image
        if($file = $request->hasFile('photo')) {
            $file = $request->file('photo') ;

            // Generate a unique file name using a random string with the current timestamp
            $fileName = $file->getClientOriginalName() ;

            // path for storage images
            // Storage::disk('public')->put('uploads/members' . $fileName, file_get_contents($file));
            $destinationPath = public_path().'/storage/uploads/members';
            $file->move($destinationPath,$fileName);

            // Photo path
            $photoPath = 'storage/uploads/members/' . $fileName;
        }


        // send data to database
        // varrObj->databaseName = varGetFromInput
        $member = new Members();
        $member->photo = $photoPath;
        $member->name = $name;
        $member->description = $description;
        $member->facebook = $facebook;
        $member->instagram = $instagram;
        $member->github = $github;
        $member->save();

        $notification = array(
            'message' => 'User Store Successfully',
            'alert-type' => 'success'
        );

        // dd($member);
        // return back()->with('flash_success', 'Data save successfully.');
        return Redirect()->back()->with($notification);
    }



    public function mem_edit($id) {

        // dd($id);
        // $id = Qs::decodeHash($id);


        $data['members'] = Members::find($id);

        // dd($data);
        return view('admin.settings.edit', $data);
    }

    public function mem_update(Request $request, $id) {


        // Validate the request.
        $validate = $request->validate([
            'photo' => 'sometimes|mimes:png,jpg,jpeg,gif,png|max:5048', // Allow photo to be optional
            'name' => 'required',
            'description' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'github' => 'required',
        ]);

         // Get the member's ID and name.
         $member = Members::find($id);

         if(!$member){
             return redirect()->back()->with('error', 'Member not found');
         }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'github' => $request->github,
        ];

       

        // Check if a new photo is uploaded.
        if ($request->hasFile('photo')) {
            
            // Delete the old photo if it exitsts
             // Delete the old image
             if(!empty($member->photo)){
                // Extract the file name from the url and delete the file
                $old_image = $member->photo;

                // Extract the relative path from the storage link
                $relativePath = str_replace('storage/', '', $old_image);

                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
            }

            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path(). '/storage/uploads/members';
            $file->move($destinationPath, $fileName);

            $data['photo'] = 'storage/uploads/members/' . $fileName;

                        
            
        }

       
        //  If have any change the return the sucessfull message
         if (!empty($data)){
            $member->update($data);

            // Return a redirect response with a success message.
            $notification = array(
                'message' => 'Member Update Successfully',
                'alert-type' => 'info',
            );

        }else{
            // If no change the return into message
            $notification = array(
                'message' => 'No changes made to the member.',
                'alert-type' => 'info'
            );
        }        

        return redirect()->back()->with($notification);

        
    }



    public function mem_show($id)
    {
        // $members = Member::where('id','=',$id)->first();

        // dd($id);
        // $id = Qs::decodeHash($id);

        // if(!$id){return back();}

        $data['member'] = Members::find($id);

        // $member= $this->member->find($id);
        // $data = [
        //     'member' => $member,
        // ];


        // dd($data);

        return view('admin.settings.show', $data);
    }


    public function mem_destroy($id) {

        // dd($id);

        $members = Members::find($id);
        if(!$members){
            return redirect()->back()->with('error', 'Member not found!!');
        }

        $old_image = $members->photo;

        // Extract the relative path from the storage link
        $relativePath = str_replace('storage/', '', $old_image);

        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }

        if ($members) {
            $members->forceDelete(); // Delete the member record
        }

        $notification = array(
            'message' => 'User Store Successfully',
            'alert-type' => 'success'
        );

        // dd($members);
        return Redirect()->back()->with($notification);
    }
}
