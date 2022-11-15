<?php

namespace App\Traits;
use App\Traits\GeneralResponse;
use App\Traits\RequiresPermissions;
use Auth;

trait ProfileVerify {

    use GeneralResponse, RequiresPermissions;

    public function can($perms = null)
    {

        $roles = ['super_admin', 'administrator', 'finance', 'rr_hh'];
        $user = Auth::user();
        $user_role = $user->profile->key;

        $error = null;

        //validate that the user's role type is allowed
        if( !in_array($user_role, $roles) ){
            $error = 'Invalid User Type';
        }
        //validate that the user's account is active verified
        // elseif( !$user->active ){
        //     $error = 'User Inactive';
        // }
        //validate that the user's role has all necessary permissions
        elseif($perms){
            if( !$this->checkPermissions($perms) ){
                $error = 'User is missing permissions';
            }
        }
        //if any user validation error was found, return.
        if($error){
            return $this->genResponse(401,null,$error);
        }else{
            return false;
        }
    }
}
