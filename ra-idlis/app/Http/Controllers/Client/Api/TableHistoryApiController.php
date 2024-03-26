<?php

namespace App\Http\Controllers\Client\Api;
use Session;
use App\Models\TableHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableHistoryApiController extends Controller
{
    public function fetch(Request $request) {
        $table_hist_id = $request->table_hist_id;
        $table_history = TableHistory::where('table_hist_id', $table_hist_id)->get();
        return response()->json($table_history, 200);
    }
}
