<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\ComplaintsForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintsFormApiController extends Controller
{
    public function fetch(Request $request) {
        $ref_no = $request->ref_no;
        $complaint_form = ComplaintsForm::where('ref_no', $ref_no)->get();
        return response()->json($complaint_form, 200);
    }
}
