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

        function multiexplode($delimiters,$string) {
            $ready = str_replace($delimiters, $delimiters[0], $string);
            $launch = explode($delimiters[0], $ready);
            return  $launch;
        }

        function array_sort($array, $on, $order=SORT_ASC)
        {
            $new_array = array();
            $sortable_array = array();

            if (count($array) > 0) {
                foreach ($array as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $k2 => $v2) {
                            if ($k2 == $on) {
                                $sortable_array[$k] = $v2;
                            }
                        }
                    } else {
                        $sortable_array[$k] = $v;
                    }
                }

                switch ($order) {
                    case SORT_ASC:
                        asort($sortable_array);
                    break;
                    case SORT_DESC:
                        arsort($sortable_array);
                    break;
                }

                foreach ($sortable_array as $k => $v) {
                    $new_array[$k] = $array[$k];
                }
            }

            return $new_array;
        }

        $point = 0 ;
        
        $rank = collect([]);
        
        $requests = DB::table('users AS usr')
                    ->select("usr.id", "usr.name", "usr.gender", "usr.active","req.id AS req_id", "req.tutor_id", "req.status", "req.subject", "req.enquiry")
                    ->join("requests AS req", "req.tutor_id", "=", "usr.id")
                    ->where('req.student_id', $user->id)
                    ->get();
        
         //$matching = User::where('active',1)->where('tutor',1)->where(
        $rank = [];

        $activeMentors = User::where('active',1)->where('tutor',1)->where('id', '!=', $user->id)->get();

        $mentorAge = 18;
        $userSubjects = array_slice(multiexplode(array("{", ",", "}"), $user_preferences->subjects), 1, -1);

        $debug_array = [];

        for ($i=0;$i<count($activeMentors);$i++)
        { 
            $point = 0;
            $mentor_match = User::where('id', $activeMentors[$i]->id )->get()->pop();
            $mentor_acadProfile = Academic::where('id', $mentor_match->academic_id)->get()->pop();
            $mentorSubjects = array_slice(multiexplode(array("{", ",", "}"), $mentor_acadProfile->subjects), 1, -1);

            // Gender
            if($user_preferences->gender == $mentor_match->gender) {
                $point = $point + 10;
            }
            // Age
            if($user_preferences->min_age < $mentorAge && $user_preferences->max_age >  $mentorAge) {
                $point = $point + 10;
            }
            // Subjects
            for($m = 0; $m < count($userSubjects); $m++)
            {
                for($o = 0; $o < count($mentorSubjects); $o++)
                {
                    if($userSubjects[$m] == $mentorSubjects[$o])
                    {
                        array_push($debug_array, [$m.$o, $userSubjects[$m], $mentorSubjects[$o], $point]);
                        $point = $point + 10;
                    }
                }
            }

            array_push($rank, ['mentorId'=> $mentor_match->id, 'points' => $point]);
        }

        $tempMentors = User::get();
        $mentors = array_sort($rank, 'points', SORT_DESC);

        $sorted = $activeMentors->sortBy(function($activeMentors) use ($mentors) {
            return array_search($activeMentors->getKey(), $mentors);
        });

        return view('studentview', ['mentors'=>$sorted, 'requests'=>$requests, 'preferences' => $user_preferences, 'mentorsessions' => $mentorsessions]);

    }
}
