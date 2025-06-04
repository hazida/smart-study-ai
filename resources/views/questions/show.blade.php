@extends('layouts.app')

@section('title', $question['title'])

@section('content')
    <div class="bg-slate-50 min-h-screen py-6 sm:py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between space-y-4 xl:space-y-0">
                    <div class="flex items-start space-x-4">
                        <a href="{{ route('questions.index') }}" class="inline-flex items-center justify-center w-10 h-10 text-slate-600 hover:text-slate-900 hover:bg-white rounded-lg transition-all duration-200 border border-slate-300 hover:border-slate-400 hover:shadow-sm flex-shrink-0 mt-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m0 7h18"></path>
                            </svg>
                        </a>
                        <div class="min-w-0 flex-1">
                            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 break-words">{{ $question['title'] }}</h1>
                            <p class="mt-1 text-slate-600 break-words">{{ $question['description'] }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3 xl:flex-shrink-0">
                        <button class="inline-flex items-center justify-center px-4 py-2.5 text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-50 rounded-lg transition-all duration-200 border border-slate-300 hover:border-slate-400 font-medium shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Export
                        </button>
                        <button class="inline-flex items-center justify-center px-4 py-2.5 text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-50 rounded-lg transition-all duration-200 border border-slate-300 hover:border-slate-400 font-medium shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            Share
                        </button>
                        <button class="inline-flex items-center justify-center px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-sm hover:shadow-md font-medium transform hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Questions
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 sm:gap-8">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Question Set Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4 sm:p-6 mb-6">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Question Set Info</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-slate-600">Total Questions</p>
                                <p class="text-2xl font-bold text-slate-900">{{ $question['question_count'] }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-slate-600">Difficulty</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                                    @if($question['difficulty'] === 'Beginner') bg-green-100 text-green-800
                                    @elseif($question['difficulty'] === 'Intermediate') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $question['difficulty'] }}
                                </span>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-slate-600">Category</p>
                                <p class="text-sm text-slate-900">{{ $question['category'] }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-slate-600">Source</p>
                                <p class="text-sm text-slate-900">{{ $question['source_type'] }}</p>
                                <p class="text-xs text-slate-500">{{ $question['source_name'] }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-slate-600">Created</p>
                                <p class="text-sm text-slate-900">{{ $question['created_at']->format('M j, Y') }}</p>
                                <p class="text-xs text-slate-500">{{ $question['created_at']->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tags -->
                    @if(!empty($question['tags']))
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4 sm:p-6 mb-6">
                            <h3 class="text-lg font-semibold text-slate-900 mb-4">Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($question['tags'] as $tag)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4 sm:p-6">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Quick Actions</h3>
                        <div class="space-y-2">
                            <button class="w-full text-left px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-lg transition-all duration-200">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download PDF
                            </button>
                            <button class="w-full text-left px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-lg transition-all duration-200">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Export to Word
                            </button>
                            <button class="w-full text-left px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-lg transition-all duration-200">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                                Share Link
                            </button>
                            <button class="w-full text-left px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 rounded-lg transition-all duration-200">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                                Duplicate Set
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <!-- Filter Bar -->
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200/60 p-4 sm:p-6 mb-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                            <div class="flex items-center space-x-4">
                                <h2 class="text-lg font-semibold text-slate-900">Questions</h2>
                                <span class="text-sm text-slate-500">({{ count($question['questions']) }} of {{ $question['question_count'] }})</span>
                            </div>
                            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                                <select class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" id="difficulty-filter">
                                    <option value="">All Difficulties</option>
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                                <select class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" id="type-filter">
                                    <option value="">All Types</option>
                                    <option value="multiple_choice">Multiple Choice</option>
                                    <option value="short_answer">Short Answer</option>
                                    <option value="essay">Essay</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Questions List -->
                    <div class="space-y-6" id="questions-list">
                        @foreach($question['questions'] as $index => $q)
                            <div class="question-item bg-white rounded-xl shadow-sm border border-slate-200/60 overflow-hidden"
                                 data-difficulty="{{ $q['difficulty'] }}"
                                 data-type="{{ $q['type'] }}">
                                
                                <!-- Question Header -->
                                <div class="px-4 sm:px-6 py-4 border-b border-slate-100 bg-slate-50">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                                {{ $index + 1 }}
                                            </span>
                                            <div>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                    @if($q['difficulty'] === 'easy') bg-green-100 text-green-800
                                                    @elseif($q['difficulty'] === 'medium') bg-yellow-100 text-yellow-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($q['difficulty']) }}
                                                </span>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 ml-2">
                                                    {{ str_replace('_', ' ', ucfirst($q['type'])) }}
                                                </span>
                                            </div>
                                        </div>
                                        <button class="text-slate-400 hover:text-slate-600 transition-colors duration-200" onclick="toggleQuestion({{ $index }})">
                                            <svg class="w-5 h-5 transform transition-transform duration-200" id="chevron-{{ $index }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Question Content -->
                                <div class="px-4 sm:px-6 py-6" id="question-content-{{ $index }}">
                                    <h3 class="text-lg font-medium text-slate-900 mb-4">{{ $q['question'] }}</h3>

                                    @if($q['type'] === 'multiple_choice' && isset($q['options']))
                                        <div class="space-y-3 mb-6">
                                            @foreach($q['options'] as $optionIndex => $option)
                                                <div class="flex items-start space-x-3 p-3 rounded-lg border border-slate-200 
                                                    @if($optionIndex === $q['correct_answer']) bg-green-50 border-green-200 @endif">
                                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-slate-100 text-slate-700 text-sm font-medium rounded-full flex-shrink-0 mt-0.5">
                                                        {{ chr(65 + $optionIndex) }}
                                                    </span>
                                                    <p class="text-slate-700 flex-1">{{ $option }}</p>
                                                    @if($optionIndex === $q['correct_answer'])
                                                        <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if(isset($q['sample_answer']))
                                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                            <h4 class="text-sm font-medium text-blue-900 mb-2">Sample Answer:</h4>
                                            <p class="text-sm text-blue-800">{{ $q['sample_answer'] }}</p>
                                        </div>
                                    @endif

                                    @if(isset($q['explanation']))
                                        <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                                            <h4 class="text-sm font-medium text-slate-900 mb-2">Explanation:</h4>
                                            <p class="text-sm text-slate-700">{{ $q['explanation'] }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const difficultyFilter = document.getElementById('difficulty-filter');
    const typeFilter = document.getElementById('type-filter');
    const questionItems = document.querySelectorAll('.question-item');

    function filterQuestions() {
        const selectedDifficulty = difficultyFilter.value;
        const selectedType = typeFilter.value;

        questionItems.forEach(item => {
            const difficulty = item.dataset.difficulty;
            const type = item.dataset.type;

            const matchesDifficulty = !selectedDifficulty || difficulty === selectedDifficulty;
            const matchesType = !selectedType || type === selectedType;

            if (matchesDifficulty && matchesType) {
                item.style.display = 'block';
                item.style.animation = 'fadeIn 0.3s ease-in-out';
            } else {
                item.style.display = 'none';
            }
        });
    }

    difficultyFilter.addEventListener('change', filterQuestions);
    typeFilter.addEventListener('change', filterQuestions);

    // Question toggle functionality
    window.toggleQuestion = function(index) {
        const content = document.getElementById(`question-content-${index}`);
        const chevron = document.getElementById(`chevron-${index}`);

        if (content.style.display === 'none') {
            content.style.display = 'block';
            content.style.animation = 'slideDown 0.3s ease-in-out';
            chevron.style.transform = 'rotate(0deg)';
        } else {
            content.style.display = 'none';
            chevron.style.transform = 'rotate(-90deg)';
        }
    };

    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideDown {
            from { opacity: 0; max-height: 0; }
            to { opacity: 1; max-height: 1000px; }
        }
        .question-item {
            transition: all 0.2s ease-in-out;
        }
        .question-item:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    `;
    document.head.appendChild(style);

    // Keyboard shortcuts
    document.addEventListener('keydown', function(event) {
        // Number keys to jump to questions
        if (event.key >= '1' && event.key <= '9') {
            const questionIndex = parseInt(event.key) - 1;
            const questionElement = document.querySelector(`#question-content-${questionIndex}`);
            if (questionElement) {
                questionElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        // 'E' key to expand/collapse all questions
        if (event.key.toLowerCase() === 'e' && !event.target.matches('input, textarea, select')) {
            const allContents = document.querySelectorAll('[id^="question-content-"]');
            const allVisible = Array.from(allContents).every(content => content.style.display !== 'none');

            allContents.forEach((content, index) => {
                const chevron = document.getElementById(`chevron-${index}`);
                if (allVisible) {
                    content.style.display = 'none';
                    chevron.style.transform = 'rotate(-90deg)';
                } else {
                    content.style.display = 'block';
                    chevron.style.transform = 'rotate(0deg)';
                }
            });
        }
    });

    // Add keyboard shortcut hints
    const shortcutHint = document.createElement('div');
    shortcutHint.className = 'fixed bottom-4 right-4 bg-slate-800 text-white text-xs px-3 py-2 rounded-lg opacity-75 z-50';
    shortcutHint.innerHTML = 'Press 1-9 to jump to questions, E to expand/collapse all';
    document.body.appendChild(shortcutHint);

    // Hide hint after 5 seconds
    setTimeout(() => {
        shortcutHint.style.opacity = '0';
        shortcutHint.style.transition = 'opacity 0.3s ease-in-out';
        setTimeout(() => shortcutHint.remove(), 300);
    }, 5000);
});
</script>
@endpush
