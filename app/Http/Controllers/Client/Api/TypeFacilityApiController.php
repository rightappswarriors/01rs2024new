<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\TypeFacility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeFacilityApiController extends Controller
{
    public function fetch(Request $request) {
        $tyf_id = $request->tyf_id;
        $type_facility = TypeFacility::where('tyf_id', $tyf_id)->get();
        return response()->json($type_facility, 200);
    }
}
