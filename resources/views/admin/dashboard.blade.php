@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                <!-- Total Users -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-600">Total Users</p>
                            <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_users']) }}</p>
                            <p class="text-xs text-emerald-600">{{ $stats['active_users'] }} active</p>
                        </div>
                    </div>
                </div>

                <!-- Total Questions -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-600">Total Questions</p>
                            <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_questions']) }}</p>
                            <p class="text-xs text-emerald-600">+{{ $stats['questions_today'] }} today</p>
                        </div>
                    </div>
                </div>

                <!-- Documents Processed -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-600">Documents</p>
                            <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_documents']) }}</p>
                            <p class="text-xs text-slate-500">Processed</p>
                        </div>
                    </div>
                </div>

                <!-- Server Status -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-600">Server Uptime</p>
                            <p class="text-2xl font-bold text-slate-900">{{ $stats['server_uptime'] }}</p>
                            <p class="text-xs text-emerald-600">All systems operational</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Users -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-slate-900">Recent Users</h3>
                            <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View all</a>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentUsers as $user)
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">{{ substr($user['name'], 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 truncate">{{ $user['name'] }}</p>
                                        <p class="text-sm text-slate-500 truncate">{{ $user['email'] }}</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
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
                        <h3 class="text-lg font-semibold text-slate-900">Recent Activity</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($recentActivity as $activity)
                                <div class="flex space-x-3">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
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

            <!-- System Health -->
            <div class="mt-8">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">System Health</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                            @foreach($systemHealth as $service)
                                <div class="bg-slate-50 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-sm font-medium text-slate-900">{{ $service['service'] }}</h4>
                                        <span class="inline-flex items-center w-3 h-3 rounded-full 
                                            @if($service['status'] === 'healthy') bg-emerald-500
                                            @elseif($service['status'] === 'warning') bg-amber-500
                                            @else bg-red-500 @endif">
                                        </span>
                                    </div>
                                    <div class="space-y-1">
                                        <div class="flex justify-between text-xs">
                                            <span class="text-slate-500">Uptime</span>
                                            <span class="text-slate-900 font-medium">{{ $service['uptime'] }}</span>
                                        </div>
                                        <div class="flex justify-between text-xs">
                                            <span class="text-slate-500">Response</span>
                                            <span class="text-slate-900 font-medium">{{ $service['response_time'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
