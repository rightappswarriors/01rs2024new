<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFSRBannexi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFSRBannexiApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $hfsrbannexi = HFSRBannexi::where('id', $id)->get();
        return response()->json($hfsrbannexi, 200);
    }
}
