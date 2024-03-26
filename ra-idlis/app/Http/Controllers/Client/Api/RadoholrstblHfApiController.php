<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\RadoholrstblHf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RadoholrstblHfApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $radoholrstbl_hf = RadoholrstblHf::where('id', $id)->get();
        return response()->json($radoholrstbl_hf, 200);
    }
}
