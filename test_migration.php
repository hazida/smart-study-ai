<?php
// Simple test to check if we can run migrations without SQLite
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

try {
    echo "Testing Laravel database connection...\n";
    
    // Try to load Laravel environment
    $app = require_once 'bootstrap/app.php';
    
    echo "Laravel application loaded successfully!\n";
    echo "Environment: " . $app->environment() . "\n";
    
    // Check database configuration
    $config = $app->make('config');
    $dbConnection = $config->get('database.default');
    echo "Database connection: " . $dbConnection . "\n";
    
    if ($dbConnection === 'sqlite') {
        $dbPath = $config->get('database.connections.sqlite.database');
        echo "SQLite database path: " . $dbPath . "\n";
        echo "Database file exists: " . (file_exists($dbPath) ? 'YES' : 'NO') . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "This is likely due to missing SQLite extensions.\n";
    echo "Please follow the instructions in SQLITE_SETUP_INSTRUCTIONS.md\n";
}
?>
