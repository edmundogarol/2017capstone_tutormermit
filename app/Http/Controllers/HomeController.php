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

       
        $point = 0 ;
        
         $rank = collect([]);
        
     
        
        
        $requests = DB::table('users AS usr')
                    ->select("usr.id", "usr.name", "usr.gender", "usr.active","req.id AS req_id", "req.tutor_id", "req.status", "req.subject", "req.enquiry")
                    ->join("requests AS req", "req.tutor_id", "=", "usr.id")
                    ->get();
        
        
         //$matching = User::where('active',1)->where('tutor',1)->where(
          
                                    
        
        
        
        
         $matching = User::where(
        
                  function($matching) use ($user_preferences,$rank,$point,$user){
                                 
                                            
                                      
                                       
                                for ($i=0;$i<100;$i++)
                                     { 
                                            $point =0;
                                             
                                            if (isset($user_preferences['gender'])) {
                                                 if($user_preferences->gender === ''){
                                                                                            }
                                                 else{
                                                    $matching->where('gender', $user_preferences->gender);
                                                  }
                                                  
                                               
                                                 $point = $point + 5;
                                               
                                      
                                              }
//                                           if (isset($user_preferences['subjects'])) {
//                                               $matching->where('subjects', $user_preferences->subjects);
//                                               $point = $point +5;
//                                            }
        //                                    
        //                                    if (isset($user_preferences['age'])) {
        //                                            $mentors->where('age', ">=",$user_preferences->min_age);
        //                                            $mentors->where('age', "<=",$user_preferences->max_age);
        //                                           
        //                                        }
        //                                    if (isset($user_preferences['language'])) {
          //                                            $mentors->where('language',$user_preferences->first_language);
          //                                            $mentors->where('language', $user_preferences->second_language);
          //                                           $point = $point + 5;
          //                                        }


        // language

                                            
                                           //$mentors = $point ->
                                        $rank[$i]=[$user->id,$point];
                                   }   
                                }
                           )->where('id', '!=', Auth::user()->id)->get();
        
      $mentors = User::where('id', '!=', Auth::user()->id)->orderByRaw($user->id)->get();
        
            //$mentors = $matching;
//                 $mentors = User::where(
//                    
//
//                       function($mentors) use ($user_preferences){
//                         
//                                    $point = 0 ;  
//                                $rank = collect([$mentors,$point]);
//
//                                     if (isset($user_preferences['gender'])) {
//                                         if($user_preferences->gender === ''){
//                                                                                    }
//                                         else{
//                                            $mentors->where('gender', $user_preferences->gender);
//                                          }
//                                           $point =   $point +5;
//                                      }
////                                   if (isset($user_preferences['subjects'])) {
////                                        $mentors->where('subjects', $user_preferences->subjects);
////                                       
////                                    }
////                                    
////                                    if (isset($user_preferences['age'])) {
////                                            $mentors->where('age', ">=",$user_preferences->min_age);
////                                            $mentors->where('age', "<=",$user_preferences->max_age);
////                                           
////                                        }
////                                        
//
//// language
//
//                                    
//                                   //$mentors = $point ->
//                               
//                                }
//                   )->where('id', '!=', Auth::user()->id)->orderByRaw($user->id)->get();

//       $mentors = User::where('id', '!=', Auth::user()->id)->orderByRaw($user->id)->get();
//
//       
//      foreach ($mentors as $user_preferences) {
//         
//        if (isset($user_preferences['gender'])) {
//             if($user_preferences->gender === 'both'){
//               
//             }
//             else{
//                $mentors->where('gender', $user_preferences->gender);
//              }
//               
//          }
//      
//        
//      }
//        
//        if ($user_preferences->gender == '') {
//            $mentors = User::where('id', '!=', Auth::user()->id)->get();
//        } else {
//            $mentors = User::where('gender', $user_preferences->gender)->get();
//        }

        return view('studentview', ['mentors'=>$mentors, 'requests'=>$requests, 'preferences' => $user_preferences, 'mentorsessions' => $mentorsessions, 'rank'=>$rank]);

    }
}
