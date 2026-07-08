<?php

namespace App\Http\Controllers;

use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvent = Event::count();

        $recentEvents = Event::latest()
                            ->take(5)
                            ->get();

        return view('dashboard', compact(
            'totalEvent',
            'recentEvents'
        ));
    }
}