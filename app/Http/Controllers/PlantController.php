<?php
namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlantController extends Controller
{

    public function index(Request $request): View
    {
        $query = Plant::where('is_active', true);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('botanical_name', 'LIKE', "%{$searchTerm}%");
            });
        }

        $plants = $query->get()->groupBy('category');

        return view('pages.plants.index', compact('plants'));
    }

    public function category(string $category, Request $request): View
    {
        $validCategories = ['tree', 'shrub', 'groundcover', 'featured'];
        
        if (!in_array($category, $validCategories)) {
            abort(404);
        }

        $title = match ($category) {
            'tree' => 'Trees',
            'shrub' => 'Shrubs',
            'groundcover' => 'Groundcovers',
            'featured' => 'Featured Picks',
        };

        $query = Plant::where('category', $category)->where('is_active', true);

        // Apply backend filter when form is submitted
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('botanical_name', 'LIKE', "%{$searchTerm}%");
            });
        }

        $plants = $query->get();

        return view('pages.plants.category', compact('plants', 'title', 'category'));
    }
}