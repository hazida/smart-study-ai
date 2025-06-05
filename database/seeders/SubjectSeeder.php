<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'Mathematics',
                'description' => 'Study of numbers, shapes, and patterns including algebra, geometry, calculus, and statistics.',
            ],
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'Science',
                'description' => 'Natural sciences including physics, chemistry, biology, and earth sciences.',
            ],
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'English Language Arts',
                'description' => 'Reading, writing, speaking, and listening skills in English language and literature.',
            ],
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'History',
                'description' => 'Study of past events, civilizations, and their impact on the modern world.',
            ],
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'Computer Science',
                'description' => 'Programming, algorithms, data structures, and computational thinking.',
            ],
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'Geography',
                'description' => 'Study of Earth\'s landscapes, environments, and the relationships between people and their environments.',
            ],
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'Art',
                'description' => 'Visual arts, creative expression, and artistic techniques and history.',
            ],
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'Music',
                'description' => 'Musical theory, performance, composition, and music history.',
            ],
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'Physical Education',
                'description' => 'Physical fitness, sports, health education, and wellness.',
            ],
            [
                'subject_id' => (string) Str::uuid(),
                'name' => 'Foreign Languages',
                'description' => 'Learning and mastering languages other than one\'s native language.',
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
