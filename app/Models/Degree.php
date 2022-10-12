<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ConexionApiController;
use App\Http\Controllers\API\CatalogsController;

class Degree extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->when(! empty ($search), function ($query) use ($search) {

            return $query->where(function($q) use ($search)
            {
                if (isset($search) && !empty($search)) {
                    $q->orWhere('name', 'ilike', '%' . $search . '%');
                }
            });
        });
    }
}
