@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Step Progress Bar -->
        <div class="progress mb-4">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Step 4 of 4</div>
        </div>

        <h2>Confirmation</h2>
        <p><strong>Name:</strong> {{ $userData['name'] }}</p>
        <p><strong>Email:</strong> {{ $userData['email'] }}</p>
        <p><strong>Phone:</strong> {{ $userData['phone_number'] }}</p>
        <p><strong>Subscription Type:</strong> {{ $userData['subscription_type'] }}</p>
        <p><strong>Address Line 1:</strong> {{ $userData['address_line_1'] }}</p>
        <p><strong>Address Line 2:</strong> {{ $userData['address_line_2'] ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $userData['city'] }}</p>
        <p><strong>Postal Code:</strong> {{ $userData['postal_code'] }}</p>
        <p><strong>State:</strong> {{ $userData['state'] }}</p>
        <p><strong>Country:</strong> {{ $userData['country'] }}</p>

        @if(isset($userData['credit_card_number']))
            <p><strong>Credit Card:</strong> **** **** **** {{ substr($userData['credit_card_number'], -4) }}</p>
        @endif

        <form method="POST" action="{{ route('register.complete') }}">
            @csrf
            <button type="submit" class="btn btn-success">Complete Registration</button>
        </form>
    </div>
@endsection
