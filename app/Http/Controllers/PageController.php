<?php
namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Project;
use App\Models\Team;
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
        $projects = Project::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('completed_at', 'desc')
            ->get();

        return view('pages.work', compact('projects'));
    }

    public function areas(): View
    {
        return view('pages.areas');
    }

    public function about(): View
    {
        $teamMembers = Team::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.about', compact('teamMembers'));
    }
}