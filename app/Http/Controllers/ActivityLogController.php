<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Gate;

class ActivityLogController extends Controller
{
    public function index()
    {
        Gate::authorize('super_admin');
        
        $activities = Activity::with('causer')->latest()->paginate(15);
        return view('activities.index', compact('activities'));
    }
}
