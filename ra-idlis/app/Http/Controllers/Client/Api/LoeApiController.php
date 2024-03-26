<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Loe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoeApiController extends Controller
{
    public function fetch(Request $request) {
        $loeid = $request->loeid;
        $leo = Loe::where('loeid', $loeid)->get();
        return response()->json($leo, 200);
    }
}
