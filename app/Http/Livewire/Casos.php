<?php

namespace App\Http\Livewire;

use App\Models\Caso;
use App\Models\CasoUpdate;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Phpml\Regression\LeastSquares;
use SebastianBergmann\CodeCoverage\Util\Percentage;

class Casos extends Component
{
    public $cases;
    public $case;
    public $updated_cases;
    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';
    public $justLook = 'All';
    public $successful_percentage;
    public $modal_add = false;
    public $modal_edit = false;

    //attributes for crud the case
    public $nombre;
    public $fecha_inicio;
    public $descripcion;
    public $requerimientos;
    public $demandante;
    public $demandado;
    public $juez;


   //Validaciones del formulario
   protected $rules = [
    'nombre' => 'required',
    'fecha_inicio' => 'required',
    'descripcion' => 'required',
    'requerimientos' => 'required',
    'demandante' => 'required',
    'demandado' => 'required',
];

//Mensajes de las validaciones
protected $messages = [
    'nombre.required' => 'El nombre del caso es obligatorio.',
    'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
    'descripcion.required' => 'La descripción es obligatoria.',
    'requerimientos.required' => 'Los requerimientos son obligatorios.',
    'demandante.required' => 'El nombre del demandante es obligatorio.',
    'demandado.required' => 'El nombre del demandado es obligatorio.',
];


    public function order($sort)
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function select_cases($case)
    {
        $this->justLook = $case;
    }

    public function open_modal_add(){
        $this->reset(['modal_add', 'nombre', 'fecha_inicio', 'descripcion', 'requerimientos', 'demandante', 'demandado', 'juez']);

        $this->modal_add = true;
    }

    public function open_modal_edit($case_id){
        $this->modal_edit = true;
        $this->case = Caso::find($case_id);
        $this->nombre = $this->case->nombre;
        $this->fecha_inicio = $this->case->fecha_inicio;
        $this->descripcion = $this->case->descripcion;
        $this->requerimientos = $this->case->requerimientos;
        $this->demandante = $this->case->demandante;
        $this->demandado = $this->case->demandado;
        $this->juez = $this->case->juez;


    }


    public function save()
    {
        $this->validate();

        Caso::create([
            'nombre' => $this->nombre,
            'fecha_inicio' => $this->fecha_inicio,
            'descripcion' => $this->descripcion,
            'requerimientos' => $this->requerimientos,
            'demandante' => $this->demandante,
            'demandado' => $this->demandado,
            'juez' => $this->juez,
        ]);
 
    }

    public function update()
    {
        $this->validate();
        $this->case->nombre = $this->nombre;
        $this->case->fecha_inicio = $this->fecha_inicio;
        $this->case->descripcion = $this->descripcion;
        $this->case->requerimientos = $this->requerimientos;
        $this->case->demandante = $this->demandante;
        $this->case->demandado = $this->demandado;
        $this->case->juez = $this->juez;
        $this->case->update();

        $this->reset(['modal_edit', 'nombre', 'fecha_inicio', 'descripcion', 'requerimientos', 'demandante', 'demandado', 'juez']);

    }

    public function justLookAt($justLook)
    {
        $this->justLook = $justLook;
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


    public function render()
    {
        $cases = Caso::all();
        $percentage = 0;
        if ($this->justLook == 'All') {
            $this->cases = Caso::where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->orWhere('requerimientos',  'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->get();
        } else if ($this->justLook == 'Successful') {
            $this->cases = [];

            foreach ($cases as $case) {
                $percentage = $this->caseSuccessPrediction($case->id);

                if ($percentage != 0) { // never enter in the if, why??

                    if (($percentage > $case->caso_updates->last()->estado)) {
                        array_push($this->cases, $case);
                    }
                }
            }
        } else if ($this->justLook == 'Lost') {
            $this->cases = [];

            foreach ($cases as $case) {
                $percentage = $this->caseSuccessPrediction($case->id);

                if ($percentage != 0) { // never enter in the if, why??

                    if (($percentage < $case->caso_updates->last()->estado)) {
                        array_push($this->cases, $case);
                    }
                }
            }
        }


        $this->updated_cases = CasoUpdate::all();
        return view('livewire.casos');
    }
}
