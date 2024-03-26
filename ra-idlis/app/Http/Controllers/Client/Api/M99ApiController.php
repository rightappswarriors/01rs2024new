<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\M99;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class M99ApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $m99 = M99::where('id', $id)->get();
        return response()->json($m99, 200);
    }
}
