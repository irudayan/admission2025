@extends('layouts.app')

@section('content')
    <div class="container login-wrapper">
        <div class="row login-box w-100">
            <!-- Left Info Column -->
            <div class="col-md-6 info-panel">
                <img style="height: 15%; width: 100%;" src="{{ asset('backend/images/logo/logo.png') }}" class="mb-3"
                    width="100" alt="Logo">

                <h3>WELCOME TO ADMISSION 2025 PORTAL</h3>
                <ol>
                    <li>Register using valid <strong>Email ID</strong> and Mobile No.</li>
                    <li>Upon successful Registration, you will receive a username and password in your Registered
                        Email..</li>
                    <li>Log in to the portal and provide your Personal Details upon completion click Save Details
                        button.</li>
                    <li>Provide Marks of Class X and XII, Aggregate percentage and other information in the Marks of X
                        and XII Tab then click on Next/Update Marks button.</li>
                    <li>Upload Scanned copies of your documents (as per specified file size and format; Passport Photo:
                        100 Kb, Others : 2 Mb Max ) in the Documents Tab.</li>

                    <li><strong style="color: #000;">Registration does not guarantee admission.</strong></li>
                </ol>

            </div>

            <!-- Right Login Form -->
            <div class="col-md-6 login-panel">
                <div class="text-center mb-4">
                    <h4>Login to Admission Portal</h4>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"
                            required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    {{-- <div class="mb-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            @endif
                        </div> --}}
                    <button type="submit" class="main_bt w-100">Sign In</button>
                    <div class="mt-3 text-center">
                        Not registered yet? <a href="#">Register here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
