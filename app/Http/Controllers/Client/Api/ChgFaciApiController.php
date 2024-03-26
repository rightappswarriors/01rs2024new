<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ChgFaci;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChgFaciApiController extends Controller
{
    public function fetch(Request $request) {
        $applylocid = $request->applylocid;
        $chg_faci = ChgFaci::where('applylocid', $applylocid)->get();
        return response()->json($chg_faci, 200);
    }
}
