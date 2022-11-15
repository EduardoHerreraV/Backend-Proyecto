<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    // protected $table="user_profiles";
    // public static $unique_table = 'user_profiles';
    // public static $unique_column = 'key';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'key',
      ];


    /**
     * Get the modules the the user has allowet.
     */
    public function modules()
    {
    return $this->hasMany('App\Models\Catalogs\Modules');
    }

    /**
     * Get the permissions that the user has allowet.
     */
    public function permissions(){
        return $this->belongsToMany('App\Models\Profiles','role_has_permissions','profile_id','permission_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->when(! empty ($search), function ($query) use ($search) {

            return $query->where(function($q) use ($search)
            {
                if (isset($search) && !empty($search)) {
                    $q->where('key', 'like', '%' . $search . '%');
                    $q->orWhere('name', 'like', '%' . $search . '%');

                }
            });
        });
    }
}
