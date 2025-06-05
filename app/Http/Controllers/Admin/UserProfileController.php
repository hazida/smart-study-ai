<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UserProfile::with('user');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by completion status
        if ($request->filled('completion')) {
            if ($request->completion === 'complete') {
                $query->whereNotNull('first_name')
                      ->whereNotNull('last_name')
                      ->whereNotNull('date_of_birth');
            } elseif ($request->completion === 'incomplete') {
                $query->where(function($q) {
                    $q->whereNull('first_name')
                      ->orWhereNull('last_name')
                      ->orWhereNull('date_of_birth');
                });
            }
        }

        $profiles = $query->orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.user-profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::doesntHave('profile')->orderBy('name')->get();

        return view('admin.user-profiles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id|unique:user_profiles',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date|before:today',
            'phone_number' => 'nullable|string|max:50|unique:user_profiles',
            'profile_picture_url' => 'nullable|url|max:255',
            'bio' => 'nullable|string|max:1000',
            'preferred_language' => 'nullable|string|max:10',
            'timezone' => 'nullable|string|max:50',
        ]);

        UserProfile::create([
            'profile_id' => (string) Str::uuid(),
            'user_id' => $validated['user_id'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'phone_number' => $validated['phone_number'],
            'profile_picture_url' => $validated['profile_picture_url'],
            'bio' => $validated['bio'],
            'preferred_language' => $validated['preferred_language'] ?? 'en',
            'timezone' => $validated['timezone'],
        ]);

        return redirect()->route('admin.user-profiles.index')
                        ->with('success', 'User profile created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        $userProfile->load('user');

        $stats = [
            'completion_percentage' => $userProfile->getCompletionPercentage(),
            'is_complete' => $userProfile->isComplete(),
            'age' => $userProfile->age,
            'full_name' => $userProfile->full_name,
            'initials' => $userProfile->initials,
        ];

        return view('admin.user-profiles.show', compact('userProfile', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        $userProfile->load('user');

        return view('admin.user-profiles.edit', compact('userProfile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        $validated = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date|before:today',
            'phone_number' => 'nullable|string|max:50|unique:user_profiles,phone_number,' . $userProfile->profile_id . ',profile_id',
            'profile_picture_url' => 'nullable|url|max:255',
            'bio' => 'nullable|string|max:1000',
            'preferred_language' => 'nullable|string|max:10',
            'timezone' => 'nullable|string|max:50',
        ]);

        $userProfile->update($validated);

        return redirect()->route('admin.user-profiles.index')
                        ->with('success', 'User profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        $userProfile->delete();

        return redirect()->route('admin.user-profiles.index')
                        ->with('success', 'User profile deleted successfully.');
    }

    /**
     * Get profile statistics.
     */
    public function statistics()
    {
        $totalUsers = User::count();
        $profilesCount = UserProfile::count();
        $completeProfiles = UserProfile::whereNotNull('first_name')
                                      ->whereNotNull('last_name')
                                      ->whereNotNull('date_of_birth')
                                      ->count();

        $stats = [
            'total_users' => $totalUsers,
            'profiles_created' => $profilesCount,
            'profiles_missing' => $totalUsers - $profilesCount,
            'complete_profiles' => $completeProfiles,
            'incomplete_profiles' => $profilesCount - $completeProfiles,
            'completion_rate' => $profilesCount > 0 ? round(($completeProfiles / $profilesCount) * 100, 2) : 0,
        ];

        return view('admin.user-profiles.statistics', compact('stats'));
    }
}
