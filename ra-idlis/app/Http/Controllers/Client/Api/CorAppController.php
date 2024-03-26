<?php

namespace App\Http\Controllers\Client\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationForm;
use App\Models\Barangay;
use App\Models\Classification;
use App\Models\Municipality;
use App\Models\Province;
use DB;

class CorAppController extends Controller
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
        
        $appform->assignedRgn           = $request->assignedRgn;

        // LTO update 5-12-2021
        $appform->ptcCode               = $request->ptcCode;
        $appform->noofmain              = $request->noofmain;
        $appform->noofsatellite         = $request->noofsatellite;
        $appform->savingStat            = $request->saveas;
        $appform->aptid                 = $request->aptid;
        $appform->appComment                 = $request->remarks;
        // $appform->savingStat            = $request->saveas;

        $appform->license_number        = $request->license_number;
        $appform->license_validity      = $request->license_validity;
        
        $appform->head_of_facility_name = $request->head_of_facility_name;

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




        if($request->appcharge){
            NewGeneralController::appCharge($request->appcharge, $appform->appid, $request->uid);
        }
        if($request->appchargeHgp){
            NewGeneralController::appCharge($request->appchargeHgp, $appform->appid, $request->uid);
        }



        // if(count($facid) > 0){
        //    $this->ltoAppDetSave($request->facid, $appform->appid, $request->uid);
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
