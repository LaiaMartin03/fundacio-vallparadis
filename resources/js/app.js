import "./libs/trix";
// import { Turbo } from "@hotwired/turbo"
import Alpine from 'alpinejs';

import './bootstrap';
import '../css/app.css';

import './professionals.js';
import './toggle.js';
import './modal';
import './outsiders';
import './calendar.js';
import './accidentabilitat.js';

// window.Turbo = Turbo
window.Alpine = Alpine;

// Ensure calendar is available before starting Alpine
// The calendar.js module sets window.calendar, but we need to wait for it
function startAlpineWhenReady() {
    if (typeof window.calendar === 'function') {
        Alpine.start();
    } else {
        // Calendar not ready yet, wait a bit and try again
        setTimeout(startAlpineWhenReady, 10);
    }
}

// Start checking when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', startAlpineWhenReady);
} else {
    // DOM already loaded, start checking immediately
    startAlpineWhenReady();
}
