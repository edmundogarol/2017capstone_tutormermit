<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Requests;
use App\Academic;
use App\Preference;
use App\MentorSession;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        DB::table('users')
            ->where('id', $user->id)
            ->update(['active' => true]);

        if ($user->birthday === '1900-01-01' || $user->birthday === '' || $user->gender === '' )
        {
            return view('edit', [
                'status' => 'unfinished',
                'callback' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'gender' => Auth::user()->gender,
                    'birthday' => date(Auth::user()->birthday),
                ]
            ]);
        } 
        else
        {
            return view('home');
        }
    }

    public function tutorView()
    {
        $user = Auth::user();

        DB::table('users')
            ->where('id', $user->id)
            ->update(['tutor' => true]);

        $mentorsessions = DB::table('users AS usr')
                    ->select("mensess.id as session_id", "usr.name", "usr.active","usr.email")
                    ->join("mentor_sessions AS mensess", "mensess.student_id", "=", "usr.id")
                    ->get();

        $students = User::where('id', '!=', Auth::user()->id)->get();

        $callback = DB::table('users AS usr')
                    ->select("usr.id", "usr.name", "usr.gender", "usr.active", "req.subject", "req.enquiry")
                    ->join("requests AS req", "req.student_id", "=", "usr.id")
                    ->where('status', '!=', 'Declined')
                    ->where('status', '!=', 'Accepted')
                    ->get();

        return view('tutor', ['students' => $students, 'requests'=> $callback, 'mentorsessions' => $mentorsessions]);
    }

    public function studentView()
    {
        $user = Auth::user();
        $user_preferences = Preference::where('id', $user->preferences_id)->get()->pop();
        $mentorsessions = DB::table('users AS usr')
                    ->select("mensess.id as session_id", "usr.name", "usr.active","usr.email", "mensess.student_id")
                    ->join("mentor_sessions AS mensess", "mensess.tutor_id", "=", "usr.id")
                    ->where('mensess.student_id', $user->id)
                    ->get();

        $point = 0;

        $requests = DB::table('users AS usr')
                    ->select("usr.id", "usr.name", "usr.gender", "usr.active","req.id AS req_id", "req.tutor_id", "req.status", "req.subject", "req.enquiry")
                    ->join("requests AS req", "req.tutor_id", "=", "usr.id")
                    ->get();
        
              
//                 $mentors = User::where(
                    
//                       function($mentors) use ($preference){
                     
//                                 $point = 0;

//                                     if (isset($user_preferences['gender'])) {
//                                         $mentors->where('gender', $user_preferences->gender);
//                                         $point = $point +5 ;    
//                                         }
// //                                    if (isset($preference['subjects'])) {
// //                                        $mentors->where('subjects', $preference->subjects);
// //                                       
// //                                    }

        
//                         } )->where('id', '!=', Auth::user()->id)->get();

        if ($user_preferences->gender == '') {
            $mentors = User::where('id', '!=', Auth::user()->id)->get();
        } else {
            $mentors = User::where('gender', $user_preferences->gender)->get();
        }

        return view('studentview', ['mentors'=>$mentors, 'requests'=>$requests, 'preferences' => $user_preferences, 'mentorsessions' => $mentorsessions]);
    }
}
