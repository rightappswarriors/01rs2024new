<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\NotificationMsg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationMsgApiController extends Controller
{
    public function fetch(Request $request) {
        $msg_code = $request->msg_code;
        $notification_msg = NotificationMsg::where('msg_code', $msg_code)->get();
        return response()->json($notification_msg, 200);
    }
}
