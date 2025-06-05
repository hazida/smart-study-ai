<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Subject::withCount(['users', 'notes']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $subjects = $query->orderBy('name')->paginate(15);

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects',
            'description' => 'nullable|string|max:1000',
        ]);

        Subject::create([
            'subject_id' => (string) Str::uuid(),
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.subjects.index')
                        ->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject->load(['users.profile', 'notes.user']);

        $stats = [
            'total_users' => $subject->users()->count(),
            'teachers' => $subject->teachers()->count(),
            'students' => $subject->students()->count(),
            'total_notes' => $subject->notes()->count(),
            'published_notes' => $subject->notes()->where('status', 'published')->count(),
        ];

        return view('admin.subjects.show', compact('subject', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->subject_id . ',subject_id',
            'description' => 'nullable|string|max:1000',
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subjects.index')
                        ->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        // Check if subject has associated data
        $hasUsers = $subject->users()->exists();
        $hasNotes = $subject->notes()->exists();

        if ($hasUsers || $hasNotes) {
            return redirect()->route('admin.subjects.index')
                            ->with('error', 'Cannot delete subject with associated users or notes.');
        }

        $subject->delete();

        return redirect()->route('admin.subjects.index')
                        ->with('success', 'Subject deleted successfully.');
    }

    /**
     * Get subject statistics for API.
     */
    public function statistics(Subject $subject)
    {
        return response()->json([
            'users_count' => $subject->users()->count(),
            'notes_count' => $subject->notes()->count(),
            'teachers_count' => $subject->teachers()->count(),
            'students_count' => $subject->students()->count(),
        ]);
    }
}
