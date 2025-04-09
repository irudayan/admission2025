<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home'; // Update if needed

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'     => ['required', 'string', 'max:100'],
            'last_name'      => ['required', 'string', 'max:100'],
            'dob'            => ['required', 'date'],
            'phone'          => ['required', 'digits:10', 'unique:users,phone'],
            'email'          => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'profile_image'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        $profileImagePath = null;

        if (isset($data['profile_image'])) {
            $image = $data['profile_image'];
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $profileImagePath = $image->storeAs('profile_images', $imageName, 'public');
        }

        return User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'dob'           => $data['dob'],
            'phone'         => $data['phone'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['phone']), // password = phone number
            'profile_image' => $profileImagePath,
        ]);
    }

    /**
     * Override register method to allow file handling
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $data = $request->all();
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image');
        }

        $user = $this->create($data);

        // Optional: Send email/SMS credentials

        // Optional: Redirect to payment
        // return redirect()->route('razorpay.payment', ['user_id' => $user->id]);

        // Auto login
        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }
}
