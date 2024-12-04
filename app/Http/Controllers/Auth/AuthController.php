<?php


namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function signin()
    {
        return view('auth.signin');
    }
    public function signup()
    {
        return view('auth.signup');
    }


    public function signInFunction(Request $request)
    {
        $credentials = $request->validate(['email' => ['required', 'email'], 'password' => ['required'],]);
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            session(['user_id' => $user->id]);
            return redirect()->intended('home')->with('success', 'Signed in successfully');
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

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return redirect()->route('home')->with('success', 'User created successfully');
    }

    /** * Handle sign-out request. */ public function destroy(Request $request)
    {
        session()->forget('user_id');
        return redirect('/signin')->with('success', 'Signed out successfully');
    }
}
