<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Repository;
use App\Models\KnowledgeInitiative;

class Initiative extends Model
{
    use HasFactory;
    protected $table = "initiatives";

    protected $fillable = [
        'project_id',
        'name'
    ];

    protected $guarded  = [ ];

    public function repository()
    {
        return $this->hasMany('App\Models\Repository', 'initiative_id');
    }

    public function knowledge()
    {
        return $this->hasMany('App\Models\KnowledgeInitiative', 'initiative_id');
    }


    public function scopeSearch($query, $search)
    {
        return $query->when(! empty ($search), function ($query) use ($search) {

            return $query->where(function($q) use ($search)
            {
                if (isset($search) && !empty($search)) {
                    $q->where('name', 'like', '%' . $search . '%');
                }
            });
        });
    }
}
