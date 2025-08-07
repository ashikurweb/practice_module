<x-layouts.app>
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3 text-2xl font-bold group">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <span class="gradient-text">MyBlog</span>
            </a>
            
            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-8">
                <a href="#" class="nav-link text-gray-700 hover:text-gray-900 font-medium py-2">Home</a>
                <a href="#" class="nav-link text-gray-700 hover:text-gray-900 font-medium py-2">Posts</a>
                <a href="#" class="nav-link text-gray-700 hover:text-gray-900 font-medium py-2">About</a>
                <a href="#" class="nav-link text-gray-700 hover:text-gray-900 font-medium py-2">Contact</a>
            </nav>
            
            <!-- Desktop Auth Buttons -->
            <div class="hidden lg:flex items-center gap-4">
                <!-- User Dropdown (when logged in) -->
                @if(Auth::check())
                    <!-- Profile Dropdown for Authenticated Users -->
                    <div class="relative" x-data="{ userOpen: false }">
                        <button 
                            @click="userOpen = !userOpen" 
                            class="flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 font-medium transition-all duration-300 shadow-lg">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                @if(Auth::user()->profile_image)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                                        alt="Profile" class="object-cover w-8 h-8 rounded-full">
                                @else
                                    <div class="rounded-full flex items-center justify-center text-slate-800 text-sm font-bold">
                                        {{ Auth::user()->getInitials() }}
                                    </div>
                                @endif
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': userOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- User Dropdown Menu -->
                        <div 
                            x-show="userOpen" 
                            @click.away="userOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                            class="absolute right-0 mt-3 w-56 mobile-menu rounded-2xl shadow-2xl border border-white/20 py-2">
                            
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white/10 transition-colors group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                                </svg>
                                Dashboard
                            </a>
                            
                            <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white/10 transition-colors group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Profile
                            </a>
                            
                            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white/10 transition-colors group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Settings
                            </a>
                            
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50/50 transition-colors w-full text-left group">
                                    <svg class="w-5 h-5 text-red-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login/Register Dropdown for Guests -->
                    <div class="relative" x-data="{ userOpen: false }">
                        <button 
                            @click="userOpen = !userOpen" 
                            class="flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 font-medium transition-all duration-300 shadow-lg">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <span>{{ __('My Account') }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': userOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Login/Register Dropdown Menu -->
                        <div 
                            x-show="userOpen" 
                            @click.away="userOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                            class="absolute right-0 mt-3 w-56 mobile-menu rounded-2xl shadow-2xl border border-white/20 py-2">
                            
                            <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white/10 transition-colors group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                {{ __('Login') }}
                            </a>
                            
                            <a href="{{ route('register') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white/10 transition-colors group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                {{ __('Register') }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Mobile Menu Button -->
            <button 
                @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden flex flex-col items-center justify-center w-10 h-10 rounded-lg hover:bg-white/10 transition-colors"
                :class="sidebarOpen ? 'hamburger-active' : ''">
                <span class="hamburger-line line1 w-6 h-0.5 bg-gray-700 mb-1"></span>
                <span class="hamburger-line line2 w-6 h-0.5 bg-gray-700 mb-1"></span>
                <span class="hamburger-line line3 w-6 h-0.5 bg-gray-700"></span>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div 
        x-show="sidebarOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden mobile-menu border-t border-white/20">
        
        <div class="container mx-auto px-4 py-6">
            <!-- Mobile Navigation -->
            <nav class="flex flex-col gap-4 mb-6">
                <a href="#" class="text-gray-700 hover:text-gray-900 font-medium py-2 border-b border-transparent hover:border-gray-200 transition-colors">Home</a>
                <a href="#" class="text-gray-700 hover:text-gray-900 font-medium py-2 border-b border-transparent hover:border-gray-200 transition-colors">Posts</a>
                <a href="#" class="text-gray-700 hover:text-gray-900 font-medium py-2 border-b border-transparent hover:border-gray-200 transition-colors">About</a>
                <a href="#" class="text-gray-700 hover:text-gray-900 font-medium py-2 border-b border-transparent hover:border-gray-200 transition-colors">Contact</a>
            </nav>
            
            @if(Auth::check())
                <!-- Mobile User Menu for Authenticated Users -->
                <div class="border-t border-white/20 pt-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                            @if(Auth::user()->profile_image)
                                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                                    alt="Profile" class="object-cover w-8 h-8 rounded-full">
                            @else
                                <div class="rounded-full flex items-center justify-center text-slate-800 text-sm font-bold">
                                    {{ Auth::user()->getInitials() }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-gray-700 hover:bg-white/10 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                            </svg>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-3 py-2 text-gray-700 hover:bg-white/10 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profile
                        </a>
                        
                        <a href="#" class="flex items-center gap-3 px-3 py-2 text-gray-700 hover:bg-white/10 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 px-3 py-2 text-red-600 hover:bg-red-50/50 rounded-lg transition-colors text-left w-full">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Mobile User Menu for Guests -->
                <div class="border-t border-white/20 pt-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ __('My Account') }}</p>
                            <p class="text-sm text-gray-600">{{ __('Login or Register') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('login') }}" class="flex items-center gap-3 px-3 py-2 text-gray-700 hover:bg-white/10 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            {{ __('Login') }}
                        </a>
                        
                        <a href="{{ route('register') }}" class="flex items-center gap-3 px-3 py-2 text-gray-700 hover:bg-white/10 rounded-lg transition-colors">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            {{ __('Register') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</header>
<!-- Main Container with Grid Background -->
<div class="min-h-screen w-full bg-[#f8fafc] relative pt-20">
    <!-- Animated Grid Background -->
    <div
        class="absolute inset-0 z-0 opacity-60"
        style="
            background-image: 
                linear-gradient(to right, #e2e8f0 1px, transparent 1px),
                linear-gradient(to bottom, #e2e8f0 1px, transparent 1px);
            background-size: 20px 30px;
            -webkit-mask-image: radial-gradient(ellipse 70% 60% at 50% 0%, #000 60%, transparent 100%);
            mask-image: radial-gradient(ellipse 70% 60% at 50% 0%, #000 60%, transparent 100%);
            animation: grid-pulse 4s ease-in-out infinite;
        "
    ></div>
    
    <!-- Floating Particles -->
    <div class="absolute inset-0 z-0">
        <div class="particle absolute w-2 h-2 bg-blue-400 rounded-full opacity-70" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle absolute w-1 h-1 bg-purple-400 rounded-full opacity-60" style="left: 20%; animation-delay: 3s;"></div>
        <div class="particle absolute w-3 h-3 bg-indigo-400 rounded-full opacity-50" style="left: 70%; animation-delay: 6s;"></div>
        <div class="particle absolute w-2 h-2 bg-violet-400 rounded-full opacity-80" style="left: 80%; animation-delay: 9s;"></div>
        <div class="particle absolute w-1 h-1 bg-blue-300 rounded-full opacity-70" style="left: 50%; animation-delay: 12s;"></div>
    </div>
    
    <!-- Morphing Background Blobs -->
    <div class="absolute top-20 left-1/4 w-96 h-96 bg-gradient-to-r from-blue-400 to-purple-500 morphing-blob opacity-20"></div>
    <div class="absolute bottom-20 right-1/4 w-80 h-80 bg-gradient-to-r from-purple-400 to-pink-500 morphing-blob opacity-15" style="animation-delay: 4s;"></div>
    
    <!-- Hero Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 pb-32">
        <div class="max-w-6xl mx-auto text-center">
            <!-- Badge -->
            <div class="text-reveal stagger-1 inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/20 rounded-full mb-8">
                <span class="relative inline-flex h-3 w-3">
                    <span class="absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75 animate-ping"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
                </span>
                <span class="text-sky-700">Welcome to the Future</span>
            </div>
            <!-- Main Heading -->
            <div class="mb-8">
                <h1 class="text-6xl md:text-8xl font-black leading-tight mb-6">
                    <span class="text-reveal stagger-1 inline-block gradient-text">Create</span>
                    <span class="text-reveal stagger-2 inline-block text-gray-800 ml-4">Amazing</span>
                    <br>
                    <span class="text-reveal stagger-3 inline-block text-gray-800">Experiences</span>
                </h1>
                
                <p class="text-reveal stagger-4 text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto font-light leading-relaxed">
                    Build the future with cutting-edge design and innovative solutions that inspire and engage your audience.
                </p>
            </div>
            
            <!-- CTA Buttons -->
            <div class="text-reveal stagger-4 flex flex-col sm:flex-row gap-6 justify-center items-center">
                <button class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-2xl hover:shadow-[0_0_15px_3px_rgba(59,130,246,0.5)] transition-all duration-300 pulse-glow">
                    <span class="relative z-10">Get Started</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-purple-700 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
                
                <button class="group px-8 py-4 glass-card text-gray-700 font-semibold rounded-2xl hover:shadow-[0_0_15px_3px_rgba(59,130,246,0.5)] border border-blue-300/20 transition-all duration-300">
                    <span class="flex items-center gap-2">
                        <!-- AI Icon (Generic) -->
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l2 5h5l-4 4 2 5-5-2-5 2 2-5-4-4h5l2-5z"/>
                        </svg>
                        Watch Demo
                    </span>
                </button>                    
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
        <div class="flex flex-col items-center text-gray-400">
            <span class="text-sm font-medium mb-2">Scroll down</span>
            <div class="w-6 h-10 border-2 border-gray-300 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-gray-400 rounded-full mt-2 animate-bounce"></div>
            </div>
        </div>
    </div>
</div>
    @include('frontend.blog.index')
</x-layouts.app>