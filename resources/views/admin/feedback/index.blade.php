@extends('layouts.admin')

@section('title', 'Feedback Management')
@section('page-title', 'Feedback')

@section('content')
<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Feedback Management</h1>
                    <p class="mt-2 text-gray-600">Monitor and manage user feedback</p>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('admin.feedback.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add Feedback
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100">
                        <i class="fas fa-comments text-orange-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Feedback</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Feedback::count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <i class="fas fa-star text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Avg Rating</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format(\App\Models\Feedback::avg('rating') ?? 0, 1) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100">
                        <i class="fas fa-thumbs-up text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Positive</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Feedback::where('rating', '>=', 4)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100">
                        <i class="fas fa-thumbs-down text-red-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Negative</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Feedback::where('rating', '<=', 2)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100">
                        <i class="fas fa-calendar text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">This Month</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Feedback::whereMonth('created_at', now()->month)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">All Feedback</h3>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input type="text" placeholder="Search feedback..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>All Ratings</option>
                            <option>5 Stars</option>
                            <option>4 Stars</option>
                            <option>3 Stars</option>
                            <option>2 Stars</option>
                            <option>1 Star</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Feedback</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse(\App\Models\Feedback::with(['user'])->latest()->take(10)->get() as $feedback)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Str::limit($feedback->comments ?? 'Feedback #' . $feedback->feedback_id, 50) }}</p>
                                    <p class="text-sm text-gray-500">ID: {{ $feedback->feedback_id }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-medium text-gray-600">{{ substr($feedback->user->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $feedback->user->name ?? 'Unknown User' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= ($feedback->rating ?? 0))
                                            <i class="fas fa-star text-yellow-400"></i>
                                        @else
                                            <i class="far fa-star text-gray-300"></i>
                                        @endif
                                    @endfor
                                    <span class="ml-2 text-sm text-gray-600">({{ $feedback->rating ?? 0 }})</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $rating = $feedback->rating ?? 0;
                                    if ($rating >= 4) {
                                        $type = 'Positive';
                                        $color = 'green';
                                    } elseif ($rating >= 3) {
                                        $type = 'Neutral';
                                        $color = 'yellow';
                                    } else {
                                        $type = 'Negative';
                                        $color = 'red';
                                    }
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-800">
                                    {{ $type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $feedback->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.feedback.show', $feedback) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.feedback.edit', $feedback) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.feedback.destroy', $feedback) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-comments text-gray-400 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No feedback found</h3>
                                    <p class="text-gray-500 mb-4">Get started by creating your first feedback entry.</p>
                                    <a href="{{ route('admin.feedback.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors">
                                        <i class="fas fa-plus mr-2"></i>Add Feedback
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">{{ \App\Models\Feedback::count() }}</span> results
                    </p>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 disabled:opacity-50" disabled>
                            Previous
                        </button>
                        <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 disabled:opacity-50" disabled>
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
