// search-professional.js - VERSIÓN DEFINITIVA

document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ search-professional.js cargado');
    
    // ============================================
    // 1. ELEMENTOS DEL DOM
    // ============================================
    const searchInput = document.getElementById('search-input');
    const clearBtn = document.getElementById('clear-search');
    const searchResults = document.getElementById('search-results');
    const resultsCount = document.getElementById('results-count');
    const noResults = document.getElementById('no-results');
    const container = document.getElementById('professionals-container');
    
    // Si no hay elementos necesarios, salir
    if (!searchInput || !container) {
        console.log('ℹ️ Elementos necesarios no encontrados');
        return;
    }
    
    // Guardar HTML original del contenedor
    const originalHTML = container.innerHTML;
    
    // ============================================
    // 2. FUNCIONES DE COLAPSO
    // ============================================
    
    function toggleSection(profession) {
        const section = document.getElementById('section-' + profession);
        const arrow = document.querySelector(`.section-arrow[data-profession="${profession}"]`);
        
        if (section && arrow) {
            const isHidden = section.classList.toggle('hidden');
            arrow.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(180deg)';
        }
    }
    
    // Delegación de eventos para botones de colapso
    document.addEventListener('click', function(e) {
        if (e.target.closest('.section-btn')) {
            const btn = e.target.closest('.section-btn');
            const profession = btn.getAttribute('data-profession');
            if (profession) {
                e.preventDefault();
                toggleSection(profession);
            }
        }
    });
    
    // ============================================
    // 3. FUNCIONES DE BÚSQUEDA
    // ============================================
    
    let searchTimeout;
    let currentSearch = '';
    let isSearching = false;
    
    async function performSearch(term) {
        term = term.trim();
        
        // Si ya estamos buscando, salir
        if (isSearching) return;
        
        // Si el término está vacío, restaurar vista original
        if (!term) {
            restoreOriginalView();
            return;
        }
        
        // Si es el mismo término, no hacer nada
        if (currentSearch === term) return;
        
        currentSearch = term;
        isSearching = true;
        
        try {
            // Mostrar "cargando"
            if (searchResults) {
                searchResults.classList.remove('hidden');
                resultsCount.textContent = 'Carregant...';
            }
            if (noResults) noResults.classList.add('hidden');
            
            // Obtener CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
            
            // Hacer petición
            const response = await fetch('/professionals/search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ search: term })
            });
            
            // Verificar respuesta
            if (!response.ok) {
                const errorText = await response.text();
                throw new Error(`Error ${response.status}: ${errorText}`);
            }
            
            const data = await response.json();
            
            // Verificar datos
            if (!data.success) {
                throw new Error(data.message || 'Error en la respuesta del servidor');
            }
            
            // Procesar resultados
            displaySearchResults(data);
            
        } catch (error) {
            console.error('❌ Error en búsqueda:', error);
            displayError();
        } finally {
            isSearching = false;
        }
    }
    
    function restoreOriginalView() {
        currentSearch = '';
        
        // Restaurar HTML original
        container.innerHTML = originalHTML;
        
        // Ocultar indicadores de búsqueda
        if (searchResults) searchResults.classList.add('hidden');
        if (noResults) noResults.classList.add('hidden');
        
        // Re-inicializar flechas
        setTimeout(() => {
            document.querySelectorAll('.section-arrow').forEach(arrow => {
                arrow.style.transform = 'rotate(180deg)';
            });
        }, 100);
        
        console.log('✅ Vista original restaurada');
    }
    
    function displaySearchResults(data) {
        // Actualizar contador
        if (searchResults && resultsCount) {
            resultsCount.textContent = data.total;
        }
        
        // Si no hay resultados
        if (data.total === 0) {
            container.innerHTML = `
                <div class="text-center text-gray-500 py-12">
                    <div class="text-4xl mb-4">🔍</div>
                    <p class="text-xl font-medium mb-2">No s'han trobat resultats</p>
                    <p class="text-gray-600">Prova amb un altre nom o professió</p>
                </div>
            `;
            return;
        }
        
        // Construir HTML con resultados
        let html = '';
        const grouped = data.grouped || {};
        
        Object.entries(grouped).forEach(([profession, professionals]) => {
            html += `
                <div class="profession-section flex flex-col gap-5" data-profession="${profession.toLowerCase()}">
                    <button class="section-btn flex gap-4 items-center group" data-profession="${profession}">
                        <svg class="w-6 h-6 text-primary_color transition-transform duration-300 section-arrow" 
                             data-profession="${profession}" 
                             viewBox="0 0 20 20" 
                             fill="currentColor"
                             style="transform: rotate(180deg)">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-2xl text-primary_color font-mclaren group-hover:text-primary_color/80 transition-colors">
                            ${profession}s
                        </span>
                        <div class="h-[1px] bg-primary_color w-full group-hover:bg-primary_color/80 transition-colors"></div>
                    </button>

                    <div class="section-content grid grid-rows-auto grid-cols-5 gap-16 transition-all duration-300 ease-in-out" id="section-${profession}">
                        ${professionals.map(pro => `
                            <div class="professional-card" data-name="${pro.full_name.toLowerCase()}" data-profession="${pro.profession.toLowerCase()}">
                                <a class="items-center w-fit bg-white py-5 px-8 rounded-xl flex flex-col shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] hover:shadow-[5px_5px_20px_5px_rgba(0,0,0,0.15)] transition-shadow" 
                                   href="${pro.show_url}">
                                    <img class="rounded-full w-40 m-auto aspect-square object-cover" 
                                         src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                         alt="${pro.name}">
                                    <span class="mt-5 text-lg font-medium">${pro.name} ${pro.surname}</span>
                                    <span class="text-primary_color text-sm">${pro.profession}</span>
                                </a>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        });
        
        // Actualizar contenido
        container.innerHTML = html;
        
        console.log('✅ Resultados mostrados:', data.total, 'profesionales');
    }
    
    function displayError() {
        container.innerHTML = `
            <div class="text-center text-gray-500 py-12">
                <div class="text-4xl mb-4">⚠️</div>
                <p class="text-xl font-medium mb-2">Error en la cerca</p>
                <p class="text-gray-600">Si us plau, intenta-ho de nou</p>
            </div>
        `;
        
        if (searchResults) searchResults.classList.add('hidden');
        if (noResults) noResults.classList.add('hidden');
    }
    
    // ============================================
    // 4. EVENT LISTENERS
    // ============================================
    
    // Búsqueda en tiempo real con debounce
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const term = this.value.trim();
            clearTimeout(searchTimeout);
            
            if (term === '') {
                restoreOriginalView();
                return;
            }
            
            searchTimeout = setTimeout(() => {
                performSearch(term);
            }, 300);
        });
        
        // Buscar con Enter (sin debounce)
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                clearTimeout(searchTimeout);
                performSearch(this.value.trim());
            }
        });
    }
    
    // Botón para limpiar búsqueda
    if (clearBtn) {
        clearBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (searchInput) {
                searchInput.value = '';
                restoreOriginalView();
                searchInput.focus();
            }
        });
    }
    
    // ============================================
    // 5. INICIALIZACIÓN
    // ============================================
    
    // Inicializar flechas
    setTimeout(() => {
        document.querySelectorAll('.section-arrow').forEach(arrow => {
            arrow.style.transform = 'rotate(180deg)';
        });
    }, 100);
    
    console.log('✅ Sistema de búsqueda inicializado correctamente');
});