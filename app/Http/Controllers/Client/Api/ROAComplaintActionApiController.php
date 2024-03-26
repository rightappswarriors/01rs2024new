<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ROAComplaintAction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ROAComplaintActionApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $roacomplaintactions = ROAComplaintAction::where('id', $id)->get();
        return response()->json($roacomplaintactions, 200);
    }
}
