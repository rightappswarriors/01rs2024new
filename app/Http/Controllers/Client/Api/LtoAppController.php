<?php
namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\AjaxController;
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
use App\Models\FACLGroup;
use App\Models\HFACIGroup;
use App\Models\x08Ft;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Redirect;
use stdClass;

class LtoAppController extends Controller
{
    public function check(Request $request)
    {
        $name = $request->name;
        $applications = ApplicationForm::where('facilityname', $name)->get();
        if (count($applications)) {
            return  response()->json(['message' => 'Facility name no longer available'], 400);
        } else {
            return  response()->json(['message' => 'Facility name is safe to use'], 200);
        }
    }
    public function fetch(Request $request)
    {
        $app = [];
        $cities = [];
        $provinces = [];
        $brgy = [];
        $classification = [];
        $subclass = [];
        if ($id = $request->appid) {
            $app = ApplicationForm::where('appid', $id)->first();
        }
        if (isset($app->rgnid)) {
            $provinces = Province::where('rgnid', $app->rgnid)->get();
        }
        if (isset($app->provid)) {
            $cities = Municipality::where('provid', $app->provid)->get();
        }
        if (isset($app->cmid)) {
            $brgy = Barangay::where('cmid', $app->cmid)->get();
        }
        if (isset($app->ocid)) {
            $classification = Classification::where('ocid',  $app->ocid)->where('isSub', null)->get();
        }
        if (isset($app->ocid) && isset($app->classid)) {
            $subclass = Classification::where('ocid', $app->ocid)->where('isSub',  $app->classid)->get();
        }
        $con_catchment = CONCatchment::where('appid', $id)->get();
        $con_hospital = CONHospital::where('appid', $id)->get();

        return  response()->json(
            [
                'application'   => $app,
                'provinces'     => $provinces,
                'cities'        => $cities,
                'brgy'          => $brgy,
                'classification' => $classification,
                'subclass'      => $subclass,
                'con_catchment' => $con_catchment,
                'con_hospital'  => $con_hospital
            ],
            200
        );
    }
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

        // if($request->aptid == 'R'){

        //     $facilitycode = $request->facilitycode;
        //     $year = $request->year;

        //     $url = URL::to('/employee/ohsrs/'.$facilitycode.'/'.$year);
        //     $xml = simplexml_load_file($url);
        //     $jsonresponse =  json_encode($xml);

        //     $result = json_decode($jsonresponse);
            
        //     if($result->response_code == '104'){

        //     } else {
        //         return redirect('client/dashboard/application/license-to-operate?grpn=c&type=r')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Facility Code Not Found. Contact the admin']);
        //     }

        // }

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

        // LTO update 5-12-2021
        $appform->ptcCode               = $request->ptcCode;
        $appform->noofmain              = $request->noofmain;
        $appform->noofsatellite         = $request->noofsatellite;

        $appform->typeamb               = $request->typeamb;
        $appform->ambtyp                = $request->ambtyp;
        $appform->plate_number          = $request->plate_number;
        $appform->ambOwner              = $request->ambOwner;
        $appform->addonDesc             = $request->addonDesc;
        $appform->savingStat            = $request->saveas;
        $appform->noofdialysis          = $request->noofdialysis;
        
        $appform->assignedRgn           = $request->assignedRgn;
        $appform->aptid                 = $request->aptid;
        $appform->hgpid                 = $request->hgpid;//6-22-2021
        $appform->appComment            = $request->remarks;
  
        if($request->saveas == 'final'){
            $appform->draft = null;
        }

        $appform->save();

        $facid = json_decode($request->facid, true);
      
        if(count($facid) > 0){
            // if($request->aptid == 'R'){
            //     $this->ltoAppDetSaveRenewal($request->appchargenew, $appform->appid, $request->uid, 'category');
            //     $this->ltoAppDetSaveRenewal($request->appchargeHgpnew, $appform->appid, $request->uid, 'service');
            // }else{
                $this->ltoAppDetSave($request->facid, $appform->appid, $request->uid);
            // }
          
        }

        if($request->typeamb){
           $amb = json_decode($request->typeamb, true);
           $ambty = json_decode($request->ambtyp, true);

           for ($i = 0; $i < count($amb); $i++) {
                if($ambty[$i] == '2'){
                    $type = 'AOASPT1';
                    if($amb[$i] == '2'){
                        $type = 'AOASPT2';
                    }
                    DB::insert('insert into x08_ft (uid, appid, facid) values (?, ?, ?)', [$request->uid, $appform->appid, $type]);
                }
           }

        }



