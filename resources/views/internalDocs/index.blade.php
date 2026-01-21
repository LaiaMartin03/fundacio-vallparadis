<x-app-layout>
    <div class="px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center mb-12">
            <h1 class="font-mclaren text-primary_color text-4xl">Documentació interna</h1>
            
        </div>

        <div class="flex items-center gap-4 pb-12">
            <x-buscador 
            label="Cercar documents" 
            placeholder="Escriu el títol, descripció o tipus..." 
            />

            <button id="download-selected-btn" 
                    class="hidden px-4 py-2 bg-primary_color text-white rounded-lg hover:bg-opacity-90 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled>
                Descarregar seleccionats
            </button>
        </div>

        <!-- Documents list -->
        <div class="h-full w-full rounded-xl bg-white">
            <div class="grid w-full grid-cols-5 items-center gap-4 p-4 pb-2 text-xs font-semibold text-gray-400">
                <div class="space-x-4">
                    <input type="checkbox" name="all" id="select-all" class="select-all-checkbox" />
                    <span>Nom</span>
                </div>
                <span>Descripció</span>
                <span>Responsable</span>
                <span>Tipus</span>
                <span>Data</span>
            </div>
            <div class="flex flex-col" id="documents-container">
                @if($documents->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg mb-4">No hi ha documents registrats.</p>
                    </div>
                @else
                    @foreach($documents as $document)
                        <a href="{{ route('internal-docs.show', $document->id) }}" 
                           class="grid cursor-pointer grid-cols-5 items-center gap-4 border-t border-gray-200 p-4 transition duration-300 ease-in-out hover:bg-orange-50">
                            <div class="space-x-4">
                                <input type="checkbox" 
                                       name="document_{{ $document->id }}" 
                                       id="document_{{ $document->id }}" 
                                       value="{{ $document->id }}"
                                       class="document-checkbox"
                                       data-document-id="{{ $document->id }}" />
                                <span>{{ $document->title }}</span>
                            </div>
                            <span class="truncate text-gray-400">{{ $document->desc ? Str::limit($document->desc, 50) : '-' }}</span>
                            <span class="truncate text-sm">{{ $document->addedBy ? $document->addedBy->name : '-' }}</span>
                            @if($document->file_extension)
                                <span class="w-fit rounded-full {{ $document->badge_color_classes }} px-3 pt-1 pb-[3px] text-xs font-semibold">{{ $document->file_extension }}</span>
                            @else
                                <span class="w-fit rounded-full bg-gray-100 text-gray-400 px-3 pt-1 pb-[3px] text-xs font-semibold">-</span>
                            @endif
                            <span class="text-sm font-semibold text-gray-400">{{ $document->created_at->format('d/m/Y') }}</span>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <x-add-button href="{{ route('internal-docs.create') }}"></x-add-button>

    <script src="{{ asset('js/search-internal-docs.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const downloadBtn = document.getElementById('download-selected-btn');
            const container = document.getElementById('documents-container');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            // Function to update download button state
            function updateDownloadButton() {
                const checkedBoxes = container.querySelectorAll('.document-checkbox:checked');
                if (checkedBoxes.length > 0) {
                    downloadBtn.classList.remove('hidden');
                    downloadBtn.disabled = false;
                    downloadBtn.textContent = `Descarregar seleccionats (${checkedBoxes.length})`;
                } else {
                    downloadBtn.classList.add('hidden');
                    downloadBtn.disabled = true;
                }
            }
            
            // Select all functionality
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const checkboxes = container.querySelectorAll('.document-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateDownloadButton();
                });
            }
            
            // Prevent checkbox clicks from triggering link navigation
            container.addEventListener('click', function(e) {
                const checkbox = e.target.closest('.document-checkbox');
                if (checkbox) {
                    e.stopPropagation();
                }
            });
            
            // Individual checkbox change
            container.addEventListener('change', function(e) {
                if (e.target.classList.contains('document-checkbox')) {
                    updateSelectAllState();
                    updateDownloadButton();
                }
            });
            
            // Update select all checkbox state
            function updateSelectAllState() {
                if (!selectAllCheckbox) return;
                const checkboxes = container.querySelectorAll('.document-checkbox');
                const checkedBoxes = container.querySelectorAll('.document-checkbox:checked');
                selectAllCheckbox.checked = checkboxes.length > 0 && checkboxes.length === checkedBoxes.length;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
            }
            
            // Download selected documents
            downloadBtn.addEventListener('click', function() {
                const checkedBoxes = container.querySelectorAll('.document-checkbox:checked');
                const documentIds = Array.from(checkedBoxes).map(cb => cb.value);
                
                if (documentIds.length === 0) {
                    return;
                }
                
                // Disable button during download
                downloadBtn.disabled = true;
                downloadBtn.textContent = 'Descarregant...';
                
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("internal-docs.bulk-download") }}';
                
                // Add CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);
                
                // Add document IDs
                documentIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'document_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });
                
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
                
                // Re-enable button after a delay
                setTimeout(() => {
                    downloadBtn.disabled = false;
                    updateDownloadButton();
                }, 2000);
            });
            
            // Initial state
            updateDownloadButton();
        });
    </script>
</x-app-layout>
