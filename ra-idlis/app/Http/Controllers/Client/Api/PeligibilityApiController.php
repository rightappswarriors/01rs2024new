<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Peligibility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeligibilityApiController extends Controller
{
    public function fetch(Request $request) {
        $peid = $request->peid;
        $plegibility = Peligibility::where('peid', $peid)->get();
        return response()->json($plegibility, 200);
    }
}
