<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Http\Controllers\Controller;

class ActivityLogsApiController extends Controller
{
    public function fetch() {
        $activitylogs = ActivityLog::get();
        return response()->json($activitylogs, 200);
    }
}
