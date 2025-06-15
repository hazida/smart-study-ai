# QuestionCraft Application Startup Guide

## 🚀 **RUNNING THE APPLICATION**

### **🎯 Current Status:**

✅ **Laravel Server**: Running successfully on `http://127.0.0.1:8000`
❌ **NPM Dev Server**: PowerShell execution policy blocking scripts
✅ **Application**: Accessible and functional

## **⚡ Quick Start (Application is Already Running!)**

### **🔗 Access the Application:**

#### **🏠 Main Application URLs:**
```
Home Page:           http://127.0.0.1:8000
Quick Admin Login:   http://127.0.0.1:8000/quick-login
Admin Dashboard:     http://127.0.0.1:8000/admin/dashboard
Standard Login:      http://127.0.0.1:8000/login
```

#### **🔐 Admin Credentials:**
```
Quick Login:    http://127.0.0.1:8000/quick-login (instant access)
Email:          admin@questioncraft.com
Password:       password123 (for manual login)
```

## **🔧 PowerShell Execution Policy Fix**

### **❌ Current Issue:**
```
PowerShell execution policy is blocking npm scripts
Error: "running scripts is disabled on this system"
```

### **✅ Solutions:**

#### **Method 1: Temporary Fix (Recommended)**
```powershell
# Open PowerShell as Administrator and run:
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser

# Then run npm dev:
npm run dev
```

#### **Method 2: Bypass for Single Command**
```powershell
# Run npm dev with bypass:
powershell -ExecutionPolicy Bypass -Command "npm run dev"
```

#### **Method 3: Use Command Prompt**
```cmd
# Open Command Prompt (cmd) and run:
npm run dev
```

#### **Method 4: Use Git Bash**
```bash
# If you have Git Bash installed:
npm run dev
```

## **📋 Complete Startup Process**

### **🔄 Step-by-Step Instructions:**

#### **1. Fix PowerShell Policy (One-time setup):**
```powershell
# Open PowerShell as Administrator
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

#### **2. Start NPM Development Server:**
```bash
# In project directory
npm run dev
```
**Expected Output:**
```
VITE v5.x.x ready in xxx ms

➜  Local:   http://localhost:5173/
➜  Network: use --host to expose
➜  press h + enter to show help
```

#### **3. Start Laravel Server (if not running):**
```bash
# In another terminal
php artisan serve
```
**Expected Output:**
```
Starting Laravel development server: http://127.0.0.1:8000
[Thu Dec 14 10:00:00 2023] PHP 8.x.x Development Server started
```

#### **4. Access Application:**
```
Main App:     http://127.0.0.1:8000
Admin Panel:  http://127.0.0.1:8000/quick-login
```

## **🛠️ Development Environment**

### **✅ Current Configuration:**

#### **📦 Package.json Scripts:**
```json
{
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "preview": "vite preview"
  }
}
```

#### **⚙️ Vite Configuration:**
```javascript
// vite.config.js
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
```

#### **🎨 Asset Compilation:**
- **CSS**: TailwindCSS compilation
- **JavaScript**: ES6+ transpilation
- **Hot Reload**: Automatic browser refresh
- **Laravel Integration**: Vite plugin for Laravel

## **🔍 Troubleshooting**

### **❌ Common Issues & Solutions:**

#### **1. PowerShell Execution Policy:**
```
Error: "running scripts is disabled on this system"
Solution: Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
```

#### **2. Port Already in Use:**
```
Error: "Port 8000 is already in use"
Solution: php artisan serve --port=8001
```

#### **3. NPM Dependencies:**
```
Error: "Module not found"
Solution: npm install
```

#### **4. Laravel Dependencies:**
```
Error: "Class not found"
Solution: composer install
```

#### **5. Database Connection:**
```
Error: "Database connection failed"
Solution: Check .env file and run php artisan migrate
```

### **🔧 Quick Fixes:**

#### **Reset Development Environment:**
```bash
# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Reinstall dependencies
npm install
composer install

# Rebuild assets
npm run build
```

#### **Database Reset:**
```bash
# Reset database with seeders
php artisan migrate:fresh --seed
```

## **📊 Application Status Check**

### **✅ Current Status:**

#### **🌐 Server Status:**
- **Laravel Server**: ✅ Running on http://127.0.0.1:8000
- **NPM Dev Server**: ❌ Blocked by PowerShell policy
- **Database**: ✅ Connected and seeded
- **Authentication**: ✅ Working with test users

#### **🔗 Accessible URLs:**
- ✅ **Home**: http://127.0.0.1:8000
- ✅ **Quick Login**: http://127.0.0.1:8000/quick-login
- ✅ **Admin Dashboard**: http://127.0.0.1:8000/admin/dashboard
- ✅ **Notes Management**: http://127.0.0.1:8000/admin/notes-crud
- ✅ **User Management**: http://127.0.0.1:8000/admin/users-crud
- ✅ **Q&A System**: All routes working

#### **🎨 Features Status:**
- ✅ **Admin Panel**: Fully functional
- ✅ **User Management**: CRUD operations working
- ✅ **Notes Management**: Complete system implemented
- ✅ **Q&A System**: Questions, Answers, Feedback working
- ✅ **Authentication**: Login/logout working
- ✅ **Responsive Design**: Mobile-optimized
- ✅ **Database**: All relationships working

## **🎯 Next Steps**

### **🔄 To Complete Setup:**

#### **1. Fix NPM Dev Server:**
```powershell
# Run as Administrator
Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
npm run dev
```

#### **2. Verify Hot Reload:**
- Make a small change to a CSS file
- Check if browser auto-refreshes
- Confirm Vite is watching files

#### **3. Test All Features:**
- ✅ Admin login and navigation
- ✅ CRUD operations for all modules
- ✅ Responsive design on mobile
- ✅ Form validation and error handling

### **🚀 Production Deployment:**

#### **📦 Build for Production:**
```bash
# Build optimized assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### **🔧 Environment Setup:**
```bash
# Set production environment
cp .env.example .env.production
php artisan key:generate --env=production
```

## **📞 Support Information**

### **🆘 If You Need Help:**

#### **🔍 Check These First:**
1. **PowerShell Policy**: Run as Administrator and set execution policy
2. **Port Conflicts**: Try different ports if 8000 is busy
3. **Dependencies**: Run `npm install` and `composer install`
4. **Database**: Ensure MySQL is running and .env is configured
5. **Permissions**: Check file/folder permissions

#### **🔗 Quick Access:**
- **Application**: http://127.0.0.1:8000
- **Admin Panel**: http://127.0.0.1:8000/quick-login
- **Documentation**: Check docs/ folder for detailed guides

### **✅ Application Ready:**

**The QuestionCraft application is running and accessible! 🎉**

**Main Access Points:**
- **Home**: http://127.0.0.1:8000
- **Admin**: http://127.0.0.1:8000/quick-login
- **Dashboard**: http://127.0.0.1:8000/admin/dashboard

**To enable hot reload, fix the PowerShell execution policy and run `npm run dev`.**

**The application is fully functional even without the NPM dev server! 🚀✨**
