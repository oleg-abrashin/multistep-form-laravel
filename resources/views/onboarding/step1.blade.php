@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Step 1: User Information</h2>
        <form method="POST" action="{{ route('onboarding.step1') }}" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
                @error('phone_number') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="subscription_type" class="form-label">Subscription Type</label>
                <select class="form-select" name="subscription_type" id="subscription_type" required>
                    <option value="free">Free</option>
                    <option value="premium">Premium</option>
                </select>
                @error('subscription_type') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>
@endsection
