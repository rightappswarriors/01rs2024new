<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CdrrPersonnel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CdrrPersonnelApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $cdrrpersonnel = CdrrPersonnel::where('id', $id)->get();
        return response()->json($cdrrpersonnel, 200);
    }
}
