<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $fillable = [
		'preferences_id', 'age_priority', 'gender_priority', 'subjects_priority'
    ];
}
