<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFSRBannexc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFSRBannexcApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $hfsrbannexc = HFSRBannexc::where('id', $id)->get();
        return response()->json($hfsrbannexc, 200);
    }
}
