<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Utils;
use Auth;
use App\User;
use App\Preference;
use App\Subject;
use App\Academic;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \TutorMeRMIT\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \TutorMeRMIT\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \TutorMeRMIT\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {        
        $user = Auth::user();

        $userToUpdate = User::find($user->id);
        $userAcad = Academic::where('id', $userToUpdate->academic_id)->first();

        $userSubjects = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $userAcad->subjects), 1, -1);

        $userToUpdate->update([
            'name' => $request->name ? $request->name : $user->name,
            'email' => $request->email ? $request->email : $user->email,
            'gender' => $request->gender ? $request->gender : $user->gender,
            'birthday' => date($request->birthday ? $request->birthday : $user->birthday),
        ]);

        $userCallback = [
            'name' => $request->name ? $request->name : $user->name,
            'email' => $request->email ? $request->email : $user->email,
            'gender' => $request->gender ? $request->gender : $user->gender,
            'birthday' => date($request->birthday ? $request->birthday : $user->birthday),
        ];
        return view('edit', [
            'status' => 'success',
            'callback' => $userCallback,
            'subjectList' => json_encode($userSubjects)
        ]);
    }

    public function getEdit()
    {
        $user = Auth::user();

        $userAcad = Academic::where('id', $user->academic_id)->first();
        $userSubjects = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $userAcad->subjects), 1, -1);

        if ( $user === null )
        {
            return view('/auth/login');
        }
        else if ( $user->birthday === '1900-01-01' || $user->birthday === '' || $user->gender === '' )
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
        } else {
            return view('edit', [
                'status' => 'initial',
                'callback' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'gender' => Auth::user()->gender,
                    'birthday' => date(Auth::user()->birthday),
                ],
                'subjectList' => json_encode($userSubjects),
            ]);
        }
    }

    public function addSubject(Request $request) 
    {
        $userAcad = Academic::where('id', Auth::user()->academic_id)->first();
        $temp =  rtrim($userAcad->subjects, "}");

        $userSubjects = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $userAcad->subjects), 1, -1);

        if (in_array($request->subject, $userSubjects)){
            $response = array(
                'status' => 'Subject not added',
            );
        } else {
            $newSubJson = $temp == '{' ? $temp.$request->subject."}" : $temp.",".$request->subject."}";
            $userAcad->update(['subjects' => $newSubJson]);

            $subject = Subject::where('id', $request->subject)->get()->pop();

            $response = array(
                'status' => 'Subject added',
                'subjectToAdd' => $subject->name,
                'subjectId' => $subject->id,
                'debug' => $userSubjects
            );
        }
        return \Response::json($response);
    }

    public function deleteSubject(Request $request) 
    {
        $userAcad = Academic::where('id', Auth::user()->academic_id)->first();
        $subject = Subject::where('id', $request->subject)->get()->pop();

        $userSubjects = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $userAcad->subjects), 1, -1);
        $temp = '';

        $idxDel = array_search($request->subject, $userSubjects);
        unset($userSubjects[$idxDel]);

        $counter = 0;
        foreach ($userSubjects as $sub) {
            if($counter != (count($userSubjects) - 1)){
                $temp = $temp.$sub.",";
            } else {
                $temp = $temp.$sub;
            }
            $counter = $counter + 1;
        }

        $updateSubjects = "{".$temp."}";
        $userAcad->update(['subjects' => $updateSubjects]);

        $response = array(
            'status' => 'Subject removed',
            'subjectToDelete' => $subject->id,
            'debug' =>  $updateSubjects
        );
        return \Response::json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \TutorMeRMIT\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function preferences()
    {
        $user = Auth::user();
        $user_preferences = Preference::where('id', $user->preferences_id)->get()->pop();

        $userCallback = [
            'name' =>  $user->name,
            'email' => $user->email,
            'gender' => $user->gender,
            'birthday' => $user->birthday,
        ];

        return view('preferences', ['preferences' => $user_preferences, 'callback' => $userCallback]);
    }
}
