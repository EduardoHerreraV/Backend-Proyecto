<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;
    protected $table="role_has_permissions";

    /**
     * Get the profiles that the user has allowet.
     */

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
