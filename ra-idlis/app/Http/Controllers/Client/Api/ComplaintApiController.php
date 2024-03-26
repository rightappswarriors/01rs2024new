<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintApiController extends Controller
{
    public function fetch() {
        $complaints = Complaint::get();
        return response()->json($complaints, 200);
    }
}
