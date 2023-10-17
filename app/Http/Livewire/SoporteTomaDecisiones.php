<?php

namespace App\Http\Livewire;

use App\Models\Caso;
use App\Models\CasoUpdate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Phpml\Regression\LeastSquares;

class SoporteTomaDecisiones extends Component
{

    public $cases_all;
    public $case_updates_all;
    public $case_id;
    public $caso;
    public $interval = 1;
    public $prediction_date;
    public $start_date;
    public $finish_date;
    public $successful_percentage;
    public $message = '';
    public $message2 = '';
    public $message3 = '';


    //MODALS
    public $modal_type = '';
    public $modal = false;



    public function mount()
    {
        // dd($this->case_id);
        $current_date = (new Carbon())->format('d/m/Y');
        $this->prediction_date = $current_date;
        $this->start_date = '2023-01-01 00:00:00';
        $this->finish_date = '2023-12-31 00:00:00';
    }

    public function emitDrawPdvVentas($data)
    {
        $this->emit('drawPdvVentas', $data);
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

    public function caseSuccessPrediction($case_id)
    {
        // Get the current date and time
        $now = Carbon::now();

        // Add one day
        $newDate = $now->addDay();

        // Initialize an empty array to store historical case update data
        $historicalData = [];

        // Fetch the case update data from the "caso_updates" model
        $caseUpdateData = DB::table('caso_updates')->where('caso_id', $case_id)->get();
        if (count($caseUpdateData) > 0) {
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
            $predictedSuccessPercentage = $regression->predict([strtotime($newDate)]);

            // Ensure the result is within the valid percentage range (0% to 100%)
            $predictedSuccessPercentage = min(max($predictedSuccessPercentage, 0), 100);
            $this->successful_percentage = $predictedSuccessPercentage;

            return $this->successful_percentage;
        }

        // You can return $predictedSuccessPercentage to your view or process it further as needed.
    }

    

    public function open_modal($id, $type)
    {
        $this->caso = Caso::find($id);
        $this->case_id = $id;
        $this->case_updates_all = CasoUpdate::where('caso_id', $id)->get();
        $percentage = $this->caseSuccessPrediction($this->case_id);
        // dd($this->case_updates_all->last()->estado);

        if ($this->case_updates_all->last() != null) {
            if ($percentage > $this->case_updates_all->last()->estado) {
                $this->message = 'Se prevee que el caso falle a favor del demandante: ' . $this->caso->demandante;
                $this->message2 = 'Se prevee que el caso falle en contra del demandado: ' . $this->caso->demandado;
                $this->message3 = 'Se recomienda tomar en cuenta los requerimientos del demandante: ' . $this->caso->requerimientos;
            } else {
                $this->message = 'Se prevee que el caso falle a favor del demandado: ' . $this->caso->demandado;
                $this->message2 = 'Se prevee que el caso falle en contra del demandante: ' . $this->caso->demandante;
                $this->message3 = 'Se recomienda tomar en cuenta una posible contra demanda o las peticiones del demandado.';
            }
        }


        $this->modal_type = $type;
        $this->modal = true;
    }

    // public function open_modal_soporte($id)
    // {
    //     $this->caso = Caso::find($id);
    //     $this->case_id = $id;
    //     $this->case_updates_all = CasoUpdate::where('caso_id', $id)->get();
    //     $percentage = $this->caseSuccessPrediction($this->case_id);
    //     // dd($this->case_updates_all->last()->estado);

    //     if ($this->case_updates_all->last() != null) {
    //         if ($percentage > $this->case_updates_all->last()->estado) {
    //             $this->message = 'Se prevee que el caso falle a favor del demandante: ' . $this->caso->demandante;
    //             $this->message2 = 'Se prevee que el caso falle en contra del demandado: ' . $this->caso->demandado;
    //         } else {
    //             $this->message = 'Se prevee que el caso falle a favor del demandado: ' . $this->caso->demandado;
    //             $this->message2 = 'Se prevee que el caso falle en contra del demandante: ' . $this->caso->demandante;
    //         }
    //     }


    //     $this->modal_graph = false;
    //     $this->modal_soporte = true;
    // }


    // public function open_modal_graph($id)
    // {
    //     $this->caso = Caso::find($id);
    //     $this->case_id = $id;
    //     $this->case_updates_all = CasoUpdate::where('caso_id', $id)->get();
    //     $percentage = $this->caseSuccessPrediction($this->case_id);
    //     // dd($this->case_updates_all->last()->estado);

    //     if ($this->case_updates_all->last() != null) {
    //         if ($percentage > $this->case_updates_all->last()->estado) {
    //             $this->message = 'Se prevee que el caso falle a favor del demandante: ' . $this->caso->demandante;
    //             $this->message2 = 'Se prevee que el caso falle en contra del demandado: ' . $this->caso->demandado;
    //         } else {
    //             $this->message = 'Se prevee que el caso falle a favor del demandado: ' . $this->caso->demandado;
    //             $this->message2 = 'Se prevee que el caso falle en contra del demandante: ' . $this->caso->demandante;
    //         }
    //     }



    //     $this->modal_soporte = false;
    //     $this->modal_graph = true;
    // }


    public function render()
    {
        $this->cases_all = Caso::all();
        $this->case_updates_all = CasoUpdate::where('caso_id', $this->case_id)->get();

        if ($this->case_id != null) {
            $cases = CasoUpdate::selectRaw("DATE_FORMAT(fecha, '{$this->getInterval()}') as time, SUM(estado) as cant")
                ->whereBetween('fecha', [$this->start_date, $this->finish_date])
                // You might want to filter by the current $case here
                ->where('caso_id', $this->case_id)
                ->groupBy('time')
                ->orderBy('fecha')
                ->get();
        } else {
            $cases = CasoUpdate::selectRaw("DATE_FORMAT(fecha, '{$this->getInterval()}') as time, SUM(estado) as cant")
                ->whereBetween('fecha', [$this->start_date, $this->finish_date])
                // You might want to filter by the current $case here
                ->groupBy('time')
                ->orderBy('fecha')
                ->get();
        }


        $total = $cases->sum('cant');
        $count = sizeof($cases) > 0 ? sizeof($cases) : 1;
        $avg = round($total / $count, 2);

        $data = [
            'labels' => $cases->pluck('time')->toArray(),
            'data' => $cases->pluck('cant')->toArray(),
        ];

        $this->emitDrawPdvVentas($data);


        return view('livewire.soporte-toma-decisiones', compact('data', 'total', 'avg'));
    }
}
