<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Classification;
use Illuminate\Http\Request;

class ClassificationApiController extends Controller {
    public function fetch(Request $request) {
        $ocid = $request->ocid;
        $classid = $request->classid ? $request->classid : null;
        $classification = Classification::where('ocid', $ocid)->where('isSub', $classid)->get();
        return response()->json($classification, 200);
    }
}