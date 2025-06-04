@extends('layouts.app')

@section('title', 'Dashboard - QuestionCraft')

@section('content')
    <div class="bg-slate-50 min-h-screen py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-sm">
                            <span class="text-white text-lg font-bold">{{ substr(session('user.name'), 0, 1) }}</span>
                        </div>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Welcome back, {{ session('user.name') }}!</h1>
                            <p class="text-slate-600 mt-1">Ready to create some amazing questions today?</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-6">
                        <div class="flex space-x-4 sm:space-x-6">
                            <div class="text-center bg-white rounded-lg p-4 border border-slate-200 shadow-sm">
                                <div class="text-2xl font-bold text-blue-600">0</div>
                                <div class="text-sm text-slate-500">Questions Created</div>
                            </div>
                            <div class="text-center bg-white rounded-lg p-4 border border-slate-200 shadow-sm">
                                <div class="text-2xl font-bold text-emerald-600">0</div>
                                <div class="text-sm text-slate-500">Documents Processed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <!-- Create Questions -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4 sm:p-6 hover:shadow-md transition-all duration-200 hover:border-blue-300">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-semibold text-slate-900 ml-3">Create Questions</h3>
                    </div>
                    <p class="text-slate-600 mb-4 text-sm sm:text-base">Upload your content and let AI generate questions automatically.</p>
                    <button class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-2.5 px-4 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-medium text-sm sm:text-base transform hover:scale-[1.02] active:scale-[0.98]">
                        Get Started
                    </button>
                </div>

                <!-- Question Bank -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4 sm:p-6 hover:shadow-md transition-all duration-200 hover:border-emerald-300">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-semibold text-slate-900 ml-3">Question Bank</h3>
                    </div>
                    <p class="text-slate-600 mb-4 text-sm sm:text-base">Browse and manage your saved questions and collections.</p>
                    <button class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2.5 px-4 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition-all duration-200 font-medium text-sm sm:text-base transform hover:scale-[1.02] active:scale-[0.98]">
                        View Bank
                    </button>
                </div>

                <!-- Analytics -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4 sm:p-6 hover:shadow-md transition-all duration-200 hover:border-purple-300 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-semibold text-slate-900 ml-3">Analytics</h3>
                    </div>
                    <p class="text-slate-600 mb-4 text-sm sm:text-base">Track performance and insights from your assessments.</p>
                    <button class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white py-2.5 px-4 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 font-medium text-sm sm:text-base transform hover:scale-[1.02] active:scale-[0.98]">
                        View Analytics
                    </button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                <div class="p-4 sm:p-6 border-b border-slate-200">
                    <h2 class="text-lg sm:text-xl font-semibold text-slate-900">Recent Activity</h2>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="text-center py-8 sm:py-12">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-medium text-slate-900 mb-2">No activity yet</h3>
                        <p class="text-slate-500 mb-4 text-sm sm:text-base">Start creating questions to see your activity here.</p>
                        <button class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2.5 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 font-medium text-sm sm:text-base transform hover:scale-[1.02] active:scale-[0.98]">
                            Create Your First Questions
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
