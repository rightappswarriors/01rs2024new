<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceApiController extends Controller {
    public function fetch(Request $request) {
        $rgnid = $request->rgnid;
        $provinces = Province::where('rgnid', $rgnid)->get();
        return response()->json($provinces, 200);
    }
}