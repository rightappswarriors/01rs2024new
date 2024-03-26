<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFERCTeam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFERCTeamApiController extends Controller
{
    public function fetch(Request $request) {
        $hfercid = $request->hfercid;
        $hferc_team = HFERCTeam::where('hfercid', $hfercid)->get();
        return response()->json($hferc_team, 200);
    }
}