        $payment = session()->get('payment');
        $appcharge =  session()->get('appcharge');
        $ambcharge   =  session()->get('ambcharge');

        $chg = DB::table('chgfil')->where([['appform_id', $appform->appid]])->first();
        if (!is_null($chg)) {
            DB::table('chgfil')->where([['appform_id', $appform->appid]])->delete();
        }


        if($request->aptid == 'R'){



            
            if($request->appcharge != ""){ NewGeneralController::appCharge($request->appcharge, $appform->appid, $request->uid);}
            if($request->appchargeHgp != ""){ NewGeneralController::appCharge($request->appchargeHgp, $appform->appid, $request->uid);}
        }else{
            

  
                if($request->appcharge != ""){
                NewGeneralController::appCharge($request->appcharge, $appform->appid, $request->uid);
                }


             
                if($request->appchargeHgp != ""){
                NewGeneralController::appCharge($request->appchargeHgp, $appform->appid, $request->uid);
            
            
            }
 

           
        }

        if($request->appChargeAmb != ""){
        NewGeneralController::appChargeAmb($request->appChargeAmb, $appform->appid, $request->uid);}


        if($request->subClassid){
                if($request->subClassid ===  "ND"){
                
                            $test = DB::table('chgfil')->insert(['appform_id' => $appform->appid,'paymentMode'=> null, 'attachedFile'=>null, 'draweeBank' => null, 'number' => null, 'userChoosen' => 1, 't_date' => Date('Y-m-d',strtotime('now')) , 't_time' => Date('H:i:s',strtotime('now'))]);
                            if($test){
                                DB::table('appform')->where('appid',$appform->appid)->update(['isPayEval' => 1, 't_date' => date('Y-m-d'), 'status' => 'FSR']);//6-1-2021


                                DB::table('chgfil')->where([['appform_id',$appform->appid],['chg_num','<>',null],['isPaid',null]])->update(['isPaid'=>1]);
                                $update = DB::table('appform')->where('appid',$appform->appid)->update(['CashierApproveBy'=>"N/A",'CashierApproveDate' => Date('Y-m-d',strtotime('now')), 'CashierApproveTime' => Date('H:i:s',strtotime('now')), 'CashierApproveIp' => "N/A", 'isCashierApprove' => 1, 'proofpaystat' => 'posted']); 
                            }
                }
        }

        

