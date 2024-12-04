<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpAuthController extends Controller
{
    //
    public function signin()
    {
        return view('app.auth.signin');
    }
    public function signup()
    {
        return view('app.auth.signup');
    }


    public function signInFunction(Request $request)
    {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required'],]);
        $user = Employee::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            session(['emp_id' => $user->id]);
            return redirect()->intended('/app/home')->with('success', 'Signed in successfully');
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.',])->onlyInput('email');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = Employee::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('app.home')->with('success', 'User created successfully');
    }

    /** * Handle sign-out request. */ public function destroy(Request $request)
    {
        session()->forget('emp_id');
        return redirect('/app/signin')->with('success', 'Signed out successfully');
    }
}
