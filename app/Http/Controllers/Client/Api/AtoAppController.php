<?php

namespace App\Http\Controllers\Client\Api;

use Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DOHController;
use App\Http\Controllers\FunctionsClientController;
use App\Models\ActivityLog;
use App\Models\ApplicationForm;
use Illuminate\Http\Request;
use App\Models\Regions;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Barangay;
use App\Models\CONCatchment;
use App\Models\CONHospital;
use App\Models\Classification;
use App\Models\FacIds;
use App\Models\x08Ft;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Redirect;

class AtoAppController extends Controller
{
    public function save(Request $request)
    {
        $stat = 'new';
        if (isset($request->appid)) {
            $appform = ApplicationForm::where('appid', $request->appid)->first();
            $stat = 'exist';
        } else {
            $appform = new ApplicationForm;
        }

        // DB::insert('insert into x08_ft (uid, appid, facid) values (?, ?, ?)', ['fds', 'ff', 'fds']);
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
        $appform->assignedRgn           = $request->assignedRgn;

        // LTO update 5-12-2021
        $appform->ptcCode               = $request->ptcCode;
        $appform->noofmain              = $request->noofmain;
        $appform->noofsatellite         = $request->noofsatellite;
        $appform->savingStat            = $request->saveas;
        $appform->aptid                 = $request->aptid;
        $appform->hgpid                 = $request->hgpid;//6-22-2021
        $appform->appComment                 = $request->remarks;
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
        
        // if(count($facid) > 0){
        //    $this->ltoAppDetSave($request->facid, $appform->appid, $request->uid);
        // }

        $chg = DB::table('chgfil')->where([['appform_id', $appform->appid]])->first();
        if (!is_null($chg)) {
            DB::table('chgfil')->where([['appform_id', $appform->appid]])->delete();
        }

       
        // $ac = json_decode($request->appcharge, true);
        // $ach = json_decode($request->appchargeHgp, true);


        // if(count($ac) > 0 && count($ach)){

            if($request->aptid == 'R'){
                    if($request->appchargenew != ""){ NewGeneralController::appChargerenew($request->appchargenew, $appform->appid, $request->uid);}
                    if($request->appchargeHgpnew != ""){ NewGeneralController::appChargerenew($request->appchargeHgpnew, $appform->appid, $request->uid);}
            }else{
                    if($request->appcharge !=""){

                    NewGeneralController::appCharge($request->appcharge, $appform->appid, $request->uid);
                    }   
                    if($request->appchargeHgp != ""){
                    NewGeneralController::appCharge($request->appchargeHgp, $appform->appid, $request->uid);}
            }

            // $this->appCharge($request->appcharge, $appform->appid, $request->uid);
        // }
      
        return response()->json(
            [
                'id' => $appform->appid,
                'applicaiton' => $appform,
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
}
