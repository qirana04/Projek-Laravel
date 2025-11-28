<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiseaseController extends Controller
{
    public function index()
    {
        $diseases = Disease::withCount('medicines')->orderBy('name')->paginate(20);
        return view('diseases.index', compact('diseases'));
    }

    public function create()
    {
        return view('diseases.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:diseases,name',
        ]);
        $data['slug'] = Str::slug($data['name']);
        Disease::create($data);
        return redirect()->route('diseases.index')->with('success','Disease created.');
    }

    public function edit(Disease $disease)
    {
        return view('diseases.edit', compact('disease'));
    }

    public function update(Request $request, Disease $disease)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:diseases,name,'.$disease->id,
        ]);
        $data['slug'] = Str::slug($data['name']);
        $disease->update($data);
        return redirect()->route('diseases.index')->with('success','Disease updated.');
    }

    public function destroy(Disease $disease)
    {
        $disease->delete();
        return redirect()->route('diseases.index')->with('success','Disease deleted.');
    }
}
