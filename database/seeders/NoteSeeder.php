<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $subjects = Subject::all();

        if ($users->isEmpty() || $subjects->isEmpty()) {
            $this->command->warn('Users or Subjects not found. Please run UserSeeder and SubjectSeeder first.');
            return;
        }

        $sampleNotes = [
            [
                'title' => 'Introduction to Algebra',
                'content' => 'Algebra is a branch of mathematics dealing with symbols and the rules for manipulating those symbols. In elementary algebra, those symbols (today written as Latin and Greek letters) represent quantities without fixed values, known as variables. The fundamental principle of algebra is the use of equations to solve for unknown values. Key concepts include: 1) Variables and constants, 2) Linear equations, 3) Quadratic equations, 4) Polynomials, 5) Factoring. Algebra forms the foundation for more advanced mathematical concepts and is essential in many fields including science, engineering, and economics.',
                'status' => 'published',
                'subject' => 'Mathematics'
            ],
            [
                'title' => 'Photosynthesis Process',
                'content' => 'Photosynthesis is the process by which green plants and some other organisms use sunlight to synthesize foods with the help of chlorophyll. The process occurs in two main stages: 1) Light-dependent reactions (occur in thylakoids), 2) Light-independent reactions or Calvin cycle (occur in stroma). The overall equation is: 6CO2 + 6H2O + light energy → C6H12O6 + 6O2. This process is crucial for life on Earth as it produces oxygen and glucose, forming the base of most food chains.',
                'status' => 'published',
                'subject' => 'Science'
            ],
            [
                'title' => 'Shakespeare\'s Literary Techniques',
                'content' => 'William Shakespeare employed various literary techniques that made his works timeless. Key techniques include: 1) Iambic pentameter - a rhythmic pattern of unstressed and stressed syllables, 2) Metaphors and similes for vivid imagery, 3) Soliloquies to reveal character thoughts, 4) Dramatic irony to engage audiences, 5) Wordplay and puns for humor and depth. These techniques helped Shakespeare create complex characters and explore universal themes of love, power, betrayal, and human nature.',
                'status' => 'published',
                'subject' => 'English Language Arts'
            ],
            [
                'title' => 'World War II Timeline',
                'content' => 'World War II (1939-1945) was a global conflict that involved most of the world\'s nations. Key events: September 1939 - Germany invades Poland, triggering the war. June 1941 - Germany invades Soviet Union (Operation Barbarossa). December 7, 1941 - Japan attacks Pearl Harbor, bringing US into war. June 6, 1944 - D-Day landings in Normandy. August 1945 - Atomic bombs dropped on Hiroshima and Nagasaki. September 2, 1945 - Japan surrenders, ending the war. The war resulted in 70-85 million deaths and reshaped the global political landscape.',
                'status' => 'published',
                'subject' => 'History'
            ],
            [
                'title' => 'Object-Oriented Programming Concepts',
                'content' => 'Object-Oriented Programming (OOP) is a programming paradigm based on the concept of objects. Four main principles: 1) Encapsulation - bundling data and methods that work on that data within one unit, 2) Inheritance - mechanism where one class acquires properties of another class, 3) Polymorphism - ability of objects to take multiple forms, 4) Abstraction - hiding complex implementation details while showing only essential features. OOP promotes code reusability, modularity, and easier maintenance.',
                'status' => 'published',
                'subject' => 'Computer Science'
            ],
            [
                'title' => 'Climate Change and Global Warming',
                'content' => 'Climate change refers to long-term shifts in global temperatures and weather patterns. While climate variations are natural, scientific evidence shows that human activities have been the main driver since the 1800s. Primary causes include: 1) Burning fossil fuels releases greenhouse gases, 2) Deforestation reduces CO2 absorption, 3) Industrial processes emit various pollutants. Effects include rising sea levels, extreme weather events, ecosystem disruption, and threats to food security. Mitigation strategies involve renewable energy adoption, energy efficiency, and international cooperation.',
                'status' => 'published',
                'subject' => 'Geography'
            ]
        ];

        foreach ($sampleNotes as $noteData) {
            $randomUser = $users->random();
            $subject = $subjects->where('name', $noteData['subject'])->first();

            $note = Note::create([
                'note_id' => (string) Str::uuid(),
                'user_id' => $randomUser->user_id,
                'title' => $noteData['title'],
                'content' => $noteData['content'],
                'status' => $noteData['status'],
            ]);

            // Associate note with subject
            if ($subject) {
                $note->subjects()->attach($subject->subject_id);
            }
        }

        // Create some additional random notes
        for ($i = 0; $i < 15; $i++) {
            $randomUser = $users->random();
            $randomSubject = $subjects->random();

            $note = Note::create([
                'note_id' => (string) Str::uuid(),
                'user_id' => $randomUser->user_id,
                'title' => 'Study Notes ' . ($i + 1),
                'content' => 'This is a sample note content for studying. It contains important information that students need to remember for their exams. The content covers various topics and concepts that are essential for understanding the subject matter.',
                'status' => rand(0, 1) ? 'published' : 'draft',
            ]);

            // Associate with random subject
            $note->subjects()->attach($randomSubject->subject_id);
        }
    }
}
