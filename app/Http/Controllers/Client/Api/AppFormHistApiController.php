<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\AppFormHist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppFormHistApiController extends Controller
{
    public function fetch() {
        $appform_hist = AppFormHist::get();
        return response()->json($appform_hist, 200);
    }
}
