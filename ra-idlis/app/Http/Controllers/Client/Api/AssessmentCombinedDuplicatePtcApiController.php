<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AssessmentCombinedDuplicatePtc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentCombinedDuplicatePtcApiController extends Controller
{
    public function fetch(Request $request) {
        $dupID = $request->dupID;
        $assessmentC_dupliatePtc = AssessmentCombinedDuplicatePtc::where('dupID', $dupID)->get();
        return response()->json($assessmentC_dupliatePtc, 200);
    }
}
