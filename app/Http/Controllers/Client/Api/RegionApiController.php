<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Regions;
use Illuminate\Http\Request;

class RegionApiController extends Controller {
    public function fetchAll() {
        // $name = $request->name;
        $regions = Regions::get();
        return  response()->json($regions, 200);
    }
}