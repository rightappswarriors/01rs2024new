<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\CityMuni;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityMuniApiController extends Controller
{
    public function fetch(Request $request) {
        $cmid = $request->cmid;
        $city_muni = CityMuni::where('cmid', $cmid)->get();
        return response()->json($city_muni, 200);
    }
}
