<div x-data="{}" 
     x-init="$store.theme.init()"
     class="flex items-center space-x-2">
    
    <!-- Theme Toggle Switch -->
    <button @click="$store.theme.toggle()" 
            class="theme-toggle relative"
            :class="{ 'ring-2 ring-yellow-400': $store.theme.isDarkMode() }"
            title="Toggle theme">
        
        <!-- Sun Icon -->
        <i class="fas fa-sun theme-icon sun" 
           :class="{ 'opacity-100': !$store.theme.isDarkMode(), 'opacity-0': $store.theme.isDarkMode() }"></i>
        
        <!-- Moon Icon -->
        <i class="fas fa-moon theme-icon moon" 
           :class="{ 'opacity-100': $store.theme.isDarkMode(), 'opacity-0': !$store.theme.isDarkMode() }"></i>
    </button>
    
    <!-- Theme Label (Optional) -->
    <span class="text-sm font-medium theme-text-secondary" x-text="$store.theme.isDarkMode() ? 'Dark' : 'Light'"></span>
</div> 