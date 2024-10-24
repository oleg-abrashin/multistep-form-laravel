<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class RegistrationController extends Controller
{
    // Show Step 1
    public function showStep1(): View|Factory|Application
    {
        return view('registration.step1');
    }

    // Handle Step 1 form submission
    public function postStep1(Request $request): RedirectResponse
    {
        Log::info('Form submitted data: ', $request->all());

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|numeric|digits:10',
            'subscription_type' => 'required',
        ]);

        Session::put('user_data', array_merge(Session::get('user_data', []), $validatedData));
        Log::info('User data in session: ', Session::get('user_data'));

        return redirect()->route('register.step2');
    }


    // Show Step 2
    public function showStep2()
    {
        Log::info('Session data on step 2: ', Session::get('user_data'));
        return view('registration.step2');
    }


    // Handle Step 2 form submission
    public function postStep2(Request $request)
    {
        $validatedData = $request->validate([
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string',
            'state' => function($attribute, $value, $fail) use ($request) {
                if ($request->country == 'US' && empty($value)) {
                    $fail('The state field is required for United States.');
                }
                if ($request->country == 'CA' && empty($value)) {
                    $fail('The province field is required for Canada.');
                }
            },
        ]);

        // Log for debugging
        Log::info('Address data validated: ', $validatedData);

        // Store in session
        Session::put('user_data', array_merge(Session::get('user_data', []), $validatedData));
        Log::info('User data in session after step 2: ', Session::get('user_data'));

        // Redirect based on subscription type
        if (Session::get('user_data')['subscription_type'] === 'premium') {
            return redirect()->route('register.step3');
        }

        return redirect()->route('register.confirmation');
    }


    // Show Step 3 (Payment)
    public function showStep3()
    {
        return view('registration.step3');
    }

    // Handle Step 3 form submission (for premium users)
    public function postStep3(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'credit_card_number' => 'required|digits:16',
            'expiration_date' => 'required|date_format:m/y|after:today',
            'cvv' => 'required|digits:3',
        ]);

        // Store in session
        Session::put('user_data', array_merge(Session::get('user_data', []), $validatedData));

        return redirect()->route('register.confirmation');
    }


    // Show confirmation page
    public function showConfirmation()
    {
        $userData = Session::get('user_data');
        return view('registration.confirmation', compact('userData'));
    }

    // Handle final submission
    public function completeRegistration(Request $request)
    {
        $userData = Session::get('user_data');

        if (!$userData) {
            return redirect()->route('register.step1');
        }

        // Create the user
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'phone_number' => $userData['phone_number'],
            'subscription_type' => $userData['subscription_type'],
            'password' => Hash::make('password123'),
            'address_line_1' => $userData['address_line_1'],
            'address_line_2' => $userData['address_line_2'],
            'city' => $userData['city'],
            'postal_code' => $userData['postal_code'],
            'state' => $userData['state'],
            'country' => $userData['country'],
            'credit_card_number' => $userData['subscription_type'] === 'premium' ? $userData['credit_card_number'] : null,
            'expiration_date' => $userData['subscription_type'] === 'premium' ? $userData['expiration_date'] : null,
            'cvv' => $userData['subscription_type'] === 'premium' ? $userData['cvv'] : null,
        ]);

        // Clear session data after registration
        Session::forget('user_data');

        // Redirect to thank you page
        return redirect()->route('register.complete')->with('status', 'Registration complete!');
    }

    public function showThankYouPage(): View|Factory|Application
    {
        return view('registration.thankyou');
    }

}

