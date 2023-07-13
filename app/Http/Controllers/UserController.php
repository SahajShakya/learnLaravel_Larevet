<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show register/create form
    public function create() {
        return view('users.register');
    }
    //login
    public function store(Request $request) {
        $formFeilds = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required','email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6',
        ]);
        //hash password
        $formFeilds['password'] = bcrypt($formFeilds['password']);
        //Create User
        $user = User::create($formFeilds);
        //Login
        auth()->login($user);
        return redirect('/')->with('message','User created and login');
    }

    //logout
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','User Logout Sucessfully');
    }

}
