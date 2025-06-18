<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class StudentEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all students
        $students = User::where('role', 'student')->get();
        
        // Get all subjects
        $subjects = Subject::all();
        
        if ($students->isEmpty() || $subjects->isEmpty()) {
            $this->command->info('No students or subjects found. Please run UserSeeder and SubjectSeeder first.');
            return;
        }
        
        // Enroll each student in 2-4 random subjects
        foreach ($students as $student) {
            $numberOfSubjects = rand(2, min(4, $subjects->count()));
            $selectedSubjects = $subjects->random($numberOfSubjects);
            
            foreach ($selectedSubjects as $subject) {
                // Check if enrollment already exists
                $exists = DB::table('user_subjects')
                    ->where('user_id', $student->user_id)
                    ->where('subject_id', $subject->subject_id)
                    ->exists();
                    
                if (!$exists) {
                    DB::table('user_subjects')->insert([
                        'user_id' => $student->user_id,
                        'subject_id' => $subject->subject_id,
                        'role_in_subject' => 'student',
                        'level' => collect(['beginner', 'intermediate', 'advanced'])->random(),
                    ]);
                }
            }
        }
        
        $this->command->info('Student enrollments created successfully!');
    }
}
