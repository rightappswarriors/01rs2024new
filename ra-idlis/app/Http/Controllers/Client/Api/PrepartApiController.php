<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Prepart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrepartApiController extends Controller
{
    public function fetch(Request $request) {
        $partid = $request->partid;
        $prepart = Prepart::where('partid', $partid)->get();
        return response()->json($prepart, 200);
    }
}
