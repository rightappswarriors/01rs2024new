<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\AppFormInsp;

class AppFormInspApiController extends Controller
{
    public function fetch() {
        $appform_insp = AppFormInsp::get();
        return response()->json($appform_insp, 200);
    }
}
