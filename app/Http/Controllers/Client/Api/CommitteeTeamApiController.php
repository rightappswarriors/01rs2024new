<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CommitteeTeam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommitteeTeamApiController extends Controller
{
    public function fetch(Request $request) {
        $committee = $request->committee;
        $committee_team = CommitteeTeam::where('committee', $committee)->get();
        return response()->json($committee_team, 200);
    }
}
