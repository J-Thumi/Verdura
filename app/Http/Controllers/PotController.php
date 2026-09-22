<?php

namespace App\Http\Controllers;

use App\Models\Pot;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PotController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pot::with('images');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('material', 'LIKE', "%{$searchTerm}%");
            });
        }

        switch ($request->get('sort')) {
            case 'name_asc': $query->orderBy('name', 'asc'); break;
            case 'name_desc': $query->orderBy('name', 'desc'); break;
            case 'price_asc': $query->orderBy('price', 'asc'); break;
            case 'price_desc': $query->orderBy('price', 'desc'); break;
            case 'latest': $query->latest(); break;
            default: $query->latest(); break;
        }

        $pots = $query->paginate(12)->withQueryString();

        return view('pages.pots.index', compact('pots'));
    }

    public function show(Pot $pot): View
    {
        $pot->load('images');

        // Fetch related pots for recommendations
        $relatedPots = Pot::with('images')
            ->where('id', '!=', $pot->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.pots.show', compact('pot', 'relatedPots'));
    }
}