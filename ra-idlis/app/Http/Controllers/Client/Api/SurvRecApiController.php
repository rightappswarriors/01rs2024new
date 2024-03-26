<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\SurvRec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurvRecApiController extends Controller
{
    public function fetch(Request $request) {
        $rec_id = $request->rec_id;
        $surv_rec = SurvRec::where('rec_id', $rec_id)->get();
        return response()->json($surv_rec, 200);
    }
}
