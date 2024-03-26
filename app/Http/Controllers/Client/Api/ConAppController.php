<?php

namespace App\Http\Controllers\Client\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsClientController;
use App\Http\Controllers\NewClientController;
use App\Models\ApplicationForm;
use App\Models\Barangay;
use App\Models\Classification;
use App\Models\CONCatchment;
use App\Models\CONHospital;
use App\Models\Municipality;
use App\Models\Province;
use Carbon\Carbon;
use DB;

class ConAppController extends Controller
{
    public function save(Request $request)
    {
        $stat = 'new';
        if (isset($request->appid)) {
            $appform = ApplicationForm::where('appid', $request->appid)->first();
             $stat = 'exist';

            // DB::insert('insert into x08_ft (uid, appid, facid) values (?, ?, ?)', ['fds', 'ff', 'fds']);
        } else {
            $appform = new ApplicationForm;
        }
        
        if($request->rgnid != "")
        {
            $appform->rgnid                 = $request->rgnid;
        }
        if($request->provid != "")
        {
            $appform->provid                = $request->provid;
        }
        if($request->cmid != "")
        {
            $appform->cmid                  = $request->cmid;
        }
        if($request->brgyid != "")
        {
            $appform->brgyid                = $request->brgyid;
        }
        if($stat == 'new'){
            $appform->uid                   = $request->uid;
        }

        $appform->hfser_id              = $request->hfser_id;
        $appform->facilityname          = $request->facilityname;
       
        $appform->street_number         = $request->street_number;
        $appform->street_name           = $request->street_name;
        $appform->zipcode               = $request->zipcode;
        $appform->contact               = $request->contact;
        $appform->areacode              = $request->areacode;
        $appform->landline              = $request->landline;
        $appform->faxnumber             = $request->faxnumber;
        $appform->email                 = $request->email;
        // $appform->facid                 = $request->facid;
        $appform->cap_inv               = $request->cap_inv;
        $appform->lot_area              = $request->lot_area;
        $appform->noofbed               = $request->noofbed;
        
        $appform->ocid                  = $request->ocid;
        $appform->classid               = $request->classid;
        $appform->subClassid            = $request->subClassid;
        $appform->facmode               = $request->facmode;
        $appform->funcid                = $request->funcid;
        $appform->owner                 = $request->owner;
        $appform->ownerMobile           = $request->ownerMobile;
        $appform->ownerLandline         = $request->ownerLandline;
        $appform->ownerEmail            = $request->ownerEmail;
        $appform->mailingAddress        = $request->mailingAddress;
        $appform->approvingauthoritypos = $request->approvingauthoritypos;
        $appform->approvingauthority    = $request->approvingauthority;
        $appform->hfep_funded           = $request->hfep_funded;
        $appform->draft                 = $request->draft;
        $appform->hgpid                 = $request->hgpid;//6-22-2021


        $appform->assignedRgn           = $request->rgnid;
        $appform->appComment                 = $request->remarks;
        // $appform->assignedRgn           = $request->assignedRgn;

        // LTO update 5-12-2021
        $appform->ptcCode               = $request->ptcCode;
        $appform->noofmain              = $request->noofmain;
        $appform->noofsatellite         = $request->noofsatellite;
        $appform->savingStat            = $request->saveas;
        $appform->aptid                 = $request->aptid;
        // $appform->savingStat            = $request->saveas;
        
        if($request->saveas == 'final'){
            $appform->draft = null;
        }

        $appform->save();

        $facid = json_decode($request->facid, true);

        // if($request->aptid == 'R'){
        //     NewGeneralController::GenAppDetSaveRenewal($request->appchargenew, $appform->appid, $request->uid, 'category');
        //     NewGeneralController::GenAppDetSaveRenewal($request->appchargeHgpnew, $appform->appid, $request->uid, 'service');
        // }else{
          $this->ltoAppDetSave($request->facid, $appform->appid, $request->uid);
        // }

        $chg = DB::table('chgfil')->where([['appform_id', $appform->appid]])->first();
        if (!is_null($chg)) {
            DB::table('chgfil')->where([['appform_id', $appform->appid]])->delete();
        }

        // $this->appCharge($request->appcharge, $appform->appid, $request->uid);

        if($request->appcharge != ""){
            NewGeneralController::appCharge($request->appcharge, $appform->appid, $request->uid);
        }

        if($request->appchargeHgp != ""){
            NewGeneralController::appCharge($request->appchargeHgp, $appform->appid, $request->uid);
        }

        // if(count($facid) > 0){
        //    $this->ltoAppDetSave($request->facid, $appform->appid, $request->uid);
        // }
      
        if($request->con_catch != "[]"){
            $concatch1 = json_decode($request->con_catch, true);
            $con_catch = [];
            // foreach ($request->con_catch  as $cc) {
            foreach ($concatch1  as $cc) {
                // dd($cc['type']);
                $arr = [
                    'appid'         => $appform->appid,
                    'type'          => $cc['type'],
                    'location'      => $cc['location'],
                    'population'    => $cc['population'],
                    'isfrombackend' => null
                ];
                array_push($con_catch, $arr);
            }
            $concatch = CONCatchment::where('appid', $request->appid)->delete();
            CONCatchment::insert($con_catch);
        }

        if($request->con_hospital != "[]"){
                $con_hospital = [];
                $conhosp = json_decode($request->con_hospital, true);
            foreach ($conhosp   as $ch) {
            // foreach ($request->con_hospital  as $ch) {
                // dd($cc['type']);
                $arr = [
                    'appid'         => $appform->appid,
                    'facilityname'  => $ch['facilityname'],
                    'location1'     => $ch['location1'],
                    'cat_hos'       => $ch['cat_hos'],
                    'noofbed1'      => $ch['noofbed1'],
                    'license'       => $ch['license'],
                    'validity'      => $ch['validity'],
                    'date_operation' => $ch['date_operation'],
                    'remarks'       => $ch['remarks']
                ];
                array_push($con_hospital, $arr);
            }
            $conhospital = CONHospital::where('appid', $request->appid)->delete();
            CONHospital::insert($con_hospital);
       }

        return response()->json(
            [
                'id' => $appform->appid,
                'applicaiton' => $appform,
                'payment' => "payment",
                'appcharge' => "appcharge",
                'ambcharge' => "ambcharge",
                'provinces'     => Province::where('rgnid', $appform->rgnid)->get(),
                'cities'        => Municipality::where('provid', $appform->provid)->get(),
                'brgy'          => Barangay::where('cmid', $appform->cmid)->get(),
                'classification' => Classification::where('ocid',  $appform->ocid)->where('isSub', null)->get(),
                'subclass'      => Classification::where('ocid', $appform->ocid)->where('isSub',  $appform->classid)->get(),
            ],
            200
        );
    }
    function ltoAppDetSave($reqfacid, $appid, $uid)
    {

        $facs =  DB::table('x08_ft')->where('appid', $appid)->first();

        if (!is_null($facs)) {
            DB::table('x08_ft')->where('appid', $appid)->delete();
        }

        $facid = json_decode($reqfacid, true);

        for ($i = 0; $i < count($facid); $i++) {
            DB::insert('insert into x08_ft (uid, appid, facid) values (?, ?, ?)', [$uid, $appid, $facid[$i]]);
        }
    }

