<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Models\Note;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get enrolled subjects with progress data
        $enrolledSubjects = $this->getEnrolledSubjectsWithProgress($user);
        
        // Get overall statistics
        $stats = $this->getStudentStats($user);
        
        // Get recent activity
        $recentActivity = $this->getRecentActivity($user);
        
        // Get upcoming deadlines and milestones
        $upcomingDeadlines = $this->getUpcomingDeadlines($user);
        
        // Get study streak and achievements
        $studyStreak = $this->getStudyStreak($user);
        
        return view('student.dashboard', compact(
            'enrolledSubjects', 
            'stats', 
            'recentActivity', 
            'upcomingDeadlines',
            'studyStreak'
        ));
    }
    
    /**
     * Get enrolled subjects with progress tracking
     */
    private function getEnrolledSubjectsWithProgress($user)
    {
        $subjects = $user->subjects()
            ->wherePivot('role_in_subject', 'student')
            ->with(['notes' => function($query) {
                $query->where('status', 'published');
            }])
            ->get();
            
        $subjectsWithProgress = [];
        
        foreach ($subjects as $subject) {
            $totalTopics = $subject->notes->count();
            $completedTopics = $this->getCompletedTopics($user, $subject);
            $progressPercentage = $totalTopics > 0 ? round(($completedTopics / $totalTopics) * 100, 1) : 0;
            
            // Calculate timeline for 1-year completion
            $timeline = $this->calculateTimeline($subject, $progressPercentage);
            
            $subjectsWithProgress[] = [
                'subject' => $subject,
                'total_topics' => $totalTopics,
                'completed_topics' => $completedTopics,
                'progress_percentage' => $progressPercentage,
                'timeline' => $timeline,
                'level' => $subject->pivot->level ?? 'beginner',
                'enrollment_date' => $subject->pivot->created_at ?? now(),
            ];
        }
        
        return collect($subjectsWithProgress);
    }
    
    /**
     * Get completed topics for a user in a subject
     */
    private function getCompletedTopics($user, $subject)
    {
        // This would typically come from a user_progress table
        // For now, we'll simulate based on user's questions answered correctly
        $correctAnswers = Answer::whereHas('question', function($query) use ($subject) {
            $query->whereHas('notes', function($noteQuery) use ($subject) {
                $noteQuery->whereHas('subjects', function($subjectQuery) use ($subject) {
                    $subjectQuery->where('subject_id', $subject->subject_id);
                });
            });
        })
        ->where('user_id', $user->user_id)
        ->where('is_correct', true)
        ->distinct('question_id')
        ->count();
        
        // Estimate completed topics based on correct answers
        return min($correctAnswers, $subject->notes->count());
    }
    
    /**
     * Calculate timeline for subject completion
     */
    private function calculateTimeline($subject, $currentProgress)
    {
        $totalTopics = $subject->notes->count();
        $remainingTopics = $totalTopics - ($totalTopics * $currentProgress / 100);
        
        // Assume 1 topic per week for steady progress
        $weeksToComplete = max(1, ceil($remainingTopics));
        $estimatedCompletion = now()->addWeeks($weeksToComplete);
        
        // Calculate milestones (quarterly checkpoints)
        $milestones = [];
        for ($i = 1; $i <= 4; $i++) {
            $milestoneDate = now()->addMonths($i * 3);
            $expectedProgress = min(100, $currentProgress + ($i * 25));
            
            $milestones[] = [
                'quarter' => "Q{$i}",
                'date' => $milestoneDate,
                'expected_progress' => $expectedProgress,
                'topics_target' => ceil($totalTopics * $expectedProgress / 100),
            ];
        }
        
        return [
            'estimated_completion' => $estimatedCompletion,
            'weeks_remaining' => $weeksToComplete,
            'milestones' => $milestones,
            'daily_target' => $remainingTopics > 0 ? round($remainingTopics / ($weeksToComplete * 7), 1) : 0,
        ];
    }
    
    /**
     * Get student statistics
     */
    private function getStudentStats($user)
    {
        $totalSubjects = $user->subjects()->wherePivot('role_in_subject', 'student')->count();
        $totalQuestions = Question::where('user_id', $user->user_id)->count();
        $correctAnswers = Answer::where('user_id', $user->user_id)->where('is_correct', true)->count();
        $totalAnswers = Answer::where('user_id', $user->user_id)->count();
        $accuracyRate = $totalAnswers > 0 ? round(($correctAnswers / $totalAnswers) * 100, 1) : 0;
        
        return [
            'enrolled_subjects' => $totalSubjects,
            'questions_answered' => $totalAnswers,
            'correct_answers' => $correctAnswers,
            'accuracy_rate' => $accuracyRate,
            'study_hours_week' => 12, // This would come from activity tracking
            'notes_created' => $user->notes()->count(),
        ];
    }
    
    /**
     * Get recent activity
     */
    private function getRecentActivity($user)
    {
        $activities = [];
        
        // Recent questions answered
        $recentAnswers = Answer::where('user_id', $user->user_id)
            ->with(['question.notes.subjects'])
            ->latest()
            ->take(5)
            ->get();
            
        foreach ($recentAnswers as $answer) {
            $activities[] = [
                'type' => 'answer',
                'description' => $answer->is_correct ? 'Answered correctly' : 'Answered incorrectly',
                'subject' => $answer->question->notes->first()->subjects->first()->name ?? 'Unknown',
                'time' => $answer->created_at,
                'icon' => $answer->is_correct ? 'check-circle' : 'x-circle',
                'color' => $answer->is_correct ? 'green' : 'red',
            ];
        }
        
        // Recent notes created
        $recentNotes = $user->notes()->latest()->take(3)->get();
        foreach ($recentNotes as $note) {
            $activities[] = [
                'type' => 'note',
                'description' => 'Created note: ' . $note->title,
                'subject' => $note->subjects->first()->name ?? 'General',
                'time' => $note->created_at,
                'icon' => 'document-text',
                'color' => 'blue',
            ];
        }
        
        return collect($activities)->sortByDesc('time')->take(8);
    }
    
    /**
     * Get upcoming deadlines
     */
    private function getUpcomingDeadlines($user)
    {
        $deadlines = [];
        
        $subjects = $user->subjects()->wherePivot('role_in_subject', 'student')->get();
        
        foreach ($subjects as $subject) {
            // Calculate next milestone deadline
            $nextMilestone = now()->addMonths(3)->startOfMonth();
            
            $deadlines[] = [
                'title' => $subject->name . ' - Quarterly Review',
                'date' => $nextMilestone,
                'type' => 'milestone',
                'subject' => $subject->name,
                'days_remaining' => now()->diffInDays($nextMilestone),
            ];
        }
        
        return collect($deadlines)->sortBy('date')->take(5);
    }
    
    /**
     * Get study streak information
     */
    private function getStudyStreak($user)
    {
        // This would typically track daily activity
        // For now, we'll simulate based on recent activity
        $recentDays = Answer::where('user_id', $user->user_id)
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date')
            ->distinct()
            ->count();
            
        return [
            'current_streak' => min($recentDays, 7), // Max 7 days for demo
            'longest_streak' => 15, // This would be tracked in database
            'total_study_days' => $recentDays,
            'weekly_goal' => 5,
            'weekly_progress' => min($recentDays, 5),
        ];
    }
}
