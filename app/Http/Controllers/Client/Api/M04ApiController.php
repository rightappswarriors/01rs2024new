<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\M04;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class M04ApiController extends Controller
{
    public function fetch(Request $request) {
        $m04IDA = $request->m04IDA;
        $m04 = M04::where('m04IDA', $m04IDA)->get();
        return response()->json($m04, 200);
    }
}
