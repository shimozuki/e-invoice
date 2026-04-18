<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Binafy\LaravelUserMonitoring\Models\ActionMonitoring;

class LogActivityController extends Controller
{
    public function index()
    {
        $items = ActionMonitoring::with('user')
            ->latest()
            ->paginate(10);

        return view('pages.log-activity.index', compact('items'));
    }
}
