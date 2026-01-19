// Función para colapsar/expandir (existente)
window.collapseProfesionals = () => {
    const section = document.getElementById('section');
    if (section) {
        section.classList.toggle('hidden');
    }
}

// BUSCADOR
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const clearSearch = document.getElementById('clear-search');
    const searchResults = document.getElementById('search-results');
    const resultsCount = document.getElementById('results-count');
    const professionalCards = document.querySelectorAll('.professional-card');
    
    if (!searchInput || professionalCards.length === 0) return;
    
    // Función de búsqueda
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        
        professionalCards.forEach(card => {
            const professionalName = card.getAttribute('data-name');
            
            if (professionalName.includes(searchTerm)) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Mostrar resultados
        if (searchTerm) {
            searchResults.classList.remove('hidden');
            resultsCount.textContent = visibleCount;
            
            // Mostrar mensaje si no hay resultados
            const noResultsMsg = document.querySelector('.no-results-message');
            if (noResultsMsg) noResultsMsg.remove();
            
            if (visibleCount === 0) {
                const section = document.getElementById('section');
                const message = document.createElement('p');
                message.className = 'no-results-message col-span-5 text-center text-gray-500 py-8';
                message.textContent = `No s'han trobat resultats per "${searchTerm}"`;
                section.appendChild(message);
            }
        } else {
            searchResults.classList.add('hidden');
            const noResultsMsg = document.querySelector('.no-results-message');
            if (noResultsMsg) noResultsMsg.remove();
        }
    }
    
    
    // Event listeners
    searchInput.addEventListener('input', performSearch);
    
    if (clearSearch) {
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            performSearch();
            searchInput.focus();
        });
    }
    
});