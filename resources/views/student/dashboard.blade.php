@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Welcome Header -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 lg:p-8 text-white shadow-xl">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-4 lg:mb-0">
                        <h1 class="text-2xl lg:text-3xl font-bold mb-2">
                            Welcome back, {{ auth()->user()->name }}! 📚
                        </h1>
                        <p class="text-blue-100 text-sm lg:text-base">
                            Track your learning progress and stay on top of your study goals
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                            <div class="text-xs text-blue-100">Study Streak</div>
                            <div class="text-lg font-bold">{{ $studyStreak['current_streak'] }} days</div>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                            <div class="text-xs text-blue-100">Accuracy Rate</div>
                            <div class="text-lg font-bold">{{ $stats['accuracy_rate'] }}%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Enrolled Subjects</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['enrolled_subjects'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Questions Answered</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['questions_answered'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Study Hours/Week</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['study_hours_week'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Notes Created</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['notes_created'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrolled Subjects with Progress -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">My Subjects</h2>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">View All</a>
            </div>

            @if($enrolledSubjects->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($enrolledSubjects as $subjectData)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6">
                                <!-- Subject Header -->
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $subjectData['subject']->name }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $subjectData['subject']->description }}</p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-2">
                                            {{ ucfirst($subjectData['level']) }} Level
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-gray-900">{{ $subjectData['progress_percentage'] }}%</div>
                                        <div class="text-xs text-gray-500">Complete</div>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                                        <span>Progress</span>
                                        <span>{{ $subjectData['completed_topics'] }}/{{ $subjectData['total_topics'] }} topics</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full transition-all duration-300" 
                                             style="width: {{ $subjectData['progress_percentage'] }}%"></div>
                                    </div>
                                </div>

                                <!-- Timeline Info -->
                                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                    <h4 class="font-medium text-gray-900 mb-2">1-Year Completion Timeline</h4>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-600">Estimated Completion:</span>
                                            <div class="font-medium">{{ $subjectData['timeline']['estimated_completion']->format('M Y') }}</div>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">Daily Target:</span>
                                            <div class="font-medium">{{ $subjectData['timeline']['daily_target'] }} topics</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quarterly Milestones -->
                                <div class="mb-4">
                                    <h5 class="text-sm font-medium text-gray-900 mb-2">Quarterly Milestones</h5>
                                    <div class="grid grid-cols-4 gap-2">
                                        @foreach($subjectData['timeline']['milestones'] as $milestone)
                                            <div class="text-center">
                                                <div class="text-xs text-gray-600">{{ $milestone['quarter'] }}</div>
                                                <div class="text-sm font-medium 
                                                    @if($milestone['expected_progress'] <= $subjectData['progress_percentage']) 
                                                        text-green-600 
                                                    @else 
                                                        text-gray-900 
                                                    @endif">
                                                    {{ $milestone['expected_progress'] }}%
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-2">
                                    <button class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                        Continue Learning
                                    </button>
                                    <button class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl p-8 text-center shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Subjects Enrolled</h3>
                    <p class="text-gray-600 mb-4">Start your learning journey by enrolling in subjects</p>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Browse Subjects
                    </button>
                </div>
            @endif
        </div>

        <!-- Recent Activity & Upcoming Deadlines -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                </div>
                <div class="p-6">
                    @if($recentActivity->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentActivity->take(5) as $activity)
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 bg-{{ $activity['color'] }}-100 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-{{ $activity['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($activity['icon'] == 'check-circle')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @elseif($activity['icon'] == 'x-circle')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            @endif
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-900">{{ $activity['description'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $activity['subject'] }} • {{ $activity['time']->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No recent activity</p>
                    @endif
                </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Upcoming Deadlines</h3>
                </div>
                <div class="p-6">
                    @if($upcomingDeadlines->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingDeadlines as $deadline)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $deadline['title'] }}</p>
                                        <p class="text-xs text-gray-600">{{ $deadline['date']->format('M j, Y') }}</p>
                                    </div>
                                    <span class="text-xs font-medium px-2 py-1 bg-orange-100 text-orange-800 rounded-full">
                                        {{ $deadline['days_remaining'] }} days
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No upcoming deadlines</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
