<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FacilityTypUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacilityTypUploadApiController extends Controller
{
    public function fetch(Request $request) {
        $facilitytypUploadid = $request->facilitytypUploadid;
        $facilityTypeUpload = FacilityTypUpload::where('facilitytypUploadid', $facilitytypUploadid)->get();
        return response()->json($facilityTypeUpload, 200);
    }
}
