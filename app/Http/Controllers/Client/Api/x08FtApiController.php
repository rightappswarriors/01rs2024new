<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\x08Ft;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class x08FtApiController extends Controller
{
    public function fetch(Request $request) {
        $id = $request->id;
        $x08ft = x08Ft::where('id', $id)->get();
        return response()->json($x08ft, 200);
    }
}
