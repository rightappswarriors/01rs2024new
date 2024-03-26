<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Session;
use DateTime;
use DateTimeZone;
use Agent;
use Maatwebsite\Excel\Facades\Excel;
use Schema;
use AjaxController;

class EvaluationController extends Controller
{
	private $agent;
	public function __construct() // for mobile detection
	{
		$this->agent = Agent::isMobile();
	}

 //    public function FPShowPart(Request $request, $appid,$otherUID = null){
	// 	if(isset($appid) && FunctionsClientController::isExistOnAppform($appid) && in_array(true, AjaxController::isSessionExist(['employee_login']))){
	// 		try {
	// 			$isMon = $isSelfAssess = false;
	// 			$data = AjaxController::getAllDataEvaluateOne($appid);
	// 			$toViewArr = [
	// 				'data' => $data,
	// 				'head' => AjaxController::forAssessmentHeaders(array(['appform.appid',$appid],['asmt_h1.apptype',$data->hfser_id]),array('asmt_title.title_name as desc','asmt_title.title_code as id')),
	// 				'address' => url('employee/dashboard/processflow/floorPlan/HeaderOne/'.$appid.'/'),
	// 				'isMain' => true,
	// 				'assesed' => AjaxController::assessedDone(3,$appid,$isMon,$isSelfAssess,true),
	// 				'isMon' => $isMon,
	// 				'isOtherUid' => $otherUID,
	// 				'isPtc' => true
	// 			];
	// 			return AjaxController::sendTo($isSelfAssess,$this->agent,$request->all(),'employee.processflow.pfassessmentShowPart',$toViewArr);
	// 		} catch (Exception $e) {
	// 			return $e;
	// 		}

	// 	} else {
	// 		switch (true) {
	// 			case !isset($appid):
	// 				return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
	// 				break;
	// 			case !FunctionsClientController::isExistOnAppform($appid):
	// 				return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
	// 				break;
	// 			case !in_array(true, AjaxController::isSessionExist(['employee_login'])):
	// 				return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please Login first.']);
	// 				break;
	// 			default:
	// 				return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Unknown error occured. Please try again later']);
	// 				break;
	// 		}
	// 	}
	// }

	public function FPShowPart(Request $request, $appid,$revision,$otherUID = null){
		AjaxController::createMobileSessionIfMobile($request);
		if(isset($appid) && isset($revision) && FunctionsClientController::isExistOnAppform($appid) && in_array(true, AjaxController::isSessionExist(['employee_login']))){
			// if( $revision > 2 && !FunctionsClientController::existOnDB('chgfil',array(['appform_id',$appid]/*,['uid',session()->get('uData')->uid]*/,['revision',$revision],['isPaid',1])) ){
			// 	return redirect('employee/dashboard/processflow/evaluation')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Payment is not settled.']);
			// }
			try {
				$isMon = $isSelfAssess = false;
				$data = AjaxController::getAllDataEvaluateOne($appid);
				$toViewArr = [
					'data' => $data,
					'head' => AjaxController::forAssessmentHeaders(array(['appform.appid',$appid],['asmt_h1.apptype',$data->hfser_id]),array('asmt_title.title_name as desc','asmt_title.title_code as id', 'x08_ft.id as xid')),
					'address' => url('employee/dashboard/processflow/floorPlan/HeaderOne/'.$appid.'/'.$revision),
					'isMain' => true,
					// 'assesed' => AjaxController::assessedDone(3,$appid,$isMon,$isSelfAssess,true),
					'assesed' => AjaxController::forDoneHeaders($appid,$isMon,$isSelfAssess,true,$revision)['h4'],
					'address' => url('employee/dashboard/processflow/floorPlan/ShowAssessments/'.$appid.'/'.$revision),
					'isMon' => $isMon,
					'isOtherUid' => $otherUID,
					'revision' => $revision,
					'isPtc' => true
				];
				// dd($toViewArr);
				return AjaxController::sendTo($isSelfAssess,$this->agent,$request->all(),'employee.processflow.pfassessmentShowPart',$toViewArr);
			} catch (Exception $e) {
				return $e;
			}

		} else {
			switch (true) {
				case !isset($appid):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
					break;
				case !FunctionsClientController::isExistOnAppform($appid):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
					break;
				case !in_array(true, AjaxController::isSessionExist(['employee_login'])):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please Login first.']);
					break;
				default:
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Unknown error occured. Please try again later']);
					break;
			}
		}
	}

