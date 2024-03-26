<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAChgFil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAChgFilApiController extends Controller
{
    public function fetch(Request $request) {
        $fda_chgfilid = $request->fda_chgfilid;
        $fda_chgFil = FDAChgFil::where('fda_chgfilid', $fda_chgfilid)->get();
        return response()->json($fda_chgFil, 200);
    }
}
