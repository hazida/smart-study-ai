@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')
    <div class="bg-slate-50 min-h-screen py-6 sm:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center w-10 h-10 text-slate-600 hover:text-slate-900 hover:bg-white rounded-lg transition-all duration-200 border border-slate-300 hover:border-slate-400 hover:shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m0 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Profile Settings</h1>
                            <p class="mt-1 text-slate-600">Manage your account settings and preferences</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="hidden sm:flex items-center space-x-3 px-4 py-2 bg-white rounded-lg border border-slate-200 shadow-sm">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-medium">{{ substr(session('user.name'), 0, 1) }}</span>
                            </div>
                            <div class="text-sm">
                                <p class="text-slate-700 font-medium">{{ session('user.name') }}</p>
                                <p class="text-slate-500">{{ session('user.email') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6 sm:space-y-8">
                @csrf

                <!-- Personal Information -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-slate-900">Personal Information</h3>
                                <p class="text-sm text-slate-500">Update your personal details and contact information</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Name -->
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                                    Full Name
                                </label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        value="{{ old('name', session('user.name')) }}"
                                        required
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('name') border-red-400 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                        placeholder="Enter your full name"
                                    >
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email', session('user.email')) }}"
                                        required
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('email') border-red-400 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                        placeholder="Enter your email address"
                                    >
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Security -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-slate-900">Password & Security</h3>
                                <p class="text-sm text-slate-500">Update your password to keep your account secure</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Current Password -->
                            <div class="sm:col-span-2">
                                <label for="current_password" class="block text-sm font-medium text-slate-700 mb-2">
                                    Current Password
                                </label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        name="current_password"
                                        id="current_password"
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('current_password') border-red-400 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                        placeholder="Enter your current password"
                                    >
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('current_password')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div>
                                <label for="new_password" class="block text-sm font-medium text-slate-700 mb-2">
                                    New Password
                                </label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        name="new_password"
                                        id="new_password"
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('new_password') border-red-400 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                        placeholder="Enter new password"
                                    >
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('new_password')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div>
                                <label for="new_password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">
                                    Confirm New Password
                                </label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        name="new_password_confirmation"
                                        id="new_password_confirmation"
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200"
                                        placeholder="Confirm new password"
                                    >
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-blue-800">Password Requirements</h4>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            <li>At least 6 characters long</li>
                                            <li>Leave blank to keep current password</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preferences -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-slate-900">Preferences</h3>
                                <p class="text-sm text-slate-500">Customize your experience and regional settings</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Timezone -->
                            <div>
                                <label for="timezone" class="block text-sm font-medium text-slate-700 mb-2">
                                    Timezone
                                </label>
                                <div class="relative">
                                    <select
                                        name="timezone"
                                        id="timezone"
                                        required
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('timezone') border-red-400 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                    >
                                        <option value="UTC" {{ old('timezone', 'UTC') == 'UTC' ? 'selected' : '' }}>UTC (Coordinated Universal Time)</option>
                                        <option value="America/New_York" {{ old('timezone') == 'America/New_York' ? 'selected' : '' }}>Eastern Time (ET)</option>
                                        <option value="America/Chicago" {{ old('timezone') == 'America/Chicago' ? 'selected' : '' }}>Central Time (CT)</option>
                                        <option value="America/Denver" {{ old('timezone') == 'America/Denver' ? 'selected' : '' }}>Mountain Time (MT)</option>
                                        <option value="America/Los_Angeles" {{ old('timezone') == 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time (PT)</option>
                                        <option value="Europe/London" {{ old('timezone') == 'Europe/London' ? 'selected' : '' }}>London (GMT)</option>
                                        <option value="Europe/Paris" {{ old('timezone') == 'Europe/Paris' ? 'selected' : '' }}>Paris (CET)</option>
                                        <option value="Asia/Tokyo" {{ old('timezone') == 'Asia/Tokyo' ? 'selected' : '' }}>Tokyo (JST)</option>
                                        <option value="Asia/Shanghai" {{ old('timezone') == 'Asia/Shanghai' ? 'selected' : '' }}>Shanghai (CST)</option>
                                        <option value="Australia/Sydney" {{ old('timezone') == 'Australia/Sydney' ? 'selected' : '' }}>Sydney (AEDT)</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('timezone')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Language -->
                            <div>
                                <label for="language" class="block text-sm font-medium text-slate-700 mb-2">
                                    Language
                                </label>
                                <div class="relative">
                                    <select
                                        name="language"
                                        id="language"
                                        required
                                        class="w-full px-4 py-3 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('language') border-red-400 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                    >
                                        <option value="en" {{ old('language', 'en') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="es" {{ old('language') == 'es' ? 'selected' : '' }}>Español</option>
                                        <option value="fr" {{ old('language') == 'fr' ? 'selected' : '' }}>Français</option>
                                        <option value="de" {{ old('language') == 'de' ? 'selected' : '' }}>Deutsch</option>
                                        <option value="it" {{ old('language') == 'it' ? 'selected' : '' }}>Italiano</option>
                                        <option value="pt" {{ old('language') == 'pt' ? 'selected' : '' }}>Português</option>
                                        <option value="ja" {{ old('language') == 'ja' ? 'selected' : '' }}>日本語</option>
                                        <option value="ko" {{ old('language') == 'ko' ? 'selected' : '' }}>한국어</option>
                                        <option value="zh" {{ old('language') == 'zh' ? 'selected' : '' }}>中文</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('language')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 border-b border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.868 19.718c.64.64 1.673.64 2.313 0l8.485-8.485c.64-.64.64-1.673 0-2.313l-8.485-8.485c-.64-.64-1.673-.64-2.313 0l-8.485 8.485c-.64.64-.64 1.673 0 2.313l8.485 8.485z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-slate-900">Notification Preferences</h3>
                                <p class="text-sm text-slate-500">Choose how you want to be notified about updates</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-4">
                            <!-- Email Notifications -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input
                                        id="notifications_email"
                                        name="notifications_email"
                                        type="checkbox"
                                        value="1"
                                        {{ old('notifications_email', true) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500/20 border-slate-300 rounded transition-all duration-200"
                                    >
                                </div>
                                <div class="ml-3">
                                    <label for="notifications_email" class="text-sm font-medium text-slate-700">
                                        Email Notifications
                                    </label>
                                    <p class="text-sm text-slate-500">Receive notifications about your account activity via email</p>
                                </div>
                            </div>

                            <!-- Browser Notifications -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input
                                        id="notifications_browser"
                                        name="notifications_browser"
                                        type="checkbox"
                                        value="1"
                                        {{ old('notifications_browser', true) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500/20 border-slate-300 rounded transition-all duration-200"
                                    >
                                </div>
                                <div class="ml-3">
                                    <label for="notifications_browser" class="text-sm font-medium text-slate-700">
                                        Browser Notifications
                                    </label>
                                    <p class="text-sm text-slate-500">Show notifications in your browser when you're online</p>
                                </div>
                            </div>

                            <!-- Marketing Notifications -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input
                                        id="notifications_marketing"
                                        name="notifications_marketing"
                                        type="checkbox"
                                        value="1"
                                        {{ old('notifications_marketing', false) ? 'checked' : '' }}
                                        class="h-4 w-4 text-blue-600 focus:ring-blue-500/20 border-slate-300 rounded transition-all duration-200"
                                    >
                                </div>
                                <div class="ml-3">
                                    <label for="notifications_marketing" class="text-sm font-medium text-slate-700">
                                        Marketing Communications
                                    </label>
                                    <p class="text-sm text-slate-500">Receive updates about new features, tips, and special offers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-3 sm:space-y-0">
                    <div class="text-sm text-slate-500">
                        <p>Changes will be saved to your account immediately.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                        <button
                            type="button"
                            onclick="window.location.reload()"
                            class="w-full sm:w-auto px-6 py-3 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 hover:border-slate-400 transition-all duration-200 font-medium text-center"
                        >
                            Reset Changes
                        </button>
                        <button
                            type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md transform hover:scale-[1.02] active:scale-[0.98]"
                        >
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Save Changes
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password field toggle functionality
    const currentPasswordField = document.getElementById('current_password');
    const newPasswordField = document.getElementById('new_password');
    const confirmPasswordField = document.getElementById('new_password_confirmation');

    // Show/hide password confirmation when new password is entered
    newPasswordField.addEventListener('input', function() {
        if (this.value.length > 0) {
            confirmPasswordField.closest('div').style.display = 'block';
            confirmPasswordField.required = true;
        } else {
            confirmPasswordField.closest('div').style.display = 'block'; // Keep visible for better UX
            confirmPasswordField.required = false;
        }
    });

    // Form validation feedback
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <span class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saving Changes...
            </span>
        `;

        // Re-enable after 3 seconds if form doesn't submit (for demo purposes)
        setTimeout(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = `
                <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Changes
                </span>
            `;
        }, 3000);
    });

    // Real-time validation for email
    const emailField = document.getElementById('email');
    emailField.addEventListener('blur', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isValid = emailRegex.test(this.value);

        if (!isValid && this.value.length > 0) {
            this.classList.add('border-red-400', 'focus:ring-red-500/20', 'focus:border-red-500');
            this.classList.remove('border-slate-300', 'focus:ring-blue-500/20', 'focus:border-blue-500');
        } else {
            this.classList.remove('border-red-400', 'focus:ring-red-500/20', 'focus:border-red-500');
            this.classList.add('border-slate-300', 'focus:ring-blue-500/20', 'focus:border-blue-500');
        }
    });

    // Password strength indicator
    newPasswordField.addEventListener('input', function() {
        const password = this.value;
        const strengthIndicator = document.getElementById('password-strength') || createPasswordStrengthIndicator();

        let strength = 0;
        let strengthText = '';
        let strengthColor = '';

        if (password.length >= 6) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        switch (strength) {
            case 0:
            case 1:
                strengthText = 'Very Weak';
                strengthColor = 'bg-red-500';
                break;
            case 2:
                strengthText = 'Weak';
                strengthColor = 'bg-orange-500';
                break;
            case 3:
                strengthText = 'Fair';
                strengthColor = 'bg-yellow-500';
                break;
            case 4:
                strengthText = 'Good';
                strengthColor = 'bg-blue-500';
                break;
            case 5:
                strengthText = 'Strong';
                strengthColor = 'bg-green-500';
                break;
        }

        if (password.length > 0) {
            strengthIndicator.style.display = 'block';
            strengthIndicator.querySelector('.strength-bar').className = `h-2 rounded-full transition-all duration-300 ${strengthColor}`;
            strengthIndicator.querySelector('.strength-bar').style.width = `${(strength / 5) * 100}%`;
            strengthIndicator.querySelector('.strength-text').textContent = strengthText;
        } else {
            strengthIndicator.style.display = 'none';
        }
    });

    function createPasswordStrengthIndicator() {
        const indicator = document.createElement('div');
        indicator.id = 'password-strength';
        indicator.className = 'mt-2';
        indicator.style.display = 'none';
        indicator.innerHTML = `
            <div class="flex items-center space-x-2">
                <div class="flex-1 bg-slate-200 rounded-full h-2">
                    <div class="strength-bar h-2 rounded-full transition-all duration-300 bg-red-500" style="width: 0%"></div>
                </div>
                <span class="strength-text text-xs text-slate-600">Very Weak</span>
            </div>
        `;
        newPasswordField.parentNode.appendChild(indicator);
        return indicator;
    }

    // Auto-save indication (visual feedback)
    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            // Show a subtle indication that changes are pending
            const saveButton = form.querySelector('button[type="submit"]');
            saveButton.classList.add('ring-2', 'ring-blue-300');
            setTimeout(() => {
                saveButton.classList.remove('ring-2', 'ring-blue-300');
            }, 1000);
        });
    });
});
</script>
@endpush
