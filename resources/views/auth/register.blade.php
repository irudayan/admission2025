@extends('layouts.app')

@section('content')
<div class="container-fluid login-wrapper">
    <div class="row login-box">
        <!-- Left Info Column -->
        <div class="col-md-6 info-panel d-flex flex-column">
            <div class="logo-container mb-4">
                <img src="{{ asset('backend/images/logo/logo.png') }}" class="img-fluid" alt="Logo">
            </div>
            <div class="content-container">
                <h3>WELCOME TO ADMISSION 2025 PORTAL</h3>
                <ol>
                    <li>Register using valid <strong>Email ID</strong> and Mobile No.</li>
                    <li>Upon successful Registration, you will receive a username and password in your Registered
                        Email.</li>
                    <li>Log in to the portal and provide your Personal Details upon completion click Save Details
                        button.</li>
                    <li>Provide Marks of Class X and XII, Aggregate percentage and other information in the Marks of X
                        and XII Tab then click on Next/Update Marks button.</li>
                    <li>Upload Scanned copies of your documents (as per specified file size and format; Passport Photo:
                        100 Kb, Others : 2 Mb Max ) in the Documents Tab.</li>
                    <li><strong style="color: #000;">Registration does not guarantee admission.</strong></li>
                </ol>
            </div>
        </div>

        <!-- Right Register Form -->
        <div class="col-md-6 login-panel d-flex align-items-center">
            <div class="w-100 px-4">
                <div class="text-center mb-4">
                    <h4>Registration Admission Portal</h4>
                </div>
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input id="dob" type="date" class="form-control" name="dob" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" type="email" class="form-control" name="email" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Mobile No. <strong>(10 Digits)</strong></label>
                            <input id="phone" type="text" class="form-control" name="phone" maxlength="10" required oninput="setPassword(this.value)">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="text" class="form-control" name="password" readonly required>
                        </div>

                    </div>

                    {{-- <div class="mb-3">
                        <label for="phone" class="form-label">Mobile No. <strong>(10 Digits)</strong></label>
                        <input id="phone" type="text" class="form-control" name="phone" maxlength="10" required oninput="setPassword(this.value)">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="text" class="form-control" name="password" readonly required>
                    </div> --}}

                    {{-- <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="text" class="form-control" name="password_confirmation" readonly required>
                    </div> --}}

                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Profile Image</label>
                        <input id="profile_image" type="file" class="form-control" name="profile_image">
                    </div>

                    <button type="submit" class="main_bt w-100">Proceed to Payment</button>
                    <div class="mt-3 text-center">
                        Already have an account? <a href="{{ route('login') }}">Login here</a>
                    </div>
                </form>

                <script>
                    function setPassword(phone) {
                        document.getElementById('password').value = phone;
                        document.getElementById('password_confirmation').value = phone;
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
