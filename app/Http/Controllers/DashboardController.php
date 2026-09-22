<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Assistance;
use App\Models\Association;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCases = Applicant::count();
        $totalAssistances = Assistance::count();
        $totalAssociations = Association::count();
        
        return view('dashboard', compact('totalCases', 'totalAssistances', 'totalAssociations'));
    }
}
