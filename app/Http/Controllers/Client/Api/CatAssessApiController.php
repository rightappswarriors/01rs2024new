<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CatAssess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatAssessApiController extends Controller
{
    public function fetch(Request $request) {
        $caid = $request->caid;
        $cat_assess = CatAssess::where('caid', $caid)->get();
        return response()->json($cat_assess, 200);
    }
}