	public function FPShowH1(Request $request,$appid,$part,$otherUID = null){
		AjaxController::createMobileSessionIfMobile($request);
		if(isset($appid) && FunctionsClientController::isExistOnAppform($appid) && FunctionsClientController::existOnDB('asmt_title',[['title_code',$part]]) && in_array(true, AjaxController::isSessionExist(['employee_login']))){
			try {
				$isMon = $isSelfAssess = false;
				$data = AjaxController::getAllDataEvaluateOne($appid);
				$whereClause = array(['appform.appid',$appid],['asmt_h1.apptype',$data->hfser_id],['asmt_h1.partID',$part]);
				$headData = AjaxController::forAssessmentHeaders($whereClause,array('asmt_h1.h1name as desc','asmt_h1.asmtH1ID as id','asmt_title.title_name as h1HeadBack','asmt_title.title_code as h1HeadID', 'x08_ft.id as xid'));
				$toViewArr = [
					'data' => $data,
					'head' => $headData,
					'address' => url('employee/dashboard/processflow/floorPlan/HeaderTwo/'.$appid),
					'customAddress' => url('employee/dashboard/processflow/floorPlan/parts/'.$appid.'/'.$otherUID),
					'assesed' => AjaxController::assessedDone(2,$appid,$isMon,$isSelfAssess,true),
					'neededData' => array('level' => 1,'id' => $part),
					'isMon' => $isMon,
					'crumb' => [array('id' => ($headData[0]->h1HeadID ?? null),'desc' => ($headData[0]->h1HeadBack ?? null), 'beforeAddress' => 'MAIN')],
					'isOtherUid' => $otherUID,
					'isPtc' => true
				];
				return AjaxController::sendTo($isSelfAssess,$this->agent,$request->all(),'employee.processflow.pfassessmentShowPart',$toViewArr);
			} catch (Exception $e) {
				return $e;
			}

		} else {
			switch (true) {
				case !isset($appid):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
					break;
				case !FunctionsClientController::isExistOnAppform($appid):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
					break;
				case !FunctionsClientController::existOnDB('asmt_title',[['title_code',$part]]):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Header does not exist.']);
					break;
				case !in_array(true, AjaxController::isSessionExist(['employee_login'])):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please Login first.']);
					break;
				default:
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Unknown error occured. Please try again later']);
					break;
			}
		}
	}

	public function FPShowH2(Request $request,$appid,$h1,$otherUID = null){
		AjaxController::createMobileSessionIfMobile($request);
		if(isset($appid) && FunctionsClientController::isExistOnAppform($appid) && FunctionsClientController::existOnDB('asmt_h1',[['asmtH1ID',$h1]]) && in_array(true, AjaxController::isSessionExist(['employee_login']))){
			try {
				$isMon = $isSelfAssess = false;
				$data = AjaxController::getAllDataEvaluateOne($appid);
				$whereClause = array(['appform.appid',$appid],['asmt_h1.apptype',$data->hfser_id],['asmt_h2.asmtH1ID_FK',$h1]);
				$headData = AjaxController::forAssessmentHeaders($whereClause,array('asmt_h2.h2name as desc','asmt_h2.asmtH2ID as id','asmt_title.title_code as idForBack','asmt_title.title_name as h1HeadBack','asmt_title.title_code as h1HeadID','asmt_h1.h1name as h2HeadBack','asmt_h1.partID as h2HeadID', 'x08_ft.id as xid'));
				$toViewArr = [
					'data' => $data,
					'head' => $headData,
					'address' => url('employee/dashboard/processflow/floorPlan/HeaderThree/'.$appid),
					'assesed' => AjaxController::assessedDone(1,$appid,$isMon,$isSelfAssess,true),
					'beforeAddress' => 'HeaderOne',
					'neededData' => array('level' => 2,'id' => $h1),
					'isMon' => $isMon,
					'crumb' => [array('id' => ($headData[0]->h1HeadID ?? null),'desc' => ($headData[0]->h1HeadBack ?? null), 'beforeAddress' => 'MAIN'),array('id' => ($headData[0]->h2HeadID ?? null),'desc' => ($headData[0]->h2HeadBack ?? null), 'beforeAddress' => 'HeaderOne')],
					'isOtherUid' => $otherUID,
					'isPtc' => true
				];
				return AjaxController::sendTo($isSelfAssess,$this->agent,$request->all(),'employee.processflow.pfassessmentShowPart',$toViewArr);
			} catch (Exception $e) {
				return $e;
			}

		} else {
			switch (true) {
				case !isset($appid):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
					break;
				case !FunctionsClientController::isExistOnAppform($appid):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
					break;
				case !FunctionsClientController::existOnDB('asmt_h1',[['asmtH1ID',$h1]]):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Header does not exist.']);
					break;
				case !in_array(true, AjaxController::isSessionExist(['employee_login'])):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please Login first.']);
					break;
				default:
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Unknown error occured. Please try again later']);
					break;
			}
		}
		return 'forbidden';

	}

