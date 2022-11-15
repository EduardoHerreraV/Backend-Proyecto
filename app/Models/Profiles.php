<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key'
    ];

    public function profiles(){
        return $this->belongsToMany('App\Models\UserProfiles','role_has_permissions','permission_id','profile_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->when(! empty ($search), function ($query) use ($search) {

            return $query->where(function($q) use ($search)
            {
                if (isset($search) && !empty($search)) {
                    $q->orWhere('name', 'like', '%' . $search . '%');
                    $q->orWhere('key', 'like', '%' . $search . '%');
                }
            });
        });
    }
}
