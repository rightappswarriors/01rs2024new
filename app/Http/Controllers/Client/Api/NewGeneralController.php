<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\AjaxController;
use Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FunctionsClientController;
use App\Models\ApplicationForm;
use App\Models\RegisteredFacility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class NewGeneralController extends Controller
{
    public static function appCharge($appcharge, $appid, $uid)
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


    public function docOptforRenewal(Request $request)
    {
       $msg = 'hello';

       $updateData = array(
        'validDateFrom' => request("valid_from"),
        // 'approvedDate' => request("valid_from"),
        'validDate' => request("valid_to"),
        'noofbed' => request("bed_cap"), 
        'noofdialysis' => request("dialysis_station"),
        'savedRenewalOpt' => 1
    );
    $stat = "failed";
    if($udate = DB::table('appform')->where('appid', '=', request("id"))->update($updateData)){
        $stat = "success";
    }

  
      

        return  response()->json(
            [
                'msg'   => request("id"),
                'status'   => $stat,
            ],
            200
        );
    }

    public static function appChargerenew($appcharge, $appid, $uid)
    {

        $arrVal = json_decode($appcharge, true);

        $arrSaveChgfil = ['chgapp_id', 'chg_num', 'appform_id', 'chgapp_id_pmt', 'orreference', 'deposit', 'other', 'au_id', 'au_date', 'reference', 'amount', 't_date', 't_time', 't_ipaddress', 'uid', 'fee_code'];

        $tPayment = 0;
        foreach ($arrVal as $a) {
            // if ($a["amount"] > 0) {
                // $chg_num = (DB::table('chg_app')->where('chgapp_id', $a["chgapp_id"])->first())->chg_num;
                $arrDataChgfil =
                    [
                        null,
                        null,
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
                        $uid,
                        $a["service_id"]
                    ];

                if (DB::table('chgfil')->insert(array_combine($arrSaveChgfil, $arrDataChgfil))) {
                    $tPayment +=  $a["amount"];
                    // DB::table('chg_app')->where([['chgapp_id', $a["chgapp_id"]]])->update(['chg_num' => ($chg_num + 1)]);
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

    public static function appChargeAmb($appcharge, $appid, $uid)
    {

        $arrVal = json_decode($appcharge, true);

        $arrSaveChgfil = ['chgapp_id', 'chg_num', 'appform_id', 'chgapp_id_pmt', 'orreference', 'deposit', 'other', 'au_id', 'au_date', 'reference', 'amount', 't_date', 't_time', 't_ipaddress', 'uid'];

        $tPayment = 0;
        foreach ($arrVal as $a) {
            // if ($a["amount"] > 0) {
                // $chg_num = (DB::table('chg_app')->where('chgapp_id', $a["chgapp_id"])->first())->chg_num;
                $arrDataChgfil =
                    [
                        NULL,
                        NULL,
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

    public function uploadProofofPay(Request $request) 
    {
        $msg = 0;
        $app =  DB::table('appform')->where('appid',$request->appid)->first();

        if($request->upproof){
            $data = $request->input('upproof');
            $fname = $request->file('upproof')->getClientOriginalName();
            $fileExtension = $request->file('upproof')->getClientOriginalExtension();
            $fileNameToStore = (session()->has('employee_login') ? FunctionsClientController::getSessionParamObj("employee_login", "uid") : FunctionsClientController::getSessionParamObj("uData", "uid")).'_'.Str::random(10).'_'.date('Y_m_d_i_s').'.'.$fileExtension;
            
            $request->file('upproof')->storeAs('public/uploaded', $fileNameToStore);

            $val =  DB::table('appform')->where('appid',$request->appid)->update(['payProofFilen' => $fileNameToStore,'isPayProofFilen' => 1 ]);
        
            if($val){  $msg += 1; }
        }
        if($request->upmach){
            $data = $request->input('upmach');
            $fname = $request->file('upmach')->getClientOriginalName();
            $fileExtension = $request->file('upmach')->getClientOriginalExtension();
            $fileNameToStore = (session()->has('employee_login') ? FunctionsClientController::getSessionParamObj("employee_login", "uid") : FunctionsClientController::getSessionParamObj("uData", "uid")).'_'.Str::random(10).'_'.date('Y_m_d_i_s').'.'.$fileExtension;
            $request->file('upmach')->storeAs('public/uploaded', $fileNameToStore);
            
            $valmch =  DB::table('appform')->where('appid',$request->appid)->update(['payProofFilenMach' => $fileNameToStore,'ispayProofFilenMach' => 1 ]);
        
            if($valmch){  $msg += 1;  }
            if(is_null($app->proofpaystatMach)){
                DB::table('appform')->where('appid',$request->appid)->update(['proofpaystatMach' => 'posting']);
            }
        }
        if($request->upphar){
            $data = $request->input('upphar');
            $fname = $request->file('upphar')->getClientOriginalName();
            $fileExtension = $request->file('upphar')->getClientOriginalExtension();
            $fileNameToStore = (session()->has('employee_login') ? FunctionsClientController::getSessionParamObj("employee_login", "uid") : FunctionsClientController::getSessionParamObj("uData", "uid")).'_'.Str::random(10).'_'.date('Y_m_d_i_s').'.'.$fileExtension;
            $request->file('upphar')->storeAs('public/uploaded', $fileNameToStore);
            
            $valmch =  DB::table('appform')->where('appid',$request->appid)->update(['payProofFilenPhar' => $fileNameToStore,'ispayProofFilenPhar' => 1 ]);
        
            if($valmch){  $msg += 1;  }
            if(is_null($app->proofpaystatPhar)){
                DB::table('appform')->where('appid',$request->appid)->update(['proofpaystatPhar' => 'posting']);
            }
        }
        if(is_null($app->proofpaystat)){
            DB::table('appform')->where('appid',$request->appid)->update(['proofpaystat' => 'posting']);
        }       

        return  response()->json([
            'msg' => 'success' ,
            'id' => $request->appid          
        ]);
    }

    // public function FPSaveAssessments (Request $request, $revision, $otherUID = null){
    public function FPSaveAssessments (Request $request){        
        // $datass = json_decode($request->data);
        // $filteredAssessment = $datass;
        // // $mydata = unserialize($request);
        // $count = 0;
        // $getOnDBID = $sample = array();

        // foreach ($filteredAssessment as $key => $value) {
        //     if($key != '_token' || $key != 'appid' || $key != 'part' ||$key != 'comment' ){
        //         if( !in_array($key, $getOnDBID)){
        //             $count += 1;
        //             array_push($getOnDBID, $key);
        //         }
        //     }
        // }            
        $hi = $request->appid;
        return  response()->json([            
            'request' => $hi,
            // 'request' =>  "heehe"
        
        ]);
        //	AjaxController::createMobileSessionIfMobile($request);
        //  dd($request->all());
        // 	$arrOfUnneeded = array('_token','appid','part');
        // 	$arrForCheck = $request->except($arrOfUnneeded);
        // 	$isMon = $isSelfAssess = false;
        // 	if(!isset($request->appid) || count($arrForCheck) <= 0 ){
        // 		return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No items to pass.']);
        // 	}
                
        // 	$getOnDBID = $sample = array();
        // 	$res = null;
        // 	if(isset($request->appid) && isset($revision) && FunctionsClientController::isExistOnAppform($request->appid) && FunctionsClientController::existOnDB('asmt_h3',[['asmtH3ID',$request->part]]) && in_array(true, AjaxController::isSessionExist(['employee_login']))){
        // 		try {
        // 			if(DB::table('assessmentcombinedduplicateptc')->where([['asmtH3ID_FK',$request->part],['appid',$request->appid],['evaluatedBy',session()->get('employee_login')->uid],['revision',$revision]])->count() <= 0){
        // 				$data = AjaxController::getAllDataEvaluateOne($request->appid);
        // 				$filteredAssessment = $request->except($arrOfUnneeded);
        // 				$uData = AjaxController::getCurrentUserAllData();
        // // suggest to place if count $filteredAssessment
        // 			foreach ($filteredAssessment as $key => $value) {
                               
        // 					if(is_numeric($key) && !in_array($key, $getOnDBID)){
        // 						$res = DB::table('assessmentcombined')->whereIn('asmtComb',[$key])->select('asmtComb','assessmentName','assessmentSeq','headingText','subFor','isAlign')->first();
        // 						$dataFromDB = AjaxController::forAssessmentHeaders(array(['asmt_title.title_code',$value['part']],['asmt_h1.asmtH1ID',$value['lvl1']],['asmt_h2.asmtH2ID',$value['lvl2']],['asmt_h3.asmtH3ID',$value['lvl3']]),array('asmt_h1.*','asmt_h2.*','asmt_h3.*','asmt_title.title_code','asmt_title.title_name', 'asmt_h2.isdisplay'))[0];
        // 		//6-4-2021 original_state					// $dataFromDB = AjaxController::forAssessmentHeaders(array(['asmt_title.title_code',$value['part']],['asmt_h1.asmtH1ID',$value['lvl1']],['asmt_h2.asmtH2ID',$value['lvl2']],['asmt_h3.asmtH3ID',$value['lvl3']]),array('asmt_h1.*','asmt_h2.*','asmt_h3.*','asmt_title.title_code','asmt_title.title_name', 'asmt_h2.isdisplay'))[0];
        // 						$forInsertArray = array('asmtComb_FK' => $res->asmtComb, 'assessmentName' => $res->assessmentName, 'asmtH3ID_FK' => $request->part, 'h3name' => $dataFromDB->h3name, 'asmtH2ID_FK' => $dataFromDB->asmtH2ID, 'isdisplay' => $dataFromDB->isdisplay, 'h2name' => $dataFromDB->h2name, 'asmtH1ID_FK' => $dataFromDB->asmtH1ID, 'h1name' => $dataFromDB->h1name, 'sub' => $res->subFor, 'isAlign' => $res->isAlign, 'revision' => $revision, 'partID' => $dataFromDB->title_code, 'parttitle' => $dataFromDB->title_name, 'evaluation' => ($value['comp'] == 'false' ? 0 : ($value['comp'] == 'NA' ? 'NA' : 1)), 'remarks' => ($value['remarks'] ?? null), 'assessmentSeq' => $res->assessmentSeq, 'evaluatedBy'=> ($uData['cur_user'] != 'ERROR' ? $uData['cur_user'] : (session()->has('uData') ? session()->get('uData')->uid :'UNKOWN, '.$request->ip())), 'assessmentHead' => $res->headingText, 'appid' => $request->appid);
        // 						// (isset($request->monid) && $request->monid > 0 ? $forInsertArray['monid'] = $request->monid : '');
        // 						DB::table('assessmentcombinedduplicateptc')->insert($forInsertArray);
        // 						array_push($getOnDBID, $key);
        // 					}
        // 				}
        // 				if(DB::table('assessmentrecommendation')->where([['choice' , 'comment'], ['evaluatedby', session()->get('employee_login')->uid], ['appid' , $request->appid], ['revision',$revision]])->exists()){
        // 					DB::table('assessmentrecommendation')->where([['choice' , 'comment'], ['evaluatedby', session()->get('employee_login')->uid], ['appid' , $request->appid], ['revision',$revision]])->delete();
        // 				}
        // 				DB::table('assessmentrecommendation')->insert(['choice' => 'comment', 'details' => ($request->comment ?? ' '), 'evaluatedby' => session()->get('employee_login')->uid, 'appid' => $request->appid, 'revision' => $revision]);
        // 				$urlToRedirect = url('employee/dashboard/processflow/floorPlan/parts/'.$request->appid.'/'.$revision. '/'.($otherUID ?? ''));
        // 				$toViewArr = [
        // 					'redirectTo' => $urlToRedirect
        // 				];
        // 				return AjaxController::sendTo($isSelfAssess,$this->agent,$request->all(),'employee/assessment/operationSuccess',$toViewArr);
        // 			}
        // 		} catch (Exception $e) {
        // 			return $e;
        // 		}
        // 	}
        // 	return ($isSelfAssess ? false : back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Item not found on DB.']));		
	}
  
    //to register the new facility that is not existing on the db on registered_facility or to update the details if existing.
    public static function appFormRegisterFacs($id)
    {

        $chechkApp = ApplicationForm::where('appid',$id)->first();

        $checknhfcode = RegisteredFacility::where('nhfcode',$chechkApp->nhfcode)->first();

       
        if(!is_null($checknhfcode)){

            $ngc = new NewGeneralController; 
            $ngc->upRegFac($checknhfcode->regfac_id, $chechkApp);

        }else{
            $term = strtolower($chechkApp->facilityname);
            $chechkReg = RegisteredFacility::whereRaw('lower(facilityname) like (?) ',["%{$term}%"])->first();

            if(!is_null($chechkReg)){

                $ngc = new NewGeneralController; 
                $ngc->upRegFac($chechkReg->regfac_id, $chechkApp);
                DB::table('appform')->where('appid', '=', $chechkApp->appid)->update(['nhfcode'=>$chechkReg->nhfcode]);
            }else{
                $ngc = new NewGeneralController; 
                $ngc->addregFac($chechkApp);
            }
        }

    }

    function upRegFac($regfac_id, $data){
        
        $reg =  DB::table('registered_facility')->where('regfac_id', $regfac_id)->first();
        DB::table('registered_facility')->where('regfac_id', '=', $regfac_id)->update([
            'facilityname'=>$data->facilityname,
            'facid'=>$data->hgpid,
            'rgnid'=>$data->rgnid,
            'provid'=>$data->provid,
            'cmid'=>$data->cmid,
            'brgyid'=>$data->brgyid,
            'street_number'=>$data->street_number,
            'street_name'=>$data->street_name,
            'zipcode'=>$data->zipcode,
            'contact'=>$data->contact,
            'areacode'=>$data->areacode,
            'landline'=>$data->landline,
            'faxnumber'=>$data->faxnumber,
            'email'=>$data->email,
            'ocid'=>$data->ocid,
            'classid'=>$data->classid,
            'subClassid'=>$data->subClassid,
            'facmode'=>$data->facmode,
            'funcid'=>$data->funcid,
            'owner'=>$data->owner,
            'ownerMobile'=>$data->ownerMobile,
            'ownerLandline'=>$data->ownerLandline,
            'ownerEmail'=>$data->ownerEmail,
            'mailingAddress'=>$data->mailingAddress,
            'approvingauthoritypos'=>$data->approvingauthoritypos,
            'approvingauthority'=>$data->approvingauthority,
            'hfep_funded'=>$data->hfep_funded,
            'con_id'=>is_null($reg->con_id) ?  ($data->hfser_id == 'CON'? $data->appid : null) : $reg->con_id,
            'ptc_id'=>is_null($reg->ptc_id) ?  ($data->hfser_id == 'PTC'? $data->appid : null) : $reg->ptc_id,
            'ato_id'=>is_null($reg->ato_id) ?  ($data->hfser_id == 'ATO'? $data->appid : null) : $reg->ato_id,
            'coa_id'=>is_null($reg->coa_id) ?  ($data->hfser_id == 'COA'? $data->appid : null) : $reg->coa_id,
            'lto_id'=>is_null($reg->lto_id) ?  ($data->hfser_id == 'LTO'? $data->appid : null) : $reg->lto_id,
            'cor_id'=>is_null($reg->cor_id) ?  ($data->hfser_id == 'COR'? $data->appid : null) : $reg->cor_id
        ]); 
       
    }

    function addregFac($request){

        $zr = 1;
        if(!is_null($ch = RegisteredFacility::orderBy('regfac_id', 'desc')->first())){
            $zr = $ch->regfac_id + 1;
        }

        $code = date('Y').date('d').'-'.rand(111, 999).'-'. $zr;      

       DB::insert('insert into registered_facility (
            nhfcode, 
            facid, 
            facilityname, 
            rgnid, 
            provid,
            cmid,
            brgyid,
            street_number,
            street_name,
            zipcode,
            contact,
            areacode,
            landline,
            faxnumber,
            email,
            ocid,
            classid,
            subClassid,
            facmode,
            funcid,
            owner,
            ownerMobile,
            ownerLandline,
            ownerEmail,
            mailingAddress,
            approvingauthoritypos,
            approvingauthority,
            hfep_funded
            ) values (?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
            [$code, $request->hgpid, $request->facilityname, $request->rgnid, $request->provid, $request->cmid, $request->brgyid, $request->street_number, $request->street_name, $request->zipcode, $request->contact, $request->areacode, $request->landline, $request->faxnumber, $request->email, $request->ocid, $request->classid, $request->subClassid, $request->facmode, $request->funcid, $request->owner, $request->ownerMobile, $request->ownerLandline, $request->ownerEmail, $request->mailingAddress, $request->approvingauthoritypos, $request->approvingauthority, $request->hfep_funded ]);

   
            $reg =  DB::table('registered_facility')->where('nhfcode', $code)->first();

           
    
              DB::table('appform')->where('appid', '=',  $request->appid)->update(['nhfcode'=>$code]);

    

              DB::table('registered_facility')->where('nhfcode', '=', $code)->update(
                  [
                      'con_id'=>is_null($reg->con_id) ?  ($request->hfser_id == 'CON'? $request->appid : null) : $reg->con_id,
                      'ptc_id'=>is_null($reg->ptc_id) ?  ($request->hfser_id == 'PTC'? $request->appid : null) : $reg->ptc_id,
                      'ato_id'=>is_null($reg->ato_id) ?  ($request->hfser_id == 'ATO'? $request->appid : null) : $reg->ato_id,
                      'coa_id'=>is_null($reg->coa_id) ?  ($request->hfser_id == 'COA'? $request->appid : null) : $reg->coa_id,
                      'lto_id'=>is_null($reg->lto_id) ?  ($request->hfser_id == 'LTO'? $request->appid : null) : $reg->lto_id,
                      'cor_id'=>is_null($reg->cor_id) ?  ($request->hfser_id == 'COR'? $request->appid : null) : $reg->cor_id
                  ]
                );   
        }

      public static  function GenAppDetSaveRenewal($reqfacid, $appid, $uid, $type)
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

    
}
