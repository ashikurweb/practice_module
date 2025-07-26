@if(session('success') || session('error'))
    <div id="notification" class="fixed top-3 right-5 z-50 w-full max-w-sm pointer-events-auto opacity-0 translate-y-4 transition-all duration-300 ease-out">
        <div class="relative flex items-start gap-3 p-5 rounded-2xl shadow-md border backdrop-blur-lg bg-white/75 
                    {{ session('success') ? 'border-green-200' : 'border-red-200' }}">
            
            <!-- Spinner / Icon -->
            <div class="flex-shrink-0 relative h-6 w-6">
                <svg id="spinnerIcon" class="h-6 w-6 {{ session('success') ? 'text-green-500' : 'text-red-500' }}" 
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                     style="animation: spin-slow 1.2s linear infinite;">
                    <circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="3" class="opacity-25"/>
                    <path fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z" class="opacity-75"/>
                </svg>
                
                <svg id="statusIcon" class="h-6 w-6 hidden {{ session('success') ? 'text-green-600' : 'text-red-600' }}" 
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    @if(session('success'))
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                    @endif
                </svg>
            </div>

            <!-- Message -->
            <div class="flex-1">
                <p class="text-base leading-snug font-medium {{ session('success') ? 'text-green-600' : 'text-red-600' }}">
                    {{ session('success') ?? session('error') }}
                </p>
            </div>

            <!-- Close button -->
            <button onclick="closeNotification()" 
                    class="ml-3 -mt-1 -mr-1 p-1 rounded-full focus:outline-none transition-opacity duration-200 hover:opacity-70
                           {{ session('success') ? 'text-green-500 hover:bg-green-100' : 'text-red-500 hover:bg-red-100' }}"
                    aria-label="Close notification">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" clip-rule="evenodd" 
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"/>
                </svg>
            </button>
        </div>
    </div>

    <style>
        @keyframes spin-slow {
            to { transform: rotate(360deg); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notification = document.getElementById('notification');
            const spinnerIcon = document.getElementById('spinnerIcon');
            const statusIcon = document.getElementById('statusIcon');
            let timerId = null;

            // Show notification
            setTimeout(() => {
                notification.classList.remove('opacity-0', 'translate-y-4');
                notification.classList.add('opacity-100', 'translate-y-0');
            }, 50);

            // Stop spinner and show status icon
            setTimeout(() => {
                spinnerIcon.classList.add('hidden');
                statusIcon.classList.remove('hidden');
            }, 800);

            // Auto-dismiss after 5 seconds
            timerId = setTimeout(() => {
                closeNotification();
            }, 5050);

            // Close function
            window.closeNotification = function() {
                clearTimeout(timerId);
                notification.classList.remove('opacity-100', 'translate-y-0');
                notification.classList.add('opacity-0', 'translate-y-4');
                
                // Remove from DOM after animation
                setTimeout(() => {
                    notification.remove();
                }, 200);
            };
        });
    </script>
@endif 