<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Answer::with(['question.note', 'feedback']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('answer_text', 'like', "%{$search}%");
        }

        // Filter by correctness
        if ($request->filled('is_correct')) {
            $query->where('is_correct', $request->is_correct === 'true');
        }

        // Filter by question
        if ($request->filled('question_id')) {
            $query->where('question_id', $request->question_id);
        }

        $answers = $query->orderBy('created_at', 'desc')->paginate(15);

        // For filters
        $questions = Question::with('note')->orderBy('created_at', 'desc')->get();

        return view('admin.answers.index', compact('answers', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::with('note')->orderBy('created_at', 'desc')->get();

        return view('admin.answers.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,question_id',
            'answer_text' => 'required|string',
            'is_correct' => 'boolean',
        ]);

        Answer::create([
            'answer_id' => (string) Str::uuid(),
            'question_id' => $validated['question_id'],
            'answer_text' => $validated['answer_text'],
            'is_correct' => $request->boolean('is_correct'),
        ]);

        return redirect()->route('admin.answers.index')
                        ->with('success', 'Answer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        $answer->load(['question.note.user', 'feedback.user']);

        $stats = [
            'feedback_count' => $answer->feedback()->count(),
            'avg_rating' => $answer->feedback()->avg('rating'),
            'character_count' => $answer->character_count,
            'word_count' => $answer->word_count,
        ];

        return view('admin.answers.show', compact('answer', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        $questions = Question::with('note')->orderBy('created_at', 'desc')->get();

        return view('admin.answers.edit', compact('answer', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,question_id',
            'answer_text' => 'required|string',
            'is_correct' => 'boolean',
        ]);

        $answer->update([
            'question_id' => $validated['question_id'],
            'answer_text' => $validated['answer_text'],
            'is_correct' => $request->boolean('is_correct'),
        ]);

        return redirect()->route('admin.answers.index')
                        ->with('success', 'Answer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return redirect()->route('admin.answers.index')
                        ->with('success', 'Answer deleted successfully.');
    }

    /**
     * Toggle answer correctness.
     */
    public function toggleCorrectness(Answer $answer)
    {
        $answer->update(['is_correct' => !$answer->is_correct]);

        $status = $answer->is_correct ? 'marked as correct' : 'marked as incorrect';
        return redirect()->back()->with('success', "Answer {$status} successfully.");
    }

    /**
     * Bulk update answer correctness.
     */
    public function bulkUpdateCorrectness(Request $request)
    {
        $validated = $request->validate([
            'answer_ids' => 'required|array',
            'answer_ids.*' => 'exists:answers,answer_id',
            'is_correct' => 'required|boolean',
        ]);

        Answer::whereIn('answer_id', $validated['answer_ids'])
              ->update(['is_correct' => $validated['is_correct']]);

        return redirect()->back()
                        ->with('success', 'Answers updated successfully.');
    }
}
