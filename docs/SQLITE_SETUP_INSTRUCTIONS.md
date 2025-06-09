# SQLite Setup Instructions for Laravel Smart Study AI

## Method 1: Using Laragon Interface (Recommended)

1. **Open Laragon Control Panel**
2. **Right-click on Laragon tray icon**
3. **Go to: PHP → Extensions**
4. **Enable these extensions:**
   - ☑️ `sqlite3`
   - ☑️ `pdo_sqlite`
5. **Click "Restart All" in Laragon**

## Method 2: Manual php.ini Configuration

1. **Find your php.ini file location:**
   ```bash
   php --ini
   ```
   
2. **Open the php.ini file in a text editor**

3. **Find and uncomment these lines (remove the semicolon `;`):**
   ```ini
   ;extension=sqlite3
   ;extension=pdo_sqlite
   ```
   
   **Change to:**
   ```ini
   extension=sqlite3
   extension=pdo_sqlite
   ```

4. **Save the file and restart your web server**

## Method 3: Download SQLite DLLs (If extensions are missing)

If the DLL files are not present in your PHP installation:

1. **Download PHP 8.4.x from:** https://windows.php.net/downloads/releases/
2. **Extract the zip file**
3. **Copy these files from the `ext` folder to your PHP `ext` directory:**
   - `php_sqlite3.dll`
   - `php_pdo_sqlite.dll`
4. **Follow Method 2 to enable in php.ini**

## Verification

After enabling SQLite, run this command in your Laravel project:

```bash
cd smart-study-ai
php check_sqlite.php
```

You should see:
- SQLite3 class exists: YES
- PDO SQLite driver: YES
- Extension loaded pdo_sqlite: YES
- Extension loaded sqlite3: YES

## Run Migrations

Once SQLite is enabled:

```bash
cd smart-study-ai
php artisan migrate
```

## Common Issues

1. **"could not find driver" error:** SQLite extensions are not enabled
2. **DLL not found:** SQLite DLL files are missing from PHP ext directory
3. **Permission denied:** Database file permissions issue

## Laravel Configuration

Your `.env` file should have:
```env
DB_CONNECTION=sqlite
# DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD should be commented out
```

The SQLite database file is located at:
`database/database.sqlite`
