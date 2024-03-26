<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ChgApplyTo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChgApplyToApiController extends Controller
{
    public function fetch(Request $request) {
        $applytoid = $request->applytoid;
        $chg_applyto = ChgApplyTo::where('applytoid', $applytoid)->get();
        return response()->json($chg_applyto, 200);
    }
}
