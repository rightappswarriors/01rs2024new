<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Asmt2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Asmt2ApiController extends Controller
{
    public function fetch(Request $request) {
        $asmt2_id = $request->asmt2_id;
        $asmt2 = Asmt2::where('asmt2_id', $asmt2_id)->get();
        return response()->json($asmt2, 200);
    }
}
