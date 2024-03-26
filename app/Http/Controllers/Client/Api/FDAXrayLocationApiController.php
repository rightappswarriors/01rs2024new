<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAXrayLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAXrayLocationApiController extends Controller
{
    public function fetch(Request $request) {
        $locid = $request->locid;
        $fda_xray_loc = FDAXrayLocation::where('locid', $locid)->get();
        return response()->json($fda_xray_loc, 200);
    }
}
