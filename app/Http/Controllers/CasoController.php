<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use App\Models\CasoUpdate;
use Illuminate\Http\Request;

class CasoController extends Controller
{
    public function show($id)
    {
        $cases = Caso::all();
        $case = Caso::find($id);
        return view('my_views.dashboard.show_case', compact('cases', 'case'));
    }


    public function generatePDFCasos()
    {
        // Obtener datos necesarios
        $casos = Caso::all();

        // $pdf = app('dompdf.wrapper');
        // $pdf->loadView('my_views.testing.testing-pdfs', compact('alerts'));
        // return $pdf->download('Lista de alertas: ' . now() . '.pdf');
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('my_views.reports.casos', compact('casos'));
        return $pdf->download('Casos:  - ' . now() . '.pdf');
    }

    public function generatePDF($myId)
    {
        // Obtener datos necesarios
        $casos = CasoUpdate::where('caso_id', $myId)->get();

        // $pdf = app('dompdf.wrapper');
        // $pdf->loadView('my_views.testing.testing-pdfs', compact('alerts'));
        // return $pdf->download('Lista de alertas: ' . now() . '.pdf');
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('my_views.reports.caso', compact('casos'));
        return $pdf->download('Caso: ' . $myId . '-' . now() . '.pdf');
        // return view('my_views.testing.testing-pdfs', compact('alerts'));
    }

    public function show_cases()
    {
        $cases = Caso::all();

        // $case = Caso::find($id);
        return view('my_views.dashboard.show_cases', compact('cases'));
    }
    public function show_soporte()
    {
        $cases = Caso::all();

        // $case = Caso::find($id);
        return view('my_views.dashboard.show_soporte_toma_decisiones', compact('cases'));
    }
}
