<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Simple demo authentication - in production, use proper database authentication
        $demoUsers = [
            'admin@questioncraft.com' => 'password123',
            'demo@questioncraft.com' => 'demo123',
            'test@questioncraft.com' => 'test123'
        ];

        if (isset($demoUsers[$credentials['email']]) &&
            $demoUsers[$credentials['email']] === $credentials['password']) {

            // Store user info in session
            $request->session()->put('user', [
                'id' => 1,
                'name' => 'Demo User',
                'email' => $credentials['email']
            ]);

            $request->session()->regenerate();

            return redirect()->intended('/dashboard')->with('success', 'Welcome back!');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required', 'accepted'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Store user info in session (demo implementation)
        $request->session()->put('user', [
            'id' => rand(1000, 9999),
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect('/dashboard')->with('success', 'Account created successfully! Welcome to QuestionCraft.');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
