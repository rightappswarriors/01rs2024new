<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchApiController extends Controller
{
    public function fetch(Request $request) {
        $regionid = $request->regionid;
        $branch = Branch::where('regionid', $regionid)->get();
        return response()->json($branch, 200);
    }
}
