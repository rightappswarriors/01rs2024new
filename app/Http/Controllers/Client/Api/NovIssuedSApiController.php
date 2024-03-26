<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\NovIssuedS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NovIssuedSApiController extends Controller
{
    public function fetch(Request $request) {
        $novid = $request->novid;
        $nov_issued_s = NovIssuedS::where('novid', $novid)->get();
        return response()->json($nov_issued_s, 200);
    }
}
