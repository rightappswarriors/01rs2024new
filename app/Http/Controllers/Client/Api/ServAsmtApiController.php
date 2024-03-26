<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ServAsmt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServAsmtApiController extends Controller
{
    public function fetch(Request $request) {
        $srvasmt_id = $request->srvasmt_id;
        $serv_asmt = ServAsmt::where('srvasmt_id', $srvasmt_id)->get();
        return response()->json($serv_asmt, 200);
    }
}
