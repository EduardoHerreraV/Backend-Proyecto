<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatStatus extends Model
{
    use HasFactory;
    protected $guarded  = [ ];


    public function Causes(){
        return $this->hasMany(CatStatusCause::class, 'cat_status_id', 'id');
    }
}
