<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Charge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChargeApiController extends Controller
{
    public function fetch() {
        $charge = Charge::get();
        return response()->json($charge, 200);
    }
}
