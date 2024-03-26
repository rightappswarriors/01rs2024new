<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\PWDHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PWDHistoryApiController extends Controller
{
    public function fetch(Request $request) {
        $ID = $request->ID;
        $pwd_history = PWDHistory::where('ID', $ID)->get();
        return response()->json($pwd_history, 200);
    }
}
