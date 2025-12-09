<x-app-layout>  
    <div class="px-20 py-10">
        <div id="header" class="flex justify-between items-center mb-8">
            <h1 class="font-mclaren text-primary_color text-4xl">Contactes externs</h1>
        </div>

        <div class="flex gap-5 w-full h-[650px]">
            <div class="flex flex-col gap-12 w-full">
                <div>
                    <x-toggle slot1="Serveis generals" slot2="Assistencials"/>
                </div>

                @if($outsiders->isEmpty())
                    <p>Ni hi han contactes registrats.</p>
                @else
                    <div class="w-full grid grid-cols-6" id="grid">
                        @foreach($outsiders as $outsider)
                            <div class="rounded-xl bg-white flex flex-col p-5 w-fit shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] outsider-card"
                                data-fullname="{{ $outsider->fullname }}"
                                data-email="{{ $outsider->email }}"
                                data-phone="{{ $outsider->phone }}"
                                data-task="{{ $outsider->task }}"
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

                            <div class="rounded-xl bg-white flex flex-col p-5 w-fit shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] outsider-card"
                                data-fullname="{{ $outsider->fullname }}"
                                data-email="{{ $outsider->email }}"
                                data-phone="{{ $outsider->phone }}"
                                data-task="{{ $outsider->task }}"
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

                            <div class="rounded-xl bg-white flex flex-col p-5 w-fit shadow-[5px_5px_15px_2px_rgba(0,0,0,0.12)] outsider-card"
                                data-fullname="{{ $outsider->fullname }}"
                                data-email="{{ $outsider->email }}"
                                data-phone="{{ $outsider->phone }}"
                                data-task="{{ $outsider->task }}"
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
                    <button>
                        <svg class="size-5 text-primary_color">
                            <use href="#edit" />
                        </svg>
                    </button>
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
</x-app-layout>
