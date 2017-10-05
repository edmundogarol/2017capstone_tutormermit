<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Requests;
use App\Subject;
use App\MentorSession;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    public function req($id, $match_perc)
    {
        $mentor_id = $id;
        $mentor = User::where('id', $mentor_id)->get()->pop();
        return view('request', [
            'mentor'=>$mentor,
            'match_perc' => $match_perc,
        ]);
    }   

    public function rereq($id)
    {
        $this_request = Requests::where('id', $id)->get()->pop();
        $mentor = User::where('id', $this_request->tutor_id)->get()->pop();

        $callback = [
            'request_id' => $this_request->id,
            'mentor_name' => $mentor->name,
            'mentor_id' => $mentor->id,
            'subject' => $this_request->subject,
            'match_perc' => $this_request->match_perc,
            'enquiry' => $this_request->enquiry,    
            'status' => $this_request->status,
        ];
        return view('re-request', ['request'=>$callback]);
    }

    public function accept($id)
    {
        $new_session = MentorSession::create([
            'student_id' => $id,
            'tutor_id' => Auth::user()->id,
        ]);

        Requests::where('student_id', $id)->where('tutor_id', Auth::user()->id)->delete();
        $student = User::where('id',$id)->get()->pop();
        return redirect('tutor')->withErrors(['Request accepted from: '.$student->name]);
    }   

    public function decline($id)
    {
        Requests::where('student_id', $id)->where('tutor_id', Auth::user()->id)->update(['status' => 'Declined']);
        $student = User::where('id', $id)->get()->pop();
        return redirect('tutor')->withErrors(['Request declined from: '.$student->name]);
    }

    public function cancel($id)
    {
        Requests::where('id', $id)->delete();
        return redirect('studentview')->withErrors(['Request cancelled.']);
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
        $requestObj = Requests::where('tutor_id', $request->mentorid)->where('student_id', Auth::user()->id)->get()->pop();
        
        $sessionObj = MentorSession::where('tutor_id', $request->mentorid)->where('student_id', Auth::user()->id)->get()->pop();

        if($requestObj != null ) {
            return redirect('studentview')->withErrors(['You already made a request to that mentor!']);
        } else if($sessionObj != null ) {
            return redirect('studentview')->withErrors(['You are in a session with this mentor.']);
        } else {
            $subject = Subject::where('id', $request->subject)->get()->pop();

            $new_request = Requests::create([
                'student_id' => Auth::user()->id,
                'tutor_id' => $request->mentorid,
                'match_perc' => $request->match_perc,
                'subject' => $subject->name,
                'enquiry' => $request->enquiry,
                'status' => 'Pending',
            ]);

            $mentor = User::where('id', $new_request->tutor_id)->get()->pop();

            $callback = [
                'request_id' => $new_request->id,
                'mentor_name' => $mentor->name,
                'mentor_id' => $mentor->id,
                'match_perc' => $new_request->match_perc,
                'subject' => $new_request->subject,
                'enquiry' => $new_request->enquiry,
                'status' => $new_request->status,
            ];

            return view('re-request', ['request' => $callback, 'reqObj' => $requestObj]);
        }
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
