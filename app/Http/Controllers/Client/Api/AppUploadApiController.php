<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AppUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppUploadApiController extends Controller
{
    public function fetch(Request $request) {
        $apup_id = $request->apup_id;
        $app_upload = AppUpload::where('apup_id', $apup_id)->get();
        return response()->json($app_upload, 200);
    }

}
