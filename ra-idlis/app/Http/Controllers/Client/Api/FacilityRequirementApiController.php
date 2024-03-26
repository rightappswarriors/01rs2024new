<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FacilityRequirement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacilityRequirementApiController extends Controller
{
    public function fetch(Request $request) {
        $fr_id = $request->fr_id;
        $facility_requirements = FacilityRequirement::where('fr_id', $fr_id)->get();
        return response()->json($facility_requirements, 200);
    }
}
