<x-app-layout>  
    <div class="px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center mb-12">
            <h1 class="font-mclaren text-primary_color text-4xl">Projectes</h1>
        </div>

        <div class="flex items-center gap-4 pb-12">
            <x-buscador 
                label="Cercar projectes" 
                placeholder="Escriu el nom o descripció..." 
            />

            <x-toggle slot1="Projectes" slot2="Comissions"/>
        </div>

        @if($projects->isEmpty())
            <p>Ni hi han projectes registrats.</p>
        @else
            <div id="projects-container">
                @foreach($projects as $project)
                    <a href="{{ route('project.show', $project->id) }}" 
                       class="bg-white shadow-lg rounded-lg p-4 mb-4 hover:bg-gray-100 flex justify-between items-center project-item"
                       data-project-type="{{ $project->type === 'project' ? 'Projecte' : 'Comissió' }}">
                    <div class="flex gap-10">
                        <span>{{ $project->name }}</span>
                        <span class="text-gray-700">{{ $project->description }}</span>
                    </div>

                    <div>
                        <span class="text-orange-500">{{ $project->type === 'project' ? 'Projecte' : 'Comissió' }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('search-input');
                const container = document.getElementById('projects-container');
                const toggle = document.getElementById('toggle');
                
                if (!container) return;
                
                const items = Array.from(container.querySelectorAll('.project-item'));
                let currentFilter = 'Projectes'; // Default filter
                
                // Filter function that combines search and type filter
                function applyFilters() {
                    const searchTerm = searchInput ? searchInput.value.trim().toLowerCase() : '';
                    
                    items.forEach(item => {
                        const projectType = item.dataset.projectType || '';
                        const text = item.textContent.toLowerCase();
                        
                        // Check type filter
                        const typeMatch = currentFilter === 'Projectes' 
                            ? projectType === 'Projecte' 
                            : projectType === 'Comissió';
                        
                        // Check search filter
                        const searchMatch = !searchTerm || text.includes(searchTerm);
                        
                        // Show item only if both filters match
                        item.style.display = (typeMatch && searchMatch) ? '' : 'none';
                    });
                }
                
                // Search input listener
                if (searchInput) {
                    searchInput.addEventListener('input', applyFilters);
                }
                
                // Toggle filter listener
                if (toggle) {
                    toggle.addEventListener('toggleChange', function(event) {
                        currentFilter = event.detail.value;
                        applyFilters();
                    });
                }
                
                // Apply initial filter
                applyFilters();
            });
        </script>
    </div>

    <x-add-button href="{{ route('project.create') }}"></x-add-button>
</x-app-layout>
