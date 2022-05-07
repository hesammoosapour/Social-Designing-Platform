<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|min:10|max:11|regex:/^([0-9\s\-\+\(\)]*)$/',
            'username'=>'required|unique:users|string|max:40|regex:/^[a-zA-Z0-9 ]+$/'
        ]);
        if (strlen($request->phone) >= 12) {
            return back()->withInput()->withErrors('شماره همراه حداکثر 11 رقم است.');
        }

        if (strlen($request->phone) == 11) {
            if (substr($request->phone, 0, 1) != 0 ) {
               return back()->withInput()->withErrors('شماره همراه اشتباه است.');
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'username'=>$request->username,
        ]);

        // assign role Subscriber to new user
        $user->assignRole('Subscriber');
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
