<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Requests;
use App\Academic;
use App\Preference;
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

        $requests = Requests::where('tutor_id', $user->id)->get();
        $students = User::where('id', '!=', Auth::user()->id)->get();

        return view('tutor', ['students' => $students, 'requests'=>$requests]);
    }

    public function studentView()
    {
        $user = Auth::user();
        $user_preferences = Preference::where('id', $user->preferences_id)->get()->pop();

        $point = 0;

        $requests = Requests::where('student_id', $user->id)->get();
        
              
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

       $mentors = User::where('gender', $user_preferences->gender)->get();

        return view('studentview', ['mentors'=>$mentors, 'requests'=>$requests, 'preferences' => $user_preferences]);
    }
}
