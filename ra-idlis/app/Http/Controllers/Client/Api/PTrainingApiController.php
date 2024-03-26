<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\PTraining;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PTrainingApiController extends Controller
{
    public function fetch(Request $request) {
        $ptid = $request->ptid;
        $ptraining = PTraining::where('ptid', $ptid)->get();
        return response()->json($ptraining, 200);
    }
}
