@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Step Progress Bar -->
        <div class="progress mb-4">
            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Step 2 of 4</div>
        </div>

        <h2>Step 2: Address Information</h2>
        <form method="POST" action="{{ route('register.step2.post') }}">
            @csrf

            <div class="mb-3">
                <label for="address_line_1" class="form-label">Address Line 1</label>
                <input type="text" name="address_line_1" class="form-control"
                       id="address_line_1"
                       value="{{ old('address_line_1', Session::get('user_data.address_line_1')) }}"
                       placeholder="Enter your address line 1">
                @error('address_line_1') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="address_line_2" class="form-label">Address Line 2 (Optional)</label>
                <input type="text" name="address_line_2" class="form-control"
                       id="address_line_2"
                       value="{{ old('address_line_2', Session::get('user_data.address_line_2')) }}"
                       placeholder="Enter your address line 2">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" class="form-control"
                       id="city"
                       value="{{ old('city', Session::get('user_data.city')) }}"
                       placeholder="Enter your city">
                @error('city') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="postal_code" class="form-label">Postal Code</label>
                <input type="text" name="postal_code" class="form-control"
                       id="postal_code"
                       value="{{ old('postal_code', Session::get('user_data.postal_code')) }}"
                       placeholder="Enter your postal code">
                @error('postal_code') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select name="country" id="country" class="form-control">
                    <option value="">Select your country</option>
                    <option value="US" {{ old('country', Session::get('user_data.country')) == 'US' ? 'selected' : '' }}>United States</option>
                    <option value="CA" {{ old('country', Session::get('user_data.country')) == 'CA' ? 'selected' : '' }}>Canada</option>
                    <option value="IN" {{ old('country', Session::get('user_data.country')) == 'IN' ? 'selected' : '' }}>India</option>
                    <!-- TODO: Add more countries as needed -->
                </select>
                @error('country') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3" id="state-container">
                <label for="state" class="form-label">State/Province</label>
                <select name="state" id="state" class="form-control">
                    <!-- TODO: Add more state/province options that will be dynamically inserted here based on the selected country -->
                </select>
                @error('state') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const country = "{{ old('country', Session::get('user_data.country')) }}";
            const state = "{{ old('state', Session::get('user_data.state')) }}";
            const stateSelect = document.getElementById('state');

            function populateStates(country) {
                stateSelect.innerHTML = '';
                if (country === 'US') {
                    stateSelect.innerHTML = '<option value="">Select your state</option>' +
                        '<option value="NY">New York</option>' +
                        '<option value="CA">California</option>' +
                        '<option value="TX">Texas</option>';
                } else if (country === 'CA') {
                    stateSelect.innerHTML = '<option value="">Select your province</option>' +
                        '<option value="ON">Ontario</option>' +
                        '<option value="QC">Quebec</option>' +
                        '<option value="BC">British Columbia</option>';
                } else if (country === 'IN') {
                    stateSelect.innerHTML = '<option value="">Select your state</option>' +
                        '<option value="DL">Delhi</option>' +
                        '<option value="MH">Maharashtra</option>' +
                        '<option value="TN">Tamil Nadu</option>';
                } else {
                    stateSelect.innerHTML = '<option value="">State/Province not required</option>';
                }
            }

            document.getElementById('country').addEventListener('change', function () {
                populateStates(this.value);
            });

            if (country) {
                populateStates(country);
                stateSelect.value = state;
            }
        });
    </script>
@endsection
