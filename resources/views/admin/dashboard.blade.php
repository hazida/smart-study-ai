@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="mb-8">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold mb-2">Welcome back, {{ session('user.name') }}!</h1>
                            <p class="text-blue-100">Here's what's happening with your platform today.</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('admin.enhanced.dashboard') }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-colors">
                                <i class="fas fa-database mr-2"></i>Enhanced CRUD Dashboard
                            </a>
                            <div class="hidden lg:block">
                                <div class="text-right">
                                    <p class="text-blue-100 text-sm">Last login</p>
                                    <p class="text-white font-medium">{{ now()->format('M d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Key Metrics -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                <!-- Total Users -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-slate-600">Total Users</p>
                            <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_users']) }}</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs text-emerald-600 font-medium">+{{ $stats['users_growth'] }}%</span>
                                <span class="text-xs text-slate-500 ml-1">vs last month</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-xs text-slate-500 mb-1">
                            <span>Active Users</span>
                            <span>{{ $stats['active_users'] }}</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($stats['active_users'] / $stats['total_users']) * 100 }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Total Questions -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-slate-600">Total Questions</p>
                            <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_questions']) }}</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs text-emerald-600 font-medium">+{{ $stats['questions_today'] }}</span>
                                <span class="text-xs text-slate-500 ml-1">generated today</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-xs text-slate-500 mb-1">
                            <span>This Week</span>
                            <span>{{ $stats['questions_week'] }}</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-emerald-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>

                <!-- Documents Processed -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-slate-600">Documents</p>
                            <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_documents']) }}</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs text-purple-600 font-medium">{{ $stats['processing_rate'] }}%</span>
                                <span class="text-xs text-slate-500 ml-1">success rate</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-xs text-slate-500 mb-1">
                            <span>Processing</span>
                            <span>{{ $stats['documents_processing'] }}</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $stats['processing_rate'] }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Revenue -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-slate-600">Monthly Revenue</p>
                            <p class="text-2xl font-bold text-slate-900">${{ number_format($stats['monthly_revenue']) }}</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs text-emerald-600 font-medium">+{{ $stats['revenue_growth'] }}%</span>
                                <span class="text-xs text-slate-500 ml-1">vs last month</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-xs text-slate-500 mb-1">
                            <span>Target</span>
                            <span>${{ number_format($stats['revenue_target']) }}</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-amber-600 h-2 rounded-full" style="width: {{ ($stats['monthly_revenue'] / $stats['revenue_target']) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl p-6 text-white cursor-pointer hover:from-blue-600 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Manage</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">User Management</h3>
                    <p class="text-blue-100 text-sm">View and manage all users</p>
                </div>

                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl p-6 text-white cursor-pointer hover:from-emerald-600 hover:to-teal-700 transition-all duration-200 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">View</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Analytics</h3>
                    <p class="text-emerald-100 text-sm">Platform insights & reports</p>
                </div>

                <div class="bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl p-6 text-white cursor-pointer hover:from-purple-600 hover:to-pink-700 transition-all duration-200 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Configure</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Settings</h3>
                    <p class="text-purple-100 text-sm">System configuration</p>
                </div>

                <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl p-6 text-white cursor-pointer hover:from-amber-600 hover:to-orange-700 transition-all duration-200 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">Monitor</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">System Health</h3>
                    <p class="text-amber-100 text-sm">Server status & alerts</p>
                </div>
            </div>

            <!-- Charts and Analytics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- User Growth Chart -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-slate-900">User Growth</h3>
                            <select class="text-sm border border-slate-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>Last 90 days</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="h-64 flex items-end justify-between space-x-2">
                            @foreach($chartData['user_growth'] as $day => $users)
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-full bg-blue-200 rounded-t-lg relative" style="height: {{ ($users / max($chartData['user_growth'])) * 200 }}px;">
                                        <div class="absolute inset-0 bg-gradient-to-t from-blue-600 to-blue-400 rounded-t-lg"></div>
                                    </div>
                                    <span class="text-xs text-slate-500 mt-2">{{ $day }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <span class="text-slate-500">Daily new users</span>
                            <span class="text-slate-900 font-medium">Avg: {{ number_format(array_sum($chartData['user_growth']) / count($chartData['user_growth'])) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Question Generation Chart -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-slate-900">Question Generation</h3>
                            <select class="text-sm border border-slate-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>Last 90 days</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="h-64 flex items-end justify-between space-x-2">
                            @foreach($chartData['questions_generated'] as $day => $questions)
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-full bg-emerald-200 rounded-t-lg relative" style="height: {{ ($questions / max($chartData['questions_generated'])) * 200 }}px;">
                                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-600 to-emerald-400 rounded-t-lg"></div>
                                    </div>
                                    <span class="text-xs text-slate-500 mt-2">{{ $day }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 flex items-center justify-between text-sm">
                            <span class="text-slate-500">Questions per day</span>
                            <span class="text-slate-900 font-medium">Avg: {{ number_format(array_sum($chartData['questions_generated']) / count($chartData['questions_generated'])) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Recent Users -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-slate-900">Recent Users</h3>
                            <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center">
                                View all
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentUsers as $user)
                                <div class="flex items-center space-x-4 p-3 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">{{ substr($user['name'], 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 truncate">{{ $user['name'] }}</p>
                                        <p class="text-sm text-slate-500 truncate">{{ $user['email'] }}</p>
                                    </div>
                                    <div class="flex flex-col items-end space-y-1">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($user['status'] === 'active') bg-emerald-100 text-emerald-800
                                            @elseif($user['status'] === 'pending') bg-amber-100 text-amber-800
                                            @else bg-slate-100 text-slate-800 @endif">
                                            {{ ucfirst($user['status']) }}
                                        </span>
                                        <span class="text-xs text-slate-500">{{ $user['created_at']->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-slate-900">Recent Activity</h3>
                            <button class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center">
                                Refresh
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentActivity as $activity)
                                <div class="flex space-x-3 p-3 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                                        @if($activity['type'] === 'user') bg-blue-100
                                        @elseif($activity['type'] === 'question') bg-emerald-100
                                        @elseif($activity['type'] === 'document') bg-purple-100
                                        @else bg-slate-100 @endif">
                                        @if($activity['type'] === 'user')
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        @elseif($activity['type'] === 'question')
                                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @elseif($activity['type'] === 'document')
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-slate-900">
                                            <span class="font-medium">{{ $activity['user'] }}</span>
                                            {{ strtolower($activity['action']) }}
                                        </p>
                                        <p class="text-sm text-slate-500">{{ $activity['details'] }}</p>
                                        <p class="text-xs text-slate-400">{{ $activity['time']->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Health & Performance -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- System Health -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-slate-900">System Health</h3>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                <span class="text-sm text-emerald-600 font-medium">All Systems Operational</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($systemHealth as $service)
                                <div class="bg-slate-50 rounded-lg p-4 hover:bg-slate-100 transition-colors duration-200">
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-sm font-medium text-slate-900">{{ $service['service'] }}</h4>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($service['status'] === 'healthy') bg-emerald-100 text-emerald-800
                                            @elseif($service['status'] === 'warning') bg-amber-100 text-amber-800
                                            @else bg-red-100 text-red-800 @endif">
                                            @if($service['status'] === 'healthy')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($service['status'] === 'warning')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                            {{ ucfirst($service['status']) }}
                                        </span>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-xs">
                                            <span class="text-slate-500">Uptime</span>
                                            <span class="text-slate-900 font-medium">{{ $service['uptime'] }}</span>
                                        </div>
                                        <div class="flex justify-between text-xs">
                                            <span class="text-slate-500">Response Time</span>
                                            <span class="text-slate-900 font-medium">{{ $service['response_time'] }}</span>
                                        </div>
                                        <div class="w-full bg-slate-200 rounded-full h-1.5">
                                            <div class="h-1.5 rounded-full
                                                @if($service['status'] === 'healthy') bg-emerald-500
                                                @elseif($service['status'] === 'warning') bg-amber-500
                                                @else bg-red-500 @endif"
                                                style="width: {{ $service['status'] === 'healthy' ? '100' : ($service['status'] === 'warning' ? '75' : '25') }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Performance Metrics -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">Performance</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <!-- CPU Usage -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-slate-700">CPU Usage</span>
                                    <span class="text-sm text-slate-900 font-bold">{{ $performance['cpu'] }}%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ $performance['cpu'] }}%"></div>
                                </div>
                            </div>

                            <!-- Memory Usage -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-slate-700">Memory Usage</span>
                                    <span class="text-sm text-slate-900 font-bold">{{ $performance['memory'] }}%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-2 rounded-full transition-all duration-300" style="width: {{ $performance['memory'] }}%"></div>
                                </div>
                            </div>

                            <!-- Disk Usage -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-slate-700">Disk Usage</span>
                                    <span class="text-sm text-slate-900 font-bold">{{ $performance['disk'] }}%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full transition-all duration-300" style="width: {{ $performance['disk'] }}%"></div>
                                </div>
                            </div>

                            <!-- Network -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-slate-700">Network Load</span>
                                    <span class="text-sm text-slate-900 font-bold">{{ $performance['network'] }}%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-amber-500 to-amber-600 h-2 rounded-full transition-all duration-300" style="width: {{ $performance['network'] }}%"></div>
                                </div>
                            </div>

                            <!-- Database -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-slate-700">Database Load</span>
                                    <span class="text-sm text-slate-900 font-bold">{{ $performance['database'] }}%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-red-500 to-red-600 h-2 rounded-full transition-all duration-300" style="width: {{ $performance['database'] }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-200">
                            <div class="text-center">
                                <p class="text-sm text-slate-500 mb-2">Overall System Health</p>
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    Excellent
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Summary -->
            <div class="bg-gradient-to-r from-slate-50 to-blue-50 rounded-xl p-6 border border-slate-200/60">
                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-4">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-slate-900">{{ $quickStats['online_users'] }}</p>
                        <p class="text-sm text-slate-600">Online Now</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-slate-900">{{ $quickStats['avg_session'] }}</p>
                        <p class="text-sm text-slate-600">Avg Session</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-slate-900">{{ $quickStats['bounce_rate'] }}%</p>
                        <p class="text-sm text-slate-600">Bounce Rate</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-slate-900">{{ $quickStats['conversion_rate'] }}%</p>
                        <p class="text-sm text-slate-600">Conversion</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-slate-900">${{ $quickStats['mrr'] }}k</p>
                        <p class="text-sm text-slate-600">MRR</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-slate-900">{{ $quickStats['support_tickets'] }}</p>
                        <p class="text-sm text-slate-600">Open Tickets</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-refresh dashboard data every 30 seconds
    setInterval(function() {
        // In a real application, you would make an AJAX call to refresh the data
        console.log('Dashboard data refresh...');
    }, 30000);

    // Add click handlers for quick action cards
    const quickActionCards = document.querySelectorAll('.cursor-pointer');
    quickActionCards.forEach(card => {
        card.addEventListener('click', function() {
            const cardText = this.querySelector('h3').textContent;

            switch(cardText) {
                case 'User Management':
                    window.location.href = '{{ route("admin.users") }}';
                    break;
                case 'Analytics':
                    window.location.href = '{{ route("admin.analytics") }}';
                    break;
                case 'Settings':
                    window.location.href = '{{ route("admin.settings") }}';
                    break;
                case 'System Health':
                    // Scroll to system health section
                    document.querySelector('#system-health')?.scrollIntoView({ behavior: 'smooth' });
                    break;
            }
        });

        // Add hover effects
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.02)';
            this.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '';
        });
    });

    // Animate progress bars on load
    const progressBars = document.querySelectorAll('[style*="width:"]');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = width;
        }, 500);
    });
});
</script>
@endpush
