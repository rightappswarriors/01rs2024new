<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Assessed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessedApiController extends Controller
{
    public function fetch(Request $request) {
        $assessedID = $request->assessedID;
        $assessed = Assessed::where('assessedID', $assessedID)->get();
        return response()->json($assessed, 200);
    }
}
