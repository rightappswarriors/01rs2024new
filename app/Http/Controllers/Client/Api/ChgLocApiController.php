<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ChgLoc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChgLocApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $chg_loc = ChgLoc::where('id', $id)->get();
        return response()->json($chg_loc, 200);
    }
}
