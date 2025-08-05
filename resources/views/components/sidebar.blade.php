<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .sidebar-gradient {
        background: linear-gradient(180deg,
                #ffffff 0%,
                #ffffff 25%,
                #ffffff 50%,
                #ffffff 75%,
                #ffffff 100%);
        backdrop-filter: blur(20px);
        border-right: 2px solid #e2e8f0;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.05);
    }

    .menu-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .menu-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .menu-item:hover::before {
        left: 100%;
    }

    .menu-item:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(4px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-left: 3px solid #60a5fa;
    }

    .active-menu {
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        border-left: 4px solid #3b82f6;
        box-shadow:
            0 4px 20px rgba(59, 130, 246, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
        transform: translateX(2px);
    }

    .active-menu i {
        color: #3b82f6;
        transform: scale(1.1);
    }

    .submenu-item {
        position: relative;
        transition: all 0.3s ease;
    }

    .submenu-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #60a5fa, #3b82f6);
        transition: width 0.3s ease;
        transform: translateY(-50%);
    }

    .submenu-item:hover::before {
        width: 20px;
    }

    .submenu-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateX(8px);
        padding-left: 1.5rem;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .logo-icon {
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .user-profile {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.05));
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .user-profile:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.1));
        transform: translateY(-2px);
    }

    .user-avatar {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .user-profile:hover .user-avatar {
        transform: scale(1.1);
    }

    .chevron-icon {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .notification-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
        animation: blink 1.5s infinite;
    }

    @keyframes blink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 40;
    }

    /* Mobile responsiveness */
    @media (max-width: 1024px) {
        .sidebar {
            z-index: 50;
        }
    }

    /* Scrollbar styling */
    .sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 2px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }
</style>

<!-- Mobile Overlay -->
<div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" @click="sidebarOpen = false" class="sidebar-overlay lg:hidden"></div>

