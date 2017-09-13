<?php

namespace TutorMeRMIT;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'student_id', 'tutor_id'
    ];
}
