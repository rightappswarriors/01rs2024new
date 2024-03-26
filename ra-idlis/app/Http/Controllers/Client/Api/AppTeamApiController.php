<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AppTeam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppTeamApiController extends Controller
{
    public function fetch(Request $request) {
        $apptid = $request->apptid;
        $app_team = AppTeam::where('apptid', $apptid)->get();
        return response()->json($app_team, 200);
    }
}
