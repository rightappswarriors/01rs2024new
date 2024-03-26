<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\MonTeam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonTeamApiController extends Controller
{
    public function fetch(Request $request) {
        $montid = $request->montid;
        $mon_team = MonTeam::where('montid', $montid)->get();
        return response()->json($mon_team, 200);
    }
}
