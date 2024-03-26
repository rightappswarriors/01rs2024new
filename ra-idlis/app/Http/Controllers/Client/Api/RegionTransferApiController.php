<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\RegionTransfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionTransferApiController extends Controller
{
    public function fetch(Request $request) {
        $transferid = $request->transferid;
        $region_transfer = RegionTransfer::where('transferid', $transferid)->get();
        return response()->json($region_transfer, 200);
    }
}
