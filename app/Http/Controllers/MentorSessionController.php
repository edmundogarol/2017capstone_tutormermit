<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MentorSession;

class MentorSessionController extends Controller
{
    public function mentorEnd($id)
    {
      MentorSession::where('id', $id)->delete();
        return redirect('tutor')->withErrors(['Session ended.']);
    } 

    public function studentEnd($id)
    {
      MentorSession::where('id', $id)->delete();
        return redirect('studentview')->withErrors(['Session ended.']);
    }   
}
