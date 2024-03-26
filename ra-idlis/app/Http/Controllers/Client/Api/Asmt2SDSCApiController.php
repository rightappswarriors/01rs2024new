<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Asmt2SDSC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Asmt2SDSCApiController extends Controller
{
    public function fetch(Request $request) {
        $asmt2sd_id = $request->asmt2sd_id;
        $asmt2_sdsc = Asmt2SDSC::where('asmt2sd_id', $asmt2sd_id)->get();
        return response()->json($asmt2_sdsc, 200);
    }
}
