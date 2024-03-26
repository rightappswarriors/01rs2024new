<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\RadoholrstblHdr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RadoholrstblHdrApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $radoholrstbl_hdr = RadoholrstblHdr::where('id', $id)->get();
        return response()->json($radoholrstbl_hdr, 200);
    }
}