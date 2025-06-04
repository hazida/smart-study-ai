<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('session.guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('session.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Settings Routes
    Route::get('/profile', function () {
        return view('profile.settings');
    })->name('profile.settings');

    Route::post('/profile', function () {
        // Validate the request
        $validated = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
            'timezone' => 'required|string',
            'language' => 'required|string',
            'notifications_email' => 'boolean',
            'notifications_browser' => 'boolean',
            'notifications_marketing' => 'boolean',
        ]);

        // Get current user data
        $user = session('user');

        // Update user session data (in a real app, this would update the database)
        $user['name'] = $validated['name'];
        $user['email'] = $validated['email'];

        // Store updated user data in session
        session(['user' => $user]);

        return redirect()->route('profile.settings')->with('success', 'Profile updated successfully!');
    })->name('profile.update');

    // My Questions Routes
    Route::get('/questions', function () {
        // Sample questions data (in a real app, this would come from database)
        $questions = [
            [
                'id' => 1,
                'title' => 'Introduction to Machine Learning',
                'description' => 'Questions generated from ML fundamentals document',
                'question_count' => 15,
                'difficulty' => 'Intermediate',
                'category' => 'Technology',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(1),
                'status' => 'completed',
                'source_type' => 'PDF Document',
                'source_name' => 'ml_fundamentals.pdf',
                'tags' => ['machine-learning', 'ai', 'algorithms'],
                'questions' => [
                    ['question' => 'What is supervised learning?', 'type' => 'multiple_choice', 'difficulty' => 'easy'],
                    ['question' => 'Explain the difference between classification and regression.', 'type' => 'short_answer', 'difficulty' => 'medium'],
                    ['question' => 'What are the main types of machine learning algorithms?', 'type' => 'multiple_choice', 'difficulty' => 'easy'],
                ]
            ],
            [
                'id' => 2,
                'title' => 'JavaScript ES6 Features',
                'description' => 'Modern JavaScript concepts and syntax',
                'question_count' => 12,
                'difficulty' => 'Beginner',
                'category' => 'Programming',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3),
                'status' => 'completed',
                'source_type' => 'Web Article',
                'source_name' => 'ES6 Tutorial - MDN',
                'tags' => ['javascript', 'es6', 'programming'],
                'questions' => [
                    ['question' => 'What is arrow function syntax?', 'type' => 'multiple_choice', 'difficulty' => 'easy'],
                    ['question' => 'How do template literals work?', 'type' => 'short_answer', 'difficulty' => 'medium'],
                ]
            ],
            [
                'id' => 3,
                'title' => 'Digital Marketing Strategy',
                'description' => 'Comprehensive guide to modern marketing',
                'question_count' => 8,
                'difficulty' => 'Advanced',
                'category' => 'Business',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
                'status' => 'processing',
                'source_type' => 'Text Input',
                'source_name' => 'Marketing Strategy Notes',
                'tags' => ['marketing', 'strategy', 'business'],
                'questions' => []
            ],
            [
                'id' => 4,
                'title' => 'React Hooks Deep Dive',
                'description' => 'Advanced React hooks patterns and best practices',
                'question_count' => 20,
                'difficulty' => 'Advanced',
                'category' => 'Programming',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(2),
                'status' => 'completed',
                'source_type' => 'Video Transcript',
                'source_name' => 'React Hooks Masterclass',
                'tags' => ['react', 'hooks', 'frontend'],
                'questions' => [
                    ['question' => 'When should you use useCallback?', 'type' => 'multiple_choice', 'difficulty' => 'hard'],
                    ['question' => 'Explain the useEffect cleanup function.', 'type' => 'essay', 'difficulty' => 'medium'],
                ]
            ],
            [
                'id' => 5,
                'title' => 'Data Structures Fundamentals',
                'description' => 'Core data structures and algorithms',
                'question_count' => 25,
                'difficulty' => 'Intermediate',
                'category' => 'Computer Science',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(8),
                'status' => 'completed',
                'source_type' => 'PDF Document',
                'source_name' => 'data_structures_guide.pdf',
                'tags' => ['data-structures', 'algorithms', 'computer-science'],
                'questions' => [
                    ['question' => 'What is the time complexity of binary search?', 'type' => 'multiple_choice', 'difficulty' => 'medium'],
                    ['question' => 'Compare arrays vs linked lists.', 'type' => 'essay', 'difficulty' => 'medium'],
                ]
            ]
        ];

        return view('questions.index', compact('questions'));
    })->name('questions.index');

    Route::get('/questions/{id}', function ($id) {
        // Sample question detail (in a real app, this would come from database)
        $question = [
            'id' => $id,
            'title' => 'Introduction to Machine Learning',
            'description' => 'Questions generated from ML fundamentals document',
            'question_count' => 15,
            'difficulty' => 'Intermediate',
            'category' => 'Technology',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDays(1),
            'status' => 'completed',
            'source_type' => 'PDF Document',
            'source_name' => 'ml_fundamentals.pdf',
            'tags' => ['machine-learning', 'ai', 'algorithms'],
            'questions' => [
                [
                    'id' => 1,
                    'question' => 'What is supervised learning?',
                    'type' => 'multiple_choice',
                    'difficulty' => 'easy',
                    'options' => [
                        'A type of learning where the algorithm learns from labeled data',
                        'A type of learning where the algorithm learns without any data',
                        'A type of learning where the algorithm supervises other algorithms',
                        'A type of learning that requires human supervision at all times'
                    ],
                    'correct_answer' => 0,
                    'explanation' => 'Supervised learning uses labeled training data to learn a mapping from inputs to outputs.'
                ],
                [
                    'id' => 2,
                    'question' => 'Explain the difference between classification and regression.',
                    'type' => 'short_answer',
                    'difficulty' => 'medium',
                    'sample_answer' => 'Classification predicts discrete categories or classes, while regression predicts continuous numerical values.'
                ],
                [
                    'id' => 3,
                    'question' => 'What are the main types of machine learning algorithms?',
                    'type' => 'multiple_choice',
                    'difficulty' => 'easy',
                    'options' => [
                        'Supervised, Unsupervised, and Reinforcement Learning',
                        'Linear and Non-linear algorithms',
                        'Simple and Complex algorithms',
                        'Fast and Slow algorithms'
                    ],
                    'correct_answer' => 0,
                    'explanation' => 'The three main paradigms of machine learning are supervised, unsupervised, and reinforcement learning.'
                ]
            ]
        ];

        return view('questions.show', compact('question'));
    })->name('questions.show');
});
