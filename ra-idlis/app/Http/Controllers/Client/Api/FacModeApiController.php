<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FacMode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacModeApiController extends Controller
{
    public function fetch(Request $request) {
        $facmid = $request->facmid;
        $fac_mode = FacMode::where('facmid', $facmid)->get();
        return response()->json($fac_mode, 200);
    }
}
