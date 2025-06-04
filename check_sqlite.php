<?php
echo "Checking SQLite support...\n";
echo "SQLite3 class exists: " . (class_exists('SQLite3') ? 'YES' : 'NO') . "\n";
echo "PDO SQLite driver: " . (in_array('sqlite', PDO::getAvailableDrivers()) ? 'YES' : 'NO') . "\n";
echo "Extension loaded pdo_sqlite: " . (extension_loaded('pdo_sqlite') ? 'YES' : 'NO') . "\n";
echo "Extension loaded sqlite3: " . (extension_loaded('sqlite3') ? 'YES' : 'NO') . "\n";

if (class_exists('SQLite3')) {
    try {
        $db = new SQLite3(':memory:');
        echo "SQLite3 test connection: SUCCESS\n";
        $db->close();
    } catch (Exception $e) {
        echo "SQLite3 test connection: FAILED - " . $e->getMessage() . "\n";
    }
}

if (in_array('sqlite', PDO::getAvailableDrivers())) {
    try {
        $pdo = new PDO('sqlite::memory:');
        echo "PDO SQLite test connection: SUCCESS\n";
    } catch (Exception $e) {
        echo "PDO SQLite test connection: FAILED - " . $e->getMessage() . "\n";
    }
}
?>
