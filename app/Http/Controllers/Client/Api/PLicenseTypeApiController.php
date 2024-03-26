<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\PLicenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PLicenseTypeApiController extends Controller
{
    public function fetch(Request $request) {
        $plid = $request->plid;
        $plicensetype = PLicenseType::where('plid', $plid)->get();
        return response()->json($plicensetype, 200);
    }
}
