<x-layouts.guest>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .input-focus {
            transition: all 0.3s ease;
        }
        
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.15);
        }
        
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .input-error {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1) !important;
        }
        
        /* Loading spinner animation */
        .spinner {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 2px solid white;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md mx-auto">
            <!-- Forgot Password Card -->
            <div class="glass-effect rounded-2xl shadow-2xl p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">
                        Forgot Password
                    </h2>
                    <p class="text-gray-600">
                        Enter your email to reset your password
                    </p>
                </div>
                
                <!-- Forgot Password Form -->
                <form id="forgotPasswordForm" class="space-y-5" action="" method="POST">
                    @csrf
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" 
                                    value="{{ old('email') }}"
                                    class="input-focus w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white/90 @error('email') input-error @enderror"
                                    placeholder="Enter your email address">
                        </div>
                        @error('email')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Submit Button -->
                    <button type="submit" id="submitBtn"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-medium text-white bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 shadow-lg">
                        <span id="btnContent" class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Send Reset Link
                        </span>
                        <span id="btnLoading" class="hidden flex items-center">
                            <div class="spinner mr-2"></div>
                            Sending...
                        </span>
                    </button>
                    
                    <!-- Back to Login Link -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Remember your password?
                            <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500 transition-colors">
                                Back to login
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- JavaScript for Form Submission -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forgotPasswordForm = document.getElementById('forgotPasswordForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnContent = document.getElementById('btnContent');
            const btnLoading = document.getElementById('btnLoading');
            
            forgotPasswordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                submitBtn.disabled = true;
                btnContent.classList.add('hidden');
                btnLoading.classList.remove('hidden');
                
                setTimeout(function() {
                    forgotPasswordForm.submit();
                }, 100);
            });
        });
    </script>
</x-layouts.guest>