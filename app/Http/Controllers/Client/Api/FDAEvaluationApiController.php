<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAEvaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAEvaluationApiController extends Controller
{
    public function fetch(Request $request) {
        $evalid = $request->evalid;
        $fdaevaluation = FDAEvaluation::where('evalid', $evalid)->get();
        return response()->json($fdaevaluation, 200);
    }
}
