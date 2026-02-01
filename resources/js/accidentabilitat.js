/**
 * Accidentabilitat Module
 * Handles collapsible sections and inline forms for accident tracking
 */

/**
 * Toggle collapse state of a section
 * @param {string} id - The ID of the section element
 */
function toggleCollapse(id) {
    const el = document.getElementById(id);
    const toggle = document.getElementById(id + 'Toggle');
    if (!el) return;
    el.classList.toggle('hidden');
    if (toggle) toggle.classList.toggle('rotate-90');
}

/**
 * Toggle visibility of an inline form
 * @param {string} id - The ID of the form element
 */
function toggleInlineForm(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.toggle('hidden');
    // Scroll into view when opening
    if (!el.classList.contains('hidden')) {
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

// Make functions globally available
window.toggleCollapse = toggleCollapse;
window.toggleInlineForm = toggleInlineForm;
