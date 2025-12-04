// Función para colapsar/expandir (existente)
window.collapseProfesionals = () => {
    const section = document.getElementById('section');
    if (section) {
        section.classList.toggle('hidden');
    }
}

// Buscador professioanl
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

// Buscador RRHH
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const clearSearch = document.getElementById('clear-search');
    const searchResults = document.getElementById('search-results');
    const resultsCount = document.getElementById('results-count');
    
    // Solo ejecutar si estamos en la página RRHH (verificamos por el título)
    const pageTitle = document.querySelector('h1.font-mclaren');
    const isHrrPage = pageTitle && pageTitle.textContent.includes('RRHH');
    
    if (!searchInput || !isHrrPage) return;
    
    // Buscar filas de la tabla
    const tableRows = document.querySelectorAll('tbody tr');
    if (tableRows.length === 0) return;
    
    // Función de búsqueda específica para RRHH
    function performSearchHrr() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;
        
        tableRows.forEach(row => {
            // Buscar en todas las celdas de texto de la fila
            const rowText = row.textContent.toLowerCase();
            
            if (searchTerm === '' || rowText.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
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
                const tbody = document.querySelector('tbody');
                const message = document.createElement('tr');
                message.className = 'no-results-message';
                message.innerHTML = `
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        No s'han trobat resultats per "${searchTerm}"
                    </td>
                `;
                tbody.appendChild(message);
            }
        } else {
            searchResults.classList.add('hidden');
            const noResultsMsg = document.querySelector('.no-results-message');
            if (noResultsMsg) noResultsMsg.remove();
        }
    }
    
    // Event listeners para RRHH
    searchInput.addEventListener('input', performSearchHrr);
    
    if (clearSearch) {
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            performSearchHrr();
            searchInput.focus();
        });
    }
    
    // Buscar automáticamente al cargar si hay texto en la URL
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    if (searchParam) {
        searchInput.value = searchParam;
        performSearchHrr();
    }
});