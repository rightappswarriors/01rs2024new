<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AssessmentRecommendation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentRecommendationApiController extends Controller
{
    public function fetch(Request $request) {
        $reco = $request->reco;
        $recommendation = AssessmentRecommendation::where('reco', $reco)->get();
        return response()->json($recommendation, 200);
    }
}
