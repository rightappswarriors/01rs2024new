<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Licensed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicensedApiController extends Controller
{
    public function fetch(Request $request) {
        $licensenumber = $request->licensenumber;
        $licensed = Licensed::where('licensenumber', $licensenumber)->get();
        return response()->json($licensed, 200);
    }
}
