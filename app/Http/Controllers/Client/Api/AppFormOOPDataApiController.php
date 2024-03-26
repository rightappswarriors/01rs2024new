<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AppFormOOPData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppFormOOPDataApiController extends Controller
{
    public function fetch() {
        $appform_oopdata = AppFormOOPData::get();
        return response()->json($appform_oopdata, 200);
    }
}
