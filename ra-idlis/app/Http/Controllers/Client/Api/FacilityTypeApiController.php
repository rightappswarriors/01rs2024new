<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FacilityType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacilityTypeApiController extends Controller
{
    public function fetch() {
        $facilitytyp = FacilityType::get();
        return response()->json($facilitytyp, 200);
    }
}
