<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'title',
        'email',
        'phone',
        'location',
        'bio',
        'photo',
        'cv_path'
    ];
}