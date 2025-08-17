<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application With AI | Ashikur Rahman</title>
    {{-- fontawesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Sora', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .header-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.5);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .mobile-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        
        .hamburger-line {
            transition: all 0.3s ease;
        }
        
        .hamburger-active .line1 {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .hamburger-active .line2 {
            opacity: 0;
        }
        
        .hamburger-active .line3 {
            transform: rotate(-45deg) translate(7px, -6px);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        .pulse-glow {
            animation: pulse-glow 4s ease-in-out infinite;
        }
        
        @keyframes pulse-glow {
            0%, 100% { 
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.3),
                           0 0 40px rgba(102, 126, 234, 0.1),
                           0 0 60px rgba(102, 126, 234, 0.05);
            }
            50% { 
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.4),
                           0 0 60px rgba(102, 126, 234, 0.2),
                           0 0 90px rgba(102, 126, 234, 0.1);
            }
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, 
                rgba(102, 126, 234, 0.1) 0%, 
                rgba(118, 75, 162, 0.1) 50%, 
                rgba(255, 255, 255, 0.05) 100%);
        }
        
        .text-reveal {
            animation: textReveal 1s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }
        
        @keyframes textReveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        
        .morphing-blob {
            animation: morph 8s ease-in-out infinite;
            filter: blur(40px);
        }
        
        @keyframes morph {
            0%, 100% { 
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                transform: translate(-50%, -50%) scale(1);
            }
            50% { 
                border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
                transform: translate(-50%, -50%) scale(1.1);
            }
        }
        
        .particle {
            animation: particle-float 15s linear infinite;
        }
        
        @keyframes particle-float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(3deg); }
        }
    </style>
</head>
<body class="bg-[#f8fafc] overflow-x-hidden">
    <!-- Modern Header -->
    <header 
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-4"
        x-data="{ 
            sidebarOpen: false,
            scrolled: false,
            init() {
                this.sidebarOpen = false;
                window.addEventListener('scroll', () => {
                    this.scrolled = window.scrollY > 20;
                });
                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 1024) {
                        this.sidebarOpen = false;
                    }
                });
            }
        }"
        :class="scrolled ? 'header-glass py-2' : ''"
        x-cloak>
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
                    <!-- Theme Toggle -->
                    <x-theme-toggle />
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
                                        <div class="rounded-full flex items-center justify-center theme-text-primary text-sm font-bold">
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
                <!-- Theme Toggle -->
                <x-theme-toggle />
                @if(Auth::check())
                    <!-- Mobile User Menu for Authenticated Users -->
                    <div class="border-t border-white/20 pt-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                                @if(Auth::user()->profile_image)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                                        alt="Profile" class="object-cover w-8 h-8 rounded-full">
                                @else
                                    <div class="rounded-full flex items-center justify-center theme-text-primary text-sm font-bold">
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
        
        <main >
            {{ $slot }}
        </main>
</body>
</html>