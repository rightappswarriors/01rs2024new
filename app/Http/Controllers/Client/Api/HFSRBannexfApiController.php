<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFSRBannexf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFSRBannexfApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $hfsrbannexf = HFSRBannexf::where('id', $id)->get();
        return response()->json($hfsrbannexf, 200);
    }
}
