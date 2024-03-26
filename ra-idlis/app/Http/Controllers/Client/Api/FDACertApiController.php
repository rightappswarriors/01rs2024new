<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDACert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDACertApiController extends Controller
{
    public function fetch(Request $request) {
        $certid = $request->certid;
        $fdacert = FDACert::where('certid', $certid)->get();
        return response()->json($fdacert, 200);
    }
}
