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
}
