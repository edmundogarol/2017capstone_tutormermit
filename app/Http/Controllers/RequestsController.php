<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    public function req($id)
    {
        $mentor_id = $id;
        $mentor = User::where('id', $mentor_id)->get()->pop();
        return view('request', ['mentor'=>$mentor]);
    }

    public function reqsend(array $data)
    {
        $mentor_id = $data->id;
        $mentor = User::where('id', $mentor_id)->get()->pop();
        return view('re-request', ['mentor'=>$mentor]);
    }
}
