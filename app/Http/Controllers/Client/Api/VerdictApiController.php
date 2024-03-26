<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Verdict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerdictApiController extends Controller
{
    public function fetch(Request $request) {
        $vid = $request->vid;
        $verdict = Verdict::where('vid', $vid)->get();
        return response()->json($verdict, 200);
    }
}
