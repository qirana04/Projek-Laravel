<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Disease;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // GET /search?q=aspirin&type=medicine (type optional)
    public function index(Request $request)
    {
        $q = trim($request->query('q',''));
        $type = $request->query('type','any'); // any | medicine | disease

        $results = [
            'medicines' => collect(),
            'diseases' => collect(),
        ];

        if ($q === '') {
            return view('search.results', compact('q','type','results'));
        }

        // search medicines by name or functions or related disease names
        if ($type === 'any' || $type === 'medicine') {
            $medicines = Medicine::where('name', 'like', "%{$q}%")
                ->orWhere('functions', 'like', "%{$q}%")
                ->orWhereHas('diseases', function($q2) use ($q) {
                    $q2->where('name','like', "%{$q}%");
                })
                ->with('diseases')
                ->orderBy('name')
                ->get();

            $results['medicines'] = $medicines;
        }

        // search diseases by name -> return matching disease and its medicines
        if ($type === 'any' || $type === 'disease') {
            $diseases = Disease::where('name', 'like', "%{$q}%")
                ->with('medicines')
                ->orderBy('name')
                ->get();

            $results['diseases'] = $diseases;
        }

        return view('search.results', compact('q','type','results'));
    }
}
