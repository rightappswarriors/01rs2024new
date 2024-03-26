<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ReAssessHist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReAssessHistApiController extends Controller
{
    public function fetch(Request $request) {
        $reassess_histid = $request->reassess_histid;
        $reassess_hist = ReAssessHist::where('reassess_histid', $reassess_histid)->get();
        return response()->json($reassess_hist, 200);
    }
}
