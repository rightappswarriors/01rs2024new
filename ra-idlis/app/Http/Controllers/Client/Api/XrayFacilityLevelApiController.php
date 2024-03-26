<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\XrayFacilityLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class XrayFacilityLevelApiController extends Controller
{
    public function fetch(Request $request) {
        $codelevel = $request->codelevel;
        $arayfacilitylevel = XrayFacilityLevel::where('codelevel', $codelevel)->get();
        return response()->json($arayfacilitylevel, 200);
    }
}
