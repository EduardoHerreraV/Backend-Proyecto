<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'sprint',
        'dependencies',
        'hours',
        'project_id',
        'cat_size_id',
        'cat_phase_id',
        'cat_statuses_id',
        'employee_id',
        'start_date',
        'end_date',
        'observations'
    ];

    protected $guarded  = [ ];

    public function scopeSearch($query, $search)
    {
        return $query->when(! empty ($search), function ($query) use ($search) {

            return $query->where(function($q) use ($search)
            {
                if (isset($search) && !empty($search)) {
                    $q->where('sprint', 'like', '%' . $search . '%');
                    $q->orWhere('project_id', 'like', '%' . $search . '%');
                    $q->orWhere('dependencies', 'like', '%' . $search . '%');
                    $q->orWhere('hours', 'like', '%' . $search . '%');
                    $q->orWhere('cat_size_id', 'like', '%' . $search . '%');
                    $q->orWhere('cat_phase_id', 'like', '%' . $search . '%');
                    $q->orWhere('cat_statuses_id', 'like', '%' . $search . '%');
                    $q->orWhere('employee_id', 'like', '%' . $search . '%');
                    $q->orWhere('start_date', 'like', '%' . $search . '%');
                    $q->orWhere('end_date', 'like', '%' . $search . '%');
                    $q->orWhere('observations', 'like', '%' . $search . '%');
                }
            });
        });
    }
}
