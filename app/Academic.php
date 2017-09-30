<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subjects', 'student_rating', 'tutor_rating', 'student_r_count', 'tutor_r_count'
    ];
}
