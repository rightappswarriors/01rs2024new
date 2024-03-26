<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Barangay;
use Illuminate\Http\Request;

class BarangayApiController extends Controller {
    
    public function fetch(Request $request) {
        $cmid = $request->cmid;
        $barangay = Barangay::where('cmid', $cmid)->get();
        return response()->json($barangay, 200);
    }
}