	public function FPShowH3(Request $request,$appid,$h2,$otherUID = null){
		AjaxController::createMobileSessionIfMobile($request);
		if(isset($appid) && FunctionsClientController::isExistOnAppform($appid) && FunctionsClientController::existOnDB('asmt_h2',[['asmtH2ID',$h2]]) && in_array(true, AjaxController::isSessionExist(['employee_login']))){
			try {
				$isMon = $isSelfAssess = false;
				$data = AjaxController::getAllDataEvaluateOne($appid);
				$whereClause = array(['appform.appid',$appid],['asmt_h1.apptype',$data->hfser_id],['asmt_h3.asmtH2ID_FK',$h2]);
				$headData = AjaxController::forAssessmentHeaders($whereClause,array('asmt_h3.h3name as desc','asmt_h3.asmtH3ID as id','asmt_h2.asmtH1ID_FK as idForBack','asmt_title.title_name as h1HeadBack','asmt_title.title_code as h1HeadID','asmt_h1.h1name as h2HeadBack','asmt_h1.partID as h2HeadID','asmt_h2.h2name as h3HeadBack','asmt_h2.asmtH2ID as h3HeadID'),1);
				$toViewArr = [
					'data' => $data,
					'head' => $headData,
					'address' => url('employee/dashboard/processflow/floorPlan/ShowAssessments/'.$appid),
					'assesed' => AjaxController::forDoneHeaders($appid,$isMon,$isSelfAssess,true)['h3'],
					'beforeAddress' => 'HeaderTwo',
					'neededData' => array('level' => 3,'id' => $h2),
					'isMon' => $isMon,
					'crumb' => [array('id' => ($headData[0]->h1HeadID ?? null),'desc' => ($headData[0]->h1HeadBack ?? null), 'beforeAddress' => 'MAIN'),array('id' => ($headData[0]->h2HeadID ?? null),'desc' => ($headData[0]->h2HeadBack ?? null), 'beforeAddress' => 'HeaderOne'),array('id' => ($headData[0]->idForBack ?? null),'desc' => ($headData[0]->h3HeadBack ?? null),'beforeAddress' => 'HeaderTwo')],
					'isOtherUid' => $otherUID,
					'isPtc' => true
				];
				return AjaxController::sendTo($isSelfAssess,$this->agent,$request->all(),'employee.processflow.pfassessmentShowPart',$toViewArr);
			} catch (Exception $e) {
				return $e;
			}
		} else {
			switch (true) {
				case !isset($appid):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
					break;
				case !FunctionsClientController::isExistOnAppform($appid):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application ID does not exist.']);
					break;
				case !FunctionsClientController::existOnDB('asmt_h2',[['asmtH2ID',$h2]]):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Header does not exist.']);
					break;
				case !in_array(true, AjaxController::isSessionExist(['employee_login'])):
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please Login first.']);
					break;
				default:
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Unknown error occured. Please try again later']);
					break;
			}
		}
		return 'forbidden';
	}

