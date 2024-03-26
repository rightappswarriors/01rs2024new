<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\XrayFacility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class XrayFacilityApiController extends Controller
{
    public function fetch(Request $request) {
        $code = $request->code;
        $xrayfacility = XrayFacility::where('code', $code)->get();
        return response()->json($xrayfacility, 200);
    }
}
