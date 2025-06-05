@extends('layouts.admin-master')

@section('title', 'Create New Subject')
@section('page-title', 'Create Subject')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Create New Subject</h1>
                <p class="mt-1 text-sm text-gray-600">Add a new academic subject to the system</p>
            </div>
            <a href="{{ route('admin.subjects.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Subjects
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow">
        <form action="{{ route('admin.subjects.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="space-y-6">
                <!-- Subject Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Subject Name *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           placeholder="e.g., Mathematics, Science, History..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subject Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" 
                              placeholder="Provide a brief description of this subject..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Maximum 1000 characters</p>
                </div>

                <!-- Subject Examples -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-blue-900 mb-2">Subject Examples</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-sm text-blue-700">
                        <div>• Mathematics</div>
                        <div>• Science</div>
                        <div>• English Language Arts</div>
                        <div>• History</div>
                        <div>• Geography</div>
                        <div>• Computer Science</div>
                        <div>• Art</div>
                        <div>• Music</div>
                        <div>• Physical Education</div>
                        <div>• Foreign Languages</div>
                        <div>• Social Studies</div>
                        <div>• Economics</div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.subjects.index') }}" 
                       class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fas fa-save mr-2"></i>Create Subject
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Help Section -->
    <div class="mt-6 bg-gray-50 rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Tips for Creating Subjects</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h4 class="font-medium text-gray-900 mb-2">Naming Guidelines</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Use clear, descriptive names</li>
                    <li>• Avoid abbreviations when possible</li>
                    <li>• Use title case (e.g., "Computer Science")</li>
                    <li>• Keep names concise but specific</li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-gray-900 mb-2">Description Best Practices</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Explain what the subject covers</li>
                    <li>• Mention key topics or skills</li>
                    <li>• Keep it informative but brief</li>
                    <li>• Use language appropriate for your audience</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Character counter for description
    document.getElementById('description').addEventListener('input', function() {
        const maxLength = 1000;
        const currentLength = this.value.length;
        const remaining = maxLength - currentLength;
        
        // You can add a character counter here if needed
        console.log(`Characters remaining: ${remaining}`);
    });

    // Auto-focus on name field
    document.getElementById('name').focus();
</script>
@endsection
