<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Utils;
use Auth;
use App\Picture;
use App\User;
use App\Preference;
use App\Subject;
use App\Academic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

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
        $hasFile = 'false';

        $userToUpdate = User::find($user->id);
        $userAcad = Academic::where('id', $userToUpdate->academic_id)->first();

        $picture = [
            'user_id' => 0,
            'url' => '',
        ];

        if( $request->file('picture') != NULL ){
            $file = $request->picture;
            Storage::disk('local')->putFile($request->input('picture'),  $file);

            if ($request->picture){
                $picture = Picture::create([
                    'user_id' => Auth::user()->id,
                    'url' => $request->picture->hashName(),
                ]);
            }
        } 

        $userSubjects = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $userAcad->subjects), 1, -1);

        $userToUpdate->update([
            'name' => $request->name ? $request->name : $user->name,
            'email' => $request->email ? $request->email : $user->email,
            'gender' => $request->gender ? $request->gender : $user->gender,
            'birthday' => date($request->birthday ? $request->birthday : $user->birthday),
        ]);

        $picture = Picture::where('user_id', Auth::user()->id)->first();

        $userCallback = [
            'name' => $request->name ? $request->name : $user->name,
            'email' => $request->email ? $request->email : $user->email,
            'gender' => $request->gender ? $request->gender : $user->gender,
            'birthday' => date($request->birthday ? $request->birthday : $user->birthday),
            'picture' => $picture ? $picture->url : '',
        ];
        return view('edit', [
            'status' => 'success',
            'callback' => $userCallback,
            'subjectList' => json_encode($userSubjects),
            'debug' => $request->file('picture')
        ]);
    }

    public function getEdit()
    {
        $user = Auth::user();

        $userAcad = Academic::where('id', $user->academic_id)->first();
        $userSubjects = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $userAcad->subjects), 1, -1);

        $picture = Picture::where('user_id', Auth::user()->id)->first();

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
                    'picture' => '',
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
                    'picture' => $picture ? $picture->url : '',
                ],
                'subjectList' => json_encode($userSubjects),
                            'debug' => 'initial'

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
}
