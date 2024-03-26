<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AsmtH3;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsmtH3ApiController extends Controller
{
    public function fetch(Request $request) {
        $asmtH3ID = $request->asmtH3ID;
        $asmt_h3 = AsmtH3::where('asmtH3ID', $asmtH3ID)->get();
        return response()->json($asmt_h3, 200);
    }
}
