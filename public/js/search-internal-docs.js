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
                    <a class="bg-white shadow-lg rounded-lg p-4 mb-4 hover:bg-gray-100 flex justify-between items-center" 
                       href="/internal-docs/${doc.id}">
                        <div class="flex gap-10 items-center">
                            <span class="font-medium text-lg">${doc.display_filename || doc.title}</span>
                            ${doc.desc ? `<span class="text-gray-700">${doc.desc.substring(0, 100)}${doc.desc.length > 100 ? '...' : ''}</span>` : ''}
                            ${doc.type ? `<span class="text-blue-600 bg-blue-100 px-3 py-1 rounded-full text-sm">${doc.type}</span>` : ''}
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-500">
                                ${new Date(doc.created_at).toLocaleDateString('es-ES')}
                            </span>
                            ${doc.file_path ? `
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            ` : ''}
                        </div>
                    </a>
                `).join('');
            } else {
                container.innerHTML = '<p class="text-center text-gray-500 py-8">No s\'han trobat resultats</p>';
            }
        })
        .catch(() => {
            container.innerHTML = '<p class="text-center text-red-500 py-8">Error en la cerca</p>';
        });
    });
});
