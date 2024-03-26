<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CdrrHrXrayServCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CdrrHrXrayServCatApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $cdrrhrxrayservcat = CdrrHrXrayServCat::where('id', $id)->get();
        return response()->json($cdrrhrxrayservcat, 200);
    }
}
