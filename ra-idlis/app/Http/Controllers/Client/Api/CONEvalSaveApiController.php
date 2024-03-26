<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CONEvalSave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CONEvalSaveApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $con_evalsave = CONEvalSave::where('id', $id)->get();
        return response()->json($con_evalsave, 200);
    }
}
