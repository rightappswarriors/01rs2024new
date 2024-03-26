<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFACIServType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFACIServTypeApiController extends Controller
{
    public function fetch(Request $request) {
        $hfser_id = $request->hfser_id;
        $hfaci_serv_type = HFACIServType::where('hfser_id', $hfser_id)->get();
        return response()->json($hfaci_serv_type, 200);
    }
}
