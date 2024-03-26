<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\SurvTeamMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurvTeamMemberApiController extends Controller
{
    public function fetch(Request $request) {
        $montmemberid = $request->montmemberid;
        $surv_team_members = SurvTeamMember::where('montmemberid', $montmemberid)->get();
        return response()->json($surv_team_members, 200);
    }
}
