<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\EmailNotify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailNotifyApiController extends Controller
{
    public function fetch(Request $request) {
        $enid = $request->enid;
        $email_notify = EmailNotify::where('enid', $enid)->get();
        return response()->json($email_notify, 200);
    }
}
