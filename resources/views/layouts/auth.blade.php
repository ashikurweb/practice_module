<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Modern Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <script type="module">
        import heroicons from 'https://cdn.jsdelivr.net/npm/heroicons@2.2.0/+esm'
        </script>        
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .sidebar-gradient {
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
        }
        
        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            transform: translateY(-1px);
        }
        
        .menu-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .menu-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(4px);
        }
        
        .active-menu {
            background: rgba(235, 6, 6, 0.15);
            border-left: 4px solid #60a5fa;
        }
    </style>

    <!-- Include idle timer only for authenticated users -->
    @if (Auth::check() && !request()->is('lockscreen'))
        <x-idle-timer :minutes="config('auth.idle_timeout', 2)" />
    @endif
</head>
<body class="theme-bg-content font-sans antialiased" 
      x-data="{ 
          sidebarOpen: false,
          init() {
              this.sidebarOpen = false;
              window.addEventListener('resize', () => {
                  if (window.innerWidth >= 1024) {
                      this.sidebarOpen = false;
                  }
              });
          }
      }" 
      x-cloak>
    <x-notification />
    <!-- Sidebar Overlay for Mobile -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"></div>

    <!-- Sidebar -->
    <x-components.sidebar />

    <!-- Main Content -->
    <div class="lg:ml-64 flex flex-col min-h-screen">
        <!-- Header -->
        <x-components.header />
        <main class="flex-1 container mx-auto mt-5 px-4 py-8">
            {{ $slot }}
        </main>
    </div>
</body>
</html>