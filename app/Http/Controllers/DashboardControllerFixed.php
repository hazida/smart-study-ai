<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardControllerFixed extends Controller
{
    /**
     * Handle dashboard routing based on user role
     */
    public function index()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login');
            }
            
            // Route users to appropriate dashboard based on their role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                    
                case 'student':
                    return app(\App\Http\Controllers\Student\DashboardControllerSimple::class)->index();
                    
                case 'teacher':
                    // For now, redirect teachers to student dashboard
                    return app(\App\Http\Controllers\Student\DashboardControllerSimple::class)->index();
                    
                case 'parent':
                    // For now, redirect parents to student dashboard
                    return app(\App\Http\Controllers\Student\DashboardControllerSimple::class)->index();
                    
                default:
                    // Default to student dashboard for any other roles
                    return app(\App\Http\Controllers\Student\DashboardControllerSimple::class)->index();
            }
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Dashboard Routing Error: ' . $e->getMessage());
            
            // Fallback to original dashboard
            return view('dashboard');
        }
    }
}
