<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\TransStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransStatusApiController extends Controller
{
    public function fetch(Request $request) {
        $trns_id = $request->trns_id;
        $trans_status = TransStatus::where('trns_id', $trns_id)->get();
        return response()->json($trans_status, 200);
    }
}
