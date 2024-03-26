<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AppFormMeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppFormMetaApiController extends Controller
{
    public function fetch(Request $request) {
        $appid = $request->appid;
        $appform_meta = AppFormMeta::where('appid', $appid)->get();
        return response()->json($appform_meta, 200);
    }
}
