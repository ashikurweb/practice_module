<x-layouts.auth>
    <div class="space-y-6">
        <!-- Page Header -->
        <div>
            <h1 class="text-3xl font-bold theme-text-primary">Settings</h1>
            <p class="theme-text-secondary mt-2">Manage your application settings and configurations</p>
        </div>

        <!-- Settings Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- General Settings -->
            <div class="theme-bg-card rounded-xl theme-border-card border theme-shadow p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold theme-text-primary">General Settings</h3>
                        <p class="text-sm theme-text-muted">Basic application configuration</p>
                    </div>
                </div>
                <p class="text-sm theme-text-secondary mb-4">Configure basic settings like site name, description, and general preferences.</p>
                <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm font-medium">
                    Configure
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Mail Configuration -->
            <div class="theme-bg-card rounded-xl theme-border-card border theme-shadow p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold theme-text-primary">Mail Configuration</h3>
                        <p class="text-sm theme-text-muted">Email server settings</p>
                    </div>
                </div>
                <p class="text-sm theme-text-secondary mb-4">Configure SMTP settings for sending emails and notifications.</p>
                <a href="{{ route('admin.mail.configuration') }}" class="inline-flex items-center text-green-600 hover:text-green-700 text-sm font-medium">
                    Configure
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Security Settings -->
            <div class="theme-bg-card rounded-xl theme-border-card border theme-shadow p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold theme-text-primary">Security Settings</h3>
                        <p class="text-sm theme-text-muted">Authentication & security</p>
                    </div>
                </div>
                <p class="text-sm theme-text-secondary mb-4">Manage password policies, session settings, and security features.</p>
                <a href="#" class="inline-flex items-center text-red-600 hover:text-red-700 text-sm font-medium">
                    Configure
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Backup & Restore -->
            <div class="theme-bg-card rounded-xl theme-border-card border theme-shadow p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold theme-text-primary">Backup & Restore</h3>
                        <p class="text-sm theme-text-muted">Data backup settings</p>
                    </div>
                </div>
                <p class="text-sm theme-text-secondary mb-4">Configure automatic backups and manage data restoration options.</p>
                <a href="#" class="inline-flex items-center text-purple-600 hover:text-purple-700 text-sm font-medium">
                    Configure
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- API Settings -->
            <div class="theme-bg-card rounded-xl theme-border-card border theme-shadow p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold theme-text-primary">API Settings</h3>
                        <p class="text-sm theme-text-muted">API configuration</p>
                    </div>
                </div>
                <p class="text-sm theme-text-secondary mb-4">Manage API keys, endpoints, and third-party integrations.</p>
                <a href="#" class="inline-flex items-center text-orange-600 hover:text-orange-700 text-sm font-medium">
                    Configure
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Notifications -->
            <div class="theme-bg-card rounded-xl theme-border-card border theme-shadow p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-6H4v6zM4 5h6V4a1 1 0 00-1-1H5a1 1 0 00-1 1v1zm0 6h6V9H4v2zm0 4h6v-2H4v2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold theme-text-primary">Notifications</h3>
                        <p class="text-sm theme-text-muted">Notification preferences</p>
                    </div>
                </div>
                <p class="text-sm theme-text-secondary mb-4">Configure email, SMS, and push notification settings.</p>
                <a href="#" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                    Configure
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-layouts.auth>