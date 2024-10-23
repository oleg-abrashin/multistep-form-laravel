<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegistrationController;

Route::get('register', [RegistrationController::class, 'showStep1'])->name('register.step1');
Route::post('register/step1', [RegistrationController::class, 'postStep1'])->name('register.postStep1');

Route::get('register/step2', [RegistrationController::class, 'showStep2'])->name('register.step2');
Route::post('register/step2', [RegistrationController::class, 'postStep2'])->name('register.postStep2');

Route::get('register/step3', [RegistrationController::class, 'showStep3'])->name('register.step3');
Route::post('register/step3', [RegistrationController::class, 'postStep3'])->name('register.postStep3');

Route::get('register/confirmation', [RegistrationController::class, 'showConfirmation'])->name('register.confirmation');

