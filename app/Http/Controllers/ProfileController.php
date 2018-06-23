<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profiles.edit', ['user' => \Auth::user()]);
    }

    public function update(ProfileRequest $request)
    {
        $user = \Auth::user();
        $user->name = $request->input('name');
        $user->photo = $request->file('photo');
        $user->email = $request->input('email');

        if ($request->input('password')) {
            $user->password = $request->input('password');
        }
        $user->save();

        return redirect()->route('home');
    }
}
