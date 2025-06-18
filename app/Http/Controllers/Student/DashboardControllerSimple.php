<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardControllerSimple extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login');
            }
            
            // Simple stats
            $stats = [
                'enrolled_subjects' => 3,
                'questions_answered' => 25,
                'accuracy_rate' => 85.5,
                'study_hours_week' => 12,
                'notes_created' => 8,
            ];
            
            // Simple enrolled subjects data
            $enrolledSubjects = collect([
                [
                    'subject' => (object)[
                        'name' => 'Mathematics',
                        'description' => 'Advanced mathematics concepts'
                    ],
                    'total_topics' => 20,
                    'completed_topics' => 12,
                    'progress_percentage' => 60.0,
                    'level' => 'intermediate',
                    'timeline' => [
                        'estimated_completion' => now()->addMonths(6),
                        'weeks_remaining' => 24,
                        'daily_target' => 0.3,
                        'milestones' => [
                            ['quarter' => 'Q1', 'date' => now()->addMonths(3), 'expected_progress' => 75, 'topics_target' => 15],
                            ['quarter' => 'Q2', 'date' => now()->addMonths(6), 'expected_progress' => 100, 'topics_target' => 20],
                            ['quarter' => 'Q3', 'date' => now()->addMonths(9), 'expected_progress' => 100, 'topics_target' => 20],
                            ['quarter' => 'Q4', 'date' => now()->addMonths(12), 'expected_progress' => 100, 'topics_target' => 20],
                        ]
                    ]
                ],
                [
                    'subject' => (object)[
                        'name' => 'Science',
                        'description' => 'General science fundamentals'
                    ],
                    'total_topics' => 15,
                    'completed_topics' => 8,
                    'progress_percentage' => 53.3,
                    'level' => 'beginner',
                    'timeline' => [
                        'estimated_completion' => now()->addMonths(8),
                        'weeks_remaining' => 32,
                        'daily_target' => 0.2,
                        'milestones' => [
                            ['quarter' => 'Q1', 'date' => now()->addMonths(3), 'expected_progress' => 70, 'topics_target' => 11],
                            ['quarter' => 'Q2', 'date' => now()->addMonths(6), 'expected_progress' => 90, 'topics_target' => 14],
                            ['quarter' => 'Q3', 'date' => now()->addMonths(9), 'expected_progress' => 100, 'topics_target' => 15],
                            ['quarter' => 'Q4', 'date' => now()->addMonths(12), 'expected_progress' => 100, 'topics_target' => 15],
                        ]
                    ]
                ]
            ]);
            
            // Simple recent activity
            $recentActivity = collect([
                [
                    'type' => 'answer',
                    'description' => 'Answered correctly',
                    'subject' => 'Mathematics',
                    'time' => now()->subHours(2),
                    'icon' => 'check-circle',
                    'color' => 'green',
                ],
                [
                    'type' => 'note',
                    'description' => 'Created note: Algebra Basics',
                    'subject' => 'Mathematics',
                    'time' => now()->subHours(5),
                    'icon' => 'document-text',
                    'color' => 'blue',
                ]
            ]);
            
            // Simple upcoming deadlines
            $upcomingDeadlines = collect([
                [
                    'title' => 'Mathematics - Quarterly Review',
                    'date' => now()->addMonths(3),
                    'type' => 'milestone',
                    'subject' => 'Mathematics',
                    'days_remaining' => 90,
                ]
            ]);
            
            // Simple study streak
            $studyStreak = [
                'current_streak' => 5,
                'longest_streak' => 15,
                'total_study_days' => 25,
                'weekly_goal' => 5,
                'weekly_progress' => 4,
            ];
            
            return view('student.dashboard', compact(
                'enrolledSubjects', 
                'stats', 
                'recentActivity', 
                'upcomingDeadlines',
                'studyStreak'
            ));
            
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Student Dashboard Error: ' . $e->getMessage());
            
            // Return a simple error view or redirect
            return view('dashboard')->with('error', 'Unable to load student dashboard. Please try again.');
        }
    }
}
