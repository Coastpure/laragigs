<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class UserController extends Controller
{
    //Show Register/Register Form
    public function register()
    {
        return view('users.register');
    }

    //Register New User
    public function store(Request $request)
    {
        //validation
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }


    //logout User
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    //Show Login Form
    public function login()
    {
        return view('users.login');
    }

    //Authenticate User, this is when the user is logging in
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([

            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => "Invalid Credentials"])->onlyInput('email');
    }


    //Show forgot Form
    public function forgot()
    {
        return view('users.forgot');
    }


    //Password forgot handle form submission
    public function forgotPassword(Request $request)
    {
        // validate input email
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        //return back()->with('message', 'Password reset link sent');
    

        return $status === Password::RESET_LINK_SENT
            ? back()->with('message', 'Password reset link sent to email')
            : back()->withErrors(['email' => __($status)]);
    }


    //Show reset pass form
    public function resetpassform($token)
    {
        return view('users.resetpass', ['token' => $token]);
    }


    //Reset the password and submit
    public function resetpass(Request $request){
          // validate the token, email and password
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);


        /*If the token, email address, and password given to the password broker are valid, the closure passed to the reset method will be invoked.*/
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            } 
        );

        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('message', 'Password reset succesfully')
                : back()->withErrors(['email' => [__($status)]]);

    }

}
