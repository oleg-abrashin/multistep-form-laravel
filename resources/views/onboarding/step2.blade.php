@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Step 2: Address Information</h2>
        <form method="POST" action="{{ route('onboarding.step2') }}" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="address_line_1" class="form-label">Address Line 1</label>
                <input type="text" class="form-control" name="address_line_1" id="address_line_1" value="{{ old('address_line_1') }}" required>
                @error('address_line_1') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="address_line_2" class="form-label">Address Line 2 (Optional)</label>
                <input type="text" class="form-control" name="address_line_2" id="address_line_2" value="{{ old('address_line_2') }}">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}" required>
                @error('city') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="postal_code" class="form-label">Postal Code</label>
                <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required>
                @error('postal_code') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" name="state" id="state" value="{{ old('state') }}" required>
                @error('state') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" name="country" id="country" required>
                    <option value="">Select your country</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <!-- Add more countries as needed -->
                </select>
                @error('country') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>
@endsection
