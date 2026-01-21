<x-app-layout>
    <div class="px-20 py-10 flex flex-col gap-8">
        <!-- Header -->
        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-3">
                <h1 class="font-mclaren text-primary_color text-4xl">
                    {{ $servei->name }}
                </h1>
                <a href="{{ route('serveis.edit', $servei->id) }}" class="flex items-center">
                    <svg class="size-5 text-primary_color hover:opacity-80 transition-opacity">
                        <use href="#edit" />
                    </svg>
                </a>
            </div>
            <span class="text-gray-600 text-sm">
                Servei {{ $servei->tipus === 'general' ? 'general' : 'complementari' }}
            </span>
        </div>

        <!-- Manager Section -->
        <div class="flex flex-col gap-3">
            <label class="text-gray-700 font-medium">Encarregat:</label>
            @if($servei->user)
                <div class="py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] flex gap-5 rounded-lg w-fit h-fit">
                    <img class="rounded-full h-12 aspect-square object-cover" 
                         src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aG9tYnJlJTIwZXNwYSVDMyVCMW9sfGVufDB8fDB8fHww&fm=jpg&q=60&w=3000" 
                         alt="{{ $servei->user->name }}">
                    <div class="flex flex-col">
                        <div>{{ $servei->user->name }} {{ $servei->user->surname ?? '' }}</div>
                        <div class="text-sm text-primary_color">{{ $servei->user->position ?? 'Encarregat' }}</div>
                    </div>
                </div>
            @else
                <div class="py-4 px-6 bg-white shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] rounded-lg w-fit">
                    <p class="text-gray-500">No hi ha encarregat assignat.</p>
                </div>
            @endif
        </div>

        <!-- Tabs -->
        <div id="box-content" class="relative w-full">
            <div class="flex gap-x-5">
                <button type="button" 
                        class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40 active" 
                        data-tab="personal"
                        onclick="showTab('personal', this)">
                    Personal
                </button>
                <button type="button" 
                        class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40" 
                        data-tab="horaris"
                        onclick="showTab('horaris', this)">
                    Horaris
                </button>
                <button type="button" 
                        class="tab-button px-3 py-1 text-white rounded-t-lg bg-primary_color opacity-40" 
                        data-tab="seguiment"
                        onclick="showTab('seguiment', this)">
                    Seguiment
                </button>
            </div>

            <!-- Tab Content Container -->
            <div class="bg-white rounded-xl p-6 shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] min-h-[400px]">
                <!-- Personal Tab -->
                <div id="tab-personal" class="tab-content">
                    <p class="text-gray-500">Contingut de Personal</p>
                </div>

                <!-- Horaris Tab -->
                <div id="tab-horaris" class="tab-content hidden">
                    <p class="text-gray-500">Contingut de Horaris</p>
                </div>

                <!-- Seguiment Tab -->
                <div id="tab-seguiment" class="tab-content hidden">
                    <p class="text-gray-500">Contingut de Seguiment</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName, button) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Show selected tab content
            const selectedTab = document.getElementById('tab-' + tabName);
            if (selectedTab) {
                selectedTab.classList.remove('hidden');
            }

            // Update button styles
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active', 'bg-white', 'text-primary_color', 'shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]');
                btn.classList.add('opacity-40', 'bg-primary_color', 'text-white');
            });

            // Apply active style to clicked button
            button.classList.add('active', 'bg-white', 'text-primary_color', 'shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]');
            button.classList.remove('opacity-40', 'bg-primary_color', 'text-white');
        }

        // Initialize with Personal tab active
        document.addEventListener('DOMContentLoaded', function() {
            const activeButton = document.querySelector('.tab-button.active');
            if (activeButton) {
                showTab('personal', activeButton);
            }
        });
    </script>
</x-app-layout>
