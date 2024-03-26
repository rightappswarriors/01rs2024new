<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ModeOfPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModeOfPaymentApiController extends Controller
{
    public function fetch(Request $request) {
        $mop_code = $request->mop_code;
        $modeofpayment = ModeOfPayment::where('mop_code', $mop_code)->get();
        return response()->json($modeofpayment, 200);
    }
}
