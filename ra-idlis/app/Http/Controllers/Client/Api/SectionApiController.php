<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionApiController extends Controller
{
    public function fetch(Request $request) {
        $secid = $request->secid;
        $section = Section::where('secid', $secid)->get();
        return response()->json($section, 200);
    }
}
