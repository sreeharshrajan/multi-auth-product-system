<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Show the customer login form.
     */
    public function showLoginForm()
    {
        return view('customer.auth.login');
    }

    /**
     * Show the customer registration form.
     */
    public function showRegisterForm()
    {
        return view('customer.auth.register');
    }

    /**
     * Handle customer registration request.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['is_active'] = true;

        $customer = \App\Models\Customer::create($data);

        Auth::guard('customer')->login($customer);
        $request->session()->regenerate();
        return redirect()->route('customer.dashboard');
    }

    /**
     * Handle customer login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('customer')->attempt($credentials, $remember)) {
            $customer = Auth::guard('customer')->user();

            // Check if customer account is active
            if (!$customer->isActive()) {
                Auth::guard('customer')->logout();
                return back()->withErrors([
                    'email' => 'Your account has been deactivated.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle customer logout request.
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.login');
    }
}
