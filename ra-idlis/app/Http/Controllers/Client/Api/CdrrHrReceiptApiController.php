<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CdrrHrReceipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CdrrHrReceiptApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $cdrrhrreceipt = CdrrHrReceipt::where('id', $id)->get();
        return response()->json($cdrrhrreceipt, 200);
    }
}
