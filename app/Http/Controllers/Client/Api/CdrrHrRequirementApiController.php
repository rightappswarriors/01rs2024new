<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CdrrHrRequirement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CdrrHrRequirementApiController extends Controller
{
    public function fetch(Request $request) {
        $reqID = $request->reqID;
        $cdrrhrrequirements = CdrrHrRequirement::where('reqID', $reqID)->get();
        return response()->json($cdrrhrrequirements, 200);
    }
}
