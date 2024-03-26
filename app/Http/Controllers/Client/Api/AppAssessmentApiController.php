<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AppAssessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppAssessmentApiController extends Controller
{
    public function fetch(Request $request) {
        $app_assess_id = $request->app_assess_id;
        $app_assessment = AppAssessment::where('app_assess_id', $app_assess_id)->get();
        return response()->json($app_assessment, 200);
    }
}
