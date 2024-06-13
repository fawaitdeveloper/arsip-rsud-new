<?php

namespace App\Http\Controllers;

use Binafy\LaravelUserMonitoring\Models\AuthenticationMonitoring;
use Illuminate\Http\Request;

class AuthenticationMonitoringController extends Controller
{
    public function index()
    {
        $authentications = AuthenticationMonitoring::query()->latest()->paginate();

        return view('laravel-user-monitoring.authentications-monitoring.index', compact('authentications'));
    }

    public function destroy(AuthenticationMonitoring $authenticationMonitoring)
    {
        $authenticationMonitoring->delete();

        // TODO: Add alert
        return to_route('user-monitoring.authentications-monitoring');
    }
}
