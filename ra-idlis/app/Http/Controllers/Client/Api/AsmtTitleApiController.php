<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AsmtTitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsmtTitleApiController extends Controller
{
    public function fetch(Request $request) {
        $title_code = $request->title_code;
        $asmt_title = AsmtTitle::where('title_code', $title_code)->get();
        return response()->json($asmt_title, 200);
    }
}
