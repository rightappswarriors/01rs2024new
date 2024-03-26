<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFSRBannexd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFSRBannexdApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $hfsrbannexd = HFSRBannexd::where('id', $id)->get();
        return response()->json($hfsrbannexd, 200);
    }
}