	public function FPShowAssessments(Request $request,$appid,$revision,$h3,$uid = null){
		if($request->isMethod('get')){
			return AjaxController::createDataForInspection($request,$appid,$revision,$h3,$uid,$this->agent);
		} else {
			return isset($uid) ? json_encode(DB::table('assessmentrecommendation')->where([['appid',$appid],['choice','comment'],['evaluatedby',$uid]])->first()) : null;
		}
	}


	public function FPShowAssessmentsMobile(Request $request,$appid,$revision,$h3,$uid = null){
		AjaxController::createMobileSessionIfMobile($request);
		if($request->isMethod('post')){
			return AjaxController::createDataForInspection($request,$appid,$revision,$h3,$uid,$this->agent);
		}
	}

	public function FPSaveAssessments (Request $request, $revision, $otherUID = null){
		AjaxController::createMobileSessionIfMobile($request);
		// dd($request->all());
		$arrOfUnneeded = array('_token','appid','part');
		$arrForCheck = $request->except($arrOfUnneeded);
		$isMon = $isSelfAssess = false;
		if(!isset($request->appid) || count($arrForCheck) <= 0 ){
			return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No items to pass.']);
		}
		
		$getOnDBID = $sample = array();
		$res = null;
		if(isset($request->appid) && isset($revision) && FunctionsClientController::isExistOnAppform($request->appid) && FunctionsClientController::existOnDB('asmt_h3',[['asmtH3ID',$request->part]]) && in_array(true, AjaxController::isSessionExist(['employee_login']))){
			try {
				if(DB::table('assessmentcombinedduplicateptc')->where([['asmtH3ID_FK',$request->part],['appid',$request->appid],['evaluatedBy',session()->get('employee_login')->uid],['revision',$revision]])->count() <= 0){

					$data = AjaxController::getAllDataEvaluateOne($request->appid);
					// $filteredAssessment = var_dump($request->except($arrOfUnneeded)) ;
					$filteredAssessment = $request->except($arrOfUnneeded);
					$uData = AjaxController::getCurrentUserAllData();
// suggest to place if count $filteredAssessment

					foreach ($filteredAssessment as $key => $value) {
											
						if(is_numeric($key) && !in_array($key, $getOnDBID)){
							$res = DB::table('assessmentcombined')->whereIn('asmtComb',[$key])->select('asmtComb','assessmentName','assessmentSeq','headingText','subFor','isAlign')->first();
							$dataFromDB = AjaxController::forAssessmentHeaders(array(['asmt_title.title_code',$value['part']],['asmt_h1.asmtH1ID',$value['lvl1']],['asmt_h2.asmtH2ID',$value['lvl2']],['asmt_h3.asmtH3ID',$value['lvl3']]),array('asmt_h1.*','asmt_h2.*','asmt_h3.*','asmt_title.title_code','asmt_title.title_name', 'asmt_h2.isdisplay', 'x08_ft.id as xid'))[0];
					//6-4-2021 original_state					// $dataFromDB = AjaxController::forAssessmentHeaders(array(['asmt_title.title_code',$value['part']],['asmt_h1.asmtH1ID',$value['lvl1']],['asmt_h2.asmtH2ID',$value['lvl2']],['asmt_h3.asmtH3ID',$value['lvl3']]),array('asmt_h1.*','asmt_h2.*','asmt_h3.*','asmt_title.title_code','asmt_title.title_name', 'asmt_h2.isdisplay'))[0];
							$forInsertArray = array('asmtComb_FK' => $res->asmtComb, 'assessmentName' => $res->assessmentName, 'asmtH3ID_FK' => $request->part, 'h3name' => $dataFromDB->h3name, 'asmtH2ID_FK' => $dataFromDB->asmtH2ID, 'isdisplay' => $dataFromDB->isdisplay, 'h2name' => $dataFromDB->h2name, 'asmtH1ID_FK' => $dataFromDB->asmtH1ID, 'h1name' => $dataFromDB->h1name, 'sub' => $res->subFor, 'isAlign' => $res->isAlign, 'revision' => $revision, 'partID' => $dataFromDB->title_code, 'parttitle' => $dataFromDB->title_name, 'evaluation' => ($value['comp'] == 'false' ? 0 : ($value['comp'] == 'NA' ? 'NA' : 1)), 'remarks' => ($value['remarks'] ?? null), 'assessmentSeq' => $res->assessmentSeq, 'evaluatedBy'=> ($uData['cur_user'] != 'ERROR' ? $uData['cur_user'] : (session()->has('uData') ? session()->get('uData')->uid :'UNKOWN, '.$request->ip())), 'assessmentHead' => $res->headingText, 'appid' => $request->appid);
							// (isset($request->monid) && $request->monid > 0 ? $forInsertArray['monid'] = $request->monid : '');
							DB::table('assessmentcombinedduplicateptc')->insert($forInsertArray);
							array_push($getOnDBID, $key);
						}
					}

					$uid = session()->get('employee_login')->uid;

// 		$i = 0;
// 		$prevpart = null;
// 		$prevlvl1 = null;
// 		$prevlvl2 = null;
// 		$prevlvl3 = null;
		
		


// 		foreach ($filteredAssessment as $key => $value) {
						
// 			if(is_numeric($key) && !in_array($key, $getOnDBID)){
// 				$res = DB::table('assessmentcombined')->whereIn('asmtComb',[$key])->select('asmtComb','assessmentName','assessmentSeq','headingText','subFor','isAlign')->first();
// 				if($i == 0){
					
// 							$dataFromDB = AjaxController::forAssessmentHeaders(array(
// 							['asmt_title.title_code',$value['part']  ],
// 							['asmt_h1.asmtH1ID', $value['lvl1']  ],
// 							['asmt_h2.asmtH2ID',  $value['lvl2']  ],
// 							['asmt_h3.asmtH3ID',  $value['lvl3'] ]
// 						),array('asmt_h1.*','asmt_h2.*','asmt_h3.*','asmt_title.title_code','asmt_title.title_name', 'asmt_h2.isdisplay'))[0];
						
// 						$prevpart = $value['part'];
// 						$prevlvl1 = $value['lvl1'];
// 						$prevlvl2 = $value['lvl2'];
// 						$prevlvl3 = $value['lvl3'];
			
// 				}else{
// 					$dataFromDB = AjaxController::forAssessmentHeaders(array(
// 						['asmt_title.title_code', $prevpart ],
// 						['asmt_h1.asmtH1ID', $prevlvl1 ],
// 						['asmt_h2.asmtH2ID', $prevlvl2 ],
// 						['asmt_h3.asmtH3ID',  $prevlvl3 ]
// 					),array('asmt_h1.*','asmt_h2.*','asmt_h3.*','asmt_title.title_code','asmt_title.title_name', 'asmt_h2.isdisplay'))[0];
					
// 				}

// 				// $dataFromDB = AjaxController::forAssessmentHeaders(array(['asmt_title.title_code',$value['part']],['asmt_h1.asmtH1ID',$value['lvl1']],['asmt_h2.asmtH2ID',$value['lvl2']],['asmt_h3.asmtH3ID',$value['lvl3']]),array('asmt_h1.*','asmt_h2.*','asmt_h3.*','asmt_title.title_code','asmt_title.title_name', 'asmt_h2.isdisplay'))[0];
// //6-4-2021 original_state					// $dataFromDB = AjaxController::forAssessmentHeaders(array(['asmt_title.title_code',$value['part']],['asmt_h1.asmtH1ID',$value['lvl1']],['asmt_h2.asmtH2ID',$value['lvl2']],['asmt_h3.asmtH3ID',$value['lvl3']]),array('asmt_h1.*','asmt_h2.*','asmt_h3.*','asmt_title.title_code','asmt_title.title_name', 'asmt_h2.isdisplay'))[0];
// 				$forInsertArray = array('asmtComb_FK' => $res->asmtComb, 'assessmentName' => $res->assessmentName, 'asmtH3ID_FK' => $request->part, 'h3name' => $dataFromDB->h3name, 'asmtH2ID_FK' => $dataFromDB->asmtH2ID, 'isdisplay' => $dataFromDB->isdisplay, 'h2name' => $dataFromDB->h2name, 'asmtH1ID_FK' => $dataFromDB->asmtH1ID, 'h1name' => $dataFromDB->h1name, 'sub' => $res->subFor, 'isAlign' => $res->isAlign, 'revision' => $revision, 'partID' => $dataFromDB->title_code, 'parttitle' => $dataFromDB->title_name, 'evaluation' => ($value['comp'] == 'false' ? 0 : ($value['comp'] == 'NA' ? 'NA' : 1)), 'remarks' => ($value['remarks'] ?? null), 'assessmentSeq' => $res->assessmentSeq, 'evaluatedBy'=> ($uData['cur_user'] != 'ERROR' ? $uData['cur_user'] : (session()->has('uData') ? session()->get('uData')->uid :'UNKOWN, '.$request->ip())), 'assessmentHead' => $res->headingText, 'appid' => $request->appid);
// 				// (isset($request->monid) && $request->monid > 0 ? $forInsertArray['monid'] = $request->monid : '');
// 				DB::table('assessmentcombinedduplicateptc')->insert($forInsertArray);
// 				array_push($getOnDBID, $key);
		
			
		
// 			}
// 		$i++;

// 		}


					if(DB::table('assessmentrecommendation')->where([['choice' , 'comment'], ['evaluatedby', session()->get('employee_login')->uid], ['appid' , $request->appid], ['revision',$revision]])->exists()){
						DB::table('assessmentrecommendation')->where([['choice' , 'comment'], ['evaluatedby', session()->get('employee_login')->uid], ['appid' , $request->appid], ['revision',$revision]])->delete();
					}
					DB::table('assessmentrecommendation')->insert(['choice' => 'comment', 'details' => ($request->comment ?? ' '), 'evaluatedby' => session()->get('employee_login')->uid, 'appid' => $request->appid, 'revision' => $revision]);

					if(DB::table('hferc_team')->where([['uid',$uid],['hasInspected',0]])->exists()){
						DB::table('hferc_team')->where('uid',$uid)->where('appid',$request->appid)->update(['hasInspected' => 1, 'inspectDate' => Date('Y-m-d H:i:s')]);
					}

					$urlToRedirect = url('employee/dashboard/processflow/floorPlan/parts/'.$request->appid.'/'.$revision. '/'.($otherUID ?? ''));
					$toViewArr = [
						'redirectTo' => $urlToRedirect
					];
					return AjaxController::sendTo($isSelfAssess,$this->agent,$request->all(),'employee/assessment/operationSuccess',$toViewArr);

				}
			} catch (Exception $e) {
				return $e;
			}
		}
		return ($isSelfAssess ? false : back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Item not found on DB.']));
		
	}

	public static function checkuidRev ($appid, $revision, $uid){

		$dataFromDB = DB::table('assessmentcombinedduplicateptc')
		->where([['assessmentcombinedduplicateptc.appid',$appid],['evaluatedBy',$uid],['revision',$revision]])
		->orderBy('assessmentSeq','ASC')->first();

		$exist = true;

		if(is_null($dataFromDB)){
			$exist = false;
		}

		return $exist;



	}

	public static function checkRev ($appid, $revision){

		$dataFromDB = DB::table('assessmentcombinedduplicateptc')
		->where([['assessmentcombinedduplicateptc.appid',$appid],['revision',$revision]])
		->orderBy('assessmentSeq','ASC')->first();

		$exist = true;

		if(is_null($dataFromDB)){
			$exist = false;
		}

		return $exist;



	}

	//this is the copy of function FPGenerateReportAssessment except that the forPrintOutof this function is true
	public function FPGenerateReportAssessmentFPO (Request $request, $appid, $revision, $uid, $isSelfAssess = null){
		$monid = null;
		$arrToSend = array();

		if(FunctionsClientController::isExistOnAppform($appid) && FunctionsClientController::existOnDB('assessmentcombinedduplicateptc',array(['assessmentcombinedduplicateptc.appid',$appid],['evaluatedBy',$uid],['revision',$revision]))){
			
			$uInf = AjaxController::getAllDataEvaluateOne($appid);
			$reco = DB::table('assessmentrecommendation')->where([['appid',$appid],['evaluatedBy',$uid],['choice','comment'],['revision',$revision]])->first();
			$assessor = array();
			$dataFromDB = DB::table('assessmentcombinedduplicateptc')->where([['assessmentcombinedduplicateptc.appid',$appid],['evaluatedBy',$uid],['revision',$revision]])->orderBy('assessmentSeq','ASC')->get();	
			
			foreach($dataFromDB as $db){
				$arrToSend[$db->partID][$db->asmtH3ID_FK][$db->asmtH2ID_FK][$db->asmtH1ID_FK][] = $db;
			}

			if(DB::table('hferc_team')->where([['uid',$uid],['appid',$appid],['hasInspected',0]])->exists()){
				DB::table('hferc_team')->where('uid',$uid)->where('appid',$appid)->update(['hasInspected' => 1, 'inspectDate' => Date('Y-m-d H:i:s')]);
			}
			$onWhereClause = ([$uid]);
			
			$data = [
				'reports' => $arrToSend,
				'assessor' => DB::table('x08')->whereIn('uid',$onWhereClause)->first(),
				'hferc_evaluator' => DB::table('hferc_team')->where([['uid',$uid], ['appid',$appid]])->first(),
				'uInf' => $uInf,
				'isPtc' => true,
				'reco' => $reco,
				'revision' => $revision,
				'datafromdb' => $dataFromDB,
				'forPrintOut' => true
			];
			//dd($data);

			return AjaxController::sendTo($isSelfAssess,$this->agent,$request->all(),'employee/processflow/pfassessmentgeneratedreportPTCFPO',$data);

		} else {
			return ($isSelfAssess ? false : back()->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'Assessment records not found.']));
		}
	}

	public function FPGenerateReportAssessment (Request $request, $appid, $revision, $uid, $isSelfAssess = null, $forPrintOut = false){

		$monid = null;
		$arrToSend = array();

		if(FunctionsClientController::isExistOnAppform($appid) && FunctionsClientController::existOnDB('assessmentcombinedduplicateptc',array(['assessmentcombinedduplicateptc.appid',$appid],['evaluatedBy',$uid],['revision',$revision]))){
			
			$uInf = AjaxController::getAllDataEvaluateOne($appid);
			$reco = DB::table('assessmentrecommendation')->where([['appid',$appid],['evaluatedBy',$uid],['choice','comment'],['revision',$revision]])->first();
			$assessor = array();
			$dataFromDB = DB::table('assessmentcombinedduplicateptc')->where([['assessmentcombinedduplicateptc.appid',$appid],['evaluatedBy',$uid],['revision',$revision]])->orderBy('assessmentSeq','ASC')->get();	
			
			foreach($dataFromDB as $db){
				$arrToSend[$db->partID][$db->asmtH3ID_FK][$db->asmtH2ID_FK][$db->asmtH1ID_FK][] = $db;
			}

			if(DB::table('hferc_team')->where([['uid',$uid],['appid',$appid],['hasInspected',0]])->exists()){
				DB::table('hferc_team')->where('uid',$uid)->where('appid',$appid)->update(['hasInspected' => 1, 'inspectDate' => Date('Y-m-d H:i:s')]);
			}
			$onWhereClause = ([$uid]);
			
			$data = [
				'reports' => $arrToSend,
				'assessor' => DB::table('x08')->whereIn('uid',$onWhereClause)->first(),
				'hferc_evaluator' => DB::table('hferc_team')->where([['uid',$uid], ['appid',$appid]])->first(),
				'uInf' => $uInf,
				'isPtc' => true,
				'reco' => $reco,
				'revision' => $revision,
				'datafromdb' => $dataFromDB,
				'forPrintOut' => false
			];
			//dd($data);

			return AjaxController::sendTo($isSelfAssess,$this->agent,$request->all(),'employee/processflow/pfassessmentgeneratedreportPTC',$data);

		} else {
			return ($isSelfAssess ? false : back()->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'Assessment records not found.']));
		}
	}

}
