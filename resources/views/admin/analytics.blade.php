@extends('layouts.admin')

@section('title', 'Analytics')
@section('page-title', 'Analytics')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Analytics</h2>
                        <p class="text-slate-600">Monitor platform performance and user engagement</p>
                    </div>
                    <div class="flex space-x-3">
                        <select class="px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                            <option>Last year</option>
                        </select>
                        <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export Report
                        </button>
                    </div>
                </div>
            </div>

            <!-- Key Metrics -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Daily Active Users</p>
                            <p class="text-2xl font-bold text-slate-900">892</p>
                            <p class="text-sm text-emerald-600">+12.5% from yesterday</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Questions Generated</p>
                            <p class="text-2xl font-bold text-slate-900">2,847</p>
                            <p class="text-sm text-emerald-600">+8.2% from last week</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Documents Processed</p>
                            <p class="text-2xl font-bold text-slate-900">456</p>
                            <p class="text-sm text-amber-600">-2.1% from last week</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-600">Avg. Session Duration</p>
                            <p class="text-2xl font-bold text-slate-900">24m 32s</p>
                            <p class="text-sm text-emerald-600">+5.7% from last week</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- User Growth Chart -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">User Growth</h3>
                        <p class="text-sm text-slate-500">New user registrations over time</p>
                    </div>
                    <div class="p-6">
                        <div class="h-64 bg-slate-50 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <p class="text-slate-500">Chart visualization would go here</p>
                                <p class="text-xs text-slate-400">Integration with Chart.js or similar library</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Question Generation Trends -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">Question Generation</h3>
                        <p class="text-sm text-slate-500">Questions created per day</p>
                    </div>
                    <div class="p-6">
                        <div class="h-64 bg-slate-50 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                </svg>
                                <p class="text-slate-500">Line chart would go here</p>
                                <p class="text-xs text-slate-400">Showing daily question generation trends</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Content and Usage Stats -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Top Question Categories -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">Top Categories</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                    <span class="text-sm text-slate-700">Technology</span>
                                </div>
                                <div class="text-sm font-medium text-slate-900">34%</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                    <span class="text-sm text-slate-700">Programming</span>
                                </div>
                                <div class="text-sm font-medium text-slate-900">28%</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                    <span class="text-sm text-slate-700">Business</span>
                                </div>
                                <div class="text-sm font-medium text-slate-900">22%</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                                    <span class="text-sm text-slate-700">Science</span>
                                </div>
                                <div class="text-sm font-medium text-slate-900">16%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Most Active Users -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">Most Active Users</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-medium">E</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-900">Emily Davis</p>
                                    <p class="text-xs text-slate-500">128 questions</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-medium">T</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-900">Tom Garcia</p>
                                    <p class="text-xs text-slate-500">89 questions</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-medium">L</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-900">Lisa Anderson</p>
                                    <p class="text-xs text-slate-500">67 questions</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-medium">J</span>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-900">John Smith</p>
                                    <p class="text-xs text-slate-500">45 questions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Performance -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <h3 class="text-lg font-semibold text-slate-900">System Performance</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-600">CPU Usage</span>
                                    <span class="text-slate-900 font-medium">45%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: 45%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-600">Memory Usage</span>
                                    <span class="text-slate-900 font-medium">67%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-emerald-500 h-2 rounded-full" style="width: 67%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-600">Storage Usage</span>
                                    <span class="text-slate-900 font-medium">82%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-amber-500 h-2 rounded-full" style="width: 82%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-600">Network I/O</span>
                                    <span class="text-slate-900 font-medium">23%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-purple-500 h-2 rounded-full" style="width: 23%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
