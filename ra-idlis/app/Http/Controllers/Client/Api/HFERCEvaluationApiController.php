<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFERCEvaluation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFERCEvaluationApiController extends Controller
{
    public function fetch(Request $request) {
        $hfercEvalId = $request->hfercEvalId;
        $hferc_evaluation = HFERCEvaluation::where('hfercEvalId', $hfercEvalId)->get();
        return response()->json($hferc_evaluation, 200);
    }
}
