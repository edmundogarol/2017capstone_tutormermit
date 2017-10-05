<?php

namespace App\Http\Controllers;

use Auth;
use App\Preference;
use App\Academic;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

class AcadController extends Controller
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

    public function preferences()
    {
        $user = Auth::user();
        $user_preferences = Preference::where('id', $user->preferences_id)->get()->pop();
        $userSubjectPreferences = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $user_preferences->subjects), 1, -1);

        $userCallback = [
            'min_age' => $user_preferences->min_age,
            'max_age' => $user_preferences->max_age,
            'gender' => $user_preferences->gender == 'both' || $user_preferences->gender == '' ? 'both' : $user_preferences->gender,
        ];

        return view('preferences', [
            'preferences' => $user_preferences, 
            'callback' => $userCallback,
            'subjectList' => json_encode($userSubjectPreferences)
        ]);
    }

    public function addSubject(Request $request) 
    {
        $user_preferences = Preference::where('id', Auth::user()->preferences_id)->get()->pop();
        $temp =  rtrim($user_preferences->subjects, "}");

        $userSubjectPreferences = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $user_preferences->subjects), 1, -1);

        if (in_array($request->subject, $userSubjectPreferences)){
            $response = array(
                'status' => 'Subject not added',
            );
        } else {
            $newSubJson = $temp == '{' ? $temp.$request->subject."}" : $temp.",".$request->subject."}";
            $user_preferences->update(['subjects' => $newSubJson]);

            $subject = Subject::where('id', $request->subject)->get()->pop();

            $response = array(
                'status' => 'Subject added',
                'subjectToAdd' => $subject->name,
                'subjectId' => $subject->id,
                'debug' => $userSubjectPreferences
            );
        }
        return \Response::json($response);
    }

    public function deleteSubject(Request $request) 
    {
        $user_preferences = Preference::where('id', Auth::user()->preferences_id)->get()->pop();
        $subject = Subject::where('id', $request->subject)->get()->pop();

        $userSubjects = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $user_preferences->subjects), 1, -1);
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
        $user_preferences->update(['subjects' => $updateSubjects]);

        $response = array(
            'status' => 'Subject removed',
            'subjectToDelete' => $subject->id,
            'debug' =>  $updateSubjects
        );
        return \Response::json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Academic::create([
            'subjects' => $data['subjects'],
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'subjects' => 'required',
        ]);
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
     * @param  \TutorMeRMIT\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function show(Academic $academic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \TutorMeRMIT\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function edit(Academic $academic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \TutorMeRMIT\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Academic $academic)
    {
        $user = Auth::user();

        $userToUpdate = User::find($user->id);
        $user_preferences = Preference::where('id', $user->preferences_id)->get()->pop();
        $userSubjectPreferences = array_slice(Utils::multiexplode(array("{", ",", "}","\""), $user_preferences->subjects), 1, -1);

        $user_preferences->update([
            'min_age' => $request->min_age,
            'max_age' => $request->max_age,
            'gender' => $request->gender == 'both' || $request->gender == '' ? 'both' : $request->gender,
        ]);

        $userCallback = [
            'min_age' => $user_preferences->min_age,
            'max_age' => $user_preferences->max_age,
            'gender' => $user_preferences->gender == 'both' || $user_preferences->gender == '' ? 'both' : $user_preferences->gender,
        ];

        return redirect('studentview');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \TutorMeRMIT\Academic  $academic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academic $academic)
    {
        //
    }
}
