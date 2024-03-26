<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentApiController extends Controller
{
    public function fetch(Request $request) {
        $asmt_id = $request->asmt_id;
        $assessment = Assessment::where('asmt_id', $asmt_id)->get();
        return response()->json($assessment, 200);
    }
}
