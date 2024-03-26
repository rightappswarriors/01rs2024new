<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FacOOP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacOOPApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $facoop = FacOOP::where('id', $id)->get();
        return response()->json($facoop, 200);
    }
}
