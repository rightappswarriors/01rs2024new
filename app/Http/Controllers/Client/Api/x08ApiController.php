<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\x08;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class x08ApiController extends Controller
{
    public function fetch(Request $request) {
        $uid = $request->uid;
        $x08 = x08::where('uid', $uid)->get();
        return response()->json($x08, 200);
    }
}
