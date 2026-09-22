<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Association;
use Illuminate\Support\Facades\Gate;

class AssociationController extends Controller
{
    public function index()
    {
        Gate::authorize('super_admin');
        $associations = Association::withCount(['users', 'applicants'])->latest()->paginate(10);
        return view('associations.index', compact('associations'));
    }

    public function create()
    {
        Gate::authorize('super_admin');
        return view('associations.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('super_admin');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:associations,name',
            'contact_number' => 'nullable|string',
            'address' => 'nullable|string',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Association::create($validated);

        return redirect()->route('associations.index')->with('success', 'تم إضافة الجمعية بنجاح.');
    }
}
