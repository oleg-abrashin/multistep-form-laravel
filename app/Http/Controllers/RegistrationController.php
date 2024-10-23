<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function showStep1()
    {
        return view('registration.step1');
    }

    public function postStep1(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:10',
            'subscription_type' => 'required',
        ]);

        // Store data in session or database, and redirect to Step 2
        session()->put('user', $validatedData);

        return redirect()->route('register.step2');
    }

}
