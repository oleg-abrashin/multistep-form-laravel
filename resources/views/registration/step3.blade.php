@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Step Progress Bar -->
        <div class="progress mb-4">
            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">Step 3 of 4</div>
        </div>

        <h2>Step 3: Payment Information</h2>
        <form method="POST" action="{{ route('register.step3.post') }}">
            @csrf

            <div class="mb-3">
                <label for="credit_card_number" class="form-label">Credit Card Number</label>
                <input type="text" name="credit_card_number" class="form-control"
                       id="credit_card_number"
                       value="{{ old('credit_card_number', Session::get('user_data.credit_card_number')) }}"
                       placeholder="Enter your credit card number">
                @error('credit_card_number') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="expiration_date" class="form-label">Expiration Date (MM/YY)</label>
                <input type="text" name="expiration_date" class="form-control"
                       id="expiration_date"
                       value="{{ old('expiration_date', Session::get('user_data.expiration_date')) }}"
                       placeholder="Enter the expiration date (MM/YY)">
                @error('expiration_date') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" name="cvv" class="form-control"
                       id="cvv"
                       value="{{ old('cvv', Session::get('user_data.cvv')) }}"
                       placeholder="Enter your CVV">
                @error('cvv') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>
@endsection
