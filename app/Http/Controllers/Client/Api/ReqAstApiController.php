<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ReqAst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReqAstApiController extends Controller
{
    public function fetch(Request $request) {
        $rq_id = $request->rq_id;
        $req_ast = ReqAst::where('rq_id', $rq_id)->get();
        return response()->json($req_ast, 200);
    }
}
