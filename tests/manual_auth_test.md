# Manual Authentication Testing Guide

## Test Environment Setup

### Prerequisites
- Laravel server running on http://127.0.0.1:8000
- MySQL database with seeded users
- Browser for testing

### Test Users Available
```
Admin User:
- Email: admin@questioncraft.com
- Password: password123

Demo User:
- Email: demo@questioncraft.com
- Password: demo123

Test User:
- Email: test@questioncraft.com
- Password: test123

Additional Users:
- john@example.com / password123
- sarah@example.com / password123
- mike@example.com / password123
- emily@example.com / password123
- tom@example.com / password123
```

## Test Cases

### 1. User Registration Tests

#### Test 1.1: Successful Registration
1. Navigate to http://127.0.0.1:8000/register
2. Fill in the form:
   - Name: "New Test User"
   - Email: "newuser@example.com"
   - Password: "password123"
   - Confirm Password: "password123"
   - Check "I agree to the Terms of Service"
3. Click "Create Account"
4. **Expected Result**: Redirected to dashboard with success message

#### Test 1.2: Registration with Invalid Email
1. Navigate to http://127.0.0.1:8000/register
2. Fill in the form with invalid email: "invalid-email"
3. Click "Create Account"
4. **Expected Result**: Error message for invalid email format

#### Test 1.3: Registration with Existing Email
1. Navigate to http://127.0.0.1:8000/register
2. Use existing email: "admin@questioncraft.com"
3. **Expected Result**: Error message for duplicate email

#### Test 1.4: Registration without Terms Agreement
1. Navigate to http://127.0.0.1:8000/register
2. Fill form but don't check terms checkbox
3. **Expected Result**: Error message for terms requirement

#### Test 1.5: Password Confirmation Mismatch
1. Navigate to http://127.0.0.1:8000/register
2. Use different passwords in password and confirm fields
3. **Expected Result**: Error message for password mismatch

### 2. User Login Tests

#### Test 2.1: Successful Login
1. Navigate to http://127.0.0.1:8000/login
2. Enter credentials:
   - Email: "admin@questioncraft.com"
   - Password: "password123"
3. Click "Sign In"
4. **Expected Result**: Redirected to dashboard with welcome message

#### Test 2.2: Login with Wrong Password
1. Navigate to http://127.0.0.1:8000/login
2. Enter:
   - Email: "admin@questioncraft.com"
   - Password: "wrongpassword"
3. **Expected Result**: Error message for invalid credentials

#### Test 2.3: Login with Non-existent Email
1. Navigate to http://127.0.0.1:8000/login
2. Enter:
   - Email: "nonexistent@example.com"
   - Password: "password123"
3. **Expected Result**: Error message for invalid credentials

#### Test 2.4: Remember Me Functionality
1. Navigate to http://127.0.0.1:8000/login
2. Enter valid credentials and check "Remember me"
3. Login successfully, then close browser
4. Reopen browser and navigate to dashboard
5. **Expected Result**: Should remain logged in

### 3. Authentication Flow Tests

#### Test 3.1: Guest Access Restrictions
1. Without logging in, try to access:
   - http://127.0.0.1:8000/dashboard
   - http://127.0.0.1:8000/admin
   - http://127.0.0.1:8000/questions
2. **Expected Result**: Redirected to login page

#### Test 3.2: Authenticated User Redirects
1. Login with valid credentials
2. Try to access:
   - http://127.0.0.1:8000/login
   - http://127.0.0.1:8000/register
3. **Expected Result**: Redirected to dashboard

#### Test 3.3: Logout Functionality
1. Login with valid credentials
2. Navigate to dashboard
3. Click logout button or access /logout
4. **Expected Result**: Redirected to homepage with logout message

### 4. Session Management Tests

#### Test 4.1: Session Persistence
1. Login successfully
2. Navigate between different pages (dashboard, questions, profile)
3. **Expected Result**: User remains logged in across pages

#### Test 4.2: Session Expiration
1. Login successfully
2. Wait for session to expire (or manually clear session)
3. Try to access protected page
4. **Expected Result**: Redirected to login page

### 5. Database Integration Tests

#### Test 5.1: User Creation in Database
1. Register a new user
2. Check database for new user record
3. **Expected Result**: User record exists with hashed password

#### Test 5.2: Login Verification
1. Login with existing user
2. Verify authentication state
3. **Expected Result**: User is properly authenticated

### 6. UI/UX Tests

#### Test 6.1: Form Validation Display
1. Submit forms with invalid data
2. Check error message display
3. **Expected Result**: Clear, user-friendly error messages

#### Test 6.2: Success Message Display
1. Complete successful registration/login
2. Check success message display
3. **Expected Result**: Clear success feedback

#### Test 6.3: Responsive Design
1. Test forms on different screen sizes
2. **Expected Result**: Forms work properly on mobile/tablet/desktop

### 7. Security Tests

#### Test 7.1: Password Hashing
1. Register a new user
2. Check database to ensure password is hashed
3. **Expected Result**: Password stored as hash, not plain text

#### Test 7.2: CSRF Protection
1. Try to submit forms without CSRF token
2. **Expected Result**: Request should be rejected

#### Test 7.3: SQL Injection Prevention
1. Try entering SQL injection attempts in form fields
2. **Expected Result**: Attempts should be safely handled

## Test Results Template

### Test Execution Log
```
Date: ___________
Tester: ___________

Test 1.1 - Successful Registration: [ PASS / FAIL ]
Notes: ________________________________

Test 1.2 - Invalid Email: [ PASS / FAIL ]
Notes: ________________________________

Test 2.1 - Successful Login: [ PASS / FAIL ]
Notes: ________________________________

[Continue for all tests...]
```

### Issues Found
```
Issue #1:
Description: ________________________
Severity: [ Critical / High / Medium / Low ]
Steps to Reproduce: _________________
Expected Result: ____________________
Actual Result: ______________________

[Continue for additional issues...]
```

## Automated Test Commands

Run these commands to execute automated tests:

```bash
# Run all authentication tests
php artisan test tests/Feature/AuthenticationTest.php

# Run specific test method
php artisan test tests/Feature/AuthenticationTest.php::test_user_can_login

# Run tests with verbose output
php artisan test tests/Feature/AuthenticationTest.php --verbose

# Run tests and generate coverage report
php artisan test tests/Feature/AuthenticationTest.php --coverage
```
