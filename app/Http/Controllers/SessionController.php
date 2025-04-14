<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the user input.
        $validatedAttributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to login the user - check email or password fails to match.
        $authStatus = Auth::attempt($validatedAttributes); // This returns a boolean

        if(!$authStatus) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, entered credentials does not match our records.',
            ]);
        }

        // Regenerate the Session token.
        request()->session()->regenerate();

        // Redirect to certain page.
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
