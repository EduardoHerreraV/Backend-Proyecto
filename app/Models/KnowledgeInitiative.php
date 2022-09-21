<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeInitiative extends Model
{
    use HasFactory;
    protected $table = "knowledge_initiatives";

    protected $fillable = [
        'initiative_id',
        'cat_knowledge_area_types_id',
        'cat_specific_knowledge_id'
    ];
}
