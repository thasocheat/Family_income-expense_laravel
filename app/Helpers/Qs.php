<?php

namespace App\Helpers;

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
        return 'uplads';

    }


}
