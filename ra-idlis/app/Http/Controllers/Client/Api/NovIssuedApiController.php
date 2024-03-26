<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\NovIssued;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NovIssuedApiController extends Controller
{
    public function fetch(Request $request) {
        $novid = $request->novid;
        $nov_issued = NovIssued::where('novid', $novid)->get();
        return response()->json($nov_issued, 200);
    }
}