            return response()->json(
                [
                    'id' => $appform->appid,
                    'applicaiton' => $appform,
                    'payment' => $payment,
                    'appcharge' => $appcharge,
                    'ambcharge' => $ambcharge,
                    // 'con_catchment' => $concatch,
                    'provinces'     => Province::where('rgnid', $appform->rgnid)->get(),
                    'cities'        => Municipality::where('provid', $appform->provid)->get(),
                    'brgy'          => Barangay::where('cmid', $appform->cmid)->get(),
                    'classification' => Classification::where('ocid',  $appform->ocid)->where('isSub', null)->get(),
                    'subclass'      => Classification::where('ocid', $appform->ocid)->where('isSub',  $appform->classid)->get(),
                ],
                200
            );
       
      
       
        



    }

    public function OHSRS($facilitycode, $year){
        $param = array( "hfhudcode" => $facilitycode, "year" => $year, "table" => "submittedReports", "key" => "ZG9oYjJ4eWMyRmtiV2x1");

        $opts = array(
            'cache_wsdl' => 0,
            'trace' => 1,
            'stream_context' => stream_context_create(array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            ))
        );
    
        $wsdlUrl = 'http://ohsrs.doh.gov.ph/webservice/index.php?wsdl';

    
        $soap = new SoapClient($wsdlUrl, $opts);

        // $soap = new SoapClient("https://ohsrs.doh.gov.ph/webservice/index.php?wsdl");
        $xml = $soap->__soapCall("getDataTable", $param);
        header("Content-Type: text/xml");
        echo $xml;



    }

    


    public function save_cor(Request $request)
    {
        $stat = 'new';
        if (isset($request->appid)) {
            $appform = ApplicationForm::where('appid', $request->appid)->first();
            $stat = 'exist';
            // DB::insert('insert into x08_ft (uid, appid, facid) values (?, ?, ?)', ['fds', 'ff', 'fds']);
        } else {
            $appform = new ApplicationForm;
        }


        // if($stat == 'new'){
        //     $appform->rgnid                 = $request->rgnid;
        //     $appform->provid                = $request->provid;
        //     $appform->cmid                  = $request->cmid;
        //     $appform->brgyid                = $request->brgyid;
        //     $appform->uid                   = $request->uid;
        // }


        $appform->hfser_id              = $request->hfser_id;
        $appform->facilityname          = $request->facilityname; // change name = 200
      
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
        $appform->classid               = $request->classid; // classification 200
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

        // LTO update 5-12-2021
        $appform->ptcCode               = $request->ptcCode;
        $appform->noofbed               = $request->noofbed; // Number of bed = // To Follow
        $appform->noofmain              = $request->noofmain;
        $appform->noofsatellite         = $request->noofsatellite;

        $appform->typeamb               = $request->typeamb; // to Follow
        $appform->ambtyp                = $request->ambtyp; 
        $appform->plate_number          = $request->plate_number;
        $appform->ambOwner              = $request->ambOwner;
        $appform->addonDesc             = $request->addonDesc;
        $appform->savingStat            = $request->saveas;
        $appform->noofdialysis          = $request->noofdialysis;
        
        $appform->assignedRgn           = $request->assignedRgn;
        $appform->aptid                 = $request->aptid;
        $appform->hgpid                 = $request->hgpid;//6-22-2021
        $appform->appComment            = $request->remarks;
  
        // if($request->saveas == 'final'){
        //     $appform->draft = null;
        // }

        $rawoldfacid = DB::table('x08_ft')->where([['appid', $appform->appid]])->get();

        $oldfacid = array();
        foreach ($rawoldfacid as $rofacid) {
             $oldfacid[] = $rofacid->facid;
        }

        $newfacid = json_decode($request->facid, true);

        $appform->save();

        if($oldfacid == $newfacid){

        } else {
            

            DB::table('appform')->where('appid',$appform->appid)->update(['isPayEval' => 1, 't_date' => date('Y-m-d'), 'status' => 'P']);

            $facid = json_decode($request->facid, true);
          
            if(count($facid) > 0){
                // if($request->aptid == 'R'){
                //     $this->ltoAppDetSaveRenewal($request->appchargenew, $appform->appid, $request->uid, 'category');
                //     $this->ltoAppDetSaveRenewal($request->appchargeHgpnew, $appform->appid, $request->uid, 'service');
                // }else{
                    $this->ltoAppDetSave($request->facid, $appform->appid, $request->uid);
                // }
              
            }
    
            if($request->typeamb){
               $amb = json_decode($request->typeamb, true);
               $ambty = json_decode($request->ambtyp, true);
    
               for ($i = 0; $i < count($amb); $i++) {
                    if($ambty[$i] == '2'){
                        $type = 'AOASPT1';
                        if($amb[$i] == '2'){
                            $type = 'AOASPT2';
                        }
                        DB::insert('insert into x08_ft (uid, appid, facid) values (?, ?, ?)', [$request->uid, $appform->appid, $type]);
                    }
               }
    
            }
    
    
            $payment = session()->get('payment');
            $appcharge =  session()->get('appcharge');
            $ambcharge   =  session()->get('ambcharge');
    
            $chg = DB::table('chgfil')->where([['appform_id', $appform->appid]])->first();
            if (!is_null($chg)) {
                DB::table('chgfil')->where([['appform_id', $appform->appid]])->delete();
            }
    
    
            if($request->aptid == 'R'){
                if($request->appcharge != ""){ NewGeneralController::appCharge($request->appcharge, $appform->appid, $request->uid);}
                if($request->appchargeHgp != ""){ NewGeneralController::appCharge($request->appchargeHgp, $appform->appid, $request->uid);}
            }else{
                
                    if($request->appcharge != ""){
                    NewGeneralController::appCharge($request->appcharge, $appform->appid, $request->uid);
                    }
    
                    if($request->appchargeHgp != ""){
                    NewGeneralController::appCharge($request->appchargeHgp, $appform->appid, $request->uid);
                
                }
            }
    
            if($request->appChargeAmb != ""){
            NewGeneralController::appChargeAmb($request->appChargeAmb, $appform->appid, $request->uid);}
    
    
            if($request->subClassid){
                    if($request->subClassid ===  "ND"){
                    
                                $test = DB::table('chgfil')->insert(['appform_id' => $appform->appid,'paymentMode'=> null, 'attachedFile'=>null, 'draweeBank' => null, 'number' => null, 'userChoosen' => 1, 't_date' => Date('Y-m-d',strtotime('now')) , 't_time' => Date('H:i:s',strtotime('now'))]);
                                if($test){
                                    DB::table('appform')->where('appid',$appform->appid)->update(['isPayEval' => 1, 't_date' => date('Y-m-d'), 'status' => 'FSR']);//6-1-2021
    
    
                                    DB::table('chgfil')->where([['appform_id',$appform->appid],['chg_num','<>',null],['isPaid',null]])->update(['isPaid'=>1]);
                                    $update = DB::table('appform')->where('appid',$appform->appid)->update(['CashierApproveBy'=>"N/A",'CashierApproveDate' => Date('Y-m-d',strtotime('now')), 'CashierApproveTime' => Date('H:i:s',strtotime('now')), 'CashierApproveIp' => "N/A", 'isCashierApprove' => 1, 'proofpaystat' => 'posted']); 
                                }
                    }
            }
        }

            return response()->json(
                [
                    'id' => $appform->appid,
                    'applicaiton' => $appform,
                    'payment' => $payment,
                    'appcharge' => $appcharge,
                    'ambcharge' => $ambcharge,
                    // 'con_catchment' => $concatch,
                    'provinces'     => Province::where('rgnid', $appform->rgnid)->get(),
                    'cities'        => Municipality::where('provid', $appform->provid)->get(),
                    'brgy'          => Barangay::where('cmid', $appform->cmid)->get(),
                    'classification' => Classification::where('ocid',  $appform->ocid)->where('isSub', null)->get(),
                    'subclass'      => Classification::where('ocid', $appform->ocid)->where('isSub',  $appform->classid)->get(),
                ],
                200
            );
       
      
       
        



    }


    public function contfromPtcTemp(Request $request,  $appid)
    {

        $user_data = session()->get('uData');
        if($user_data){
            $nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
        }else{
            $nameofcomp = null;
        }

        $ptcapp = ApplicationForm::where('appid', $appid)->first();
        $ponly = DB::table('ptc')->where([['appid', $appid]])->first();

        $appform = new stdClass();

        $hfser_id = 'LTO';
        //$sql_hfser_id  =  DB::select("SELECT hfser_id FROM type_facility WHERE facid='$ptcapp->hgpid' AND (hfser_id='LTO' OR hfser_id='ATO' OR hfser_id='COA' OR hfser_id='COR') LIMIT 1;");
       
        /*
        foreach ($sql_hfser_id as $s) {
            $hfser_id=$s;
        }
        */
        /// dd($hfser_id);
        $faclArr = [];
        $facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
        
        foreach ($facl_grp as $f) {
            array_push($faclArr, $f->hgpid);
        }

        $hfaci_sql = "SELECT * FROM hfaci_grp WHERE hgpid IN (SELECT hgpid FROM `facl_grp` WHERE hfser_id = '$hfser_id')"; 


        $appform->facilityname          = $ptcapp->facilityname;
        $appform->rgnid                 = $ptcapp->rgnid;
        $appform->provid                = $ptcapp->provid;
        $appform->cmid                  = $ptcapp->cmid;
        $appform->brgyid                = $ptcapp->brgyid;
        $appform->street_number         = $ptcapp->street_number;
        $appform->street_name           = $ptcapp->street_name;
        $appform->zipcode               = $ptcapp->zipcode;
        $appform->contact               = $ptcapp->contact;
        $appform->areacode              = $ptcapp->areacode;
        $appform->landline              = $ptcapp->landline;
        $appform->faxnumber             = $ptcapp->faxnumber;
        $appform->email                 = $ptcapp->email;
        $appform->cap_inv               = $ptcapp->cap_inv;
        $appform->lot_area              = $ptcapp->lot_area;
        $appform->noofbed               = (int)$ponly->propbedcap;
        // $appform->noofbed               = $ptcapp->noofbed;
        $appform->uid                   = $ptcapp->uid;
        $appform->ocid                  = $ptcapp->ocid;
        $appform->classid               = $ptcapp->classid;
        $appform->subClassid            = $ptcapp->subClassid;
        $appform->facmode               = $ptcapp->facmode;
        $appform->funcid                = $ptcapp->funcid;
        $appform->owner                 = $ptcapp->owner;
        $appform->ownerMobile           = $ptcapp->ownerMobile;
        $appform->ownerLandline         = $ptcapp->ownerLandline;
        $appform->ownerEmail            = $ptcapp->ownerEmail;
        $appform->mailingAddress        = $ptcapp->mailingAddress;
        $appform->approvingauthoritypos = $ptcapp->approvingauthoritypos;
        $appform->approvingauthority    = $ptcapp->approvingauthority;
        $appform->hfep_funded           = $ptcapp->hfep_funded;
        $appform->assignedRgn           = $ptcapp->assignedRgn;
        $appform->ptcCode               = $ptcapp->hfser_id.'R'.$ptcapp->rgnid.'-'.$ptcapp->appid;
        // $appform->ptcCode               = $ptcapp->ptcCode;
        $appform->noofmain              = $ptcapp->noofmain;
        $appform->noofdialysis          = $ptcapp->noofdialysis;
        // $appform->noofsatellite         = $ptcapp->noofsatellite;
        $appform->aptid                 = $ptcapp->aptid;
        $appform->savingStat            = "partial";
        $appform->hgpid                 = $ptcapp->hgpid;
        $appform->rgn_desc             =  DB::table('region')->where([['rgnid', $ptcapp->rgnid]])->first()->rgn_desc;
        $appform->provname              =  DB::table('province')->where([['provid', $ptcapp->provid]])->first()->provname;
        $appform->cmname               =  DB::table('city_muni')->where([['cmid', $ptcapp->cmid]])->first()->cmname;
        $appform->brgyname                = DB::table('barangay')->where([['brgyid', $ptcapp->brgyid]])->first()->brgyname;
        $appform->faxNumber                 = $ptcapp->faxNumber;
        $appform->appid                  = null;
        $appform->appComment                   = null;
        $appform->noofdialysis                    = null;
        $appform->noofsatellite                     = null;
        $appform->typeamb                      = null;
        $appform->ambtyp                       = null;
        $appform->plate_number                        = null;
        $appform->ambOwner                         = null;
        $appform->addonDesc                          = null;
       
        $appformConv = array();
        $appformConv[] = $appform;
        
        $chk =  DB::table('x08_ft')->where([['appid', $appid]])->first();

        $chkFacid = new stdClass();
        $chkFacid->facid = $chk->facid;

        $amb = new stdClass();
        $amb->amt = 0;

        $ambConv = array();
        $ambConv[] = $amb;
        $ambConv[] = $amb;

        $arrRet1 = [];
        if(! empty($appid)) {
            $sql2 =array($chk->facid);
            // $sql2 = "SELECT DISTINCT facid FROM `x08_ft` WHERE appid = '$appid'";
            // $sql1 = "SELECT DISTINCT hgpid FROM facilitytyp WHERE facid IN ($sql2) ORDER BY hgpid DESC";
            // $sql3 = "SELECT facid, facname FROM facilitytyp WHERE facid IN ($sql2)";
            // $sql4 = "SELECT hgpid, hgpdesc FROM hfaci_grp WHERE hgpid IN ($sql1)";
            
            $sql1 = "SELECT DISTINCT hgpid FROM facilitytyp WHERE facid = '$chk->facid' ORDER BY hgpid DESC";
            $sql3 = "SELECT facid, facname FROM facilitytyp WHERE facid = '$chk->facid'";
            $sql4 = "SELECT hgpid, hgpdesc FROM hfaci_grp WHERE hgpid IN ($sql1)";

            $arrRet1 = [DB::select($sql1), [$chkFacid], DB::select($sql3), DB::select($sql4)];
            // $arrRet = [DB::select($sql1), DB::select($sql2), DB::select($sql3), DB::select($sql4)];
        }

        $proceesedAmb = [];
					foreach (AjaxController::getForAmbulanceList(false,'forAmbulance.hgpid') as $key => $value) {
						array_push($proceesedAmb, $value->hgpid);
					}

         $hfLocs = 
                    [
                        'client1/apply/app/LTO/'.$appid, 
                        'client1/apply/app/LTO/'.$appid.'/hfsrb', 
                        'client1/apply/app/LTO/'.$appid.'/fda'
                    ];
        if(isset($hideExtensions)) {
            $hfLocs = [
                'client1/apply/employeeOverride/app/LTO/'.$appid, 
                'client1/apply/employeeOverride/app/LTO/'.$appid.'/hfsrb', 
                'client1/apply/employeeOverride/app/LTO/'.$appid.'/fda'
            ];
        }

        $arrRet = [
            // 'grpid' =>  $grpid,
            'nameofcomp' =>  $nameofcomp,
            'user'=> $user_data,
            'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
            'regions' => Regions::orderBy('sort')->get(),
            'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
            'hfser' =>  $hfser_id,
            
            'userInf'=>FunctionsClientController::getUserDetails(),
            'hfaci_serv_type'=>DB::select($hfaci_sql),
            'serv_cap'=>json_encode(DB::table('facilitytyp')->where('servtype_id',1)->get()),
            'apptype'=>DB::table('apptype')->get(),
            'ownership'=>DB::table('ownership')->get(),
            'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
            'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
            'function'=>DB::table('funcapf')->get(),
            'facmode'=>DB::table('facmode')->get(),
            'fAddress'=>$appformConv,
            'servfac'=>json_encode($arrRet1),
            'ptcdet'=>[],
            'cToken'=>FunctionsClientController::getToken(),
            'addresses'=>$hfLocs,
            'hfer' => $hfser_id,
            'hideExtensions'=>null,
            'ambcharges'=>DB::table('chg_app')->whereIn('chgapp_id', ['284', '472'])->get(),//$ambConv,
            'aptid'=>null,
            'group' => json_encode(DB::table('facilitytyp')->where('servtype_id','>',1)->whereNotNull('grphrz_name')->get()),
            'forAmbulance' => json_encode($proceesedAmb),
            
            'apptypenew'=> $ptcapp->aptid ?  $ptcapp->aptid : 'IN'
        ];
        $locRet = "dashboard.client.license-to-operate";
        return view($locRet, $arrRet);
    }

    public function contfromPtcTemp_COA(Request $request,  $appid)
    {
        $user_data = session()->get('uData');
        $nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
        $ptcapp = ApplicationForm::where('appid', $appid)->first();
        $ponly = DB::table('ptc')->where([['appid', $appid]])->first();
        $appform = new stdClass();
        $hfser_id = 'COA';
        $faclArr = [];
        $facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
        $grpid = 'C';
        
        foreach ($facl_grp as $f) {
            array_push($faclArr, $f->hgpid);
        }

        $hfaci_sql = "SELECT * FROM hfaci_grp WHERE hgpid IN (SELECT hgpid FROM `facl_grp` WHERE hfser_id = '$hfser_id')"; 

        $appform->facilityname          = $ptcapp->facilityname;
        $appform->rgnid                 = $ptcapp->rgnid;
        $appform->provid                = $ptcapp->provid;
        $appform->cmid                  = $ptcapp->cmid;
        $appform->brgyid                = $ptcapp->brgyid;
        $appform->street_number         = $ptcapp->street_number;
        $appform->street_name           = $ptcapp->street_name;
        $appform->zipcode               = $ptcapp->zipcode;
        $appform->contact               = $ptcapp->contact;
        $appform->areacode              = $ptcapp->areacode;
        $appform->landline              = $ptcapp->landline;
        $appform->faxnumber             = $ptcapp->faxnumber;
        $appform->email                 = $ptcapp->email;
        $appform->cap_inv               = $ptcapp->cap_inv;
        $appform->lot_area              = $ptcapp->lot_area;
        $appform->noofbed               = (int)$ponly->propbedcap;
        // $appform->noofbed               = $ptcapp->noofbed;
        $appform->uid                   = $ptcapp->uid;
        $appform->ocid                  = $ptcapp->ocid;
        $appform->classid               = $ptcapp->classid;
        $appform->subClassid            = $ptcapp->subClassid;
        $appform->facmode               = $ptcapp->facmode;
        $appform->funcid                = $ptcapp->funcid;
        $appform->owner                 = $ptcapp->owner;
        $appform->ownerMobile           = $ptcapp->ownerMobile;
        $appform->ownerLandline         = $ptcapp->ownerLandline;
        $appform->ownerEmail            = $ptcapp->ownerEmail;
        $appform->mailingAddress        = $ptcapp->mailingAddress;
        $appform->approvingauthoritypos = $ptcapp->approvingauthoritypos;
        $appform->approvingauthority    = $ptcapp->approvingauthority;
        $appform->hfep_funded           = $ptcapp->hfep_funded;
        $appform->assignedRgn           = $ptcapp->assignedRgn;
        $appform->ptcCode               = $ptcapp->hfser_id.'R'.$ptcapp->rgnid.'-'.$ptcapp->appid;
        $appform->con_number            = '';
        // $appform->ptcCode               = $ptcapp->ptcCode;
        $appform->noofmain              = $ptcapp->noofmain;
        $appform->noofdialysis          = $ptcapp->noofdialysis;
        // $appform->noofsatellite         = $ptcapp->noofsatellite;
        $appform->aptid                 = $ptcapp->aptid;
        $appform->savingStat            = "partial";
        $appform->hgpid                 = $ptcapp->hgpid;
        $appform->rgn_desc              =  DB::table('region')->where([['rgnid', $ptcapp->rgnid]])->first()->rgn_desc;
        $appform->provname              =  DB::table('province')->where([['provid', $ptcapp->provid]])->first()->provname;
        $appform->cmname                =  DB::table('city_muni')->where([['cmid', $ptcapp->cmid]])->first()->cmname;
        $appform->brgyname              = DB::table('barangay')->where([['brgyid', $ptcapp->brgyid]])->first()->brgyname;
        $appform->faxNumber             = $ptcapp->faxNumber;
        $appform->appid                 = null;
        $appform->appComment            = null;
        $appform->noofdialysis          = null;
        $appform->noofsatellite         = null;
        $appform->typeamb               = null;
        $appform->ambtyp                = null;
        $appform->plate_number          = null;
        $appform->ambOwner              = null;
        $appform->addonDesc             = null;
       
        $appformConv = array();
        $appformConv[] = $appform;
        $chk =  DB::table('x08_ft')->where([['appid', $appid]])->first();
        $chkFacid = new stdClass();
        $chkFacid->facid = $chk->facid;
        $amb = new stdClass();
        $amb->amt = 0;
        $ambConv = array();
        $ambConv[] = $amb;
        $ambConv[] = $amb;
        $arrRet1 = [];

        if(! empty($appid)) {
            $sql2 =array($chk->facid);
            
            $sql1 = "SELECT DISTINCT hgpid FROM facilitytyp WHERE facid = '$chk->facid' ORDER BY hgpid DESC";
            $sql3 = "SELECT facid, facname FROM facilitytyp WHERE facid = '$chk->facid'";
            $sql4 = "SELECT hgpid, hgpdesc FROM hfaci_grp WHERE hgpid IN ($sql1)";
            $arrRet1 = [DB::select($sql1), [$chkFacid], DB::select($sql3), DB::select($sql4)];
        }
        $proceesedAmb = [];

        foreach (AjaxController::getForAmbulanceList(false,'forAmbulance.hgpid') as $key => $value) {
            array_push($proceesedAmb, $value->hgpid);
        }
        $hfLocs = [
                'client1/apply/app/COA/'.$appid, 
                'client1/apply/app/COA/'.$appid.'/hfsrb', 
                'client1/apply/app/COA/'.$appid.'/fda'
        ];

        if(isset($hideExtensions)) {
            $hfLocs = [
                'client1/apply/employeeOverride/app/COA/'.$appid, 
                'client1/apply/employeeOverride/app/COA/'.$appid.'/hfsrb', 
                'client1/apply/employeeOverride/app/COA/'.$appid.'/fda'
            ];
        }

        $arrRet = [
            'grpid' =>  $grpid,
            'nameofcomp' =>  $nameofcomp,
            'user'=> $user_data,
            'appFacName' => FunctionsClientController::getDistinctByFacilityName(),
            'regions' => Regions::orderBy('sort')->get(),
            'hfaci_service_type'  => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
            'hfser' =>  $hfser_id,            
            'userInf'=>FunctionsClientController::getUserDetails(),
            'hfaci_serv_type'=>DB::select($hfaci_sql),
            'serv_cap'=>json_encode(DB::table('facilitytyp')->where('servtype_id',1)->get()),
            'apptype'=>DB::table('apptype')->get(),
            'ownership'=>DB::table('ownership')->get(),
            'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
            'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
            'function'=>DB::table('funcapf')->get(),
            'facmode'=>DB::table('facmode')->get(),
            'fAddress'=>$appformConv,
            'servfac'=>json_encode($arrRet1),
            'ptcdet'=>[],
            'cToken'=>FunctionsClientController::getToken(),
            'addresses'=>$hfLocs,
            'hfer' => $hfser_id,
            'hideExtensions'=>null,
            'ambcharges'=>DB::table('chg_app')->whereIn('chgapp_id', ['284', '472'])->get(),//$ambConv,
            'aptid'=>null,
            'group' => json_encode(DB::table('facilitytyp')->where('servtype_id','>',1)->whereNotNull('grphrz_name')->get()),
            'forAmbulance' => json_encode($proceesedAmb),            
            'apptypenew'=> $ptcapp->aptid ?  $ptcapp->aptid : 'IN'
        ];

        $locRet = "dashboard.client.certificate-of-accreditation";
        return view($locRet, $arrRet);

    }

    public function assessmentReady(Request $request, $appid)
	{
		$curForm = FunctionsClientController::getUserDetailsByAppform($appid);
		if(count($curForm) < 1) {
			return redirect('client1/apply')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No application selected.']);
		}
		try {
			$dohC = new DOHController();
			$toViewArr = $dohC->AssessmentShowPart($request,$appid,false,true);
			$toViewArr['appform'] = $curForm[0];
			return view('client1.assessment.assessmentView',$toViewArr);
		} catch (Exception $e) {
			return $e;
		}
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

    function ltoAppDetSaveRenewal($reqfacid, $appid, $uid, $type)
    {

        $facs =  DB::table('x08_ft')->where([['appid', $appid], ['fee_type', $type]])->first();
     
        if (!is_null($facs)) {
            DB::table('x08_ft')->where([['appid', $appid], ['fee_type', $type]])->delete();
        }

        $facid = json_decode($reqfacid, true);

        foreach($facid as $f){
            DB::insert('insert into x08_ft (uid, appid, facid, fee_type) values (?, ?, ?, ?)', [$uid, $appid, $f["service_id"],  $f["type"]]);
        }
        // for ($i = 0; $i < count($facid); $i++) {
           
        // }
    }



    public function contfromPtc(Request $request,  $appid)
    {

        $ptcapp = ApplicationForm::where('appid', $appid)->first();
        $facids =  DB::table('x08_ft')->where([['appid', $appid]])->get();
        $ponly = DB::table('ptc')->where([['appid', $appid]])->first();
       
        $appform = new ApplicationForm;

        $appform->hfser_id              = 'LTO';
        $appform->facilityname          = $ptcapp->facilityname;
        $appform->rgnid                 = $ptcapp->rgnid;
        $appform->provid                = $ptcapp->provid;
        $appform->cmid                  = $ptcapp->cmid;
        $appform->brgyid                = $ptcapp->brgyid;
        $appform->street_number         = $ptcapp->street_number;
        $appform->street_name           = $ptcapp->street_name;
        $appform->zipcode               = $ptcapp->zipcode;
        $appform->contact               = $ptcapp->contact;
        $appform->areacode              = $ptcapp->areacode;
        $appform->landline              = $ptcapp->landline;
        $appform->faxnumber             = $ptcapp->faxnumber;
        $appform->email                 = $ptcapp->email;
        $appform->cap_inv               = $ptcapp->cap_inv;
        $appform->lot_area              = $ptcapp->lot_area;
        $appform->noofbed               = (int)$ponly->propbedcap;
        // $appform->noofbed               = $ptcapp->noofbed;
        $appform->uid                   = $ptcapp->uid;
        $appform->ocid                  = $ptcapp->ocid;
        $appform->classid               = $ptcapp->classid;
        $appform->subClassid            = $ptcapp->subClassid;
        $appform->facmode               = $ptcapp->facmode;
        $appform->funcid                = $ptcapp->funcid;
        $appform->owner                 = $ptcapp->owner;
        $appform->ownerMobile           = $ptcapp->ownerMobile;
        $appform->ownerLandline         = $ptcapp->ownerLandline;
        $appform->ownerEmail            = $ptcapp->ownerEmail;
        $appform->mailingAddress        = $ptcapp->mailingAddress;
        $appform->approvingauthoritypos = $ptcapp->approvingauthoritypos;
        $appform->approvingauthority    = $ptcapp->approvingauthority;
        $appform->hfep_funded           = $ptcapp->hfep_funded;
        $appform->assignedRgn           = $ptcapp->assignedRgn;
        $appform->ptcCode               = $ptcapp->hfser_id.'R'.$ptcapp->rgnid.'-'.$ptcapp->appid;
        // $appform->ptcCode               = $ptcapp->ptcCode;
        $appform->noofmain              = $ptcapp->noofmain;
        $appform->noofdialysis          = $ptcapp->noofdialysis;
        // $appform->noofsatellite         = $ptcapp->noofsatellite;
        $appform->aptid                 = $ptcapp->aptid;
        $appform->savingStat            = "partial";
        $appform->hgpid                 = $ptcapp->hgpid;

        

        $appform->save();

        // $this->ltoAppDetSave($facids, $appform->appid, $request->uid);
        foreach($facids as $f){
            DB::insert('insert into x08_ft (uid, appid, facid) values (?, ?, ?)', [$ptcapp->uid, $appform->appid, $f->facid]);
        }
      

        return redirect('client1/apply/app/LTO/'.$appform->appid.'?cont=yes');


    }
}


