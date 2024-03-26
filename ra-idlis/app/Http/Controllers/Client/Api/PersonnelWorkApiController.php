<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\PersonnelWork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonnelWorkApiController extends Controller
{
    public function fetch(Request $request) {
        $pworkid = $request->pworkid;
        $personnel_work = PersonnelWork::where('pworkid', $pworkid)->get();
        return response()->json($personnel_work, 200);
    }
}
