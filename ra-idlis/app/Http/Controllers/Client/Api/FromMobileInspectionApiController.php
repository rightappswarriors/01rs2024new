<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FromMobileInspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FromMobileInspectionApiController extends Controller
{
    public function fetch(Request $request) {
        $inspectID = $request->inspectID;
        $mob_inspec = FromMobileInspection::where('inspectID', $inspectID)->get();
        return response()->json($mob_inspec, 200);
    }
}
