<?php
// app/Http/Controllers/PotController.php
namespace App\Http\Controllers;

use App\Models\Pot;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PotController extends Controller
{
    public function index(Request $request): View
{
    $query = Pot::with('images');

    // Apply Search Filter
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('material', 'LIKE', "%{$searchTerm}%")
              ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        });
    }

    // Apply Sorting Options
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
            $query->orderBy('name', 'asc');
            break;
    }

    // Paginate results (12 per page) and preserve GET query params
    $pots = $query->paginate(12)->withQueryString();

    return view('pages.pots', compact('pots'));
}
}