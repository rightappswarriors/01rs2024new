<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\Nov;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NovApiController extends Controller
{
    public function fetch(Request $request) {
        $novid_directions = $request->novid_directions;
        $nov = Nov::where('novid_directions', $novid_directions)->get();
        return response()->json($nov, 200);
    }
}
