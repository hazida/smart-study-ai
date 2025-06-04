<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - QuestionGen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="flex flex-col flex-grow bg-slate-900 pt-5 pb-4 overflow-y-auto">
                    <!-- Logo -->
                    <div class="flex items-center flex-shrink-0 px-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">Q</span>
                        </div>
                        <span class="ml-3 text-white text-lg font-semibold">Admin Panel</span>
                    </div>

                    <!-- Navigation -->
                    <nav class="mt-8 flex-1 px-2 space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                            Dashboard
                        </a>

                        <a href="{{ route('admin.users') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200 {{ request()->routeIs('admin.users') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            Users
                        </a>

                        <a href="{{ route('admin.analytics') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200 {{ request()->routeIs('admin.analytics') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Analytics
                        </a>

                        <a href="{{ route('admin.settings') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-colors duration-200 {{ request()->routeIs('admin.settings') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </a>

                        <!-- Divider -->
                        <div class="border-t border-slate-700 my-4"></div>

                        <a href="{{ route('dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium text-slate-300 hover:bg-slate-700 hover:text-white rounded-md transition-colors duration-200">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m0 7h18"></path>
                            </svg>
                            Back to App
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top navigation -->
            <header class="bg-white shadow-sm border-b border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center py-4">
                        <!-- Mobile menu button -->
                        <div class="flex items-center lg:hidden">
                            <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" onclick="toggleMobileMenu()">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <span class="ml-3 text-lg font-semibold text-slate-900">Admin Panel</span>
                        </div>

                        <!-- Page title -->
                        <div class="hidden lg:block">
                            <h1 class="text-2xl font-semibold text-slate-900">@yield('page-title', 'Dashboard')</h1>
                        </div>

                        <!-- User menu -->
                        <div class="flex items-center space-x-4">
                            <!-- Notifications -->
                            <button class="p-2 text-slate-400 hover:text-slate-500 hover:bg-slate-100 rounded-lg transition-colors duration-200">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.868 19.718c.64.64 1.673.64 2.313 0l8.485-8.485c.64-.64.64-1.673 0-2.313l-8.485-8.485c-.64-.64-1.673-.64-2.313 0l-8.485 8.485c-.64.64-.64 1.673 0 2.313l8.485 8.485z"></path>
                                </svg>
                            </button>

                            <!-- User dropdown -->
                            <div class="relative">
                                <button class="flex items-center space-x-3 p-2 rounded-lg hover:bg-slate-100 transition-colors duration-200" onclick="toggleUserDropdown()">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">{{ substr(session('user.name'), 0, 1) }}</span>
                                    </div>
                                    <div class="hidden sm:block text-left">
                                        <p class="text-sm font-medium text-slate-700">{{ session('user.name') }}</p>
                                        <p class="text-xs text-slate-500">Administrator</p>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200 z-50">
                                    <div class="py-1">
                                        <a href="{{ route('profile.settings') }}" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            Profile Settings
                                        </a>
                                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                            </svg>
                                            User Dashboard
                                        </a>
                                        <div class="border-t border-slate-100"></div>
                                        <a href="{{ route('logout') }}" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            Sign Out
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden lg:hidden bg-slate-900">
                <nav class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">Dashboard</a>
                    <a href="{{ route('admin.users') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('admin.users') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">Users</a>
                    <a href="{{ route('admin.analytics') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('admin.analytics') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">Analytics</a>
                    <a href="{{ route('admin.settings') }}" class="block px-3 py-2 text-base font-medium rounded-md {{ request()->routeIs('admin.settings') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">Settings</a>
                    <div class="border-t border-slate-700 my-2"></div>
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium text-slate-300 hover:bg-slate-700 hover:text-white rounded-md">Back to App</a>
                </nav>
            </div>

            <!-- Page content -->
            <main class="flex-1 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function toggleUserDropdown() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userDropdown = document.getElementById('user-dropdown');
            const userButton = event.target.closest('[onclick="toggleUserDropdown()"]');
            
            if (!userButton && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
