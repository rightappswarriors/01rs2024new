<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FacAssessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacAssessmentApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $facassessment = FacAssessment::where('id', $id)->get();
        return response()->json($facassessment, 200);
    }
}
