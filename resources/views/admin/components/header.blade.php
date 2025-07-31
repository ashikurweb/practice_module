<header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
    <div class="flex items-center justify-between px-4 py-4">
        <!-- Mobile Menu Button & Search -->
        <div class="flex items-center space-x-4">
            <button @click="sidebarOpen = !sidebarOpen" 
                    data-mobile-menu
                    class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 hover-glow transition-all duration-200">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <!-- Search Bar -->
            <div class="hidden md:flex relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                </div>
                <input type="text" 
                       placeholder="Search anything..." 
                       class="pl-12 pr-4 py-3 w-80 border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition-all duration-300 bg-gray-50 focus:bg-white shadow-sm hover:shadow-md">
            </div>
        </div>

        <!-- Right Side Items -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="p-2 text-gray-600 hover:bg-gray-100 rounded-xl hover-glow transition-all duration-200 relative">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-bounce-subtle">3</span>
                </button>
                
                <!-- Notifications Dropdown -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50">
                    
                    <div class="px-4 py-2 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-900">Notifications</h3>
                    </div>
                    
                    <div class="max-h-64 overflow-y-auto">
                        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium">New order received</p>
                                <p class="text-xs text-gray-500">2 minutes ago</p>
                            </div>
                        </a>
                        
                        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium">Payment successful</p>
                                <p class="text-xs text-gray-500">5 minutes ago</p>
                            </div>
                        </a>
                        
                        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                            <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></div>
                            <div>
                                <p class="text-sm font-medium">Low stock alert</p>
                                <p class="text-xs text-gray-500">10 minutes ago</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="border-t border-gray-100 mt-2 pt-2">
                        <a href="#" class="flex items-center px-4 py-3 text-blue-600 hover:bg-blue-50 transition-colors">
                            <span class="text-sm font-medium">View all notifications</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-xl hover-glow transition-all duration-200">
                <i class="fas fa-envelope text-xl"></i>
            </button>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="flex items-center space-x-3 p-2 rounded-xl hover:bg-gray-100 transition-all duration-200 hover-glow">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face" 
                         alt="Profile" class="w-10 h-10 rounded-full ring-2 ring-primary-200">
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>

                <!-- Profile Dropdown Menu -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50">
                    
                    <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-user-circle mr-3 text-gray-400"></i>
                        <span>My Profile</span>
                    </a>
                    
                    <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-cog mr-3 text-gray-400"></i>
                        <span>Account Settings</span>
                    </a>
                    
                    <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-moon mr-3 text-gray-400"></i>
                        <span>Dark Mode</span>
                    </a>
                    
                    <div class="border-t border-gray-100 mt-2 pt-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>