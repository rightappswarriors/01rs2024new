<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FACLGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FACLGroupApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $facl_grp = FACLGroup::where('id', $id)->get();
        return response()->json($facl_grp, 200);
    }
}
