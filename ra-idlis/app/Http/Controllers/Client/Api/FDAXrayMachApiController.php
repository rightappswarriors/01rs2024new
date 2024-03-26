<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAXrayMach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAXrayMachApiController extends Controller
{
    public function fetch(Request $request) {
        $xrayid = $request->xrayid;
        $fda_xray_mach = FDAXrayMach::where('xrayid', $xrayid)->get();
        return response()->json($fda_xray_mach, 200);
    }
}
