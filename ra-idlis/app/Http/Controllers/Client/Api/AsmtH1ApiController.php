<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AsmtH1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsmtH1ApiController extends Controller
{
    public function fetch(Request $request) {
        $asmtH1ID = $request->asmtH1ID;
        $asmt_h1 = AsmtH1::where('asmtH1ID', $asmtH1ID)->get();
        return response()->json($asmt_h1, 200);
    }
}