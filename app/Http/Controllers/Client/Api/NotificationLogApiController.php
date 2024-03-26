<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\NotificationLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationLogApiController extends Controller
{
    public function fetch(Request $request) {
        $notfid = $request->notfid;
        $notification_log = NotificationLog::where('notfid', $notfid)->get();
        return response()->json($notification_log, 200);
    }
}
