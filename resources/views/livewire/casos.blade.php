<div class="m-auto">
    <!-- component -->
    <section class="px-4 my-auto">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Casos Jurídicos</h2>

                    <span
                        class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{ count($cases) }}
                        casos</span>
                </div>

                {{-- <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">These companies have purchased in the last 12
                    months.</p> --}}
            </div>

            <div class="flex items-center mt-4 gap-x-3">
                <a href="{{ route('generate.report.casos') }}">
                    <button
                        class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2 sm:w-auto dark:hover:bg-gray-800 dark:bg-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:border-gray-700">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_3098_154395)">
                                <path
                                    d="M13.3333 13.3332L9.99997 9.9999M9.99997 9.9999L6.66663 13.3332M9.99997 9.9999V17.4999M16.9916 15.3249C17.8044 14.8818 18.4465 14.1806 18.8165 13.3321C19.1866 12.4835 19.2635 11.5359 19.0351 10.6388C18.8068 9.7417 18.2862 8.94616 17.5555 8.37778C16.8248 7.80939 15.9257 7.50052 15 7.4999H13.95C13.6977 6.52427 13.2276 5.61852 12.5749 4.85073C11.9222 4.08295 11.104 3.47311 10.1817 3.06708C9.25943 2.66104 8.25709 2.46937 7.25006 2.50647C6.24304 2.54358 5.25752 2.80849 4.36761 3.28129C3.47771 3.7541 2.70656 4.42249 2.11215 5.23622C1.51774 6.04996 1.11554 6.98785 0.935783 7.9794C0.756025 8.97095 0.803388 9.99035 1.07431 10.961C1.34523 11.9316 1.83267 12.8281 2.49997 13.5832"
                                    stroke="currentColor" stroke-width="1.67" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_3098_154395">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>

                        <span>Reporte</span>
                    </button>
                </a>
                <button wire:click="open_modal_add()"
                    class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span>Añadir caso</span>
                </button>
            </div>
        </div>

        <div class="mt-6 md:flex md:items-center md:justify-between">
            <div
                class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
                <button wire:click="select_cases('All')"
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 bg-gray-100 sm:text-sm dark:bg-gray-800 dark:text-gray-300">
                    Ver Todos
                </button>

                <button wire:click="select_cases('Successful')"
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">Posibles
                    casos exitosos
                </button>

                <button wire:click="select_cases('Lost')"
                    class="px-5 py-2 text-xs font-medium text-gray-600 transition-colors duration-200 sm:text-sm dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">Posibles
                    casos fallidos
                </button>
            </div>

            <div class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <x-jet-input wire:model="search" type="text" placeholder="Buscar..."
                    class="block max-w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" />
            </div>

            {{-- <div class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <x-jet-input wire:model="search" type="text" placeholder="Buscar..."
                    class="block max-w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40" />
            </div> --}}
        </div>

        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <button class="flex items-center gap-x-3 focus:outline-none">
                                            <span>Caso</span>

                                            <svg class="h-3" viewBox="0 0 10 11" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z"
                                                    fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path
                                                    d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z"
                                                    fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                                <path
                                                    d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z"
                                                    fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                            </svg>
                                        </button>
                                    </th>

                                    <th scope="col"
                                        class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Fecha Inicio
                                    </th>

                                    <th scope="col"
                                        class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Fecha Finalización
                                    </th>

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Requerimientos
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Involucrados
                                    </th>


                                    {{-- <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Users</th> --}}

                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Probabilidad de Éxito</th>

                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                                @foreach ($cases as $case)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium">
                                            <div>
                                                <h2 class="font-medium text-gray-800 dark:text-white">
                                                    {{ $case->nombre }}</h2>
                                                <p class="text-xs font-normal italic text-gray-600 dark:text-gray-400">
                                                    {{ $case->descripcion }}</p>
                                            </div>
                                        </td>
                                        <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                            <div
                                                class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                {{ $case->fecha_inicio }}
                                            </div>


                                        </td>
                                        <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                            @if ($case->fecha_finalizacion != null)
                                                <div
                                                    class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                    {{ $case->fecha_finalizacion }}
                                                </div>
                                            @else
                                                <div
                                                    class="inline px-3 py-1 text-sm font-normal rounded-full text-gray-500 gap-x-2 bg-gray-100/60 dark:bg-gray-800">
                                                    En proceso
                                                </div>
                                            @endif

                                        </td>
                                        <td class="px-4 py-4 text-sm">
                                            <div>
                                                <p class=" text-gray-700 dark:text-gray-200">
                                                    {{ $case->requerimientos }}
                                                </p>

                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm">
                                            <div>
                                                <p class="text-gray-500 dark:text-gray-400">
                                                    <strong>Demandante:</strong>
                                                    {{ $case->demandante }}
                                                </p>

                                                <p class=" text-gray-500 dark:text-gray-400">
                                                    <strong>Demandado:</strong>
                                                    {{ $case->demandado }}
                                                </p>
                                                <p class=" text-gray-500 dark:text-gray-400"><strong>Juez:</strong>
                                                    {{ $case->juez }}
                                                </p>
                                            </div>
                                        </td>

                                        {{-- <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="object-cover w-6 h-6 -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80"
                                                alt="">
                                            <img class="object-cover w-6 h-6 -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0"
                                                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80"
                                                alt="">
                                            <img class="object-cover w-6 h-6 -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0"
                                                src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1256&q=80"
                                                alt="">
                                            <img class="object-cover w-6 h-6 -mx-1 border-2 border-white rounded-full dark:border-gray-700 shrink-0"
                                                src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=256&q=80"
                                                alt="">
                                            <p
                                                class="flex items-center justify-center w-6 h-6 -mx-1 text-xs text-blue-600 bg-blue-100 border-2 border-white rounded-full">
                                                +4</p>
                                        </div>
                                    </td> --}}
                                        @if ($updated_cases->where('caso_id', $case->id)->last() != null)
                                            <td class="px-4 py-4 text-sm whitespace-nowrap">

                                                <div style="width: 120px"
                                                    class="h-1.5 bg-blue-200 overflow-hidden rounded-full">
                                                    <div style="width: {{ $updated_cases->where('caso_id', $case->id)->last()->estado }}%"
                                                        class="bg-blue-500 h-1.5"></div>
                                                </div>
                                            </td>
                                        @else
                                            <td class="px-4 py-4 text-sm whitespace-nowrap">

                                                <div
                                                    class="inline px-3 py-1 text-sm font-normal rounded-full text-gray-500 gap-x-2 bg-gray-100/60 dark:bg-gray-800">
                                                    Sin Seguimiento
                                                </div>
                                            </td>
                                        @endif



                                        <td class="px-4 py-4 text-sm whitespace-nowrap flex">
                                            <a href="{{ route('show.case', $case->id) }}"
                                                class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                    viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                </svg>
                                            </a>
                                            <a wire:click="open_modal_edit({{ $case->id }})"
                                                class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                    <path
                                                        d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                                </svg>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="mt-6 sm:flex sm:items-center sm:justify-between ">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Page <span class="font-medium text-gray-700 dark:text-gray-100">1 of 10</span>
            </div>

            <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
                <a href="#"<div class="mb-4">
                    <x-jet-label value="Juez" />
                    <x-jet-input type="text" class="w-full" wire:model.defer="nombre"
                        placeholder='Escriba el nombre del Juez' />
                    <x-jet-input-error for="juez" />
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>

            <span>
                previous
            </span>
            </a>

            <a href="#"
                class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md sm:w-auto gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                <span>
                    Next
                </span>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 rtl:-scale-x-100">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div> --}}
    </section>



    <x-jet-dialog-modal wire:model="modal_add">

        <x-slot name="title">
            Añadir Caso:
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" class="w-full" wire:model.defer="nombre"
                    placeholder='Escriba el nombre' />
                <x-jet-input-error for="nombre" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Fecha Inicio" />
                <x-jet-input type="fecha_inico" type="date" class="w-full" wire:model.defer="fecha_inicio"
                    placeholder='Seleccione la Fecha' />
                <x-jet-input-error for="fecha_inicio" />
            </div>



            <div class="mb-4">
                <x-jet-label value="Descripción" />
                <textarea wire:model.defer="descripcion"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                    rows="2" placeholder="Escriba la descripción"></textarea>
                <x-jet-input-error for="descripcion" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Requerimientos" />
                <textarea wire:model.defer="requerimientos"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                    rows="2" placeholder="Escriba los requerimientos"></textarea>
                <x-jet-input-error for="requerimientos" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Demandante" />
                <x-jet-input type="text" class="w-full" wire:model.defer="demandante"
                    placeholder='Escriba el nombre del Demandante' />
                <x-jet-input-error for="demandante" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Demandado" />
                <x-jet-input type="text" class="w-full" wire:model.defer="demandado"
                    placeholder='Escriba el nombre del Demandado' />
                <x-jet-input-error for="demandado" />
            </div>


            <div class="mb-4">
                <x-jet-label value="Juez" />
                <x-jet-input type="text" class="w-full" wire:model.defer="juez"
                    placeholder='Escriba el nombre del Juez' />
                <x-jet-input-error for="juez" />
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal_add', false)" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save"
                class="disabled:opacity-25 bg-black">
                Guardar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>




    <x-jet-dialog-modal wire:model="modal_edit">

        <x-slot name="title">
            Editar Caso:
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" class="w-full" wire:model.defer="nombre"
                    placeholder='Escriba el nombre' />
                <x-jet-input-error for="nombre" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Fecha Inicio" />
                <x-jet-input type="fecha_inico" type="date" class="w-full" wire:model.defer="fecha_inicio"
                    placeholder='Seleccione la Fecha' />
                <x-jet-input-error for="fecha_inicio" />
            </div>



            <div class="mb-4">
                <x-jet-label value="Descripción" />
                <textarea wire:model.defer="descripcion"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                    rows="2" placeholder="Escriba la descripción"></textarea>
                <x-jet-input-error for="descripcion" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Requerimientos" />
                <textarea wire:model.defer="requerimientos"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                    rows="2" placeholder="Escriba los requerimientos"></textarea>
                <x-jet-input-error for="requerimientos" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Demandante" />
                <x-jet-input type="text" class="w-full" wire:model.defer="demandante"
                    placeholder='Escriba el nombre del Demandante' />
                <x-jet-input-error for="demandante" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Demandado" />
                <x-jet-input type="text" class="w-full" wire:model.defer="demandado"
                    placeholder='Escriba el nombre del Demandado' />
                <x-jet-input-error for="demandado" />
            </div>


            <div class="mb-4">
                <x-jet-label value="Juez" />
                <x-jet-input type="text" class="w-full" wire:model.defer="juez"
                    placeholder='Escriba el nombre del Juez' />
                <x-jet-input-error for="juez" />
            </div>


        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal_edit', false)" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="update()" wire:loading.attr="disabled" wire:target="update"
                class="disabled:opacity-25 bg-black">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>



</div>
