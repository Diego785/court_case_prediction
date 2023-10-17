<div>

    <div class="mx-60 min-h-screen block items-center justify-center">
        @foreach ($cases_all as $case)
            <!-- component -->
            <div class=" bg-gray-50 py-6 flex flex-col justify-center relative overflow-hidden sm:py-12">
                <h2 class="text-center text-2xl font-semibold mt-3">{{ $case->nombre }}</h2>
                <div
                    class="relative px-6 pt-10 pb-8 bg-white shadow-xl ring-1 ring-gray-900/5 sm:max-w-lg sm:mx-auto sm:rounded-lg sm:px-10">
                    <div class="max-w-md mx-auto">

                        <div class="flex flex-wrap gap-4">



                            <button wire:click="open_modal({{ $case->id }}, 'graph')"
                                class="relative group px-8 h-14 bg-red-500
                        before:absolute 
                        before:inset-0 
                        before:bg-red-700 
                        before:scale-x-0 
                        before:origin-right
                        before:transition
                        before:duration-300
                        hover:before:scale-x-100
                        hover:before:origin-left
                        ">
                                <span class="relative uppercase text-base text-white">Gráfica, Predicción y
                                    Soporte</span>
                            </button>

                            <a href="{{ route('generate.report', $case->id) }}">
                                <button
                                    class="relative group overflow-hidden pl-6 h-14 flex space-x-6 items-center bg-blue-500">
                                    <span class="relative uppercase text-base text-white">Reporte</span>
                                    <div aria-hidden="true"
                                        class="w-14 bg-blue-600 transition duration-300 -translate-y-7 group-hover:translate-y-7">
                                        <div class="h-14 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto fill-white"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="h-14 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 m-auto fill-white"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </button>
                            </a>
                            <a href="{{ route('show.case', $case->id) }}">
                                <button
                                    class="uppercase relative group overflow-hidden px-6 h-12 rounded-full flex space-x-2 items-center bg-gradient-to-r from-pink-500 to-purple-500 hover:to-purple-600">
                                    <span class="relative text-sm text-white">Ver más</span>
                                    <div class="flex items-center -space-x-3 translate-x-3">
                                        <div
                                            class="w-2.5 h-[1.6px] rounded bg-white origin-left scale-x-0 transition duration-300 group-hover:scale-x-100">
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 stroke-white -translate-x-2 transition duration-300 group-hover:translate-x-0"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>
                            </a>

                            {{-- <button wire:click="open_modal({{ $case->id }}, 'soporte')"
                                class="relative group overflow-hidden px-6 h-12 border border-purple-200 rounded-full">
                                <div aria-hidden="true" class="transition duration-300 group-hover:-translate-y-12">
                                    <div class="h-12 flex items-center justify-center">
                                        <span class="text-purple-700">Soporte a la toma de desiciones</span>
                                    </div>
                                    <div class="h-12 flex items-center justify-center">
                                        <span class="text-purple-700">Ver</span>
                                    </div>
                                </div>
                            </button> --}}

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <x-jet-dialog-modal wire:model="modal">

        <x-slot name="title" class="font-bold">
            Soporte a la toma de desiciones, gráfica del estado del caso y predicción del resultado
        </x-slot>

        <x-slot name="content">

            <!-- component -->
            <div class="w-full flex-grow px-3">

                <div class="row py-4">

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


                <div style="margin-top: 20px" class="mx-20">
                    <canvas id="lineChartVentas" width="400" height="300"></canvas>
                </div>


                <br>
                <br>

                <label>Actualmente la probabilidad de éxito es:</label>
                <br>
                <br>
                <br>
                <div class="grid grid-cols-1 gap-20 lg:grid-cols-2 lg:gap-10">
                    <div class="flex items-center flex-wrap max-w-md px-10 bg-white shadow-xl rounded-2xl h-20"
                        x-data="{ circumference: 50 * 2 * Math.PI, percent: {{ $successful_percentage }} }">
                        <div class="flex items-center justify-center -m-6 overflow-hidden bg-white rounded-full">
                            <svg class="w-32 h-32 transform translate-x-1 translate-y-1" x-cloak aria-hidden="true">
                                <circle class="text-gray-300" stroke-width="10" stroke="currentColor" fill="transparent"
                                    r="50" cx="60" cy="60" />
                                <circle class="text-blue-600" stroke-width="10" :stroke-dasharray="circumference"
                                    :stroke-dashoffset="circumference - percent / 100 * circumference"
                                    stroke-linecap="round" stroke="currentColor" fill="transparent" r="50"
                                    cx="60" cy="60" />
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
                                <circle class="text-gray-300" stroke-width="10" stroke="currentColor"
                                    fill="transparent" r="50" cx="60" cy="60" />
                                <circle class="text-red-600" stroke-width="10" :stroke-dasharray="circumference"
                                    :stroke-dashoffset="circumference - percent / 100 * circumference"
                                    stroke-linecap="round" stroke="currentColor" fill="transparent" r="50"
                                    cx="60" cy="60" />
                            </svg>
                            <span class="absolute text-2xl text-red-700" x-text="`${percent.toFixed(2)}%`"></span>
                        </div>
                        <p class="ml-10 font-medium text-gray-600 sm:text-xl">Fracaso</p>

                        {{-- <span class="ml-auto text-xl font-medium text-red-600 hidden sm:block">20GB</span> --}}
                    </div>

                    

                </div>


                <div class="w-10/12 md:w-7/12 lg:6/12 mx-auto relative py-20">
                    <h1 class="text-3xl text-center font-bold text-blue-500">Línea de Tiempo del caso</h1>
                    <div class="border-l-2 mt-10">

                        @for ($i = 0; $i < $case_updates_all->count(); $i++)
                            <!-- Card 1 -->
                            @php
                                $update = $case_updates_all[$i];
                            @endphp
                            <div
                                class="transform transition cursor-pointer hover:-translate-y-2 ml-10 relative flex items-center px-6 py-4 bg-yellow-600 text-white rounded mb-10 flex-col md:flex-row">
                                <!-- Dot Follwing the Left Vertical Line -->
                                <div
                                    class="w-5 h-5 bg-yellow-600 absolute -left-10 transform -translate-x-2/4 rounded-full z-10 -mt-2 md:mt-0">
                                </div>

                                <!-- Line that connecting the box with the vertical line -->
                                <div class="w-10 h-1 bg-yellow-300 absolute -left-10 z-0"></div>

                                <!-- Content that showing in the box -->
                                <div class="flex-auto">
                                    <p class="text-md">Día {{ $i }}</p>
                                    <p class="text-md font-bold">{{ $update->descripcion }}</p>
                                    <h3>
                                        {{ $update->fecha }}
                                    </h3>
                                </div>
                                <a href="#"
                                    class="text-center text-white hover:text-gray-300">{{ $update->estado }}%</a>
                            </div>
                        @endfor



                        <div
                            class=" max-w-[26rem] whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none">
                            <div class="mb-2 flex items-center gap-3">

                                <div
                                    class="center relative inline-block select-none whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white">
                                    <div class="mt-px">Conclusión y Soporte:</div>
                                </div>
                            </div>
                            @if ($case_updates_all->count() == 0)
                                <p class="block font-sans text-xl font-bold leading-normal text-gray-700 antialiased">
                                    Sin seguimiento al caso.
                                </p>
                            @else
                                <p class="block font-sans text-sm font-bold leading-normal text-gray-700 antialiased">
                                    - {{ $message }}
                                </p>
                                <p class="block font-sans text-sm font-bold leading-normal text-gray-700 antialiased">
                                    - {{ $message2 }}
                                </p>
                                <p class="block font-sans text-sm font-bold leading-normal text-gray-700 antialiased">
                                    - {{ $message3 }}
                                </p>
                            @endif


                        </div>



                    </div>
                </div>



        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal', false)" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>
            {{-- <x-jet-danger-button wire:click="update()" wire:loading.attr="disabled" wire:target="update"
            class="disabled:opacity-25 bg-black">
            Actualizar
        </x-jet-danger-button> --}}
        </x-slot>
    </x-jet-dialog-modal>

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



</div>
