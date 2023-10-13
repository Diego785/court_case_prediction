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
                    @if ($casoArray['fecha_finalizacion'] != null)
                        <p class="text-gray-400 text-sm">{{ $casoArray['fecha_inicio'] }} -
                            {{ $casoArray['fecha_finalizacion'] }}</p>
                    @else
                        <p class="text-gray-400 text-sm">{{ $casoArray['fecha_inicio'] }} - No Finalizado</p>
                    @endif
                </div>
            </div>
            <p class="-mt-4 text-gray-500">{{ $casoArray['descripcion'] }}</p>
        </div>

    </div>
  
    <div class="w-screen h-full  bg-gray-100">
        <div class="grid grid-cols-1 gap-20 lg:grid-cols-2 lg:gap-10">
            <div class="flex items-center flex-wrap max-w-md px-10 bg-white shadow-xl rounded-2xl h-20"
                x-data="{ circumference: 50 * 2 * Math.PI, percent: {{ $successful_percentage }} }">
                <div class="flex items-center justify-center -m-6 overflow-hidden bg-white rounded-full">
                    <svg class="w-32 h-32 transform translate-x-1 translate-y-1" x-cloak aria-hidden="true">
                        <circle class="text-gray-300" stroke-width="10" stroke="currentColor" fill="transparent"
                            r="50" cx="60" cy="60" />
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
                        <circle class="text-gray-300" stroke-width="10" stroke="currentColor" fill="transparent"
                            r="50" cx="60" cy="60" />
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


            <br>
            <br>
            {{-- <div
                class="flex flex-row m-auto bg-gradient-to-r from-purple-700 via-purple-800 to-purple-900 p-6 gap-8 rounded-lg border-2 border-purple-500">
                <div class="my-auto">
                    <div class="text-lg text-purple-300">Ventas para </div>
                    <div class="text-4xl text-purple-100"></div>
                </div>
                <div
                    class="text-purple-300 my-auto bg-gradient-to-l from-purple-700 via-purple-800 to-purple-900 rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z" />
                    </svg>
                </div>
            </div>

            <br>
            <div
                class="flex flex-row m-auto bg-gradient-to-r from-purple-700 via-purple-800 to-purple-900 p-6 gap-8 rounded-lg border-2 border-purple-500">
                <div class="my-auto">
                    <div class="text-lg text-purple-300">Producto más Vendido para </div>
                    <div class="text-4xl text-purple-100"> con
                        ventas</div>
                </div>
                <div
                    class="text-purple-300 my-auto bg-gradient-to-l from-purple-700 via-purple-800 to-purple-900 rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z" />
                    </svg>
                </div>
            </div>

            <!-- component -->
            <div class="flex flex-col">
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

            <div style="display: flex; justify-content: center">
                <p style="font-weight: bold; color: orange; font-size: 15px">Total: {{ $total }} - Media:
                    {{ $avg }}
                </p>
            </div>
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
