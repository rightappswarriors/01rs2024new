<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CONHospital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CONHospitalApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $con_hospital = CONHospital::where('id', $id)->get();
        return response()->json($con_hospital, 200);
    }
}
