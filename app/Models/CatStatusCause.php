<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatStatusCause extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_status_id',
        'name',
        'description'
    ];

    public function catStatus()
    {
        return $this->belongsTo(CatStatus::class);
    }
}
