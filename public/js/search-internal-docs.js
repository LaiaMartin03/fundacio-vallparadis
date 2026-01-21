// search-internal-docs.js
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const container = document.getElementById('documents-container');
    
    if (!searchInput || !container) return;
    
    const originalHtml = container.innerHTML;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    
    searchInput.addEventListener('input', function() {
        const term = this.value.trim();
        
        if (!term) {
            container.innerHTML = originalHtml;
            return;
        }
        
        fetch('/internal-docs/search', {
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
            if (data.documents && data.documents.length > 0) {
                container.innerHTML = data.documents.map(doc => `
                    <a href="/internal-docs/${doc.id}" 
                       class="grid cursor-pointer grid-cols-5 items-center gap-4 border-t border-gray-200 p-4 transition duration-300 ease-in-out hover:bg-orange-50">
                        <div class="space-x-4">
                            <input type="checkbox" 
                                   name="document_${doc.id}" 
                                   id="document_${doc.id}" 
                                   value="${doc.id}"
                                   class="document-checkbox"
                                   data-document-id="${doc.id}" />
                            <span>${doc.title || ''}</span>
                        </div>
                        <span class="truncate text-gray-400">${doc.desc ? (doc.desc.length > 50 ? doc.desc.substring(0, 50) + '...' : doc.desc) : '-'}</span>
                        <span class="truncate text-sm">${doc.added_by ? doc.added_by.name : '-'}</span>
                        ${doc.file_extension ? 
                            `<span class="w-fit rounded-full ${doc.badge_color_classes || 'bg-gray-100 text-gray-400'} px-3 pt-1 pb-[3px] text-xs font-semibold">${doc.file_extension}</span>` :
                            '<span class="w-fit rounded-full bg-gray-100 text-gray-400 px-3 pt-1 pb-[3px] text-xs font-semibold">-</span>'
                        }
                        <span class="text-sm font-semibold text-gray-400">${new Date(doc.created_at).toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' })}</span>
                    </a>
                `).join('');
            } else {
                container.innerHTML = '<div class="text-center py-12"><p class="text-gray-500 text-lg">No s\'han trobat resultats</p></div>';
            }
        })
        .catch(() => {
            container.innerHTML = '<p class="text-center text-red-500 py-8">Error en la cerca</p>';
        });
    });
});
