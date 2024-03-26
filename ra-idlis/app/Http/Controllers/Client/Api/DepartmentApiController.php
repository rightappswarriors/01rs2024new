<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentApiController extends Controller
{
    public function fetch(Request $request) {
        $depid = $request->depid;
        $departments = Department::where('depid', $depid)->get();
        return response()->json($departments, 200);
    }
}
