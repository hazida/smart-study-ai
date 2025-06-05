<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Feedback::with(['user', 'question.note', 'answer']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('comments', 'like', "%{$search}%");
        }

        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }

        // Filter by type (positive/negative)
        if ($request->filled('type')) {
            if ($request->type === 'positive') {
                $query->where('rating', '>=', 4);
            } elseif ($request->type === 'negative') {
                $query->where('rating', '<=', 2);
            } else {
                $query->where('rating', 3);
            }
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $feedback = $query->orderBy('created_at', 'desc')->paginate(15);

        // For filters
        $users = User::orderBy('name')->get();

        return view('admin.feedback.index', compact('feedback', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        $questions = Question::with('note')->orderBy('created_at', 'desc')->get();
        $answers = Answer::with('question.note')->orderBy('created_at', 'desc')->get();

        return view('admin.feedback.create', compact('users', 'questions', 'answers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'question_id' => 'nullable|exists:questions,question_id',
            'answer_id' => 'nullable|exists:answers,answer_id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'feedback_id' => (string) Str::uuid(),
            'user_id' => $validated['user_id'],
            'question_id' => $validated['question_id'],
            'answer_id' => $validated['answer_id'],
            'rating' => $validated['rating'],
            'comments' => $validated['comments'],
        ]);

        return redirect()->route('admin.feedback.index')
                        ->with('success', 'Feedback created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        $feedback->load(['user.profile', 'question.note', 'answer.question']);

        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        $users = User::orderBy('name')->get();
        $questions = Question::with('note')->orderBy('created_at', 'desc')->get();
        $answers = Answer::with('question.note')->orderBy('created_at', 'desc')->get();

        return view('admin.feedback.edit', compact('feedback', 'users', 'questions', 'answers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'question_id' => 'nullable|exists:questions,question_id',
            'answer_id' => 'nullable|exists:answers,answer_id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        $feedback->update($validated);

        return redirect()->route('admin.feedback.index')
                        ->with('success', 'Feedback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedback.index')
                        ->with('success', 'Feedback deleted successfully.');
    }

    /**
     * Get feedback statistics.
     */
    public function statistics()
    {
        $stats = [
            'total' => Feedback::count(),
            'positive' => Feedback::positive()->count(),
            'negative' => Feedback::negative()->count(),
            'average_rating' => round(Feedback::avg('rating'), 2),
            'by_rating' => Feedback::selectRaw('rating, count(*) as count')
                                  ->groupBy('rating')
                                  ->orderBy('rating')
                                  ->get(),
        ];

        return view('admin.feedback.statistics', compact('stats'));
    }

    /**
     * Bulk delete feedback.
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'feedback_ids' => 'required|array',
            'feedback_ids.*' => 'exists:feedback,feedback_id',
        ]);

        Feedback::whereIn('feedback_id', $validated['feedback_ids'])->delete();

        return redirect()->back()
                        ->with('success', 'Selected feedback deleted successfully.');
    }
}
