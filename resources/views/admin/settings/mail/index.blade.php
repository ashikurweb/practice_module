<x-layouts.admin>
    <x-breadcrumb :breadcrumbs="[
        ['label' => 'Settings', 'url' => route('settings')],
        ['label' => 'Mail Configuration']
    ]" />
    
    <div class="w-full mx-auto max-w-6xl theme-bg-primary rounded-2xl shadow-[0_0_5px_rgba(0,0,0,0.1)] theme-border-primary border overflow-hidden">
        <div class="px-8 py-6 theme-bg-secondary theme-border-primary border-b">
            <div class="flex items-center space-x-3">
                <div>
                    <h2 class="text-xl font-semibold theme-text-primary">Email Configuration</h2>
                    <p class="text-sm theme-text-secondary mt-1">Configure your email settings</p>
                </div>
            </div>
        </div>
        
        <form action="{{ route('admin.mail.configuration.update') }}" method="POST" enctype="multipart/form-data" class="p-8" id="mailConfigForm">
            @csrf
            
            <!-- MAIL MAILER * -->
            <div class="mb-6">
                <label for="mail_mailer" class="block text-sm font-semibold theme-text-primary mb-2">MAIL MAILER *</label>
                <input type="text" 
                        id="mail_mailer"
                        name="mail_mailer"  
                        value="{{ old('mail_mailer', $values['MAIL_MAILER']) }}"
                        class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('mail_mailer') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                        placeholder="e.g., smtp">
                @error('mail_mailer')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            
            <!-- MAIL HOST * -->
            <div class="mb-8">
                <label for="mail_host" class="block text-sm font-semibold theme-text-primary mb-2">MAIL HOST *</label>
                <input type="text" 
                        id="mail_host" 
                        name="mail_host" 
                        value="{{ old('mail_host', $values['MAIL_HOST']) }}"
                        class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('mail_host') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                        placeholder="e.g., smtp.gmail.com">
                @error('mail_host')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            
            <!-- MAIL PORT * -->
            <div class="mb-8">
                <label for="mail_port" class="block text-sm font-semibold theme-text-primary mb-2">MAIL PORT *</label>
                <input type="number" 
                        id="mail_port" 
                        name="mail_port"
                        value="{{ old('mail_port', $values['MAIL_PORT']) }}" 
                        class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('mail_port') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                        placeholder="e.g., 587, 465, 25">
                @error('mail_port')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            
            <!-- MAIL USERNAME * -->
            <div class="mb-8">
                <label for="mail_username" class="block text-sm font-semibold theme-text-primary mb-2">MAIL USERNAME *</label>
                <input type="text" 
                        id="mail_username" 
                        name="mail_username"
                        value="{{ old('mail_username', $values['MAIL_USERNAME']) }}"
                        class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('mail_username') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                        placeholder="e.g., your-email@gmail.com">
                @error('mail_username')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            
            <!-- MAIL PASSWORD * -->
            <div class="mb-8">
                <label for="mail_password" class="block text-sm font-semibold theme-text-primary mb-2">MAIL PASSWORD *</label>
                <input type="password" 
                        id="mail_password" 
                        name="mail_password" 
                        value="{{ old('mail_password', $values['MAIL_PASSWORD']) }}"
                        class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('mail_password') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                        placeholder="Enter SMTP password">
                @error('mail_password')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            
            <!-- MAIL ENCRYPTION * -->
            <div class="mb-8">
                <label for="mail_encryption" class="block text-sm font-semibold theme-text-primary mb-2">MAIL ENCRYPTION *</label>
                <input type="text" 
                        id="mail_encryption" 
                        name="mail_encryption" 
                        value="{{ old('mail_encryption', $values['MAIL_ENCRYPTION']) }}"
                        class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('mail_encryption') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                        placeholder="e.g., tls, ssl">
                @error('mail_encryption')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            
            <!-- MAIL FROM ADDRESS *-->
            <div class="mb-8">
                <label for="mail_from_address" class="block text-sm font-semibold theme-text-primary mb-2">MAIL FROM ADDRESS *</label>
                <input type="email" 
                        id="mail_from_address" 
                        name="mail_from_address" 
                        value="{{ old('mail_from_address', $values['MAIL_FROM_ADDRESS']) }}"
                        class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('mail_from_address') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                        placeholder="e.g., noreply@yourdomain.com">
                @error('mail_from_address')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            
            <!-- MAIL FROM NAME *-->
            <div class="mb-8">
                <label for="mail_from_name" class="block text-sm font-semibold theme-text-primary mb-2">MAIL FROM NAME *</label>
                <input type="text" 
                        id="mail_from_name" 
                        name="mail_from_name" 
                        value="{{ old('mail_from_name', $values['MAIL_FROM_NAME']) }}"
                        class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('mail_from_name') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                        placeholder="e.g., Your Application Name">
                @error('mail_from_name')
                    <p class="text-red-500 text-xs mt-2 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            
            <!-- Save and Test Buttons -->
            <div class="flex items-center justify-between space-x-4 mt-6">
                <button type="submit" 
                        name="action"
                        value="save"
                        class="px-8 py-3 text-white hover:opacity-80 border border-green-400 bg-lime-600 font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-sm">
                    <i class="fa-solid fa-save mr-2"></i>
                    Save Changes
                </button>
                <button type="submit"
                        name="action"
                        value="test" 
                        class="px-8 py-3 text-white hover:opacity-80 border border-blue-400 bg-blue-600 font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm">
                    <i class="fa-solid fa-envelope mr-2"></i>
                    Test Connection
                </button>
            </div>
            
            <!-- Warning Message -->
            <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700">
                <p class="text-sm">
                    <strong>Important:</strong> 
                    <ul class="list-disc pl-5 mt-2">
                        <li>You must fill in all fields before testing the connection.</li>
                        <li>You must save your configuration before testing the connection.</li>
                        <li>The test email will be sent to the "MAIL FROM ADDRESS" you specified.</li>
                        <li>Invalid credentials will result in test failure.</li>
                    </ul>
                </p>
            </div>
        </form>
    </div>

    <!-- Script to handle form submission and reset dropdowns -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('mailConfigForm');
            
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Reset all dropdown states before form submission
                    if (typeof window.resetAllDropdowns === 'function') {
                        window.resetAllDropdowns();
                    }
                });
            }
            
            // Also listen for button clicks in the form
            const buttons = document.querySelectorAll('#mailConfigForm button');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Close all dropdowns when any button in the form is clicked
                    if (typeof window.resetAllDropdowns === 'function') {
                        window.resetAllDropdowns();
                    }
                });
            });
        });
    </script>
</x-layouts.admin>