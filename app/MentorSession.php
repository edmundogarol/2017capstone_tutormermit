<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MentorSession extends Model
{
    protected $fillable = [
        'student_id', 'tutor_id'
    ];
}
