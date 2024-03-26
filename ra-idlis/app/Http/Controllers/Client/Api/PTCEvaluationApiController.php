<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\PTCEvaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PTCEvaluationApiController extends Controller
{
    public function fetch(Request $request) {
        $app_eval_id = $request->app_eval_id;
        $ptc_eval = PTCEvaluation::where('app_eval_id', $app_eval_id)->get();
        return response()->json($ptc_eval, 200);
    }
}
