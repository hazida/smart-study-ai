<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - QuestionCraft</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-transition { transition: transform 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-gray-50" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform lg:translate-x-0 lg:static lg:inset-0 sidebar-transition"
             :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
             x-cloak>
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 bg-gradient-to-r from-blue-600 to-indigo-600">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-white text-2xl mr-3"></i>
                    <h1 class="text-white text-lg font-bold">QuestionCraft</h1>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav class="mt-6 px-3 pb-20 overflow-y-auto">
                <!-- Dashboard Section -->
                <div class="mb-6">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Dashboard</h3>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-tachometer-alt mr-3 w-5"></i>
                        Overview
                    </a>
                    <a href="{{ route('admin.enhanced.dashboard') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.enhanced.dashboard') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-database mr-3 w-5"></i>
                        CRUD Management
                    </a>
                    <a href="{{ route('admin.analytics') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.analytics') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-chart-bar mr-3 w-5"></i>
                        Analytics
                    </a>
                </div>

                <!-- User Management Section -->
                <div class="mb-6">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">User Management</h3>
                    <a href="{{ route('admin.users-crud.index') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users-crud.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-users mr-3 w-5"></i>
                        All Users
                        <span class="ml-auto bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">{{ \App\Models\User::count() }}</span>
                    </a>
                    <a href="{{ route('admin.user-profiles.index') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.user-profiles.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-id-card mr-3 w-5"></i>
                        User Profiles
                    </a>
                    <a href="{{ route('admin.users') }}"
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-user-cog mr-3 w-5"></i>
                        Legacy Users
                    </a>
                </div>

                <!-- Content Management Section -->
                <div class="mb-6">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Content</h3>
                    <a href="{{ route('admin.subjects.index') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.subjects.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-book mr-3 w-5"></i>
                        Subjects
                        <span class="ml-auto bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">{{ \App\Models\Subject::count() }}</span>
                    </a>
                    <a href="{{ route('admin.notes-crud.index') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.notes-crud.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-sticky-note mr-3 w-5"></i>
                        Notes
                        <span class="ml-auto bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">{{ \App\Models\Note::count() }}</span>
                    </a>

                </div>

                <!-- Q&A System Section -->
                <div class="mb-6">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Q&A System</h3>
                    <a href="{{ route('admin.questions.index') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.questions.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-question-circle mr-3 w-5"></i>
                        Questions
                        <span class="ml-auto bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">{{ \App\Models\Question::count() }}</span>
                    </a>
                    <a href="{{ route('admin.answers.index') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.answers.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-check-circle mr-3 w-5"></i>
                        Answers
                        <span class="ml-auto bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">{{ \App\Models\Answer::count() }}</span>
                    </a>
                    <a href="{{ route('admin.feedback.index') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.feedback.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-comments mr-3 w-5"></i>
                        Feedback
                        <span class="ml-auto bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">{{ \App\Models\Feedback::count() }}</span>
                    </a>
                </div>

                <!-- System Section -->
                <div class="mb-6">
                    <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">System</h3>
                    <a href="{{ route('admin.system-health') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.system-health') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-heartbeat mr-3 w-5"></i>
                        System Health
                    </a>
                    <a href="{{ route('admin.export-data') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-download mr-3 w-5"></i>
                        Export Data
                    </a>
                    <a href="{{ route('admin.reports') }}" 
                       class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.reports') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-file-chart-line mr-3 w-5"></i>
                        Reports
                    </a>
                </div>
            </nav>

            <!-- User Info at Bottom -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 bg-white">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-blue-600">{{ substr(session('user.name', 'A'), 0, 1) }}</span>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-gray-700">{{ session('user.name', 'Admin') }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute bottom-full right-0 mb-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i>User Dashboard
                            </a>
                            <a href="{{ route('profile.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i>Settings
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <!-- Top Navigation Bar (Mobile) -->
            <header class="bg-white shadow-sm border-b border-gray-200 lg:hidden">
                <div class="flex items-center justify-between h-16 px-4">
                    <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-gray-900">@yield('page-title', 'Admin Dashboard')</h1>
                    <div class="w-6"></div> <!-- Spacer for centering -->
                </div>
            </header>

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <i class="fas fa-times cursor-pointer"></i>
                </span>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <i class="fas fa-times cursor-pointer"></i>
                </span>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
                <div class="font-bold">Please fix the following errors:</div>
                <ul class="mt-2">
                    @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
                    <i class="fas fa-times cursor-pointer"></i>
                </span>
            </div>
            @endif

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 px-4 py-3">
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <div>
                        © {{ date('Y') }} QuestionCraft. All rights reserved.
                    </div>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-gray-700">Documentation</a>
                        <a href="#" class="hover:text-gray-700">Support</a>
                        <a href="#" class="hover:text-gray-700">API</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden" x-cloak></div>

    <!-- Scripts -->
    <script>
        // Auto-hide flash messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                alert.style.display = 'none';
            });
        }, 5000);
    </script>

    @yield('scripts')
</body>
</html>
