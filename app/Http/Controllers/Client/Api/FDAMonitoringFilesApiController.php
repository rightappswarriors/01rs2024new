<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\FDAMonitoringFiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FDAMonitoringFilesApiController extends Controller
{
    public function fetch(Request $request) {
        $fdaFilesID = $request->fdaFilesID;
        $fda_monitoring_files = FDAMonitoringFiles::where('fdaFilesID', $fdaFilesID)->get();
        return response()->json($fda_monitoring_files, 200);
    }
}
