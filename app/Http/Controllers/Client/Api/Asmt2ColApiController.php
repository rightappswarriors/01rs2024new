<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Asmt2Col;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Asmt2ColApiController extends Controller
{
    public function fetch(Request $request) {
        $asmt2c_id = $request->asmt2c_id;
        $asmt2_col = Asmt2Col::where('asmt2c_id', $asmt2c_id)->get();
        return response()->json($asmt2_col, 200);
    }
}
