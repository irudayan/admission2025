@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-center">Complete Your Payment</h3>
    <form action="{{ route('razorpay.success') }}" method="POST">
        @csrf
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ env('RAZORPAY_KEY') }}"
                data-amount="50000"
                data-currency="INR"
                data-order_id="{{ $order_id }}"
                data-buttontext="Pay ₹500"
                data-name="Admission Portal"
                data-description="Admission Fee"
                data-prefill.name="{{ $user['name'] }}"
                data-prefill.email="{{ $user['email'] }}"
                data-prefill.contact="{{ $user['phone'] }}"
                data-theme.color="#2c97ea">
        </script>
        <input type="hidden" name="hidden">
    </form>
</div>
@endsection
