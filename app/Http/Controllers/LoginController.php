<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller
{

    public function index(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
 
            return redirect('/');
        }else{
            return redirect('/gagal');
            // return back()->with('errMes', "Username/Email atau Password Salah!");
        }

        return back()->withErrors([
            'errMes' => 'The provided credentials do not match our records.',
        ])->onlyInput('uername');
    }

    public function createUser(Request $request){

        $validator = Validator::make($request->all(), [
            'fullName' => 'required',
            'username' => 'required|unique:posts|max:255',
            'password' => 'required',
        ]);

        $users = new User;
        $users->name = $request->fullName;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->phoneNumber = $request->phoneNumber;

        $users->save();

        return redirect('/login')->with('status', 'Data Berhasil Ditambahkan!');
    }

}
