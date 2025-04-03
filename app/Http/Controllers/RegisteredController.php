<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class RegisteredController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],// Here the last data specifies that the email should be unique
                                                                   // in the users table specifically in the email column.
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $employeeAttributes = $request->validate([
            'employer' => ['required'],
            'logo' => ['required', File::types(['png', 'jpg', 'jpeg', 'webp', 'svg'])],
        ]);

        // Creates the user.
        $user = User::create($userAttributes);

        $logoPath = $request->logo->store('logos');

        // Creates the employer - because we are accessing the create method the below way it will automatically assign the user id to the employee record.
        $user->employer()->create([
            'name' => $employeeAttributes['employer'],
            'logo' => $logoPath,
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
