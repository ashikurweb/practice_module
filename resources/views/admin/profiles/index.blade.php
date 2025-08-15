<x-layouts.auth>
    <div class="p-6 min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold theme-text-primary">Profile Settings</h1>
            <p class="theme-text-secondary mt-2">Manage your account information and security settings</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Side - Profile Upload Card -->
            <div class="lg:col-span-1">
                <div class="theme-bg-primary rounded-2xl shadow-[0_0_5px_rgba(0,0,0,0.1)] theme-border-primary border overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-purple-50 to-pink-50 theme-border-primary border-b">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold theme-text-primary">Profile Picture</h2>
                                <p class="text-sm theme-text-secondary mt-1">Upload your profile image</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <!-- Profile Image Display -->
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center mb-4 overflow-hidden">
                                @if($user->profile_image)
                                    <img id="profile-preview" src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <div id="profile-initials" class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center theme-text-primary text-3xl font-bold">
                                        {{ $user->getInitials() }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold theme-text-primary">{{ $user->name }}</h3>
                            <p class="text-sm theme-text-secondary">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Profile Information and Password Cards -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Profile Information Card -->
                <div class="theme-bg-primary rounded-2xl shadow-[0_0_5px_rgba(0,0,0,0.1)] theme-border-primary border overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-blue-50 to-indigo-50 theme-border-primary border-b">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold theme-text-primary">Profile Information</h2>
                                <p class="text-sm theme-text-secondary mt-1">Update your account's profile information</p>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
                        @csrf
                        <!-- Name Field -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold theme-text-primary mb-2">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ $user->name }}" 
                                       class="w-full pl-10 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                                       placeholder="Enter your full name">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-8">
                            <label for="email" class="block text-sm font-semibold theme-text-primary mb-2">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ $user->email }}" 
                                       class="w-full pl-10 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                                       placeholder="Enter your email address">
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Profile Image Upload Field -->
                        <div class="mb-6">
                            <label for="profile_image" class="block text-sm font-semibold theme-text-primary mb-2">Profile Image</label>
                            <input type="file" 
                                   id="profile_image" 
                                   name="profile_image" 
                                   accept="image/*"
                                   onchange="previewImage(this)"
                                   class="w-full px-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('profile_image') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary">
                            @error('profile_image')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Save Button -->
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="px-8 py-3 text-white hover:opacity-80 border border-blue-400 bg-blue-600 font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm">
                                    <i class="fa-solid fa-save mr-2"></i>
                                    Update Profile
                            </button>
                        </div>
                    </form>
                </div>

               
            </div>
        </div>
        <!-- Update Password Card -->
        <div class="theme-bg-primary rounded-2xl mt-5 max-w-6xl w-full shadow-[0_0_5px_rgba(0,0,0,0.1)] theme-border-primary border">
           <div class="px-8 py-6 bg-gradient-to-r from-green-50 to-emerald-50 theme-border-primary border-b">
               <div class="flex items-center space-x-3">
                   <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                       <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                       </svg>
                   </div>
                   <div>
                       <h2 class="text-xl font-semibold theme-text-primary">Update Password</h2>
                       <p class="text-sm theme-text-secondary mt-1">Ensure your account is using a long, random password to stay secure</p>
                   </div>
               </div>
           </div>
           
           <form action="{{ route('profile.password') }}" method="POST" class="p-8">
               @csrf
               
               <!-- Current Password -->
               <div class="mb-6">
                   <label for="current_password" class="block text-sm font-semibold theme-text-primary mb-2">Current Password</label>
                   <div class="relative">
                       <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                           <svg class="h-5 w-5 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                           </svg>
                       </div>
                       <input type="password" 
                              id="current_password" 
                              name="current_password" 
                              class="w-full pl-10 pr-12 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('current_password') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                              placeholder="Enter your current password">
                       <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                           <svg class="h-5 w-5 theme-text-muted hover:text-gray-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                           </svg>
                       </button>
                   </div>
                   @error('current_password')
                       <p class="text-red-500 text-xs mt-2 flex items-center">
                           <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                               <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                           </svg>
                           {{ $message }}
                       </p>
                   @enderror
               </div>

               <!-- New Password -->
               <div class="mb-6">
                   <label for="password" class="block text-sm font-semibold theme-text-primary mb-2">New Password</label>
                   <div class="relative">
                       <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                           <svg class="h-5 w-5 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                           </svg>
                       </div>
                       <input type="password" 
                              id="password" 
                              name="password" 
                              class="w-full pl-10 pr-12 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                              placeholder="Enter your new password">
                       <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                           <svg class="h-5 w-5 theme-text-muted hover:text-gray-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                           </svg>
                       </button>
                   </div>
                   @error('password')
                       <p class="text-red-500 text-xs mt-2 flex items-center">
                           <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                               <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                           </svg>
                           {{ $message }}
                       </p>
                   @enderror
               </div>

               <!-- Confirm Password -->
               <div class="mb-6">
                   <label for="password_confirmation" class="block text-sm font-semibold theme-text-primary mb-2">Confirm New Password</label>
                   <div class="relative">
                       <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                           <svg class="h-5 w-5 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                           </svg>
                       </div>
                       <input type="password" 
                              id="password_confirmation" 
                              name="password_confirmation" 
                              class="w-full pl-10 pr-12 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 theme-bg-secondary theme-text-primary"
                              placeholder="Confirm your new password">
                       <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                           <svg class="h-5 w-5 theme-text-muted hover:text-gray-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                           </svg>
                       </button>
                   </div>
               </div>

               <!-- Save Button -->
               <div class="flex justify-end">
                   <button type="submit" 
                           class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 hover:shadow-xl">
                       <span class="flex items-center">
                           <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                           </svg>
                           Update Password
                       </span>
                   </button>
               </div>
           </form>
       </div>
    </div>

    <script>
        // Password Toggle Functionality
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const eyeIcon = this.querySelector('svg');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m6.121-3.879l3.879-3.879m0 0l-4.242 4.242M21 3l-3.879 3.879"></path>
                    `;
                } else {
                    input.type = 'password';
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    `;
                }
            });
        });

        // Profile Image Preview Functionality
        function previewImage(input) {
            const preview = document.querySelector('#profile-preview');
            const initials = document.querySelector('#profile-initials');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    if (preview) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    } else {
                        // Create new image element if it doesn't exist
                        const newPreview = document.createElement('img');
                        newPreview.id = 'profile-preview';
                        newPreview.src = e.target.result;
                        newPreview.alt = 'Profile';
                        newPreview.className = 'w-full h-full object-cover';
                        
                        const container = document.querySelector('.w-32.h-32');
                        container.innerHTML = '';
                        container.appendChild(newPreview);
                    }
                    
                    // Hide initials if they exist
                    if (initials) {
                        initials.classList.add('hidden');
                    }
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-layouts.auth>