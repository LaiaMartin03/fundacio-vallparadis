<x-app-layout>
    <div class="px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center mb-12">
            <h1 class="font-mclaren text-primary_color text-4xl">Documentació interna</h1>
        </div>

        <!-- Buscador -->
        <div id="filters" class="mb-8">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label for="search-input" class="block text-sm font-medium text-gray-700 mb-2">
                        Cercar documents
                    </label>
                    <input type="text" id="search-input" placeholder="Escriu el títol, descripció o tipus..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent">
                </div>
                <button id="clear-search" class="mt-6 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Netejar
                </button>
            </div>
            <div id="search-results" class="text-sm text-gray-500 mt-2 hidden">
                S'estan mostrant <span id="results-count">0</span> resultats
            </div>
        </div>

        <!-- Upload block section -->
        <div class="bg-white shadow-lg rounded-lg mb-8 overflow-hidden">
            <button 
                id="toggle-upload-form"
                class="w-full flex justify-between items-center p-6 hover:bg-gray-50 transition-colors cursor-pointer rounded-t-lg"
                type="button">
                <h2 class="font-mclaren text-primary_color text-2xl">Pujar nou document</h2>
                <svg id="toggle-upload-icon" class="w-6 h-6 text-primary_color transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="upload-form-container" 
                 style="display: none;"
                 class="px-6 pb-6 rounded-b-lg">
                <form action="{{ route('internal-docs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Títol <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent"
                            value="{{ old('title') }}">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipus (opcional)
                        </label>
                        <input type="text" id="type" name="type"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent"
                            placeholder="Ex: Manual, Política, Procediment..."
                            value="{{ old('type') }}">
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="desc" class="block text-sm font-medium text-gray-700 mb-2">
                        Descripció (opcional)
                    </label>
                    <textarea id="desc" name="desc" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent"
                        placeholder="Descripció del document...">{{ old('desc') }}</textarea>
                    @error('desc')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        Fitxer <span class="text-red-500">*</span>
                    </label>
                    <input type="file" id="file" name="file" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary_color focus:border-transparent"
                        accept=".pdf,.doc,.docx,.txt,.xls,.xlsx">
                    <p class="text-sm text-gray-500 mt-1">Màxim 10MB. Formats: PDF, DOC, DOCX, TXT, XLS, XLSX</p>
                    @error('file')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button type="submit">
                        Pujar document
                    </x-primary-button>
                </div>
                </form>
            </div>
        </div>

        <!-- Documents list -->
        @if($documents->isEmpty())
            <div class="text-center py-12 bg-white rounded-xl shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)]">
                <p class="text-gray-500 text-lg mb-4">No hi ha documents registrats.</p>
            </div>
        @else
            <div id="documents-container">
                @foreach($documents as $document)
                    <a href="{{ route('internal-docs.show', $document->id) }}" 
                       class="bg-white shadow-lg rounded-lg p-4 mb-4 hover:bg-gray-100 flex justify-between items-center transition-colors">
                        <div class="flex gap-10 items-center">
                            <span class="font-medium text-lg">{{ $document->display_filename }}</span>
                            @if($document->desc)
                                <span class="text-gray-700">{{ Str::limit($document->desc, 100) }}</span>
                            @endif
                            @if($document->type)
                                <span class="text-blue-600 bg-blue-100 px-3 py-1 rounded-full text-sm">{{ $document->type }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-500">
                                {{ $document->created_at->format('d/m/Y') }}
                            </span>
                            @if($document->file_path)
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <script src="{{ asset('js/search-internal-docs.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggle-upload-form');
            const formContainer = document.getElementById('upload-form-container');
            const toggleIcon = document.getElementById('toggle-upload-icon');
            
            if (toggleButton && formContainer && toggleIcon) {
                toggleButton.addEventListener('click', function() {
                    const isHidden = formContainer.style.display === 'none';
                    formContainer.style.display = isHidden ? 'block' : 'none';
                    toggleIcon.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
                });
            }
        });
    </script>
</x-app-layout>
