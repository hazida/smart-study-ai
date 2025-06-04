<?php
echo "PHP Version: " . PHP_VERSION . "\n";
echo "PHP Binary: " . PHP_BINARY . "\n";
echo "PHP Extension Dir: " . PHP_EXTENSION_DIR . "\n";
echo "PHP Config File: " . php_ini_loaded_file() . "\n";
echo "PHP Config Dir: " . php_ini_scanned_files() . "\n\n";

echo "Current loaded extensions:\n";
$extensions = get_loaded_extensions();
sort($extensions);
foreach ($extensions as $ext) {
    echo "- $ext\n";
}

echo "\nChecking for SQLite files in extension directory...\n";
$ext_dir = PHP_EXTENSION_DIR;
if (is_dir($ext_dir)) {
    $files = scandir($ext_dir);
    foreach ($files as $file) {
        if (strpos(strtolower($file), 'sqlite') !== false) {
            echo "Found: $file\n";
        }
    }
} else {
    echo "Extension directory not found: $ext_dir\n";
}

echo "\nTo enable SQLite, you need to:\n";
echo "1. Ensure php_sqlite3.dll and php_pdo_sqlite.dll are in the extension directory\n";
echo "2. Add these lines to php.ini:\n";
echo "   extension=sqlite3\n";
echo "   extension=pdo_sqlite\n";
echo "3. Restart the web server\n";
?>
