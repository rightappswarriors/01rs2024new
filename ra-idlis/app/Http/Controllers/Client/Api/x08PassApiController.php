<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\x08Pass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class x08PassApiController extends Controller
{
    public function fetch(Request $request) {
        $x08p_id = $request->x08p_id;
        $x08_pass = x08Pass::where('x08p_id', $x08p_id)->get();
        return response()->json($x08_pass, 200);
    }
}
