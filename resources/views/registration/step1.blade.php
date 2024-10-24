@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Step Progress Bar -->
        <div class="progress mb-4">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Step 1 of 4</div>
        </div>

        <h2>Step 1: User Information</h2>
        <form method="POST" action="{{ route('register.step1.post') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required placeholder="Enter your full name">
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required placeholder="Enter your email">
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number') }}" required placeholder="Enter your phone number">
                @error('phone_number') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="subscription_type" class="form-label">Subscription Type</label>
                <select name="subscription_type" class="form-select" id="subscription_type" required>
                    <option value="">Select a subscription type</option>
                    <option value="free" {{ old('subscription_type') === 'free' ? 'selected' : '' }}>Free</option>
                    <option value="premium" {{ old('subscription_type') === 'premium' ? 'selected' : '' }}>Premium</option>
                </select>
                @error('subscription_type') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>
@endsection
