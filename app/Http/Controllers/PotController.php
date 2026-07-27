<?php
// app/Http/Controllers/PotController.php
namespace App\Http\Controllers;

use App\Models\Pot;
use Illuminate\View\View;

class PotController extends Controller
{
    public function index(): View
    {
        $pots = Pot::with('images')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('pots', compact('pots'));
    }
}