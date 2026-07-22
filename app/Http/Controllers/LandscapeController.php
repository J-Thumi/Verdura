<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LandscapeController extends Controller
{
    public function index(): View
    {
        $featuredSpecimen = Cache::remember('featured_specimen', 2, function () {
            return Plant::active()->where('is_featured', true)->first();
        });

        // Retrieve raw items or collection, then group afterwards
        $allPlants = Cache::remember('all_active_plants', 2, function () {
            return Plant::active()
                ->select(['id', 'name', 'botanical_name', 'category', 'description', 'price', 'image_url'])
                ->get();
        });

        // Grouping after cache retrieval ensures $plants behaves as a valid standard Eloquent Collection
        $plants = $allPlants->groupBy('category');

        return view('home', compact('featuredSpecimen', 'plants'));
    }
}