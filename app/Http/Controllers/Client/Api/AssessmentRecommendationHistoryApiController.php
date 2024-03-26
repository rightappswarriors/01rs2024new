<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AssessmentRecommendationHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentRecommendationHistoryApiController extends Controller
{
    public function fetch(Request $request) {
        $recohistid = $request->recohistid;
        $recommendation_hist = AssessmentRecommendationHistory::where('recohistid', $recohistid)->get();
        return response()->json($recommendation_hist, 200);
    }
}
