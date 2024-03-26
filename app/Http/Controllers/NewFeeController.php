<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class NewFeeController extends Controller
{
    public function getServiceFee(Request $request)
    {
        try {
            $facids = json_decode(request('service_id'), true);
            $cats = json_decode(request('category'), true);

            $service =  DB::table('service_fees')
                ->join('facilitytyp', 'service_fees.service_id', '=', 'facilitytyp.facid')
                ->where([
                    // ['service_id', request('service_id')],
                    ['ocid', request('ocid')],
                    ['facmode', request('facmode')],
                    ['funcid', request('funcid')],
                ])
                ->where('type', 'service')
                ->whereIn('service_id', $facids)
                ->select('service_fees.*', 'facilitytyp.facname')
                ->get();

            $category =  DB::table('service_fees')
                ->join('hfaci_grp', 'service_fees.service_id', '=', 'hfaci_grp.hgpid')
                ->where([
                    // ['service_id', request('service_id')],
                    ['service_fees.ocid', request('ocid')],
                    ['service_fees.facmode', request('facmode')],
                    ['service_fees.funcid', request('funcid')],
                    ['service_fees.type', 'category']
                ])
                ->whereIn('hfaci_grp.hgpid', $cats)
                ->select('service_fees.*', 'hfaci_grp.hgpdesc')
                ->get();

            return  response()->json([
                'message' => 'servcie fees',
                'service_fee' => $service,
                'category' => $category
            ], 200);
        } catch (Exception $e) {
        }
    }
}
