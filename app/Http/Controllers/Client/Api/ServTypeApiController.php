<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ServType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServTypeApiController extends Controller
{
    public function fetch(Request $request) {
        $servtype_id = $request->servtype_id;
        $serv_type = ServType::where('servtype_id', $servtype_id)->get();
        return response()->json($serv_type, 200);
    }
}
