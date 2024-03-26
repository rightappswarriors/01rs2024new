<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAPharmacyCharges;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAPharmacyChargesApiController extends Controller
{
    public function fetch(Request $request) {
        $chargeID = $request->chargeID;
        $fda_pharmaCharges = FDAPharmacyCharges::where('chargeID', $chargeID)->get();
        return response()->json($fda_pharmaCharges, 200);
    }
}
