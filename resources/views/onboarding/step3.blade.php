@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Step 3: Payment Information</h2>
        <form method="POST" action="{{ route('onboarding.step3') }}" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="credit_card_number" class="form-label">Credit Card Number</label>
                <input type="text" class="form-control" name="credit_card_number" id="credit_card_number" value="{{ old('credit_card_number') }}" required>
                @error('credit_card_number') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="expiration_date" class="form-label">Expiration Date (MM/YY)</label>
                <input type="text" class="form-control" name="expiration_date" id="expiration_date" value="{{ old('expiration_date') }}" required>
                @error('expiration_date') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" name="cvv" id="cvv" value="{{ old('cvv') }}" required>
                @error('cvv') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>
@endsection
