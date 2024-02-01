<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create() {
        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required','email', 'unique:users,email'],
            'password' => 'required|between:3,255|confirmed',
        ]);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended('/books');
        }
    }
}