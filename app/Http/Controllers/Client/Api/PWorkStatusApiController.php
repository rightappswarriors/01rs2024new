<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\PWorkStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PWorkStatusApiController extends Controller
{
    public function fetch(Request $request) {
        $pworksid = $request->pworksid;
        $p_work_status = PWorkStatus::where('pworksid', $pworksid)->get();
        return response()->json($p_work_status, 200);
    }
}
