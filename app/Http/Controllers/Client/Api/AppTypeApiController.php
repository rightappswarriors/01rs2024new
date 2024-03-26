<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AppType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppTypeApiController extends Controller
{
    public function fetch() {
        $apptype = AppType::get();
        return response()->json($apptype, 200);
    }
}
