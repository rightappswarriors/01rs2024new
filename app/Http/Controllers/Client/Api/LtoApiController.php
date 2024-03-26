<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Lto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LtoApiController extends Controller
{
    public function fetch(Request $request) {
        $LTOno = $request->LTOno;
        $lto = Lto::where('LTOno', $LTOno)->get();
        return response()->json($lto, 200);
    }
}
