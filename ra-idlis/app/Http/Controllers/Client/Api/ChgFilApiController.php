<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ChgFil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChgFilApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $chgfil = ChgFil::where('id', $id)->get();
        return response()->json($chgfil, 200);
    }
}
