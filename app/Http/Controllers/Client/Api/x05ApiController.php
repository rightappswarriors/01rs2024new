<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\x05;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class x05ApiController extends Controller
{
    public function fetch(Request $request) {
        $mod_id = $request->mod_id;
        $x05 = x05::where('mod_id', $mod_id)->get();
        return response()->json($x05, 200);
    }
}
