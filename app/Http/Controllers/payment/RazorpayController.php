<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\User;

class RazorpayController extends Controller
{
public function paymentPage()
{
$user = session('user_data');

$api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
$orderData = $api->order->create([
'receipt' => 'ADM_' . rand(1000, 9999),
'amount' => 50000, // Rs.500
'currency' => 'INR'
]);

session(['razorpay_order_id' => $orderData->id]);

return view('payment', [
'order_id' => $orderData->id,
'user' => $user,
'amount' => 500
]);
}

public function paymentSuccess(Request $request)
{
$data = session('user_data');

$user = User::create($data);

auth()->login($user); // Auto login after payment

session()->forget(['user_data', 'razorpay_order_id']);

return redirect('/home')->with('success', 'Registration & Payment Successful!');
}
}
