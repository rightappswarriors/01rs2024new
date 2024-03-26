<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFSRBannexh;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFSRBannexhApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $hfsrBannexh = HFSRBannexh::where('id', $id)->get();
        return response()->json($hfsrBannexh, 200);
    }
}
