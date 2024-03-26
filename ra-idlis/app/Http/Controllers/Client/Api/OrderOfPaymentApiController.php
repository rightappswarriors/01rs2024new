<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\OrderOfPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderOfPaymentApiController extends Controller
{
    public function fetch(Request $request) {
        $oop_id = $request->oop_id;
        $orderofpayment = OrderOfPayment::where('oop_id', $oop_id)->get();
        return response()->json($orderofpayment, 200);
    }
}
