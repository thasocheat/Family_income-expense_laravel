<?php

namespace App\Helpers;

use Hashids\Hashids;
use App\Models\Setting;
use App\Models\ChildRecord;
use App\Models\IncomeCategory;
use Illuminate\Support\Facades\Auth;




class Qs
{

    // Error message
    public static function displayError($errors)
    {
        foreach ($errors as $err) {
            $data[] = $err;
        }
        return '
                <div class="alert alert-danger alert-styled-left alert-dismissible">
									<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
									<span class="font-weight-semibold">Oops!</span> '.
        implode(' ', $data).'
							    </div>
                ';
    }




    // Count the user with their user type to display on dashboard
    public static function userIsCount(){
        return in_array(Auth::user()->user_type, self::getCountType());
    }

    // Return all user type need
    public static function getCountType(){
        return ['admin','parent','child'];
    }


    // Function to get default user profile
    public static function getDefaultUserImage()
    {
        return 'storage/uploads/default-photo.png';
    }

    // Get all user type
    public static function getAllUserTypes($remove=[])
    {
        $data =  ['admin', 'parent', 'child'];
        return $remove ? array_values(array_diff($data, $remove)) : $data;
    }


    // Count category
    // public static function categoryIsCount(){
    //     return in_array(IncomeCategory::all());
    // }

    public static function months(){
        return[
            1 => 'January',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'August',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Des',

        ];
    }




    // Get the panel
    public static function getPanelOptions()
    {
        return '    <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>';
    }


    // If user is admin function
    public static function userIsAdmin(){
        return Auth::user()->user_type == 'admin';
    }

    public static function userIsParent(){
        return Auth::user()->user_type == 'parent';
    }

    public static function userIsChild(){
        return Auth::user()->user_type == 'child';
    }


    // Admin and parentfunction
    public static function userIsAP(){
        return in_array(Auth::user()->user_type, self::getAP());
    }

    // All Admin and parent function
    public static function getAP(){
        return ['admin','parent','child'];
    }

    public static function findMyChildren($parent_id)
    {
        return ChildRecord::where('my_parent_id', $parent_id)->with(['user'])->get();
    }
    // Get file meta data
    public static function getFileMetaData($file){
        $dataFile['ext'] = $file->getClientOriginalExtension();
        $dataFile['type'] = $file->getClientMimeType();
        $dataFile['size'] = self::formatBytes($file->getSize());
        return $dataFile;

    }

    // Format by for photo
    public static function formatBytes($size, $precision = 2){
        $base = log($size, 1024);
        $suffixes = array('B','KB','MB','GB','TB');
        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }

    // Get photo upload diretory
    public static function getUploadPath($user_type){
        return 'uploads/'.$user_type;
        // return 'uploads/';

    }


    // Check if User is Head of Admins (Untouchable)
    public static function headA(int $user_id)
    {
        return $user_id === 1;
    }

    // Get the admin and parent
    public static function getTeamPA()
    {
        // return ['admin'];
        return ['parent'];

    }
    public static function getTeamPAT()
    {
        return ['admin'];
    }
    public static function userIsTeamPA()
    {
        return in_array(Auth::user()->user_type, self::getTeamPA());
    }
    public static function userIsTeamPAT()
    {
        return in_array(Auth::user()->user_type, self::getTeamPAT());
    }



    // Hash code
    public static function hash($id)
    {
        $date = date('dMY').'TEST';
        $hash = new Hashids($date, 14);
        return $hash->encode($id);
    }

    // Dashcod
    public static function decodeHash($str, $toString = true)
    {
        $date = date('dMY').'TEST';
        $hash = new Hashids($date, 14);
        // $decoded = $hash->decode($str);
        // return $toString ? implode(',', $decoded) : $decoded;
        if ($str !== null && $str !== '') {
            $decoded = $hash->decode($str);
            return $toString ? implode(',', $decoded) : $decoded;
        }

        return $toString ? '' : [];


    }

    public static function generateUserCode()
    {
        return substr(uniqid(mt_rand()), -7, 7);
    }

    // Parent and they child
    public static function userIsMyChild($child_id, $parent_id)
    {
        $data = ['user_id' => $child_id, 'my_parent_id' =>$parent_id];
        return ChildRecord::where($data)->exists();
    }

    // Message json
    public static function jsonStoreOk()
    {
        return self::json(__('msg.store_ok'));
    }
    public static function json($msg, $ok = TRUE, $arr = [])
    {
        return $arr ? response()->json($arr) : response()->json(['ok' => $ok, 'msg' => $msg]);
    }
    public static function jsonUpdateOk()
    {
        return self::json(__('msg.update_ok'));
    }

    public static function goWithDanger($to = 'dashboard', $msg = NULL)
    {
        $msg = $msg ? $msg : __('msg.rnf');
        return self::goToRoute($to)->with('flash_danger', $msg);
    }

    public static function goToRoute($goto, $status = 302, $headers = [], $secure = null)
    {
        $data = [];
        $to = (is_array($goto) ? $goto[0] : $goto) ?: 'dashboard';
        if(is_array($goto)){
            array_shift($goto);
            $data = $goto;
        }
        return app('redirect')->to(route($to, $data), $status, $headers, $secure);
    }

    public static function goWithSuccess($to, $msg)
    {
        return self::goToRoute($to)->with('flash_success', $msg);
    }




    // Staff
    public static function getStaffRecord($remove = [])
    {
        $data = ['created_at',];

        return $remove ? array_values(array_diff($data, $remove)) : $data;
    }

    public static function userIsStaff()
    {
        return in_array(Auth::user()->user_type, self::getStaff());
    }

    public static function getStaff($remove=[])
    {
        $data =  ['admin', 'parent'];
        return $remove ? array_values(array_diff($data, $remove)) : $data;
    }



    public static function getAppCode()
    {
        return self::getSetting('system_title') ?: 'TEST';
    }

    public static function getSetting($type)
    {
        return Setting::where('type', $type)->first()->description;
    }

    public static function getSystemName()
    {
        return self::getSetting('system_name');
    }



    // Child
    public static function getUserRecord($remove = [])
    {
        $data = ['name', 'email', 'phone', 'phone2', 'dob', 'gender', 'address'];

        return $remove ? array_values(array_diff($data, $remove)) : $data;
    }
    public static function getChildData($remove = [])
    {
        $data = ['my_parent_id','age'];

        return $remove ? array_values(array_diff($data, $remove)) : $data;

    }


}
