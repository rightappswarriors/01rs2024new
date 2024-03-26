<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadApiController extends Controller
{
    public function fetch(Request $request) {
        $upid = $request->upid;
        $upload = Upload::where('upid', $upid)->get();
        return response()->json($upload, 200);
    }
}
