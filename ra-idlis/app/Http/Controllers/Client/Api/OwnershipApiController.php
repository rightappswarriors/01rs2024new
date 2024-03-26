<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Ownership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OwnershipApiController extends Controller
{
    public function fetch(Request $request) {
        $ocid = $request->ocid;
        $ownership = Ownership::where('ocid', $ocid)->get();
        return response()->json($ownership, 200);
    }
}
