<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle dashboard routing based on user role
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Route users to appropriate dashboard based on their role
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
                
            case 'student':
                return app(\App\Http\Controllers\Student\DashboardController::class)->index();
                
            case 'teacher':
                // For now, redirect teachers to student dashboard
                // You can create a separate teacher dashboard later
                return app(\App\Http\Controllers\Student\DashboardController::class)->index();
                
            case 'parent':
                // For now, redirect parents to student dashboard
                // You can create a separate parent dashboard later
                return app(\App\Http\Controllers\Student\DashboardController::class)->index();
                
            default:
                // Default to student dashboard for any other roles
                return app(\App\Http\Controllers\Student\DashboardController::class)->index();
        }
    }
}
