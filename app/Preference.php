<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'subjects', 'min_age', 'max_age', 'gender'
    ];
}
