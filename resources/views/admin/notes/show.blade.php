@extends('layouts.admin')

@section('title', 'View Note')
@section('page-title', 'Note Details')

@section('content')
<div class="p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $note->title }}</h1>
                    <p class="mt-2 text-gray-600">Note Details and Management</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.notes-crud.edit', $note) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit Note
                    </a>
                    <a href="{{ route('admin.notes-crud.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Notes
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Note Content -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Content</h3>
                    </div>
                    <div class="p-6">
                        <div class="prose max-w-none">
                            {!! nl2br(e($note->content)) !!}
                        </div>
                    </div>
                </div>

                <!-- Associated Questions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Generated Questions ({{ $note->questions->count() }})
                        </h3>
                        <a href="{{ route('admin.questions.create') }}?note_id={{ $note->note_id }}" 
                           class="bg-green-600 text-white px-3 py-1 rounded-md text-sm hover:bg-green-700 transition-colors">
                            <i class="fas fa-plus mr-1"></i>Add Question
                        </a>
                    </div>
                    <div class="p-6">
                        @if($note->questions->count() > 0)
                            <div class="space-y-4">
                                @foreach($note->questions->take(5) as $question)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ Str::limit($question->question_text, 100) }}
                                                </p>
                                                <div class="mt-2 flex items-center space-x-4 text-xs text-gray-500">
                                                    <span>
                                                        <i class="fas fa-user mr-1"></i>
                                                        {{ $question->user->name ?? 'Unknown' }}
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-calendar mr-1"></i>
                                                        {{ $question->created_at->format('M d, Y') }}
                                                    </span>
                                                    <span>
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        {{ $question->answers->count() }} answers
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2 ml-4">
                                                <a href="{{ route('admin.questions.show', $question) }}" 
                                                   class="text-blue-600 hover:text-blue-900">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.questions.edit', $question) }}" 
                                                   class="text-indigo-600 hover:text-indigo-900">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                @if($note->questions->count() > 5)
                                    <div class="text-center pt-4">
                                        <a href="{{ route('admin.questions.index') }}?note_id={{ $note->note_id }}" 
                                           class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                            View all {{ $note->questions->count() }} questions →
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-question-circle text-gray-400 text-3xl mb-4"></i>
                                <h4 class="text-lg font-medium text-gray-900 mb-2">No Questions Yet</h4>
                                <p class="text-gray-500 mb-4">Generate questions from this note content.</p>
                                <a href="{{ route('admin.questions.create') }}?note_id={{ $note->note_id }}" 
                                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Create First Question
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Note Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Note Information</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                @if($note->status === 'published') bg-green-100 text-green-800
                                @elseif($note->status === 'draft') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($note->status) }}
                            </span>
                        </div>

                        <!-- Author -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-sm font-medium text-blue-600">{{ substr($note->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $note->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ ucfirst($note->user->role) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Dates -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Created</label>
                            <p class="text-sm text-gray-900">{{ $note->created_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Updated</label>
                            <p class="text-sm text-gray-900">{{ $note->updated_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>

                        <!-- Word Count -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Word Count</label>
                            <p class="text-sm text-gray-900">{{ $note->word_count ?? str_word_count($note->content) }} words</p>
                        </div>
                    </div>
                </div>

                <!-- Associated Subjects -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Associated Subjects</h3>
                    </div>
                    <div class="p-6">
                        @if($note->subjects->count() > 0)
                            <div class="space-y-2">
                                @foreach($note->subjects as $subject)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                <i class="fas fa-book text-blue-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $subject->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $subject->description ?? 'No description' }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('admin.subjects.show', $subject) }}" 
                                           class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-external-link-alt text-sm"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-book text-gray-400 text-2xl mb-2"></i>
                                <p class="text-sm text-gray-500">No subjects associated</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('admin.questions.create') }}?note_id={{ $note->note_id }}" 
                           class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>Generate Questions
                        </a>
                        
                        <a href="{{ route('admin.notes-crud.edit', $note) }}" 
                           class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-edit mr-2"></i>Edit Note
                        </a>
                        
                        <button onclick="duplicateNote()" 
                                class="w-full flex items-center justify-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-copy mr-2"></i>Duplicate Note
                        </button>
                        
                        <form action="{{ route('admin.notes-crud.destroy', $note) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this note? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                <i class="fas fa-trash mr-2"></i>Delete Note
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Statistics</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Questions Generated</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $note->questions->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Answers</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $note->questions->sum(function($q) { return $q->answers->count(); }) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Associated Subjects</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $note->subjects->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Content Length</span>
                            <span class="text-sm font-semibold text-gray-900">{{ strlen($note->content) }} chars</span>
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
    function duplicateNote() {
        if (confirm('Create a copy of this note?')) {
            // In a real implementation, this would make an AJAX call to duplicate the note
            window.location.href = "{{ route('admin.notes-crud.create') }}?duplicate={{ $note->note_id }}";
        }
    }
</script>
@endsection
