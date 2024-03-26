<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CdrrHrXrayList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CdrrHrXrayListApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $cdrrhrxraylist = CdrrHrXrayList::where('id', $id)->get();
        return response()->json($cdrrhrxraylist, 200);
    }
}
