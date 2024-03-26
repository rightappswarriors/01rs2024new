<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssessmentCombinedDuplicate;

class AssessmentCombinedDuplicateApiController extends Controller
{
    public function fetch(Request $request) {
        $dupID = $request->dupID;
        $assessmentC_duplicate = AssessmentCombinedDuplicate::where('dupID', $dupID)->get();
        return response()->json($assessmentC_duplicate, 200);
    }
}
