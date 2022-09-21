<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Employee;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'psp_id',
        'name',
        'contract_number',
        'contract_start_date',
        'contract_end_date'
    ];


}


