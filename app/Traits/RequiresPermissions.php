<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;

trait RequiresPermissions{

    /**
     * Store a newly created resource in storage.
     *
     * @param  $perms ARRAY[STRING]
     * @return BOOL
     */
    public function checkPermissions($perms)
    {
        if( !Auth::user()->hasPermissions($perms) ){
            return false;
        }
        return true;
    }

}
