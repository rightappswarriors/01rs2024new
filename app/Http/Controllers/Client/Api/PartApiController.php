<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Part;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartApiController extends Controller
{
    public function fetch(Request $request) {
        $partid = $request->partid;
        $part = Part::where('partid', $partid)->get();
        return response()->json($part, 200);
    }
}