<!-- Sidebar -->
<div class="fixed top-0 left-0 z-50 w-64 h-full sidebar-gradient shadow-2xl sidebar overflow-y-auto lg:translate-x-0"
    :class="sidebarOpen ? 'open' : ''" x-cloak>

    <!-- Logo Area -->
    <div class="flex items-center justify-center h-16 px-4 border-b border-slate-200">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 logo-icon rounded-lg flex items-center justify-center relative">
                <iconify-icon icon="duo-icons:app-dots" class="text-xl"></iconify-icon>
                <div class="notification-badge"></div>
            </div>
            <span class="text-xl font-bold text-slate-900 tracking-wide">Dashboard</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-8 px-4 space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="menu-item flex items-center px-4 py-3 text-slate-600 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'active-menu' : '' }}">
            <iconify-icon icon="duo-icons:dashboard" class="text-xl mr-2"></iconify-icon>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Analytics with Dropdown -->
        <div x-data="{ open: false }" x-cloak>
            <button @click="open = !open"
                class="menu-item w-full flex items-center justify-between px-4 py-3 text-slate-600 rounded-xl transition-all duration-300">
                <div class="flex items-center">
                    <!-- Iconify Chart Line Icon -->
                    <iconify-icon icon="mdi:chart-line"
                        class="w-5 text-center mr-3"></iconify-icon>
                    <span class="font-medium">Analytics</span>
                </div>
                <iconify-icon icon="mdi:chevron-down" class="text-xl transition-transform duration-300"
                    :class="open ? 'rotate-180' : ''"></iconify-icon>
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 transform scale-95 translate-y-2" class="ml-4 mt-2 space-y-1">
                <a href="#"
                    class="flex items-center px-4 py-2 text-gray-600 hover:text-slate-900 rounded-lg transition-all duration-300">
                    <iconify-icon icon="mdi:chart-line"
                        class="w-5 text-center mr-3 opacity-60"></iconify-icon>
                    <span class="text-sm font-medium">Reports</span>
                </a>
                <a href="#"
                    class="flex items-center px-4 py-2 text-gray-600 hover:text-slate-900 rounded-lg transition-all duration-300">
                    <iconify-icon icon="mdi:chart-line"
                        class="w-5 text-center mr-3 opacity-60"></iconify-icon>
                    <span class="text-sm font-medium">Insights</span>
                </a>
                <a href="#"
                    class="flex items-center px-4 py-2 text-gray-600 hover:text-slate-900 rounded-lg transition-all duration-300">
                    <iconify-icon icon="mdi:chart-line"
                        class="w-5 text-center mr-3 opacity-60"></iconify-icon>
                    <span class="text-sm font-medium">Real-time Data</span>
                </a>
            </div>
        </div>

        <!-- Users -->
        <a href="{{ route('admin.users') }}" class="menu-item flex items-center px-4 py-3 text-slate-600 rounded-xl relative {{ request()->routeIs('admin.users') ? 'active-menu' : '' }}">
            <iconify-icon icon="duo-icons:user" class="text-xl mr-2"></iconify-icon>
            <span class="font-medium">Users</span>
        </a>

        <!-- Products with Dropdown -->
        <div x-data="{ open: false }" x-cloak>
            <button @click="open = !open"
                class="menu-item w-full flex items-center justify-between px-4 py-3 text-slate-600 rounded-xl">
                <div class="flex items-center">
                    <iconify-icon icon="duo-icons:box" class="text-xl mr-2"></iconify-icon>
                    <span class="font-medium">Products</span>
                </div>
                <iconify-icon icon="mdi:chevron-down" class="text-xl transition-transform duration-300"
                    :class="open ? 'rotate-180' : ''"></iconify-icon>
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
                x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 transform scale-95 translate-y-2" class="ml-4 mt-2 space-y-1">
                <a href="#"
                    class="submenu-item flex items-center px-4 py-2 text-gray-600 hover:text-slate-900 rounded-lg transition-all duration-300">
                    <iconify-icon icon="duo-icons:box" class="text-xl mr-2 opacity-60"></iconify-icon>
                    <span class="text-sm font-medium">All Products</span>
                </a>
                <a href="#"
                    class="submenu-item flex items-center px-4 py-2 text-gray-600 hover:text-slate-900 rounded-lg transition-all duration-300">
                    <iconify-icon icon="duo-icons:align-center" class="text-xl mr-2 opacity-60"></iconify-icon>
                    <span class="text-sm font-medium">Categories</span>
                </a>
                <a href="#"
                    class="submenu-item flex items-center px-4 py-2 text-gray-600 hover:text-slate-900 rounded-lg transition-all duration-300">
                    <iconify-icon icon="duo-icons:align-bottom" class="text-xl mr-2 opacity-60"></iconify-icon>
                    <span class="text-sm font-medium">Inventory</span>
                </a>
                <a href="#"
                    class="submenu-item flex items-center px-4 py-2 text-gray-600 hover:text-slate-900 rounded-lg transition-all duration-300">
                    <iconify-icon icon="duo-icons:bell" class="text-xl mr-2 opacity-60"></iconify-icon>
                    <span class="text-sm font-medium">Stock Alerts</span>
                </a>
            </div>
        </div>

        <!-- Orders -->
        <a href="#" class="menu-item flex items-center px-4 py-3 text-slate-600 rounded-xl">
            <iconify-icon icon="duo-icons:briefcase" class="text-xl mr-2"></iconify-icon>
            <span class="font-medium">Orders</span>
        </a>

        <!-- Messages -->
        <a href="#" class="menu-item flex items-center px-4 py-3 text-slate-600 rounded-xl">
            <iconify-icon icon="duo-icons:message-2" class="text-xl mr-2"></iconify-icon>
            <span class="font-medium">Messages</span>
        </a>

        <a href="{{ route('profile.index') }}"
            class="menu-item flex items-center px-4 py-3 text-slate-600 rounded-xl {{ request()->routeIs('profile.*') ? 'active-menu' : '' }}">
            <iconify-icon icon="duo-icons:user" class="text-xl mr-2"></iconify-icon>
            <span class="font-medium">Profile</span>
        </a>

        <!-- Settings -->
        <a href="{{ route('settings') }}" class="menu-item flex items-center px-4 py-3 text-slate-600 rounded-xl {{ request()->routeIs('settings') ? 'active-menu' : '' }}">
            <iconify-icon icon="duo-icons:settings" class="text-xl mr-2"></iconify-icon>
            <span class="font-medium">Settings</span>
        </a>
    </nav>
</div>
