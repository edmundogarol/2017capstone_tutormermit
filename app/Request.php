<?php

namespace TutorMeRMIT;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'student_id', 'tutor_id'
    ];
}
