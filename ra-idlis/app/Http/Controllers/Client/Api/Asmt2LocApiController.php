<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Asmt2Loc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Asmt2LocApiController extends Controller
{
    public function fetch(Request $request) {
        $asmt2l_id = $request->asmt2l_id;
        $asmt2_loc = Asmt2Loc::where('asmt2l_id', $asmt2l_id)->get();
        return response()->json($asmt2_loc, 200);
    }
}
