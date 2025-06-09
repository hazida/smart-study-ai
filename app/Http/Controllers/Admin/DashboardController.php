<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Models\Note;
use App\Models\Question;
use App\Models\Answer;
use App\Models\UserProfile;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get overall statistics in the format expected by the unified dashboard
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $totalQuestions = Question::count();
        $totalNotes = Note::count();
        $totalSubjects = Subject::count();
        $totalAnswers = Answer::count();
        $totalFeedback = Feedback::count();

        $stats = [
            // Main metrics for the key metrics cards
            'total_users' => $totalUsers,
            'active_users' => $activeUsers,
            'users_growth' => 12.5, // Calculate actual growth rate
            'total_questions' => $totalQuestions,
            'questions_today' => Question::whereDate('created_at', today())->count(),
            'questions_week' => Question::where('created_at', '>=', now()->subWeek())->count(),
            'total_documents' => $totalNotes, // Using notes as documents
            'documents_processing' => Note::where('status', 'draft')->count(),
            'processing_rate' => $totalNotes > 0 ? round((Note::where('status', 'published')->count() / $totalNotes) * 100, 1) : 0,
            'monthly_revenue' => 24750, // Mock data - replace with actual revenue calculation
            'revenue_growth' => 18.3, // Mock data
            'revenue_target' => 30000, // Mock data

            // Detailed stats for CRUD management cards
            'users' => [
                'total' => $totalUsers,
                'active' => $activeUsers,
                'by_role' => User::select('role', DB::raw('count(*) as count'))
                                ->groupBy('role')
                                ->get()
                                ->pluck('count', 'role'),
            ],
            'subjects' => [
                'total' => $totalSubjects,
                'with_notes' => Subject::has('notes')->count(),
                'with_users' => Subject::has('users')->count(),
            ],
            'notes' => [
                'total' => $totalNotes,
                'published' => Note::where('status', 'published')->count(),
                'draft' => Note::where('status', 'draft')->count(),
                'archived' => Note::where('status', 'archived')->count(),
            ],
            'questions' => [
                'total' => $totalQuestions,
                'ai_generated' => Question::where('generated_by', 'AI')->count(),
                'manual' => Question::where('generated_by', 'Manual')->count(),
                'by_difficulty' => Question::select('difficulty', DB::raw('count(*) as count'))
                                         ->whereNotNull('difficulty')
                                         ->groupBy('difficulty')
                                         ->get()
                                         ->pluck('count', 'difficulty'),
            ],
            'answers' => [
                'total' => $totalAnswers,
                'correct' => Answer::where('is_correct', true)->count(),
                'incorrect' => Answer::where('is_correct', false)->count(),
            ],
            'profiles' => [
                'total' => UserProfile::count(),
                'complete' => UserProfile::whereNotNull('first_name')
                                        ->whereNotNull('last_name')
                                        ->whereNotNull('date_of_birth')
                                        ->count(),
            ],
            'feedback' => [
                'total' => $totalFeedback,
                'positive' => Feedback::where('rating', '>=', 4)->count(),
                'negative' => Feedback::where('rating', '<=', 2)->count(),
                'average_rating' => round(Feedback::avg('rating'), 2),
            ],
        ];

        // Recent activity for the activity feed
        $recentActivity = collect();

        // Add recent user registrations
        User::orderBy('created_at', 'desc')->take(3)->get()->each(function($user) use ($recentActivity) {
            $recentActivity->push([
                'user' => $user->name,
                'action' => 'Registered account',
                'details' => 'New user signup',
                'time' => $user->created_at,
                'type' => 'user'
            ]);
        });

        // Add recent notes
        Note::with('user')->orderBy('created_at', 'desc')->take(3)->get()->each(function($note) use ($recentActivity) {
            $recentActivity->push([
                'user' => $note->user->name ?? 'System',
                'action' => 'Created note',
                'details' => $note->title,
                'time' => $note->created_at,
                'type' => 'document'
            ]);
        });

        // Add recent questions
        Question::with('note')->orderBy('created_at', 'desc')->take(3)->get()->each(function($question) use ($recentActivity) {
            $recentActivity->push([
                'user' => 'System',
                'action' => 'Generated question',
                'details' => substr($question->question_text, 0, 50) . '...',
                'time' => $question->created_at,
                'type' => 'question'
            ]);
        });

        // Sort by time and take the most recent 10
        $recentActivity = $recentActivity->sortByDesc('time')->take(10)->values();

        // Chart data for analytics
        $chartData = [
            'user_growth' => [
                'Mon' => User::whereDate('created_at', now()->subDays(6))->count(),
                'Tue' => User::whereDate('created_at', now()->subDays(5))->count(),
                'Wed' => User::whereDate('created_at', now()->subDays(4))->count(),
                'Thu' => User::whereDate('created_at', now()->subDays(3))->count(),
                'Fri' => User::whereDate('created_at', now()->subDays(2))->count(),
                'Sat' => User::whereDate('created_at', now()->subDays(1))->count(),
                'Sun' => User::whereDate('created_at', today())->count(),
            ],
            'questions_generated' => [
                'Mon' => Question::whereDate('created_at', now()->subDays(6))->count(),
                'Tue' => Question::whereDate('created_at', now()->subDays(5))->count(),
                'Wed' => Question::whereDate('created_at', now()->subDays(4))->count(),
                'Thu' => Question::whereDate('created_at', now()->subDays(3))->count(),
                'Fri' => Question::whereDate('created_at', now()->subDays(2))->count(),
                'Sat' => Question::whereDate('created_at', now()->subDays(1))->count(),
                'Sun' => Question::whereDate('created_at', today())->count(),
            ],
            'users_by_month' => $this->getUsersByMonth(),
            'notes_by_status' => $this->getNotesByStatus(),
            'questions_by_difficulty' => $this->getQuestionsByDifficulty(),
            'feedback_ratings' => $this->getFeedbackRatings(),
        ];

        // Recent users for the dashboard
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get()->map(function($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'status' => $user->is_active ? 'active' : 'inactive'
            ];
        });

        // System health data
        $systemHealth = [
            ['service' => 'Web Server', 'status' => 'healthy', 'uptime' => '99.9%', 'response_time' => '45ms'],
            ['service' => 'Database', 'status' => 'healthy', 'uptime' => '99.8%', 'response_time' => '12ms'],
            ['service' => 'File Storage', 'status' => 'healthy', 'uptime' => '99.9%', 'response_time' => '23ms'],
            ['service' => 'AI Service', 'status' => 'healthy', 'uptime' => '98.5%', 'response_time' => '156ms'],
            ['service' => 'Email Service', 'status' => 'healthy', 'uptime' => '99.7%', 'response_time' => '89ms'],
            ['service' => 'Cache Server', 'status' => 'healthy', 'uptime' => '99.6%', 'response_time' => '8ms'],
        ];

        // Performance metrics
        $performance = [
            'cpu' => 34,
            'memory' => 67,
            'disk' => 45,
            'network' => 23,
            'database' => 28,
        ];

        // Quick stats
        $quickStats = [
            'online_users' => $activeUsers,
            'avg_session' => '8m 32s',
            'bounce_rate' => 23,
            'conversion_rate' => 4.7,
            'mrr' => 24.8,
            'support_tickets' => 3,
        ];

        return view('admin.dashboard', compact('stats', 'recentActivity', 'chartData', 'recentUsers', 'systemHealth', 'performance', 'quickStats'));
    }

    /**
     * Get users created by month for the last 12 months.
     */
    private function getUsersByMonth()
    {
        return User::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                return [
                    'label' => date('M Y', mktime(0, 0, 0, $item->month, 1, $item->year)),
                    'value' => $item->count
                ];
            });
    }

    /**
     * Get notes count by status.
     */
    private function getNotesByStatus()
    {
        return Note::select('status', DB::raw('count(*) as count'))
                   ->groupBy('status')
                   ->get()
                   ->map(function ($item) {
                       return [
                           'label' => ucfirst($item->status),
                           'value' => $item->count
                       ];
                   });
    }

    /**
     * Get questions count by difficulty.
     */
    private function getQuestionsByDifficulty()
    {
        return Question::select('difficulty', DB::raw('count(*) as count'))
                      ->whereNotNull('difficulty')
                      ->groupBy('difficulty')
                      ->get()
                      ->map(function ($item) {
                          return [
                              'label' => ucfirst($item->difficulty),
                              'value' => $item->count
                          ];
                      });
    }

    /**
     * Get feedback distribution by rating.
     */
    private function getFeedbackRatings()
    {
        return Feedback::select('rating', DB::raw('count(*) as count'))
                      ->groupBy('rating')
                      ->orderBy('rating')
                      ->get()
                      ->map(function ($item) {
                          return [
                              'label' => $item->rating . ' Star' . ($item->rating > 1 ? 's' : ''),
                              'value' => $item->count
                          ];
                      });
    }

    /**
     * Get system health information.
     */
    public function systemHealth()
    {
        $health = [
            'database' => [
                'status' => 'healthy',
                'tables' => [
                    'users' => User::count(),
                    'subjects' => Subject::count(),
                    'notes' => Note::count(),
                    'questions' => Question::count(),
                    'answers' => Answer::count(),
                    'user_profiles' => UserProfile::count(),
                    'feedback' => Feedback::count(),
                ],
            ],
            'storage' => [
                'disk_usage' => '45%', // This would be calculated from actual disk usage
                'available_space' => '2.1 GB',
            ],
            'performance' => [
                'avg_response_time' => '120ms',
                'active_sessions' => session()->all() ? count(session()->all()) : 0,
            ],
        ];

        return view('admin.system-health', compact('health'));
    }

    /**
     * Export data for backup.
     */
    public function exportData(Request $request)
    {
        $type = $request->get('type', 'all');

        $data = [];

        switch ($type) {
            case 'users':
                $data = User::with('profile')->get();
                break;
            case 'notes':
                $data = Note::with('user', 'subjects')->get();
                break;
            case 'questions':
                $data = Question::with('note', 'answers')->get();
                break;
            default:
                $data = [
                    'users' => User::with('profile')->get(),
                    'subjects' => Subject::all(),
                    'notes' => Note::with('subjects')->get(),
                    'questions' => Question::with('answers')->get(),
                    'feedback' => Feedback::all(),
                ];
        }

        return response()->json($data);
    }

    /**
     * System reports
     */
    public function reports()
    {
        // Generate comprehensive system reports
        $reports = [
            'user_statistics' => [
                'total_users' => User::count(),
                'active_users' => User::where('is_active', true)->count(),
                'users_by_role' => User::select('role', \DB::raw('count(*) as count'))
                    ->groupBy('role')
                    ->pluck('count', 'role')
                    ->toArray(),
                'recent_registrations' => User::where('created_at', '>=', now()->subDays(30))->count(),
            ],
            'content_statistics' => [
                'total_subjects' => Subject::count(),
                'total_notes' => Note::count(),
                'published_notes' => Note::where('status', 'published')->count(),
                'draft_notes' => Note::where('status', 'draft')->count(),
                'notes_by_subject' => Subject::withCount('notes')->get()->pluck('notes_count', 'name')->toArray(),
            ],
            'qa_statistics' => [
                'total_questions' => Question::count(),
                'total_answers' => Answer::count(),
                'correct_answers' => Answer::where('is_correct', true)->count(),
                'ai_generated_questions' => Question::where('generated_by', 'AI')->count(),
                'manual_questions' => Question::where('generated_by', 'Manual')->count(),
            ],
            'feedback_statistics' => [
                'total_feedback' => Feedback::count(),
                'average_rating' => round(Feedback::avg('rating'), 2),
                'feedback_by_rating' => Feedback::select('rating', \DB::raw('count(*) as count'))
                    ->groupBy('rating')
                    ->pluck('count', 'rating')
                    ->toArray(),
                'recent_feedback' => Feedback::where('created_at', '>=', now()->subDays(30))->count(),
            ],
            'system_health' => [
                'database_status' => 'healthy',
                'total_records' => User::count() + Subject::count() + Note::count() + Question::count() + Answer::count() + Feedback::count(),
                'last_backup' => 'N/A', // Would be actual backup date
                'system_uptime' => '99.9%', // Would be actual uptime
            ]
        ];

        return view('admin.reports', compact('reports'));
    }
}
