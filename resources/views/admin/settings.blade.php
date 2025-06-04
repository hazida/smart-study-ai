@extends('layouts.admin')

@section('title', 'System Settings')
@section('page-title', 'System Settings')

@section('content')
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-900">System Settings</h2>
                <p class="text-slate-600">Configure platform settings and preferences</p>
            </div>

            <form class="space-y-8">
                <!-- General Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">General Settings</h3>
                                <p class="text-sm text-slate-500">Basic platform configuration</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Platform Name</label>
                                <input type="text" value="QuestionGen" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Support Email</label>
                                <input type="email" value="support@questiongen.com" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Platform Description</label>
                            <textarea rows="3" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">AI-powered question generation platform for educators and content creators.</textarea>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="maintenance_mode" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                            <label for="maintenance_mode" class="ml-2 text-sm text-slate-700">Enable maintenance mode</label>
                        </div>
                    </div>
                </div>

                <!-- User Registration -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">User Registration</h3>
                                <p class="text-sm text-slate-500">Control user registration and verification</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="allow_registration" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                <label for="allow_registration" class="ml-2 text-sm text-slate-700">Allow new user registration</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="require_email_verification" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                <label for="require_email_verification" class="ml-2 text-sm text-slate-700">Require email verification</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="admin_approval" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                <label for="admin_approval" class="ml-2 text-sm text-slate-700">Require admin approval for new accounts</label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Default User Role</label>
                            <select class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                <option value="user" selected>User</option>
                                <option value="moderator">Moderator</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- AI Configuration -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">AI Configuration</h3>
                                <p class="text-sm text-slate-500">Configure AI service settings</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">AI Provider</label>
                                <select class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                    <option value="openai" selected>OpenAI</option>
                                    <option value="anthropic">Anthropic</option>
                                    <option value="google">Google AI</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Default Model</label>
                                <select class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                                    <option value="gpt-4" selected>GPT-4</option>
                                    <option value="gpt-3.5-turbo">GPT-3.5 Turbo</option>
                                    <option value="claude-3">Claude 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Max Questions per Request</label>
                                <input type="number" value="50" min="1" max="100" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Request Timeout (seconds)</label>
                                <input type="number" value="30" min="10" max="120" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- File Upload Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">File Upload Settings</h3>
                                <p class="text-sm text-slate-500">Configure file upload limits and types</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Max File Size (MB)</label>
                                <input type="number" value="10" min="1" max="100" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Max Files per User</label>
                                <input type="number" value="50" min="1" max="1000" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Allowed File Types</label>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                    <span class="ml-2 text-sm text-slate-700">PDF</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                    <span class="ml-2 text-sm text-slate-700">DOCX</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                    <span class="ml-2 text-sm text-slate-700">TXT</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                    <span class="ml-2 text-sm text-slate-700">PPTX</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Email Settings -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200/60">
                    <div class="px-6 py-4 border-b border-slate-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-pink-600 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">Email Settings</h3>
                                <p class="text-sm text-slate-500">Configure email notifications and SMTP</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">SMTP Host</label>
                                <input type="text" value="smtp.gmail.com" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">SMTP Port</label>
                                <input type="number" value="587" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" id="email_notifications" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                <label for="email_notifications" class="ml-2 text-sm text-slate-700">Enable email notifications</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="welcome_emails" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded">
                                <label for="welcome_emails" class="ml-2 text-sm text-slate-700">Send welcome emails to new users</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-6 py-3 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                        Reset to Defaults
                    </button>
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
