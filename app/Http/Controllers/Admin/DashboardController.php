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
        // Get overall statistics
        $stats = [
            'users' => [
                'total' => User::count(),
                'active' => User::where('is_active', true)->count(),
                'by_role' => User::select('role', DB::raw('count(*) as count'))
                                ->groupBy('role')
                                ->get()
                                ->pluck('count', 'role'),
            ],
            'subjects' => [
                'total' => Subject::count(),
                'with_notes' => Subject::has('notes')->count(),
                'with_users' => Subject::has('users')->count(),
            ],
            'notes' => [
                'total' => Note::count(),
                'published' => Note::where('status', 'published')->count(),
                'draft' => Note::where('status', 'draft')->count(),
                'archived' => Note::where('status', 'archived')->count(),
            ],
            'questions' => [
                'total' => Question::count(),
                'ai_generated' => Question::where('generated_by', 'AI')->count(),
                'manual' => Question::where('generated_by', 'Manual')->count(),
                'by_difficulty' => Question::select('difficulty', DB::raw('count(*) as count'))
                                         ->whereNotNull('difficulty')
                                         ->groupBy('difficulty')
                                         ->get()
                                         ->pluck('count', 'difficulty'),
            ],
            'answers' => [
                'total' => Answer::count(),
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
                'total' => Feedback::count(),
                'positive' => Feedback::where('rating', '>=', 4)->count(),
                'negative' => Feedback::where('rating', '<=', 2)->count(),
                'average_rating' => round(Feedback::avg('rating'), 2),
            ],
        ];

        // Recent activity
        $recentActivity = [
            'users' => User::orderBy('created_at', 'desc')->take(5)->get(),
            'notes' => Note::with('user')->orderBy('created_at', 'desc')->take(5)->get(),
            'questions' => Question::with('note')->orderBy('created_at', 'desc')->take(5)->get(),
            'feedback' => Feedback::with('user')->orderBy('created_at', 'desc')->take(5)->get(),
        ];

        // Chart data for analytics
        $chartData = [
            'users_by_month' => $this->getUsersByMonth(),
            'notes_by_status' => $this->getNotesByStatus(),
            'questions_by_difficulty' => $this->getQuestionsByDifficulty(),
            'feedback_ratings' => $this->getFeedbackRatings(),
        ];

        return view('admin.dashboard', compact('stats', 'recentActivity', 'chartData'));
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
}
