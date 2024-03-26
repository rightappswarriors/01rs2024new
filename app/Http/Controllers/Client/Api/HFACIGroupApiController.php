<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\HFACIGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HFACIGroupApiController extends Controller
{
    public function fetch(Request $request) {
        $hgpid = $request->hgpid;
        $hfaci_grp = HFACIGroup::where('hgpid', $hgpid)->get();
        return response()->json($hfaci_grp, 200);
    }
}
