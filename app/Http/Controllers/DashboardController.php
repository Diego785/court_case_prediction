<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $cases = Caso::all();
        return view('my_views.dashboard.show_dashboard', compact('cases'));
    }
}
