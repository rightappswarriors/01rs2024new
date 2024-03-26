<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\SurvTeam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurvTeamApiController extends Controller
{
    public function fetch(Request $request) {
        $montid = $request->montid;
        $surv_team = SurvTeam::where('montid', $montid)->get();
        return response()->json($surv_team, 200);
    }
}
