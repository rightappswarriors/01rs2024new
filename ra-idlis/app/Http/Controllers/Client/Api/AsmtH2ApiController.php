<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AsmtH2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsmtH2ApiController extends Controller
{
    public function fetch(Request $request) {
        $asmtH2ID = $request->asmtH2ID;
        $asmt_h2 = AsmtH2::where('asmtH2ID', $asmtH2ID)->get();
        return response()->json($asmt_h2, 200);
    }
}
