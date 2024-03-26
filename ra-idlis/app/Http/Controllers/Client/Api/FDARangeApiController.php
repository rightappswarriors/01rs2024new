<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDARange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDARangeApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $fda_range = FDARange::where('id', $id)->get();
        return response()->json($fda_range, 200);
    }
}
