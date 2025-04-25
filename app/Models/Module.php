<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //

    protected $fillable = [
        'slug',
        'label',
        'singular_label'
    ];
}
