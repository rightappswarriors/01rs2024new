<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CdrrReceipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CdrrReceiptApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->cmid;
        $cdrr_receipt = CdrrReceipt::where('id', $id)->get();
        return response()->json($cdrr_receipt, 200);
    }
}
