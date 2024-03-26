<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\RadoholrstblCtnt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RadoholrstblCtntApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $radoholrstbl_ctnt = RadoholrstblCtnt::where('id', $id)->get();
        return response()->json($radoholrstbl_ctnt, 200);
    }
}
