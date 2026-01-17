// search-hr.js - VERSIÓN SIMPLIFICADA CON ID
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const searchInput = document.getElementById('search-input');
    const clearSearch = document.getElementById('clear-search');
    const searchResults = document.getElementById('search-results');
    const resultsCount = document.getElementById('results-count');
    const container = document.getElementById('hr-cards-container'); // ¡AHORA CON ID!
    
    // Si no hay buscador en esta página, salir
    if (!searchInput) {
        console.log('ℹ️ No hay buscador en esta página');
        return;
    }
    
    // Si no hay contenedor, mostrar error
    if (!container) {
        console.error('❌ No se encontró el contenedor #hr-cards-container');
        return;
    }
    
    console.log('✅ Elementos encontrados correctamente');
    
    // Variables
    const originalHtml = container.innerHTML;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    let debounceTimer;
    
    // Función para realizar la búsqueda
    async function performSearch(searchTerm) {
        // Si el término está vacío, restaurar
        if (!searchTerm.trim()) {
            restoreOriginal();
            return;
        }
        
        try {
            // Hacer la petición al servidor
            const response = await fetch('/hr/search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ search: searchTerm })
            });
            
            // Verificar respuesta
            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }
            
            // Procesar datos
            const data = await response.json();
            
            // Actualizar contador de resultados
            updateResultsCounter(data.count || 0);
            
            // Renderizar los resultados
            renderResults(data.hrCases || [], searchTerm);
            
        } catch (error) {
            console.error('Error en la búsqueda:', error);
            showError('Error al conectar con el servidor');
        }
    }
    
    // Función para renderizar resultados
    function renderResults(hrCases, searchTerm) {
        if (hrCases.length === 0) {
            container.innerHTML = `
                <div class="col-span-3 text-center py-12 bg-white rounded-xl shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                    <p class="text-gray-500 text-lg mb-2">No s'han trobat resultats per "${searchTerm}"</p>
                    <p class="text-sm text-gray-400">Prova amb un altre nom o torna a intentar-ho</p>
                </div>
            `;
            return;
        }
        
        // Generar HTML para cada caso
        container.innerHTML = hrCases.map(hr => `
            <a class="rounded-xl bg-white flex flex-col p-5 w-full shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] gap-3 hover:shadow-[5px_5px_20px_5px_rgba(0,0,0,0.15)] transition-shadow duration-300 ${hr.active == 0 ? 'opacity-60 hover:opacity-80' : ''}" 
               href="/hr/${hr.id}">
                
                <div class="flex justify-between items-start">
                    <span class="font-medium text-lg line-clamp-1">
                        ${hr.affectedProfessional?.name || 'N/A'} ${hr.affectedProfessional?.surname || ''}
                    </span>
                    <div class="flex flex-col items-end gap-1">
                        <span class="text-sm text-gray-500">#${hr.id}</span>
                    </div>
                </div>
                
                <div class="h-[1px] w-full bg-primary_color mb-2 ${hr.active == 0 ? 'opacity-50' : ''}"></div>
                
                <div class="text-gray-700 line-clamp-2 text-justify mb-4 flex-1 ${hr.active == 0 ? 'opacity-70' : ''}">
                    ${hr.description ? hr.description : '<span class="text-gray-400 italic">Sense descripció</span>'}
                </div>
                
                <div class="space-y-3 text-sm ${hr.active == 0 ? 'opacity-70' : ''}">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Assignat a:</span>
                        <span class="font-medium">${hr.assignedTo?.name || 'N/A'} ${hr.assignedTo?.surname || ''}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Derivat a:</span>
                        <span class="font-medium">${hr.derivatedTo?.name || 'N/A'} ${hr.derivatedTo?.surname || ''}</span>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center ${hr.active == 0 ? 'opacity-70' : ''}">
                    <span class="text-primary_color text-sm">
                        ${new Date(hr.created_at).toLocaleDateString('es-ES')}
                    </span>
                    
                    ${hr.attached_docs ? 
                        `<div class="flex items-center gap-1 text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="text-xs font-medium">Documents</span>
                        </div>` : 
                        `<span class="text-gray-400 text-xs">Sense documents</span>`
                    }
                </div>
            </a>
        `).join('');
    }
    
    // Función para actualizar el contador
    function updateResultsCounter(count) {
        if (searchResults && resultsCount) {
            searchResults.classList.remove('hidden');
            resultsCount.textContent = count;
        }
    }
    
    // Función para restaurar el estado original
    function restoreOriginal() {
        container.innerHTML = originalHtml;
        if (searchResults) {
            searchResults.classList.add('hidden');
        }
    }
    
    // Función para mostrar error
    function showError(message) {
        container.innerHTML = `
            <div class="col-span-3 text-center py-12 bg-red-50 border border-red-200 rounded-xl">
                <p class="text-red-600 font-medium">${message}</p>
                <p class="text-sm text-red-500 mt-2">Torna a intentar-ho en uns segons</p>
            </div>
        `;
    }
    
    // Event Listeners
    
    // Búsqueda con debounce (300ms)
    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const searchTerm = this.value.trim();
        
        debounceTimer = setTimeout(() => {
            performSearch(searchTerm);
        }, 300);
    });
    
    // Búsqueda al presionar Enter
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(debounceTimer);
            performSearch(this.value.trim());
        }
    });
    
    // Limpiar búsqueda
    if (clearSearch) {
        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            restoreOriginal();
            searchInput.focus();
        });
    }
    
    // Limpiar con tecla Escape
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            searchInput.value = '';
            restoreOriginal();
        }
    });
    
    console.log('✅ Buscador de RRHH inicializado correctamente');
});