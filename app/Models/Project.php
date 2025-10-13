<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'technologies',
        'project_url',
        'github_url',
        'featured'
    ];

    protected $casts = [
        'technologies' => 'array',
        'featured' => 'boolean'
    ];
}