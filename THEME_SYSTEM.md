# Theme System Documentation

## Overview
This theme system provides a clean, reusable dark/light theme toggle with smooth animations and transitions.

## Features
- ✅ Dark/Light theme toggle with animated switch
- ✅ Smooth transitions between themes
- ✅ Persistent theme selection (localStorage)
- ✅ Reusable component system
- ✅ CSS custom properties for easy customization
- ✅ Responsive design

## Usage

### 1. Theme Toggle Component
```blade
<!-- Include the theme toggle anywhere in your layout -->
<x-components.theme-toggle />
```

### 2. Theme Utility Classes
Use these CSS classes to apply theme-aware styling:

#### Background Colors
- `.theme-bg-primary` - Main background color
- `.theme-bg-secondary` - Secondary background color  
- `.theme-bg-tertiary` - Tertiary background color

#### Text Colors
- `.theme-text-primary` - Primary text color
- `.theme-text-secondary` - Secondary text color
- `.theme-text-muted` - Muted text color

#### Accent Colors
- `.theme-accent-primary` - Primary accent color
- `.theme-accent-secondary` - Secondary accent color
- `.theme-accent-tertiary` - Tertiary accent color

#### Borders & Shadows
- `.theme-border-primary` - Primary border color
- `.theme-border-secondary` - Secondary border color
- `.theme-shadow` - Default shadow
- `.theme-shadow-lg` - Large shadow

### 3. JavaScript API
```javascript
// Access theme manager
const themeManager = window.themeManager;

// Get current theme
const currentTheme = themeManager.getTheme();

// Toggle theme
const newTheme = themeManager.toggleTheme();

// Set specific theme
themeManager.setTheme('dark');
themeManager.setTheme('light');
```

### 4. Event Listeners
```javascript
// Listen for theme changes
document.addEventListener('themeChanged', (e) => {
    console.log('Theme changed to:', e.detail.theme);
});
```

## CSS Custom Properties

The theme system uses CSS custom properties that automatically update:

### Light Theme (Default)
```css
--bg-primary: #ffffff;
--bg-secondary: #f8fafc;
--bg-tertiary: #f1f5f9;
--text-primary: #1e293b;
--text-secondary: #64748b;
--text-muted: #94a3b8;
--border-primary: #e2e8f0;
--border-secondary: #f1f5f9;
--accent-primary: #3b82f6;
--accent-secondary: #60a5fa;
--accent-tertiary: #dbeafe;
```

### Dark Theme
```css
--bg-primary: #0f172a;
--bg-secondary: #1e293b;
--bg-tertiary: #334155;
--text-primary: #f1f5f9;
--text-secondary: #cbd5e1;
--text-muted: #64748b;
--border-primary: #334155;
--border-secondary: #475569;
--accent-primary: #60a5fa;
--accent-secondary: #3b82f6;
--accent-tertiary: #1e40af;
```

## Customization

### Adding New Themes
1. Add new theme variables to `resources/css/app.css`
2. Update the theme toggle component if needed
3. Add theme-specific styles

### Modifying Colors
Edit the CSS custom properties in `resources/css/app.css` to change theme colors.

### Animation Customization
Modify the transition properties in the CSS to change animation timing and easing.

## Browser Support
- Modern browsers with CSS custom properties support
- LocalStorage for theme persistence
- Alpine.js for reactive functionality

## Performance
- CSS custom properties provide smooth transitions
- Minimal JavaScript overhead
- Efficient theme switching without page reloads 