<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AssessmentCombined;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentCombinedApiController extends Controller
{
    public function fetch(Request $request) {
        $asmtComb = $request->asmtComb;
        $assessmentcombined = AssessmentCombined::where('asmtComb', $asmtComb)->get();
        return response()->json($assessmentcombined, 200);
    }
}
