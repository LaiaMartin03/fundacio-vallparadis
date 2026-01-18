// search-hr.js - Versión simplificada
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const container = document.getElementById('hr-cards-container');
    
    if (!searchInput || !container) return;
    
    const originalHtml = container.innerHTML;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    
    searchInput.addEventListener('input', function() {
        const term = this.value.trim();
        
        if (!term) {
            container.innerHTML = originalHtml;
            return;
        }
        
        fetch('/hr/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ search: term })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.hrCases && data.hrCases.length > 0) {
                container.innerHTML = data.hrCases.map(hr => `
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
            } else {
                container.innerHTML = '<p class="col-span-3 text-center text-gray-500 py-8">No s\'han trobat resultats</p>';
            }
        })
        .catch(() => {
            container.innerHTML = '<p class="col-span-3 text-center text-red-500 py-8">Error</p>';
        });
    });
});