<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Personnel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonnelApiController extends Controller
{
    public function fetch(Request $request) {
        $pid = $request->pid;
        $personnel = Personnel::where('pid', $pid)->get();
        return response()->json($personnel, 200);
    }
}
