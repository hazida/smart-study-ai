@extends('layouts.admin-master')

@section('title', 'Enhanced Admin Dashboard - CRUD Management')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Enhanced Admin Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-600">Comprehensive CRUD management for all database tables</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.export-data') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-download mr-2"></i>Export Data
                    </a>
                    <a href="{{ route('admin.system-health') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-heartbeat mr-2"></i>System Health
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Users Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['users']['total'] }}</p>
                        <p class="text-sm text-green-600">{{ $stats['users']['active'] }} active</p>
                    </div>
                </div>
            </div>

            <!-- Subjects Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-book text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Subjects</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['subjects']['total'] }}</p>
                        <p class="text-sm text-blue-600">{{ $stats['subjects']['with_notes'] }} with notes</p>
                    </div>
                </div>
            </div>

            <!-- Notes Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-sticky-note text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Notes</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['notes']['total'] }}</p>
                        <p class="text-sm text-green-600">{{ $stats['notes']['published'] }} published</p>
                    </div>
                </div>
            </div>

            <!-- Questions Stats -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-question-circle text-white"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Questions</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['questions']['total'] }}</p>
                        <p class="text-sm text-purple-600">{{ $stats['questions']['ai_generated'] }} AI generated</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CRUD Management Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- User Management -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">User Management</h3>
                            <p class="text-sm text-gray-600">Manage users, roles, and profiles</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <a href="{{ route('admin.users-crud.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-list mr-2"></i>View All Users
                        </a>
                        <a href="{{ route('admin.users-crud.create') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-plus mr-2"></i>Add New User
                        </a>
                        <a href="{{ route('admin.user-profiles.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-id-card mr-2"></i>User Profiles
                        </a>
                    </div>
                </div>
            </div>

            <!-- Subject Management -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-book text-purple-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Subject Management</h3>
                            <p class="text-sm text-gray-600">Organize academic subjects</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <a href="{{ route('admin.subjects.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-list mr-2"></i>View All Subjects
                        </a>
                        <a href="{{ route('admin.subjects.create') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-plus mr-2"></i>Add New Subject
                        </a>
                    </div>
                </div>
            </div>

            <!-- Note Management -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-sticky-note text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Note Management</h3>
                            <p class="text-sm text-gray-600">Manage educational content</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <a href="{{ route('admin.notes-crud.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-list mr-2"></i>View All Notes
                        </a>
                        <a href="{{ route('admin.notes-crud.create') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-plus mr-2"></i>Add New Note
                        </a>
                    </div>
                </div>
            </div>

            <!-- Question Management -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-question-circle text-yellow-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Question Management</h3>
                            <p class="text-sm text-gray-600">Manage Q&A system</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <a href="{{ route('admin.questions.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-list mr-2"></i>View All Questions
                        </a>
                        <a href="{{ route('admin.questions.create') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-plus mr-2"></i>Add New Question
                        </a>
                        <a href="{{ route('admin.answers.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-check-circle mr-2"></i>Manage Answers
                        </a>
                    </div>
                </div>
            </div>

            <!-- Feedback Management -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-comments text-red-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Feedback Management</h3>
                            <p class="text-sm text-gray-600">Monitor user feedback</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <a href="{{ route('admin.feedback.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-list mr-2"></i>View All Feedback
                        </a>
                        <a href="{{ route('admin.feedback.statistics') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-chart-bar mr-2"></i>Feedback Statistics
                        </a>
                    </div>
                </div>
            </div>

            <!-- System Tools -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-cogs text-gray-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">System Tools</h3>
                            <p class="text-sm text-gray-600">System management tools</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <a href="{{ route('admin.system-health') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-heartbeat mr-2"></i>System Health
                        </a>
                        <a href="{{ route('admin.export-data') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-download mr-2"></i>Export Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Recent Users -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Recent Users</h4>
                        <div class="space-y-3">
                            @foreach($recentActivity['users']->take(3) as $user)
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-medium text-blue-600">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Notes -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Recent Notes</h4>
                        <div class="space-y-3">
                            @foreach($recentActivity['notes']->take(3) as $note)
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-sticky-note text-green-600 text-xs"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($note->title, 30) }}</p>
                                    <p class="text-xs text-gray-500">by {{ $note->user->name }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add any JavaScript for dashboard interactivity
    console.log('Enhanced Admin Dashboard loaded');
</script>
@endsection
