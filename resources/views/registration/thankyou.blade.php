@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body text-center">
                <h2 class="mb-4 text-success">Thank You for Your Subscription!</h2>
                <p class="lead">We appreciate your registration and subscription to our service. Your registration has been successfully completed.</p>
                <p>Enjoy all the premium features that come with your subscription and start exploring StreamPlus now!</p>
                <a href="{{ url('/register/') }}" class="btn btn-primary btn-lg mt-3">Go to Homepage</a>
            </div>
        </div>
    </div>
@endsection
