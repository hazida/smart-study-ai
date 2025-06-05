<?php

/**
 * Script to fix syntax errors in migration files
 */

$migrationFiles = [
    'database/migrations/2025_06_05_045137_create_lessons_table.php',
    'database/migrations/2025_06_05_045138_create_quizzes_table.php',
    'database/migrations/2025_06_05_045140_create_classes_table.php',
    'database/migrations/2025_06_05_045141_create_note_subjects_table.php',
    'database/migrations/2025_06_05_045142_create_feedback_table.php',
    'database/migrations/2025_06_05_045143_create_chat_history_table.php'
];

function fixMigrationFile($filePath) {
    if (!file_exists($filePath)) {
        echo "File not found: $filePath\n";
        return false;
    }
    
    $content = file_get_contents($filePath);
    
    // Fix common syntax issues
    $content = preg_replace('/\s+public function up\(\): void/', '    public function up(): void', $content);
    $content = preg_replace('/\s+public function down\(\): void/', '    public function down(): void', $content);
    
    // Remove extra closing braces and parentheses
    $content = preg_replace('/\}\s*\)\s*;\s*\}\s*;\s*\}/', '        });
    }', $content);
    
    // Fix malformed method endings
    $content = preg_replace('/\}\s*\)\s*;\s*\}\s*\}/', '        });
    }', $content);
    
    file_put_contents($filePath, $content);
    echo "Fixed: " . basename($filePath) . "\n";
    return true;
}

echo "Fixing migration syntax errors...\n\n";

foreach ($migrationFiles as $file) {
    fixMigrationFile($file);
}

echo "\nAll migration files fixed!\n";
