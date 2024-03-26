<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFSRBannexb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFSRBannexbApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $hfsrbannexb = HFSRBannexb::where('id', $id)->get();
        return response()->json($hfsrbannexb, 200);
    }
}
