<?php
namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $featuredSpecimen = Plant::where('is_featured', true)->where('is_active', true)->first();
        return view('pages.home', compact('featuredSpecimen'));
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function work(): View
    {
        return view('pages.work');
    }

    public function areas(): View
    {
        return view('pages.areas');
    }

    public function about(): View
    {
        return view('pages.about');
    }
}