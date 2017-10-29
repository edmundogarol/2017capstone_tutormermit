<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Controllers\Utils;
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
        $subjectList = [];

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
                    'picture' => '',
                ],
                'subjectList' => json_encode($subjectList),
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
                    ->select("usr.id", "usr.name", "usr.gender", "usr.active","req.match_perc", "req.subject", "req.enquiry")
                    ->join("requests AS req", "req.student_id", "=", "usr.id")
                    ->where("req.tutor_id", '=', $user->id)
                    ->where('status', '!=', 'Declined')
                    ->where('status', '!=', 'Accepted')
                    ->orderBy('req.match_perc', 'desc')
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

        $point = 0 ;
        
        $rank = collect([]);
        
        $requests = DB::table('users AS usr')
                    ->select("usr.id", "usr.name", "usr.gender", "usr.active","req.id AS req_id", "req.tutor_id", "req.status", "req.subject", "req.enquiry")
                    ->join("requests AS req", "req.tutor_id", "=", "usr.id")
                    ->where('req.student_id', $user->id)
                    ->get();
        
         //$matching = User::where('active',1)->where('tutor',1)->where(
        $rank = [];
        $order = [];

        $activeMentors = User::where('active',1)->where('tutor',1)->where('id', '!=', $user->id)->get();

        $mentorAge = 0;
                
        $userSubjects = array_slice( Utils::multiexplode(array("{", ",", "}"), $user_preferences->subjects), 1, -1);

        // [Gender + Age ] (2) + [Subjects]
        $preference_count = 2 + ($userSubjects[0] == '' ? 0 : count($userSubjects));

        $debug_array = [];

        for ($i=0;$i<count($activeMentors);$i++)
        { 
            $point = 0;
            $match_count = 0;
            $subject_match = 0;
            $mentor_match = User::where('id', $activeMentors[$i]->id )->get()->pop();
            $mentor_acadProfile = Academic::where('id', $mentor_match->academic_id)->get()->pop();
            $mentorSubjects = array_slice( Utils::multiexplode(array("{", ",", "}"), $mentor_acadProfile->subjects), 1, -1);
            
            //get DOB
            $mentor_dob = Utils::multiexplode(array(" ","-"), $mentor_match->birthday);
            //caculate age
            $mentorAge = date('Y')-$mentor_dob[0]+1;
            
            // Gender
            if($user_preferences->gender == $mentor_match->gender || ($user_preferences->gender == 'both' || $user_preferences->gender == '')) {
                $point = $point + 10;
                $match_count = $match_count + 1;
            }
            // Age
            if($user_preferences->min_age < $mentorAge && $user_preferences->max_age >  $mentorAge) {
                $point = $point + 10;
                $match_count = $match_count + 1;
            }
            // Subjects
            for($m = 0; $m < count($userSubjects); $m++)
            {
                for($o = 0; $o < count($mentorSubjects); $o++)
                {
                    if($userSubjects[$m] == $mentorSubjects[$o] && $userSubjects[$m] != '')
                    {
                        $point = $point + 10;
                        $subject_match = $subject_match + 1;
                        $match_count = $match_count + 1;
                    }
                }
            }

            $match_percentage = ($match_count / $preference_count) * 100;

            if ($subject_match == 0) {
                $match_percentage = 0;
            }

            array_push($rank, ['id' => $mentor_match->id, 'mentorname'=> $mentor_match->name, 'points' => $point,'match_count' => $match_count, 'match_percentage' => $match_percentage]);  
        }
        $sorted = [];

        if(count($rank) != 0 ){
            Utils::sksort($rank, 'points', false);

            for($i=0; $i<count($rank); $i++){
                array_push($order, $rank[$i]['id']);
            }

            $sorted = $activeMentors->sortBy(function($activeMentors) use ($order) {
                return array_search($activeMentors->getKey(), $order);
            });
        }

        return view('studentview', ['mentors'=>$sorted , 'requests'=>$requests, 'preferences' => $user_preferences, 'mentorsessions' => $mentorsessions, 'rankingObj' => $rank, 'test' => json_encode($rank)]);

    }
}
