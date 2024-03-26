<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamApiController extends Controller
{
    public function fetch(Request $request) {
        $teamid = $request->teamid;
        $team = Team::where('teamid', $teamid)->get();
        return response()->json($team, 200);
    }
}
