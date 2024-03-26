<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFACICustomOne;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFACICustomOneApiController extends Controller
{
    public function fetch(Request $request) {
        $hcus_id = $request->hcus_id;
        $hfaci_cus_one = HFACICustomOne::where('hcus_id', $hcus_id)->get();
        return response()->json($hfaci_cus_one, 200);
    }
}
