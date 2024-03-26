<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAXrayCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAXrayCatApiController extends Controller
{
    public function fetch(Request $request) {
        $catid = $request->catid;
        $fda_xrayCat = FDAXrayCat::where('catid', $catid)->get();
        return response()->json($fda_xrayCat, 200);
    }
}
