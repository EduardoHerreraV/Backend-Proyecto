<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use HasFactory;

    protected $table="modules";

    protected $fillable = [
        'name',
        'key'
    ];

        /**
     * Get the permissions of the module.
     */

    public function permissions()
    {
        return $this->hasMany('App\Models\Profiles');
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
