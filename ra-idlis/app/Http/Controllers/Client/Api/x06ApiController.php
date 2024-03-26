<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\x06;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class x06ApiController extends Controller
{
    public function fetch(Request $request) {
        $x06_id = $request->x06_id;
        $x06 = x06::where('x06_id', $x06_id)->get();
        return response()->json($x06, 200);
    }
}
