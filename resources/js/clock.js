// Real-time clock update
function updateClock() {
    const clockElements = document.querySelectorAll('.realtime-clock');
    const now = new Date();
    
    // Format for Asia/Manila timezone
    const options = {
        timeZone: 'Asia/Manila',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    };
    
    const timeString = now.toLocaleTimeString('en-US', options);
    
    clockElements.forEach(element => {
        element.textContent = timeString;
    });
}

// Update clock every second
setInterval(updateClock, 1000);

// Initial call
document.addEventListener('DOMContentLoaded', updateClock);