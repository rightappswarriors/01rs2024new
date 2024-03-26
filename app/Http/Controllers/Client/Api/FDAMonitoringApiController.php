<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAMonitoring;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAMonitoringApiController extends Controller
{
    public function fetch(Request $request) {
        $fdamon = $request->fdamon;
        $fda_mon = FDAMonitoring::where('fdamon', $fdamon)->get();
        return response()->json($fda_mon, 200);
    }
}
