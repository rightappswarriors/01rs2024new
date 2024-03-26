<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CdrrAttachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CdrrAttachmentApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $cdrr_attachment = CdrrAttachment::where('id', $id)->get();
        return response()->json($cdrr_attachment, 200);
    }
}
