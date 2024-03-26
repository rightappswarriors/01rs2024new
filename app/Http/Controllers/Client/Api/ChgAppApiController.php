<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ChgApp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChgAppApiController extends Controller
{
    public function fetch(Request $request) {
        $chgapp_id = $request->chgapp_id;
        $chgapp = ChgApp::where('chgapp_id', $chgapp_id)->get();
        return response()->json($chgapp, 200);
    }
}
