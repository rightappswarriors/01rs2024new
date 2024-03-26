<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CdrrHrPersonnel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CdrrHrPersonnelApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $cdrrhrpersonnel = CdrrHrPersonnel::where('id', $id)->get();
        return response()->json($cdrrhrpersonnel, 200);
    }
}
