<?php
namespace App\Services;

class IdleTimerService
{
    public static function generateScript(int $minutes = 30): string
    {
        $milliseconds = $minutes * 60 * 1000;
        $lockUrl = route('lockscreen');
        
        return <<<JS
        (() => {
            const idleTime = {$milliseconds};
            let timer;
            let isLocked = false;
            
            const lockScreen = () => {
                if (!isLocked) {
                    isLocked = true;
                    window.location.href = '{$lockUrl}';
                }
            };
            
            const resetTimer = () => {
                clearTimeout(timer);
                timer = setTimeout(lockScreen, idleTime);
            };
            
            const events = ['mousemove', 'mousedown', 'keypress', 'scroll', 'touchstart', 'click'];
            
            // Throttled event handler
            const handler = throttle(() => resetTimer(), 1000);
            
            events.forEach(event => {
                document.addEventListener(event, handler, true);
            });
            
            // Initialize timer
            resetTimer();
            
            // Throttle utility
            function throttle(callback, delay) {
                let lastCall = 0;
                return (...args) => {
                    const now = new Date().getTime();
                    if (now - lastCall < delay) return;
                    lastCall = now;
                    return callback(...args);
                };
            }
        })();
        JS;
    }
}