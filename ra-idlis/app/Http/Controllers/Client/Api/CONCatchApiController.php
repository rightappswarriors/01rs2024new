<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CONCatch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CONCatchApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $con_catch = CONCatch::where('id', $id)->get();
        return response()->json($con_catch, 200);
    }
}
