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

        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                ->orWhere('botanical_name', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Apply sorting options
        switch ($request->get('sort')) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
                $query->latest();
                break;
            default:
                $query->orderBy('name', 'asc')->orderBy('name', 'asc');
                break;
        }

        $plants = $query->paginate(12)->withQueryString();

        return view('pages.plants.category', compact('plants', 'title', 'category'));
    }
}