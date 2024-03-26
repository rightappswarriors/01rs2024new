<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionApiController extends Controller
{
    public function fetch(Request $request) {
        $posid = $request->posid;
        $positions = Position::where('posid', $posid)->get();
        return response()->json($positions, 200);
    }
} 