#!/bin/bash

# QuestionCraft Authentication Testing Script
# This script runs comprehensive tests for the authentication system

echo "=== QuestionCraft Authentication Test Suite ==="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    if [ "$2" = "PASS" ]; then
        echo -e "${GREEN}✓ $1${NC}"
    elif [ "$2" = "FAIL" ]; then
        echo -e "${RED}✗ $1${NC}"
    elif [ "$2" = "INFO" ]; then
        echo -e "${BLUE}ℹ $1${NC}"
    else
        echo -e "${YELLOW}⚠ $1${NC}"
    fi
}

# Check if Laravel server is running
print_status "Checking if Laravel server is running..." "INFO"
if curl -s http://127.0.0.1:8000 > /dev/null; then
    print_status "Laravel server is running" "PASS"
else
    print_status "Laravel server is not running. Please start it with 'php artisan serve'" "FAIL"
    exit 1
fi

# Check if MySQL is running
print_status "Checking MySQL connection..." "INFO"
if php -r "
try {
    \$pdo = new PDO('mysql:host=127.0.0.1;dbname=smart_study_ai', 'root', '');
    echo 'Connected';
} catch (Exception \$e) {
    echo 'Failed';
}
" | grep -q "Connected"; then
    print_status "MySQL connection successful" "PASS"
else
    print_status "MySQL connection failed" "FAIL"
    exit 1
fi

# Run database tests
print_status "Running database authentication tests..." "INFO"
if php tests/database_test_script.php | grep -q "Success Rate: 100%"; then
    print_status "Database tests passed" "PASS"
else
    print_status "Database tests failed" "FAIL"
fi

# Run Laravel feature tests
print_status "Running Laravel feature tests..." "INFO"
if php artisan test tests/Feature/AuthenticationTest.php --quiet; then
    print_status "Laravel feature tests passed" "PASS"
else
    print_status "Laravel feature tests failed" "FAIL"
fi

# Test key endpoints
print_status "Testing key endpoints..." "INFO"

# Test login page
if curl -s http://127.0.0.1:8000/login | grep -q "Sign in to your QuestionCraft account"; then
    print_status "Login page loads correctly" "PASS"
else
    print_status "Login page has issues" "FAIL"
fi

# Test register page
if curl -s http://127.0.0.1:8000/register | grep -q "Create your account"; then
    print_status "Register page loads correctly" "PASS"
else
    print_status "Register page has issues" "FAIL"
fi

# Test protected route (should redirect to login)
if curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:8000/dashboard | grep -q "302"; then
    print_status "Protected routes properly redirect guests" "PASS"
else
    print_status "Protected routes not properly secured" "FAIL"
fi

echo ""
print_status "=== Test Summary ===" "INFO"
echo ""
print_status "Available test users:" "INFO"
echo "  • admin@questioncraft.com / password123"
echo "  • demo@questioncraft.com / demo123"
echo "  • test@questioncraft.com / test123"
echo "  • john@example.com / password123"
echo ""
print_status "Test URLs:" "INFO"
echo "  • Login: http://127.0.0.1:8000/login"
echo "  • Register: http://127.0.0.1:8000/register"
echo "  • Dashboard: http://127.0.0.1:8000/dashboard"
echo "  • Admin: http://127.0.0.1:8000/admin"
echo ""
print_status "Manual testing commands:" "INFO"
echo "  • Database tests: php tests/database_test_script.php"
echo "  • Feature tests: php artisan test tests/Feature/AuthenticationTest.php"
echo "  • All tests: php artisan test"
echo ""
print_status "Authentication system testing complete!" "PASS"
