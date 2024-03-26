<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\TechnicalFindingsHist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TechnicalFindingsHistApiController extends Controller
{
    public function fetch(Request $request) {
        $transid = $request->transid;
        $cechnical_findings_hist = TechnicalFindingsHist::where('transid', $transid)->get();
        return response()->json($cechnical_findings_hist, 200);
    }
}
