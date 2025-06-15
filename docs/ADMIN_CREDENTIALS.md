# QuestionCraft Admin Credentials

## 🔐 **ADMIN LOGIN CREDENTIALS**

### **🎯 Primary Admin Account:**

#### **📧 Admin User (Database Seeded):**
```
Email:    admin@questioncraft.com
Password: password123
Role:     admin
Status:   Active
```

#### **🚀 Quick Login (Route-based):**
```
Email:    admin@questioncraft.com
Password: password
URL:      http://127.0.0.1:8000/quick-login
```

**⚠️ Note**: The quick-login route uses a different password (`password`) than the seeded admin user (`password123`).

## **🔑 All Available User Accounts**

### **👑 Admin Accounts:**

#### **1. Main Admin User:**
- **Email**: `admin@questioncraft.com`
- **Password**: `password123`
- **Username**: `admin_user`
- **Name**: `Admin User`
- **Role**: `admin`
- **Status**: `Active`

### **👨‍🏫 Teacher Accounts:**

#### **2. John Smith (Teacher):**
- **Email**: `john@example.com`
- **Password**: `password123`
- **Username**: `john_smith`
- **Name**: `John Smith`
- **Role**: `teacher`
- **Status**: `Active`

#### **3. Sarah Johnson (Teacher):**
- **Email**: `sarah@example.com`
- **Password**: `password123`
- **Username**: `sarah_johnson`
- **Name**: `Sarah Johnson`
- **Role**: `teacher`
- **Status**: `Active`

### **👨‍🎓 Student Accounts:**

#### **4. Demo User:**
- **Email**: `demo@questioncraft.com`
- **Password**: `demo123`
- **Username**: `demo_user`
- **Name**: `Demo User`
- **Role**: `student`
- **Status**: `Active`

#### **5. Test User:**
- **Email**: `test@questioncraft.com`
- **Password**: `test123`
- **Username**: `test_user`
- **Name**: `Test User`
- **Role**: `student`
- **Status**: `Active`

#### **6. Mike Wilson (Student):**
- **Email**: `mike@example.com`
- **Password**: `password123`
- **Username**: `mike_wilson`
- **Name**: `Mike Wilson`
- **Role**: `student`
- **Status**: `Active`

#### **7. Emily Davis (Student):**
- **Email**: `emily@example.com`
- **Password**: `password123`
- **Username**: `emily_davis`
- **Name**: `Emily Davis`
- **Role**: `student`
- **Status**: `Active`

### **👨‍👩‍👧‍👦 Parent Accounts:**

#### **8. Tom Garcia (Parent):**
- **Email**: `tom@example.com`
- **Password**: `password123`
- **Username**: `tom_garcia`
- **Name**: `Tom Garcia`
- **Role**: `parent`
- **Status**: `Active`

## **🌐 Access URLs**

### **🔗 Login Methods:**

#### **1. Quick Login (Instant Access):**
```
URL: http://127.0.0.1:8000/quick-login
Method: GET (automatic login)
Credentials: admin@questioncraft.com / password
Redirects to: Admin Dashboard
```

#### **2. Standard Login Form:**
```
URL: http://127.0.0.1:8000/login
Method: POST (manual login)
Credentials: admin@questioncraft.com / password123
```

#### **3. Direct Admin Access:**
```
URL: http://127.0.0.1:8000/admin/dashboard
Note: Requires authentication
```

### **📊 Admin Dashboard URLs:**

#### **🏠 Main Dashboards:**
- **Admin Dashboard**: `http://127.0.0.1:8000/admin/dashboard`
- **User Dashboard**: `http://127.0.0.1:8000/dashboard`
- **Admin Index**: `http://127.0.0.1:8000/admin/`

#### **👥 User Management:**
- **Users CRUD**: `http://127.0.0.1:8000/admin/users-crud`
- **User Profiles**: `http://127.0.0.1:8000/admin/user-profiles`
- **Users Overview**: `http://127.0.0.1:8000/admin/users`

