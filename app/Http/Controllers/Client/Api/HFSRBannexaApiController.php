<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFSRBannexa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFSRBannexaApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $hfsrbannexa = HFSRBannexa::where('id', $id)->get();
        return response()->json($hfsrbannexa, 200);
    }
}
