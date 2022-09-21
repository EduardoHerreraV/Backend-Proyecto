<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;
    protected $table = "repositories";

    protected $fillable = [
        'initiative_id',
        'repository_name',
        'url',
        'description'
    ];
}
