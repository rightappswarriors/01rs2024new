<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CONEvaluate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CONEvaluateApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $con_evaluate = CONEvaluate::where('id', $id)->get();
        return response()->json($con_evaluate, 200);
    }
}
