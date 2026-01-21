<x-app-layout :breadcrumbs="$breadcrumbs">
    <div class="px-20 py-10 space-y-4">
        <div id="header" class="flex justify-between items-center mb-12">
            <h1 class="font-mclaren text-primary_color text-4xl">Pujar nou document</h1>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="px-6 pb-6 pt-6">
                <form action="{{ route('internal-docs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
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

                    <div class="flex justify-end mt-4 gap-4">
                        <a href="{{ route('internal-docs.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancel·lar
                        </a>
                        <x-primary-button type="submit">
                            Pujar document
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
