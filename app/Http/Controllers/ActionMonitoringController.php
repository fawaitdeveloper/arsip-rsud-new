<?php

namespace App\Http\Controllers;

use Binafy\LaravelUserMonitoring\Models\ActionMonitoring;
use Illuminate\Http\Request;

class ActionMonitoringController extends Controller
{
    public function index()
    {
        $actions = ActionMonitoring::query()->latest()->paginate();

        return view('laravel-user-monitoring.actions-monitoring.index', compact('actions'));
    }

    public function destroy(ActionMonitoring $actionMonitoring)
    {
        $actionMonitoring->delete();

        // TODO: Add alert
        return to_route('user-monitoring.actions-monitoring');
    }
}
