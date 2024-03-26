<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FunCapF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FunCapFApiController extends Controller
{
    public function fetch(Request $request) {
        $funcid = $request->funcid;
        $funcapf = FunCapF::where('funcid', $funcid)->get();
        return response()->json($funcapf, 200);
    }
}
