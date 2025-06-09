@extends('layouts.admin')

@section('title', 'Answers Management')
@section('page-title', 'Answers')

@section('content')
<div class="p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Answers Management</h1>
                    <p class="mt-2 text-gray-600">Manage all answers in the Q&A system</p>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('admin.answers.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add Answer
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Answers</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Answer::count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100">
                        <i class="fas fa-star text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Correct</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Answer::where('is_correct', true)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100">
                        <i class="fas fa-times text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Incorrect</p>
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Answer::where('is_correct', false)->count() }}</p>
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
                        <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Answer::whereMonth('created_at', now()->month)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Answers Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">All Answers</h3>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <input type="text" placeholder="Search answers..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>All Status</option>
                            <option>Correct</option>
                            <option>Incorrect</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Answer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse(\App\Models\Answer::with(['question.user'])->latest()->take(10)->get() as $answer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Str::limit($answer->answer_text ?? 'Answer #' . $answer->id, 50) }}</p>
                                    <p class="text-sm text-gray-500">ID: {{ $answer->id }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs">
                                    <p class="text-sm text-gray-900 truncate">{{ Str::limit($answer->question->question_text ?? 'Question #' . $answer->question_id, 40) }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-medium text-gray-600">{{ substr($answer->question->user->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $answer->question->user->name ?? 'Question Author' }}</p>
                                        <p class="text-xs text-gray-500">Question Author</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($answer->is_correct ?? false)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Correct
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1"></i>Incorrect
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $answer->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.answers.show', $answer) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.answers.edit', $answer) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(!($answer->is_correct ?? false))
                                    <button class="text-green-600 hover:text-green-900" title="Mark as Correct">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @endif
                                    <form action="{{ route('admin.answers.destroy', $answer) }}" method="POST" class="inline">
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
                                    <i class="fas fa-check-circle text-gray-400 text-4xl mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No answers found</h3>
                                    <p class="text-gray-500 mb-4">Get started by creating your first answer.</p>
                                    <a href="{{ route('admin.answers.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                        <i class="fas fa-plus mr-2"></i>Add Answer
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
                        Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">{{ \App\Models\Answer::count() }}</span> results
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
