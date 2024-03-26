<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AssessedPtc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessedPtcApiController extends Controller
{
    public function fetch(Request $request) {
        $assessedID = $request->assessedID;
        $assessed_ptc = AssessedPtc::where('assessedID', $assessedID)->get();
        return response()->json($assessed_ptc, 200);
    }
}
