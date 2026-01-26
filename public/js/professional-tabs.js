document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('tab-container');
    const buttons = Array.from(document.querySelectorAll('.tab-button'));
    
    if (!container || !buttons.length) return;

    async function loadPartial(url, btn) {
        container.innerHTML = '<div class="flex justify-center items-center h-32"><p>Carregant...</p></div>';
        
        try {
            const res = await fetch(url, { 
                credentials: 'same-origin', 
                headers: { 'X-Requested-With': 'XMLHttpRequest' } 
            });
            
            if (!res.ok) throw new Error('Error en la respuesta');
            
            const content = await res.text();
            container.innerHTML = content;
            
            // Actualizar estado visual de todos los botones
            buttons.forEach(b => {
                b.classList.remove('active', 'bg-white', 'text-primary_color', 'shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]');
                b.classList.add('opacity-40', 'bg-primary_color', 'text-white');
            });
            
            // Aplicar estilo al botón activo
            btn.classList.add('active', 'bg-white', 'text-primary_color', 'shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]');
            btn.classList.remove('opacity-40', 'bg-primary_color', 'text-white');
            
        } catch (error) {
            console.error('Error cargando el contenido:', error);
            container.innerHTML = '<div class="text-red-500 text-center p-4">Error carregant el contingut</div>';
        }
    }

    // Agregar event listeners a los botones
    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const url = btn.dataset.url;
            if (url) {
                loadPartial(url, btn);
            }
        });
    });

    // Carga inicial del contenido
    const activeBtn = buttons.find(b => b.classList.contains('active')) || buttons[0];
    if (activeBtn && activeBtn.dataset.url) {
        loadPartial(activeBtn.dataset.url, activeBtn);
    }
});

// Funciones para modales
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Cerrar modal al hacer clic fuera
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('bg-gray-600')) {
        event.target.classList.add('hidden');
    }
});