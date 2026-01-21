// Initialize all toggle components on the page
function initializeToggles() {
    const toggles = document.querySelectorAll('#toggle');
    
    toggles.forEach(toggle => {
        // Skip if already initialized
        if (toggle.dataset.initialized === 'true') return;
        
        const opt1 = toggle.querySelector('#opt1');
        const opt2 = toggle.querySelector('#opt2');
        const over = toggle.querySelector('#over');
        
        if (!opt1 || !opt2 || !over) return;
        
        let selected = 0; // 0 = opt1, 1 = opt2
        
        // Initialize the toggle state
        const target = opt1;
        over.style.transform = `translateX(${target.offsetLeft}px)`;
        over.style.width = `${target.offsetWidth}px`;
        opt1.classList.add("text-white");
        opt2.classList.remove("text-white");
        over.innerText = target.innerText;
        
        toggle.addEventListener("click", () => {
            selected = 1 - selected;
            const target = selected === 0 ? opt1 : opt2;

            over.style.transform = `translateX(${target.offsetLeft}px)`;
            over.style.width = `${target.offsetWidth}px`;

            opt1.classList.toggle("text-white");
            opt2.classList.toggle("text-white");

            over.innerText = target.innerText;
            
            // Dispatch custom event with the selected value
            const event = new CustomEvent('toggleChange', {
                detail: {
                    selected: selected,
                    value: selected === 0 ? opt1.innerText.trim() : opt2.innerText.trim(),
                    toggleElement: toggle
                }
            });
            toggle.dispatchEvent(event);
        });
        
        // Mark as initialized
        toggle.dataset.initialized = 'true';
    });
}

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeToggles);
} else {
    initializeToggles();
}
