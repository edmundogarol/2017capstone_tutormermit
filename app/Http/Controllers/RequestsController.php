<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Requests;
use App\Subject;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    public function req($id)
    {
        $mentor_id = $id;
        $mentor = User::where('id', $mentor_id)->get()->pop();
        return view('request', ['mentor'=>$mentor]);
    }
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
        $new_request = Requests::create([
            'student_id' => Auth::user()->id,
            'tutor_id' => $request->mentorid,
            'subject_id' => $request->subject,
            'status' => 'pending',
        ]);

        $mentor = User::where('id', $new_request->tutor_id)->get()->pop();
        $subject = Subject::where('id', $new_request->subject_id)->get()->pop();

        $callback = [
            'request_id' => $new_request->id,
            'mentor_name' => $mentor->name,
            'mentor_id' => $mentor->id,
            'subject' => $subject->name,
            'question' => $request->enquiry,
        ];

        return view('re-request', ['request' => $callback]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \TutorMeRMIT\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show(Requests $requests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \TutorMeRMIT\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $requests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \TutorMeRMIT\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requests $requests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \TutorMeRMIT\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests $requests)
    {
        //
    }
}
