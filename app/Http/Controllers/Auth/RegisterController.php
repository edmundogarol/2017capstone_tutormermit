<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Academic;
use App\Preference;
use App\Http\Controllers\AcadController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $acad = Academic::create([
            'subjects' => '{}',
            'student_rating' => 0,
            'tutor_rating' => 0,
        ]);

        $prefs = Preference::create([
            'subjects' => '{}',
            'min_age' => 0,
            'max_age' => 200,
            'gender' => '',
        ]);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => '',
            'academic_id' => $acad->id,
            'birthday' => date('1900-01-01'),
            'active' => true,
            'session' => 0,
            'tutor' => false,
            'preferences_id' => $prefs->id,
            'password' => bcrypt($data['password']),
        ]);
    }
}
