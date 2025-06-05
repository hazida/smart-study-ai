@extends('layouts.admin-master')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="p-6">
    <!-- Welcome Header -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Welcome back, {{ session('user.name', 'Admin') }}!</h1>
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

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                        <i class="fas fa-users text-white"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::count() }}</p>
                    <p class="text-sm text-green-600">{{ \App\Models\User::where('is_active', true)->count() }} active</p>
                </div>
            </div>
        </div>

        <!-- Total Subjects -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                        <i class="fas fa-book text-white"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Subjects</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Subject::count() }}</p>
                    <p class="text-sm text-blue-600">{{ \App\Models\Subject::has('notes')->count() }} with notes</p>
                </div>
            </div>
        </div>

        <!-- Total Notes -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                        <i class="fas fa-sticky-note text-white"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Notes</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Note::count() }}</p>
                    <p class="text-sm text-green-600">{{ \App\Models\Note::where('status', 'published')->count() }} published</p>
                </div>
            </div>
        </div>

        <!-- Total Questions -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                        <i class="fas fa-question-circle text-white"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Questions</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Question::count() }}</p>
                    <p class="text-sm text-purple-600">{{ \App\Models\Question::where('generated_by', 'AI')->count() }} AI generated</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Grid -->
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
                        <p class="text-sm text-gray-600">Manage users and profiles</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <a href="{{ route('admin.users-crud.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                        <i class="fas fa-list mr-2"></i>View All Users
                    </a>
                    <a href="{{ route('admin.users-crud.create') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                        <i class="fas fa-plus mr-2"></i>Add New User
                    </a>
                </div>
            </div>
        </div>

        <!-- Content Management -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Content Management</h3>
                        <p class="text-sm text-gray-600">Manage subjects and notes</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <a href="{{ route('admin.subjects.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                        <i class="fas fa-book mr-2"></i>Subjects
                    </a>
                    <a href="{{ route('admin.notes-crud.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                        <i class="fas fa-sticky-note mr-2"></i>Notes
                    </a>
                </div>
            </div>
        </div>

        <!-- Q&A System -->
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-question-circle text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-gray-900">Q&A System</h3>
                        <p class="text-sm text-gray-600">Manage questions and answers</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <a href="{{ route('admin.questions.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                        <i class="fas fa-question-circle mr-2"></i>Questions
                    </a>
                    <a href="{{ route('admin.answers.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                        <i class="fas fa-check-circle mr-2"></i>Answers
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
                        @foreach(\App\Models\User::orderBy('created_at', 'desc')->take(3)->get() as $user)
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
                        @foreach(\App\Models\Note::with('user')->orderBy('created_at', 'desc')->take(3)->get() as $note)
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

    <!-- System Status -->
    <div class="mt-8 bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">System Status</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-900">Database</p>
                    <p class="text-xs text-green-600">Healthy</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-server text-green-600"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-900">Server</p>
                    <p class="text-xs text-green-600">Online</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-shield-alt text-green-600"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-900">Security</p>
                    <p class="text-xs text-green-600">Secure</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add any dashboard-specific JavaScript here
    console.log('Admin Dashboard loaded');
</script>
@endsection
