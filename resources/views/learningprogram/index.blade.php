<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cursos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-4">Learning Programs</h1>
                    
                    <x-buscador 
                        label="Cercar cursos" 
                        placeholder="Escriu per cercar..." 
                    />
                    
                    <table class="min-w-full bg-white" id="learningprogram-table">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">ID</th>
                                <th class="py-2 px-4 border-b">
                                    type
                                </th>
                                <th class="py-2 px-4 border-b">assistent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cursos as $curso)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $curso->id }}</td>
                                    <td class="py-2 px-4 border-b">{{ $curso->type }}</td>
                                    <td class="py-2 px-4 border-b">{{ $curso->assistent }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const searchInput = document.getElementById('search-input');
                            const table = document.getElementById('learningprogram-table');
                            
                            if (!searchInput || !table) return;
                            
                            const rows = Array.from(table.querySelectorAll('tbody tr'));
                            
                            searchInput.addEventListener('input', function() {
                                const term = this.value.trim().toLowerCase();
                                
                                rows.forEach(row => {
                                    const text = row.textContent.toLowerCase();
                                    row.style.display = text.includes(term) ? '' : 'none';
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
