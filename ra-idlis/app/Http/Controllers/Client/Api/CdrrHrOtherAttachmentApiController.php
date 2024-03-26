<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CdrrHrOtherAttachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CdrrHrOtherAttachmentApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $cdrrhrother_attachment = CdrrHrOtherAttachment::where('id', $id)->get();
        return response()->json($cdrrhrother_attachment, 200);
    }
}
