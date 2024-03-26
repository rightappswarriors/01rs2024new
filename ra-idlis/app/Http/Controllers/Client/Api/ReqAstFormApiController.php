<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ReqAstForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReqAstFormApiController extends Controller
{
    public function fetch(Request $request) {
        $ref_no = $request->ref_no;
        $req_ast_form = ReqAstForm::where('ref_no', $ref_no)->get();
        return response()->json($req_ast_form, 200);
    }
}