#### **📚 Content Management:**
- **Subjects**: `http://127.0.0.1:8000/admin/subjects`
- **Notes**: `http://127.0.0.1:8000/admin/notes-crud`

#### **❓ Q&A System:**
- **Questions**: `http://127.0.0.1:8000/admin/questions`
- **Answers**: `http://127.0.0.1:8000/admin/answers`
- **Feedback**: `http://127.0.0.1:8000/admin/feedback`

#### **⚙️ System & Tools:**
- **System Health**: `http://127.0.0.1:8000/admin/system-health`
- **Reports**: `http://127.0.0.1:8000/admin/reports`
- **Export Data**: `http://127.0.0.1:8000/admin/export-data`
- **Settings**: `http://127.0.0.1:8000/admin/settings`
- **Analytics**: `http://127.0.0.1:8000/admin/analytics`

## **🔒 Security Information**

### **🛡️ Password Security:**

#### **📝 Password Patterns:**
- **Admin Password**: `password123` (seeded user)
- **Quick Login**: `password` (route-based)
- **Demo Users**: `demo123`, `test123`
- **Standard Users**: `password123`

#### **🔐 Password Hashing:**
- All passwords are hashed using Laravel's `Hash::make()`
- Stored securely in the database
- Cannot be retrieved in plain text

### **🎭 Role-Based Access:**

#### **👑 Admin Role:**
- **Full Access**: All admin routes and functionality
- **User Management**: Create, read, update, delete users
- **Content Management**: Manage subjects, notes, questions
- **System Access**: System health, reports, analytics
- **Settings**: Application configuration

#### **👨‍🏫 Teacher Role:**
- **Limited Access**: Teaching-related functionality
- **Content Creation**: Create and manage educational content
- **Student Monitoring**: View student progress

#### **👨‍🎓 Student Role:**
- **User Access**: Personal dashboard and questions
- **Learning Features**: Access to educational content
- **Progress Tracking**: View personal learning progress

#### **👨‍👩‍👧‍👦 Parent Role:**
- **Monitoring Access**: View child's progress
- **Limited Functionality**: Parent-specific features

## **🚀 Quick Start Guide**

### **⚡ Fastest Admin Access:**

#### **1. Instant Login (Recommended):**
```bash
# Open browser and navigate to:
http://127.0.0.1:8000/quick-login

# Automatically logs in as admin and redirects to dashboard
```

#### **2. Manual Login:**
```bash
# Navigate to login page:
http://127.0.0.1:8000/login

# Enter credentials:
Email: admin@questioncraft.com
Password: password123

# Click login button
```

#### **3. Direct Dashboard Access:**
```bash
# If already logged in, go directly to:
http://127.0.0.1:8000/admin/dashboard
```

### **🔧 Development Notes:**

#### **📊 Database Seeding:**
- Run `php artisan db:seed` to create all test users
- UserSeeder creates 8 predefined users + 20 factory users
- All users have verified email addresses

#### **🔄 Session Management:**
- Sessions store user data for quick access
- Logout available in admin dropdown menu
- Session-based authentication middleware

#### **🛠️ Testing Accounts:**
- Use demo/test accounts for feature testing
- Different roles for testing role-based access
- All accounts are pre-verified and active

## **📞 Support Information**

### **🆘 Troubleshooting:**

#### **❌ Login Issues:**
1. **Wrong Password**: Try both `password123` and `password`
2. **Account Not Found**: Run database seeders
3. **Access Denied**: Check user role and status
4. **Session Issues**: Clear browser cache/cookies

#### **🔧 Quick Fixes:**
```bash
# Reset database and seed users:
php artisan migrate:fresh --seed

# Clear application cache:
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### **✅ Verification:**

#### **🔍 Check Admin Access:**
- ✅ Quick login works: `http://127.0.0.1:8000/quick-login`
- ✅ Admin dashboard loads: `http://127.0.0.1:8000/admin/dashboard`
- ✅ All sidebar links functional
- ✅ User management accessible
- ✅ Q&A system working

**The admin credentials are ready for use! 🎯🔐✨**
