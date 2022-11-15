<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfiles extends Model
{
    use HasFactory;
    protected $table="user_profiles";
    public static $unique_table = 'user_profiles';
    public static $unique_column = 'key';

    protected $fillable = [
        'name',
        'key',
      ];

    public function modules()
    {
    return $this->hasMany('App\Models\Modules');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Profiles','role_has_permissions','profile_id','permission_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->when(! empty ($search), function ($query) use ($search) {

            return $query->where(function($q) use ($search)
            {
                if (isset($search) && !empty($search)) {
                    $q->orWhere('name', 'like', '%' . $search . '%');
                    $q->where('key', 'like', '%' . $search . '%');

                }
            });
        });
    }
}
