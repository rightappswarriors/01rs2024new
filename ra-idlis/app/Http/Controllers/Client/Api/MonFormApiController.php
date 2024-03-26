<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\MonForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonFormApiController extends Controller
{
    public function fetch(Request $request) {
        $monid = $request->monid;
        $mon_form = MonForm::where('monid', $monid)->get();
        return response()->json($mon_form, 200);
    }
}
