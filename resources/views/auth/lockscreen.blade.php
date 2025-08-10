<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lock Screen</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
            height: 100vh;
            cursor: pointer;
        }

        .lockscreen-container {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Background Image with blur effect */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(0px);
            transition: filter 0.8s ease;
        }

        .background.blurred {
            filter: blur(25px) brightness(0.7);
        }

        /* Default Screen */
        .default-screen {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 20;
            transition: opacity 0.8s ease, transform 0.8s ease;
            transform: translateY(0);
            cursor: pointer;
        }

        .default-screen.hidden {
            opacity: 0;
            transform: translateY(-50px);
            pointer-events: none;
            cursor: default;
        }

        /* Time Display */
        .time-display {
            font-size: 6rem;
            font-weight: 200;
            color: white;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.6);
            margin-bottom: 0.5rem;
            animation: timeGlow 4s ease-in-out infinite alternate;
            letter-spacing: -2px;
        }

        .date-display {
            font-size: 1.8rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 0 2px 15px rgba(0, 0, 0, 0.4);
            margin-bottom: 4rem;
            letter-spacing: 1px;
        }

        /* Scroll hint */
        .scroll-hint {
            position: absolute;
            bottom: 8%;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            text-align: center;
            animation: bounce 2.5s infinite;
        }

        .scroll-icon {
            font-size: 1.5rem;
            margin-top: 0.5rem;
            display: block;
        }

        /* Login Screen */
        .login-screen {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 30;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.8s ease, transform 0.8s ease;
            transform: translateY(100px);
        }

        .login-screen.active {
            opacity: 1;
            pointer-events: all;
            transform: translateY(0);
        }

        /* Glass morphism card - Improved Design */
        .glass-card {
            backdrop-filter: blur(25px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            width: 100%;
            max-width: 380px;
            text-align: center;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                0 0 1px rgba(255, 255, 255, 0.2) inset;
            position: relative;
            animation: slideInUp 0.6s ease-out;
        }

        /* Profile Image Container */
        .profile-container {
            position: relative;
            margin-bottom: 2.5rem;
            display: flex;
            justify-content: center;
        }

        .profile-image {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.4);
            box-shadow: 
                0 0 0 4px rgba(255, 255, 255, 0.1),
                0 8px 32px rgba(0, 0, 0, 0.3);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .profile-image:hover {
            transform: scale(1.05);
            box-shadow: 
                0 0 0 4px rgba(255, 255, 255, 0.2),
                0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .profile-initials {
            width: 110px;
            height: 110px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: 300;
            color: white;
            box-shadow: 
                0 0 0 4px rgba(255, 255, 255, 0.1),
                0 8px 32px rgba(0, 0, 0, 0.3);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .profile-initials:hover {
            transform: scale(1.05);
            box-shadow: 
                0 0 0 4px rgba(255, 255, 255, 0.2),
                0 12px 40px rgba(0, 0, 0, 0.4);
        }

        /* User Name */
        .user-name {
            font-size: 1.9rem;
            font-weight: 300;
            color: white;
            margin-bottom: 2.5rem;
            text-shadow: 0 2px 15px rgba(0, 0, 0, 0.4);
            letter-spacing: 0.5px;
        }

        /* Form Styling */
        .unlock-form {
            width: 100%;
        }

        .password-input {
            width: 100%;
            padding: 1.2rem 2rem;
            background: rgba(255, 255, 255, 0.08);
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 60px;
            color: white;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            outline: none;
            transition: all 0.4s ease;
            backdrop-filter: blur(20px);
            text-align: center;
        }

        .password-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
        }

        .password-input:focus {
            border-color: rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 
                0 0 0 4px rgba(255, 255, 255, 0.1),
                0 8px 32px rgba(0, 0, 0, 0.2);
            transform: translateY(-3px);
        }

        .error-message {
            color: #ff6b6b;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            animation: shake 0.6s ease-in-out;
        }

        .unlock-button {
            width: 100%;
            padding: 1.2rem 2rem;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.25);
            border-radius: 60px;
            color: white;
            font-size: 1.1rem;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(20px);
            letter-spacing: 0.5px;
        }

        .unlock-button:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.35);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        .unlock-button:active {
            transform: translateY(-1px);
        }

        /* Weather info */
        .weather-info {
            position: absolute;
            bottom: 2.5rem;
            left: 2.5rem;
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 1.2rem;
            color: white;
            min-width: 220px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .weather-temp {
            font-size: 2.2rem;
            font-weight: 200;
            margin-bottom: 0.5rem;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .weather-desc {
            font-size: 0.95rem;
            opacity: 0.85;
            line-height: 1.4;
        }

        /* Floating particles */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            pointer-events: none;
            animation: float 12s linear infinite;
        }

        /* Scroll progress indicator */
        .scroll-progress {
            position: fixed;
            top: 50%;
            right: 30px;
            transform: translateY(-50%);
            width: 4px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            z-index: 40;
        }

        .scroll-progress-bar {
            width: 100%;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 2px;
            transition: height 0.3s ease;
            height: 0%;
        }

        /* Animations */
        @keyframes timeGlow {
            from {
                text-shadow: 0 4px 30px rgba(0, 0, 0, 0.6);
            }
            to {
                text-shadow: 
                    0 4px 40px rgba(255, 255, 255, 0.2),
                    0 0 60px rgba(255, 255, 255, 0.1);
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-15px);
            }
            60% {
                transform: translateX(-50%) translateY(-8px);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(60px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.6;
            }
            90% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .time-display {
                font-size: 4rem;
            }
            
            .date-display {
                font-size: 1.4rem;
            }
            
            .glass-card {
                padding: 2.5rem 2rem;
                margin: 1rem;
                max-width: 380px;
            }
            
            .profile-image,
            .profile-initials {
                width: 90px;
                height: 90px;
            }
            
            .user-name {
                font-size: 1.6rem;
            }

            .weather-info {
                bottom: 1.5rem;
                left: 1.5rem;
                min-width: 180px;
                padding: 1rem;
            }

            .weather-temp {
                font-size: 1.8rem;
            }

            .scroll-progress {
                right: 20px;
                height: 80px;
            }
        }

        @media (max-width: 480px) {
            .time-display {
                font-size: 3rem;
            }
            
            .glass-card {
                padding: 2rem 1.5rem;
                margin: 0.5rem;
                max-width: 340px;
            }
        }
    </style>
</head>
<body>
    <div class="lockscreen-container">
        <!-- Background -->
        <div class="background" id="background"></div>
        
        <!-- Floating Particles -->
        <div class="particles" id="particles"></div>

        <!-- Scroll Progress Indicator -->
        <div class="scroll-progress">
            <div class="scroll-progress-bar" id="scrollBar"></div>
        </div>

        <!-- Default Screen -->
        <div class="default-screen" id="defaultScreen">
            <div class="time-display" id="timeDisplay">15:56</div>
            <div class="date-display" id="dateDisplay">Sunday 10 August</div>
            <div class="scroll-hint">
                <div>Scroll or click anywhere to unlock</div>
                <span class="scroll-icon">⇅</span>
            </div>
        </div>

        <!-- Weather Info -->
        <div class="weather-info">
            <div class="weather-temp">34°C</div>
            <div class="weather-desc">Dhaka Division<br>Mostly cloudy</div>
        </div>

         <!-- Login Screen (Second View) -->
        <div class="login-screen" id="loginScreen">
            <!-- Back Button -->
            <div class="back-button" id="backButton">
                <span></span>
            </div>

            <!-- Glass Card -->
            <div class="glass-card">
                <!-- Profile Section -->
                <div class="profile-container">
                    @if(Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                             alt="Profile" 
                             class="profile-image">
                    @else
                        <div class="profile-initials">
                            {{ Auth::user()->getInitials() }}
                        </div>
                    @endif
                </div>

                <!-- User Name -->
                <h2 class="user-name">{{ $user->name }}</h2>

                <!-- Unlock Form -->
                <form method="POST" action="{{ route('lockscreen.unlock') }}" class="unlock-form">
                    @csrf
                    <input type="password" 
                           name="password" 
                           placeholder="Password" 
                           class="password-input" 
                           required 
                           autofocus>
                    
                    @error('password')
                        <p class="error-message">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="unlock-button">
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const defaultScreen = document.getElementById('defaultScreen');
            const loginScreen = document.getElementById('loginScreen');
            const background = document.getElementById('background');
            const timeDisplay = document.getElementById('timeDisplay');
            const dateDisplay = document.getElementById('dateDisplay');
            const scrollBar = document.getElementById('scrollBar');
            
            let scrollThreshold = 0;
            let isLocked = true;

            // Update time and date
            function updateTime() {
                const now = new Date();
                const timeOptions = { 
                    hour: '2-digit', 
                    minute: '2-digit',
                    hour12: false 
                };
                const dateOptions = { 
                    weekday: 'long', 
                    day: 'numeric', 
                    month: 'long' 
                };
                
                timeDisplay.textContent = now.toLocaleTimeString('en-US', timeOptions);
                dateDisplay.textContent = now.toLocaleDateString('en-US', dateOptions);
            }

            updateTime();
            setInterval(updateTime, 1000);

            // Click event handlers
            defaultScreen.addEventListener('click', function() {
                if (isLocked) {
                    scrollThreshold = 300;
                    activateLoginScreen();
                }
            });

            // Click outside login form to close
            loginScreen.addEventListener('click', function(e) {
                // Only close if clicking outside the glass card
                if (e.target === loginScreen) {
                    deactivateLoginScreen();
                }
            });

            // Handle scroll events
            function handleScroll(event) {
                event.preventDefault();
                
                const delta = event.deltaY || event.detail || event.wheelDelta;
                
                // Handle scroll direction
                if (isLocked) {
                    // On default screen - scroll down to activate login
                    if (delta > 0) {
                        scrollThreshold += delta;
                    } else {
                        scrollThreshold -= Math.abs(delta);
                    }
                } else {
                    // On login screen - scroll up to go back
                    if (delta < 0) {
                        scrollThreshold -= Math.abs(delta) * 2; // Faster return
                    } else {
                        scrollThreshold += delta;
                    }
                }
                
                // Clamp scroll threshold between -100 and 300
                scrollThreshold = Math.max(-100, Math.min(300, scrollThreshold));
                
                // Update progress bar
                const progress = Math.max(0, (scrollThreshold / 300) * 100);
                scrollBar.style.height = progress + '%';
                
                // Activate login screen when scrolling down enough
                if (scrollThreshold >= 300 && isLocked) {
                    activateLoginScreen();
                }
                
                // Deactivate when scrolling up enough
                if (scrollThreshold <= 0 && !isLocked) {
                    deactivateLoginScreen();
                }
            }

            function activateLoginScreen() {
                isLocked = false;
                defaultScreen.classList.add('hidden');
                loginScreen.classList.add('active');
                background.classList.add('blurred');
                document.body.style.cursor = 'default';
                
                // Focus on password input after animation
                setTimeout(() => {
                    const passwordInput = document.querySelector('.password-input');
                    if (passwordInput) {
                        passwordInput.focus();
                    }
                }, 800);
            }

            function deactivateLoginScreen() {
                isLocked = true;
                scrollThreshold = 0;
                scrollBar.style.height = '0%';
                loginScreen.classList.remove('active');
                defaultScreen.classList.remove('hidden');
                background.classList.remove('blurred');
                document.body.style.cursor = 'pointer';
            }

            // Add scroll event listeners
            document.addEventListener('wheel', handleScroll, { passive: false });
            document.addEventListener('DOMMouseScroll', handleScroll, { passive: false });

            // Touch events for mobile
            let startY = 0;
            let currentY = 0;

            document.addEventListener('touchstart', function(e) {
                startY = e.touches[0].clientY;
            });

            document.addEventListener('touchmove', function(e) {
                e.preventDefault();
                currentY = e.touches[0].clientY;
                const deltaY = startY - currentY;
                
                // Handle touch direction
                if (isLocked) {
                    // On default screen - swipe up to activate login
                    scrollThreshold += deltaY * 2;
                } else {
                    // On login screen - swipe down to go back
                    scrollThreshold -= deltaY * 3; // Faster return on touch
                }
                
                // Clamp scroll threshold
                scrollThreshold = Math.max(-100, Math.min(300, scrollThreshold));
                
                const progress = Math.max(0, (scrollThreshold / 300) * 100);
                scrollBar.style.height = progress + '%';
                
                if (scrollThreshold >= 300 && isLocked) {
                    activateLoginScreen();
                }
                
                if (scrollThreshold <= 0 && !isLocked) {
                    deactivateLoginScreen();
                }
                
                startY = currentY;
            }, { passive: false });

            // ESC key to go back
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !isLocked) {
                    deactivateLoginScreen();
                }
            });

            // Create floating particles
            function createParticle() {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                const size = Math.random() * 6 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 8 + 10) + 's';
                particle.style.animationDelay = Math.random() * 3 + 's';
                
                document.getElementById('particles').appendChild(particle);
                
                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.remove();
                    }
                }, 15000);
            }
            
            setInterval(createParticle, 1200);

            // Handle form submission
            document.querySelector('.unlock-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const button = document.querySelector('.unlock-button');
                const passwordInput = document.querySelector('.password-input');
                
                button.innerHTML = 'Signing in...';
                button.style.background = 'rgba(255, 255, 255, 0.25)';
                passwordInput.disabled = true;
                
                // Simulate login process
                setTimeout(() => {
                    alert('Login functionality would go here');
                    button.innerHTML = 'Sign In';
                    button.style.background = 'rgba(255, 255, 255, 0.15)';
                    passwordInput.disabled = false;
                    passwordInput.value = '';
                }, 2000);
            });

            // Prevent context menu
            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });

            // Prevent default scroll behavior
            document.addEventListener('scroll', function(e) {
                e.preventDefault();
                window.scrollTo(0, 0);
            });
        });
    </script>
</body>
</html>