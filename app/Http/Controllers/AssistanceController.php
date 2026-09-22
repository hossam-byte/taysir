<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assistance;
use App\Models\Applicant;

class AssistanceController extends Controller
{
    public function create(Applicant $applicant)
    {
        return view('assistances.create', compact('applicant'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'applicant_id' => 'required|exists:applicants,id',
            'type_or_value' => 'required|string',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $validated['association_id'] = auth()->user()->association_id;
        $validated['user_id'] = auth()->id();

        Assistance::create($validated);

        return redirect()->route('applicants.show', $validated['applicant_id'])->with('success', 'تم تسجيل المساعدة بنجاح.');
    }
}
