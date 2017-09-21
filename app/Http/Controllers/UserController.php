<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Preference;
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
        ]);
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

        return view('preferences', ['preferences' => $user_preferences]);
    }
}
