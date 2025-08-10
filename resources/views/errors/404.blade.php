<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            height: 100vh;
            overflow: hidden;
            cursor: none;
        }
        .container {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
        }
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            filter: blur(10px) brightness(0.2) contrast(1.2);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform: scale(1.1);
        }
        .content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: white;
            padding: 2rem;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            margin: 0 auto;
            transition: all 0.3s ease;
        }
        .content:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-5px);
            box-shadow: 0 35px 70px rgba(0, 0, 0, 0.4);
        }
        .error-code {
            font-size: clamp(4rem, 12vw, 8rem);
            font-weight: 900;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientShift 3s ease-in-out infinite;
            letter-spacing: -0.05em;
            margin-bottom: 1rem;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
        }
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .title {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            opacity: 0.95;
            letter-spacing: -0.02em;
        }
        .description {
            font-size: clamp(1rem, 2.5vw, 1.2rem);
            margin-bottom: 2.5rem;
            opacity: 0.8;
            line-height: 1.6;
            color: #e0e6ed;
        }
        .home-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }
        .home-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        .home-button:hover::before {
            left: 100%;
        }
        .home-button:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .cursor-follower {
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 40%, transparent 70%);
            pointer-events: none;
            transform: translate(-50%, -50%);
            transition: all 0.1s ease-out;
            z-index: 5;
            mix-blend-mode: screen;
        }
        .cursor-glow {
            position: fixed;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.3) 50%, transparent 70%);
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 15;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
        }
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            50% { transform: translateY(-100px) rotate(180deg); }
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .content {
                margin: 1rem;
                padding: 1.5rem;
            }
            
            .cursor-follower {
                width: 250px;
                height: 250px;
            }
            
            .cursor-glow {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="background-image" id="backgroundImage"></div>
        <div class="cursor-follower" id="cursorFollower"></div>
        <div class="cursor-glow" id="cursorGlow"></div>
        
        <div class="particles" id="particles"></div>
        
        <div class="content">
            <div class="error-code">404</div>
            <h1 class="title">Page Not Found</h1>
            <p class="description">
                Sorry, the page you are looking for does not exist or has been removed.
            </p>

            {{-- redirect back --}}
            <a href="{{ url()->previous() }}" class="home-button">
                <span>🏠</span>
                Go Back
            </a>
        </div>
    </div>
    <script>
        // Cursor follower and background focus effect
        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;
        let glowX = 0, glowY = 0;
        
        const cursorFollower = document.getElementById('cursorFollower');
        const cursorGlow = document.getElementById('cursorGlow');
        const backgroundImage = document.getElementById('backgroundImage');
        
        // Smooth cursor following
        function updateCursor() {
            // Update follower position with smooth easing
            followerX += (mouseX - followerX) * 0.1;
            followerY += (mouseY - followerY) * 0.1;
            
            // Update glow position with faster easing
            glowX += (mouseX - glowX) * 0.3;
            glowY += (mouseY - glowY) * 0.3;
            
            cursorFollower.style.left = followerX + 'px';
            cursorFollower.style.top = followerY + 'px';
            
            cursorGlow.style.left = glowX + 'px';
            cursorGlow.style.top = glowY + 'px';
            
            // Calculate background brightness based on cursor position
            const centerX = window.innerWidth / 2;
            const centerY = window.innerHeight / 2;
            const distanceX = (mouseX - centerX) / centerX;
            const distanceY = (mouseY - centerY) / centerY;
            
            // Calculate brightness based on distance from center
            const distance = Math.sqrt(distanceX * distanceX + distanceY * distanceY);
            const brightness = 0.2 + (0.5 * (1 - Math.min(distance, 1)));
            const blur = 10 - (8 * (1 - Math.min(distance, 1)));
            
            backgroundImage.style.filter = `blur(${blur}px) brightness(${brightness}) contrast(1.2)`;
            backgroundImage.style.transform = `scale(${1.1 - (0.1 * (1 - Math.min(distance, 1)))})`;
            
            requestAnimationFrame(updateCursor);
        }
        
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });
        
        updateCursor();
        
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
                particlesContainer.appendChild(particle);
            }
        }
        
        createParticles();
        
        // Home button function
        function goHome() {
            // In Laravel, this would be: window.location.href = "{{ route('home') }}";
            alert('This would redirect to home page in a Laravel application');
        }
        
        // Add some interactivity on load
        window.addEventListener('load', () => {
            document.querySelector('.content').style.opacity = '0';
            document.querySelector('.content').style.transform = 'translateY(50px)';
            
            setTimeout(() => {
                document.querySelector('.content').style.transition = 'all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                document.querySelector('.content').style.opacity = '1';
                document.querySelector('.content').style.transform = 'translateY(0)';
            }, 500);
        });
    </script>
</body>
</html>