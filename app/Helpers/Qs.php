<?php

namespace App\Helpers;

use Hashids\Hashids;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;




class Qs
{
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
        return asset('backends/images/user/user.png');
    }

    // Get all user type
    public static function getAllUserTypes($remove=[])
    {
        $data =  ['admin', 'parent', 'child'];
        return $remove ? array_values(array_diff($data, $remove)) : $data;
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


    // Admin and parentfunction
    public static function userIsAP(){
        return in_array(Auth::user()->user_type, self::getAP());
    }

    // All Admin and parentfunction
    public static function getAP(){
        return ['admin','parent'];
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
        // return 'uplads'.$user_type.'/';
        return 'uploads';

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
        return ['admin', 'parent'];

    }
    public static function getTeamPAT()
    {
        return ['admin', 'parent'];
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
        $date = date('dMY').'CJ';
        $hash = new Hashids($date, 14);
        return $hash->encode($id);
    }

    // Dashcod
    public static function decodeHash($str, $toString = true)
    {
        $date = date('dMY').'CJ';
        $hash = new Hashids($date, 14);
        $decoded = $hash->decode($str);
        return $toString ? implode(',', $decoded) : $decoded;
    }

    // Parent and they child
    public static function userIsMyChild($student_id, $parent_id)
    {
        $data = ['user_id' => $student_id, 'my_parent_id' =>$parent_id];
        // return StudentRecord::where($data)->exists();
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




    // Staff
    public static function getStaffRecord($remove = [])
    {
        $data = ['emp_date',];

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
        return self::getSetting('system_title') ?: 'CJ';
    }

    public static function getSetting($type)
    {
        return Setting::where('type', $type)->first()->description;
    }


}
