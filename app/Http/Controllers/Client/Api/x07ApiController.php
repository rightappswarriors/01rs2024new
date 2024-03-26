<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\x07;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class x07ApiController extends Controller
{
    public function fetch(Request $request) {
        $grp_id = $request->grp_id;
        $x07 = x07::where('grp_id', $grp_id)->get();
        return response()->json($x07, 200);
    }
}
