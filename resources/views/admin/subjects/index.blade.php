@extends('layouts.admin')

@section('title', 'Subject Management')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Subject Management</h1>
                    <p class="mt-1 text-sm text-gray-600">Organize and manage academic subjects</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.subjects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add New Subject
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-6">
                <form method="GET" action="{{ route('admin.subjects.index') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Subjects</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               placeholder="Subject name or description..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                        <a href="{{ route('admin.subjects.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition-colors">
                            <i class="fas fa-times mr-2"></i>Clear
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Subjects Grid -->
        @if($subjects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($subjects as $subject)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $subject->name }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ Str::limit($subject->description, 100) }}</p>
                        </div>
                        <div class="flex space-x-1 ml-4">
                            <a href="{{ route('admin.subjects.show', $subject) }}" 
                               class="text-blue-600 hover:text-blue-800 p-1" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.subjects.edit', $subject) }}" 
                               class="text-indigo-600 hover:text-indigo-800 p-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if(!$subject->users()->exists() && !$subject->notes()->exists())
                            <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this subject?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 p-1" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $subject->users_count }}</div>
                            <div class="text-xs text-blue-600">Users</div>
                        </div>
                        <div class="text-center p-3 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $subject->notes_count }}</div>
                            <div class="text-xs text-green-600">Notes</div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.subjects.show', $subject) }}" 
                           class="flex-1 bg-blue-100 text-blue-700 text-center py-2 rounded-md hover:bg-blue-200 transition-colors text-sm">
                            View Details
                        </a>
                        <a href="{{ route('admin.subjects.edit', $subject) }}" 
                           class="flex-1 bg-gray-100 text-gray-700 text-center py-2 rounded-md hover:bg-gray-200 transition-colors text-sm">
                            Edit
                        </a>
                    </div>

                    <!-- Created Date -->
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500">
                            Created {{ $subject->created_at->format('M d, Y') }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4">
                {{ $subjects->links() }}
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-12 text-center">
                <i class="fas fa-book text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No subjects found</h3>
                @if(request('search'))
                <p class="text-gray-500 mb-4">No subjects match your search criteria.</p>
                <a href="{{ route('admin.subjects.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors mr-2">
                    <i class="fas fa-times mr-2"></i>Clear Search
                </a>
                @else
                <p class="text-gray-500 mb-4">Get started by creating your first subject.</p>
                @endif
                <a href="{{ route('admin.subjects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add First Subject
                </a>
            </div>
        </div>
        @endif

        <!-- Quick Stats -->
        <div class="mt-8 bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Subject Statistics</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600">{{ $subjects->total() }}</div>
                        <div class="text-sm text-gray-600">Total Subjects</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $subjects->where('notes_count', '>', 0)->count() }}</div>
                        <div class="text-sm text-gray-600">With Notes</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-600">{{ $subjects->where('users_count', '>', 0)->count() }}</div>
                        <div class="text-sm text-gray-600">With Users</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-600">{{ $subjects->sum('notes_count') }}</div>
                        <div class="text-sm text-gray-600">Total Notes</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto-submit search form on Enter
    document.getElementById('search').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            this.form.submit();
        }
    });
</script>
@endsection
