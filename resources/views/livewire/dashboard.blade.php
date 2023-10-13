<div class="flex-grow px-3">
    <h2 class="py-4" style="display: flex; justify-content: center ; font-weight: bold; color: orange">Ventas</h2>
    <div class="row py-4">
        <div class="col-md-3">
            <label>Tiendas:</label>
            <select class="form-control" id="exampleFormControlSelect1" wire:model="producto_id">
                <option selected value="">Todo</option>
                {{-- @foreach ($pdvs as $pdv)
                    <option value="{{ $pdv->id }}">{{ $pdv->nombre }}</option>
                @endforeach --}}
            </select>
        </div>
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
            <input class="form-control"  wire:model=""
                type="datetime-local" id="" name="">
            
        </div>
        <div class="col-md-3">
            <label for="end_date">Fecha y hora Fin:</label>
            <input class="form-control " wire:model=""
                type="datetime-local" id="" name="">
         
        </div>
    </div>
    <button wire:click=""
        class="group relative h-12 w-60 overflow-hidden rounded-lg bg-white text-lg shadow">
        <div class="absolute inset-0 w-3 bg-amber-400 transition-all duration-[250ms] ease-out group-hover:w-full">
        </div>
        <span class="relative text-black group-hover:text-white">Predecir Éxito del Caso</span>
    </button>

    <button wire:click=""
        class="group relative h-12 w-72 overflow-hidden rounded-lg bg-white text-lg shadow">
        <div class="absolute inset-0 w-3 bg-amber-400 transition-all duration-[250ms] ease-out group-hover:w-full">
        </div>
        <span class="relative text-black group-hover:text-white">Predecir Producto Más Vendido</span>
    </button>


    <label for="dateTimePicker">Fecha de Predicción:</label>
    <input type="datetime-local" wire:model="" id="dateTimePicker" name="dateTimePicker">

    <br>
    <br>
    <div
        class="flex flex-row m-auto bg-gradient-to-r from-purple-700 via-purple-800 to-purple-900 p-6 gap-8 rounded-lg border-2 border-purple-500">
        <div class="my-auto">
            <div class="text-lg text-purple-300">Casos</div>
            <div class="text-4xl text-purple-100"></div>
        </div>
        <div
            class="text-purple-300 my-auto bg-gradient-to-l from-purple-700 via-purple-800 to-purple-900 rounded-full p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 20 20" fill="currentColor">
                <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z" />
            </svg>
        </div>
    </div>

    <br>
    <div
        class="flex flex-row m-auto bg-gradient-to-r from-purple-700 via-purple-800 to-purple-900 p-6 gap-8 rounded-lg border-2 border-purple-500">
        <div class="my-auto">
            <div class="text-lg text-purple-300"></div>
            {{-- @if ($prediction_product)
                <div class="text-4xl text-purple-100">{{ $prediction_product }} con {{ $prediction_product_sales }}
                    ventas</div>
            @endif --}}
        </div>
        <div
            class="text-purple-300 my-auto bg-gradient-to-l from-purple-700 via-purple-800 to-purple-900 rounded-full p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 20 20" fill="currentColor">
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
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  #
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  First
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Last
                </th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                  Handle
                </th>
              </tr>
            </thead>
            <tbody>
              <tr class="bg-gray-100 border-b">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
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
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2</td>
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
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">3</td>
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
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">4</td>
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
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">5</td>
                <td colspan="2" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
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
  </div>
    <div style="margin-top: 20px">
        <canvas id="lineChartVentas" style="width: 50%"></canvas>
    </div>

    <div style="display: flex; justify-content: center">
        <p style="font-weight: bold; color: orange; font-size: 15px">Total: </p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the current date and time in "yyyy-mm-ddThh:mm" format
            const currentDateTime = new Date().toISOString().slice(0, 16);

            // Set the minimum date and time attribute of the input field
            document.getElementById("dateTimePicker").setAttribute("min", currentDateTime);
        });
    </script>

    <script>
        document.addEventListener('livewire:load', function() {

            let lineChart = null;


            // Livewire.on('drawPdvVentas', function(data) {
            //     draw(data);
            // });

            function draw(newData) {
                let ctx = document.getElementById('lineChartVentas').getContext('2d');

                const data = {
                    labels: newData.labels,
                    datasets: [{
                        label: 'Nro. de ventas',
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
                                text: 'Cantidad de Ventas'
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
