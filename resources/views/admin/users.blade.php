@extends('layouts.admin')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Users</h2>
                        <p class="text-slate-600">Manage user accounts and permissions</p>
                    </div>
                    <div class="flex space-x-3">
                        <button class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export Users
                        </button>
                        <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add User
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-6 mb-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Search</label>
                        <input type="text" placeholder="Search users..." class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" id="search-input">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                        <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" id="status-filter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="inactive">Inactive</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Role</label>
                        <select class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" id="role-filter">
                            <option value="">All Roles</option>
                            <option value="user">User</option>
                            <option value="moderator">Moderator</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Actions</label>
                        <button onclick="clearFilters()" class="w-full px-3 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors duration-200">
                            Clear Filters
                        </button>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-slate-900">All Users ({{ count($users) }})</h3>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                            </button>
                            <button class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                    <input type="checkbox" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Questions</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Last Login</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Joined</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200" id="users-table">
                            @foreach($users as $user)
                                <tr class="user-row hover:bg-slate-50 transition-colors duration-200" 
                                    data-name="{{ strtolower($user['name']) }}" 
                                    data-email="{{ strtolower($user['email']) }}" 
                                    data-status="{{ $user['status'] }}" 
                                    data-role="{{ $user['role'] }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                                <span class="text-white text-sm font-medium">{{ substr($user['name'], 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-slate-900">{{ $user['name'] }}</div>
                                                <div class="text-sm text-slate-500">{{ $user['email'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($user['role'] === 'admin') bg-red-100 text-red-800
                                            @elseif($user['role'] === 'moderator') bg-purple-100 text-purple-800
                                            @else bg-slate-100 text-slate-800 @endif">
                                            {{ ucfirst($user['role']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($user['status'] === 'active') bg-emerald-100 text-emerald-800
                                            @elseif($user['status'] === 'pending') bg-amber-100 text-amber-800
                                            @elseif($user['status'] === 'suspended') bg-red-100 text-red-800
                                            @else bg-slate-100 text-slate-800 @endif">
                                            {{ ucfirst($user['status']) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                        {{ $user['questions_count'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $user['last_login'] ? $user['last_login']->diffForHumans() : 'Never' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                        {{ $user['created_at']->format('M j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900 p-1 rounded hover:bg-blue-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                            <button class="text-slate-600 hover:text-slate-900 p-1 rounded hover:bg-slate-50">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <div class="relative">
                                                <button class="text-slate-400 hover:text-slate-600 p-1 rounded hover:bg-slate-50" onclick="toggleUserDropdown({{ $user['id'] }})">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                                                    </svg>
                                                </button>
                                                <div id="user-dropdown-{{ $user['id'] }}" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-200 z-10">
                                                    <div class="py-1">
                                                        @if($user['status'] === 'active')
                                                            <a href="#" class="block px-4 py-2 text-sm text-amber-600 hover:bg-amber-50">Suspend User</a>
                                                        @elseif($user['status'] === 'suspended')
                                                            <a href="#" class="block px-4 py-2 text-sm text-emerald-600 hover:bg-emerald-50">Activate User</a>
                                                        @endif
                                                        <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Reset Password</a>
                                                        <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Send Email</a>
                                                        <div class="border-t border-slate-100"></div>
                                                        <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Delete User</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-slate-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-slate-500">
                            Showing 1 to {{ count($users) }} of {{ count($users) }} results
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 text-sm text-slate-500 hover:text-slate-700 disabled:opacity-50" disabled>
                                Previous
                            </button>
                            <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded">
                                1
                            </button>
                            <button class="px-3 py-1 text-sm text-slate-500 hover:text-slate-700 disabled:opacity-50" disabled>
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const statusFilter = document.getElementById('status-filter');
    const roleFilter = document.getElementById('role-filter');
    const userRows = document.querySelectorAll('.user-row');

    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedStatus = statusFilter.value;
        const selectedRole = roleFilter.value;

        let visibleCount = 0;

        userRows.forEach(row => {
            const name = row.dataset.name;
            const email = row.dataset.email;
            const status = row.dataset.status;
            const role = row.dataset.role;

            const matchesSearch = !searchTerm || name.includes(searchTerm) || email.includes(searchTerm);
            const matchesStatus = !selectedStatus || status === selectedStatus;
            const matchesRole = !selectedRole || role === selectedRole;

            const shouldShow = matchesSearch && matchesStatus && matchesRole;

            if (shouldShow) {
                row.style.display = 'table-row';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update results count
        const resultsText = document.querySelector('.text-sm.text-slate-500');
        if (resultsText) {
            resultsText.textContent = `Showing 1 to ${visibleCount} of ${visibleCount} results`;
        }
    }

    // Clear filters function
    window.clearFilters = function() {
        searchInput.value = '';
        statusFilter.value = '';
        roleFilter.value = '';
        filterUsers();
    };

    // Add event listeners
    searchInput.addEventListener('input', filterUsers);
    statusFilter.addEventListener('change', filterUsers);
    roleFilter.addEventListener('change', filterUsers);

    // Dropdown toggle functionality
    window.toggleUserDropdown = function(id) {
        const dropdown = document.getElementById(`user-dropdown-${id}`);
        const allDropdowns = document.querySelectorAll('[id^="user-dropdown-"]');

        // Close all other dropdowns
        allDropdowns.forEach(d => {
            if (d !== dropdown) {
                d.classList.add('hidden');
            }
        });

        // Toggle current dropdown
        dropdown.classList.toggle('hidden');
    };

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('[onclick^="toggleUserDropdown"]') && !event.target.closest('[id^="user-dropdown-"]')) {
            document.querySelectorAll('[id^="user-dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
});
</script>
@endpush
