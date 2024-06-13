<?php

namespace App\Http\Controllers;

use Binafy\LaravelUserMonitoring\Models\VisitMonitoring;
use Illuminate\Http\Request;

class VisitMonitoringController extends Controller
{
    public function index()
    {
        $visits = VisitMonitoring::query()->latest()->paginate();

        return view('laravel-user-monitoring.visits-monitoring.index', compact('visits'));
    }

    public function destroy(int $id)
    {
        VisitMonitoring::query()->findOrFail($id)->delete();

        // TODO: Add alert
        return to_route('user-monitoring.visits-monitoring');
    }
}
