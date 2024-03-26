<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ServChg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServChgApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $serv_chg = ServChg::where('id', $id)->get();
        return response()->json($serv_chg, 200);
    }
}
