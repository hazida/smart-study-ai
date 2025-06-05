<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notes = Note::all();
        $users = User::all();

        if ($notes->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Notes or Users not found. Please run NoteSeeder and UserSeeder first.');
            return;
        }

        // Sample questions and answers for different subjects
        $questionsData = [
            // Mathematics - Algebra
            [
                'question_text' => 'What is the solution to the equation 2x + 5 = 13?',
                'answers' => [
                    ['text' => 'x = 4', 'correct' => true],
                    ['text' => 'x = 3', 'correct' => false],
                    ['text' => 'x = 5', 'correct' => false],
                    ['text' => 'x = 6', 'correct' => false],
                ],
                'difficulty' => 'easy',
                'generated_by' => 'Manual'
            ],
            [
                'question_text' => 'What is a variable in algebra?',
                'answers' => [
                    ['text' => 'A symbol that represents an unknown value', 'correct' => true],
                    ['text' => 'A fixed number', 'correct' => false],
                    ['text' => 'An operation symbol', 'correct' => false],
                    ['text' => 'A mathematical constant', 'correct' => false],
                ],
                'difficulty' => 'easy',
                'generated_by' => 'AI'
            ],

            // Science - Photosynthesis
            [
                'question_text' => 'What are the main products of photosynthesis?',
                'answers' => [
                    ['text' => 'Glucose and oxygen', 'correct' => true],
                    ['text' => 'Carbon dioxide and water', 'correct' => false],
                    ['text' => 'Nitrogen and hydrogen', 'correct' => false],
                    ['text' => 'Protein and lipids', 'correct' => false],
                ],
                'difficulty' => 'medium',
                'generated_by' => 'Manual'
            ],
            [
                'question_text' => 'Where do light-dependent reactions occur in photosynthesis?',
                'answers' => [
                    ['text' => 'In the thylakoids', 'correct' => true],
                    ['text' => 'In the stroma', 'correct' => false],
                    ['text' => 'In the nucleus', 'correct' => false],
                    ['text' => 'In the mitochondria', 'correct' => false],
                ],
                'difficulty' => 'medium',
                'generated_by' => 'AI'
            ],

            // English - Shakespeare
            [
                'question_text' => 'What is iambic pentameter?',
                'answers' => [
                    ['text' => 'A rhythmic pattern of unstressed and stressed syllables', 'correct' => true],
                    ['text' => 'A type of rhyme scheme', 'correct' => false],
                    ['text' => 'A form of metaphor', 'correct' => false],
                    ['text' => 'A dramatic technique', 'correct' => false],
                ],
                'difficulty' => 'medium',
                'generated_by' => 'Manual'
            ],
            [
                'question_text' => 'What is the purpose of a soliloquy in Shakespeare\'s plays?',
                'answers' => [
                    ['text' => 'To reveal a character\'s inner thoughts to the audience', 'correct' => true],
                    ['text' => 'To provide comic relief', 'correct' => false],
                    ['text' => 'To advance the plot quickly', 'correct' => false],
                    ['text' => 'To introduce new characters', 'correct' => false],
                ],
                'difficulty' => 'medium',
                'generated_by' => 'AI'
            ],

            // History - WWII
            [
                'question_text' => 'When did World War II begin?',
                'answers' => [
                    ['text' => 'September 1939', 'correct' => true],
                    ['text' => 'December 1941', 'correct' => false],
                    ['text' => 'June 1941', 'correct' => false],
                    ['text' => 'August 1939', 'correct' => false],
                ],
                'difficulty' => 'easy',
                'generated_by' => 'Manual'
            ],
            [
                'question_text' => 'What event brought the United States into World War II?',
                'answers' => [
                    ['text' => 'Attack on Pearl Harbor', 'correct' => true],
                    ['text' => 'Invasion of Poland', 'correct' => false],
                    ['text' => 'D-Day landings', 'correct' => false],
                    ['text' => 'Battle of Britain', 'correct' => false],
                ],
                'difficulty' => 'easy',
                'generated_by' => 'AI'
            ],

            // Computer Science - OOP
            [
                'question_text' => 'What are the four main principles of Object-Oriented Programming?',
                'answers' => [
                    ['text' => 'Encapsulation, Inheritance, Polymorphism, Abstraction', 'correct' => true],
                    ['text' => 'Variables, Functions, Classes, Objects', 'correct' => false],
                    ['text' => 'Input, Process, Output, Storage', 'correct' => false],
                    ['text' => 'Create, Read, Update, Delete', 'correct' => false],
                ],
                'difficulty' => 'medium',
                'generated_by' => 'Manual'
            ],
            [
                'question_text' => 'What is encapsulation in OOP?',
                'answers' => [
                    ['text' => 'Bundling data and methods within one unit', 'correct' => true],
                    ['text' => 'Creating multiple instances of a class', 'correct' => false],
                    ['text' => 'Inheriting properties from parent class', 'correct' => false],
                    ['text' => 'Hiding implementation details', 'correct' => false],
                ],
                'difficulty' => 'medium',
                'generated_by' => 'AI'
            ]
        ];

        // Create questions and answers for each note
        foreach ($notes->take(6) as $index => $note) {
            if (isset($questionsData[$index * 2])) {
                // Create first question for this note
                $this->createQuestionWithAnswers($note, $questionsData[$index * 2], $users);

                // Create second question for this note if available
                if (isset($questionsData[$index * 2 + 1])) {
                    $this->createQuestionWithAnswers($note, $questionsData[$index * 2 + 1], $users);
                }
            }
        }

        // Create additional random questions for remaining notes
        foreach ($notes->skip(6) as $note) {
            $this->createRandomQuestion($note, $users);
        }
    }

    private function createQuestionWithAnswers($note, $questionData, $users)
    {
        $question = Question::create([
            'question_id' => (string) Str::uuid(),
            'note_id' => $note->note_id,
            'user_id' => $note->user_id,
            'question_text' => $questionData['question_text'],
            'difficulty' => $questionData['difficulty'],
            'generated_by' => $questionData['generated_by'],
        ]);

        // Create answers
        foreach ($questionData['answers'] as $answerData) {
            Answer::create([
                'answer_id' => (string) Str::uuid(),
                'question_id' => $question->question_id,
                'answer_text' => $answerData['text'],
                'is_correct' => $answerData['correct'],
            ]);
        }

        // Create some feedback
        if (rand(0, 1)) {
            $randomUser = $users->random();
            Feedback::create([
                'feedback_id' => (string) Str::uuid(),
                'user_id' => $randomUser->user_id,
                'question_id' => $question->question_id,
                'rating' => rand(3, 5),
                'comments' => 'This is a helpful question for understanding the topic.',
            ]);
        }
    }

    private function createRandomQuestion($note, $users)
    {
        $difficulties = ['easy', 'medium', 'hard'];
        $generatedBy = ['Manual', 'AI'];

        $question = Question::create([
            'question_id' => (string) Str::uuid(),
            'note_id' => $note->note_id,
            'user_id' => $note->user_id,
            'question_text' => 'What is the main concept discussed in this note?',
            'difficulty' => $difficulties[array_rand($difficulties)],
            'generated_by' => $generatedBy[array_rand($generatedBy)],
        ]);

        // Create a simple answer
        Answer::create([
            'answer_id' => (string) Str::uuid(),
            'question_id' => $question->question_id,
            'answer_text' => 'The main concept is explained in the note content.',
            'is_correct' => true,
        ]);
    }
}
