// search.js - Versión super simple
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const section = document.getElementById('section');
    
    if (!searchInput || !section) return;
    
    const originalHtml = section.innerHTML;
    
    searchInput.addEventListener('input', function() {
        const term = this.value.trim().toLowerCase();
        
        if (!term) {
            section.innerHTML = originalHtml;
            return;
        }
        
        fetch('/professionals/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
            },
            body: JSON.stringify({ search: term })
        })
        .then(response => response.json())
        .then(data => {
            if (data.professionals.length > 0) {
                section.innerHTML = data.professionals.map(prof => `
                    <div class="professional-card">
                        <a href="/professionals/${prof.id}" class="items-center w-fit bg-white py-5 px-8 rounded-xl flex flex-col shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] hover:shadow-[5px_5px_20px_5px_rgba(0,0,0,0.15)] transition-shadow">
                            <img class="rounded-full w-40 m-auto aspect-square object-cover" 
                                 src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f" 
                                 alt="${prof.name}">
                            <span class="mt-5 text-lg font-medium">${prof.name} ${prof.surname}</span>
                            <span class="text-primary_color text-sm">Psícologo</span>
                        </a>
                    </div>
                `).join('');
            } else {
                section.innerHTML = '<p class="col-span-5 text-center text-gray-500 py-8">No s\'han trobat resultats</p>';
            }
        })
        .catch(() => {
            section.innerHTML = '<p class="col-span-5 text-center text-red-500 py-8">Error</p>';
        });
    });
});

window.collapseProfesionals = () => {
    document.getElementById('section')?.classList.toggle('hidden');
};