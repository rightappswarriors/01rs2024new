<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ForAmbulance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForAmbulanceApiController extends Controller
{
    public function fetch(Request $request) {
        $ambid = $request->ambid;
        $forambulance = ForAmbulance::where('ambid', $ambid)->get();
        return response()->json($forambulance, 200);
    }
}
