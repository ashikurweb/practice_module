// Alpine.js Theme Store
document.addEventListener('alpine:init', () => {
    Alpine.store('theme', {
        // State
        isDark: false,
        currentTheme: 'light',

        // Initialize theme
        init() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            this.currentTheme = savedTheme;
            this.isDark = savedTheme === 'dark';
            this.applyTheme(savedTheme);
        },

        // Toggle theme
        toggle() {
            this.isDark = !this.isDark;
            const newTheme = this.isDark ? 'dark' : 'light';
            this.currentTheme = newTheme;
            this.applyTheme(newTheme);
            this.saveTheme(newTheme);
        },

        // Apply theme to document
        applyTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
        },

        // Save theme to localStorage
        saveTheme(theme) {
            localStorage.setItem('theme', theme);
        },

        // Get current theme
        getTheme() {
            return this.currentTheme;
        },

        // Check if dark mode
        isDarkMode() {
            return this.isDark;
        }
    });
}); 