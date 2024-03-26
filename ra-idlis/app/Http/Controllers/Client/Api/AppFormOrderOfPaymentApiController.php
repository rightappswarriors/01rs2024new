<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AppFormOrderOfPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppFormOrderOfPaymentApiController extends Controller
{
    public function fetch() {
        $appform_orderofpayment = AppFormOrderOfPayment::get();
        return response()->json($appform_orderofpayment, 200);
    }
}
