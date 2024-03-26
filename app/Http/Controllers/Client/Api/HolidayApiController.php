<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HolidayApiController extends Controller
{
    public function fetch(Request $request) {
        $hdy_id = $request->hdy_id;
        $holidays = Holiday::where('hdy_id', $hdy_id)->get();
        return response()->json($holidays, 200);
    }
}
