<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Requests;
use App\Academic;
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
        // $students = User::where('id', '!=', Auth::user()->id)->get();
        $students = User::get();
        $requests = Requests::get();

        return view('tutor', ['students'=>$students, 'requests'=>$requests]);
    }

    public function studentView()
    {
        $user = Auth::user();

        DB::table('users')
            ->where('id', $user->id)
            ->update(['tutor' => false]);

//        $point = 0;
//        $mentors = User::where('active', 0) ->where('tutor', 0)->where(
//            
//              function($mentors) use ($point){
//                            if (isset($user['gender'])) {
//                                $mentors->where('gender', $user->gender);
//                                $point = 5;
//                            }
//
//                } )->where('id', '!=', Auth::user()->id)->get();
         
         $mentors = User::where('active', 0) ->where('tutor', 0)->where('id', '!=', Auth::user()->id)->get();

         //$mentors = User::where('active', 0) ->where('tutor', 0)->where('subject', $user->subject)->where('gender', $user->gender)->where('age', $user->age)->where('id', '!=', Auth::user()->id)->get();




        return view('studentview', ['mentors'=>$mentors]);
    }
}
