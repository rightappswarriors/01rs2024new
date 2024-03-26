<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AssessmentUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessmentUploadApiController extends Controller
{
    public function fetch(Request $request) {
        $upload_id = $request->upload_id;
        $assessment_upload = AssessmentUpload::where('upload_id', $upload_id)->get();
        return response()->json($assessment_upload, 200);
    }
}
