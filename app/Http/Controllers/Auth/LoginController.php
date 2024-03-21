<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'email|required',
            'password'=>'required|string',
        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user=Auth::user();
            $token=$user->createToken('authToken')->plainTextToken;
            return redirect()->route('dashboard')->with('success', 'You have been successfully logged in.');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password. Please try again.')->withErrors(['msg' => 'Unauthenticated']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('login');
    }
}
