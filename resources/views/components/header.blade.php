<header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
    <div class="flex items-center justify-between px-4 py-2">
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
                    <iconify-icon icon="mdi:search" class="text-gray-400 text-xl"></iconify-icon> 
                </div>
                <input type="text" 
                    placeholder="Search anything..." 
                    class="pl-12 pr-4 py-2 w-50 border outline-none border-gray-50 shadow-sm rounded-full transition-all duration-300 hover-glow">

            </div>
        </div>

        <!-- Right Side Items -->
        <div class="flex items-center space-x-2 md:space-x-4">
            <div class="relative inline-block" x-data="{ open: false }" x-cloak>
                <button @click="open = !open" 
                class="p-2 text-gray-600 hover-glow rounded-full h-10 w-10  border border-gray-50 shadow-sm transition-all duration-200 relative">
                <iconify-icon icon="duo-icons:bell" class="text-2xl"></iconify-icon>
                <span class="absolute top-0.5 right-0.5 flex h-3 w-3">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex h-3 w-3 rounded-full bg-blue-500"></span>
                </span>
                </button>
                
                <!-- Notifications Dropdown -->
                <div x-show="open" x-cloak
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-50 py-2 z-50">
                    
                    <div class="px-4 py-2 border-b border-gray-100">
                        <h3 class="text-sm font-semibold text-gray-900">{{ __('Notifications') }}</h3>
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
                            <span class="text-sm font-medium">{{ __('View all notifications') }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative shadow-sm border border-gray-50 rounded-xl hidden sm:block" 
     x-data="{ 
         open: false, 
         currentLang: '{{ app()->getLocale() }}', 
         languages: {
             'en': { name: 'English', flag: 'us.png' },
             'es': { name: 'Español', flag: 'es.png' },
             'fr': { name: 'Français', flag: 'fr.png' },
             'de': { name: 'Deutsch', flag: 'de.png' },
             'it': { name: 'Italiano', flag: 'it.png' },
             'pt': { name: 'Português', flag: 'pt.png' },
             'ru': { name: 'Русский', flag: 'ru.png' },
             'cn': { name: '中文', flag: 'cn.png' },
             'hi': { name: 'हिन्दी', flag: 'in.png' },
             'bn': { name: 'বাংলা', flag: 'bd.png' },
             'ar': { name: 'العربية', flag: 'sa.png' },
         },
         switchLanguage(code) {
             this.currentLang = code;
             this.open = false;
             window.location.href = `/lang/${code}`;
         }
     }" 
     x-init="currentLang = '{{ app()->getLocale() }}'"
     x-cloak>
     
    <button @click="open = !open" 
            class="flex items-center space-x-2 p-2 text-gray-600 hover:bg-gray-100 rounded-xl hover-glow transition-all duration-200">
        <img :src="'/assets/flags/' + languages[currentLang].flag" :alt="languages[currentLang].name" class="w-6 h-4 object-cover rounded-sm">
        <span x-text="languages[currentLang].name" class="text-sm font-medium"></span>
        <iconify-icon icon="mdi:chevron-down" class="text-xl text-gray-400 transition-transform duration-300"
        :class="open ? 'rotate-180' : ''"></iconify-icon>
    </button>
    
    <!-- Language Dropdown Menu -->
    <div x-show="open" x-cloak
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95 translate-y-1"
        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 transform scale-95 translate-y-1"
        class="absolute right-0 mt-2 w-48 md:w-56 bg-white rounded-xl shadow-xl border border-gray-50 py-2 z-50 max-w-[800px]">
        
        <div class="px-4 py-2 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-900 flex items-center">
                <i class="fas fa-language mr-2 text-blue-500"></i>
                {{ __('Select Language') }}
            </h3>
        </div>
        
        <template x-for="[code, lang] in Object.entries(languages)" :key="code">
            <button @click="switchLanguage(code)"
                    class="flex items-center w-full px-4 py-3 text-gray-700 hover:bg-gray-50 transition-all duration-200 group"
                    :class="currentLang === code ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-500' : ''">
                <img :src="'/assets/flags/' + lang.flag" :alt="lang.name" class="w-6 h-4 object-cover rounded-sm mr-3 group-hover:scale-110 transition-transform duration-200">
                <span x-text="lang.name" class="font-medium"></span>
                <i x-show="currentLang === code" class="fas fa-check ml-auto text-blue-500"></i>
            </button>
        </template>
    </div>
</div>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }" x-cloak>
                <button @click="open = !open" 
                        class="flex items-center space-x-3 p-2 rounded-xl hover:bg-gray-100 transition-all duration-200 hover-glow">
                    @if(Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                             alt="Profile" class="w-10 h-10 object-cover rounded-full ring-2 ring-primary-200">
                    @else
                        <div class="w-10 h-10 bg-slate-200 rounded-full ring-2 ring-primary-200 flex items-center justify-center text-slate-800 text-sm font-bold">
                            {{ Auth::user()->getInitials() }}
                        </div>
                    @endif
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user() ? Auth::user()->name : 'Guest' }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user() ? Auth::user()->email : 'guest@example.com' }}</p>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>

                <!-- Profile Dropdown Menu -->
                <div x-show="open" x-cloak
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-50">
                    
                    <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                        <iconify-icon icon="duo-icons:user" class="text-xl mr-2"></iconify-icon>
                        <span>{{ __('My Profile') }}</span>
                    </a>
                    
                    <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                        <iconify-icon icon="duo-icons:settings" class="text-xl mr-2"></iconify-icon>
                        <span>{{ __('Account Settings') }}</span>
                    </a>
                    
                    <div class="border-t border-gray-100 mt-2 pt-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 hover:bg-red-50 transition-colors">
                                <div class="w-4 h-4 mr-2">
                                <svg data-slot="icon" size="3" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9"></path>
                                  </svg>
                                </div>
                                <span>{{ __('Sign Out') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>