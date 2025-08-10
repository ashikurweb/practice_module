    <x-layouts.guest>
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

    </div>
        @include('frontend.blog.index') <!-- Blog Section -->
    </x-layouts.guest>