<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\MonTeamMembers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonTeamMembersApiController extends Controller
{
    public function fetch(Request $request) {
        $montmemberid = $request->montmemberid;
        $mon_team_members = MonTeamMembers::where('montmemberid', $montmemberid)->get();
        return response()->json($mon_team_members, 200);
    }
}
