<?php

namespace Siacme\Http\Controllers\Auth;

// use Usuarios;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\AuthenticatesAndRegistersUsers as AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\ThrottlesLogins as ThrottlesLogins;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/';

    // public function authenticate()
    // {
    //     if (Usuarios::attempt(['Username' => $Username, 'Passwd' => $Passwd])) {
    //         // Authentication passed...
    //         return redirect()->intended('/');
    //     }
    // }

    // public function getLogin()
    // {
    //     return view('auth.login');
    // }

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'txtUsername' => 'required|email|max:255|unique:users',
            'txtPassword' => 'required|confirmed|min:6',
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
        return User::create([
            'Nombre'  => $data['Nombre'],
            'Paterno' => $data['Paterno'],
            'Passwd'  => bcrypt($data['Passwd']),
        ]);
    }
}
