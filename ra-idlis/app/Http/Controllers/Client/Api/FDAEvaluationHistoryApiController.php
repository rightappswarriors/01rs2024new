<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAEvaluationHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAEvaluationHistoryApiController extends Controller
{
    public function fetch(Request $request) {
        $fdaevaluationhistoryID = $request->fdaevaluationhistoryID;
        $fda_eval_history = FDAEvaluationHistory::where('fdaevaluationhistoryID', $fdaevaluationhistoryID)->get();
        return response()->json($fda_eval_history, 200);
    }
}
