<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\PWork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PWorkApiController extends Controller
{
    public function fetch(Request $request) {
        $pworkid = $request->pworkid;
        $p_work = PWork::where('pworkid', $pworkid)->get();
        return response()->json($p_work, 200);
    }
}
