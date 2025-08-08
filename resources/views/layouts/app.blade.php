<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Hero Section</title>
    {{-- fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        
        <main>
            {{ $slot }}
        </main>
</body>
</html>