    function appCharge($appcharge, $appid, $uid)
    {

        $arrVal = json_decode($appcharge, true);

        $arrSaveChgfil = ['chgapp_id', 'chg_num', 'appform_id', 'chgapp_id_pmt', 'orreference', 'deposit', 'other', 'au_id', 'au_date', 'reference', 'amount', 't_date', 't_time', 't_ipaddress', 'uid'];

        $tPayment = 0;
        foreach ($arrVal as $a) {
            // if ($a["amount"] > 0) {
                $chg_num = (DB::table('chg_app')->where('chgapp_id', $a["chgapp_id"])->first())->chg_num;
                $arrDataChgfil =
                    [
                        $a["chgapp_id"],
                        $chg_num,
                        $appid,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        NULL,
                        $a["reference"],
                        $a["amount"],
                        Carbon::now()->toDateString(),
                        Carbon::now()->toTimeString(),
                        request()->ip(),
                        $uid
                    ];

                if (DB::table('chgfil')->insert(array_combine($arrSaveChgfil, $arrDataChgfil))) {
                    $tPayment +=  $a["amount"];
                    DB::table('chg_app')->where([['chgapp_id', $a["chgapp_id"]]])->update(['chg_num' => ($chg_num + 1)]);
                }
            // }
        }

        $chkGet = DB::table('appform_orderofpayment')->where([['appid', $appid]])->first();
        if(isset($chkGet)) {
            DB::table('appform_orderofpayment')->where([['appop_id', $chkGet->appop_id]])->update(['oop_total' => ($chkGet->oop_total + $tPayment)]);
        } else {
            DB::table('appform_orderofpayment')->insert(['appid' => $appid, 'oop_total' => $tPayment, 'oop_time' => Carbon::now()->toTimeString(), 'oop_date' => Carbon::now()->toDateString(), 'oop_ip' => request()->ip(), 'uid' => $uid]);
        }
    }
}
