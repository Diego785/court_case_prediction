<?php

namespace App\Http\Livewire;

use App\Models\Caso as ModelsCaso;
use App\Models\CasoUpdate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Phpml\Regression\LeastSquares;

class Caso extends Component
{
    public $case_id;
    public $caso;
    public $casoArray;

    public $case;
    public $start_date;
    public $finish_date;
    public $prediction_date;
    public $successful_percentage;
    public $interval = 1;
    public $estados;

    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'finish_date' => 'required|date|after:start_date',
    ];

    protected $messages = [
        'start_date.required' => 'La Fecha y Hora de inicio es requerida.',
        'finish_date.required' => 'La Fecha y Hora de fin es requerida.',
        'finish_date.after' => 'La Fecha Fin no puede ser menor que la Fecha inicio.',
        'start_date.before' => 'La Fecha Inicio no puede ser mayor que la Fecha Fin.',
    ];

    public function mount()
    {
        // dd($this->case_id);
        $this->caso = ModelsCaso::find($this->case_id);
        $this->casoArray = $this->caso->toArray();
        $current_date = (new Carbon())->format('d/m/Y');
        $this->prediction_date = $current_date . ' 00:00:00';
        $this->start_date = '2023-01-01 00:00:00';
        $this->finish_date = '2023-12-31 00:00:00';
        $this->successful_percentage = 0;
    }

    public function caseSuccessPrediction()
    {
        // Initialize an empty array to store historical case update data
        $historicalData = [];

        // Fetch the case update data from the "caso_updates" model
        $caseUpdateData = DB::table('caso_updates')->where('caso_id', $this->case_id)->get();
        // Loop through the case update data and format it into the desired structure
        foreach ($caseUpdateData as $update) {
            // Use "estado" as the success percentage and "fecha" as the date of the update
            $historicalData[] = [
                'success_percentage' => $update->estado,
                'update_date' => strtotime($update->fecha),
            ];
        }

        // Sort the historical data by update date in ascending order
        usort($historicalData, function ($a, $b) {
            return $a['update_date'] <=> $b['update_date'];
        });

        // Prepare data for training
        $samples = [];
        $targets = [];
        foreach ($historicalData as $data) {
            $samples[] = [$data['update_date']];
            $targets[] = $data['success_percentage'];
        }

        // Create and train a machine learning model (e.g., Linear Regression)
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        // // Make predictions for a future date (provide relevant date as input)
        // $futureUpdateDate = strtotime('2023-12-31'); // Example future date
        // $predictedSuccessPercentage = $regression->predict([$futureUpdateDate]);

        // Make predictions for the provided future date
        $predictedSuccessPercentage = $regression->predict([strtotime($this->prediction_date)]);

        // Ensure the result is within the valid percentage range (0% to 100%)
        $predictedSuccessPercentage = min(max($predictedSuccessPercentage, 0), 100);
        $this->successful_percentage = $predictedSuccessPercentage;

        // You can return $predictedSuccessPercentage to your view or process it further as needed.
    }

    public function getInterval()
    {
        switch ($this->interval) {
            case 1:
                return "%d/%m/%Y %H:00";
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


    public function render()
    {

        if ($this->case_id) {
            $cases = CasoUpdate::selectRaw("DATE_FORMAT(fecha, '{$this->getInterval()}') as time, SUM(estado) as cant")
                ->whereBetween('fecha', [$this->start_date, $this->finish_date])
                ->where('caso_id', $this->case_id)
                ->groupBy('time')
                ->orderBy('fecha')
                ->get();
        } else {
            $cases = CasoUpdate::selectRaw("DATE_FORMAT(fecha, '{$this->getInterval()}') as time")
                ->selectRaw("MAX(estado) as cant")
                ->whereBetween('fecha', [$this->start_date, $this->finish_date])
                ->groupBy('time')
                ->orderBy('fecha')
                ->get();
        }


        // dd($cases);

        $total = $cases->SUM('cant');
        $count = sizeof($cases) > 0 ? sizeof($cases) : 1;
        $avg = round($total / $count, 2);


        $data = [
            'labels' => $cases->pluck('time')->toArray(),
            'data' => $cases->pluck('cant')->toArray(),
        ];

        // dd($data);
        $this->emitDrawPdvVentas($data);

        return view('livewire.caso', compact('data', 'total', 'avg'));
    }
}
