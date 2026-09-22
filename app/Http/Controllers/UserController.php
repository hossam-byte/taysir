<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Association;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('super_admin');
        $users = User::where('role', 'association_user')->with('association')->latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('super_admin');
        $associations = Association::all();
        return view('users.create', compact('associations'));
    }

    public function store(Request $request)
    {
        Gate::authorize('super_admin');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|min:6',
            'association_id' => 'required|exists:associations,id',
        ]);

        $validated['role'] = 'association_user';
        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'تم إضافة موظف الجمعية بنجاح.');
    }

    public function edit(User $user)
    {
        Gate::authorize('super_admin');
        $associations = Association::all();
        return view('users.edit', compact('user', 'associations'));
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('super_admin');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6',
            'association_id' => 'required|exists:associations,id',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'تم تعديل بيانات الموظف بنجاح.');
    }

    public function destroy(User $user)
    {
        Gate::authorize('super_admin');
        $user->delete();
        return redirect()->route('users.index')->with('success', 'تم حذف الموظف بنجاح.');
    }
}
