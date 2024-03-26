<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\PTrainingsTrainingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PTrainingsTrainingTypeApiController extends Controller
{
    public function fetch(Request $request) {
        $tt_id = $request->tt_id;
        $p_tt_type = PTrainingsTrainingType::where('tt_id', $tt_id)->get();
        return response()->json($p_tt_type, 200);
    }
}
