<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAXrayServ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAXrayServApiController extends Controller
{
    public function fetch(Request $request) {
        $servid = $request->servid;
        $fda_xray_serv = FDAXrayServ::where('servid', $servid)->get();
        return response()->json($fda_xray_serv, 200);
    }
}
