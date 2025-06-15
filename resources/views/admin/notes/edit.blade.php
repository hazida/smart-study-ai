@extends('layouts.admin')

@section('title', 'Edit Note')
@section('page-title', 'Edit Note')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Note</h1>
                    <p class="mt-2 text-gray-600">Update note information and content</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.notes-crud.show', $note) }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-eye mr-2"></i>View Note
                    </a>
                    <a href="{{ route('admin.notes-crud.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Notes
                    </a>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Note Information</h3>
            </div>

            <form action="{{ route('admin.notes-crud.update', $note) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $note->title) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                           placeholder="Enter note title..."
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" 
                              id="content" 
                              rows="12"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                              placeholder="Enter note content..."
                              required>{{ old('content', $note->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        You can use markdown formatting for better content structure.
                    </p>
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                        Excerpt
                    </label>
                    <textarea name="excerpt" 
                              id="excerpt" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('excerpt') border-red-500 @enderror"
                              placeholder="Brief description of the note...">{{ old('excerpt', $note->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Optional brief summary that will be shown in listings.
                    </p>
                </div>

                <!-- Status and Author Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" 
                                id="status" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                                required>
                            <option value="">Select Status</option>
                            <option value="draft" {{ old('status', $note->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $note->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $note->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Author <span class="text-red-500">*</span>
                        </label>
                        <select name="user_id" 
                                id="user_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('user_id') border-red-500 @enderror"
                                required>
                            <option value="">Select Author</option>
                            @foreach(\App\Models\User::where('role', 'admin')->orWhere('role', 'teacher')->get() as $user)
                                <option value="{{ $user->user_id }}" {{ old('user_id', $note->user_id) === $user->user_id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ ucfirst($user->role) }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Subjects -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Associated Subjects
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                        @php
                            $noteSubjectIds = $note->subjects->pluck('subject_id')->toArray();
                        @endphp
                        @foreach(\App\Models\Subject::all() as $subject)
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" 
                                       name="subjects[]" 
                                       value="{{ $subject->subject_id }}"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                       {{ in_array($subject->subject_id, old('subjects', $noteSubjectIds)) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">{{ $subject->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('subjects')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Select the subjects this note relates to. This helps with organization and question generation.
                    </p>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex items-center space-x-4">
                        <button type="button" 
                                onclick="document.getElementById('status').value='draft'"
                                class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400 transition-colors">
                            <i class="fas fa-save mr-2"></i>Save as Draft
                        </button>
                        <button type="button" 
                                onclick="document.getElementById('status').value='published'"
                                class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition-colors">
                            <i class="fas fa-check mr-2"></i>Publish Note
                        </button>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.notes-crud.show', $note) }}" 
                           class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-save mr-2"></i>Update Note
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Note Statistics -->
        <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Note Statistics</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $note->questions->count() }}</div>
                        <div class="text-sm text-gray-600">Questions Generated</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $note->questions->sum(function($q) { return $q->answers->count(); }) }}</div>
                        <div class="text-sm text-gray-600">Total Answers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600">{{ $note->subjects->count() }}</div>
                        <div class="text-sm text-gray-600">Associated Subjects</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-orange-600">{{ str_word_count($note->content) }}</div>
                        <div class="text-sm text-gray-600">Word Count</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Questions -->
        @if($note->questions->count() > 0)
        <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Recent Questions</h3>
                <a href="{{ route('admin.questions.index') }}?note_id={{ $note->note_id }}" 
                   class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                    View All →
                </a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @foreach($note->questions->take(3) as $question)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ Str::limit($question->question_text, 80) }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $question->answers->count() }} answers • {{ $question->created_at->diffForHumans() }}
                                </p>
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
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto-generate excerpt from content if excerpt is empty
    document.getElementById('content').addEventListener('input', function() {
        const content = this.value;
        const excerptField = document.getElementById('excerpt');
        
        if (!excerptField.value && content.length > 50) {
            // Generate excerpt from first 150 characters
            const excerpt = content.substring(0, 150).trim() + '...';
            excerptField.value = excerpt;
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        const status = document.getElementById('status').value;
        const userId = document.getElementById('user_id').value;

        if (!title || !content || !status || !userId) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
    });

    // Highlight changes
    const originalContent = @json($note->content);
    const contentField = document.getElementById('content');
    
    contentField.addEventListener('input', function() {
        if (this.value !== originalContent) {
            this.classList.add('border-yellow-400', 'bg-yellow-50');
        } else {
            this.classList.remove('border-yellow-400', 'bg-yellow-50');
        }
    });
</script>
@endsection
