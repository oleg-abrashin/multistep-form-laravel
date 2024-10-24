<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// Redirect the base URL to /register/step1
Route::get('/', function () {
    return redirect()->route('register.step1');
});

Route::redirect('/register', '/register/step1');

// Step 1 (User Information)
Route::get('register/step1', [RegistrationController::class, 'showStep1'])->name('register.step1');
Route::post('register/step1', [RegistrationController::class, 'postStep1'])->name('register.step1.post');

// Step 2 (Address Information)
Route::get('register/step2', [RegistrationController::class, 'showStep2'])->name('register.step2');
Route::post('register/step2', [RegistrationController::class, 'postStep2'])->name('register.step2.post');

// Step 3 (Payment Information - for premium users)
Route::get('register/step3', [RegistrationController::class, 'showStep3'])->name('register.step3');
Route::post('register/step3', [RegistrationController::class, 'postStep3'])->name('register.step3.post');

// Confirmation
Route::get('register/confirmation', [RegistrationController::class, 'showConfirmation'])->name('register.confirmation');
Route::post('register/complete', [RegistrationController::class, 'completeRegistration'])->name('register.complete');

// Thank you page route
Route::get('register/complete', [RegistrationController::class, 'showThankYouPage'])->name('register.complete');

