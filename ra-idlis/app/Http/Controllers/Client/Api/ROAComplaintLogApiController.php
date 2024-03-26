<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ROAComplaintLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ROAComplaintLogApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $roacomplaintlog = ROAComplaintLog::where('id', $id)->get();
        return response()->json($roacomplaintlog, 200);
    }
}
