<div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    <br>
    <br>
    <!-- component -->
    <div class="flex justify-center relative px-28 mx-48">

        <!-- This is an example component -->
        <div class="relative grid grid-cols-1 gap-4 p-4 mb-8 border rounded-lg bg-white shadow-lg">
            <div class="relative flex gap-4">
                <img src="https://icons.iconarchive.com/icons/diversity-avatars/avatars/256/charlie-chaplin-icon.png"
                    class="relative rounded-lg -top-8 -mb-4 bg-white border h-20 w-20" alt="" loading="lazy">
                <div class="flex flex-col w-full">
                    <div class="flex flex-row justify-between">
                        <p class="relative text-xl whitespace-nowrap truncate overflow-hidden">{{ $casoArray['nombre'] }}
                        </p>
                        <a class="text-gray-500 text-xl" href="#"><i class="fa-solid fa-trash"></i></a>
                    </div>
                    @if ($casoArray->fecha_finalizacion != null)
                        <p class="text-gray-400 text-sm">{{ $casoArray->fecha_incio }} -
                            {{ $casoArray->fecha_finalizacion }}</p>
                    @else
                        <p class="text-gray-400 text-sm">{{ $casoArray->inicio }} - No Finalizado</p>
                    @endif
                </div>
            </div>
            <p class="-mt-4 text-gray-500">{{ $casoArray->descripcion }}</p>
        </div>

    </div>



    <div class="w-screen h-full  bg-gray-100">
        <div class="grid grid-cols-1 gap-20 lg:grid-cols-2 lg:gap-10">
            <div class="flex items-center flex-wrap max-w-md px-10 bg-white shadow-xl rounded-2xl h-20"
                x-data="{ circumference: 50 * 2 * Math.PI, percent: {{ $successful_percentage }} }">
                <div class="flex items-center justify-center -m-6 overflow-hidden bg-white rounded-full">
                    <svg class="w-32 h-32 transform translate-x-1 translate-y-1" x-cloak aria-hidden="true">
                        <circle class="text-gray-300" stroke-width="10" stroke="currentColor" fill="transparent" r="50"
                            cx="60" cy="60" />
                        <circle class="text-blue-600" stroke-width="10" :stroke-dasharray="circumference"
                            :stroke-dashoffset="circumference - percent / 100 * circumference" stroke-linecap="round"
                            stroke="currentColor" fill="transparent" r="50" cx="60" cy="60" />
                    </svg>
                    <span class="absolute text-2xl text-blue-700" x-text="`${percent.toFixed(2)}%`"></span>
                </div>
                <p class="ml-10 font-medium text-gray-600 sm:text-xl">Éxito</p>

                {{-- <span class="ml-auto text-xl font-medium text-blue-600 hidden sm:block">+25%</span> --}}
            </div>


            <div class="flex items-center flex-wrap max-w-md px-10 bg-white shadow-xl rounded-2xl h-20"
                x-data="{ circumference: 50 * 2 * Math.PI, percent: {{ $successful_percentage === 0 ? 0 : 100 - $successful_percentage }} }">
                <div class="flex items-center justify-center -m-6 overflow-hidden bg-white rounded-full">
                    <svg class="w-32 h-32 transform translate-x-1 translate-y-1" x-cloak aria-hidden="true">
                        <circle class="text-gray-300" stroke-width="10" stroke="currentColor" fill="transparent" r="50"
                            cx="60" cy="60" />
                        <circle class="text-red-600" stroke-width="10" :stroke-dasharray="circumference"
                            :stroke-dashoffset="circumference - percent / 100 * circumference" stroke-linecap="round"
                            stroke="currentColor" fill="transparent" r="50" cx="60" cy="60" />
                    </svg>
                    <span class="absolute text-2xl text-red-700" x-text="`${percent.toFixed(2)}%`"></span>
                </div>
                <p class="ml-10 font-medium text-gray-600 sm:text-xl">Fracaso</p>

                {{-- <span class="ml-auto text-xl font-medium text-red-600 hidden sm:block">20GB</span> --}}
            </div>
        </div>
        <br>
        <br>
        <br>

        <button wire:click="caseSuccessPrediction()"
            class="group relative h-12 w-60 overflow-hidden rounded-lg bg-white text-lg shadow">
            <div class="absolute inset-0 w-3 bg-amber-400 transition-all duration-[250ms] ease-out group-hover:w-full">
            </div>
            <span class="relative text-black group-hover:text-white">Predecir Porcentage de Éxito</span>
        </button>



        <label for="dateTimePicker">Fecha de Predicción:</label>
        <input type="datetime-local" wire:model="prediction_date" id="dateTimePicker" name="dateTimePicker">





        <br>
        <br>

        <div class="flex items-center mt-4 gap-x-3">



            <a href="{{ route('generate.report', $casoArray->id) }}"
                class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-red-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-red-600 dark:hover:bg-red-500 dark:bg-red-600">
                <i class="fa-solid fa-file-pdf text-lg leading-none"></i>

                <span>Reportar</span>
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
        <br>
        <div class="flex flex-col mt-6">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>

                                    <th scope="col"
                                        class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Actualización del caso
                                    </th>

                                    <th scope="col"
                                        class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Fecha
                                    </th>


                                    <th scope="col"
                                        class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Probabilidad de Éxito</th>

                                    <th scope="col" class="relative py-3.5 px-4">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

                                @foreach ($casoArray->caso_updates as $case)
                                    <tr>
                                        <td class="px-4 py-4">
                                            <p class="font-sm italic text-gray-800 dark:text-white">
                                                {{ $case->descripcion }}</p>

                                        </td>
                                        <td class="px-12 py-4 text-sm font-medium">
                                            <div
                                                class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                {{ $case->fecha }}
                                            </div>


                                        </td>

                                        <td class="px-4 py-4 text-sm">
                                            <p class=" text-gray-700 dark:text-gray-200">{{ $case->estado }}%
                                            </p>

                                        </td>


                                        </td>




                                        <td class="px-4 py-4 text-sm whitespace-nowrap flex">

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
        <br>
        <br>

        {{-- HERE START THE GRAPH --}}


        <div class="w-full flex-grow px-3">
            {{-- <h2 class="py-4" style="display: flex; justify-content: center ; font-weight: bold; color: orange">Ventas
            </h2> --}}
            <div class="row py-4">
                {{-- <div class="col-md-3">
                    <label>Tiendas:</label>
                    <select class="form-control" id="exampleFormControlSelect1" wire:model="">
                        <option selected value="">Todo</option>
                        {{-- @foreach ($pdvs as $pdv)
                            <option value="{{ $pdv->id }}">{{ $pdv->nombre }}</option>
                        @endforeach --}}
                {{-- </select>
                </div> --}}
                <div class="col-md-1">
                    <label>Intervalo:</label>
                    <select class="form-control" id="exampleFormControlSelect1" wire:model="interval">
                        <option value="1">Hora</option>
                        <option value="2">Dia</option>
                        <option value="3">Mes</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="start_date">Fecha y hora Inicio:</label>
                    <input class="form-control @error('start_date') is-invalid @enderror" wire:model="start_date"
                        type="datetime-local" id="start_date" name="start_date">
                    @error('start_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="finish_date">Fecha y hora Fin:</label>
                    <input class="form-control @error('finish_date') is-invalid @enderror" wire:model="finish_date"
                        type="datetime-local" id="finish_date" name="finish_date">
                    @error('finish_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <!-- component -->
            {{-- <div class="flex flex-col">
                <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-white border-b">
                                    <tr>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            First
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Last
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Handle
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-gray-100 border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Mark
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Otto
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @mdo
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Jacob
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Dillan
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @fat
                                        </td>
                                    </tr>
                                    <tr class="bg-gray-100 border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">3
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Mark
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Twen
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @twitter
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">4
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Bob
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            Dillan
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @fat
                                        </td>
                                    </tr>
                                    <tr class="bg-gray-100 border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">5
                                        </td>
                                        <td colspan="2"
                                            class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                            Larry the Bird
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @twitter
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div style="margin-top: 20px" class="mx-20">
                <canvas id="lineChartVentas" style="width: 50%"></canvas>
            </div>

            {{-- <div style="display: flex; justify-content: center">
                <p style="font-weight: bold; color: orange; font-size: 15px">Total: {{ $total }} - Media:
                    {{ $avg }}
                </p>
            </div> --}}
            <br>
            <br>
            <br>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Get the current date and time in "yyyy-mm-ddThh:mm" format
                    const currentDateTime = new Date().toISOString().slice(0, 16);

                    // Set the minimum date and time attribute of the input field
                    const dateTimePicker = document.getElementById("dateTimePicker");
                    dateTimePicker.setAttribute("min", currentDateTime);

                    // Add an event listener to the input field to prevent selecting past dates and times
                    dateTimePicker.addEventListener("input", function() {
                        const selectedDateTime = dateTimePicker.value;
                        if (selectedDateTime < currentDateTime) {
                            // Reset the input field if a past date and time is selected
                            dateTimePicker.value = currentDateTime;
                        }
                    });
                });
            </script>

            <script>
                document.addEventListener('livewire:load', function() {

                    let lineChart = null;


                    draw(@json($data));

                    Livewire.on('drawPdvVentas', function(data) {
                        draw(data);
                    });

                    function draw(newData) {
                        let ctx = document.getElementById('lineChartVentas').getContext('2d');

                        const data = {
                            labels: newData.labels,
                            datasets: [{
                                label: 'Estado del Caso',
                                data: newData.data,
                                borderColor: 'orange',
                                borderWidth: 2,
                                fill: false
                            }]
                        };

                        const options = {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Tiempo'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Porcentage de Éxito (%)'
                                    },
                                    beginAtZero: true
                                }
                            }
                        };


                        if (lineChart) {
                            lineChart.destroy()
                        }

                        lineChart = new Chart(ctx, {
                            type: 'line',
                            data: data,
                            options: options
                        });

                        lineChart.render();
                    }
                });
            </script>
        </div>


    </div>






</div>
