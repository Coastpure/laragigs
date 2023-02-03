<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;

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

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    //Show reset pass form
    public function resetpass(Request $token)
    {
        return view('users.resetpass', ['token' => $token]);
    }
}
