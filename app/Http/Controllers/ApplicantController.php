<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = Applicant::latest()->paginate(10);
        return view('applicants.index', compact('applicants'));
    }

    public function create()
    {
        return view('applicants.create');
    }

    public function createPublic()
    {
        return view('applicants.public_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:male,female',
            'national_id' => 'required|string|unique:applicants,national_id',
            'address' => 'required|string',
            'social_status' => 'nullable|string',
            'id_photo' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp|max:5120',
            'proof_photos.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp|max:5120',
        ]);

        if ($request->hasFile('id_photo')) {
            $validated['id_photo'] = $request->file('id_photo')->store('applicants/id_photos', 'public');
        }

        if ($request->hasFile('proof_photos')) {
            $photos = [];
            foreach ($request->file('proof_photos') as $photo) {
                $photos[] = $photo->store('applicants/proof_photos', 'public');
            }
            $validated['proof_photos'] = $photos;
        }

        $validated['association_id'] = auth()->user()->association_id;
        
        $applicant = Applicant::create($validated);
        
        return redirect()->route('applicants.show', $applicant)->with('success', 'تم تسجيل الحالة بنجاح');
    }

    public function storePublic(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:male,female',
            'national_id' => 'required|string|unique:applicants,national_id',
            'address' => 'required|string',
            'social_status' => 'nullable|string',
            'id_photo' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp|max:5120',
            'proof_photos.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp|max:5120',
        ]);

        if ($request->hasFile('id_photo')) {
            $validated['id_photo'] = $request->file('id_photo')->store('applicants/id_photos', 'public');
        }

        if ($request->hasFile('proof_photos')) {
            $photos = [];
            foreach ($request->file('proof_photos') as $photo) {
                $photos[] = $photo->store('applicants/proof_photos', 'public');
            }
            $validated['proof_photos'] = $photos;
        }

        Applicant::create($validated);
        
        return back()->with('success', 'تم إرسال بياناتك بنجاح. سيتم مراجعتها من قبل الجمعيات.');
    }

    public function show(Applicant $applicant)
    {
        $applicant->load('assistances.association');
        return view('applicants.show', compact('applicant'));
    }

    public function search(Request $request)
    {
        $request->validate(['national_id' => 'required|string']);
        
        $applicant = Applicant::where('national_id', $request->national_id)->first();
        
        if ($applicant) {
            return redirect()->route('applicants.show', $applicant)->with('success', 'الحالة مسجلة بالفعل في النظام.');
        }
        
        return back()->with('error', 'هذه الحالة غير مسجلة في النظام. يمكنك إضافتها الآن.');
    }
}
