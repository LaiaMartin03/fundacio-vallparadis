<x-app-layout>  
    <div class="px-20 py-10">
        <div id="header" class="flex justify-between items-center mb-8">
            <h1 class="font-mclaren text-primary_color text-4xl">Contactes externs</h1>
        </div>

        <div class="flex gap-5 w-full h-[650px]">
            <div class="flex flex-col gap-12 w-full">

                
                <div class="flex items-center gap-4">
                    <x-buscador label="Cercar contactes" placeholder="Escriu el nom, email o tasca..." />
                    <x-toggle slot1="Serveis generals" slot2="Assistencials"/>
                </div>

                @if($outsiders->isEmpty())
                    <p>Ni hi han contactes registrats.</p>
                @else
                    <div class="grid grid-cols-6 gap-6" id="outsiders-grid">
                        @foreach($outsiders as $outsider)
                            <div class="rounded-xl bg-white flex flex-col p-5 w-fit shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] outsider-card"
                                data-id="{{ $outsider->id }}"
                                data-fullname="{{ $outsider->fullname }}"
                                data-email="{{ $outsider->email }}"
                                data-phone="{{ $outsider->phone }}"
                                data-task="{{ $outsider->task }}"
                                data-service="{{ $outsider->service }}"
                                data-description="{{ $outsider->description }}">
                                
                                <div class="mb-3 gap-20 justify-between flex items-center">
                                    <span class="font-medium text-lg">{{ $outsider->fullname }}</span>
                                    <button class="group outsider-button">
                                        <svg class="size-5 text-gray-300 group-hover:text-primary_color transition duration-300 ease-in-out">
                                            <use href="#new-tab" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="flex gap-2 items-center">
                                    <svg class="size-4 text-gray-400">
                                        <use href="#email" />
                                    </svg>
                                    <span>{{ $outsider->email }}</span>
                                </div>

                                <div class="flex gap-2 items-center">
                                    <svg class="size-4 text-gray-400">
                                        <use href="#tlf" />
                                    </svg>
                                    <span>{{ $outsider->phone }}</span>
                                </div>

                                <span class="text-sm text-primary_color text-right mt-2">{{ $outsider->task }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="bg-white rounded-xl p-4 flex flex-col gap-4 h-full hidden" id="outsider-info">
                <div class="flex w-full justify-between">
                    <span class="font-medium text-xl" id="fullname"></span>
                    <a id="edit-link" href="#" data-base="{{ route('outsiders.edit') }}">
                        <svg class="size-5 text-primary_color">
                            <use href="#edit" />
                        </svg>
                    </a>
                </div>
                <div class="flex flex-col">
                    <span id="mail"></span>
                    <span id="phone"></span>
                </div>

                <span class="text-primary_color" id="task"></span>

                <div class="mt-4 h-full overflow-y-auto">
                    <span class="text-sm text-gray_color text-right">Observacions:</span>
                    <p class="text-justify text-charcoal_color w-[250px]" id="description"></p>
                </div>
            </div>
        </div>
    </div>

    <x-add-button href="{{ route('outsiders.create') }}"></x-add-button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const grid = document.getElementById('outsiders-grid');
            const toggle = document.getElementById('toggle');
            
            if (!grid) return;
            
            const cards = Array.from(grid.querySelectorAll('.outsider-card'));
            let currentTaskFilter = null; // null = show all, no filter applied initially
            
            // Map toggle values to task values
            const taskMap = {
                'Serveis generals': 'General',
                'Assistencials': 'Assistencial'
            };
            
            // Filter function that combines search and task filter
            function applyFilters() {
                const searchTerm = searchInput ? searchInput.value.trim().toLowerCase() : '';
                const taskValue = currentTaskFilter ? taskMap[currentTaskFilter] : null;
                
                cards.forEach(card => {
                    const cardTask = (card.dataset.task || '').toLowerCase();
                    const fullname = card.dataset.fullname?.toLowerCase() || '';
                    const email = card.dataset.email?.toLowerCase() || '';
                    const phone = card.dataset.phone?.toLowerCase() || '';
                    const task = card.dataset.task?.toLowerCase() || '';
                    const description = card.dataset.description?.toLowerCase() || '';
                    
                    // Check task filter (if taskValue is null, show all)
                    // Match exact task value
                    const taskMatch = !taskValue || cardTask === taskValue.toLowerCase();
                    
                    // Check search filter
                    const searchMatch = !searchTerm || 
                                       fullname.includes(searchTerm) || 
                                       email.includes(searchTerm) || 
                                       phone.includes(searchTerm) || 
                                       task.includes(searchTerm) || 
                                       description.includes(searchTerm);
                    
                    // Show card only if both filters match
                    card.style.display = (taskMatch && searchMatch) ? '' : 'none';
                });
            }
            
            // Search input listener
            if (searchInput) {
                searchInput.addEventListener('input', applyFilters);
            }
            
            // Toggle filter listener
            if (toggle) {
                // Only apply task filter when user actually clicks the toggle
                // Don't apply initial filter - show all items by default
                toggle.addEventListener('toggleChange', function(event) {
                    currentTaskFilter = event.detail.value;
                    applyFilters();
                });
            }
            
            // Show all items initially - no filters applied
        });
    </script>
</x-app-layout>
