<?php

namespace App\Http\Livewire;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use Phpml\Regression\LeastSquares;

class Dashboard extends Component
{

    public $pdvs = null;
    public $producto_id = null;
    public $interval = 1;
    public $start_date;
    public $end_date;
    public $errorMessage = '';

    public $prediction_sales;
    public $prediction_product;
    public $prediction_product_sales;
    public $prediction_date;


    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date' => 'required|date|after:start_date',
    ];

    protected $messages = [
        'start_date.required' => 'La Fecha y Hora de inicio es requerida.',
        'end_date.required' => 'La Fecha y Hora de fin es requerida.',
        'end_date.after' => 'La Fecha Fin no puede ser menor que la Fecha inicio.',
        'start_date.before' => 'La Fecha Inicio no puede ser mayor que la Fecha Fin.',
    ];


    public function salesPrediction()
    {

        // Initialize an empty array to store historical data
        $historicalData = [];

        // Fetch the sales data from the "ventas" model
        $salesData = DB::table('ventas')->get();

        // Your code to fetch historical sales data from the database
        // Loop through the sales data and format it into the desired structure
        foreach ($salesData as $sale) {
            $historicalData[] = [
                'date' => $sale->fecha,
                'quantity' => $sale->total, // Assuming "total" represents the quantity in your model
            ];
        }

        // Prepare data for training
        $samples = [];
        $targets = [];
        foreach ($historicalData as $data) {
            $samples[] = [strtotime($data['date'])];
            $targets[] = $data['quantity'];
        }

        // Create and train a forecasting model (e.g., Linear Regression)
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        // Make predictions for future dates (adjust as needed)
        $futureDate = strtotime($this->prediction_date);
        $this->prediction_sales = $regression->predict([$futureDate]);


        // You can return $predictedQuantity to your view or process it further as needed.
    }
    public function findMostSoldProductForDate()
    {
        // Initialize an array to store product sales predictions
        $productSalesPredictions = [];

        // Fetch Unique Product IDs
        $uniqueProductIds = DB::table('ventas')->distinct()->pluck('producto_id')->toArray();

        // Loop through unique product IDs
        foreach ($uniqueProductIds as $productId) {
            // Initialize an empty array to store historical data for this product
            $historicalData = [];

            // Fetch the sales data for this product from the "ventas" model
            $salesDataForProduct = DB::table('ventas')
                ->where('producto_id', $productId)
                ->get();

            // Loop through the sales data and format it into the desired structure
            foreach ($salesDataForProduct as $sale) {
                $historicalData[] = [
                    'date' => $sale->fecha,
                    'quantity' => $sale->total, // Assuming "total" represents the quantity in your model
                ];
            }

            // Prepare data for training
            $samples = [];
            $targets = [];
            foreach ($historicalData as $data) {
                $samples[] = [strtotime($data['date'])];
                $targets[] = $data['quantity'];
            }

            // Create and train a forecasting model (e.g., Linear Regression) for this product
            $regression = new LeastSquares();
            $regression->train($samples, $targets);

            // Make predictions for the specified future date (adjust as needed)
            $futureDate = strtotime($this->prediction_date);
            $productSalesPredictions[$productId] = $regression->predict([$futureDate]);
        }

        // Find the most sold product by sorting the predictions array
        arsort($productSalesPredictions);
        $mostSoldProductId = key($productSalesPredictions);
        $mostSoldProductSales = current($productSalesPredictions);
        // Fetch the name of the most sold product from the "productos" table
        $this->prediction_product = DB::table('productos')
            ->where('id', $mostSoldProductId)
            ->value('nombre');

        $this->prediction_product_sales = $mostSoldProductSales;



        // You can return the most sold product ID and its predicted sales
        return [
            'most_sold_product_id' => $mostSoldProductId,
            'predicted_sales' => $mostSoldProductSales,
        ];
    }







    public function __construct()
    {
        $this->loadPdvs();
        $currentDate = (new Carbon())->format('d/m/Y');

        $this->start_date = $currentDate . ' 00:00:00';
        $this->end_date = $currentDate . ' 23:59:59';
        $this->prediction_date = Carbon::now();
        $this->prediction_date->subHours(4);
    }

    public function getInterval()
    {
        switch ($this->interval) {
            case 1:
                return "%d/%m-%Y %H:00";
                break;
            case 2:
                return "%d/%m/%Y";
                break;
            case 3:
                return "%m/%Y";
                break;
        }
    }

    public function emitDrawPdvVentas($data)
    {
        $this->emit('drawPdvVentas', $data);
    }

    public function loadPdvs()
    {
        // $this->pdvs = Producto::select('id', 'nombre')
        //     ->orderby('nombre', 'asc')
        //     ->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
