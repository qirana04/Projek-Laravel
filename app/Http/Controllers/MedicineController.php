<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Disease;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with('diseases')->orderBy('name')->paginate(15);
        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        $diseases = Disease::orderBy('name')->get();
        return view('medicines.create', compact('diseases'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:medicines,name',
            'description' => 'nullable|string',
            'functions' => 'nullable|string',
            'diseases' => 'nullable|array',
            'diseases.*' => 'nullable|integer|exists:diseases,id',
        ]);

        $medicine = Medicine::create([
            'name' => $request->name,
            'function' => $request->function,
        ]);

        $medicine->diseases()->sync($request->diseases);


        return redirect()->route('medicines.index')->with('success', 'Medicine created.');
    }

    public function show(Medicine $medicine)
    {
        $medicine->load('diseases');
        return view('medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        $diseases = Disease::orderBy('name')->get();
        $medicine->load('diseases');
        return view('medicines.edit', compact('medicine','diseases'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:medicines,name,'.$medicine->id,
            'description' => 'nullable|string',
            'functions' => 'nullable|string',
            'diseases' => 'nullable|array',
            'diseases.*' => 'nullable|integer|exists:diseases,id',
        ]);

        $medicine->update([
            'name' => $request->name,
            'function' => $request->function,
        ]);

        $medicine->diseases()->sync($request->diseases);


        $medicine->update($data);
        $medicine->diseases()->sync($data['diseases'] ?? []);

        return redirect()->route('medicines.index')->with('success', 'Medicine updated.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Medicine deleted.');
    }
}
