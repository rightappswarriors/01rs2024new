<?php 
namespace App\Http\Controllers;
use Mail;
use Session;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\EvaluationController; 
use App\Http\Controllers\Client\Api\NewGeneralController; 
use Illuminate\Support\Facades\Cache;
use FunctionsClientController;
use DOHController;
use AjaxController;
use App\Http\Controllers\AjaxController as ControllersAjaxController;
use App\Http\Controllers\FunctionsClientController as ControllersFunctionsClientController;
use App\Models\FACLGroup;
use App\Models\HFACIGroup;
use App\Models\Regions;
use Hamcrest\Arrays\IsArray;
use QrCode;
use stdClass;

class NewClientController extends Controller {
	protected static $curUser;
	
	public function __index(Request $request) {
		try {
			$cSes = FunctionsClientController::checkSession(false);

			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}
			AjaxController::getHeaderSettings();
			$arrRet = [
				'region'=>DB::table('region')->whereNotIn('rgnid', ['HFSRB','FDA'])->get()
			];
			return view('client1.login', $arrRet);
		} catch(Exception $e) {
			dd($e);
			// return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Login. Contact the admin']);
		}
	}
	
	public function __newlogout(Request $request) {
		try {
			session()->forget('uData'); 
			session()->forget('payment');
			session()->forget('appcharge');
			session()->forget('ambcharge');
			session()->forget('directorSettings');
			
			return view('client1.login');
		} catch(Exception $e) {
			dd($e);
			// return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Login. Contact the admin']);
		}
	}

	public function faq(){
		return view('client1.faq');
	}

	public function __forgot(Request $request, $uid, $token) {
		try {
			$cSes = FunctionsClientController::checkSession(false);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}
			$appDet = FunctionsClientController::getUserDetails($uid);
			$arrRet = [
				'appDet'=>json_encode($appDet)
			];
			if(count($appDet) < 1) {
				return redirect('client1')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No user associated with that user id.']);
			}
			return view('client1.forgot', $arrRet);
		} catch(Exception $e) {
			return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Forgot. Contact the admin']);
		}
	}

	public function __reset(Request $request, $uid) {
		// if(session()->has('uData') && session()->get('uData')->uid == $uid){
			try {
				$chck = $pwd = null;
				if ($request->isMethod('get')) 
				{
					try 
					{
						if (DB::table('x08')->where('uid',$uid)->exists()) {
							if(AjaxController::isPasswordExpired($uid)){
								return view('client1.reset');
							} else {
								return redirect('client1')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'Password is not yet expired!']);
							}
						} else {
							return redirect('client1')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'User not found!']);
						}
					} 
					catch (Exception $e) 
					{
						dd($e);
					}
				}
				if ($request->isMethod('post')) 
				{
					return AjaxController::processExpired($uid,$request->pwd,$request->pass);
				}
			} catch(Exception $e) {
				return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Forgot. Contact the admin']);
			}
		// } else {
		// 	return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Action not allowed']);
		// }
	}

	public function __changePass(Request $request) {
		if(session()->has('uData')){
			if ($request->isMethod('get')) 
			{
				try {
					$uDetails = session()->get('uData');
					$chck = $pwd = null;
					if ($request->isMethod('get')) 
					{
						try 
						{
							if (DB::table('x08')->where('uid',$uDetails->uid)->exists()) {
								return view('client1.reset');
							}
						} 
						catch (Exception $e) 
						{
							dd($e);
						}
					}
					if ($request->isMethod('post')) 
					{
						return AjaxController::processExpired($uDetails->uid,$request->pwd,$request->pass);
					}
					
				} catch(Exception $e) {
					return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Forgot. Contact the admin']);
				}
			}

		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Action not allowed']);
		}
	}

	public function __home(Request $request) {
		try {
			// dd(Route::getFacadeRoot()->current()->uri());
			$cSes = FunctionsClientController::checkSession(true);

			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}
			$data = FunctionsClientController::getUserDetails();
			if(!session()->has('fornav')){
				session()->put('fornav',$data);
			}
			
			$uid = $data[0]->uid;
			$appGet = FunctionsClientController::getApplicationDetailsWithTransactions(FunctionsClientController::getSessionParamObj("uData", "uid"), "IN", true);
			//dd($appGet);
			//$appGet[$key][0] => appform values
			//$appGet[$key][1]
			
			foreach ($appGet as $key => $value) {
				switch ($value[0]->hfser_id) {
					case 'PTC':
						$appGet[$key][4] = DB::table('hferc_evaluation')->where([['appid',$value[0]->appid],['HFERC_eval',1]])->first();
						$appGet[$key][5] =  AjaxController::getAuthorizationTypeExceptCONPTC($value[0]->appid); //Next Authorization
						
						break;

					case 'LTO':
						$appGet[$key][4] = DB::table('assessmentrecommendation')->where([['appid',$value[0]->appid],['choice','issuance']])->first();
						break;

					case 'CON':
						$appGet[$key][4] = DB::table('con_evaluate')->where('appid',$value[0]->appid)->first();
						break;
				}
			}
			//dd($appGet);
			$arrRet = [
				'appDet'=>$appGet,
				'userInf'=>$data,
				'year' => DB::select("SELECT * FROM `appform` LEFT JOIN `hfaci_serv_type` on hfaci_serv_type.hfser_id = appform.hfser_id WHERE (appform.uid = '$uid' AND year(t_date) < year(CURRENT_TIMESTAMP) )")
			];
			return view('client1.home', $arrRet);
		} catch(Exception $e) {
			dd($e);
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
		}
	}

	public function __apply(Request $request) {
		try {
			$cSes = FunctionsClientController::checkSession(true);

			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

			$appform = FunctionsClientController::getApplicationDetailsWithTransactions(FunctionsClientController::getSessionParamObj("uData", "uid"), 'NOT IN', false, true);
			$appGet = FunctionsClientController::getApplicationDetailsWithTransactions(FunctionsClientController::getSessionParamObj("uData", "uid"), "IN", true);
			//dd($appform );
			$arrRet = [
				'appDet'=> $appform ,
				'appDet1'=> $appGet ,
				'userInf'=>FunctionsClientController::getUserDetails(),
				'legends' => DB::table('trans_status')->where([['allowedlegend',1],['color','<>',null]])->get()
			];

			return view('client1.apply', $arrRet);
		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
		}
	}

	public function __historyapplication(Request $request) {
		try {
			$cSes = FunctionsClientController::checkSession(true);

			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

			$appform = FunctionsClientController::getApplicationDetailsWithTransactions(FunctionsClientController::getSessionParamObj("uData", "uid"), 'NOT IN', false, true, true);
			
			$arrRet = [
				'appDet'=> $appform ,
				'userInf'=>FunctionsClientController::getUserDetails(),
				'legends' => DB::table('trans_status')->where([['allowedlegend',1],['color','<>',null]])->get()
			];

			return view('client1.history', $arrRet);
		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
		}
	}

	public function __msg_inbox(Request $request) {
		//try {
			$cSes = FunctionsClientController::checkSession(true);
			$user = FunctionsClientController::getUser();
			$request->request->add(['uid' => $user->uid]); 

			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

			$msg_arr = AjaxController::getNotificationMessage($request);
			//dd($msg_arr );
			$arrRet = [
				'msg_arr'=> $msg_arr ,
				'userInf'=>FunctionsClientController::getUserDetails()
			];

			return view('client1.messages.inbox', $arrRet);
		/*} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
		}*/
	}

	public function __complianceDetails(Request $request, $appid) {


		try {
			$cSes = FunctionsClientController::checkSession(true);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

			$data = FunctionsClientController::getComplianceDetails($appid);

			

			$array = $data->all();

			// dd($array);

			return view('client1.compliance', ['BigData'=>$data, 'complianceId' => $array[0]->compliance_id, 'appid' => $appid, 'type'=>'technical', 'isdocumentary'=>'false']);

		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
			
		}


	}

	public function __complianceAttachment(Request $request, $complianceId, $appid){

		try {
			$cSes = FunctionsClientController::checkSession(true);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

		

			$data = FunctionsClientController::getComplianceAttachment($complianceId);

		

			return view('client1.complianceattachment', ['BigData'=>$data, 'complianceId' => $complianceId, 'appid' => $appid, 'type'=>'technical', 'isdocumentary'=>'false']);

		} catch(Exception $e) {

			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
			
		}

	}


	public function __complianceRemarks(Request $request, $complianceId, $appid){


		try {
			$cSes = FunctionsClientController::checkSession(true);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

			$data = FunctionsClientController::getComplianceRemarks($complianceId);

			$array = $data->all();

			return view('client1.complianceremarks', ['BigData'=>$data, 'complianceId' => $complianceId, 'appid' => $appid, 'type'=>'technical', 'isdocumentary'=>'false']);

		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
			
		}

	}



	public function __correctionDetails(Request $request, $appid) {


		try {
			$cSes = FunctionsClientController::checkSession(true);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

			$data = FunctionsClientController::getComplianceDetailsByCompID($appid);

			

			$array = $data->all();

			

			return view('client1.monitoring', ['BigData'=>$data, 'complianceId' => $array[0]->compliance_id, 'appid' => $array[0]->app_id, 'type'=>'technical', 'isdocumentary'=>'false']);

		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
			
		}


	}

	public function __correctionAttachment(Request $request, $complianceId, $appid){

		try {
			$cSes = FunctionsClientController::checkSession(true);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

		

			$data = FunctionsClientController::getComplianceAttachment($complianceId);

		

			return view('client1.monitoringattachment', ['BigData'=>$data, 'complianceId' => $complianceId, 'appid' => $appid, 'type'=>'technical', 'isdocumentary'=>'false']);

		} catch(Exception $e) {

			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
			
		}

	}


	public function __correctionRemarks(Request $request, $complianceId, $appid){


		try {
			$cSes = FunctionsClientController::checkSession(true);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

			$data = FunctionsClientController::getComplianceRemarks($complianceId);

			$array = $data->all();

			return view('client1.monitoringremarks', ['BigData'=>$data, 'complianceId' => $complianceId, 'appid' => $appid, 'type'=>'technical', 'isdocumentary'=>'false']);

		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
			
		}

	}



	public function __complianceAddAttachment(Request $request){

		
		if ($request->isMethod('post')) {
			
			

			if($request->has('attachment')){

					$attachment = FunctionsClientController::uploadFileNew($request->attachment);
					$curForm = FunctionsClientController::getUserDetails();

					$data = array(
						'compliance_id'=> $request->compliance_id, 
						'app_id'=> $request->appid, 
						'file_real_name' => $attachment['fileNameToStore'], 
						'description' => $request->description,
						'attachment_name' => $request->attachment_name,
						'user_id' => $curForm[0]->uid,
						'type' =>  $attachment['mime'], 
						'path' =>  $attachment['path'], 
					);

					DB::table('compliance_attachment')->insert($data);

					// dd($data);

			} else {
				return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No file selected']);
			}



			return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);


		}

		
	}

	public function __complianceAddRemarks(Request $r){

		if ($r->isMethod('post')) {
			$currData = $email = null;		

			
			// $currentuser = AjaxController::getCurrentUserAllData();

			$curForm = FunctionsClientController::getUserDetails();

			// dd($curForm);

			$data = array(
				'compliance_id'=>$r->compliance_id, 
				'message'=>$r->message, 
				'user_id' => $curForm[0]->uid
			);


			DB::table('compliance_remarks')->insert($data);



			return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);


		}
		
	}



	public function __applyNew(Request $request) {
		try {
			$cSes = FunctionsClientController::checkSession(true);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}
			$appGet = FunctionsClientController::getUserDetailsByAppform(null, null,1);
			unset($appGet[0]->areacode);
			// $curForm = FunctionsClientController::getUserDetailsByAppform($appid);
			$arrRet = [
				'curUserDet'=>json_encode(FunctionsClientController::getUserDetails()),
				'hfaci'=>DB::table('hfaci_serv_type')->orderBy('seq_num', 'ASC')->get(),
				'appFacName'=>FunctionsClientController::getDistinctByFacilityName(),
				'region'=>DB::table('region')->whereNotIn('rgnid', ['HFSRB','FDA'])->orderBy('sort','asc')->get(),
				'curForm'=>(isset($appGet[0]->appid) ? json_encode(FunctionsClientController::getUserDetailsByAppform($appGet[0]->appid)) : json_encode([])),
				'userInf'=>FunctionsClientController::getUserDetails(),
				//new
				'ownership'=>DB::table('ownership')->get(),
				'function'=>DB::table('funcapf')->get(),
				'facmode'=>DB::table('facmode')->get(),
				'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
				'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
				'fAddress'=>(isset($appGet[0]->appid) ? json_encode($appGet) : json_encode([])),
				'servfac'=>(isset($appGet[0]->appid) ? json_encode(FunctionsClientController::getServFaclDetails($appGet[0]->appid)) : json_encode([])),
				'ptcdet'=>(isset($appGet[0]->appid) ? json_encode(FunctionsClientController::getPTCDetails($appGet[0]->appid)) : json_encode([])),
			];
			
			return view('client1.applynew', $arrRet);
		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Add new Application. Contact the admin']);
		}
	}
	public function __applyEdit(Request $request, $appid) {
		try {
			$cSes = FunctionsClientController::checkSession(true);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}
			$appGet = FunctionsClientController::getUserDetailsByAppform($appid, null);
			unset($appGet[0]->areacode);
			$curForm = FunctionsClientController::getUserDetailsByAppform($appid);
			if(count($curForm) < 1) {
				return redirect('client1/apply')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No application selected.']);
			}
			$arrRet = [
				'applicationType' => 'edit',
				'curUserDet'=>json_encode(FunctionsClientController::getUserDetails()),
				'hfaci'=>DB::table('hfaci_serv_type')->orderBy('seq_num', 'ASC')->get(),
				'appFacName'=>FunctionsClientController::getDistinctByFacilityName(),
				'region'=>DB::table('region')->whereNotIn('rgnid', ['HFSRB','FDA'])->get(),
				'curForm'=>json_encode($curForm),
				'userInf'=>FunctionsClientController::getUserDetails(),
				//new
				'ownership'=>DB::table('ownership')->get(),
				'function'=>DB::table('funcapf')->get(),
				'facmode'=>DB::table('facmode')->get(),
				'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
				'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
				'fAddress'=>json_encode($appGet),
				'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
				'ptcdet'=>json_encode(FunctionsClientController::getPTCDetails($appid)),
			];
			return view('client1.applynew', $arrRet);
		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Add new Application. Contact the admin']);
		}
	}

	//Client Attachedments or Uploads of Documents
	public function __applyAttach(Request $request, $hfser, $appid, $office = 'hfsrb') {
		// try {
			$office = AjaxController::listsofapproved(['hfsrb','xray','pharma'],strtolower($office),'hfsrb');
			$arrFaci = array();
			$req = null;
			$submitted = false;
			$lookFor = array(null,3);
			$cSes = FunctionsClientController::checkSession(true);

			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}

			$curForm = FunctionsClientController::getUserDetailsByAppform($appid);
			//dd($appid);
			// dd($request);
			if(count($curForm) < 1) {
				return redirect('client1/apply')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No application selected.']);
			}

			if($request->isMethod("post")) {
				if($request->has('action') && $request->action == 'trigger'){
					if(DB::table('appform')->where('appid',$appid)->update(['isReadyForInspec' => 0])){
						return 'DONE';
					}
				} else {

				$curRecord = []; $msgRet = []; $isApproved = [1, null]; $isAllUpload = [];

				foreach(FunctionsClientController::getReqUploads($hfser, $appid, $office) AS $each) {

					if(! isset($each->filepath)) {
						array_push($curRecord, $each->upid);
					} else {
						if(! in_array($each->evaluation, $isApproved)) {
							if(in_array($curForm[0]->canapply, [1])) {
								array_push($curRecord, $each->upid);
							}
						} else {
							if($each->evaluation == 0) {
								if(in_array($curForm[0]->canapply, [1])) {
									array_push($curRecord, $each->upid);
								}
							}
						}
					}
				}
				
				//dd($curForm); //hfser_id
				if($request->has('upload')){
					
					if($curForm[0]->isReadyForInspec == 0){
						if($curForm[0]->hfser_id == 'PTC'){
							DB::table('appform')->where('appid',$appid)->update(['isReadyForInspec' => 0, 'status'=>'FDE', 'submittedReq'=>1]);
							AjaxController::setAppForm_UpdatedDate($appid);
						}
						else if($curForm[0]->hfser_id == 'LTO' || $curForm[0]->hfser_id == 'COA' || $curForm[0]->hfser_id == 'COR' || $curForm[0]->hfser_id == 'ATO'){
							DB::table('appform')->where('appid',$appid)->update(['isReadyForInspec' => 0, 'status'=>'FSR', 'submittedReq'=>1]);
							AjaxController::setAppForm_UpdatedDate($appid);
						}
						else {
							DB::table('appform')->where('appid',$appid)->update(['isReadyForInspec' => 0, 'status'=>'FDE', 'submittedReq'=>1]);
							AjaxController::setAppForm_UpdatedDate($appid);
						}
					}
					//var_dump($curRecord);
					foreach($request->upload AS $uKey => $uValue) {
						//echo"<br/><br/> ukey<br/>";
						//var_dump($uKey);
						if(in_array($uKey, $curRecord)) {
							$arrFind = DB::table('app_upload')->where([['app_id', $appid], ['upid', $uKey]])->get(); $_file = $request->upload[$uKey];
							// dd($arrFind);
							//echo"<br/><br/> arrFind<br/>";
							//var_dump($arrFind);
							//echo"<br/><br/> _file<br/>";
							//var_dump($_file);
							if(isset($_file) || ! empty($_file)) {

				                $reData = FunctionsClientController::uploadFile($_file);
								$arrData = ['app_id', 'upid', 'filepath', 'fileExten', 'fileSize', 't_date', 't_time', 'ipaddress'];
								$sRequest = ['app_id'=>$appid, 'upid'=>$uKey, 'filepath'=>$reData['fileNameToStore'], 'fileExten'=>$reData['fileExtension'], 'fileSize'=>$reData['fileSize'], 't_date'=>Carbon::now()->toDateString(), 't_time'=>Carbon::now()->toTimeString(), 'ipaddress'=>request()->ip()];
								$arrCheck = []; $makeHash = []; $haveAdd = ['evaluation'=>NULL]; $fMail = [];
								$validate = [['app_id', 'upid', 'filepath'], ['app_id'=>'No application selected.', 'upid'=>'No upload.', 'filepath'=>'No path selected.']];

								$stat = ((count($arrFind) > 0) ? FunctionsClientController::fUpdData($sRequest, $arrData, $arrCheck, $makeHash, $haveAdd, $fMail, $validate, 'app_upload', [['app_id', $appid], ['upid', $uKey]]) : FunctionsClientController::fInsData($sRequest, $arrData, $arrCheck, $makeHash, $haveAdd, $fMail, $validate, 'app_upload'));
								
								//echo"<br/><br/> -----------------------<br/>";
								//var_dump($stat);

								if(count($arrFind) > 0)
								{
									if($stat == true)
									{
										DB::table('notificiationlog')->insert([
											'notifdatetime'=>Carbon::now()->toDateString() .' '. Carbon::now()->toTimeString(),
											'appid'=>$appid,
											'uid'=>$arrFind[0]->evaluatedby,
											'msg_code'=>'78', 
											'status'=>0
										]);
									}
								}
								if(! in_array($stat, $msgRet)) {
									array_push($msgRet, $stat);
								}
							}
						}
					}
					
					//echo"<br/><br/> -----------------------<br/>";
					//dd($request->upload);
				} else {
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No file selected']);
				}
				// foreach(FunctionsClientController::getReqUploads($hfser, $appid) AS $each) {
				// 	if(! isset($each->filepath)) {
				// 		array_push($isAllUpload, $each->upid);
				// 	} else {
				// 		if(! in_array($each->evaluation, $isApproved)) {
				// 			if(in_array($curForm[0]->canapply, [1])) {
				// 				array_push($isAllUpload, $each->upid);
				// 			}
				// 		}
				// 	}
				// }
				// if(count($isAllUpload) < 1) {
				// 	DB::table('appform')->where([['appid', $appid]])->update(['documentSent'=>Carbon::now()->toDateString()]);
				// }

				}
				$submitted = true;

			}

			$facilities = DB::table('x08_ft')->where('appid',$appid)->select('facid')->get();
			// dd($facilities);
			foreach ($facilities as $key => $value) {
				if(!in_array(trim($value->facid), $arrFaci)){
					array_push($arrFaci, trim($value->facid));
				}
			}
			//dd($curForm[0]);
			$reqChecklist = DB::table('x08_ft')->join('facilitytypupload','x08_ft.facid','facilitytypupload.facid')->where([['facilitytypupload.hfser_id',$hfser],['x08_ft.appid',$appid]])->get();
			$req = FunctionsClientController::getReqUploads($hfser, $appid, $office);
			$apf = DB::table('appform')->where([['appid', $appid]])->first();
			$arrRet = [
				'userInf'=>FunctionsClientController::getUserDetails(),
				'appDet'=>$req,
				'appform'=>$curForm[0],
				'submitted'=> $apf->submittedReq,
				'cToken'=>FunctionsClientController::getToken(),
				'orderOfPayment'=>FunctionsClientController::getChgfilCharges($appid),
				'checklist' => $reqChecklist,
				// 'canSubmit' => (array_search(null,array_column($req, 'evaluation')) <= 0 ? true : false)
				'canSubmit' => true,
				'prompt' => ($submitted ? ($office == 'hfsrb' ? DB::table('appform')->join('chgfil','chgfil.appform_id','appform.appid')->where([['chgfil.userChoosen',1],['chgfil.appform_id',$appid]])->orWhere([['chgfil.userChoosen',1],['chgfil.appform_id',$appid],['appform.isPayEval',1]])->doesntExist() : false) : false),
				'appid' => $appid,
				'isReadyToInspect' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',1]])->exists(),
				'office' => $office
			];
			// dd($arrRet);
			return view('client1.applyattach', $arrRet);
		// } catch(Exception $e) {
		// 	return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Add new Application. Contact the admin']);
		// }
	}

	//find me
	public function __applyApp(Request $request, $hfser, $appid, $hideExtensions = NULL, $aptid = NULL) 
	{
		try 
		{	
			$user_data = session()->get('uData');

			if($user_data){
				$nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
			} else{	$nameofcomp = null;	}
			//default client url
			$hfLocs = [
					'client1/apply/app/LTO/'.$appid, 
					'client1/apply/app/LTO/'.$appid.'/hfsrb', 
					'client1/apply/app/LTO/'.$appid.'/fda'
			];
			//employee override url if user id is set
			if(isset($hideExtensions)) {
				$hfLocs = [
					'client1/apply/employeeOverride/app/LTO/'.$appid, 
					'client1/apply/employeeOverride/app/LTO/'.$appid.'/hfsrb', 
					'client1/apply/employeeOverride/app/LTO/'.$appid.'/fda'
				];
			}

			if(! isset($hideExtensions)) {
				$cSes = FunctionsClientController::checkSession(true);
				
				if(count($cSes) > 0) {
					return redirect($cSes[0])->with($cSes[1], $cSes[2]);
				}
			}
			
			$appGet = FunctionsClientController::getUserDetailsByAppform($appid, $hideExtensions);
			//dd($appGet);
			if(count($appGet) < 1) {
				return redirect('client1/apply')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No application selected.']);
			}
			//dd($hfser);
			if($hfser != $appGet[0]->hfser_id) {
				return redirect('client1/apply/app/'.$appGet[0]->hfser_id.'/'.$appid.'');
			}
			$percentage = FunctionsClientController::getAssessmentTotalPercentage($appid, ''.$appGet[0]->uid.'_'.$appGet[0]->hfser_id.'_'.$appGet[0]->aptid.'');
			//dd($percentage);
			if(intval($percentage[0]) < 100) {
				// return redirect('client1/apply/assessmentReady/'.$appid.'/'.$appGet[0]->hfser_id.'')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Proceed to assessment.']);
			}
			$arrRet = []; 
			$locRet = ""; 
			$hfaci_sql = "SELECT * FROM hfaci_grp WHERE hgpid IN (SELECT hgpid FROM `facl_grp` WHERE hfser_id = '$hfser')"; 
			$arrCon = [6];
			$apptype = $appGet[0]->hfser_id;

			// $usid = FunctionsClientController::getSessionParamObj("uData", "uid");
			// $grpid = DB::table('x08')->where([['uid', $usid]])->first()->grpid;
			// $grpid = ' ';
			// unset($appGet[0]->areacode);  //temporary fix
			switch($hfser) {
				case 'CON':
					session()->forget('ambcharge');
	
					$hfser_id = 'CON';
					$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
					$arrRet = [
						// 'grpid' =>  $grpid,
						// 'nameofcomp' =>  $nameofcomp,
						'appid' =>  $appid,
						'appFacName' => FunctionsClientController::getDistinctByFacilityName(),
						'nameofcomp' =>  $nameofcomp,
						'hfser' => $hfser_id,
						'user'=> $user_data,
						'regions' => Regions::orderBy('sort')->get(),
						'userInf'=>FunctionsClientController::getUserDetails(),
						'serv_cap'=>DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->whereIn('hgpid', $arrCon)->get(),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'apptype'=>DB::table('apptype')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'condet'=>FunctionsClientController::getCONDetails($appid),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'arrCon'=>json_encode($arrCon),
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					// unset($arrRet['fAddress'][0]->areacode);
					// dd($arrRet);
					
					$locRet = "dashboard.client.newapplication";
					// $locRet = "client1.apply.CON1.conapp";
					break;
				case 'PTC':
					session()->forget('ambcharge');
					$hfser_id = 'PTC';
					$faclArr = [];
					$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
					
					foreach ($facl_grp as $f) {
						array_push($faclArr, $f->hgpid);
					}

					$ptc =  DB::table('ptc')->where('appid', $appid)->get();

					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'user'=> $user_data,
						'hfser' =>  $hfser_id,
						'appFacName'  => FunctionsClientController::getDistinctByFacilityName(),
						'regions' => Regions::orderBy('sort')->get(),
						'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1]/*,['forSpecialty',0]*/])->get()),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'ptcdet'=>json_encode(FunctionsClientController::getPTCDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'ptc'=>$ptc,
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					// dd($arrRet);
					$locRet = "dashboard.client.permit-to-construct";
					// $locRet = "client1.apply.PTC1.ptcapp";
					break;
				case 'LTO':
					$proceesedAmb = [];
					foreach (AjaxController::getForAmbulanceList(false,'forAmbulance.hgpid') as $key => $value) {
						array_push($proceesedAmb, $value->hgpid);
					}

					// 5-12-2021
					$hfser_id = 'LTO';
					$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}

					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'hfser' =>  $hfser_id,
						'user'=> $user_data,
						'regions' => Regions::orderBy('sort')->get(),
						'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),

						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where('servtype_id',1)->get()),
						'apptype'=>DB::table('apptype')->get(),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'ptcdet'=>json_encode(FunctionsClientController::getPTCDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'addresses'=>$hfLocs,
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'ambcharges'=>DB::table('chg_app')->whereIn('chgapp_id', ['284', '472'])->get(),
						'aptid'=>$aptid,
						'group' => json_encode(DB::table('facilitytyp')->where('servtype_id','>',1)->whereNotNull('grphrz_name')->get()),
						'forAmbulance' => json_encode($proceesedAmb),
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					];
					
					 $locRet = "dashboard.client.license-to-operate";
					//  $locRet = "client1.apply.LTO1.ltoapp";
					break;
				case 'COR':
						session()->forget('ambcharge');
						$hfser_id = 'COR';
						$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
						$arrRet = [
							// 'grpid' =>  $grpid,
							'appid' =>  $appid,
							'nameofcomp' =>  $nameofcomp,
							'hfser' =>  "COR",
							'user'=> $user_data,
							'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
							'userInf'=>FunctionsClientController::getUserDetails(),
							'regions' => Regions::orderBy('sort')->get(),
							'hfaci_serv_type'=>DB::select($hfaci_sql),
							'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
							'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
							'ownership'=>DB::table('ownership')->get(),
							'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
							'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
							'function'=>DB::table('funcapf')->get(),
							'facmode'=>DB::table('facmode')->get(),
							'apptype'=>DB::table('apptype')->get(),
							'fAddress'=>$appGet,
							'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
							'cToken'=>FunctionsClientController::getToken(),
							'hfer' => $apptype,
							'hideExtensions'=>$hideExtensions,
							'aptid'=>$aptid,
							'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
						]; 
						$locRet = "dashboard.client.certificate-of-registration";
						// $locRet = "client1.apply.default1.defaultapp";
						break;

				case 'COA':
					session()->forget('ambcharge');
					$hfser_id = 'COA';
						$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
						'hfser' =>  "COA",
						'user'=> $user_data,
						'regions' => Regions::orderBy('sort')->get(),
						'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'apptype'=>DB::table('apptype')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					
					$locRet = "dashboard.client.certificate-of-accreditation";
					// $locRet = "client1.apply.COA1.coaapp";
					break;
				case 'ATO':
					session()->forget('ambcharge');
						$hfser_id = 'ATO';
						$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
						$arrRet = [
							// 'grpid' =>  $grpid,
							'appid' =>  $appid,
							'nameofcomp' =>  $nameofcomp,
							'hfser' =>  "ATO",
							'user'=> $user_data,
							'regions' => Regions::orderBy('sort')->get(),
							'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
							'userInf'=>FunctionsClientController::getUserDetails(),
							'hfaci_serv_type'=>DB::select($hfaci_sql),
							'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
							'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
							'ownership'=>DB::table('ownership')->get(),
							'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
							'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
							'function'=>DB::table('funcapf')->get(),
							'facmode'=>DB::table('facmode')->get(),
							'apptype'=>DB::table('apptype')->get(),
							'fAddress'=>$appGet,
							'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
							'cToken'=>FunctionsClientController::getToken(),
							'hfer' => $apptype,
							'hideExtensions'=>$hideExtensions,
							'aptid'=>$aptid,
							'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
						]; 
						$locRet = "dashboard.client.authority-to-operate";
					break;
				
				default:
					session()->forget('ambcharge');
					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'userInf'=>FunctionsClientController::getUserDetails(),
						'regions' => Regions::orderBy('sort')->get(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'apptype'=>DB::table('apptype')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					$locRet = "client1.apply.default1.defaultapp";
					break;
					// unset($arrRet['fAddress'][0]->areacode);
			}
			return view($locRet, $arrRet);
		} catch(Exception $e) {
			return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Add new Application. Contact the admin']);
		}
	}

	public function __applyAppCoR(Request $request, $hfser, $appid, $hideExtensions = NULL, $aptid = NULL) {
		try {	
			$user_data = session()->get('uData');
			if($user_data){
				$nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
			}else{
				$nameofcomp = null;
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

			if(! isset($hideExtensions)) {
				$cSes = FunctionsClientController::checkSession(true);
				if(count($cSes) > 0) {
					return redirect($cSes[0])->with($cSes[1], $cSes[2]);
				}
			}
			
			$appGet = FunctionsClientController::getUserDetailsByAppform($appid, $hideExtensions);
			// dd($appGet);
			if(count($appGet) < 1) {
				return redirect('client1/apply')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No application selected.']);
			}
			// dd($hfer);
			if($hfser != $appGet[0]->hfser_id) {
				return redirect('client1/apply/app/'.$appGet[0]->hfser_id.'/'.$appid.'');
			}
			$percentage = FunctionsClientController::getAssessmentTotalPercentage($appid, ''.$appGet[0]->uid.'_'.$appGet[0]->hfser_id.'_'.$appGet[0]->aptid.'');
			
			if(intval($percentage[0]) < 100) {
				// return redirect('client1/apply/assessmentReady/'.$appid.'/'.$appGet[0]->hfser_id.'')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Proceed to assessment.']);
			}
			$arrRet = []; 
			$locRet = ""; 
			$hfaci_sql = "SELECT * FROM hfaci_grp WHERE hgpid IN (SELECT hgpid FROM `facl_grp` WHERE hfser_id = '$hfser')"; 
			$arrCon = [6];
			$apptype = $appGet[0]->hfser_id;

			// $usid = FunctionsClientController::getSessionParamObj("uData", "uid");
			// $grpid = DB::table('x08')->where([['uid', $usid]])->first()->grpid;
			// $grpid = ' ';
			// unset($appGet[0]->areacode);  //temporary fix
			switch($hfser) {
				case 'CON':
					session()->forget('ambcharge');
	
					$hfser_id = 'CON';
					$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
					$arrRet = [
						// 'grpid' =>  $grpid,
						// 'nameofcomp' =>  $nameofcomp,
						'appid' =>  $appid,
						'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
						'nameofcomp' =>  $nameofcomp,
						'hfser' =>  $hfser_id,
						'user'=> $user_data,
						'userInf'=>FunctionsClientController::getUserDetails(),
						'serv_cap'=>DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->whereIn('hgpid', $arrCon)->get(),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'apptype'=>DB::table('apptype')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'condet'=>FunctionsClientController::getCONDetails($appid),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'arrCon'=>json_encode($arrCon),
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					// unset($arrRet['fAddress'][0]->areacode);
					// dd($arrRet);
					
					$locRet = "dashboard.client.newapplicationcor";
					// $locRet = "client1.apply.CON1.conapp";
					break;
				case 'PTC':
					session()->forget('ambcharge');
					$hfser_id = 'PTC';
					$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}

					$ptc =  DB::table('ptc')->where('appid', $appid)->get();

					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'user'=> $user_data,
						'hfser' =>  $hfser_id,
						'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
						'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1]/*,['forSpecialty',0]*/])->get()),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'ptcdet'=>json_encode(FunctionsClientController::getPTCDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'ptc'=>$ptc,
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					// dd($arrRet);
					$locRet = "dashboard.client.permit-to-constructcor";
					// $locRet = "client1.apply.PTC1.ptcapp";
					break;
				case 'LTO':
					$proceesedAmb = [];
					foreach (AjaxController::getForAmbulanceList(false,'forAmbulance.hgpid') as $key => $value) {
						array_push($proceesedAmb, $value->hgpid);
					}

					// 5-12-2021
					$hfser_id = 'LTO';
					$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}

					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'hfser' =>  $hfser_id,
						'user'=> $user_data,
						'regions' => Regions::orderBy('sort')->get(),
						'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),

						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where('servtype_id',1)->get()),
						'apptype'=>DB::table('apptype')->get(),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'ptcdet'=>json_encode(FunctionsClientController::getPTCDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'addresses'=>$hfLocs,
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'ambcharges'=>DB::table('chg_app')->whereIn('chgapp_id', ['284', '472'])->get(),
						'aptid'=>$aptid,
						'group' => json_encode(DB::table('facilitytyp')->where('servtype_id','>',1)->whereNotNull('grphrz_name')->get()),
						'forAmbulance' => json_encode($proceesedAmb),
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					];
					 $locRet = "dashboard.client.license-to-operatecor";
					//  $locRet = "client1.apply.LTO1.ltoapp";
					break;
				case 'COR':
						session()->forget('ambcharge');
						$hfser_id = 'COR';
						$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
						$arrRet = [
							// 'grpid' =>  $grpid,
							'appid' =>  $appid,
							'nameofcomp' =>  $nameofcomp,
							'hfser' =>  "COR",
							'user'=> $user_data,
							'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
							'userInf'=>FunctionsClientController::getUserDetails(),
							'hfaci_serv_type'=>DB::select($hfaci_sql),
							'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
							'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
							'ownership'=>DB::table('ownership')->get(),
							'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
							'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
							'function'=>DB::table('funcapf')->get(),
							'facmode'=>DB::table('facmode')->get(),
							'apptype'=>DB::table('apptype')->get(),
							'fAddress'=>$appGet,
							'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
							'cToken'=>FunctionsClientController::getToken(),
							'hfer' => $apptype,
							'hideExtensions'=>$hideExtensions,
							'aptid'=>$aptid,
							'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
						]; 
						$locRet = "dashboard.client.certificate-of-registrationcor";
						// $locRet = "client1.apply.default1.defaultapp";
						break;

				case 'COA':
					session()->forget('ambcharge');
					$hfser_id = 'COA';
						$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
						'hfser' =>  "COA",
						'user'=> $user_data,
						'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'apptype'=>DB::table('apptype')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					
					$locRet = "dashboard.client.certificate-of-accreditationcor";
					// $locRet = "client1.apply.COA1.coaapp";
					break;
				case 'ATO':
					session()->forget('ambcharge');
						$hfser_id = 'ATO';
						$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
						$arrRet = [
							// 'grpid' =>  $grpid,
							'appid' =>  $appid,
							'nameofcomp' =>  $nameofcomp,
							'hfser' =>  "ATO",
							'user'=> $user_data,
							'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
							'userInf'=>FunctionsClientController::getUserDetails(),
							'hfaci_serv_type'=>DB::select($hfaci_sql),
							'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
							'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
							'ownership'=>DB::table('ownership')->get(),
							'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
							'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
							'function'=>DB::table('funcapf')->get(),
							'facmode'=>DB::table('facmode')->get(),
							'apptype'=>DB::table('apptype')->get(),
							'fAddress'=>$appGet,
							'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
							'cToken'=>FunctionsClientController::getToken(),
							'hfer' => $apptype,
							'hideExtensions'=>$hideExtensions,
							'aptid'=>$aptid,
							'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
						]; 
						$locRet = "dashboard.client.authority-to-operatecor";
					break;
				
				default:
					session()->forget('ambcharge');
					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'apptype'=>DB::table('apptype')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					$locRet = "client1.apply.default1.defaultappcor";
					break;
					// unset($arrRet['fAddress'][0]->areacode);
			}
			return view($locRet, $arrRet);
		} catch(Exception $e) {
			return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Add new Application. Contact the admin']);
		}
	}

	public function __applyApp_n(Request $request, $hfser, $appid, $aptid) {
		$col1 = "up_appid, hfser_id, facilityname, owner, rgnid, provid, cmid, brgyid, contact, email, uid, street_name, street_number, faxNumber, zipcode, landline, mailingAddress, ownerMobile, ownerLandline, ownerEmail, aptid"; $col2 = "'$appid' AS up_appid, hfser_id, facilityname, owner, rgnid, provid, cmid, brgyid, contact, email, uid, street_name, street_number, faxNumber, zipcode, landline, mailingAddress, ownerMobile, ownerLandline, ownerEmail, '$aptid' AS aptid"; $tbl = "appform"; $where = "appid = '$appid'"; $NOT_ACCEPTED = ["CON", "PTC"];
		$appid1 = FunctionsClientController::getUserDetailsByAppform($appid);
		$cSes = FunctionsClientController::checkSession(true);
		if(count($cSes) > 0) {
			return redirect($cSes[0])->with($cSes[1], $cSes[2]);
		}
		if(count($appid1) > 0) { 
			if(! in_array($appid1[0]->hfser_id, $NOT_ACCEPTED)) { 
				if($appid1[0]->aptid != $aptid) { // if(isset($appid1[0]->aptid)) {
					$gData = "SELECT appid FROM appform WHERE appid = '$appid' AND aptid = '$aptid' AND (up_appid IS NOT NULL AND up_appid != '')"; // (COALESCE(hfser_id, ''), facilityname, owner, rgnid, provid, cmid, brgyid, contact, email, uid, COALESCE(street_name, ''), street_number, COALESCE(faxNumber, ''), zipcode, COALESCE(landline, ''), COALESCE(mailingAddress, ''), ownerMobile, ownerLandline, ownerEmail) IN (SELECT COALESCE(hfser_id, ''), facilityname, owner, rgnid, provid, cmid, brgyid, contact, email, uid, COALESCE(street_name, ''), street_number, COALESCE(faxNumber, ''), zipcode, COALESCE(landline, ''), COALESCE(mailingAddress, ''), ownerMobile, ownerLandline, ownerEmail FROM appform WHERE appid = '$appid')
					$gDataS = DB::select(DB::raw($gData));
					if(count($gDataS) > 0) {
						$nAppid = $gDataS[0]->appid; $rUrl = "client1/apply/app/$hfser/$nAppid/$aptid";
						return redirect($rUrl);
					} else {
						if(FunctionsClientController::fInsSel($col1, $tbl, $col2, $tbl, $where)) {
							$gDataS = DB::select(DB::raw("SELECT appid FROM appform WHERE up_appid = '$appid' AND aptid = '$aptid' AND (up_appid IS NOT NULL AND up_appid != '')")); $nAppid = $gDataS[0]->appid; $rUrl = "client1/apply/app/$hfser/$nAppid/$aptid";
							return redirect($rUrl);
						}
					}
				} return self::__applyApp($request, $hfser, $appid, NULL, $aptid); 
			}
			return redirect('client1/home')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'Renewal not applicable to this application.']);
		}

		return redirect('client1/home')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No application selected.']);
	}
	public function __updApp(Request $request, $appid) {
		$cSes = FunctionsClientController::checkSession(true);
		if(count($cSes) > 0) {
			return redirect($cSes[0])->with($cSes[1], $cSes[2]);
		}
		$errMsg = "No continuation for selected application type.";
		$sql = DB::select(DB::raw("SELECT hfaci_serv_type.* FROM appform INNER JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id WHERE appid = '$appid'"));
		if(count($sql) > 0) {
			$isSub = FunctionsClientController::retColArr($sql[0], 'isSub'); 
			$col1 = "up_appid, hfser_id, facilityname, owner, rgnid, provid, cmid, brgyid, contact, email, uid, street_name, street_number, faxNumber, zipcode, landline, mailingAddress, ownerMobile, ownerLandline, ownerEmail, aptid"; $col2 = "'$appid' AS up_appid, '$isSub' AS hfser_id, facilityname, owner, rgnid, provid, cmid, brgyid, contact, email, uid, street_name, street_number, faxNumber, zipcode, landline, mailingAddress, ownerMobile, ownerLandline, ownerEmail, (CASE WHEN (aptid IS NULL OR aptid = '') THEN NULL ELSE 'IN' END) AS aptid"; $tbl = "appform"; $where = "appid = '$appid'";
			if(isset($isSub)) {
				$appform = DB::select(DB::raw("SELECT * FROM appform WHERE appid = '$appid' AND TRIM(licenseNo) IS NOT NULL"));
				if(count($appform) > 0) {
					$upApp = DB::select("SELECT * FROM appform WHERE up_appid = '$appid' AND hfser_id = '$isSub'");
					if(count($upApp) > 0) {
						return redirect('client1/apply/edit/'.$upApp[0]->appid.'');
					} else {
						$insThis = FunctionsClientController::fInsSel($col1, $tbl, $col2, $tbl, $where);
						if(in_array($insThis, [true, 1])) {
							return redirect('client1/apply/app/updApp/'.$appid.'');
						}
					}
				} else {
					$errMsg = "Application selected is not yet licensed or doesn't exist.";
				}
			}
		}
		return redirect('client1/home')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>$errMsg]);
	}

	

	public function __change_request(Request $request, $appid) {
		// try {
			$cSes = FunctionsClientController::checkSession(true);
			$appform = FunctionsClientController::getUserDetailsByAppform($appid);
			$up_appid = DB::table('appform')->where([['up_appid', $appid], ['aptid', 'IC']])->first();
			$allConnected = FunctionsClientController::getTablesConnectedAppform($appid);
			$col1 = "up_appid, uid, facilityname, serv_capabilities, owner, email, mailingAddress, contact, rgnid, provid, cmid, brgyid, landline, street_name, street_number, faxnumber, zipcode, ownerMobile, ownerLandline, ownerEmail, hfser_id, facid, ocid, ocdesc, aptid, classid, classdesc, subClassid, subClassdesc, funcid, facmode, noofbed, conCode, noofsatellite, clab, draft, appid_payment, t_date, t_time, ipaddress, assignedRgn, assignedRgnTime, assignedRgnDate, assignedRgnIP, assignedRgnBy, assignedLO, assignedLOTime, assignedLoDate, assignedLOIP, assignedLOBy, status, cap_inv, lot_area, typeamb, plate_number, noofamb"; $col2 = "'$appid' AS up_appid, uid, facilityname, serv_capabilities, owner, email, mailingAddress, contact, rgnid, provid, cmid, brgyid, landline, street_name, street_number, faxnumber, zipcode, ownerMobile, ownerLandline, ownerEmail, hfser_id, facid, ocid, ocdesc, 'IC' AS aptid, classid, classdesc, subClassid, subClassdesc, funcid, facmode, noofbed, conCode, noofsatellite, clab, draft, appid_payment, t_date, t_time, ipaddress, assignedRgn, assignedRgnTime, assignedRgnDate, assignedRgnIP, assignedRgnBy, assignedLO, assignedLOTime, assignedLoDate, assignedLOIP, assignedLOBy, status, cap_inv, lot_area, typeamb, plate_number, noofamb"; $tbl = "appform"; $where = "appid = '$appid'";
			// dd($allConnected);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}
			if(count($appform) < 1) {
				return redirect('client1/home')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No application selected.']);
			}
			if(! isset($up_appid)) {
				$insAppform = FunctionsClientController::fInsSel($col1, $tbl, $col2, $tbl, $where);
				if(in_array($insAppform, [true, 1])) {
					$nUp_appid = DB::table('appform')->where([['up_appid', $appid]])->first();
					if(isset($nUp_appid)) {
						$nAppid = $nUp_appid->appid;
						// foreach($allConnected AS $key => $value) {
						// 	if(! in_array($key, [$tbl, 'licensed'])) {
						// 		// DB::table($key)->where([[$value, $nAppid]])->delete();
						// 		$nCol = FunctionsClientController::arrayString_agg("COLUMN_NAME", FunctionsClientController::returnColumns("COLUMNS", "TABLE_NAME = '$key' AND COLUMN_NAME NOT IN ('$value') AND COLUMN_KEY != 'PRI'"));
						// 		$nCol1 = ((! empty($nCol)) ? "$value, $nCol" : "$value"); $nCol2 = ((! empty($nCol)) ? "'$nAppid' AS $value, $nCol" : "$value");
						// 		$insInTbl = FunctionsClientController::fInsSel($nCol1, $key, $nCol2, $key, "$value = '$appid'");
						// 		if(! in_array($insAppform, [true, 1])) {
						// 			return redirect('client1/home')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>$insAppform]);
						// 		}
						// 	}
						// }
						return redirect('client1/apply/edit/'.$nAppid.'');
					} else {
						$insAppform = "Error on saving";
					}
				}
				return redirect('client1/home')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>$insAppform]);
			}
			return redirect('client1/apply/edit/'.$up_appid->appid.'');
		// } catch(Exception $e) {

		// }
	}
	public function __payment(Request $request, $token = "", $chgapp_id = "", $appid = "") {

		try {
			$cSes = FunctionsClientController::checkSession(true);
			if(count($cSes) > 0) {
				return redirect($cSes[0])->with($cSes[1], $cSes[2]);
			}
			if((! empty($token)) && (! empty($chgapp_id))) {
				if($token == FunctionsClientController::getToken()) {
					$appform = FunctionsClientController::getUserDetailsByAppform($appid);
					if(count($appform) > 0) {
						$selHfser = ['LTO'];
						$retArr = FunctionsClientController::insPayment($request->all(), request()->ip(), $chgapp_id, $appid, FunctionsClientController::getTotalAmount('amount', FunctionsClientController::getChgfilCharges($appid)));
						$nLoc = ((in_array($appform[0]->hfser_id, $selHfser)) ? 'client1/apply/app/'.$appform[0]->hfser_id.'/'.$appid.'/hfsrb' : 'client1/apply/attachment/'.$appform[0]->hfser_id.'/'.$appid.'');
						return redirect($nLoc)->with($retArr[0], $retArr[1]);
					} else {
						return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No application selected.']);
					}
				} else {
					return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Incorrect token.']);
				}
			}
			return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No token and/or payment type set on payment.']);
		} catch(Exception $e) {
			return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Processing Payment. Contact the admin.']);
		}
	}
	public static function checkExitPay($appid) {
		$appform = DB::table('appform')->join('chgfil','chgfil.appform_id','appform.appid')->where([['chgfil.userChoosen',1],['chgfil.appform_id',$appid]])->orWhere([['chgfil.userChoosen',1],['chgfil.appform_id',$appid],['appform.isPayEval',1]])->exists();
		
		$ex = "no";
		if($appform){
			$ex = "yes";
		}

		return $ex;
	}
	
	public function __dPayment(Request $request, $token = "", $appid = "") {
		try {
			if($request->isMethod('get')){
				$appform = DB::table('appform')->join('chgfil','chgfil.appform_id','appform.appid')->where([['chgfil.userChoosen',1],['chgfil.appform_id',$appid]])->orWhere([['chgfil.userChoosen',1],['chgfil.appform_id',$appid],['appform.isPayEval',1]])->exists();
				// dd($appform);
				if($appform){
					return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'You cannot choose a payment at this moment or you have already selected a payment method.']);
				}
				$cSes = FunctionsClientController::checkSession(true);
				if(count($cSes) > 0) {
					return redirect($cSes[0])->with($cSes[1], $cSes[2]);
				}
				$retArr = [];

				if($token == FunctionsClientController::getToken()) {
					// $payment = FunctionsClientController::getChgfilCharges($appid);
					$payment = FunctionsClientController::getChgfilTransactions($appid,'C');

					if(isset($payment)) { if(isset($payment)) {

						// 6-9-2021
						$dohC = new DOHController();
						$toViewArr = $dohC->GenerateReportAssessment($request,$appid,null,1);
						$hasAssessment = 0;
						if($toViewArr){
							$hasAssessment = 1;
						}

						$af = DB::table('appform')->where('appid',$appid)->first();
						// $payment = array_unique($payment);
						$arrRet = [
							'userInf'=>FunctionsClientController::getUserDetails(),
							'npayment'=>$payment,
							'cToken'=>FunctionsClientController::getToken(),
							'appid'=>$appid,
							'hasAssessment'=>$hasAssessment,
							'hfser_id'=>$af->hfser_id,
							'aptid'=>$af->aptid
						];

						if($af->aptid == 'R'){
							$arrRet['discounts'] =  DB::table('application_discount')
							->where('date_start', '<', Carbon::now())
							->where('date_end', '>', Carbon::now())
							->where('type', 'Renewal')
							->where('status', '1')
							->get();
						} else {
							$arrRet['discounts'] =  DB::table('application_discount')
							->where('date_start', '<', Carbon::now())
							->where('date_end', '>', Carbon::now())
							->where('type', 'Initial')
							->where('status', '1')
							->get();
						}
						
						return view('client1.payment', $arrRet);
					} }
					return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No payment(s) and/or charges selected.']);
				}
				return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Incorrect token.']);

			} else {
				if($request->has('mPay')){
					$filename = null;

					if($request->hasFile('attFile')){
						$filename = FunctionsClientController::uploadFile($request->attFile)['fileNameToStore'];
					}
					$test = false;					
					if($request->mPay == "MOP-16")
					{
						$dt = Carbon::now();
						$dateNow = $dt->toDateString();
						$timeNow = $dt->toTimeString();
						$appform = DB::table('appform')->where('appid', '=',$appid)->select(['hfser_id','aptid', 'uid'])->get();
						$getData = DB::table('chgfil')->where('appform_id', '=',$appid)->select('chg_num')->first();
						$aptid = NULL;
						$hfser_id = NULL;
						$uid = NULL;
						
						if(isset($appform))
						{							
							if(count($appform) > 0)
							{
								$aptid = $appform[0]->aptid;
								$hfser_id =  $appform[0]->hfser_id;
								$uid = $appform[0]->uid;
							}
						}
						
						$chgapp_id = DB::table('chg_app')->insertGetId([
									'chg_num' => (intval($getData->chg_num) + 1)."",
									'chgopp_seq' => '1',					
									'chg_code'=> $request->mPay, 
									'amt' => $request->au_amount,	
									'aptid' => $aptid,
									'hfser_id'=> $hfser_id,
									'remarks' => "Payment",	
									'renewal_period'=> "0"
								]); 
												
						$test = DB::table('chgfil')->insertGetId([
									'chgapp_id' => $chgapp_id,
									'chg_num' => (intval($getData->chg_num) + 1)."",
									'appform_id' => $appid,
									'reference' => "Payment",
									'amount' => $request->au_amount,						
									'paymentMode'=> $request->mPay, 
									'paymentDate'=> $request->au_date, 
									'attachedFile'=>$filename, 
									'draweeBank' => $request->drawee,
									'draweeBank' => $request->drawee,
									'number' => $request->number, 
									'userChoosen' => 1, 
									'sysdate' => $dateNow,
									'systime' => $timeNow,
									'uid' => $uid,
									't_date' => $dateNow , 
									't_time' => $timeNow
								]); 
					}
					else
					{
						$test = DB::table('chgfil')->insert(['appform_id' => $appid,'paymentMode'=> $request->mPay, 'attachedFile'=>$filename, 'draweeBank' => $request->drawee, 'number' => $request->number, 'userChoosen' => 1, 't_date' => Date('Y-m-d',strtotime('now')) , 't_time' => Date('H:i:s',strtotime('now'))]);
					}
					
					if($test){
						DB::table('appform')->where('appid',$appid)->update(['isPayEval' => 1, 't_date' => date('Y-m-d'), 'status' => 'P']);//6-1-2021
						// DB::table('appform')->where('appid',$appid)->update(['isrecommended' => 1,'isPayEval' => 1]);
						return redirect('client1/apply')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Successfully submitted application form and updated payment information.']);
					}
				}
				return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'We are sorry but we have encoutered a problem. Contact the admin.']);
			}

		} catch(Exception $e) {
			dd($e);
			return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Opening payment module. Contact the admin.']);
		}
	}

	public function __byHfser(Request $request, $hfser, $appid, $viewFor = 'client') 
	{
		$ftr_msg_facility = "";
		$hgpid = "";

		try {
			if(DB::table('appform')->where([['appform.appid',$appid],['appform.isApprove',1]])->doesntExist()){
				return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application Does not Exist']);
			}
			$otherDetails = null;
			$x08_ft = 0;
			$arrayFaci = $arrayserv = array();
			$retTable = FunctionsClientController::getUserDetailsByAppform($appid, "", 10);
			
			if(!empty($retTable))
			{
				if(isset($retTable[0]->hgpid))
					$hgpid = $retTable[0]->hgpid; 
					
				switch ($retTable[0]->hfser_id) {
					case 'PTC':
						$otherDetails = DB::table('hferc_evaluation')->join('hferc_team', 'hferc_evaluation.HFERC_evalBy', '=', 'hferc_team.uid')
						->where([['hferc_evaluation.appid',$appid],['hferc_evaluation.HFERC_eval',1],['hferc_team.pos','C']])
						->first();
						// $otherDetails = DB::table('hferc_evaluation')->where([['appid',$appid],['HFERC_eval',1]])->first();
						$ftr_msg_facility = (DB::table('hfaci_grp')->select('ftr_msg_ptc')->where('hgpid',$hgpid)->first())->ftr_msg_ptc;
						break;

					case 'LTO':
						$otherDetails = [DB::table('assessmentrecommendation')->where('appid',$appid)->first(), DB::table('x08_ft')->where('appid',$appid)->whereIn('facid',['H','H2','H3'])->exists()];

						$ftr_msg_facility = (DB::table('hfaci_grp')->select('ftr_msg_lto')->where('hgpid',$hgpid)->first())->ftr_msg_lto;

						break;
					case 'COA':
						$otherDetails = [DB::table('assessmentrecommendation')->where('appid',$appid)->first(), DB::table('x08_ft')->where('appid',$appid)->whereIn('facid',['H','H2','H3'])->exists()];
						$ftr_msg_facility = (DB::table('hfaci_grp')->select('ftr_msg_coa')->where('hgpid',$hgpid)->first())->ftr_msg_coa;

						break;

					case 'ATO':
						$otherDetails = [DB::table('assessmentrecommendation')->where('appid',$appid)->first(), DB::table('x08_ft')->where('appid',$appid)->whereIn('facid',['H','H2','H3'])->exists()];
						$ftr_msg_facility = (DB::table('hfaci_grp')->select('ftr_msg_ato')->where('hgpid',$hgpid)->first())->ftr_msg_ato;
						break;

					case 'COR':
						$otherDetails = [DB::table('assessmentrecommendation')->where('appid',$appid)->first(), DB::table('x08_ft')->where('appid',$appid)->whereIn('facid',['H','H2','H3'])->exists()];
						$ftr_msg_facility = (DB::table('hfaci_grp')->select('ftr_msg_cor')->where('hgpid',$hgpid)->first())->ftr_msg_cor;
						break;

					case 'CON':
						$otherDetails = DB::table('con_evaluate')->where('appid',$appid)->first();
						break;
					
					default:
						$otherDetails = null;
						break;
				}
				
				$facilityTypeId = "No Facility Type"; 
				$serviceId = "No Service";

				if($hfser != $retTable[0]->hfser_id) {
					return redirect('client1/apply/app/'.$retTable[0]->hfser_id.'/'.$appid.'');
				}

				/*$x08_ft = DB::table('x08_ft')
						->where('appid',$appid)->join('facilitytyp','facilitytyp.facid','x08_ft.facid')
						->where('facilitytyp.servtype_id',2)->get();*/

				$x08_ft = DB::table('x08_ft')->select('x08_ft.*', 'facilitytyp.*')
						->join('facilitytyp','facilitytyp.facid','=','x08_ft.facid')
						->leftJoin('appform','appform.appid','=','x08_ft.appid')
						->where('x08_ft.appid','=',$appid)
						->where(function ($query) {
							$query->where('servtype_id','=','2')
								->orWhere('appform.hgpid','=','1+
								');
						})->get();
				
				if(count($x08_ft) > 0){
					foreach($x08_ft as $table){
						if(!in_array($table->facname, $arrayFaci)){
							if($table->facid != 'AOASPT1' && $table->facid != 'AOASPT2'  ){
								array_push($arrayFaci, $table->facname);
							}
						}
					}
				}
				
				if(count($retTable) > 0) {
					if($retTable[0]->canapply != 2) {
						return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application not yet applied.']);
					}
				} else {
					return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No application selected']);
				}
			}
			$sData = FunctionsClientController::getServFaclDetails($appid); 

			if(count($sData[3])) {
				$impArr = [];
				$i = 0;
				$facname = "No Health Facility";

				foreach($sData[3] AS $facilityTypeRow) {

							array_push($impArr, $facilityTypeRow->hgpdesc);
							if($i == 0 ){
								$facname = 	$facilityTypeRow->hgpdesc;
							}
							$i++;
				}
				$facilityTypeId = implode(', ', $impArr);
				
			}
			if(count($sData[2])) {
				$impArr1 = [];
				foreach($sData[2] AS $serviceTypeRow) {
					array_push($impArr1, $serviceTypeRow->facname);
				}
				$serviceId = implode(', ', $impArr1);
			}

			$rgn = FunctionsClientController::isFacilityFor($appid);
			$hfser .= '1';

			$check =  DB::table('x08_ft')
							->join('facilitytyp','x08_ft.facid','facilitytyp.facid')
							->join('hfaci_grp','facilitytyp.hgpid','hfaci_grp.hgpid')
							->where([['x08_ft.appid',$appid] ])
							->whereNull('facilitytyp.specified')
							->orderBy('x08_ft.id', 'ASC')
							->first();

			$servname = '';
			$servname_new ='';
			
			//to be corrected. need to placed on db
			if(!is_null($check)){
				$servname = $check->facname;
				$servname_new = $check->facname;

				$data = array(
				'Level 1 Hospital' => 'H1',
				'Level 2 Hospital' => 'H2',
				'Level 3 Hospital' => 'H3',
				'Level 1' => 'H1',
				'Level 2' => 'H2',
				'Level 3' => 'H3',

				'Kidney Transplant Facility' => 'KTF',
				'Newborn Screening Center' => 'NSC',
				'Human Stem Cell and Cell-Based or Cellular Therapy' => 'HSC',

				'Colorectal Surgery' => 'ASC',
				'General Surgery' => 'ASC',
				'Oral and Maxillo-Facial Surgery' => 'ASC',
				'Orthopedic Surgery' => 'ASC',
				'Ophthalmologic Surgery' => 'ASC',
				'Otolryngologic Surgery' => 'ASC',
				'Plastic/Reconstructive Surgery' => 'ASC',
				'Pediatric Surgery' => 'ASC',
				'Reproductive Health Surgery' => 'ASC',
				'Thoracic Surgery' => 'ASC',
				'Urologic Surgery' => 'ASC',

				'Hemodialysis' => 'DC',
				'Dental Laboratory' => 'DL',

				'Primary Clinical Laboratory' => 'CL',
				'Secondary Clinical Laboratory' => 'CL',
				'Tertiary Clinical Laboratory' => 'CL',

				'Primary Care Facility - Birthing Home' => 'BH',
				'Primary Care Facility - Infirmary' => 'I',
				'Primary Care Facility -  Infirmary' => 'I',

				'Acute Chronic' => 'AC',
				'Custodial' => 'CP',
				'Birthing Home' => 'BH',
				'Blood Center' => 'BC',
				'Ambulance Service Provider' => 'ASP',
				'Laboratory for Drinking Water Analysis*' => 'LW',
				'Regular Medical Facility' => 'MF',
				'Special Land-based Medical Facility' => 'MF',
				'Special Seafarer\'s Medical Facility' => 'MF',
				'Non-residential' => 'DR',
				'Residential' => 'DR',
				'Residential DATRC with OutPatient Facility' => 'DR',
				'Blood Station' => 'BS',
				'Blood Collection Unit' => 'BCU',
				'Special Clinical Authority' => 'SCL',
				
				'Drug Testing Laboratory-Confirmatory'=>'DTL',
				'Drug Testing Laboratory - Screening'=>'DTL'

				);

				$servname = $data[$check->facname];
			}
			$arrData = [
				'facname'=>$facname,
				'servname'=>$servname_new,
				'userInf'=>FunctionsClientController::getUserDetails(),
				'director'=>DB::table('branch')->where('regionid',$rgn)->first(),
				'm99'=>DB::table('m99')->first(),
				'retTable'=>$retTable, 
				'facilityTypeId'=>$facilityTypeId, 
				'serviceId'=>$serviceId,
				'addons' => $arrayFaci,
				'x08_ft' => $x08_ft,
				'services' => AjaxController::getHighestApplicationFromX08FT($appid),
				'newservices' => $servname,
				'otherDetails' => $otherDetails,
				'ftr_msg_facility'=> $ftr_msg_facility,
				'viewFor' => (session()->has('employee_login') && $viewFor == 'employee' ? 'employee' : 'client')
			];
			// dd($arrData);
			return view('client1.certificates.'.$hfser, $arrData);
		} catch(Exception $e) {
			dd($e);
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Issuance. Contact the admin.']);
		}
	}

	public function viewCertExt(Request $request, $appid) {
		try {
			if(DB::table('appform')->where([['appform.appid',$appid],['appform.isApprove',1]])->doesntExist()){
				return 'Application Does not Exist';
			}
			$uid = AjaxController::getUidFrom($appid);
			$arrayFaci = $arrayserv = array();
			$retTable = FunctionsClientController::getUserDetailsByAppform($appid,$uid);
			$x08_ft = DB::table('x08_ft')->where('appid',$appid)->join('facilitytyp','facilitytyp.facid','x08_ft.facid')->where('facilitytyp.servtype_id',1)->get();
			// dd($x08_ft);
			foreach($x08_ft as $table){
				if($table->servtype_id == 1){
					if(!in_array($table->facname, $arrayFaci)){
						array_push($arrayFaci, $table->facname);
					}
				}
			}
			$ptcdet=[];
			$serviceId = null;

			$check =  DB::table('x08_ft')
							->join('facilitytyp','x08_ft.facid','facilitytyp.facid')
							->join('hfaci_grp','facilitytyp.hgpid','hfaci_grp.hgpid')
							->where([['x08_ft.appid',$appid] ])
							->whereNull('facilitytyp.specified')
							->orderBy('x08_ft.id', 'ASC')
							->first();

			$servname = '';
			$servname_new ='';
			
			//to be corrected. need to placed on db
			if(!is_null($check)){
				$servname = $check->facname;
				$servname_new = $check->facname;

				$data = array(
				'Level 1 Hospital' => 'H1',
				'Level 2 Hospital' => 'H2',
				'Level 3 Hospital' => 'H3',
				'Level 1' => 'H1',
				'Level 2' => 'H2',
				'Level 3' => 'H3',

				'Kidney Transplant Facility' => 'KTF',
				'Newborn Screening Center' => 'NSC',
				'Human Stem Cell and Cell-Based or Cellular Therapy' => 'HSC',

				'Colorectal Surgery' => 'ASC',
				'General Surgery' => 'ASC',
				'Oral and Maxillo-Facial Surgery' => 'ASC',
				'Orthopedic Surgery' => 'ASC',
				'Ophthalmologic Surgery' => 'ASC',
				'Otolryngologic Surgery' => 'ASC',
				'Plastic/Reconstructive Surgery' => 'ASC',
				'Pediatric Surgery' => 'ASC',
				'Reproductive Health Surgery' => 'ASC',
				'Thoracic Surgery' => 'ASC',
				'Urologic Surgery' => 'ASC',

				'Hemodialysis' => 'DC',
				'Dental Laboratory' => 'DL',

				'Primary Clinical Laboratory' => 'CL',
				'Secondary Clinical Laboratory' => 'CL',
				'Tertiary Clinical Laboratory' => 'CL',

				'Primary Care Facility - Birthing Home' => 'BH',
				'Primary Care Facility - Infirmary' => 'I',
				'Primary Care Facility -  Infirmary' => 'I',

				'Acute Chronic' => 'AC',
				'Custodial' => 'CP',
				'Birthing Home' => 'BH',
				'Blood Center' => 'BC',
				'Ambulance Service Provider' => 'ASP',
				'Laboratory for Drinking Water Analysis*' => 'LW',
				'Regular Medical Facility' => 'MF',
				'Special Land-based Medical Facility' => 'MF',
				'Special Seafarer\'s Medical Facility' => 'MF',
				'Non-residential' => 'DR',
				'Residential' => 'DR',
				'Residential DATRC with OutPatient Facility' => 'DR',
				'Blood Station' => 'BS',
				'Blood Collection Unit' => 'BCU',
				'Special Clinical Authority' => 'SCL',
				
				'Drug Testing Laboratory-Confirmatory'=>'DTL',
				'Drug Testing Laboratory - Screening'=>'DTL'

				);

				$servname = $data[$check->facname];
			}


			$facname = "No Health Facility";
			//approvedDate  for date issued
			$issued_date = ((isset($retTable[0]->approvedDate)) ? date_format(date_create($retTable[0]->approvedDate),"F d, Y ")  : 'Not Specified');
			
			switch ($retTable[0]->hfser_id) {
				case 'PTC':
					$ptcdet = DB::table('ptc')->where([['appid',$appid]])->first();
					// $otherDetails = DB::table('hferc_evaluation')->where([['appid',$appid],['HFERC_eval',1]])->first();
					$otherDetails = DB::table('hferc_evaluation')->join('hferc_team', 'hferc_evaluation.HFERC_evalBy', '=', 'hferc_team.uid')
					->where([['hferc_evaluation.appid',$appid],['hferc_evaluation.HFERC_eval',1],['hferc_team.pos','C']])
					->first();
					break;

				case 'LTO':

					$check =  DB::table('x08_ft')
					->join('facilitytyp','x08_ft.facid','facilitytyp.facid')
					->join('hfaci_grp','facilitytyp.hgpid','hfaci_grp.hgpid')
					->where([['x08_ft.appid',$appid],['facilitytyp.hgpid',6] ])
					->whereNull('facilitytyp.specified')
					->orderBy('x08_ft.id', 'ASC')
					->first();
		
					
					if(!is_null($check)){
						$servname = $check->facname;
					}

					$sData = FunctionsClientController::getServFaclDetails($appid);
					if(count($sData[3])) {
									$impArr = [];
									$i = 0;
									
									foreach($sData[3] AS $facilityTypeRow) {

												array_push($impArr, $facilityTypeRow->hgpdesc);
												if($i == 0 ){
													$facname = 	$facilityTypeRow->hgpdesc;
												}
												$i++;
									}
					}

					//$otherDetails = DB::table('assessmentrecommendation')->where([['appid',$appid],['choice','issuance']])->first();
					$otherDetails = [DB::table('assessmentrecommendation')->where([['appid',$appid],['choice','issuance']])->first(), DB::table('x08_ft')->where('appid',$appid)->whereIn('facid',['H','H2','H3'])->exists()];
					break;

				case 'CON':
					$otherDetails = DB::table('con_evaluate')->where('appid',$appid)->first();

					$serviceType = DB::select("SELECT facname FROM facilitytyp WHERE facilitytyp.facid IN (SELECT facid FROM x08_ft WHERE appid = '$appid')");
					if(count($serviceType)) {
						$impArr1 = [];
						foreach($serviceType AS $serviceTypeRow) {
							array_push($impArr1, $serviceTypeRow->facname);
						}
						$serviceId = implode(', ', $impArr1);
					}

					break;
				
				default:
					$otherDetails = null;
					break;
			}
			$arrData = [
				'retTable' => $retTable,
				'servCap' => $arrayFaci,
				'ptcdet' => $ptcdet,
				'otherDetails' => $otherDetails,
				'serviceId'=>$serviceId,
				'servname'=>$servname_new,
				'newservices' => $servname,
				'facname' => $facname,
				'issued_date' => $issued_date
			];
			// dd($arrData['retTable'][0]->office);
			return view('client1.certificates.certView', $arrData);
		} catch(Exception $e) {
			dd($e);
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Issuance. Contact the admin.']);
		}
	}
	public function viewCert($appid){
		if(session()->has('uData')){
			$hfer = AjaxController::gethfer_id($appid);
			return redirect('client1/certificates/'.$hfer.'/'.$appid);
		}
	}
	public function __pgPayment(Request $request, $token, $appid) {
		if(FunctionsClientController::isUserApplication($appid)){
			try {
				$cSes = FunctionsClientController::checkSession(true);
				if(count($cSes) > 0) {
					return redirect($cSes[0])->with($cSes[1], $cSes[2]);
				}
				if($token == FunctionsClientController::getToken()) {
					$amount = 0; 
					foreach(FunctionsClientController::getChgfilTransactions($appid, 'C') AS $each) { 
						if($each->m04ID_FK == null && $each->recievedBy == null){
							$amount += $each->amount; 
						}
					}
					
					$af = DB::table('appform')->where('appid',$appid)->first();

					if($af->aptid == 'R'){
						$discounts =  DB::table('application_discount')
						->where('date_start', '<', Carbon::parse($af->created_at))
						->where('date_end', '>', Carbon::parse($af->created_at))
						->where('type', 'Renewal')
						->where('status', '1')
						->get();
					} else {
						$discounts =  DB::table('application_discount')
						->where('date_start', '<', Carbon::parse($af->created_at))
						->where('date_end', '>', Carbon::parse($af->created_at))
						->where('type', 'Initial')
						->where('status', '1')
						->get();
					}

		
					foreach ($discounts as $dkey => $dvalue) {
						$discount = $dvalue->percentage;
						$discountdecimal = floatval(floatval($discount) / 100);
						$discountprice = $discountdecimal * floatval($amount);
						$amount = floatval($amount) - floatval($discountprice);
					}

					$arrRet = [
						'userInf'=>FunctionsClientController::getUserDetails(),
						'appDet'=>FunctionsClientController::getUserDetailsByAppformWithTransactions($appid),
						'totalWord'=>[$amount, FunctionsClientController::moneyToString($amount)],
						'neededData' => [FunctionsClientController::getUserDetailsByAppform($appid)[0],FunctionsClientController::getServFaclDetails($appid)],
						'Notfinal' => DB::table('appform')->where([['isPayEval',1],['appid',$appid]])->exists(),
						'isDisplayABC' => DB::table('x08_ft')->where('appid',$appid)->whereIn('facid',['H','H2','H3'])->exists()
					];

					if($af->aptid == 'R'){
						$arrRet['discounts'] =  DB::table('application_discount')
						->where('date_start', '<', Carbon::parse($af->created_at))
						->where('date_end', '>', Carbon::parse($af->created_at))
						->where('type', 'Renewal')
						->where('status', '1')
						->get();
					} else {
						$arrRet['discounts'] =  DB::table('application_discount')
						->where('date_start', '<', Carbon::parse($af->created_at))
						->where('date_end', '>', Carbon::parse($af->created_at))
						->where('type', 'Initial')
						->where('status', '1')
						->get();
					}				

					return view('client1.payment.defaultpayment', $arrRet);
				}
				return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Incorrect token.']);
			} catch(Exception $e) {
				return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Order of Payment Module. Contact the admin.']);
			}

		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}
	public function __fdaPayment(Request $request, $token, $appid) {
		if(FunctionsClientController::isExistOnAppform($appid) !== true){
			return redirect('client1/home');
		}
		try {
			if($token == FunctionsClientController::getToken()){
				$data = [
					'fda' => FunctionsClientController::getDetailsFDA($appid)
				];
				if(is_array($data['fda'])){
					return view('client1.payment.fdapayment',$data);	
				} else {
					return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>FunctionsClientController::getDetailsFDA($appid)]);
				}
			}
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Incorrect token.']);
		}
		catch (Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Order of Payment Module. Contact the admin.']);
		}
	}

	public function fdacert(Request $request, $appid, $requestOfClient = null) {
		if(FunctionsClientController::isExistOnAppform($appid) !== true || !FunctionsClientController::existOnDB('fdacert',[['appid',$appid],['department',(AjaxController::isRequestForFDA($requestOfClient) == 'machines' ? 'cdrrhr' : 'cdrr')]]) || !isset($requestOfClient)){
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No records Found.']);
		}
		try {
			$selection = (AjaxController::isRequestForFDA($requestOfClient) == 'machines' ? 'cdrrhr' : 'cdrr');
			
			$data = DB::table('fdacert')->where([['fdacert.appid',$appid],['fdacert.department',$selection]])->join('appform','appform.appid','fdacert.appid')->leftjoin('x08','x08.uid','appform.uid')->leftjoin('apptype','appform.aptid','apptype.aptid')->select('appform.*','fdacert.*','x08.authorizedsignature','apptype.aptdesc')->first();

			if($data){
				if(AjaxController::isRequestForFDA($requestOfClient) != 'machines'){
				
					$view = ($data->certtype == 'COC' ? 'client1.FDA.coc' : 'client1.FDA.rl');
				} else {
					// $view = ($data->certtype == 'COC' ? 'client1.FDA.linac' : 'client1.FDA.cdrrhrRL');
					$view = ($data->certtype == 'COC' ? 'client1.FDA.cdrrhrCOC' : 'client1.FDA.cdrrhrRL');
					$machineData = DB::table('cdrrhrxraylist')->where('appid',$appid)->get();
				}
				$arrRet = [
					'appform' => DB::table('appform')->where('appid',$appid)->first(),
					'data' => $data,
					'machineData' => isset($machineData) ? $machineData : null,
					'otherDetails' => [DB::table('hfsrbannexa')->where([['appid',$appid],['isMainRadio',1]])->first(),DB::table('hfsrbannexa')->where([['appid',$appid],['isMainRadioPharma',1]])->first(),DB::table('hfsrbannexa')->where([['appid',$appid],['ismainpo',1]])->first()]
				];
				return view($view,$arrRet);
			}
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No records Found.']);
		}
		catch (Exception $e) {
			dd($e);
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Order of Payment Module. Contact the admin.']);
		}
	}
public function fdacertN(Request $request, $appid, $requestOfClient = null) {
		if(FunctionsClientController::isExistOnAppform($appid) !== true || !FunctionsClientController::existOnDB('fdacert',[['appid',$appid],['department',(AjaxController::isRequestForFDA($requestOfClient) == 'machines' ? 'cdrrhr' : 'cdrr')]]) || !isset($requestOfClient)){
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No records Found.']);
		}
		try {
			$selection = (AjaxController::isRequestForFDA($requestOfClient) == 'machines' ? 'cdrrhr' : 'cdrr');
			
			$data = DB::table('fdacert')->where([['fdacert.appid',$appid],['fdacert.department',$selection]])->join('appform','appform.appid','fdacert.appid')->leftjoin('x08','x08.uid','appform.uid')->leftjoin('apptype','appform.aptid','apptype.aptid')->select('appform.*','fdacert.*','x08.authorizedsignature','apptype.aptdesc')->first();
		
			$chk = DB::table('fdaevaluation')->where([['appid', $appid], ['requestFrom', $requestOfClient == 'machines'? 'machines': 'pharma']])
			->orderBy('fdaevaluation.evalid','DESC')
			->first();

			$dets = [];
			$cheifradt = '';
			$hfsrbannexb = [];
			$cdrrhrxraylist = [];
			$required = array(
				'required1' => '',
				'required2' => '',
				'required3' => ''
			);
		
			if($data){

				$getLevel = 0;
				if(AjaxController::isRequestForFDA($requestOfClient) != 'machines'){

					if($chk->decision == 'RLN'){
						$view = 'client1.FDA.newFDARL';
					}else{
						$view = 'client1.FDA.coc';
					}
				
					// $view = ($data->certtype == 'COC' ? 'client1.FDA.coc' : 'client1.FDA.rl');
				} else {
					// $view = ($data->certtype == 'COC' ? 'client1.FDA.linac' : 'client1.FDA.cdrrhrRL');					
					
					// $view = ($data->certtype == 'COC' ? 'client1.FDA.cdrrhrCOC' : 'client1.FDA.cdrrhrRL');

					$getannexa = DB::table('hfsrbannexa')->where([['appid', $appid]])->get();
						
					foreach($getannexa as $a){
						if($a->isChiefRadTech == 1){
							$mn = $a->middlename;
							$cheifradt = ucfirst($a->firstname).' '.ucfirst($mn[0]).'. '. ucfirst($a->surname);
						}
					}

					$required1 = '';
					$required2 = '';
					$required3 = '';

					foreach($getannexa as $a){

						$professions = json_decode($a->profession);

						if(is_array($professions)){
							$mn = $a->middlename;
							foreach($professions as $profession){
								if($profession == '1'){
									$required1 = ucfirst($a->firstname).' '.ucfirst($mn[0]).'. '. ucfirst($a->surname);
								}

								if($profession == '10'){
									$required2 = ucfirst($a->firstname).' '.ucfirst($mn[0]).'. '. ucfirst($a->surname);
								}

								if($profession == '3' || $profession == '5'){
									$required3 = ucfirst($a->firstname).' '.ucfirst($mn[0]).'. '. ucfirst($a->surname);
								}
							}
						}
					}

					$required = array(
						'required1' => $required1,
						'required2' => $required2,
						'required3' => $required3
					);

					if($chk->decision == 'LINAC'){

						$xrserv = DB::table('cdrrhrxrayservcat')->where([['appid', $appid]])->first();
						$arrserv = array($xrserv->selected);

						$arrayToCheck = array();
						foreach ($arrserv as $value) {
							$ct = DB::table('fda_xrayserv')->where([['servid', $value]])->first();
							if(!in_array($ct->catid, $arrayToCheck)){
								array_push($arrayToCheck, $ct->catid);
							}
						}
						
						$getLevel = max($arrayToCheck);

						$getannexa = DB::table('hfsrbannexa')->where([['appid', $appid]])->get();

						
						foreach($getannexa as $a){
							if($a->isChiefRadTech == 1){
								$mn = $a->middlename;
								$cheifradt = ucfirst($a->firstname).' '.ucfirst($mn[0]).'. '. ucfirst($a->surname);
							}
						}

					

						$hfsrbannexb =  DB::table('hfsrbannexb')->where('appid',$appid)->get();
						$cdrrhrxraylist = DB::table('cdrrhrxraylist')->join('fda_xraymach','cdrrhrxraylist.machinetype','fda_xraymach.xrayid')/*->leftJoin('fda_xraymach','cdrrhrxraylist.location','fda_xraymach.xrayid')*/->where('appid',$appid)->get();

						$dets = [DB::table('assessmentrecommendation')->where([['appid',$appid],['choice','issuance']])->first(), DB::table('x08_ft')->where('appid',$appid)->whereIn('facid',['H','H2','H3'])->exists()];

						$view = 'client1.FDA.linac';
					}else if($chk->decision == 'NOD'){
						$view = 'client1.FDA.machNOD';
					}
					else{
						
						$view = 'client1.FDA.cdrrhrCOC';
					}
					
					$machineData = DB::table('cdrrhrxraylist')->where('appid',$appid)->get();
				}
				$arrRet = [
					'appform' => DB::table('appform')->where('appid',$appid)->first(),
					'data' => $data,
					'getLevel' => $getLevel,
					'hfsrbannexb' => $hfsrbannexb,
					'cdrrhrxraylist' => $cdrrhrxraylist,
					'cheifradt' => $cheifradt,
					'required' => $required,
					'dets' => $dets,
					'machineData' => isset($machineData) ? $machineData : null,
					'otherDetails' => [DB::table('hfsrbannexa')->where([['appid',$appid],['isMainRadio',1]])->first(),DB::table('hfsrbannexa')->where([['appid',$appid],['isMainRadioPharma',1]])->first(),DB::table('hfsrbannexa')->where([['appid',$appid],['ismainpo',1]])->first()]
				];
				return view($view,$arrRet);
			}
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No records Found.']);
		}
		catch (Exception $e) {
			dd($e);
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Order of Payment Module. Contact the admin.']);
		}
	}

	public function reqReEval(Request $request) {
		try {
		$curapp = 	DB::table('appform')->where([['appid', $request->appid]])->first();

		$newcount = $curapp->reevalcount + 1;
		
			DB::table('appform')->where([['appid',  $request->appid]])->update(['requestReeval' => 1, 
			'reevalcount'=> $newcount, 
			'status' => 'FREV', 
			'isRecoForApproval' => null
		]);

			return 'succ';
		
		}
		catch (Exception $e) {
			return 'failed';
		}
	}

	public function __fdaPaymentCDRR(Request $request, $token, $appid) {
		if(FunctionsClientController::isExistOnAppform($appid) !== true){
			return redirect('client1/home');
		}
		try {
			if($token == FunctionsClientController::getToken()){
				$data = [
					'fda' => FunctionsClientController::getDetailsFDACDRR($appid)
				];
				if(is_array($data['fda'])){
					return view('client1.payment.fdapaymentCDRR',$data);	
				} else {
					return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>FunctionsClientController::getDetailsFDACDRR($appid)]);
				}
			}
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Incorrect token.']);
		}
		catch (Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Order of Payment Module. Contact the admin.']);
		}
	}

	public function __applyhfsrb(Request $request, $hfser, $appid, $hideExtensions = NULL) {
		try {
			if($request->isMethod('get')){
				$hfLocs = ['client1/apply/app/LTO/'.$appid, 'client1/apply/app/LTO/'.$appid.'/hfsrb', 'client1/apply/app/LTO/'.$appid.'/fda', 'client1/printPayment/'.FunctionsClientController::getToken().'/'.$appid];
				if(isset($hideExtensions)) {
					$hfLocs = ['client1/apply/employeeOverride/app/LTO/'.$appid, 'client1/apply/employeeOverride/app/LTO/'.$appid.'/hfsrb', 'client1/apply/employeeOverride/app/LTO/'.$appid.'/fda', 'client1/printPayment/'.FunctionsClientController::getToken().'/'.$appid];
				}
				if(! isset($hideExtensions)) {
					$cSes = FunctionsClientController::checkSession(true);
					if(count($cSes) > 0) {
						return redirect($cSes[0])->with($cSes[1], $cSes[2]);
					}
				}
				$appDet = FunctionsClientController::getUserDetailsByAppform($appid, $hideExtensions);
				if(count($appDet) < 1) {
					return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No application selected.']);
				}

				// $sb = DB::table('appform')->where('appid', $appid)->first();
				// $subclass = 'none';
				// if(!is_null($sb->subclassid)){
				// 	$subclass =$sb->subclassid;
				// }
				$checkRadio = DB::table('x08_ft')->where([['appid', $appDet[0]->appid]])
					->whereIn('facid',['H1A1LXR', 'H2A2LX', 'H3A3XR', 'mfowsRMF', 'S-SLBMF', 'S-SSMF'])
					->first();

				$hasRadio = false;

				if(!is_null($checkRadio)){
					$hasRadio = true;
				}

				$arrRet = [
					'userInf'=>FunctionsClientController::getUserDetails(),
					'addresses'=>$hfLocs,
					'fAddress'=>$appDet,
					'subclass'=> $appDet[0]->subClassid ,
					'hideExtensions'=>$hideExtensions,
					'appid'=>$appDet[0]->appid,
					'hfser_id'=>$appDet[0]->hfser_id,
					'isReadyForInspecFDA'=>$appDet[0]->isReadyForInspecFDA,
					'appform'=>$appDet[0],
					'hasRadio'=>$hasRadio,
					'data' =>AjaxController::getAllRequirementsLTO($appid)
				];
				// dd($arrRet);
				return view('client1.apply.LTO1.ltohfsrb', $arrRet);
			} else {
				if(isset($request->readyNow)){
					$ret = DB::table('appform')->where('appid',$appid)->update(['isReadyForInspec' => 0, 'status'=> 'CRFE']);
					// $ret = DB::table('appform')->where('appid',$appid)->update(['isReadyForInspec' => 1, 'status'=> 'FE']);
					if($ret){
						return 'succ';
					}
					return 'fail';
				}
			}
		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on HFSRB Module. Contact the admin.']);
		}
	}
	public function __applyfda(Request $request, $hfser, $appid, $hideExtensions = NULL) {
		try {
			if($request->isMethod('get')){

				$hfLocs = ['client1/apply/app/LTO/'.$appid, 'client1/apply/app/LTO/'.$appid.'/hfsrb', 'client1/apply/app/LTO/'.$appid.'/fda', 'client1/printPaymentFDA/'.FunctionsClientController::getToken().'/'.$appid, 'client1/printPaymentFDACDRR/'.FunctionsClientController::getToken().'/'.$appid];
				
				if(isset($hideExtensions)) {
					$hfLocs = ['client1/apply/employeeOverride/app/LTO/'.$appid, 'client1/apply/employeeOverride/app/LTO/'.$appid.'/hfsrb', 'client1/apply/employeeOverride/app/LTO/'.$appid.'/fda', 'client1/printPaymentFDA/'.FunctionsClientController::getToken().'/'.$appid];
				}
				if(! isset($hideExtensions)) {
					$cSes = FunctionsClientController::checkSession(true);
					if(count($cSes) > 0) {
						return redirect($cSes[0])->with($cSes[1], $cSes[2]);
					}
				}
				$appDet = FunctionsClientController::getUserDetailsByAppform($appid, $hideExtensions);

				if(count($appDet) < 1) {
					return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No application selected.']);
				}

				$checkRadio = DB::table('x08_ft')->where([['appid', $appid]])
					->whereIn('facid',['H1A1LXR', 'H2A2LX', 'H3A3XR', 'mfowsRMF', 'S-SLBMF', 'S-SSMF'])
					->first();

				$hasRadio = false;

				if(!is_null($checkRadio)){
					$hasRadio = true;
				}
				$data = AjaxController::getRequirementsFDA($appid);
								
				$arrRet = [
					'userInf'=>FunctionsClientController::getUserDetails(),
					'addresses'=>$hfLocs,
					'hasRadio'=>$hasRadio,
					'fAddress'=>$appDet,
					'hideExtensions'=>$hideExtensions,
					'appid' => $appid,
					'data' => $data //AjaxController::getRequirementsFDA($appid)
				];
				
				// if($appDet[0]->aptid == 'R'){
				// 	return view('client1.apply.LTO1.ltofdar', $arrRet);
				// }

				return view('client1.apply.LTO1.ltofda', $arrRet);
			}
			else {
				if(isset($request->readyNow)){
					
					$toAppform = [];
					//$pharma = NewClientController::hasEmptyRequiredReqFDAPersonnel(['prc','coe']);
					$pharma = FunctionsClientController::hasEmptyDBFields('cdrrpersonnel',['appid' => $appid],['prc','coe']);
					$mach = FunctionsClientController::hasEmptyDBFields('cdrrhrpersonnel',['appid' => $appid],['prc','bc','coe']);
					$pharmaattc = DB::table('cdrrhrotherattachment')->where([['appid', $appid]])->first();  // this is not pharmacy, but, other attachment of Radiology.
					$servcat = DB::table('cdrrhrxrayservcat')->where([['appid', $appid]])->first();
					$requiredQualifications =  DB::table('cdrrhrpersonnel')
												->select('cdrrhrpersonnel.*','hfsrbannexa.*')
												->join('hfsrbannexa', 'cdrrhrpersonnel.hfsrbannexaID', '=', 'hfsrbannexa.id')
												->where([['cdrrhrpersonnel.appid', $appid]])->get();
					
					$required1 = false;
					$required2 = false;
					$required3 = false;

					foreach ($requiredQualifications as $requiredQualification) {
						$professions = json_decode($requiredQualification->profession);

					
						if(is_array($professions)){

							foreach($professions as $profession){
								if($profession == '1' || $profession == '27'){
									$required1 = true;
								}

								if($profession == '10'){
									$required2 = true;
								}

								if($profession == '3' || $profession == '5' || $profession == '28'  || $profession == '29'){
									$required3 = true;
								}
							}
						}
					}
	

					$checkRadio = DB::table('x08_ft')->where([['appid', $appid]])
								->whereIn('facid',['H1A1LXR', 'H2A2LX', 'H3A3XR', 'mfowsRMF', 'S-SLBMF', 'S-SSMF'])
								->first();

					$machfilt1 = $mach[2];
					$machfilt2 = $mach[0];

					if(!is_null($checkRadio)){
						$machfilt1 =  $mach[2];
						$machfilt2 = $mach[0];
						$chkserve = !is_null($servcat) ? true : false;
					}else{
						$machfilt1 = true;
						$machfilt2 = false;
						$chkserve = true;
						$required1 = true;
						$required2 = true;
						$required3 = true;
					}
					
					// if($pharma[2] == true && $mach[2] == true){
					// if($pharma[2] == true && $mach[2] == true && !is_null($pharmaattc)&& !is_null($servcat)){
					// if(!$pharma[0] && !$mach[0]  && !is_null($pharmaattc) && !is_null($servcat)){

					$appform = FunctionsClientController::getUserDetailsByAppform($appid)[0];
					
					$renewal_checker = true;

					if(isset($appform->aptid)){
						if($appform->aptid == 'R') {
							$cocp = DB::table('fda_coc')->where('appid', $appid)->where('fda_type', 'Pharmacy')->first();
							$cocr = DB::table('fda_coc')->where('appid', $appid)->where('fda_type', 'Radiology')->first();
							
							if((is_null($cocp) && $appform->hfser_id != 'COA') || is_null($cocr)){
								$renewal_checker = false;
							}
						}
					}

					if(($required1 == true && $required2 == true && $required3 == true ) && ($pharma[2] == true || $appform->hfser_id == 'COA') && $machfilt1 == true && !is_null($pharmaattc)&& $chkserve == true && $renewal_checker == true){

						if(!$pharma[0] && !$machfilt2  && !is_null($pharmaattc) && $chkserve == true ){
				
							$ret = DB::table('appform')->where('appid',$appid)->update(['isReadyForInspecFDA' => 1]);
							if($ret){
								$lrf = $lrfForPharma = 0;
								$dataMach = DB::table('cdrrhrxraylist')->select('id','maxma')->where('appid',$appid)->get();

								$appform = FunctionsClientController::getUserDetailsByAppform($appid)[0];
								$cdrr = FunctionsClientController::getDetailsFDACDRR($appid);
								$findIn = 'initial_amnt';
								
								if(isset($appform->aptid)){
									switch (true) {
										case ($appform->aptid == 'IN'):
											$findIn = 'initial_amnt';
											break;
										case ($appform->aptid == 'R'):
											$findIn = 'renewal_amnt';
											break;
									}
								}

								foreach($dataMach as $mach){
									$price = DB::table('fdarange')->select($findIn, 'id')->where('rangeFrom','<=',$mach->maxma)->where('rangeTo','>=',$mach->maxma)->first();
									$lrf += ($price->$findIn <= 1000 ? 10 : ($price->$findIn /100));
									$toChgfil = DB::table('fda_chgfil')->insert(['appid' => $appid, 'fchg_code' => $price->id, 'xray_listID' => $mach->id ,'MAvalue' => $mach->maxma, 'amount' => $price->$findIn, 't_date' => Carbon::now()->toDateString(), 't_time' => Carbon::now()->toTimeString(), 'uid' => session()->get('uData')->uid, 'ipaddress' => request()->ip()]);
								}

								if(isset($cdrr[3])){ 	
									if($cdrr[3] != ' '){
										$prices = DB::table('fda_pharmacycharges')->get();
										// main
										if(isset($cdrr[3][0]) && isset($prices)){
											for ($i=0; $i < $cdrr[3][0]; $i++) { 
												$lrfForPharma += ($prices[0]->price * 0.01) /* ($prices[0]->price <= 1000 ? 10 : ($prices[0]->price /100)) */;
											}
										}
										// sattelite
										if(isset($cdrr[3][1]) && isset($prices)){
											for ($j=0; $j < $cdrr[3][1]; $j++) { 
												$lrfForPharma +=  ($prices[0]->price * 0.01) /* ($prices[1]->price <= 1000 ? 10 : ($prices[1]->price /100)) */;
											}										}

										DB::table('fda_chgfil')->insert(['appid' => $appid, 'fchg_code' => null, 'xray_listID' => null ,'MAvalue' => null, 'amount' => isset($cdrr[2]) ? $cdrr[2] : null, 't_date' => Carbon::now()->toDateString(), 't_time' => Carbon::now()->toTimeString(), 'uid' => session()->get('uData')->uid, 'ipaddress' => request()->ip()]);
										DB::table('fda_chgfil')->insert(['appid' => $appid, 'fchg_code' => null, 'xray_listID' => null ,'MAvalue' => null, 'amount' => $lrfForPharma, 't_date' => Carbon::now()->toDateString(), 't_time' => Carbon::now()->toTimeString(), 'uid' => 'SYSTEM', 'lrfFor' => 'cdrr', 'ipaddress' => request()->ip()]);
									}
								}			

								$sum = DB::table('fda_chgfil')->where([['appid',$appid],['amount', '>', 0]])->sum('amount');

								if(!empty($dataMach)){
									DB::table('fda_chgfil')->insert(['appid' => $appid, 'amount' => $lrf, 't_date' => Carbon::now()->toDateString(), 't_time' => Carbon::now()->toTimeString(), 'lrfFor' => 'cdrrhr', 'uid' => 'SYSTEM', 'ipaddress' => request()->ip()]);
								}
							
								// pharmacy
								if(FunctionsClientController::hasRequirementsFor('cdrr',$appid)){
									$toAppform['isPayEvalFDAPharma'] = 1;
									$toAppform['payEvalbyFDAPharma'] = 'SYSTEM';
									$toAppform['payEvaldateFDAPharma'] = Carbon::now()->toDateString();
									$toAppform['payEvaltimeFDAPharma'] = Carbon::now()->toTimeString();
									$toAppform['payEvalipFDAPharma'] = request()->ip();
								}
								
								// machines
								if(FunctionsClientController::hasRequirementsFor('cdrrhr',$appid)){

									$toAppform['isPayEvalFDA'] = 1;
									$toAppform['payEvalbyFDA'] = 'SYSTEM';
									$toAppform['payEvaldateFDA'] = Carbon::now()->toDateString();
									$toAppform['payEvaltimeFDA'] = Carbon::now()->toTimeString();
									$toAppform['payEvalipFDA'] = request()->ip();
								}

							$chapp = DB::table('appform')->where([['appid', $appid]])->first();
							if($chapp->machDocNeedRev == 1){
								$toAppform['FDAStatMach'] = 'Resubmitted, for re-evaluation';
								$toAppform['machDocNeedRev'] = null;

							}

							if($chapp->pharDocNeedRev == 1){
								$toAppform['FDAStatPhar'] = 'Resubmitted, for re-evaluation';
								$toAppform['pharDocNeedRev'] = null;
							}

								isset($toAppform) ? DB::table('appform')->where('appid',$appid)->update($toAppform) : '';
								
							}
							return 'succ';
						} else {

							$initial = 'Please provide Personnel on Pharmacy and Radiology and make sure to submit all requirements. Following are lacking requirements. ';
							if($pharma[2] == true){
								$pharMsg = $pharma[0] ? "For Pharmacy: " . implode(",",$pharma[1]). ". ": "";
							}else{
								$pharMsg = "\n - No personnel yet on Pharmacy. ";
							}

							if($mach[2] == true && !is_null($checkRadio)){
								$radMsg = $mach[0] ? "For Radiology: " . implode(",",$mach[1]). ". ": "";
							}else{
								$radMsg = "\n - No personnel yet on Radiology. ";
							}

							$attchp = "";
							if(is_null($pharmaattc)){
								$attchp = "\n - No Attachment found at Other Attachments (CDRRHR)";
							}

							$sp = "";
							if(is_null($servcat) && !is_null($checkRadio)){
								$sp = "\n - No service category yet. ";
							}

							$message = $initial.$pharMsg.$radMsg.$attchp;

							return $message ;
							return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please provide Personnel on Pharmacy and Radiology.']);
						}
					}else{

						$mssg = "Please provide ";
						if($pharma[2] != true && ($mach[2] != true && !is_null($checkRadio))){
							$mssg .= " \n - Personnel on Pharmacy and Radiology and make sure to submit all requirements";
						}

						if(is_null($pharmaattc)){
							$mssg .= " \n - No Attachment found at Other Attachments (CDRRHR)";
						}

						if($required1 != true){
							$mssg .= " \n - Please input Chief X-ray Technologist or Chief Radiologic Technologist";
						}

						if($required2 != true){
							$mssg .= " \n - Please input Head of Radiology";
						}

						if($required3 != true){
							$mssg .= " \n -  Radiation Protection Officer";
						}

						if(isset($appform->aptid)){
							if($appform->aptid == 'R'  ) {
								if(is_null($cocp) && $appform->hfser_id != 'COA'){
									$mssg .= " \n - COC Pharmacy";
								}
	
								if(is_null($cocr)){
									$mssg .= " \n - COC Radiology";
								}
							}
						}

						if(is_null($servcat) && !is_null($checkRadio)){
							$mssg .= " \n - Service Category";
						}

						return $mssg ;
					}

					return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on FDA Module. Contact the admin.']);

				}
			}
		} catch(Exception $e) {
			dd($e);
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on FDA Module. Contact the admin.']);
		}
	}

	public static function hasEmptyRequiredReqFDAPersonnel ($fields = []) {
		$haslist = false;
		$arrEmpty = array();

		$res = DB::table('cdrrpersonnel')
					->select('cdrrpersonnel.coe', 'cdrrpersonnel.prc', 'position.groupRequired')
					->leftJoin('hfsrbannexa','cdrrpersonnel.hfsrbannexaID','=','hfsrbannexa.id')
					->leftJoin('position','position.posid','=','hfsrbannexa.prof')
					->where([['cdrrpersonnel.appid'=> $appid, 'position.groupRequired'=>'1' ]]);

		if(isset($fields)){
			$res2 = $res;

			if($res2->first()){

				$test = $res->get();

				foreach ($test as $key) {
					foreach ($fields as $field) {
						if(empty($key->$field)){
							if(!in_array($field, $arrEmpty)){
								array_push($arrEmpty, $field);
							}
						}
					}
				}

				$haslist = true;
				
			}else{
				$arrEmpty = array();
				$haslist = false;
			}
			
			return [(empty($arrEmpty) ? false : true),$arrEmpty, $haslist];
			// return [(empty($arrEmpty) ? false : true),$arrEmpty, $haslist];
		}
	}

	public function __novm(Request $request, $appid = "") {
		try {
			if(! empty($appid)) {
				$novm = FunctionsClientController::getNOVRecords($appid);
				if(count($novm) > 0) {
					$arrRet = [
						'userInf'=>FunctionsClientController::getUserDetails(),
						'Nov'=>$novm[0],
						'novTeams'=>DB::table('x08')->where([['team', $novm[0]->novteam]])->get()
					];
					return view('client1.nov', $arrRet);
				}
				return redirect('client1/home')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'No Notice of Violation associated with this application']);
			}
		} catch(Exception $e) {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on Notice on violation Module. Contact the admin.']);
		}
	}
	public function __editApp(Request $request, $hfser, $appid) 
	{
		$emp = FunctionsClientController::getSessionParamObj("employee_login");
		$appid1 = FunctionsClientController::getApplicationDetailsFEmployee($appid);
		
		if(isset($emp)) { 
			if(count($appid1) > 0) {
				//__applyApp
				return self::update_application($request, $hfser, $appid, $appid1[0]->uid);
			} 
		}
		return back()->with('errRet', ['system_error'=>'No employee on sight.']);
	}
	public function update_application(Request $request, $hfser, $appid, $hideExtensions = NULL, $aptid = NULL) 
	{
		//try 
		//{	
			$reg_fac_id = $appid; 
			$functype = 'main';
			$appform_changeaction 	= null;
			$nameofcomp 			= null;
			$validity 				= "";
			$user_data 				= session()->get('uData');
			$hgpid					= null;
			$appform 				= DB::table('viewAppFormForUpdate')->where('appid','=',$appid)->first();

			//try {
				if(true) 
				{
					$locRet 	= "dashboard.client.update-application";
					$hfser_id 	=  $appform->hfser_id;
					$nameofcomp = $appform->nameofcompany;	
					$regservices	= FunctionsClientController::get_view_reg_facility_services($reg_fac_id, 0);					
					$savingStat = NULL;
					$uid = "";

					//try {
						$validto 	= ($hfser_id == 'PTC') ? "" : strtolower($hfser_id).'_validityto';
						$validfrom 	= ($hfser_id == 'PTC') ? "" : strtolower($hfser_id).'_validityfrom';
						$validity 	= "";
						$issued_date = "";

						if($hfser_id == 'PTC') {
							$validity = 'Starting '.date_format(date_create($appform->ptc_approveddate),"F d, Y"); 
							$issued_date = date_format(date_create($appform->ptc_approveddate),"F d, Y");
						}
						elseif($hfser_id == 'LTO') {
							$validity = 'Until '.date_format(date_create($appform->lto_validityto),"F d, Y");
							$issued_date = date_format(date_create($appform->lto_approveddate),"F d, Y");
						}
						elseif($hfser_id == 'COA') {
							$validity = 'Until '.date_format(date_create($appform->coa_validityto),"F d, Y"); 
							$issued_date = date_format(date_create($appform->coa_approveddate),"F d, Y");
						}
						elseif($hfser_id == 'ATO') {
							$validity = 'Until '.date_format(date_create($appform->ato_validityto),"F d, Y"); 
							$issued_date = date_format(date_create($appform->ato_approveddate),"F d, Y");
						}						
					//} catch (Exception $e) { }	

					$data = [
						'appid'					=> $appid, //old app id
						'regfac_id'				=> $reg_fac_id,
						'functype'				=> $functype,
						'appform'				=> $appform,
						'validity'				=> $validity,
						'issued_date'			=> $issued_date,
						'uid'					=> $uid,
						'appform_changeaction'	=> $appform_changeaction,					
						'regservices'			=> $regservices,
						'chgfil_reg'			=> FunctionsClientController::getChargesByAppID($appid, "Facility Registration Fee", TRUE),
						'chgfil_sf'				=> FunctionsClientController::getChargesByAppID($appid, "Service Fee", TRUE),
						'chgfil_af'				=> FunctionsClientController::getChargesByAppID($appid, "Ambulance Fee", TRUE),
						'savingStat'			=> $savingStat				
						//DB::table('chgfil')->where([['appform_id', $appid]])->get()
					];
					
					if($functype == 'av')
					{					
						$data_reg 	= DB::table('view_registered_facility_for_change')->WHERE('regfac_id','=',$reg_fac_id )->first();
						$isaddnew 		= 1;
						$isupdate 		= 1;
						$reg_ambulance_temp = null;
						$appform_ambulance_temp = null;
						
						if (!is_null($appform)) { 
							$appform_ambulance_temp = [
								'typeamb' 		=> json_decode($appform->typeamb), 
								'ambtyp'		=> json_decode($appform->ambtyp), 
								'plate_number'	=> json_decode($appform->plate_number), 
								'ambOwner'		=> json_decode($appform->ambOwner)
							];
						}
						if (!is_null($data_reg) ){ 
							$reg_ambulance_temp = [
								'typeamb' 		=> json_decode($data_reg->typeamb), 
								'ambtyp'		=> json_decode($data_reg->ambtyp), 
								'plate_number'	=> json_decode($data_reg->plate_number), 
								'ambOwner'		=> json_decode($data_reg->ambOwner)
							];
						}
						//$appform_ambulance_temp= DB::table('appform')->WHERE('appid','=',$appid )->get();
						$appform_ambulance = null;
						$reg_ambulance = null;

						$appform_ambulance= DB::table('appform_ambulance')->select('typeamb', 'ambtyp', 'plate_number', 'ambOwner')->where('appid','=',$appid)->get();
						
						if(isset($reg_ambulance_temp))
						{
							foreach( $reg_ambulance_temp as $key=>$val)
							{
								if($key == "typeamb")
								{
									$d = $val;
			
									for($j=count($d)-1; 0 <= $j; $j--)
										$reg_ambulance[$j]['typeamb'] = $d[$j];
								}
								if($key == "ambtyp")
								{
									$d = $val;
			
									for($j=count($d)-1; 0 <= $j; $j--)
										$reg_ambulance[$j]['ambtyp'] = $d[$j];
								}
								if($key == "plate_number")
								{
									$d = $val;
			
									for($j=count($d)-1; 0 <= $j; $j--)
										$reg_ambulance[$j]['plate_number'] = $d[$j];
								}
								if($key == "ambOwner")
								{
									$d = $val;
			
									for($j=count($d)-1; 0 <= $j; $j--)
										$reg_ambulance[$j]['ambOwner'] = $d[$j];
								}
							}
						}

						$cat_id = 3;
						$data2 = [
							// 'grpid' =>  $grpid,
							'appform_ambulance'	=> $appform_ambulance,
							'reg_ambulance'		=> $reg_ambulance,
							'isaddnew'			=> $isaddnew,
							'isupdate'			=> $isupdate,
							'cat_id'			=> $cat_id
						];
						
						$data = array_merge($data, $data2);
					}
					else if($functype == 'cs' || $functype == 'as' || $functype == 'hospital')
					{	
						$cat_id			= 0;				
						$isaddnew 		= 0;
						$isupdate 		= 0;
						$mainservicelist = FunctionsClientController::get_view_ServiceList($hgpid, 1);
						$addonservicelist = FunctionsClientController::get_view_ServiceList($hgpid, 2);
						$mainservices_reg	= FunctionsClientController::get_view_reg_facility_services($reg_fac_id, 1);
						$addOnservices_reg	= FunctionsClientController::get_view_reg_facility_services($reg_fac_id, 2);
						$mainservices_applied	= FunctionsClientController::get_view_facility_services_per_appform($appid, 1);
						$addOnservices_applied	= FunctionsClientController::get_view_facility_services_per_appform($appid, 2);
						$chk			=  DB::table('x08_ft')->where([['appid', $appid]])->first();
						$chkFacid 		= new stdClass();
						$proceesedAmb 	= []; 
						$arrRet1 		= []; 
						$faclArr 		= []; 
						$facl_grp 		= FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
						$appGet 		= FunctionsClientController::getUserDetailsByAppform($appid, NULL);	
						$apptype 		= ($appid > 0 && count($appGet) > 0 ) ? $appGet[0]->hfser_id :	$hfser_id;													
						$hfaci_sql 		= "SELECT * FROM hfaci_grp WHERE hgpid IN (SELECT hgpid FROM `facl_grp` WHERE hfser_id = '$apptype')"; 

						if($functype == 'as')
						{						
							$isaddnew 		= 1;	
							$cat_id			= 5;	
						}
						if($functype == 'cs' )
						{						
							$isupdate 		= 1;
							$cat_id			= 4;	
						}
						if($functype == 'hospital')
						{
							$isaddnew 		= 1;
							$isupdate 		= 1;
							$cat_id			= 9;		
						}
						
						foreach ($facl_grp as $f) {	array_push($faclArr, $f->hgpid);	}

						if($chk)
						{
							$chkFacid->facid = $chk->facid;
		
							if(!empty($appid)) 
							{
								$sql2 = array($chk->facid);							
								$sql1 = "SELECT DISTINCT hgpid FROM facilitytyp WHERE facid = '$chk->facid' ORDER BY hgpid DESC";
								$sql3 = "SELECT facid, facname FROM facilitytyp WHERE facid = '$chk->facid'";
								$sql4 = "SELECT hgpid, hgpdesc FROM hfaci_grp WHERE hgpid IN ($sql1)";	
								//$arrRet1 = [DB::select($sql1), [$chkFacid], DB::select($sql3), DB::select($sql4)];
							}
						}
						foreach (AjaxController::getForAmbulanceList(false,'forAmbulance.hgpid') as $key => $value) {
							array_push($proceesedAmb, $value->hgpid);
						}
						
						$data2 = [
							// 'grpid' =>  $grpid,
							'aptid'				=> 'IC',
							'apptypenew'		=> 'IC',						
							'nameofcomp'		=> $nameofcomp,
							'hfser'				=> $hfser_id,
							'user'				=> $user_data,
							'regions'			=> Regions::orderBy('sort')->get(),
							'hfaci_service_type'=> HFACIGroup::whereIn('hgpid', $faclArr)->get(),
							'appFacName'		=> FunctionsClientController::getDistinctByFacilityName(),
							'userInf'			=> FunctionsClientController::getUserDetails(),
							'hfaci_serv_type'	=> DB::select($hfaci_sql),
							'serv_cap'			=> json_encode(DB::table('facilitytyp')->where('servtype_id',1)->get()),
							'apptype'			=> DB::table('apptype')->get(),
							'ownership'			=> DB::table('ownership')->get(),
							'class'				=> json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
							'subclass'			=> json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
							'function'			=> DB::table('funcapf')->get(),
							'facmode'			=> DB::table('facmode')->get(),
							'fAddress'			=> $appGet,
							'servfac'			=> json_encode(FunctionsClientController::getServFaclDetails($appid)),
							'ptcdet'			=> json_encode(FunctionsClientController::getPTCDetails($appid)),
							'cToken'			=> FunctionsClientController::getToken(),
							'addresses'			=> '',
							'hfer'				=> $apptype,
							'hideExtensions'	=> null,
							'ambcharges'		=> DB::table('chg_app')->whereIn('chgapp_id', ['284', '472'])->get(),
							'group'				=> json_encode(DB::table('facilitytyp')->where('servtype_id','>',1)->whereNotNull('grphrz_name')->get()),
							'forAmbulance'		=> json_encode($proceesedAmb),	
							'mainservices_reg'		=> $mainservices_reg,
							'addOnservices_reg'		=> $addOnservices_reg,
							'mainservices_applied'	=> $mainservices_applied,
							'addOnservices_applied'	=> $addOnservices_applied,
							'mainservicelist'		=> $mainservicelist,
							'addonservicelist'		=> $addonservicelist,
							'isaddnew'		=> $isaddnew,
							'isupdate'		=> $isupdate,
							'cat_id'		=> $cat_id
						];
						
						$data = array_merge($data, $data2);
					}
					
					return view($locRet, $data);
				}
				else{
					return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No Registered Facility Record found. Contact the admin']);
				}





			/*
			$user_data = session()->get('uData');
			$locRet 	= "dashboard.client.update-application";  

			if($user_data){
				$nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
			} else{	$nameofcomp = null;	}
			//default client url
			$hfLocs = [
					'client1/apply/app/LTO/'.$appid, 
					'client1/apply/app/LTO/'.$appid.'/hfsrb', 
					'client1/apply/app/LTO/'.$appid.'/fda'
			];
			//employee override url if user id is set
			if(isset($hideExtensions)) {
				$hfLocs = [
					'client1/apply/employeeOverride/app/LTO/'.$appid, 
					'client1/apply/employeeOverride/app/LTO/'.$appid.'/hfsrb', 
					'client1/apply/employeeOverride/app/LTO/'.$appid.'/fda'
				];
			}

			if(! isset($hideExtensions)) {
				$cSes = FunctionsClientController::checkSession(true);
				
				if(count($cSes) > 0) {
					return redirect($cSes[0])->with($cSes[1], $cSes[2]);
				}
			}
			
			$appGet = FunctionsClientController::getUserDetailsByAppform($appid, $hideExtensions);
			//dd($appGet);
			if(count($appGet) < 1) {
				return redirect('client1/apply')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No application selected.']);
			}
			//dd($hfser);
			if($hfser != $appGet[0]->hfser_id) {
				return redirect('client1/apply/app/'.$appGet[0]->hfser_id.'/'.$appid.'');
			}
			$percentage = FunctionsClientController::getAssessmentTotalPercentage($appid, ''.$appGet[0]->uid.'_'.$appGet[0]->hfser_id.'_'.$appGet[0]->aptid.'');
			//dd($percentage);
			if(intval($percentage[0]) < 100) {
				// return redirect('client1/apply/assessmentReady/'.$appid.'/'.$appGet[0]->hfser_id.'')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Proceed to assessment.']);
			}
			$arrRet = []; 
			$locRet = ""; 
			$hfaci_sql = "SELECT * FROM hfaci_grp WHERE hgpid IN (SELECT hgpid FROM `facl_grp` WHERE hfser_id = '$hfser')"; 
			$arrCon = [6];
			$apptype = $appGet[0]->hfser_id;

			// $usid = FunctionsClientController::getSessionParamObj("uData", "uid");
			// $grpid = DB::table('x08')->where([['uid', $usid]])->first()->grpid;
			// $grpid = ' ';
			// unset($appGet[0]->areacode);  //temporary fix
			switch($hfser) {
				case 'CON':
					session()->forget('ambcharge');
	
					$hfser_id = 'CON';
					$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
					$arrRet = [
						// 'grpid' =>  $grpid,
						// 'nameofcomp' =>  $nameofcomp,
						'appid' =>  $appid,
						'appFacName' => FunctionsClientController::getDistinctByFacilityName(),
						'nameofcomp' =>  $nameofcomp,
						'hfser' => $hfser_id,
						'user'=> $user_data,
						'regions' => Regions::orderBy('sort')->get(),
						'userInf'=>FunctionsClientController::getUserDetails(),
						'serv_cap'=>DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->whereIn('hgpid', $arrCon)->get(),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'apptype'=>DB::table('apptype')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'condet'=>FunctionsClientController::getCONDetails($appid),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'arrCon'=>json_encode($arrCon),
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					// unset($arrRet['fAddress'][0]->areacode);
					// dd($arrRet);
					
					$locRet = "dashboard.client.newapplication";
					// $locRet = "client1.apply.CON1.conapp";
					break;
				case 'PTC':
					session()->forget('ambcharge');
					$hfser_id = 'PTC';
					$faclArr = [];
					$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
					
					foreach ($facl_grp as $f) {
						array_push($faclArr, $f->hgpid);
					}

					$ptc =  DB::table('ptc')->where('appid', $appid)->get();

					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'user'=> $user_data,
						'hfser' =>  $hfser_id,
						'appFacName'  => FunctionsClientController::getDistinctByFacilityName(),
						'regions' => Regions::orderBy('sort')->get(),
						'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1]/*,['forSpecialty',0]   /////])->get()),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'ptcdet'=>json_encode(FunctionsClientController::getPTCDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'ptc'=>$ptc,
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					// dd($arrRet);
					$locRet = "dashboard.client.permit-to-construct";
					// $locRet = "client1.apply.PTC1.ptcapp";
					break;
				case 'LTO':
					$proceesedAmb = [];
					foreach (AjaxController::getForAmbulanceList(false,'forAmbulance.hgpid') as $key => $value) {
						array_push($proceesedAmb, $value->hgpid);
					}

					// 5-12-2021
					$hfser_id = 'LTO';
					$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}

					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'hfser' =>  $hfser_id,
						'user'=> $user_data,
						'regions' => Regions::orderBy('sort')->get(),
						'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),

						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where('servtype_id',1)->get()),
						'apptype'=>DB::table('apptype')->get(),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'ptcdet'=>json_encode(FunctionsClientController::getPTCDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'addresses'=>$hfLocs,
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'ambcharges'=>DB::table('chg_app')->whereIn('chgapp_id', ['284', '472'])->get(),
						'aptid'=>$aptid,
						'group' => json_encode(DB::table('facilitytyp')->where('servtype_id','>',1)->whereNotNull('grphrz_name')->get()),
						'forAmbulance' => json_encode($proceesedAmb),
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					];
					
					 $locRet = "dashboard.client.update-application-lto";
					//  $locRet = "client1.apply.LTO1.ltoapp";
					break;
				case 'COR':
						session()->forget('ambcharge');
						$hfser_id = 'COR';
						$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
						$arrRet = [
							// 'grpid' =>  $grpid,
							'appid' =>  $appid,
							'nameofcomp' =>  $nameofcomp,
							'hfser' =>  "COR",
							'user'=> $user_data,
							'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
							'userInf'=>FunctionsClientController::getUserDetails(),
							'regions' => Regions::orderBy('sort')->get(),
							'hfaci_serv_type'=>DB::select($hfaci_sql),
							'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
							'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
							'ownership'=>DB::table('ownership')->get(),
							'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
							'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
							'function'=>DB::table('funcapf')->get(),
							'facmode'=>DB::table('facmode')->get(),
							'apptype'=>DB::table('apptype')->get(),
							'fAddress'=>$appGet,
							'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
							'cToken'=>FunctionsClientController::getToken(),
							'hfer' => $apptype,
							'hideExtensions'=>$hideExtensions,
							'aptid'=>$aptid,
							'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
						]; 
						$locRet = "dashboard.client.certificate-of-registration";
						// $locRet = "client1.apply.default1.defaultapp";
						break;

				case 'COA':
					session()->forget('ambcharge');
					$hfser_id = 'COA';
						$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
						'hfser' =>  "COA",
						'user'=> $user_data,
						'regions' => Regions::orderBy('sort')->get(),
						'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'userInf'=>FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'apptype'=>DB::table('apptype')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					
					$locRet = "dashboard.client.certificate-of-accreditation";
					// $locRet = "client1.apply.COA1.coaapp";
					break;
				case 'ATO':
					session()->forget('ambcharge');
						$hfser_id = 'ATO';
						$faclArr = [];
							$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
							foreach ($facl_grp as $f) {
								array_push($faclArr, $f->hgpid);
							}
						$arrRet = [
							// 'grpid' =>  $grpid,
							'appid' =>  $appid,
							'nameofcomp' =>  $nameofcomp,
							'hfser' =>  "ATO",
							'user'=> $user_data,
							'regions' => Regions::orderBy('sort')->get(),
							'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
							'userInf'=>FunctionsClientController::getUserDetails(),
							'hfaci_serv_type'=>DB::select($hfaci_sql),
							'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(),
							'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
							'ownership'=>DB::table('ownership')->get(),
							'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
							'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
							'function'=>DB::table('funcapf')->get(),
							'facmode'=>DB::table('facmode')->get(),
							'apptype'=>DB::table('apptype')->get(),
							'fAddress'=>$appGet,
							'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
							'cToken'=>FunctionsClientController::getToken(),
							'hfer' => $apptype,
							'hideExtensions'=>$hideExtensions,
							'aptid'=>$aptid,
							'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
						]; 
						$locRet = "dashboard.client.authority-to-operate";
					break;
				
				default:
					session()->forget('ambcharge');
					$arrRet = [
						// 'grpid' =>  $grpid,
						'appid' =>  $appid,
						'nameofcomp' =>  $nameofcomp,
						'userInf'=>FunctionsClientController::getUserDetails(),
						'regions' => Regions::orderBy('sort')->get(),
						'hfaci_serv_type'=>DB::select($hfaci_sql),
						'serv_cap'=>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
						'ownership'=>DB::table('ownership')->get(),
						'class'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'=>json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'=>DB::table('funcapf')->get(),
						'facmode'=>DB::table('facmode')->get(),
						'apptype'=>DB::table('apptype')->get(),
						'fAddress'=>$appGet,
						'servfac'=>json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'cToken'=>FunctionsClientController::getToken(),
						'hfer' => $apptype,
						'hideExtensions'=>$hideExtensions,
						'aptid'=>$aptid,
						'apptypenew'=> $request->apptype ? $request->apptype : 'IN'
					]; 
					$locRet = "client1.apply.default1.defaultapp";
					break;
					// unset($arrRet['fAddress'][0]->areacode);
			}
			return view($locRet, $arrRet);
			*/
		/*} catch(Exception $e) {
			return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Add new Application. Contact the admin']);
		}*/
	}

	public function __editAppCoR(Request $request, $hfser, $appid) {

		$appid1 = FunctionsClientController::getApplicationDetailsFEmployee($appid);
		if(count($appid1) > 0) {
			return self::__applyAppCoR($request, $hfser, $appid, $appid1[0]->uid);
		} 
		return back()->with('errRet', ['system_error'=>'No employee on sight.']);
	}
	public function __editAppCoRSubmit(Request $request) 
	{
		$remarks = "";
		$regfac_id = $request->regfac_id;
		$cat_id = $request->cat_id;		
		$uid = FunctionsClientController::getSessionParamObj("uData", "uid");
		$appform 	= $this->checkAppForm($regfac_id);	//CHECK APP id			
		$appid = -1;
		$savingStat = NULL;
		$hgpid = 0;
		$addOnDesc = NULL;

		if (!is_null($appform)) { 
			$appid 		= $appform->appid;
			$savingStat = $appform->savingStat;
			$hgpid = $appform->hgpid;
		}

		if($appid < 1) {	$appid = $this->insertAppForm($regfac_id);	}

		//update List of Change Remarks
		if($cat_id == 0)
		{
			$id = $request->id;
			$remarks = $request->remarks;
			
			DB::table('appform_changeaction')->where(array('id' => $id))->update(['remarks' => $remarks]);
		}		
		//Increase/Decrease In Bed Capacity
		else if($cat_id == 1)
		{
			$amt = "0.00";
			$facid = "";

			if($hgpid == 6)
			{
				if($request->noofbed_applied <= 100)
				{
					$facid='H';
					$remarks = "Level 1";
					$chgapp_id = "229";
					$amt = "6500";
				}
				if($request->noofbed_applied <= 200)
				{
					$facid='H2';
					$remarks = "Level 2";
					$chgapp_id = "232";
					$amt = "8500";
				} 
				else{
					$facid='H3';
					$remarks = "Level 3";
					$chgapp_id = "235";
					$amt = "10500";
				}
			}
			else{

			}
			
			DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();

			$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $remarks, 'amount'=>$amt));
			$appcharge = json_encode($arr);
			NewGeneralController::appCharge($appcharge, $appid, $uid);

			if(isset($facid) && !empty($facid) )
			{
				DB::table('x08_ft')->where(array('facid' => $facid, 'appid' => $appid))->delete();
				DB::table('x08_ft')->insert(['uid' => $uid, 'appid' => $appid, 'reg_facid' => $regfac_id, 'facid' => $facid]);
			}

			$remarks = "Adjusted No. Of Bed Applied is ".$request->noofbed_applied;

			DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
			DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
			DB::table('appform')->where('appid',$appid)->update(['noofbed' => $request->noofbed_applied, 'noofbed_old'=>$request->noofbed_old]);
			
			return redirect('client1/changerequest/'.$request->regfac_id.'/cs')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Service successfully saved.']);
		}
		//Increase/Decrease In Dialysis Clinic
		else if($cat_id == 2)
		{
			$facid = "";
			$amt = "0.00";

			if($hgpid == 6)
			{
				$remarks = "Dialysis Clinic";
				$chgapp_id = "261";
				$amt = "3000.00";    

				$facid='H1-AO-DC';
			}
			else{
				$remarks = "Dialysis Clinic";
				$chgapp_id = "11";
				$amt = "9500.00";
				$facid='HDS';
			}
			
			DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();

			$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $remarks, 'amount'=>$amt));
			$appcharge = json_encode($arr);
			NewGeneralController::appCharge($appcharge, $appid, $uid);

			if(isset($facid) && !empty($facid) )
			{
				DB::table('x08_ft')->where(array('facid' => $facid, 'appid' => $appid))->delete();
				DB::table('x08_ft')->insert(['uid' => $uid, 'appid' => $appid, 'reg_facid' => $regfac_id, 'facid' => $facid]);
			}

			$remarks = "No. Of Dialysis Clinic Applied is ".$request->noofdialysis;
			DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
			DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
			DB::table('appform')->where('appid',$appid)->update(['noofdialysis' => $request->noofdialysis, 'noofdialysis_old'=>$request->noofdialysis_old]);
		}
		//Increase/Decrease In Ambulance Vehicle
		else if($cat_id == 3)
		{
			$id = $request->id;
			$noOfRegAmbulance = $request->noOfRegAmbulance;
			$amb_arr = [
				'appid'	=> $appid,
				'typeamb' => $request->typeamb,
				'ambtyp' => $request->ambtyp,
				'plate_number' => $request->plate_number,
				'ambOwner' => $request->ambOwner
			];
			//Savings on ambulance
			DB::table('appform_ambulance')->where(array('id'=>$id))->delete();
			DB::table('appform_ambulance')->insert($amb_arr);
			$amt = 0.00;
			$NoOfAmb =	DB::table('appform_ambulance')->where(array('appid'=>$appid, 'ambtyp'=>'2'))->count();

			if($NoOfAmb > 0)
			{				
				if($hgpid == 34)
				{
					$amt = (($NoOfAmb + $noOfRegAmbulance) * 3000);
				}
				else if($hgpid == 6)
				{
					$amt = (($NoOfAmb ) * 1000);
				}
				else{

					$NoOfAmb = $NoOfAmb + $noOfRegAmbulance;
					$amt = 0.00;

					if($noOfRegAmbulance == 0)
					{
						if($NoOfAmb == 1)
						{
							$amt = 5000.00;
						}
						else if($NoOfAmb > 1){
							$amt = 5000.00 + (($NoOfAmb -1) * 1000);
						}
					}
					else{
						$amt = (($NoOfAmb ) * 1000);
					}
				}
			}
			
			DB::table('chgfil')->where(array('appform_id'=>$appid, 'reference'=> 'Ambulance charge'))->delete();
			$arr = array(array('reference'=> 'Ambulance charge', 'amount'=>$amt));
			$appcharge = json_encode($arr);
			NewGeneralController::appChargeAmb($appcharge, $appid, $uid);

			$remarks = "Increase/Decrease In Ambulance Vehicle.";
			DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
			DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
			return redirect('client1/changerequest/'.$request->regfac_id.'/av')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Ambulance successfully saved.']);
		}
		//Change In Service
		else if($cat_id == 4)
		{
			$action = $request->action;

			if($action == "del"){

				$fromRegistered = $request->fromRegistered;
				$facid = $request->facid;
				$chgapp_id = "";
				$fees = FunctionsClientController::get_view_ServiceCharge([$request->facid], "","", "","", TRUE);

				foreach ($fees as $d){
					$chgapp_id = $d->chgapp_id;
					
					DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();
				}
				DB::table('x08_ft')->where(array('appid'=>$appid, 'facid'=> $facid))->delete();

				if($fromRegistered){

				}
			}
			else{
				$chgapp_id = "";
				$fees = FunctionsClientController::get_view_ServiceCharge([$request->facid], "","", "","", TRUE);
				
				foreach ($fees as $d){
					$chgapp_id = $d->chgapp_id;
					$facname	= $d->facname;
					$amt	= $d->amt;
					
					DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();
					$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $facname, 'amount'=>$amt));
					$appcharge = json_encode($arr);
					NewGeneralController::appCharge($appcharge, $appid, $uid);
				}
	
				//added to service for assessment tool
				DB::table('x08_ft')->where(array('facid' => $request->facid, 'appid' => $appid))->delete();
				DB::table('x08_ft')->insert(['uid' => $uid, 'appid' => $appid, 'reg_facid' => $regfac_id, 'facid' => $request->facid, 'servowner' => $request->servowner, 'servtyp' => $request->servtyp, 'facid_old' => $request->facid_old]);
	
				$remarks = "New Service(s) has been updated.";
				DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
				DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
				//DB::table('appform')->where('appid',$appid)->update(['noofbed' => $request->noofbed_applied, 'noofbed_old'=>$request->noofbed]);
			}

			return redirect('client1/changerequest/'.$request->regfac_id.'/cs')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Service successfully saved.']);
		}
		//Additional In Service
		else if($cat_id == 5)
		{
			$action = $request->action;

			if($action == "del"){

				$fromRegistered = $request->fromRegistered;
				$facid = $request->facid;
				$chgapp_id = "";
				$fees = FunctionsClientController::get_view_ServiceCharge([$request->facid], "","", "","", TRUE);

				foreach ($fees as $d){
					$chgapp_id = $d->chgapp_id;
					
					DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();
				}
				DB::table('x08_ft')->where(array('appid'=>$appid, 'facid'=> $facid))->delete();

				if($fromRegistered){

				}
			}
			else{
				$chgapp_id = "";
				$fees = FunctionsClientController::get_view_ServiceCharge([$request->facid], "","", "","", TRUE);
	
				foreach ($fees as $d){
					$chgapp_id = $d->chgapp_id;
					$facname	= $d->facname;
					$amt	= $d->amt;
					
					DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();
					$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $facname, 'amount'=>$amt));
					$appcharge = json_encode($arr);
					NewGeneralController::appCharge($appcharge, $appid, $uid);
				}
				//added to service for assessment tool
				DB::table('x08_ft')->where(array('facid' => $request->facid, 'appid' => $appid))->delete();
				DB::table('x08_ft')->insert(['uid' => $uid, 'appid' => $appid, 'reg_facid' => $regfac_id, 'facid' => $request->facid, 'servowner' => $request->servowner, 'servtyp' => $request->servtyp, 'facid_old' => $request->facid_old]);
	
				$remarks = "New Service(s) has been added.";
				DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
				DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
				//DB::table('appform')->where('appid',$appid)->update(['noofbed' => $request->noofbed_applied, 'noofbed_old'=>$request->noofbed]);
			}
			
			return redirect('client1/changerequest/'.$request->regfac_id.'/as')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Service successfully saved.']);
		}
		//Update in Personnel
		else if($cat_id == 6)
		{
			$remarks = "Update in Personnel applied.";
			$chgapp_id = '3787';
			DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();

			$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $remarks, 'amount'=>'0.00'));
			$appcharge = json_encode($arr);
			NewGeneralController::appCharge($appcharge, $appid, $uid);

			DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
			DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
			DB::table('appform')->where('appid',$appid)->update(['noofbed' => $request->noofbed_applied, 'noofbed_old'=>$request->noofbed]);

			return redirect('client1/changerequest/'.$request->regfac_id.'/annexa')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Equipment successfully saved.']);
		}
		//Update in Equipment
		else if($cat_id == 7)
		{
			$remarks = "Update in Equipment applied.";
			$chgapp_id = '3788';
			DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();

			$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $remarks, 'amount'=>'0.00'));
			$appcharge = json_encode($arr);
			NewGeneralController::appCharge($appcharge, $appid, $uid);
			
			DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
			DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
			DB::table('appform')->where('appid',$appid)->update(['noofbed' => $request->noofbed_applied, 'noofbed_old'=>$request->noofbed]);
			
			return redirect('client1/changerequest/'.$request->regfac_id.'/annexb')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Equipment successfully saved.']);
		}
		//Update in Classification/Function/Institutional Character
		else if($cat_id == 8)
		{
			$remarks = "Update in Classification/Function/Institutional Character applied.";
			$chgapp_id = '3789';

			DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();

			$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $remarks, 'amount'=>'200.00'));
			$appcharge = json_encode($arr);
			NewGeneralController::appCharge($appcharge, $appid, $uid);
			
			DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
			DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
			DB::table('appform')->where('appid',$appid)->update(['noofbed' => $request->noofbed_applied, 'noofbed_old'=>$request->noofbed]);
		}
		//Downgrade in Hospital Level
		else if($cat_id == 9)
		{
			$action = $request->action;

			if($action == "del"){

				$fromRegistered = $request->fromRegistered;
				$facid = $request->facid;
				$chgapp_id = "";
				$fees = FunctionsClientController::get_view_ServiceCharge([$request->facid], "","", "","", TRUE);

				foreach ($fees as $d){
					$chgapp_id = $d->chgapp_id;
					
					DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();
				}
				DB::table('x08_ft')->where(array('appid'=>$appid, 'facid'=> $facid))->delete();

				if($fromRegistered){

				}
			}
			else if($action == "main"){
				$servtype_id = 3;
				$rfacid = $request->facid;
				if($rfacid == "H2") { $servtype_id = 4; } elseif($rfacid == "H3") { $servtype_id = 5; } 

				DB::table('chgfil')->where(array('appform_id'=>$appid))->delete();
				DB::table('x08_ft')->where(array('appid' => $appid))->delete();

				$chgapp_id = "";					
				$fees = FunctionsClientController::get_view_ServiceCharge([$rfacid], "","", "","", TRUE);

				foreach ($fees as $d)
				{
					$chgapp_id = $d->chgapp_id;
					$facname	= $d->facname;
					$amt	= $d->amt;
					
						DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();
						$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $facname, 'amount'=>$amt));
						$appcharge = json_encode($arr);
						NewGeneralController::appCharge($appcharge, $appid, $uid);
				}
				//added to service for assessment tool
				DB::table('x08_ft')->where(array('facid' => $rfacid, 'appid' => $appid))->delete();
				DB::table('x08_ft')->insert(['uid' => $uid, 'appid' => $appid, 'reg_facid' => $regfac_id, 'facid' => $rfacid, 'servowner' => null, 'servtyp' => null, 'facid_old' => null]);

				/////////////ADD ON SERVICES
				$addonservicelist = FunctionsClientController::get_view_ServiceList($hgpid, $servtype_id, true);

				foreach ($addonservicelist AS $d)
				{
					$chgapp_id = "";
					$facid = $d->facid;						
					$fees = FunctionsClientController::get_view_ServiceCharge([$facid], "","", "","", TRUE);
	
						foreach ($fees as $d)
						{
							$chgapp_id = $d->chgapp_id;
							$facname	= $d->facname;
							$amt	= $d->amt;
							
							if(($rfacid == "H" && $facid != "H2" && $facid != "H3" ) || ($rfacid == "H2" && $facid != "H" && $facid != "H3" ) 
									|| ($rfacid == "H3" && $facid != "H2" && $facid != "H" ))
							{
								DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();
								$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $facname, 'amount'=>$amt));
								$appcharge = json_encode($arr);
								NewGeneralController::appCharge($appcharge, $appid, $uid);
							}
						}
					//added to service for assessment tool
					DB::table('x08_ft')->where(array('facid' => $facid, 'appid' => $appid))->delete();
					DB::table('x08_ft')->insert(['uid' => $uid, 'appid' => $appid, 'reg_facid' => $regfac_id, 'facid' => $facid, 'servowner' => null, 'servtyp' => null, 'facid_old' => null]);
				}
			}else{

				$chgapp_id = "";
				$fees = FunctionsClientController::get_view_ServiceCharge([$request->facid], "","", "","", TRUE);
	
				foreach ($fees as $d){
					$chgapp_id = $d->chgapp_id;
					$facname	= $d->facname;
					$amt	= $d->amt;
					
					DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();
					$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $facname, 'amount'=>$amt));
					$appcharge = json_encode($arr);
					NewGeneralController::appCharge($appcharge, $appid, $uid);
				}
				//added to service for assessment tool
				DB::table('x08_ft')->where(array('facid' => $request->facid, 'appid' => $appid))->delete();
				DB::table('x08_ft')->insert(['uid' => $uid, 'appid' => $appid, 'reg_facid' => $regfac_id, 'facid' => $request->facid, 'servowner' => $request->servowner, 'servtyp' => $request->servtyp, 'facid_old' => $request->facid_old]);
	
				$remarks = "Update in Hospital Level";
				DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
				DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
				//DB::table('appform')->where('appid',$appid)->update(['noofbed' => $request->noofbed_applied, 'noofbed_old'=>$request->noofbed]);
			}
			
			return redirect('client1/changerequest/'.$request->regfac_id.'/hospital')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Hospital Service successfully saved.']);
		}
		//Rename Facility
		else if($cat_id == 10)
		{
			$remarks = "Rename Facility to ".$request->facilityname;
			$chgapp_id = '3790';

			DB::table('chgfil')->where(array('appform_id'=>$appid, 'chgapp_id'=> $chgapp_id))->delete();

			$arr = array(array('chgapp_id'=> $chgapp_id,   'reference'=> $remarks, 'amount'=>'200.00'));
			$appcharge = json_encode($arr);
			NewGeneralController::appCharge($appcharge, $appid, $uid);
			
			DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
			DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
			DB::table('appform')->where('appid',$appid)->update(['facilityname' => $request->facilityname, 'facilityname_old'=>$request->facilityname_old]);
		}
		//Other Updates
		else if($cat_id == 11)
		{
			$remarks = "Other Updates";
			DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
			DB::table('appform')->where('appid',$appid)->update(['noofbed' => $request->noofbed_applied, 'noofbed_old'=>$request->noofbed]);
		}
		//Final Submission
		else if($cat_id == 100000)
		{
			$remarks = "N";
			DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
			DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
			DB::table('appform')->where('appid',$appid)->update(['savingStat' => 'final', 't_date'=>Carbon::now()->toDateString(), 'isPayEval' => '1', 'status'=>'CRFE']);			

			//return redirect('client1/apply/attachment/'.$hfser_id.'/'.$appid.'')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Successfully Finalized the Initial Change application. Proceeding to Requirements']);
			$x08_ft_cnt = DB::table('x08_ft')->where('appid', '=', $appid)->count();

			if($x08_ft_cnt > 0){
				return redirect('client1/apply/assessmentReady/'.$appid.'')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Successfully finalized the initial change applicaiton. Proceeding to Assessment tool']);
			}
			else{
				return redirect('client1/apply')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Successfully finalized the initial change applicaiton.']);
			}
			
		}

		return redirect('client1/changerequest/'.$request->regfac_id.'/main')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Successfully Created/Updated Initial Change application.']);
	}
	
	// to be updated
	public function checkAppForm($regfac_id){

		$id = DB::table('appform')->select('*')
				->where('regfac_id','=',$regfac_id)
				->where('aptid','=','IC')
				->where('isApprove',NULL)
				->orderby('appid', 'DESC')
				->first();
				
		if (!is_null($id)) { return $id;	}

		// insert new appform
		DB::Statement("INSERT INTO appform (aptid, regfac_id, uid, facilityname, hgpid, assignedRgn, rgnid, provid, cmid, brgyid, street_number, street_name, zipcode,
			contact, areacode, landline, faxnumber, email, ocid, classid, subClassid, facmode, funcid, owner, ownerMobile, ownerLandline, ownerEmail, mailingAddress, approvingauthoritypos, approvingauthority, hfep_funded,
			noofbed, noofstation, noofsatellite, noofdialysis, noofmain, cap_inv, lot_area, typeamb, ambtyp, plate_number, ambOwner, HFERC_swork, noofamb, pharCOC, xrayCOC, isApprove)

			SELECT 'IC' AS aptid, regfac_id, uid, facilityname, facid  AS hgpid, assignedRgn, rgnid, provid, cmid, brgyid, street_number, street_name, zipcode,
			contact, areacode, landline, faxnumber, email, ocid, classid, subClassid, facmode, funcid, owner, ownerMobile, ownerLandline, ownerEmail, mailingAddress, approvingauthoritypos, approvingauthority, hfep_funded,
			noofbed, noofstation, noofsatellite, noofdialysis, noofmain, cap_inv, lot_area, typeamb, ambtyp, plate_number, ambOwner, HFERC_swork, noofamb, pharCOC, xrayCOC, NULL AS isApprove
			FROM registered_facility WHERE regfac_id='$regfac_id'");

			$id = DB::table('appform')->select('*')
							->where('regfac_id','=',$regfac_id)
							->where('aptid','=','IC')
							->where('isApprove',NULL)
							->orderby('appid', 'DESC')
							->first();
		
		if (!is_null($id)) { return $id;	}

		return null;
	}

	public function insertAppForm($regfac_id){

		try {

			$facility = DB::select("SELECT 'IC', regfac_id, hgpid, nhfcode, facilityname, assignedRgn, rgnid, provid, cmid, brgyid, street_number, street_name, zipcode, contact, areacode, landline, faxnumber, email, rf.ocid, rf.classid, subClassid, facmode, funcid, owner, ownerMobile, ownerLandline, ownerEmail, mailingAddress, approvingauthoritypos, approvingauthority, hfep_funded, hfser_id, uid, noofbed, noofstation, noofsatellite, noofdialysis, noofmain, cap_inv, lot_area, typeamb, ambtyp, plate_number, ambOwner, HFERC_swork, noofamb, pharCOC, xrayCOC, noofbed AS noofbed_old, noofdialysis AS noofdialysis_old,  facilityname AS facilityname_old, rf.ocid AS ocid_old, ocdesc AS ocdesc_old , classid AS classid_old, classname AS classdesc_old, subClassid AS subClassid_old, funcid AS funcid_old, facmode AS facmode_old
			FROM view_registered_facility_for_change rf 
			WHERE regfac_id=$regfac_id");

			$insert = DB::insert('INSERT INTO appform (
				aptid, 
				regfac_id, 
				hgpid, 
				nhfcode, 
				facilityname, 
				assignedRgn, 
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
				hfep_funded,  
				hfser_id, 
				uid, 
				noofbed, 
				noofstation, 
				noofsatellite,
				noofdialysis, 
				noofmain, 
				cap_inv, 
				lot_area, 
				typeamb, 
				ambtyp, 
				plate_number, 
				ambOwner, 
				HFERC_swork, 
				noofamb, 
				pharCOC, 
				xrayCOC, 
				noofbed_old, 
				noofdialysis_old, 
				facilityname_old,
				ocid_old, 
				ocdesc_old, 
				classid_old,  
				classdesc_old, 
				subClassid_old, 
				funcid_old, 
				facmode_old) VALUES 
				(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
				['IC', 
				$facility[0]->regfac_id, 
				$facility[0]->hgpid, 
				$facility[0]->nhfcode, 
				$facility[0]->facilityname, 
				$facility[0]->assignedRgn, 
				$facility[0]->rgnid, 
				$facility[0]->provid, 
				$facility[0]->cmid, 
				$facility[0]->brgyid, 
				$facility[0]->street_number, 
				$facility[0]->street_name, 
				$facility[0]->zipcode, 
				$facility[0]->contact, 
				$facility[0]->areacode, 
				$facility[0]->landline, 
				$facility[0]->faxnumber, 
				$facility[0]->email, 
				$facility[0]->ocid, 
				$facility[0]->classid, 
				$facility[0]->subClassid, 
				$facility[0]->facmode, 
				$facility[0]->funcid, 
				$facility[0]->owner, 
				$facility[0]->ownerMobile, 
				$facility[0]->ownerLandline, 
				$facility[0]->ownerEmail, 
				$facility[0]->mailingAddress, 
				$facility[0]->approvingauthoritypos, 
				$facility[0]->approvingauthority, 
				$facility[0]->hfep_funded, 
				$facility[0]->hfser_id, 
				$facility[0]->uid, 
				$facility[0]->noofbed, 
				$facility[0]->noofstation, 
				$facility[0]->noofsatellite, 
				$facility[0]->noofdialysis, 
				$facility[0]->noofmain, 
				$facility[0]->cap_inv, 
				$facility[0]->lot_area, 
				$facility[0]->typeamb, 
				$facility[0]->ambtyp, 
				$facility[0]->plate_number, 
				$facility[0]->ambOwner, 
				$facility[0]->HFERC_swork, 
				$facility[0]->noofamb, 
				$facility[0]->pharCOC, 
				$facility[0]->xrayCOC, 
				$facility[0]->noofbed_old, 
				$facility[0]->noofdialysis_old, 
				$facility[0]->facilityname_old, 
				$facility[0]->ocid_old, 
				$facility[0]->ocdesc_old , 
				$facility[0]->classid_old, 
				$facility[0]->classdesc_old, 
				$facility[0]->subClassid_old, 
				$facility[0]->funcid_old, 
				$facility[0]->facmode_old]);
	
			if($insert){
				$id = DB::table('appform')->where('regfac_id', $regfac_id)->latest('created_at')->first();
	
				return $id->appid;
			} 
	
			return false;
		}
		catch (Exception $e) 
		{
			dd($e->getMessage());
		}
	
	}

	//Initial Change Function and Forms
	public function __editAppCoRNew(Request $request, $reg_fac_id, string $functype = '') {

		//$data = DB::table('view_registered_facility_for_change')->where('regfac_id', $reg_fac_id)->get();
		$data 					= DB::select("SELECT view_registered_facility_for_change.*, 0 AS appid, facilityname AS facilityname_old, noofbed AS noofbed_old, noofdialysis AS noofdialysis_old  FROM `view_registered_facility_for_change` WHERE `regfac_id` = $reg_fac_id;");
		$appform_changeaction 	= null;
		$nameofcomp 			= null;
		$validity 				= "";
		$user_data 				= session()->get('uData');
		$hgpid					= null;

		//try {
			if(count($data) > 0) 
			{
				$locRet 	= "dashboard.client.forms.request-for-change";
				$hfser_id 	=  $data[0]->hfser_id;
				$nameofcomp = ""; //DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;	
				$regservices	= FunctionsClientController::get_view_reg_facility_services($reg_fac_id, 0);
				$appform 	= $this->checkAppForm($reg_fac_id);	//CHECK APP id			
				$appid = -1;
				$savingStat = NULL;
				$uid = "";

				if (!is_null($appform)) { 
					$appid 		= $appform->appid;
					$savingStat = $appform->savingStat;
					$hgpid		= $appform->hgpid;
					$nameofcomp = $appform->owner;
					$uid 		= $appform->uid;
				}

				else{
					if (!is_null($data) && is_array($data)) { 
						$hgpid		= $data[0]->hgpid;
						$nameofcomp = $data[0]->owner;
						$uid 		= $data[0]->uid;
					}
				}

				//try {
					$validto 	= ($hfser_id == 'PTC') ? "" : strtolower($hfser_id).'_validityto';
					$validfrom 	= ($hfser_id == 'PTC') ? "" : strtolower($hfser_id).'_validityfrom';
					$validity 	= "";
					$issued_date = "";

					if($hfser_id == 'PTC') {
						$validity = 'Starting '.date_format(date_create($data[0]->ptc_approveddate),"F d, Y"); 
						$issued_date = date_format(date_create($data[0]->ptc_approveddate),"F d, Y");
					}
					elseif($hfser_id == 'LTO') {
						$validity = 'Until '.date_format(date_create($data[0]->lto_validityto),"F d, Y");
						$issued_date = date_format(date_create($data[0]->lto_approveddate),"F d, Y");
					}
					elseif($hfser_id == 'COA') {
						$validity = 'Until '.date_format(date_create($data[0]->coa_validityto),"F d, Y"); 
						$issued_date = date_format(date_create($data[0]->coa_approveddate),"F d, Y");
					}
					elseif($hfser_id == 'ATO') {
						$validity = 'Until '.date_format(date_create($data[0]->ato_validityto),"F d, Y"); 
						$issued_date = date_format(date_create($data[0]->ato_approveddate),"F d, Y");
					}
					
				//} catch (Exception $e) { }
				
				if($appid > 0) 
				{
					/*$data = DB::table('appform')->select('view_registered_facility_for_change.*','appform.appid')->where('appform.regfac_id', $reg_fac_id)
								->join('view_registered_facility_for_change', 'view_registered_facility_for_change.regfac_id', '=', 'appform.regfac_id')
								->orderBy('appid','DESC')->get();*/					
					$appform_changeaction = ($functype == '' || $functype == 'main') ? DB::select("SELECT aca.id, aca.appid, aca.cat_id, ctyp.description, aca.remarks FROM `appform_changeaction` aca LEFT JOIN change_action_type ctyp ON aca.cat_id=ctyp.cat_id WHERE appid='$appid';") : null;
				}		

				$data = [
					'appid'					=> $appid, //old app id
					'regfac_id'				=> $reg_fac_id,
					'functype'				=> $functype,
					'registered_facility'	=> (count($data) > 0) ? $data[0] : null,
					'validity'				=> $validity,
					'issued_date'			=> $issued_date,
					'uid'					=> $uid,
					'appform_changeaction'	=> $appform_changeaction,					
					'regservices'			=> $regservices,
					'chgfil_reg'			=> FunctionsClientController::getChargesByAppID($appid, "Facility Registration Fee", TRUE),
					'chgfil_sf'				=> FunctionsClientController::getChargesByAppID($appid, "Service Fee", TRUE),
					'chgfil_af'				=> FunctionsClientController::getChargesByAppID($appid, "Ambulance Fee", TRUE),
					'savingStat'			=> $savingStat				
					//DB::table('chgfil')->where([['appform_id', $appid]])->get()
				];
				if($functype == 'annexa')
				{
					//$locRet = "client1.apply.LTO1.hfsrb.annexa-part-personnel";
					$data2 = $this->reg_annexa_COR($request, $reg_fac_id, $appid);
					
					if($request->isMethod('post')) { 

						if($data2 == "DONE")
						{
							$cat_id = "6";
							$remarks = "Update In Personnel.";
							DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
							DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
						}

						return $data2;
					}

					if(is_array($data2))
					{
						$data = array_merge($data, $data2);
					}
				}
				else if($functype == 'annexb')
				{
					//$locRet = "client1.apply.LTO1.hfsrb.annexa-part-personnel";
					$data2 = $this->reg_annexb_COR($request, $appid);
					
					if($request->isMethod('get')){
						if(is_array($data2))
						{
							$data = array_merge($data, $data2);
						}
					} else if($request->isMethod('post')) { 

						if($data2 == "DONE")
						{
							$cat_id = "7";
							$remarks = "Update In Equipment.";
							DB::table('appform_changeaction')->where(array('cat_id' => $cat_id, 'appid' => $appid))->delete();
							DB::table('appform_changeaction')->insert(['cat_id' => $cat_id, 'appid' => $appid, 'remarks' => $remarks]);
						}
						return $data2;
					}
				}
				else if($functype == 'av')
				{					
					$data_reg 	= DB::table('view_registered_facility_for_change')->WHERE('regfac_id','=',$reg_fac_id )->first();
					$isaddnew 		= 1;
					$isupdate 		= 1;
					$reg_ambulance_temp = null;
					$appform_ambulance_temp = null;
					
					if (!is_null($appform)) { 
						$appform_ambulance_temp = [
							'typeamb' 		=> json_decode($appform->typeamb), 
							'ambtyp'		=> json_decode($appform->ambtyp), 
							'plate_number'	=> json_decode($appform->plate_number), 
							'ambOwner'		=> json_decode($appform->ambOwner)
						];
					}
					if (!is_null($data_reg) ){ 
						$reg_ambulance_temp = [
							'typeamb' 		=> json_decode($data_reg->typeamb), 
							'ambtyp'		=> json_decode($data_reg->ambtyp), 
							'plate_number'	=> json_decode($data_reg->plate_number), 
							'ambOwner'		=> json_decode($data_reg->ambOwner)
						];
					}

					//$appform_ambulance_temp= DB::table('appform')->WHERE('appid','=',$appid )->get();
					$appform_ambulance = null;
					$reg_ambulance = null;
					
					/*if(isset($appform_ambulance_temp))
					{
						foreach( $appform_ambulance_temp as $key=>$val)
						{
							if($key == "typeamb")
							{
								$d = $val;
		
								for($j=count($d)-1; 0 <= $j; $j--)
									$appform_ambulance[$j]['typeamb'] = $d[$j];
							}
							if($key == "ambtyp")
							{
								$d = $val;
		
								for($j=count($d)-1; 0 <= $j; $j--)
									$appform_ambulance[$j]['ambtyp'] = $d[$j];
							}
							if($key == "plate_number")
							{
								$d = $val;
		
								for($j=count($d)-1; 0 <= $j; $j--)
									$appform_ambulance[$j]['plate_number'] = $d[$j];
							}
							if($key == "ambOwner")
							{
								$d = $val;
		
								for($j=count($d)-1; 0 <= $j; $j--)
									$appform_ambulance[$j]['ambOwner'] = $d[$j];
							}
						}
					} */

					$appform_ambulance= DB::table('appform_ambulance')->select('typeamb', 'ambtyp', 'plate_number', 'ambOwner')->where('appid','=',$appid)->get();
					
					if(isset($reg_ambulance_temp))
					{
						foreach( $reg_ambulance_temp as $key=>$val)
						{
							if($key == "typeamb")
							{
								$d = $val;
		
								for($j=count($d)-1; 0 <= $j; $j--)
									$reg_ambulance[$j]['typeamb'] = $d[$j];
							}
							if($key == "ambtyp")
							{
								$d = $val;
		
								for($j=count($d)-1; 0 <= $j; $j--)
									$reg_ambulance[$j]['ambtyp'] = $d[$j];
							}
							if($key == "plate_number")
							{
								$d = $val;
		
								for($j=count($d)-1; 0 <= $j; $j--)
									$reg_ambulance[$j]['plate_number'] = $d[$j];
							}
							if($key == "ambOwner")
							{
								$d = $val;
		
								for($j=count($d)-1; 0 <= $j; $j--)
									$reg_ambulance[$j]['ambOwner'] = $d[$j];
							}
						}
					}

					$cat_id = 3;
					$data2 = [
						// 'grpid' =>  $grpid,
						'aptid'				=> 'IC',
						'apptypenew'		=> 'IC',
						'appform_ambulance'	=> $appform_ambulance,
						'reg_ambulance'		=> $reg_ambulance,
						'isaddnew'			=> $isaddnew,
						'isupdate'			=> $isupdate,
						'cat_id'			=> $cat_id
					];
					
					$data = array_merge($data, $data2);
				}
				else if($functype == 'cs' || $functype == 'as' || $functype == 'hospital')
				{	
					$cat_id			= 0;				
					$isaddnew 		= 0;
					$isupdate 		= 0;
					$mainservicelist = FunctionsClientController::get_view_ServiceList($hgpid, 1);
					$addonservicelist = FunctionsClientController::get_view_ServiceList($hgpid, 2);
					$mainservices_reg	= FunctionsClientController::get_view_reg_facility_services($reg_fac_id, 1);
					$addOnservices_reg	= FunctionsClientController::get_view_reg_facility_services($reg_fac_id, 2);
					$mainservices_applied	= FunctionsClientController::get_view_facility_services_per_appform($appid, 1);
					$addOnservices_applied	= FunctionsClientController::get_view_facility_services_per_appform($appid, 2);
					$chk			=  DB::table('x08_ft')->where([['appid', $appid]])->first();
					$chkFacid 		= new stdClass();
					$proceesedAmb 	= []; 
					$arrRet1 		= []; 
					$faclArr 		= []; 
					$facl_grp 		= FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
					$appGet 		= FunctionsClientController::getUserDetailsByAppform($appid, NULL);	
					$apptype 		= ($appid > 0 && count($appGet) > 0 ) ? $appGet[0]->hfser_id :	$hfser_id;													
					$hfaci_sql 		= "SELECT * FROM hfaci_grp WHERE hgpid IN (SELECT hgpid FROM `facl_grp` WHERE hfser_id = '$apptype')"; 

					if($functype == 'as')
					{						
						$isaddnew 		= 1;	
						$cat_id			= 5;	
					}
					if($functype == 'cs' )
					{						
						$isupdate 		= 1;
						$cat_id			= 4;	
					}
					if($functype == 'hospital')
					{
						$isaddnew 		= 1;
						$isupdate 		= 1;
						$cat_id			= 9;		
					}
					
					foreach ($facl_grp as $f) {	array_push($faclArr, $f->hgpid);	}

					if($chk)
					{
						$chkFacid->facid = $chk->facid;
	
						if(!empty($appid)) 
						{
							$sql2 = array($chk->facid);							
							$sql1 = "SELECT DISTINCT hgpid FROM facilitytyp WHERE facid = '$chk->facid' ORDER BY hgpid DESC";
							$sql3 = "SELECT facid, facname FROM facilitytyp WHERE facid = '$chk->facid'";
							$sql4 = "SELECT hgpid, hgpdesc FROM hfaci_grp WHERE hgpid IN ($sql1)";	
							//$arrRet1 = [DB::select($sql1), [$chkFacid], DB::select($sql3), DB::select($sql4)];
						}
					}
					foreach (AjaxController::getForAmbulanceList(false,'forAmbulance.hgpid') as $key => $value) {
						array_push($proceesedAmb, $value->hgpid);
					}
					
					$data2 = [
						// 'grpid' =>  $grpid,
						'aptid'				=> 'IC',
						'apptypenew'		=> 'IC',						
						'nameofcomp'		=> $nameofcomp,
						'hfser'				=> $hfser_id,
						'user'				=> $user_data,
						'regions'			=> Regions::orderBy('sort')->get(),
						'hfaci_service_type'=> HFACIGroup::whereIn('hgpid', $faclArr)->get(),
						'appFacName'		=> FunctionsClientController::getDistinctByFacilityName(),
						'userInf'			=> FunctionsClientController::getUserDetails(),
						'hfaci_serv_type'	=> DB::select($hfaci_sql),
						'serv_cap'			=> json_encode(DB::table('facilitytyp')->where('servtype_id',1)->get()),
						'apptype'			=> DB::table('apptype')->get(),
						'ownership'			=> DB::table('ownership')->get(),
						'class'				=> json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
						'subclass'			=> json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
						'function'			=> DB::table('funcapf')->get(),
						'facmode'			=> DB::table('facmode')->get(),
						'fAddress'			=> $appGet,
						'servfac'			=> json_encode(FunctionsClientController::getServFaclDetails($appid)),
						'ptcdet'			=> json_encode(FunctionsClientController::getPTCDetails($appid)),
						'cToken'			=> FunctionsClientController::getToken(),
						'addresses'			=> '',
						'hfer'				=> $apptype,
						'hideExtensions'	=> null,
						'ambcharges'		=> DB::table('chg_app')->whereIn('chgapp_id', ['284', '472'])->get(),
						'group'				=> json_encode(DB::table('facilitytyp')->where('servtype_id','>',1)->whereNotNull('grphrz_name')->get()),
						'forAmbulance'		=> json_encode($proceesedAmb),	
						'mainservices_reg'		=> $mainservices_reg,
						'addOnservices_reg'		=> $addOnservices_reg,
						'mainservices_applied'	=> $mainservices_applied,
						'addOnservices_applied'	=> $addOnservices_applied,
						'mainservicelist'		=> $mainservicelist,
						'addonservicelist'		=> $addonservicelist,
						'isaddnew'		=> $isaddnew,
						'isupdate'		=> $isupdate,
						'cat_id'		=> $cat_id
					];
					
					$data = array_merge($data, $data2);
				}
				
				return view($locRet, $data);
			}
			else{
				return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No Registered Facility Record found. Contact the admin']);
			}
		//} catch (Exception $e) {
		//	return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on page Apply. Contact the admin']);
		//}
		return back()->with('errRet', ['system_error'=>'No registered facility on sight.']);		
	}

	public function __editAppHfsrb(Request $request, $hfser, $appid) {

		$emp = FunctionsClientController::getSessionParamObj("employee_login");
		$appid1 = FunctionsClientController::getApplicationDetailsFEmployee($appid);

		if(isset($emp)) { if(count($appid1) > 0) {
			return self::__applyhfsrb($request, $hfser, $appid, $appid1[0]->uid);
		} }
		return back()->with('errRet', ['system_error'=>'No employee on sight.']);
	}
	public function __editAppFda(Request $request, $hfser, $appid) {

		$emp = FunctionsClientController::getSessionParamObj("employee_login");
		$appid1 = FunctionsClientController::getApplicationDetailsFEmployee($appid);

		if(isset($emp)) { if(count($appid1) > 0) {
			return self::__applyfda($request, $hfser, $appid, $appid1[0]->uid);
		} }
		return back()->with('errRet', ['system_error'=>'No employee on sight.']);
	}
	// syrel ni
	//assessment
	public function cdrrhrxraymachine(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'cdrrhrxraylist' => DB::table('cdrrhrxraylist')->join('fda_xraymach','cdrrhrxraylist.machinetype','fda_xraymach.xrayid')/*->leftJoin('fda_xraymach','cdrrhrxraylist.location','fda_xraymach.xrayid')*/->where('appid',$appid)->get(),
				'dropdowns' => [AjaxController::getAllFrom('fda_xraylocation'),AjaxController::getAllFrom('fda_xraymach')],
				'canAdd' => DB::table('appform')->where('appid',$appid)->select('isReadyForInspecFDA')->first()->isReadyForInspecFDA,
				'appid' => $appid
			];
			// dd($arrRet);
			return view('client1.apply.LTO1.cdrrhr.xraymachine',$arrRet);
		} else if($request->isMethod('post')) {
			if($request->action == 'add'){
				$returnToSender = DB::table('cdrrhrxraylist')->insert(['machinetype' => $request->xray, 'appuse' => $request->appuse, 'brandtubehead' => $request->brandTH, 'brandtubeconsole' => $request->brandCC, 'modeltubehead' => $request->modelTH, 'modeltubeconsole' => $request->modelCC, 'serialtubehead' => $request->serialTH, 'serialconsole' => $request->serialCC, 'maxma' => $request->ma , 'maxkvp' => $request->kvp , 'photonmv' => $request->lmv , 'electronsmev' => $request->lmev , 'location' => $request->location, 'appid' => $appid]);
			} else if($request->action == 'edit'){
				$returnToSender = DB::table('cdrrhrxraylist')
				->where('id',$request->id)->update([
					'machinetype' => $request->edit_lname, 
					'brandtubehead' => $request->edit_position, 
					'brandtubeconsole' => $request->edit_tin,
					'email' => $request->edit_email, 
					'modeltubeconsole' => $request->edit_govid
				]);
			} else if($request->action == 'delete') {
				$returnToSender = DB::table('cdrrhrxraylist')->where('id',$request->id)->delete();
			}
			return ($returnToSender > 0 ? "DONE" : "ERROR");
		}
	}
	public function viewcdrrhrxraymachine(Request $request, $appid){
		if($request->isMethod('get')){
			$arrRet = [
				'cdrrhrxraylist' => DB::table('cdrrhrxraylist')->join('fda_xraymach','cdrrhrxraylist.machinetype','fda_xraymach.xrayid')/*->leftJoin('fda_xraymach','cdrrhrxraylist.location','fda_xraymach.xrayid')*/->where('appid',$appid)->get(),
				'dropdowns' => [AjaxController::getAllFrom('fda_xraylocation'),AjaxController::getAllFrom('fda_xraymach')]
			];
			return view('client1.apply.LTO1.cdrrhrview.xraymachine',$arrRet);
		}
	}
	public function cdrrhrxrayservcat(Request $request, $appid){
		if($request->isMethod('get')){
			$data = DB::table('fda_xraycat')->join('fda_xrayserv','fda_xrayserv.catid','fda_xraycat.catid')->get();
			$selectedServices = (!empty(DB::table('cdrrhrxrayservcat')->where('appid',$appid)->first()) ? DB::table('cdrrhrxrayservcat')->where('appid',$appid)->first()->selected : []);
			$arrRet = [
				'serv' => $data,
				'selected' => (empty($selectedServices) ? "" :explode(',',$selectedServices)),
				'canAdd' => DB::table('appform')->where('appid',$appid)->select('isReadyForInspecFDA')->first()->isReadyForInspecFDA,
				'appid' => $appid
			];
			// dd($arrRet);
			return view('client1.apply.LTO1.cdrrhr.xrayservcat',$arrRet);
		} else if($request->isMethod('post')) {

			try {
				if(!empty($request->services)){
					if(DB::table('cdrrhrxrayservcat')->where('appid',$appid)->exists() === false){
						$returnToSender = DB::table('cdrrhrxrayservcat')->insert(['selected' => implode(',',$request->services), 'appid' => $appid]);
					} else {
						$returnToSender = DB::table('cdrrhrxrayservcat')->where(['appid' => $appid])->update(['selected' => implode(',',$request->services)]);
					}
					return ($returnToSender > 0 ? "DONE" : "ERROR");
				} else {
					return 'noServSelected';
				}
			} catch (Exception $e) {
				return $e;
			}		
		}
	}
	public function viewcdrrhrxrayservcat(Request $request, $appid){
		if($request->isMethod('get')){
			$data = DB::table('fda_xraycat')->join('fda_xrayserv','fda_xrayserv.catid','fda_xraycat.catid')->get();
			$selectedServices = (!empty(DB::table('cdrrhrxrayservcat')->where('appid',$appid)->first()) ? DB::table('cdrrhrxrayservcat')->where('appid',$appid)->first()->selected : '');
			$arrRet = [
				'serv' => $data,
				'selected' => explode(',',$selectedServices)
			];
			return view('client1.apply.LTO1.cdrrhrview.xrayservcat',$arrRet);
		}
	}
	public function cdrrpersonnel(Request $request, $appid){

		if(FunctionsClientController::isUserApplication($appid)){

			if($request->isMethod('get')){
				$inHF = array();
				
				/* $cdrr = DB::table('cdrrpersonnel')->where('appid','=',$appid)->get();
				$cdrrnew = DB::table('cdrrpersonnel')->join('hfsrbannexa', 'cdrrpersonnel.hfsrbannexaID', '=', 'hfsrbannexa.id')
								->join('position','position.posid','hfsrbannexa.prof')
								->select('cdrrpersonnel.*', 'position.posname', 'hfsrbannexa.profession', 'position.groupRequired')
								->where('cdrrpersonnel.appid',$appid)->get(); */

				$cdrr = DB::table('cdrrpersonnel')->where('appid','=',$appid)->get();
				$cdrrnew = DB::table('cdrrpersonnel')->join('hfsrbannexa', 'cdrrpersonnel.hfsrbannexaID', '=', 'hfsrbannexa.id')
								->join('position','position.posid','hfsrbannexa.prof')
								->select('hfsrbannexa.firstname', 'hfsrbannexa.middlename', 'hfsrbannexa.surname', 'hfsrbannexa.suffix', 'hfsrbannexa.profession', 'cdrrpersonnel.*', 'position.posname', 'position.groupRequired')
								->where('hfsrbannexa.appid',$appid)->get();

				if(count($cdrr) > 0){
					foreach ($cdrr as $key) {
						if(!in_array($key->id, $inHF)){
							array_push($inHF, $key->id);
						}
					}
					$inHF = implode(',', $inHF);
				}
				$professions = DB::table('profession')->get();
				$profession = array();

				foreach ($professions as $key => $value) {
					$profession[$value->id.'-'.$value->type] = $value->description;
				}

				$arrRet = [
					'cdrrpersonnelnew' => $cdrrnew,
					'profession' => $profession,
					'cdrrpersonnel' => $cdrr,
					'annexa' => DB::table('hfsrbannexa')->where('appid',$appid)->whereNotIn('id',(is_array($inHF) ? [] : [$inHF]) )->get(),
					'appid' => $appid
				];

				return view('client1.apply.LTO1.cdrr.personnel',$arrRet);
			} else if($request->isMethod('post')) {
				if($request->action == 'add'){
					if(!empty($request->states)){
						foreach ($request->states as $key) {
							$data = DB::table('hfsrbannexa')->where('id',$key)->first();
							DB::table('cdrrpersonnel')->insert(['hfsrbannexaID' => $data->id, 'appid' => $data->appid, 'name' => strtolower($data->prefix . ' ' . $data->firstname . ' ' . $data->middlename . ' ' . $data->surname . ' ' . $data->suffix ), 'designation' => $data->pos, 'tin' => $data->tin, 'email' => $data->email, 'area' => $data->area]);
						}
					}
					$returnToSender = 1;
				} else if($request->action == 'edit'){
					$editArr = ['tin' => $request->edit_tin, 'area' => $request->edit_area];
					if($request->hasFile('edit_prc') || $request->hasFile('edit_coe')){
						if($request->hasFile('edit_prc')){
							$prcFilename = FunctionsClientController::uploadFile($request->edit_prc);
							$editArr['prc'] = $prcFilename['fileNameToStore'];
						}
						if($request->hasFile('edit_coe')){
							$coeFilename = FunctionsClientController::uploadFile($request->edit_coe);
							$editArr['coe'] = $coeFilename['fileNameToStore'];
						}
					} 
					$returnToSender = DB::table('cdrrpersonnel')
						->where('id',$request->id)->update(/*[*/$editArr
							// 'name' => $request->edit_lname, 
							// 'designation' => $request->edit_position, 
							// 'tin' => $request->edit_tin,
							// 'email' => $request->edit_email
							/*'governmentid' => $request->edit_govid*/
						/*]*/);
					$returnToSender = 1;
				} else if($request->action == 'delete') {
					$returnToSender = DB::table('cdrrpersonnel')->where('id',$request->id)->delete();
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}


	public function fdacoc(Request $request, $appid){
		if(FunctionsClientController::isUserApplication($appid)){

			if($request->isMethod('get')){
				
				$coc = DB::table('fda_coc')->where('appid',$appid)->where('fda_type','Pharmacy')->get();

				$arrRet = [
					'cocs' => $coc,
					'appid' => $appid
				];

				// dd($arrRet);
				return view('client1.apply.LTO1.cdrr.coc',$arrRet);

			} else if($request->isMethod('post')) {

				if($request->action == 'add'){
					if(!empty($request->coc_number)){
						// dd($request->coc_file);
						$cocFilename = FunctionsClientController::uploadFile($request->coc_file);
						// dd($cocFilename);

						DB::table('fda_coc')->insert(
							[
								'appid' => $request->appid, 
								'coc_number' => $request->coc_number, 
								'valid_to' => $request->valid_to, 
								'coc_file' => $cocFilename['fileNameToStore'], 
								'fda_type' => $request->fda_type, 
							]
						);
					}

					$returnToSender = 1;

				} else if($request->action == 'edit'){
			
					$editArr = ['coc_number' => $request->coc_number, 'valid_to' => $request->valid_to, 'fda_type' => $request->fda_type ];
	
					if($request->hasFile('coc_file')){
						$cocFilename = FunctionsClientController::uploadFile($request->coc_file);
						$editArr['coc_file'] = $cocFilename['fileNameToStore'];
					}

					
					DB::table('fda_coc')->where('id',$request->id)
					->update($editArr);


					$returnToSender = 1;
				} else if($request->action == 'delete') {
					$returnToSender = DB::table('fda_coc')->where('id',$request->id)->delete();
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}

	public function fdacocr(Request $request, $appid){
		if(FunctionsClientController::isUserApplication($appid)){

			if($request->isMethod('get')){
				
				$coc = DB::table('fda_coc')->where('appid',$appid)->where('fda_type','Radiology')->get();

				$arrRet = [
					'cocs' => $coc,
					'appid' => $appid
				];

				// dd($arrRet);
				return view('client1.apply.LTO1.cdrrhr.coc',$arrRet);

			} else if($request->isMethod('post')) {

				if($request->action == 'add'){
					if(!empty($request->coc_number)){
						// dd($request->coc_file);
						$cocFilename = FunctionsClientController::uploadFile($request->coc_file);
						// dd($cocFilename);

						DB::table('fda_coc')->insert(
							[
								'appid' => $request->appid, 
								'coc_number' => $request->coc_number, 
								'valid_to' => $request->valid_to, 
								'coc_file' => $cocFilename['fileNameToStore'], 
								'fda_type' => $request->fda_type, 
							]
						);
					}

					$returnToSender = 1;

				} else if($request->action == 'edit'){
			
					$editArr = ['coc_number' => $request->coc_number, 'valid_to' => $request->valid_to, 'fda_type' => $request->fda_type ];
	
					if($request->hasFile('coc_file')){
						$cocFilename = FunctionsClientController::uploadFile($request->coc_file);
						$editArr['coc_file'] = $cocFilename['fileNameToStore'];
					}

					
					DB::table('fda_coc')->where('id',$request->id)
					->update($editArr);


					$returnToSender = 1;
				} else if($request->action == 'delete') {
					$returnToSender = DB::table('fda_coc')->where('id',$request->id)->delete();
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}


	public static function  getTaggedCount($appid)
	{
		return DB::table('cdrrpersonnel')->where(['appid'=>$appid, 'isTag'=>1])->count();
	}


	public function viewcdrrpersonnel(Request $request, $appid, $tag = false){
		if($tag && !session()->has('employee_login')){
			return redirect('employee')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please login first']);
		}
		try {
			if($request->isMethod('get')){
				$cdrrnew = DB::table('cdrrpersonnel')->join('hfsrbannexa', 'cdrrpersonnel.hfsrbannexaID', '=', 'hfsrbannexa.id')
				// ->join('cdrrhrpersonnel','hfsrbannexa.id','cdrrhrpersonnel.hfsrbannexaID')
				->join('position','position.posid','hfsrbannexa.prof')
				->select('cdrrpersonnel.*', 'position.posname', 'hfsrbannexa.profession', 'hfsrbannexa.dob', 'hfsrbannexa.prcno', 'hfsrbannexa.validityPeriodTo as validity')
				// ->where('hfsrbannexa.appid',$appid)->get();
				->where('cdrrpersonnel.appid',$appid)->get();

				$professions = DB::table('profession')->get();
				$profession = array();
				foreach ($professions as $key => $value) {
					$profession[$value->id.'-'.$value->type] = $value->description;
				}

				$arrRet = [
					'tag' => $tag,
					'AppData' => AjaxController::getAllDataEvaluateOne($appid),
					'cdrrpersonnel' => $cdrrnew,
					'profession' => $profession
				];
				($tag ? $arrRet['currentUser'] = AjaxController::getCurrentUserAllData() : '');
				return view('client1.apply.LTO1.cdrrview.personnel',$arrRet);
			} else {
				if($tag && $request->has('action')){

					date_default_timezone_set('Asia/Manila');

					if(DB::table('cdrrpersonnel')->where('id',$request->id)->update(['isTag' => $request->action, 'tagBy' => AjaxController::getCurrentUserAllData()['cur_user'], 'remarkstag' => $request->remarkstag])){
						
						return 'DONE';
					}
				}
			}
		} catch (Exception $e) {
			return $e;
		}
		
	}

	public function viewcocp(Request $request, $appid, $tag = false){
		if($tag && !session()->has('employee_login')){
			return redirect('employee')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please login first']);
		}

		try {
			if($request->isMethod('get')){
				$arrRet = [
					'tag' => $tag,
					'cocs' => DB::table('fda_coc')->where('appid',$appid)->where('fda_type', 'Pharmacy')->get()
				];
				($tag ? $arrRet['currentUser'] = AjaxController::getCurrentUserAllData() : '');
				return view('client1.apply.LTO1.cdrrview.coc',$arrRet);
			} else {
				if($tag && $request->has('action')){
					if(DB::table('cdrrpersonnel')->where('id',$request->id)->update(['isTag' => $request->action, 'tagBy' => AjaxController::getCurrentUserAllData()['cur_user']])){
						return 'DONE';
					}
				}
			}
		} catch (Exception $e) {
			return $e;
		}
		
	}

	public function viewcocr(Request $request, $appid, $tag = false){
		if($tag && !session()->has('employee_login')){
			return redirect('employee')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please login first']);
		}

		try {
			if($request->isMethod('get')){
				$arrRet = [
					'tag' => $tag,
					'cocs' => DB::table('fda_coc')->where('appid',$appid)->where('fda_type', 'Radiology')->get()
				];
				($tag ? $arrRet['currentUser'] = AjaxController::getCurrentUserAllData() : '');
				return view('client1.apply.LTO1.cdrrhrview.coc',$arrRet);
			} else {
				if($tag && $request->has('action')){
					if(DB::table('cdrrpersonnel')->where('id',$request->id)->update(['isTag' => $request->action, 'tagBy' => AjaxController::getCurrentUserAllData()['cur_user']])){
						return 'DONE';
					}
				}
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function viewcdrrattachments(Request $request, $appid){
		if($request->isMethod('get')){
			$arrRet = [
				'cdrrattachment' => DB::table('cdrrattachment')->where('appid',$appid)->get(),
			];
			return view('client1.apply.LTO1.cdrrview.attachment',$arrRet);
		}
	}
	public function cdrrhrpersonnel(Request $request, $appid){
		if(FunctionsClientController::isUserApplication($appid)){
			if($request->isMethod('get')){
				$inHF = array();
				$cdrrhr = DB::table('cdrrhrpersonnel')->where('appid',$appid)->get();

				$cdrrnew = DB::table('cdrrhrpersonnel')->join('hfsrbannexa', 'cdrrhrpersonnel.hfsrbannexaID', '=', 'hfsrbannexa.id')
				->leftJoin('position','position.posid','hfsrbannexa.prof')
				->select('cdrrhrpersonnel.*', 'position.posname', 'hfsrbannexa.isMainRadio', 'hfsrbannexa.ismainpo', 'hfsrbannexa.isMainRadioPharma', 'hfsrbannexa.isChiefRadTech', 'hfsrbannexa.isXrayTech','hfsrbannexa.profession')
				->where('cdrrhrpersonnel.appid',$appid)->get();

				if(count($cdrrhr) > 0){
					foreach ($cdrrhr as $key) {
						if(!in_array($key->id, $inHF)){
							array_push($inHF, $key->id);
						}
					}
					$inHF = implode(',', $inHF);
				}

				$professions = DB::table('profession')->get();
				$profession = array();
				foreach ($professions as $key => $value) {
					$profession[$value->id.'-'.$value->type] = $value->description;
				}


				$arrRet = [
					'cdrrhrpersonnelnew' => $cdrrnew,
					'cdrrhrpersonnel' => $cdrrhr,
					'profession' => $profession,
					'annexa' => DB::table('hfsrbannexa')->where('appid',$appid)->whereNotIn('id',(is_array($inHF) ? [] : [$inHF]) )->get(),
					'appid' => $appid
				];
				return view('client1.apply.LTO1.cdrrhr.personnel',$arrRet);
			} else if($request->isMethod('post')) {
				if($request->action == 'add'){
					if(!empty($request->states)){
						foreach ($request->states as $key) {
							$data = DB::table('hfsrbannexa')->where('id',$key)->first();
							DB::table('cdrrhrpersonnel')->insert(['hfsrbannexaID' => $data->id, 'appid' => $data->appid, 'name' => strtolower($data->prefix . ' ' . $data->firstname . ' ' . $data->middlename . ' ' . $data->surname . ' ' . $data->suffix ), 'designation' => $data->pos, 'qualification' => $data->qual, 'prcno' => $data->prcno, 'faciassign' => $data->area, 'validity' => $data->validityPeriodTo]);
						}
					}
					$returnToSender = 1;
					// $filename = FunctionsClientController::uploadFile($request->add_attachment);
					// if($filename['mime'] == 'application/pdf'){
					// $returnToSender = DB::table('cdrrhrpersonnel')->insert(['name' => $request->add_name, 'designation' => $request->add_position, 'faciassign' => $request->add_faciassign, 'qualification' => $request->add_qualification, 'prcno' => $request->add_prcno, 'validity' => $request->add_validity, 'certificate' => $filename['fileNameToStore'], 'appid' => $appid]);
					// }
					// else {
					// 	return 'invalidFile';
					// }
				} else if($request->action == 'edit'){
					// if($request->hasFile('edit_attachment') && isset($request->oldFilename)){
					// 	if(Storage::exists('public/uploaded/'.$request->oldFilename)){
					// 		unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $request->oldFilename ));
					// 	}
					// 	$filename = FunctionsClientController::uploadFile($request->edit_attachment);
					// 	if($filename['mime'] == 'application/pdf'){
					// 		$returnToSender = DB::table('cdrrhrpersonnel')->where('id',$request->id)->update([
					// 			'name' => $request->edit_name, 
					// 			'designation' => $request->edit_position, 
					// 			'faciassign' => $request->edit_faciassign,
					// 			'qualification' => $request->edit_qualification,
					// 			'prcno' => $request->edit_prcno,
					// 			'validity' => $request->edit_validity,
					// 			'certificate' => $filename['fileNameToStore']
					// 		]);
					// 	} else {
					// 		return 'invalidFile';
					// 	}
					// } else {
					// 	$returnToSender = DB::table('cdrrhrpersonnel')
					// 	->where('id',$request->id)->update([
					// 		'name' => $request->edit_name, 
					// 		'designation' => $request->edit_position, 
					// 		'faciassign' => $request->edit_faciassign,
					// 		'qualification' => $request->edit_qualification,
					// 		'prcno' => $request->edit_prcno,
					// 		'validity' => $request->edit_validity
					// 	]);
					// }
					$editArr = ['faciassign' => $request->edit_faciassign];
					if($request->hasFile('edit_prc') || $request->hasFile('edit_coe') || $request->hasFile('edit_bc')){
						
						if($request->hasFile('edit_prc')){
							$prcFilename = FunctionsClientController::uploadFile($request->edit_prc);
							$editArr['prc'] = $prcFilename['fileNameToStore'];
						}
						if($request->hasFile('edit_coe')){
							$coeFilename = FunctionsClientController::uploadFile($request->edit_coe);
							$editArr['coe'] = $coeFilename['fileNameToStore'];
						}
						if($request->hasFile('edit_bc')){
							$bcFilename = FunctionsClientController::uploadFile($request->edit_bc);
							$editArr['bc'] = $bcFilename['fileNameToStore'];
						}
					} 
					$returnToSender = DB::table('cdrrhrpersonnel')
					->where('id',$request->id)->update(/*[*/$editArr
						// 'name' => $request->edit_lname, 
						// 'designation' => $request->edit_position, 
						// 'tin' => $request->edit_tin,
						// 'email' => $request->edit_email
						/*'governmentid' => $request->edit_govid*/
					/*]*/);
					$returnToSender = 1;
				} else if($request->action == 'delete') {

					// if(Storage::exists('public/uploaded/'.$request->filename)){
					// 	unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $request->filename));
					// }
					$returnToSender = DB::table('cdrrhrpersonnel')->where('id',$request->id)->delete();
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}
	public function viewcdrrhrpersonnel(Request $request, $appid){
		try {
			if($request->isMethod('get')){

				$cdrrnew = DB::table('cdrrhrpersonnel')->join('hfsrbannexa', 'cdrrhrpersonnel.hfsrbannexaID', '=', 'hfsrbannexa.id')
				->leftJoin('position','position.posid','hfsrbannexa.prof')
				->select('cdrrhrpersonnel.*', 'position.posname', 'hfsrbannexa.isMainRadio', 'hfsrbannexa.ismainpo', 'hfsrbannexa.isMainRadioPharma', 'hfsrbannexa.isChiefRadTech', 'hfsrbannexa.isXrayTech','hfsrbannexa.profession')
				->where('cdrrhrpersonnel.appid',$appid)->get();

				$professions = DB::table('profession')->get();
				$profession = array();
				foreach ($professions as $key => $value) {
					$profession[$value->id.'-'.$value->type] = $value->description;
				}


				$arrRet = [
					'cdrrhrpersonnel' => $cdrrnew,
					'profession' => $profession,
				];
				return view('client1.apply.LTO1.cdrrhrview.personnel',$arrRet);
			}
		} catch (Exception $e) {
			return $e;
		}
		
	}
	public function cdrrreceipt(Request $request, $appid){
		if(FunctionsClientController::isUserApplication($appid)){
			if($request->isMethod('get')){
				$arrRet = [
					'cdrrreceipt' => DB::table('cdrrreceipt')->where('appid',$appid)->get()
				];
				return view('client1.apply.LTO1.cdrr.receipt',$arrRet);
			} else if($request->isMethod('post')) {
				if($request->action == 'add'){
					$filename = FunctionsClientController::uploadFile($request->add_attachment);
					if($filename['mime'] == 'application/pdf'){
						$returnToSender = DB::table('cdrrreceipt')->insert(['receiptno' => $request->add_receipt, 'dop' => $request->add_dop, 'office' => $request->add_office, 'amountpaid' => $request->add_amount, 'attachment' => $filename['fileNameToStore'], 'appid' => $appid]);
							return ($returnToSender > 0 ? "DONE" : "ERROR");
					} else {
						return 'invalidFile';
					}
				}
			}
		}
		else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}
	public function cdrrhrreceipt(Request $request, $appid){
		if(FunctionsClientController::isUserApplication($appid)){
			if($request->isMethod('get')){
				$arrRet = [
					'cdrrhrreceipt' => DB::table('cdrrhrreceipt')->where('appid',$appid)->get()
				];
				return view('client1.apply.LTO1.cdrrhr.receipt',$arrRet);
			} else if($request->isMethod('post')) {
				if($request->action == 'add'){
					$filename = FunctionsClientController::uploadFile($request->add_attachment);
					if($filename['mime'] == 'application/pdf'){
						$returnToSender = DB::table('cdrrhrreceipt')->insert(['receiptno' => $request->add_receipt, 'dop' => $request->add_dop, 'office' => $request->add_office, 'amountpaid' => $request->add_amount, 'attachment' => $filename['fileNameToStore'], 'appid' => $appid]);
							return ($returnToSender > 0 ? "DONE" : "ERROR");
					} else {
						return 'invalidFile';
					}
				}
			}
		}
		else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}
	public function cdrrattachments(Request $request, $appid){
		if(FunctionsClientController::isUserApplication($appid)){
			if($request->isMethod('get')){
				$arrRet = [
					'cdrrattachment' => DB::table('cdrrattachment')->where('appid',$appid)->get(),
					'canAdd' => DB::table('appform')->where('appid',$appid)->select('isReadyForInspecFDA')->first()->isReadyForInspecFDA,
					'appid' => $appid
				];
				return view('client1.apply.LTO1.cdrr.attachment',$arrRet);
			} else if($request->isMethod('post')) {
				if($request->action == 'add'){
					$filename = FunctionsClientController::uploadFile($request->add_attachment);
					if($filename['mime'] == 'application/pdf'){
						$returnToSender = DB::table('cdrrattachment')->insert(['attachmentdetails' => $request->add_details, 'attachment' => $filename['fileNameToStore'], 'appid' => $appid]);
					} else {
						return 'invalidFile';
					}
				} else if($request->action == 'delete'){
					if(Storage::exists('public/uploaded/'.$request->deleteFile)){
						unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $request->deleteFile ));
					}
					$returnToSender = DB::table('cdrrattachment')->where('id',$request->id)->delete();
				} else if($request->action == 'edit'){
					if($request->hasFile('edit_attachment') && isset($request->oldFilename)){
						if(Storage::exists('public/uploaded/'.$request->oldFilename)){
							unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $request->oldFilename ));
						}
						$filename = FunctionsClientController::uploadFile($request->edit_attachment);
						if($filename['mime'] == 'application/pdf'){
							$returnToSender = DB::table('cdrrattachment')->where('id',$request->id)->update(['attachmentdetails' => $request->edit_details, 'attachment' => $filename['fileNameToStore']]);
						} else {
							return 'invalidFile';
						}
					} else {
						$returnToSender = DB::table('cdrrattachment')->where('id',$request->id)->update([
							'attachmentdetails' => $request->edit_details
						]);
					}
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}




	public function cdrrhrattachments(Request $request, $appid){
		if(FunctionsClientController::isUserApplication($appid)){
			
			$arrRet = [
				'cdrrhrotherattachment' => DB::table('cdrrhrotherattachment')->select('cdrrhrotherattachment.*', 'cdrrhrrequirements.reqName')->leftJoin('cdrrhrrequirements','cdrrhrrequirements.reqID','cdrrhrotherattachment.reqID')->where('appid',$appid)->get(),
				'attType' => DB::table('cdrrhrrequirements')->get(),
				'appid' => $appid
			];

			if($request->isMethod('get')){
				// dd($arrRet);
				return view('client1.apply.LTO1.cdrrhr.attachment',$arrRet);
			} else if($request->isMethod('post')) {
				// return $request->all();
				if($request->action == 'add'){
					$filename = FunctionsClientController::uploadFile($request->add_attachment);
						$returnToSender = DB::table('cdrrhrotherattachment')->insert(['reqID' => $request->req, 'attachmentdetails' => $request->add_details, 'attachment' => $filename['fileNameToStore'],  'appid' => $appid]);
						// $returnToSender = DB::table('cdrrhrotherattachment')->insert(['attachmentdetails' => $request->add_details, 'attachment' => $filename['fileNameToStore'], 'reqID' => $request->req, 'appid' => $appid]);
				} else if($request->action == 'delete'){
					if(Storage::exists('public/uploaded/'.$request->deleteFile)){
						unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $request->deleteFile ));
					}
					$returnToSender = DB::table('cdrrhrotherattachment')->where('id',$request->id)->delete();
				} else if($request->action == 'edit'){
					if($request->hasFile('edit_attachment') && isset($request->oldFilename)){
						if(Storage::exists('public/uploaded/'.$request->oldFilename)){
							unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $request->oldFilename ));
						}
						$filename = FunctionsClientController::uploadFile($request->edit_attachment);
						if($filename['mime'] == 'application/pdf'){
							$returnToSender = DB::table('cdrrhrotherattachment')->where('id',$request->id)->update(['attachmentdetails' => $request->edit_details, 'reqID' => $request->edit_req, 'attachment' => $filename['fileNameToStore']]);
						} else {
							return 'invalidFile';
						}
					} else {
						$returnToSender = DB::table('cdrrhrotherattachment')->where('id',$request->id)->update([
							'attachmentdetails' => $request->edit_details
						]);
					}
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}

	public function viewcdrrhrattachments(Request $request, $appid){
		if($request->isMethod('get')){
			$arrRet = [
				'cdrrhrotherattachment' => DB::table('cdrrhrotherattachment')->leftJoin('cdrrhrrequirements','cdrrhrrequirements.reqID','cdrrhrotherattachment.reqID')->where('appid',$appid)->get()
			];
			return view('client1.apply.LTO1.cdrrhrview.attachment',$arrRet);
		}
	}

	//hfsrb requirements for initial change
	public function reg_annexa_COR(Request $request, $regfac_id, $appid=null){
		//if(FunctionsClientController::isUserApplication($appid)){
			$hgpid = null; $pos = DB::table('position')->get();
			$professions = DB::table('profession')->get();

			if($appid <= 0) { $appid=null; }

			if((isset($appid) && !empty($appid) && $appid!=null)) {
				$hgpid = DB::table('appform')->where('appid',$appid)->select('hgpid')->first()->hgpid;
			} else {
				$hgpid = DB::table('registered_facility')->where('regfac_id',$regfac_id)->select('facid')->first()->facid;
			}

			//if($request->isMethod('get')) {
				$arrRet = [
					'workstat' => AjaxController::getAllWorkStatus(),
					'pos' => $pos,
					'professions' => $professions,
					'hfsrbannexa' => [DB::table('hfsrbannexa')
					->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where('appid',$appid)->get(),
					
					DB::table('hfsrbannexa')->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where([['appid',$appid],['isMainRadio',1]])
					->doesntExist(),DB::table('hfsrbannexa')
					->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where([['appid',$appid],['isMainRadioPharma',1]])
					->doesntExist(),DB::table('hfsrbannexa')
					->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where([['appid',$appid],['ismainpo',1]])
					->doesntExist()],
					// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
					'canAdd' => true,
					'appid' =>$appid,
					'_isSuccess' => null
				];
				
			//} else 
			if($request->isMethod('post')) {
				$customInsertMach = $customInsertPhar = false;
				$filename = $returnToSender = null;
				$arrName = $arrFiles = $arrPharma = $arrMach = array();
				$toInsert = ['surname' => strtolower($request->sur_name), 
				'firstname' => strtolower($request->fname), 
				'middlename' => $request->mname, 
				'prof' => $request->prof, 
				'prcno' => $request->prcno,
				 /*'validityPeriodFrom' => $request->vfrom,*/ 
				 'validityPeriodTo' => $request->vto ,
				 'speciality' => $request->speciality,
				  'dob' => $request->dob,
				   'sex' => $request->sex, 
				   'employement' => $request->employement, 
				   'prefix' => $request->prefix, 
				   'suffix' => $request->suffix, 
				   'pos' => $request->position, 
				   'designation' => $request->designation, 
				   'area' => $request->assignment, 
				   'qual' => $request->qual, 
				   'email' => $request->email,
				   'tin' => $request->tin, 
				   'isMainRadio' => $request->head1, 
				   'isMainRadioPharma' => $request->pharmahead1 , 
				   'ismainpo' => $request->po1,
				   'isXrayTech' => $request->xtech,
				   'isChiefRadTech' => $request->chiefrt,
				   'profession' => json_encode($request->profession),
				//    'isMainRadio' => ($request->head == 1 ? $request->head : null), 
				//    'isMainRadioPharma' => ($request->pharmahead == 1 ? $request->pharmahead : null), 
				//    'ismainpo' => ($request->po == 1 ? $request->po : ($request->po1 == 1 ? $request->po1 : null)), 
				   'appid' => $appid];

				$pharma = ['appid' => $appid, 'name' => strtolower($request->prefix . ' ' . $request->fname . ' ' . $request->mname . ' ' . $request->sur_name . ' ' . $request->suffix ), 'designation' => $request->position, 'tin' => $request->tin, 'email' => $request->email, 'area' => $request->assignment];
				$mach = ['appid' => $appid, 'name' => strtolower($request->prefix . ' ' . $request->fname . ' ' . $request->mname . ' ' . $request->sur_name . ' ' . $request->suffix ), 'designation' => $request->position, 'qualification' => $request->qual, 'prcno' => $request->prcno, 'faciassign' => $request->assignment, 'validity' => $request->vto];

				if($request->po1 == 1 || $request->head1 == 1 || $request->xtech == 1 || $request->chiefrt == 1){
					$customInsertMach = true;
				}
				if($request->pharmahead1 == 1 ){
					$customInsertPhar = true;
				}
				if(count($pos) > 0){
					foreach ($pos as $position) {
						if($position->fda_type == 'cdrr'){
							if(!in_array($position->posid, $arrPharma)){
								array_push($arrPharma, $position->posid);
							}
						}
						if($position->fda_type == 'cdrrhr'){
							if(!in_array($position->posid, $arrMach)){
								array_push($arrMach, $position->posid);
							}
						}
					}
				}				
				/*if($request->has('req')){
					foreach ($request->file('req') as $key => $value) {
						$filename = FunctionsClientController::uploadFile($value);
						if($key == 'prc1'){
							array_push($arrName, 'prc');
						} else {
							array_push($arrName, $key);
						}
						array_push($arrFiles, $filename['fileNameToStore']);
					}
				}
				$filename = array_combine($arrName, $arrFiles);
				
				if(count($filename) > 0){
					foreach($filename as $key => $value){
						$toInsert[$key]  = $value;
					}
				}*/
				if($request->action == 'add'){
					$returnToSender = DB::table('hfsrbannexa')->insertGetId($toInsert);
					if($returnToSender){
						if(in_array($request->prof, $arrPharma) || in_array($request->prof, $arrMach) || $customInsertMach || $customInsertPhar){

							$pharma['hfsrbannexaID'] = $returnToSender;
							$mach['hfsrbannexaID'] = $returnToSender;

							if($hgpid!='12' && (in_array($request->prof, $arrPharma)  || $customInsertPhar)){
								$returnToSender = DB::table('cdrrpersonnel')->insert($pharma);
							}
							if(in_array($request->prof, $arrMach) || $customInsertMach){
								$returnToSender = DB::table('cdrrhrpersonnel')->insert($mach);
							}
						}
					}
				} else if($request->action == 'edit'){
					$curStat = DB::table('hfsrbannexa')->where('id',$request->id)->first();
					if(!empty($filename) && !empty($curStat)){
						foreach ($filename as $key => $value) {
							if(Storage::exists('public/uploaded/'.$curStat->$key)){
								unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $curStat->$key ));
							}
						}
					}
					$returnToSender = DB::table('hfsrbannexa')->where('id',$request->id)->update($toInsert);					

					if(in_array($request->prof, $arrPharma) || in_array($request->prof, $arrMach) || $customInsertMach || $customInsertPhar){

						$pharma['hfsrbannexaID'] = $request->id;
						$mach['hfsrbannexaID'] = $request->id;

						//MFOWS  not included in``````````````````````````````````````````````````````````````````````````````````````````
						if($hgpid=='12'){
							DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
						}

						if(in_array($request->prof, $arrPharma ) || $customInsertPhar){
							DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->update($pharma);
						}else{
							DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->update($pharma);
							DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->update(['isdelete'=>'TRUE']);
						}

						if(in_array($request->prof, $arrMach) || $customInsertMach){
							DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->update($mach);
						}else{
							DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->update($mach);
							DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->update(['isdelete'=>'TRUE']);
						}
					}
				} else if($request->action == 'delete') {
					$curStat = DB::table('hfsrbannexa')->where('id',$request->id)->select('status')->first()->status;
					$returnToSender = DB::table('hfsrbannexa')->where('id',$request->id)->update(['status' => ($curStat == 1 ? 2 : 1)]);

					DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
					DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
				}

				$arrRet['_isSuccess'] = ($returnToSender > 0 ? "DONE" : "ERROR");

				return $arrRet['_isSuccess'];
			}
			
				$arrRet['hfsrbannexa'] = [DB::table('hfsrbannexa')
					->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where('appid',$appid)->get(),
					
					DB::table('hfsrbannexa')->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where([['appid',$appid],['isMainRadio',1]])
					->doesntExist(),DB::table('hfsrbannexa')
					->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where([['appid',$appid],['isMainRadioPharma',1]])
					->doesntExist(),DB::table('hfsrbannexa')
					->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where([['appid',$appid],['ismainpo',1]])
					->doesntExist()];
			
			return $arrRet;
		/*} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}*/
	}

	public function reg_annexb_COR(Request $request, $appid = "0"){

		//if(FunctionsClientController::isUserApplication($appid)){

			if($request->isMethod('get')){
				$arrRet = [
					'hfsrbannexb' => DB::table('hfsrbannexb')->where('appid',$appid)->get(),
					// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
					'canAdd' => true,
					'appid' =>$appid
				];
				return $arrRet;
			} else if($request->isMethod('post')) {
				if($request->action == 'add'){
					$returnToSender = DB::table('hfsrbannexb')->insert(['equipment' => $request->equipment, 'brandname' => $request->brandname, 'model' => $request->model, 'serial' => $request->serial, 'quantity' => $request->quantity, 'dop' => $request->dop, 'manDate' => $request->manDate, 'appid' => $appid]);
				} else if($request->action == 'edit'){
					$returnToSender = DB::table('hfsrbannexb')
					->where('id',$request->id)->update([
						'equipment' => $request->equipment, 
						'brandname' => $request->brandname, 
						'model' => $request->model, 
						'serial' => $request->serial, 
						'quantity' => $request->quantity, 
						'manDate' => $request->manDate,
						'dop' => $request->dop
					]);
				} else if($request->action == 'delete') {
					$returnToSender = DB::table('hfsrbannexb')->where('id',$request->id)->delete();
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		//} else {
		//	return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		//}
	}

	//hfsrb requirements
	public function reg_annexa(Request $request, $regfac_id, $appid=null){
		//if(FunctionsClientController::isUserApplication($appid)){
			$hgpid = null;
			$pos = DB::table('position')->get();
			$professions = DB::table('profession')->get();
			
			if($appid <= 0) {$appid=null;}

			if((isset($appid) && !empty($appid) && $appid!=null))
			{
				$hgpid = DB::table('appform')->where('appid',$appid)->select('hgpid')->first()->hgpid;
			}
			else
			{
				$hgpid = DB::table('registered_facility')->where('regfac_id',$regfac_id)->select('facid')->first()->facid;
			}

			// dd($professions);
			if($request->isMethod('get')){
				$arrRet = [
					'workstat' => AjaxController::getAllWorkStatus(),
					'pos' => $pos,
					'professions' => $professions,
					'hfsrbannexa' => [DB::table('hfsrbannexa')
					->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where('appid',$appid)->get(),
					
					DB::table('hfsrbannexa')->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where([['appid',$appid],['isMainRadio',1]])
					->doesntExist(),DB::table('hfsrbannexa')
					->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where([['appid',$appid],['isMainRadioPharma',1]])
					->doesntExist(),DB::table('hfsrbannexa')
					->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
					->leftJoin('position','position.posid','hfsrbannexa.prof')
					->where([['appid',$appid],['ismainpo',1]])
					->doesntExist()],
					// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
					'canAdd' => true,
					'appid' =>$appid
				];
				// dd($arrRet);
				return view('client1.apply.LTO1.hfsrb.annexa',$arrRet);
			} else if($request->isMethod('post')) {
				$customInsertMach = $customInsertPhar = false;
				$filename = $returnToSender = null;
				$arrName = $arrFiles = $arrPharma = $arrMach = array();
				$toInsert = ['surname' => strtolower($request->sur_name), 
				'firstname' => strtolower($request->fname), 
				'middlename' => $request->mname, 
				'prof' => $request->prof, 
				'prcno' => $request->prcno,
				 /*'validityPeriodFrom' => $request->vfrom,*/ 
				 'validityPeriodTo' => $request->vto ,
				 'speciality' => $request->speciality,
				  'dob' => $request->dob,
				   'sex' => $request->sex, 
				   'employement' => $request->employement, 
				   'prefix' => $request->prefix, 
				   'suffix' => $request->suffix, 
				   'pos' => $request->position, 
				   'designation' => $request->designation, 
				   'area' => $request->assignment, 
				   'qual' => $request->qual, 
				   'email' => $request->email,
				   'tin' => $request->tin, 
				   'isMainRadio' => $request->head1, 
				   'isMainRadioPharma' => $request->pharmahead1 , 
				   'ismainpo' => $request->po1,
				   'isXrayTech' => $request->xtech,
				   'isChiefRadTech' => $request->chiefrt,
				   'profession' => json_encode($request->profession),
				//    'isMainRadio' => ($request->head == 1 ? $request->head : null), 
				//    'isMainRadioPharma' => ($request->pharmahead == 1 ? $request->pharmahead : null), 
				//    'ismainpo' => ($request->po == 1 ? $request->po : ($request->po1 == 1 ? $request->po1 : null)), 
				   'appid' => $appid];


				$pharma = ['appid' => $appid, 'name' => strtolower($request->prefix . ' ' . $request->fname . ' ' . $request->mname . ' ' . $request->sur_name . ' ' . $request->suffix ), 'designation' => $request->position, 'tin' => $request->tin, 'email' => $request->email, 'area' => $request->assignment];
				$mach = ['appid' => $appid, 'name' => strtolower($request->prefix . ' ' . $request->fname . ' ' . $request->mname . ' ' . $request->sur_name . ' ' . $request->suffix ), 'designation' => $request->position, 'qualification' => $request->qual, 'prcno' => $request->prcno, 'faciassign' => $request->assignment, 'validity' => $request->vto];

				// for custom addition to FDA
				// if($request->po == 1 || $request->head == 1){
				// 	$customInsertMach = true;
				// }

				if($request->po1 == 1 || $request->head1 == 1 || $request->xtech == 1 || $request->chiefrt == 1){
					$customInsertMach = true;
				}

				if($request->pharmahead1 == 1 ){
					$customInsertPhar = true;
				}


				if(count($pos) > 0){
					foreach ($pos as $position) {
						if($position->fda_type == 'cdrr'){
							if(!in_array($position->posid, $arrPharma)){
								array_push($arrPharma, $position->posid);
							}
						}
						if($position->fda_type == 'cdrrhr'){
							if(!in_array($position->posid, $arrMach)){
								array_push($arrMach, $position->posid);
							}
						}
					}
				}
				
				if($request->has('req')){
					foreach ($request->file('req') as $key => $value) {
						$filename = FunctionsClientController::uploadFile($value);
						if($key == 'prc1'){
							array_push($arrName, 'prc');
						} else {
							array_push($arrName, $key);
						}
						array_push($arrFiles, $filename['fileNameToStore']);
					}
				}
				$filename = array_combine($arrName, $arrFiles);
				if(count($filename) > 0){
					foreach($filename as $key => $value){
						$toInsert[$key]  = $value;
					}
				}
				if($request->action == 'add'){
					$returnToSender = DB::table('hfsrbannexa')->insertGetId($toInsert);
					if($returnToSender){
						if(in_array($request->prof, $arrPharma) || in_array($request->prof, $arrMach) || $customInsertMach || $customInsertPhar){

							$pharma['hfsrbannexaID'] = $returnToSender;
							$mach['hfsrbannexaID'] = $returnToSender;

							if($hgpid!='12' && (in_array($request->prof, $arrPharma)  || $customInsertPhar)){
								$returnToSender = DB::table('cdrrpersonnel')->insert($pharma);
							}
							if(in_array($request->prof, $arrMach) || $customInsertMach){
								$returnToSender = DB::table('cdrrhrpersonnel')->insert($mach);
							}
						}
					}
				} else if($request->action == 'edit'){
					$curStat = DB::table('hfsrbannexa')->where('id',$request->id)->first();
					if(!empty($filename) && !empty($curStat)){
						foreach ($filename as $key => $value) {
							if(Storage::exists('public/uploaded/'.$curStat->$key)){
								unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $curStat->$key ));
							}
						}
					}
					$returnToSender = DB::table('hfsrbannexa')->where('id',$request->id)->update($toInsert);					

					if(in_array($request->prof, $arrPharma) || in_array($request->prof, $arrMach) || $customInsertMach || $customInsertPhar){

						$pharma['hfsrbannexaID'] = $request->id;
						$mach['hfsrbannexaID'] = $request->id;

						//MFOWS  not included in``````````````````````````````````````````````````````````````````````````````````````````
						if($hgpid=='12'){
							DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
						}

						if(in_array($request->prof, $arrPharma ) || $customInsertPhar){
							DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->update($pharma);
						}else{
							DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->update($pharma);
							DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->update(['isdelete'=>'TRUE']);
						}

						if(in_array($request->prof, $arrMach) || $customInsertMach){
							DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->update($mach);
						}else{
							DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->update($mach);
							DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->update(['isdelete'=>'TRUE']);
						}
					}
				} else if($request->action == 'delete') {
					$curStat = DB::table('hfsrbannexa')->where('id',$request->id)->select('status')->first()->status;
					$returnToSender = DB::table('hfsrbannexa')->where('id',$request->id)->update(['status' => ($curStat == 1 ? 2 : 1)]);

					DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
					DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		/*} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}*/
	}

	public function reg_annexb(Request $request, $appid = "0"){

		//if(FunctionsClientController::isUserApplication($appid)){

			if($request->isMethod('get')){
				$arrRet = [
					'hfsrbannexb' => DB::table('hfsrbannexb')->where('appid',$appid)->get(),
					// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
					'canAdd' => true,
					'appid' =>$appid
				];
				return view('client1.apply.LTO1.hfsrb.annexb',$arrRet);
			} else if($request->isMethod('post')) {
				if($request->action == 'add'){
					$returnToSender = DB::table('hfsrbannexb')->insert(['equipment' => $request->equipment, 'brandname' => $request->brandname, 'model' => $request->model, 'serial' => $request->serial, 'quantity' => $request->quantity, 'dop' => $request->dop, 'manDate' => $request->manDate, 'appid' => $appid]);
				} else if($request->action == 'edit'){
					$returnToSender = DB::table('hfsrbannexb')
					->where('id',$request->id)->update([
						'equipment' => $request->equipment, 
						'brandname' => $request->brandname, 
						'model' => $request->model, 
						'serial' => $request->serial, 
						'quantity' => $request->quantity, 
						'manDate' => $request->manDate,
						'dop' => $request->dop
					]);
				} else if($request->action == 'delete') {
					$returnToSender = DB::table('hfsrbannexb')->where('id',$request->id)->delete();
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		//} else {
		//	return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		//}
	}

	public function annexa(Request $request, $appid){

		if(FunctionsClientController::isUserApplication($appid)){

			$pos = AjaxController::getAllPosition();
			$professions = AjaxController::getAllProfessionOnly();
			$hgpid = DB::table('appform')->where('appid',$appid)->select('hgpid')->first()->hgpid;

			if($request->isMethod('get')){
				$arrRet = [
					'workstat' => AjaxController::getAllWorkStatus(),
					'pos' => $pos,
					'professions' => $professions,
					'hfsrbannexa' => [DB::table('hfsrbannexa')
											->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
											->leftJoin('position','position.posid','hfsrbannexa.prof')
											->where('appid',$appid)->get(),
											
											DB::table('hfsrbannexa')->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
											->leftJoin('position','position.posid','hfsrbannexa.prof')
											->where([['appid',$appid],['isMainRadio',1]])
											->doesntExist(),DB::table('hfsrbannexa')
											->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
											->leftJoin('position','position.posid','hfsrbannexa.prof')
											->where([['appid',$appid],['isMainRadioPharma',1]])
											->doesntExist(),DB::table('hfsrbannexa')
											->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')
											->leftJoin('position','position.posid','hfsrbannexa.prof')
											->where([['appid',$appid],['ismainpo',1]])
											->doesntExist()],
					// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
					'canAdd' => true,
					'appid' =>$appid
				];

				return view('client1.apply.LTO1.hfsrb.annexa',$arrRet);

			} else if($request->isMethod('post')) {

				$customInsertMach = $customInsertPhar = false;
				$filename = $returnToSender = null;
				$arrName = $arrFiles = $arrPharma = $arrMach = array();
				$toInsert = ['surname' => strtolower($request->sur_name), 
				'firstname' => strtolower($request->fname), 
				'middlename' => $request->mname, 
				'prof' => $request->prof, 
				'prcno' => $request->prcno,
				 /*'validityPeriodFrom' => $request->vfrom,*/ 
				 'validityPeriodTo' => $request->vto ,
				 'speciality' => $request->speciality,
				  'dob' => $request->dob,
				   'sex' => $request->sex, 
				   'employement' => $request->employement, 
				   'prefix' => $request->prefix, 
				   'suffix' => $request->suffix, 
				   'pos' => $request->position, 
				   'designation' => $request->designation, 
				   'area' => $request->assignment, 
				   'qual' => $request->qual, 
				   'email' => $request->email,
				   'tin' => $request->tin, 
				   'isMainRadio' => $request->head1, 
				   'isMainRadioPharma' => $request->pharmahead1 , 
				   'ismainpo' => $request->po1,
				   'isXrayTech' => $request->xtech,
				   'isChiefRadTech' => $request->chiefrt,
				   'profession' => json_encode($request->profession),
				//    'isMainRadio' => ($request->head == 1 ? $request->head : null), 
				//    'isMainRadioPharma' => ($request->pharmahead == 1 ? $request->pharmahead : null), 
				//    'ismainpo' => ($request->po == 1 ? $request->po : ($request->po1 == 1 ? $request->po1 : null)), 
				   'appid' => $appid];

				$pharma = ['appid' => $appid, 'name' => strtolower($request->prefix . ' ' . $request->fname . ' ' . $request->mname . ' ' . $request->sur_name . ' ' . $request->suffix ), 'designation' => $request->position, 'tin' => $request->tin, 'email' => $request->email, 'area' => $request->assignment];
				$mach = ['appid' => $appid, 'name' => strtolower($request->prefix . ' ' . $request->fname . ' ' . $request->mname . ' ' . $request->sur_name . ' ' . $request->suffix ), 'designation' => $request->position, 'qualification' => $request->qual, 'prcno' => $request->prcno, 'faciassign' => $request->assignment, 'validity' => $request->vto];

				// for custom addition to FDA
				// if($request->po == 1 || $request->head == 1){
				// 	$customInsertMach = true;
				// }

				if($request->po1 == 1 || $request->head1 == 1 || $request->xtech == 1 || $request->chiefrt == 1){
					$customInsertMach = true;
				}

				if($request->pharmahead1 == 1 ){
					$customInsertPhar = true;
				}

				if(count($pos) > 0){
					foreach ($pos as $position) {
						if($position->fda_type == 'cdrr'){
							if(!in_array($position->posid, $arrPharma)){
								array_push($arrPharma, $position->posid);
							}
						}
						if($position->fda_type == 'cdrrhr'){
							if(!in_array($position->posid, $arrMach)){
								array_push($arrMach, $position->posid);
							}
						}
					}
				}
				
				if($request->has('req')){
					foreach ($request->file('req') as $key => $value) {
						$filename = FunctionsClientController::uploadFile($value);
						if($key == 'prc1'){
							array_push($arrName, 'prc');
						} else {
							array_push($arrName, $key);
						}
						array_push($arrFiles, $filename['fileNameToStore']);
					}
				}
				$filename = array_combine($arrName, $arrFiles);

				if(count($filename) > 0){
					foreach($filename as $key => $value){
						$toInsert[$key]  = $value;
					}
				}
				if($request->action == 'add'){

					$returnToSender = DB::table('hfsrbannexa')->insertGetId($toInsert);

					if($returnToSender){
						
						if(in_array($request->prof, $arrPharma) || in_array($request->prof, $arrMach) || $customInsertMach || $customInsertPhar){

							$pharma['hfsrbannexaID'] = $returnToSender;
							$mach['hfsrbannexaID'] = $returnToSender;

							if($hgpid!='12' && (in_array($request->prof, $arrPharma)  || $customInsertPhar)){
								$returnToSender = DB::table('cdrrpersonnel')->insert($pharma);
							}
							if(in_array($request->prof, $arrMach) || $customInsertMach){
								$returnToSender = DB::table('cdrrhrpersonnel')->insert($mach);
							}
						}
					}
				} else if($request->action == 'edit'){

					/*$curStat = DB::table('hfsrbannexa')->where('id',$request->id)->first();
					if(!empty($filename) && !empty($curStat)){
						foreach ($filename as $key => $value) {
							if(Storage::exists('public/uploaded/'.$curStat->$key)){
								unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $curStat->$key ));
							}
						}
					}

					$returnToSender = DB::table('hfsrbannexa')->where('id',$request->id)->update($toInsert);	
					$pharmaExistsOnDB = DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->exists();
					$radExistsOnDB = DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->exists(); 			
					
					if(in_array($request->prof, $arrPharma) || in_array($request->prof, $arrMach) || $customInsertMach || $customInsertPhar){

						$pharma['hfsrbannexaID'] = $request->id;
						$mach['hfsrbannexaID'] = $request->id;
						//MFOWS  not included in												
						if($hgpid=='12'){
							DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
						}

						if(in_array($request->prof, $arrPharma ) || $customInsertPhar){
							if($pharmaExistsOnDB) {
								DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->update($pharma);
							}else {
								DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->insert($pharma);
							}
						}else{
							if($pharmaExistsOnDB) {
								DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
							}
						}

						if(in_array($request->prof, $arrMach) || $customInsertMach){
							if($radExistsOnDB){
								DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->update($mach);
							}else {
								DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->insert($mach);
							}
						}else{
							if($radExistsOnDB) {
								DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
							}
						}
					}
					*/

					$curStat = DB::table('hfsrbannexa')->where('id',$request->id)->first();
					if(!empty($filename) && !empty($curStat)){
						foreach ($filename as $key => $value) {
							if(Storage::exists('public/uploaded/'.$curStat->$key)){
								unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $curStat->$key ));
							}
						}
					}
					$returnToSender = DB::table('hfsrbannexa')
					->where('id',$request->id)->update($toInsert);
					
					DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
					DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->delete();

					if(in_array($request->prof, $arrPharma) || in_array($request->prof, $arrMach) || $customInsertMach || $customInsertPhar){

						$pharma['hfsrbannexaID'] = $request->id;
						$mach['hfsrbannexaID'] = $request->id;
						//MFOWS  not included 		
						if($hgpid!='12' && (in_array($request->prof, $arrPharma)  || $customInsertPhar)){
							$returnToSender = DB::table('cdrrpersonnel')->insert($pharma);
						}
						if(in_array($request->prof, $arrMach) || $customInsertMach){
							$returnToSender = DB::table('cdrrhrpersonnel')->insert($mach);
						}
					}
					
				} else if($request->action == 'delete') {
					$curStat = DB::table('hfsrbannexa')->where('id',$request->id)->select('status')->first()->status;
					$returnToSender = DB::table('hfsrbannexa')->where('id',$request->id)->update(['status' => ($curStat == 1 ? 2 : 1)]);

					DB::table('cdrrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
					DB::table('cdrrhrpersonnel')->where('hfsrbannexaID',$request->id)->delete();
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
		}
		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}
	public function annexb(Request $request, $appid){

		if(FunctionsClientController::isUserApplication($appid)){
			if($request->isMethod('get')){
				$arrRet = [
					'hfsrbannexb' => DB::table('hfsrbannexb')->where('appid',$appid)->get(),
					// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
					'canAdd' => true,
					'appid' =>$appid
				];
				return view('client1.apply.LTO1.hfsrb.annexb',$arrRet);
			} else if($request->isMethod('post')) {
				if($request->action == 'add'){
					$returnToSender = DB::table('hfsrbannexb')->insert(['equipment' => $request->equipment, 'brandname' => $request->brandname, 'model' => $request->model, 'serial' => $request->serial, 'quantity' => $request->quantity, 'dop' => $request->dop, 'manDate' => $request->manDate, 'appid' => $appid]);
				} else if($request->action == 'edit'){
					$returnToSender = DB::table('hfsrbannexb')
					->where('id',$request->id)->update([
						'equipment' => $request->equipment, 
						'brandname' => $request->brandname, 
						'model' => $request->model, 
						'serial' => $request->serial, 
						'quantity' => $request->quantity, 
						'manDate' => $request->manDate,
						'dop' => $request->dop
					]);
				} else if($request->action == 'delete') {
					$returnToSender = DB::table('hfsrbannexb')->where('id',$request->id)->delete();
				}
				return ($returnToSender > 0 ? "DONE" : "ERROR");
			}
		} else {
			return redirect('client1/home')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Please try again later.']);
		}
	}
	public function annexc(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexcd' => DB::table('hfsrbannexc')->where('appid',$appid)->get(),
				// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
				'canAdd' => true
			];
			return view('client1.apply.LTO1.hfsrb.annexcd',$arrRet);
		} else if($request->isMethod('post')) {
			if($request->action == 'add'){
				$returnToSender = DB::table('hfsrbannexc')->insert(['testmethod' => $request->testmethod, 'equipment' => $request->equipment, 'reagent' => $request->reagent, 'materials' => $request->materials,'appid' => $appid]);
			} else if($request->action == 'edit'){
				$returnToSender = DB::table('hfsrbannexc')
				->where('id',$request->id)->update([
					'testmethod' => $request->testmethod, 
					'equipment' => $request->equipment,
					'reagent' => $request->reagent, 
					'materials' => $request->materials, 
				]);
			} else if($request->action == 'delete') {
				$returnToSender = DB::table('hfsrbannexc')->where('id',$request->id)->delete();
			}
			return ($returnToSender > 0 ? "DONE" : "ERROR");
		}
	}
	public function annexd(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexcd' => DB::table('hfsrbannexd')->where('appid',$appid)->get(),
				// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
				'canAdd' => true
			];
			return view('client1.apply.LTO1.hfsrb.annexcd',$arrRet);
		} else if($request->isMethod('post')) {
			if($request->action == 'add'){
				$returnToSender = DB::table('hfsrbannexd')->insert(['testmethod' => $request->testmethod, 'equipment' => $request->equipment, 'reagent' => $request->reagent, 'materials' => $request->materials,'appid' => $appid]);
			} else if($request->action == 'edit'){
				$returnToSender = DB::table('hfsrbannexd')
				->where('id',$request->id)->update([
					'testmethod' => $request->testmethod, 
					'equipment' => $request->equipment,
					'reagent' => $request->reagent, 
					'materials' => $request->materials, 
				]);
			} else if($request->action == 'delete') {
				$returnToSender = DB::table('hfsrbannexd')->where('id',$request->id)->delete();
			}
			return ($returnToSender > 0 ? "DONE" : "ERROR");
		}
	}
	public function annexf(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexf' => DB::table('hfsrbannexf')->where('appid',$appid)->get(),
				// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
				'canAdd' => true
			];
			return view('client1.apply.LTO1.hfsrb.annexf',$arrRet);
		} else if($request->isMethod('post')) {
			if($request->action == 'add'){
				$returnToSender = DB::table('hfsrbannexf')->insert([
					$request->department => 1, 
					'fpcr' => $request->fpcr, 
					'dpbr' => $request->dpbr, 
					'dohcert' => $request->dohcert, 
					'fpccp' => $request->fpccp,
					'trained' => $request->trained,
					'fpros' => $request->fpros,
					'rxt' => $request->rxt,
					'rrt' => $request->rrt,
					'rso' => $request->rso,
					'others' => $request->others,
					'prcno' => $request->prcno,
					'validity' => $request->validity,
					'appid' => $appid
				]);
			} else if($request->action == 'edit'){
				$returnToSender = DB::table('hfsrbannexf')
				->where('id',$request->id)->update([
					'testmethod' => $request->testmethod, 
					'equipment' => $request->equipment,
					'reagent' => $request->reagent, 
					'materials' => $request->materials, 
				]);
			} else if($request->action == 'delete') {
				$returnToSender = DB::table('hfsrbannexf')->where('id',$request->id)->delete();
			}
			return ($returnToSender > 0 ? "DONE" : "ERROR");
		}
	}
	public function annexh(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexh' => DB::table('hfsrbannexh')->where('appid',$appid)->get(),
				// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
				'canAdd' => true
			];
			return view('client1.apply.LTO1.hfsrb.annexh',$arrRet);
		} else if($request->isMethod('post')) {
			if($request->action == 'add'){
				$returnToSender = DB::table('hfsrbannexh')->insert([
					'brandname' => $request->brandname, 
					'model' => $request->model, 
					'serialno' => $request->serialno, 
					'quantity' => $request->quantity, 
					'dop' => $request->dop, 
					'labmaterials' => $request->labmaterials, 
					'appid' => $appid]);
			} else if($request->action == 'edit'){
				$returnToSender = DB::table('hfsrbannexh')
				->where('id',$request->id)->update([
					'brandname' => $request->brandname, 
					'model' => $request->model,
					'serialno' => $request->serialno, 
					'quantity' => $request->quantity, 
					'dop' => $request->dop, 
					'labmaterials' => $request->labmaterials
				]);
			} else if($request->action == 'delete') {
				$returnToSender = DB::table('hfsrbannexh')->where('id',$request->id)->delete();
			}
			return ($returnToSender > 0 ? "DONE" : "ERROR");
		}
	}
	public function annexi(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexi' => DB::table('hfsrbannexi')->where('appid',$appid)->get(),
				// 'canAdd' => DB::table('appform')->where([['appid',$appid],['isReadyForInspec',0]])->exists()
				'canAdd' => true
			];
			return view('client1.apply.LTO1.hfsrb.annexi',$arrRet);
		} else if($request->isMethod('post')) {
			if($request->action == 'add'){
				$returnToSender = DB::table('hfsrbannexi')->insert([
					'test' => $request->test, 
					'kittype' => $request->kittype, 
					'kit' => $request->kit, 
					'lotno' => $request->lotno, 
					'appid' => $appid]);
			} else if($request->action == 'edit'){
				$returnToSender = DB::table('hfsrbannexi')
				->where('id',$request->id)->update([
					'test' => $request->test, 
					'kittype' => $request->kittype,
					'kit' => $request->kit, 
					'lotno' => $request->lotno,
				]);
			} else if($request->action == 'delete') {
				$returnToSender = DB::table('hfsrbannexi')->where('id',$request->id)->delete();
			}
			return ($returnToSender > 0 ? "DONE" : "ERROR");
		}
	}

	public function monitoringCompliance($actid){


	}

	public function sendActionTaken(Request $request, $from, $actid){
		try {

			$violationMonRemarks = $violationDetails = array();
			$vio = $reco = $subreco = $otherDet = null;
			$allowedFrom = ['mon','surv','fdamonitoring'];
			$from = strtolower($from);
			if(in_array($from, $allowedFrom)){
				switch ($from) {
					case 'mon':
						$table = 'mon_form';
						$field = 'monid';
						$teamField = 'team';
						$teamTable = 'mon_team_members';
						$teamPK = 'montid';
						$attachmentFromLo = 'attached_files';
						$attachmentToLo = 'attached_filesUser';
						break;
					case 'surv':
						$table = 'surv_form';
						$field = 'survid';
						$teamField = 'team';
						$teamTable = 'surv_team_members';
						$teamPK = 'montid';
						$attachmentFromLo = 'LOAttachments';
						$attachmentToLo = 'attachments';
						break;
					case 'fdamonitoring':
						$table = 'fdamonitoring';
						$field = 'fdamon';
						$teamField = 'team';
						$attachmentFromLo = null;
						$attachmentToLo = null;
						break;
				}
				$exp = DB::table($table)->where($field,$actid)->first();
				if(empty($exp)){
					return redirect('client1')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'No Records found']);
				}
				if($from == 'mon'){
					$violationMon = DB::table('assessmentcombinedduplicate')->where([['monid',$actid],['selfassess',null]])->whereNotIn('evaluation',[1,'NA'])->get();
					foreach ($violationMon as $key) {
						
						array_push($violationDetails,(isset($key->assessmentName) ? $key->assessmentName : 'No Details Provided'));
						array_push($violationMonRemarks,(isset($key->remarks) ? $key->remarks : 'No Details Provided'));
					}
					$vio = array_combine($violationDetails,$violationMonRemarks);
					$otherDet = DB::table('technicalfindingshist')->where([['id',$actid],['fromWhere', 'mon']])->get();
					$reco = $exp->verdict;
				}
				if($from == 'fdamonitoring'){
					$toFilter = DB::table('fdamonitoringfiles')->where([['fdaMonId',$actid]])->orderBy('addedTimeDate','DESC')->get();
					foreach ($toFilter as $key => $value) {
						if($value->isReply != null){
							$vio['fromUser'][] = $value;
						} else {
							$vio['fromPO'] = $value;
						}
					}
				}
				if($from == 'surv'){
					$otherDet = DB::table('technicalfindingshist')->where([['id',$actid],['fromWhere', 'surv']])->get();
					$reco = DB::table('surv_rec')->where('rec_id',$exp->recommendation)->first();
					if(isset($reco)){
						switch ($reco->rec_id) {
							case 2:
								$subreco = 'payment';
								break;
							case 3:
								$subreco = 'suspension';
								break;
							case 5:
								$subreco = 's_rec_others';
								break;
						}
						$reco = array_combine(array($reco->rec_desc), array(isset($subreco) ? $exp->$subreco : null));
					}
				}
			} else {
				return redirect('client1')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'No Records found']);
			}
			if($request->isMethod('get')){
				return view('client1.reported',['data' => $exp, 'from' => $from, 'LO' => $attachmentFromLo, 'user' => $attachmentToLo, 'vio' => $vio, 'reco' => $reco, 'extraDetails' => $otherDet]);
			} else if($request->isMethod('post')){
				$images = null;
				if($request->has('images')){
					$images = array();
					foreach ($request->file('images') as $key) {
						$imageRec = FunctionsClientController::uploadFile($key);
						array_push($images,$imageRec['fileNameToStore']);
					}
				}
				switch ($from) {
					case 'mon':
						
					case 'surv':
						// $test = DB::table($table)->where($field,$actid)->update(['hasLOE' => 1, 'LOE' => $request->exp, $attachmentToLo => (is_array($images) ? implode(',',$images): null )]);
						if($request->has('images')){
							$test = DB::table($table)->where($field,$actid)->update(['hasLOE' => 1, ($from == 'mon' ? 'explanation' : 'LOE') => $request->exp, $attachmentToLo => (is_array($images) ? implode(',',$images): null ), 'forResubmit' => null]);
							$forNotify = DB::table($table)->where($field,$actid)->first();
							if(isset($forNotify)){
								$notifyPersons = DB::table($teamTable)->where($teamPK,$forNotify->$teamField)->get();
								if(isset($notifyPersons)){
									foreach ($notifyPersons as $key => $value) {
										AjaxController::notifyClient($actid,$value->uid,($from == 'mon' ? 66: 67));
									}
									
								}
							}
						} else {
							$test = DB::table($table)->where($field,$actid)->update(['hasLOE' => 1, 'LOE' => $request->exp]);
						}
						break;
					case 'fdamonitoring':
						$test = DB::table($table)->where($field,$actid)->update(['hasReplyFlag' => 1]);
						if($test){
							$test = DB::table('fdamonitoringfiles')->insert(['addedBy' => (session()->get('uData')->uid ?? 'SYSTEM'), 'remark' => $request->exp, 'fdaMonId' => $actid, 'isReply' => 1, 'fileName' => (is_array($images) ? implode(',',$images): null )]);
							$POUdet = DB::table('fdamonitoring')->where('fdamon',$actid)->select('addedBy','type')->first();
							AjaxController::notifyClient($actid,$POUdet->addedBy,($POUdet->type == 'machines' ? 61: 62),$POUdet->type);
						}
					break;
				}
				return $test ? 'done' : $test;
			}
		} catch (Exception $e) {
			return $e;
			return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on action Taken. Contact the admin']);
		}
	}

	// view sched
	public function viewInsSched(Request $request, $appid){
		try {
			if(session()->has('uData')){
				$supData = FunctionsClientController::getUserDetailsByAppform($appid)[0];
				if($supData->uid == session()->get('uData')->uid && isset($supData->proposedWeek)){
					$inspectors = DB::table('app_team')->join('x08','x08.uid','app_team.uid')->where('app_team.appid',$appid)->get();
					return view('client1.insSched',['data' => $supData, 'inspectors' => $inspectors]);
				}
				return redirect('client1')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'Record does not exist.']);
			}
			return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on View Sched module. Contact the admin']);
		} catch (Exception $e) {
			return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on View Sched module. Contact the admin']);
		}
	}

	// end hfsrb requirements
	//hfsrb view requirements
	public function viewannexa(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexa' => DB::table('hfsrbannexa')->leftJoin('pwork_status','pwork_status.pworksid','hfsrbannexa.employement')->leftJoin('position','position.posid','hfsrbannexa.prof')->where('appid',$appid)->get(),
			];
			return view('client1.apply.LTO1.hfsrbView.annexa',$arrRet);
		} else {
			if(isset($request->appid)){
				$imploded = implode("','", $request->appid);
				return DB::select("SELECT facilityname,appid from appform where appid in ($imploded)");
			}
		}
	}
	public function viewannexb(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexb' => DB::table('hfsrbannexb')->where('appid',$appid)->get()
			];
			return view('client1.apply.LTO1.hfsrbView.annexb',$arrRet);
		} else {
			if(isset($request->appid)){
				$imploded = implode("','", $request->appid);
				return DB::select("SELECT facilityname,appid from appform where appid in ($imploded)");
			}
		}
	}
	public function viewannexd(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexcd' => DB::table('hfsrbannexd')->where('appid',$appid)->get()
			];
			return view('client1.apply.LTO1.hfsrbView.annexcd',$arrRet);
		}
	}
	public function viewannexc(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexcd' => DB::table('hfsrbannexc')->where('appid',$appid)->get()
			];
			return view('client1.apply.LTO1.hfsrbView.annexcd',$arrRet);
		}
	}
	public function viewannexf(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexf' => DB::table('hfsrbannexf')->where('appid',$appid)->get()
			];
			return view('client1.apply.LTO1.hfsrbView.annexf',$arrRet);
		}
	}
	public function viewannexh(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexh' => DB::table('hfsrbannexh')->where('appid',$appid)->get()
			];
			return view('client1.apply.LTO1.hfsrbView.annexh',$arrRet);
		}
	}
	public function viewannexi(Request $request, $appid){

		if($request->isMethod('get')){
			$arrRet = [
				'hfsrbannexi' => DB::table('hfsrbannexi')->where('appid',$appid)->get()
			];
			return view('client1.apply.LTO1.hfsrbView.annexi',$arrRet);
		}
	}
	// end view hfsrb requirements
	public function assessmentReady(Request $request, $appid)
	{
		$curForm = FunctionsClientController::getUserDetailsByAppform($appid);
		
		if(count($curForm) < 1) {
			return redirect('client1/apply')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'No application selected.']);
		}
		try {
			$dohC = new DOHController();
			// $toViewArr = $dohC->AssessmentShowPartClientAss($request,$appid,false,true);
			$toViewArr = $dohC->AssessmentShowPart($request,$appid,false,true);
			// $toViewArr['appform'] = DB::table('appform')->where('appid', $appid)->first();
			// $toViewArr['appform'] = $curForm[0];
			//dd($toViewArr);
			return view('client1.assessment.assessmentView',$toViewArr);
		} catch (Exception $e) {
			return $e;
		}
	}

	public function assessmentHeaderOne(Request $request, $appid, $part)
	{
		try {
			$dohC = new DOHController();
			$toViewArr = $dohC->AssessmentShowH1($request,$appid,$part,false,true);
			if($toViewArr){
				$toViewArr['headon'] = true;
				$toViewArr['parts'] = $part;
				return view('client1.assessment.assessmentView',$toViewArr);
			}
			return redirect('client1/apply/assessmentReady/'.$appid)->with('errRet', ['errAlt'=>'Part does not exist.']);
		} catch (Exception $e) {
			return $e;
		}
	}

	public function AssessmentShowH2(Request $request, $appid, $h1)
	{
		try {
			$dohC = new DOHController();
			$toViewArr = $dohC->AssessmentShowH2($request,$appid,$h1,false,true);
			if($toViewArr){
				return view('client1.assessment.assessmentView',$toViewArr);
			}
			return redirect('client1/apply/assessmentReady/'.$appid)->with('errRet', ['errAlt'=>'Header does not exist.']);
		} catch (Exception $e) {
			return $e;
		}
	}

	public function AssessmentShowH3(Request $request, $appid, $h2)
	{
		try {
			$dohC = new DOHController();
			$toViewArr = $dohC->AssessmentShowH3($request,$appid,$h2,false,true);
			if($toViewArr){
				return view('client1.assessment.assessmentView',$toViewArr);
			}
			return redirect('client1/apply/assessmentReady/'.$appid)->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Area does not exist.']);
		} catch (Exception $e) {
			return $e;
		}
	}

	public function ShowAssessments(Request $request, $appid, $h3)
	{
		try {
			$dohC = new DOHController();
			$toViewArr = $dohC->ShowAssessments($request,$appid,$h3,false,true);
			if($toViewArr){
				return view('client1.assessment.assessmentAnswer',$toViewArr);
			}
			return redirect('client1/apply/assessmentReady/'.$appid)->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Sub Category does not exist or has been assessed.']);
		} catch (Exception $e) {
			return $e;
		}
	}

	public function SaveAssessments(Request $request)
	{
		try {
			$dohC = new DOHController();
			$toViewArr = $dohC->SaveAssessments($request,true);
			if($toViewArr){
				return view('client1.assessment.assessmentSuccess',$toViewArr);
			}
			return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Item not found on DB..']);
		} catch (Exception $e) {
			return $e;
		}
	}

	public function assessmentRegister(Request $request)
	{
		return json_encode(AjaxController::logAssessed($request->level,$request->appid,$request->id,null,1)); 
	}

	public function GenerateReportAssessment(Request $request, $appid)
	{
		try {
			$dohC = new DOHController();
			$toViewArr = $dohC->GenerateReportAssessment($request,$appid,null,1);
			$app = DB::table('appform')->where('appid',$appid)->first();
			if($toViewArr){
				$toViewArr['appid'] = $appid;
				$toViewArr['hfser_id'] = $app->hfser_id;
				$toViewArr['aptid'] = $app->aptid;
				return view('client1.assessment.assessmentGeneratedClient',$toViewArr);
			}
			return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Assessment records not found.']);
		} catch (Exception $e) {
			return $e;
		}
	}



	public function assessmentView(Request $request, $appid, $apptype, $choosen, $otherApplication = false)
	{		
		$charCombined = $checkExistMon = $currentUser = null;
		$appidReal = $appid;
		$applyType = 'license';
		$origChoosen = $choosen;
		$choosen = (strtoupper($choosen) !== 'OTHERS'? ['asmt2_loc.header_lvl1',$choosen] : ['asmt2_loc.asmt2l_id','<>',null]);
		$firstLevel = array();
		if ($request->isMethod('get')) 
		{
			if(strtolower($apptype) !== 'mon' && strtolower($apptype) !== 'surv'){
				$whereClause = [['x08_ft.appid','=',$appid],['serv_asmt.hfser_id', '=',$apptype], $choosen];
				$appformFetch = DB::table('appform')->where('appid',$appid)->select('uid','hfser_id','aptid')->get()->first();
				if(!empty($appformFetch)){
					$charCombined = $appformFetch->uid.'_'.$appformFetch->hfser_id.'_'.$appformFetch->aptid.'_'.$appidReal;
					if(DB::table('app_assessment')->where('appid',$charCombined)->count() > 0 || $appformFetch->hfser_id != $apptype){
						// return redirect('employee/dashboard/processflow/assessment/view/'.$appid.'/'.$apptype);
						// dd('Redirecting you to page');
					}
				} else {
					return response()->back();
					dd('Wrong appid');
				}
			} 
			try 
			{
				$asmt2_col = $asmt2_loc = $levelFirst = array();
				$joinedData = null;
				$allAccess = $filenames = array();
				$countColoumn = DB::SELECT("SELECT count(*) as 'all' FROM information_schema.columns WHERE table_name = 'asmt2'")[0]->all -1;
				// $currentUser = AjaxController::getCurrentUserAllData()['position'];
				$joinedData = FunctionsClientController::getAllAssessment($whereClause);	            // if(!empty($headersFromDB)){
				// dd($joinedData);
	            if(strtolower($origChoosen) === 'others'){
	            	$joinedData->whereNull('asmt2_loc.header_lvl1');
	            }
	            $joinedData = json_decode($joinedData->get(),true);
	            // dd($joinedData);
	            foreach ($joinedData as $data) {
		            if($countColoumn){
		            	for ($i=1; $i <= $countColoumn ; $i++) {
							$actualHeader = 'header_lvl'.$i;
							if($data['srvasmt_col'] !== null){
								foreach (json_decode($data['srvasmt_col']) as $json) {
								 	if(!in_array($json, $asmt2_col)){
								 		array_push($asmt2_col, $json);
								 	}
								 }
							}
							if(Schema::hasColumn('asmt2_loc', $actualHeader))
							{
								if($data[$actualHeader] !== NULL){
									if(!in_array($data[$actualHeader], $asmt2_loc)){
										array_push($asmt2_loc, $data[$actualHeader]);
									}
								}
							}
		            	}
		            }
					if(!empty($data['filename'])){
						if(!in_array($data['filename'], $filenames)){
							array_push($filenames, $data['filename']);
						}
					}
				}
	            ////////////fetch data from DB
	            foreach ($asmt2_col as $colValue) {
	            	$dataAll = DB::table('asmt2_col')->where('asmt2c_id' , '=', $colValue)->select('asmt2c_desc','asmt2c_type')->get()->first();
	            	$joinedData[$colValue.'Desc'] = $dataAll->asmt2c_desc;
	            	$joinedData[$colValue.'Type'] = $dataAll->asmt2c_type;
	            	$dataAll = null;
	            }
	            foreach ($asmt2_loc as $locData) {
	            	$dataAll = DB::table('asmt2_loc')->where('asmt2l_id' , '=', $locData)->select('asmt2l_desc')->get()->first();
	            	$joinedData[$locData.'Desc'] = $dataAll->asmt2l_desc;
	            	$dataAll = null;
				}
				$data = AjaxController::getAllDataEvaluateOne($appid);
				$SELECTED = $data->uid.'_'.$data->hfser_id.'_'.$data->aptid.'_'.$appidReal;
				// dd($joinedData);
				return view('client1.assessment.assessmentAnswer', ['AppData'=>$data, 'appId'=> $appidReal, 'joinedData'=>$joinedData, 'apptype' => $apptype, 'filenames'=>$filenames, 'monType'=>$applyType, 'header'=>$origChoosen,'org'=>$SELECTED/*, 'assessor' => $currentUser*/]);	
			} 
			catch (Exception $e) 
			{
				dd($e);
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pfassessmentone');	
			}
		}
		if ($request->isMethod('post')) 
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				// 	chckOrNot [] , rmks [], num, AsId [], id, SeldID [],
				// $Gas = DB::table('app_assessment')->where('appid', '=', $request->id)->first();
				$X = 0;
				for ($i=0; $i < $request->num; $i++) { 
					$test = DB::table('app_assessment')
							->where('app_assess_id', '=', $request->SeldID[$i])
							->update([
								'isapproved' => $request->chckOrNot[$i],
								'remarks' => $request->rmks[$i],
								't_date' => $Cur_useData['date'],
								't_time' => $Cur_useData['time'],
								'assessedby' => $Cur_useData['cur_user'],
								// 'uid' => $Cur_useData['cur_user']
							]);
					}
					if ($request->hasNotApproved == 0) {$Stat = 'FR';$x = 1;} 
					else { $Stat = 'RI';$x = 0;}
					$update = array(
									'status'=>$Stat,
									'isInspected'=> $x,
									'inspecteddate'=> $Cur_useData['date'],
									'inspectedtime'=> $Cur_useData['time'],
									'inspectedipaddr'=> $Cur_useData['ip'],
									'inspectedby'=> $Cur_useData['cur_user'],
								);
					$test = DB::table('appform')->where('appid', '=', $request->id)->update($update);
					$selected = AjaxController::getUidFrom($request->id);
					AjaxController::notifyClient($selected, 4);
					if ($test) {
						return 'DONE';
					} else {
						$TestError = $this->SystemLogs('No data has been modfied in appform table. (AssessmentOneProcessFlow)');
						return 'ERROR';
					}
					return $request->hasApproved;	
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				return 'ERROR';
			}
		}
	}
	public function AssessmentSend(Request $request, $appid, $apptype, $otherApplication = false)
	{
		$dataToView = $charCompiled = $toDir = $jsonToArray = $noCharCompiled = $selfAssessmentCheck = $jsonToDB = $appform = $table = $selectFromDB = $whereClause = $recordsToCheck = $tableToUpdate = $slug = $fieldsOnUpdate = $allUserDetails = $checkExistMon = $currentAssessment = $storedAssessment = $merged = $checkForStatus = $urlToRedirect = $tableNames = null;
		
		try 
		{
			($request->isMobile === "true" && $this->agent ? self::sessionForMobile($request->uid) : null);
			$allUserDetails = AjaxController::getCurrentUserAllData();
			$exceptData = array('_token','appID','facilityname','monType','org','header');
			if(strtolower($apptype) !== 'mon' && strtolower($apptype) !== 'surv'){//licensing
				$tableNames = 'appform';
				$urlToRedirect = asset('client1/apply/assessmentReady/'.$appid.'/'.$apptype);
				$selectFromDB = array('selfAssessment');
				if(DB::table('appform')->where('appid',$appid)->count() < 1){
					// return redirect('employee/dashboard/processflow/assessment/');
					dd('redirecting you to page');
				}
				if(!empty($request->all())){
					$charCompiled = $request->org;
				} else {
					$noCharCompiled = DB::table('appform')->where('appid',$appid)->select('uid','hfser_id','aptid')->get()->first();
					$charCompiled = $noCharCompiled->uid.'_'.$noCharCompiled->hfser_id.'_'.$noCharCompiled->aptid.'_'.$appid;
				}
				$table = 'app_assessment';
				$whereClause = 'appid';
				$fieldsOnUpdate = array(
					'isInspected'=>1,
					'inspecteddate'=>$allUserDetails['date'],
					'inspectedtime'=>$allUserDetails['time'],
					'inspectedipaddr'=>$allUserDetails['ip'],
					'inspectedby'=>$allUserDetails['cur_user']
				);
			}
			$dataToView = DB::table($table)->where($whereClause,$charCompiled)->select($selectFromDB)->get()->first();
			$selectFromDB = implode('', $selectFromDB);
			if(empty($dataToView->$selectFromDB)){
				if(!empty($request->all())){
					$recordsToCheck = $request->all();
					$slug = in_array('false',$recordsToCheck,true);
					if($slug && strtolower($apptype) !== 'mon'){	
						DB::table($tableNames)
						->where($whereClause,$appid)							
						->update($fieldsOnUpdate);
					}
					$jsonToDB = json_encode(array($request->header => $request->except($exceptData)));
					if(DB::table($table)->where($whereClause,$charCompiled)->count() <= 0 ){
						DB::table($table)->insert([
						    ['appid' => $charCompiled,'t_date' => Carbon::now(),'t_time' => Carbon::now()->toTimeString(),'selfAssessment' => $jsonToDB]
							]);
					} else {
						DB::table($table)->update([
					    	'selfAssessment' => $jsonToDB
						]);
					}	
					$dataToView = json_encode($request->except($exceptData));
				} else {
					// return view('client1.assessment.assessmentSuccess', ['redirectTo' => $urlToRedirect]);
					// return redirect('employee/dashboard/processflow/assessment');
					return response()->back();
				}
			} else {
				// $checkForStatus = (is_null(DB::table($table)->where($whereClause,$charCompiled)->select('assessmentStatus')->get()->first()) ? null : DB::table($table)->where($whereClause,$charCompiled)->select('assessmentStatus')->get()->first()->assessmentStatus); //do not make hilabot
				$dataToView = $dataToView->$selectFromDB;
				// if($checkForStatus  === 0){
					if(!empty($request->all())){
						$storedAssessment = json_decode($dataToView,true);
						$currentAssessment = array($request->header => $request->except($exceptData));
						if(!array_key_exists($request->header,$storedAssessment)){
							$merged = json_encode(array_merge($currentAssessment,$storedAssessment));
							DB::table($table)
								->where($whereClause,$charCompiled)							
								->update([$selectFromDB => $merged]);
						} /*else {
							return view('employee/assessment/operationSucess');
						}*/
					} else {
						return response()->back();
					} /*else {
						return redirect('employee/dashboard/processflow/assessment/view/'.$appid.'/'.$apptype.'/'.$otherApplication);
						dd('Redirecting you to page');
					}*/
				// } elseif($checkForStatus === 1) { // FOR POSSIBLE CHANGES ONLY. PLEASE DON'T MAKE HILABOT
					// dd('Unknown Error occured. Please try again later.');
				// }
			}
			return view('client1.assessment.assessmentSuccess', ['redirectTo' => $urlToRedirect]);
			// $dataToView = json_decode($dataToView,true);
			// $toDir = explode(',',$dataToView['filename']);
			// unset($dataToView['filename']);
			// unset($dataToView['header']);
			// $appform = DB::table('appform')->where('appid',$appid)->get()->first();
			// return view('employee.processflow.pfassessmentoneview',['data' => json_encode($dataToView),'file'=>$toDir,'selfCheck'=>$selfAssessmentCheck, 'appform' => $appform]);
		} 
		catch (Exception $e) 
		{
			dd($e);
			AjaxController::SystemLogs($e);
			session()->flash('system_error','ERROR');
			return view('employee.processflow.pfassessmentoneview');
		}
	}
	public function AssessmentDisplay(Request $request, $appid, $apptype)
	{
		$charCompiled = $noCharCompiled = $appform = $table = $selectFromDB = $whereClause = $fieldsOnUpdate = $checkExistMon = $checkStatus = $checkForStatus = $compliedToString = $dataFromDB = $mergedData = $unsortedData = $isEmptyAssess = $checkInspected = $currentTask = null;
		$assessor = $filenames = $listofSelfAssessment = array();
		$exceptData = array('_token','appID','facilityname','monType','org','header','assessor');
		$allUserDetails = AjaxController::getCurrentUserAllData();
		$fieldsOnUpdate = array('assessmentStatus' => 1);
		if(strtolower($apptype) !== 'mon' && strtolower($apptype) !== 'surv'){//licensing
			$selectFromDB = array('selfAssessment');
			if(DB::table('appform')->where('appid',$appid)->count() < 1){
				return redirect('employee/dashboard/processflow/assessment/');
				dd('redirecting you to page');
			}	
			// if(!empty($request->all())){
			// 	$charCompiled = $request->org;
			// } else {
				$noCharCompiled = DB::table('appform')->where('appid',$appid)->select('uid','hfser_id','aptid')->get()->first();
				$charCompiled = $noCharCompiled->uid.'_'.$noCharCompiled->hfser_id.'_'.$noCharCompiled->aptid.'_'.$appid;
			// }
			$table = 'app_assessment';
			$whereClause = 'appid';
		}
		$selectFromDBRaw = $selectFromDB[0];
		$isEmptyAssess = empty(DB::table($table)->where($whereClause,$charCompiled)->get()->first()->$selectFromDBRaw);
		
		if(!$isEmptyAssess){
			$compliedToString = $selectFromDB[0];
			$checkForStatus = (is_null(DB::table($table)->where($whereClause,$charCompiled)->select($selectFromDB)->get()->first()) ? null : DB::table($table)->where($whereClause,$charCompiled)->select($selectFromDB)->get()->first()->$compliedToString);
			$dataFromDB = json_decode($checkForStatus,true);
			foreach ($dataFromDB as $key => $value) {
				if(array_key_exists('assessor',$value)){
					if(!in_array($value['assessor'], $assessor)){
						array_push($assessor, $value['assessor']);
						unset($dataFromDB[$key]['assessor']);
					}
				}
				if(array_key_exists('filename', $value)){
					if(!in_array($value['filename'], $filenames)){
						array_push($filenames, $value['filename']);
						unset($dataFromDB[$key]['filename']);
					}
				}
			}
			$unsortedData = call_user_func_array("array_merge", $dataFromDB);
			$testArray = array();
			foreach ($unsortedData as $key => $value) {
				$stringToFind = '/headCode';
				if($key !== 'filename'){
					$string = $key;
					$findSeq = strpos($string,$stringToFind);
					$part = null;
					if($findSeq !== false) {
						$findSeq +=strlen($stringToFind);
						while(substr($string,$findSeq,1) !== '/'){
							$part = $part.substr($string,$findSeq,1);
							$findSeq +=1;
						}
						$testArray[$part][$key] = $value;
						$findSeq = $part = null;
					}
				}
			}
			$testFinalArray = array();
			// $testArray['filename'] = array($unsortedData['filename']);
			$sortArray = array(); 
			foreach ($testArray as $key => $value) {
				$testHere = $testArray[$key];
				ksort($testHere,SORT_NATURAL);
				array_push($testFinalArray, $testHere);
			}
			$tryLng = call_user_func_array("array_merge", $testFinalArray);
			// $tryLng['filename'] = $tryLng[0];
			// unset($tryLng[0]);
			$dataToView = $tryLng;
			if(strtolower($apptype) !== 'mon' && strtolower($apptype) !== 'surv'){
				$checkInspected = DB::table('appform')->where($whereClause,$appid)->select('isInspected')->first()->isInspected;
				if($checkInspected <=0 ){
					$valueToUpdate = 1;
					if(in_array('false',$dataToView,true)){
						$valueToUpdate = 2;
					}
					DB::table('appform')->where($whereClause,$appid)->update([
						'isInspected'=>$valueToUpdate,
						'inspecteddate'=>Date('Y-m-d'),
						'inspectedtime'=>Date('H:i:s',strtotime('now')),
						'inspectedipaddr'=>$request->ip(),
						'inspectedby'=>session()->get('uData')->uid
					]);
				}
			}
			$currentTask = 'Self Assessment';
			$listofSelfAssessment = ['LTO'];
			if(!in_array($apptype,$listofSelfAssessment)){
				$currentTask = 'Checklist';
			}
			$toDir = $filenames;
			return view('client1/assessment/assessmentDisplay',['data' => json_encode($dataToView),'file'=>$toDir, 'assessor' => $assessor, 'currentTask' => $currentTask]);
		} else {
			return redirect('client1/apply');
		}
	}
	//extra
	//extra
	//extra
	//extra extra
	public static function __rToken(Request $request, $token) {
		try {
			if($request->isMethod('get')) {
				$chkQry = DB::table('x08')->where('token', $token)->select('*')->first();
				//dd($chkQry);
				if($chkQry != null) {
					DB::table('x08')->where('token', $token)->update(['token'=>NULL]);
					return redirect('client1')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Successfully verified account.']);
				} else {
					return redirect('client1')->with('errRet', ['errAlt'=>'warning', 'errMsg'=>'Error on verifying account. Token must be expired.']);
				}
			} else {
				return redirect('client1');
			}
		} catch (Exception $e) {
			return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'An error has occured in verifying token.']);
		}
	}
	//redirection to client page
	public static function __rToken1(Request $request) {
		try {
			return redirect('/')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Successfully verified account.']);
		} catch (Exception $e) {
			return redirect('/')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'An error has occured in verifying token.']);
		}
	}
	
	public static function __rMail(Request $request, $uid) {
		try {
			if($request->isMethod('get')) {
				$nToken = Str::random(40);
				$chkQry = DB::table('x08')->where('uid', $uid)->select('*')->first();
				// dd($chkQry);
				if($chkQry != null) {
					$dRequest =new \stdClass();
					$dRequest->text2 = $chkQry->nameofcompany; 
					$dRequest->text6 = $chkQry->email;
					$sData = ['name'=>$chkQry->nameofcompany, 'authorizedsignature'=>$chkQry->authorizedsignature, 'assign'=>$chkQry->assign, 'password'=>NULL, 'token'=>$nToken];

					
					if(DB::table('x08')->where('uid', $uid)->update(['token'=>$nToken])) { //true
						if(FunctionsClientController::sMailVerRetBool('client1.mail', $sData, $dRequest)) {
							return redirect('client1')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Successfully sent verification to your account.']);
						}
						return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on sending verfication email.']);
					}
					return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error on updating verification account.']);
				}
				return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'No user selected.']);
			} else {
				// return redirect()->route('client1.login');
			}
		} catch (Exception $e) {
			return redirect('client1')->with(['errAlt'=>'danger', 'errMsg'=>'An error has occured.']);
		}
	}

	public function __rTbl(Request $request, $tbl) {
		try {
			if($request->isMethod('get')) {
				$toReturn = DB::table($tbl)->select('*');
				if($tbl == 'barangay'){
					$toReturn->orderBy('brgyname','ASC');
				}
				return json_encode($toReturn->get());
			} else {
				$_WHERE = []; $_rTable = []; $_rCol = "";
				if(isset($request->rTbl) && isset($request->rId)) {
					if(is_array($request->rTbl) && is_array($request->rId)) {
						if(count($request->rTbl) == count($request->rId)) {
							for($i = 0; $i < count($request->rTbl); $i++) {
								array_push($_WHERE, [$request->rTbl[$i], $request->rId[$i]]);
							}
						} else {
							return json_encode(["not equal count"]);
						}
					} elseif(is_array($request->rId)) {
						$_rCol = $request->rTbl;
						foreach($request->rId AS $rIdRow) {
							array_push($_WHERE, ((isset($request->rFunc)) ? $rIdRow : [$request->rTbl, $rIdRow]));
						}
					} else {
						array_push($_WHERE, [$request->rTbl, $request->rId]);
					}
				}
				if(count($_WHERE) > 0) {
					if(isset($request->rFunc)) {
						$_rTable = DB::table($tbl)->whereIn($_rCol, $_WHERE)->select('*')->get();
					} else {
						$_rTable = DB::table($tbl)->where($_WHERE)->select('*')->get();
					}
				} else {
					$_rTable = DB::table($tbl)->select('*')->get();
				}
				return json_encode($_rTable);
			}
		} catch (Exception $e) {
			return json_encode($e);
		}
	}
	
	public function __customQuery(Request $request, $custom) {
		// try {
			$notify = false;
			if(isset($custom)) {
				if($request->isMethod('get')) {
					switch($custom) {
						case 'assessment':
							
							break;
						case 'logoutUser':
							session()->forget('uData'); 
							session()->forget('payment');
							session()->forget('appcharge');
							session()->forget('ambcharge');
							session()->forget('directorSettings');
							$request->session()->flush(); 
							Cache::flush();
							
							return json_encode(true);
							break;
						case 'checkFile':
							$path = 'ra-idlis/public/js/forall.js';
							if(!File::exists($path)) {
							    return json_encode(false);
							} else {
								return json_encode(true);
							}
							break;
						case 'checkDirectory':
							$path = 'ra-idlis/public/js1';
							if(!File::isDirectory($path)) {
							    return json_encode(false);
							} else {
								return json_encode(true);
							}
							break;
						case 'decodeThis':
							break;
						case 'fGetAppformIdLatest':
							return json_encode(FunctionsClientController::fGetAppformIdLatest(FunctionsClientController::getSessionParamObj("uData", "uid")));
							break;
						case 'fTrySubmitPayment':
							break;
						default:
							return json_encode([]);
							break;
					}
				} else {
					switch($custom) {
						case 'checkUser':
							if(isset($request->_userName) && isset($request->_userPass)) {
								$retThis = FunctionsClientController::procLogin($request->_userName, $request->_userPass);
								return json_encode($retThis);
							} else {
								return json_encode('Please input Username and Password');
							}
							return json_encode('No username and/or password.');
							break;
						case 'fPassword':
							$retArr = ["No email supplied."];
							if(isset($request->_email)) {
								$retThis = FunctionsClientController::fPassword(FunctionsClientController::findColGC('email', $request->_email), $request->_token);
								$retArr = json_encode($retThis);
							}
							return $retArr;
							break;
						case 'oldPass':
							if(isset($request->_oPass) && isset($request->_oUid)) {
								$retThis = FunctionsClientController::findColGC('uid', $request->_oUid);
								if(count($retThis) > 0) {
									$__bool = Hash::check($request->_oPass, $retThis[0]->pwd);
									return json_encode($__bool);
								}
								return json_encode(false);
							}
							return json_encode([]);
							break;
						case 'chgPass':
							if(isset($request->_nPass) && isset($request->_oUid)) { //isset($request->_oPass) && 
								$retThis = FunctionsClientController::findColGC('uid', $request->_oUid);
								if(count($retThis) > 0) {
									$__bool = true; //Hash::check($request->_oPass, $retThis[0]->pwd);
									if($__bool) {
										if(!AjaxController::isPreviousPassword($request->_nPass,$request->_oUid)){

											if(DB::table('x08')->where([['uid', $request->_oUid], ['grpid', 'C']])->update(['pwd'=>Hash::make($request->_nPass), 'lastChangePassDate' => Date('Y-m-d'), 'lastChangePassTime' => Date('H:i:s',strtotime('now'))])) {
												DB::table('pwdHistory')->insert(['uid' => $request->_oUid, 'pwd' => Hash::make($request->_nPass)]);
												return json_encode(true);
											} else {
												json_encode("Error on updating password.");
											}

										} else {
											return json_encode("Please input password that does not exist before.");
										}

									} else {
										return json_encode("Old password does not match.");
									}
								}
								return json_encode("No user found in current user id.");
							}
							return json_encode("Old and new password is not set.");
							break;
						case 'fRegister':
							// qwe
							$rToken = null;
							// $rToken = Str::random(40);
							$nPassword = (strlen($request->pwd) > 3) ? str_repeat('*', (strlen($request->pwd) - 3)) . substr($request->pwd, -3) : "***";
							$arrData = [/*'rgnid', 'province', 'city_muni', 'barangay', 'streetname', 'zipcode', 'street_number',  */'authorizedsignature', 'assign', 'email', 'contact', 'uid', 'pwd', 'nameofcompany']; 
							$arrCheck = [['uid', 'email'], ['uid'=>"Username already taken.", 'email'=>"Email already used. Please use another email."]]; 
							$makeHash = ['pwd']; 
							$haveAdd = ['grpid'=>'C', 'ipaddress'=>request()->ip(), 't_date'=>Carbon::now()->toDateString(), 't_time'=>Carbon::now()->toTimeString(), 'token'=>$rToken]; 
							$fMail = ['client1.mail', ['name'=>strtoupper($request->uid), 'authorizedsignature'=>$request->authorizedsignature, 'assign'=>$request->assign, 'password'=>$nPassword, 'token'=>$rToken], ['authorizedsignature', 'email']]; 
							$validate = [[/*'rgnid', 'province', 'city_muni', 'barangay', */'authorizedsignature', 'assign', 'email', 'contact', 'uid', 'pwd', 'nameofcompany'], [/*'rgnid'=>'No region selected.', 'province'=>'No province selected', 'city_muni'=>'No city/municipality selected', 'barangay'=>'No barangay selected',*/ 'authorizedsignature'=>'Please input name (to be used as owner)', 'assign'=>'Please Provide Position', 'email'=>'Please input email.', 'contact'=>'Please input contact information', 'uid'=>'Please input your username', 'street_number'=>'no street number', 'pwd'=>'Please input your password', 'nameofcompany'=>'Please provide name of company']];
							return json_encode(FunctionsClientController::fInsData($request->all(), $arrData, $arrCheck, $makeHash, $haveAdd, $fMail, $validate, 'x08'));
							break;
						case 'fEmail':
							if(isset($request->_cEmail)) {
								$retThis = FunctionsClientController::findColGC('email', $request->_cEmail);
								if(count($retThis) > 0) {
									return json_encode("Email already used. Please use another email account.");
								}
								return json_encode(true);
							}
							return json_encode("No email.");
							break;
						case 'fUid':
							if(isset($request->_cUid)) {
								$retThis = FunctionsClientController::findColGC('uid', strtoupper($request->_cUid));
								if(count($retThis) > 0) {
									return json_encode("Username already used. Please use another username.");
								}
								return json_encode(true);
							}
							return json_encode("No username.");
							break;
						case 'fApply':
							$arrData = ['hfser_id', 'facilityname', 'owner', 'rgnid', 'provid', 'cmid', 'brgyid', 'contact', 'email', 'uid', 'street_name', 'street_number', 'faxNumber', 'zipcode', 'landline', 'mailingAddress', 'ownerMobile', 'ownerLandline', 'ownerEmail', 'areacode', 'ocid', 'classid', 'subClassid', 'facmode','funcid','approvingauthority','approvingauthoritypos','draft']; 
							$arrCheck = []; $makeHash = []; $haveAdd = ['ipaddress'=>request()->ip(), 't_date'=>Carbon::now()->toDateString(), 't_time'=>Carbon::now()->toTimeString(), 'status'=>'P', 'assignedRgn'=>$request->rgnid]; 
							$fMail = []; 
							$validate = [
								['hfser_id', 'facilityname', 'owner', 'rgnid', 'provid', 'cmid', 'brgyid', 'contact', 'email',/* 'street_name',*/ 'zipcode', 'ownerMobile','ownerEmail','ocid','classid','facmode','funcid','approvingauthority','approvingauthoritypos'], 
								['hfser_id'=>'Please select type of application', 'facilityname'=>'PLease input/select facility name.', 'owner'=>'Please input owner\'s name', 'rgnid'=>'Please select region', 'provid'=>'Please select province', 'cmid'=>'Please select city/municipality', 'brgyid'=>'Please select barangay', 'contact'=>'Please input contact information', 'email'=>'Please input email.'/*, 'street_name'=>'No street name specified.'*/, 'zipcode'=>'No zipcode specified.', 'mailingAddress'=>'No Mailing Address specified.', 'ownerMobile'=>'No Proponent/Owner Mobile Number specified.', 'ownerEmail'=>'No Proponent/Owner Email specified.', 'ocid' => 'Please provide Ownership details.', 'classid' => 'Please Select Class', 'facmode' => 'Please select Institutional Character','funcid' => 'Please select function','approvingauthority' => 'Please specify the fullname of Approving Authority', 'approvingauthoritypos' => 'Please specify the Position / Designation of Approving Authority']
							];
							$where = [['appid', $request->appid]];
							return json_encode(((isset($request->appid) || !empty($request->appid)) ? FunctionsClientController::fUpdData($request->all(), $arrData, $arrCheck, $makeHash, [], $fMail, $validate, 'appform', $where) : FunctionsClientController::fInsData($request->all(), $arrData, $arrCheck, $makeHash, $haveAdd, $fMail, $validate, 'appform', true)));
							break;
						case 'fPTCApp':
							session()->forget('ambcharge');
							$arrData = [
								[
									'ocid', 
									'classid', 
									'subClassid', 
									'facmode', 
									'funcid', 
									'hfep_funded', 
									'assignedRgn'
								], 
								[
									'appid', 
									'propbedcap', 
									'conCode', 
									'propstation', 
									'incbedcapfrom', 
									'incbedcapto', 
									'incstationfrom', 
									'incstationto', 
									'construction_description', 
									/*'others',*/ 
									'type', 
									'renoOption'
								], 
								[
									'uid', 
									'appid', 
									'facid'
								]
							];
							$arrCheck = [[], [], []];
							$makeHash = [[], [], []];
							$haveAdd = [['ipaddress'=>request()->ip(), 't_date'=>Carbon::now()->toDateString(), 't_time'=>Carbon::now()->toTimeString()], [], []];
							$fMail = [[], [], []];
							$validate = [[['ocid', 'facmode', 'funcid'], ['ocid'=>'No ownership selected.', 'facmode'=>'No Institutional Character selected.', 'funcid'=>'No function selected.']], [['type', 'construction_description'], ['type'=>'Please select Construction type.', 'construction_description' => 'Please provide Scope of works']], [['uid', 'appid', 'facid'], ['uid'=>'No user selected.', 'appid'=>'No application selected.', 'facid'=>'Please select Type of facility and service capability.']]];
							$tbl = ['appform', 'ptc', 'x08_ft'];
							$appid = [$request->appid, $request->ptcid, null]; 
							$where = [[['appid', $request->appid]], [['id', $request->ptcid]], [['appid', $request->appid]]]; 
							$numLoop = [1, 1, count(($request->facid ?? ['no']))];
							$msgRet = [];
							for($i = 0; $i < count($tbl); $i++) { if($i == 2) { DB::table($tbl[$i])->where($where[$i])->delete(); } for($j = 0; $j < $numLoop[$i]; $j++) {
								$rData = [$request->all(), $request->all(), ['uid'=>$request->uid, 'appid'=>$request->appid, 'facid'=>((isset($request->facid[$j])) ? $request->facid[$j] : NULL)]];
								if(isset($appid[$i])){
									DB::table('chgfil')->where([['appform_id', $appid[$i]]])->delete();
									$notify = $appid[$i];
								}
								$stat = ((isset($appid[$i])) ? FunctionsClientController::fUpdData($rData[$i], $arrData[$i], $arrCheck[$i], $makeHash[$i], $haveAdd[$i], $fMail[$i], $validate[$i], $tbl[$i], $where[$i],true) : FunctionsClientController::fInsData($rData[$i], $arrData[$i], $arrCheck[$i], $makeHash[$i], $haveAdd[$i], $fMail[$i], $validate[$i], $tbl[$i]));
								if(! in_array($stat, $msgRet)) {
									array_push($msgRet, $stat);
								}
							} 
							if($stat !== true){
								return json_encode([$stat]);
							}
							}
							if($notify){
								FunctionsClientController::notifyForChange($notify);
							}
							return json_encode(FunctionsClientController::procInsCharges($msgRet));
							break;
						case 'fCOAApp':
							session()->forget('ambcharge');
							$arrData = [['ocid', 'classid', 'subClassid', 'facmode', 'funcid', 'hfep_funded', 'assignedRgn','noofmain','noofsatellite'], ['uid', 'appid', 'facid']];
							$arrCheck = [[], []];
							$makeHash = [[], []];
							$haveAdd = [['ipaddress'=>request()->ip(), 't_date'=>Carbon::now()->toDateString(), 't_time'=>Carbon::now()->toTimeString()], []];
							$fMail = [[], []];
							$validate = [[['ocid', 'facmode', 'funcid'], ['ocid'=>'No ownership selected.', 'facmode'=>'No Institutional Character selected.', 'funcid'=>'No function selected.']], [['uid', 'appid', 'facid'], ['uid'=>'No user selected.', 'appid'=>'No application selected.', 'facid'=>'Please select Type of facility and service capability.']]];
							$tbl = ['appform', 'x08_ft'];
							$appid = [$request->appid, null]; 
							$where = [[['appid', $request->appid]], [['appid', $request->appid]]]; 
							$numLoop = [1, count(($request->facid ?? ['no']))];
							$msgRet = [];
							for($i = 0; $i < count($tbl); $i++) { if($i == 1) { DB::table($tbl[$i])->where($where[$i])->delete(); } for($j = 0; $j < $numLoop[$i]; $j++) { $rData = [$request->all(), ['uid'=>$request->uid, 'appid'=>$request->appid, 'facid'=>((isset($request->facid[$j])) ? $request->facid[$j] : NULL)]];
								if(isset($appid[$i])){
									DB::table('chgfil')->where([['appform_id', $appid[$i]]])->delete();
									$notify = $appid[$i];
								}
								$stat = ((isset($appid[$i])) ? FunctionsClientController::fUpdData($rData[$i], $arrData[$i], $arrCheck[$i], $makeHash[$i], $haveAdd[$i], $fMail[$i], $validate[$i], $tbl[$i], $where[$i], true) : FunctionsClientController::fInsData($rData[$i], $arrData[$i], $arrCheck[$i], $makeHash[$i], $haveAdd[$i], $fMail[$i], $validate[$i], $tbl[$i]));
								// return $stat;
								if(! in_array($stat, $msgRet)) {
									array_push($msgRet, $stat);
								}
							} 
							if($stat !== true){
								return json_encode([$stat]);
							}
							}
							if($notify){
								FunctionsClientController::notifyForChange($notify);
							}
							return json_encode(FunctionsClientController::procInsCharges($msgRet));
							break;
						case 'fDefaultApp':
							session()->forget('ambcharge');
							$arrData = [['ocid', 'classid', 'subClassid', 'facmode', 'funcid', 'hfep_funded', 'assignedRgn'], ['uid', 'appid', 'facid']];
							$arrCheck = [[], []];
							$makeHash = [[], []];
							$haveAdd = [['ipaddress'=>request()->ip(), 't_date'=>Carbon::now()->toDateString(), 't_time'=>Carbon::now()->toTimeString()], []];
							$fMail = [[], []];
							$validate = [[['ocid', 'facmode', 'funcid'], ['ocid'=>'No ownership selected.', 'facmode'=>'No Institutional Character selected.', 'funcid'=>'No function selected.']], [['uid', 'appid', 'facid'], ['uid'=>'No user selected.', 'appid'=>'No application selected.', 'facid'=>'Please select Type of facility and service capability.']]];
							$tbl = ['appform', 'x08_ft'];
							$appid = [$request->appid, null]; 
							$where = [[['appid', $request->appid]], [['appid', $request->appid]]]; 
							$numLoop = [1, count(($request->facid ?? ['no']))];
							$msgRet = [];
							for($i = 0; $i < count($tbl); $i++) { if($i == 1) { DB::table($tbl[$i])->where($where[$i])->delete(); } for($j = 0; $j < $numLoop[$i]; $j++) { $rData = [$request->all(), ['uid'=>$request->uid, 'appid'=>$request->appid, 'facid'=>((isset($request->facid[$j])) ? $request->facid[$j] : NULL)]];
								if(isset($appid[$i])){
									DB::table('chgfil')->where([['appform_id', $appid[$i]]])->delete();
									$notify = $appid[$i];
								}
								$stat = ((isset($appid[$i])) ? FunctionsClientController::fUpdData($rData[$i], $arrData[$i], $arrCheck[$i], $makeHash[$i], $haveAdd[$i], $fMail[$i], $validate[$i], $tbl[$i], $where[$i], true) : FunctionsClientController::fInsData($rData[$i], $arrData[$i], $arrCheck[$i], $makeHash[$i], $haveAdd[$i], $fMail[$i], $validate[$i], $tbl[$i]));
								// return $stat;
								if(! in_array($stat, $msgRet)) {
									array_push($msgRet, $stat);
								}
							} 
							if($stat !== true){
								return json_encode([$stat]);
							}
							}
							if($notify){
								FunctionsClientController::notifyForChange($notify);
							}
							return json_encode(FunctionsClientController::procInsCharges($msgRet));
							break;
						case 'fLTOApp':
							// hospital list
							// $facidForHospital = ['H','H2','H3'];
							// $toUnsetIfHospital = [['noofamb','typeamb','ambtyp','plate_number']];
							// return json_encode($request->all());
							$arrData = [['ocid', 'classid', 'subClassid', 'facmode', 'funcid', 'aptid', 'ptcCode', 'noofbed', 'clab', 'noofsatellite', 'noofmain', 'noofamb', 'hfep_funded', 'assignedRgn', 'typeamb', 'ambtyp', 'plate_number', 'ambOwner'], ['uid', 'appid', 'facid']]; //, 'others_oanc'
							// hospital check if not in required ambulance services
							// foreach($facidForHospital as $facid){
							// 	if(!in_array($facid, $request->all())){
							// 		foreach ($toUnsetIfHospital as $key => $data) {
							// 			for ($i=0; $i < count($data); $i++) { 
							// 				unset($arrData[$key][array_search($toUnsetIfHospital[$key][$i], $arrData[$key])]);
							// 			}
							// 		}
							// 	}
							// }
							$arrCheck = [[], []];
							$makeHash = [[], []];
							$haveAdd = [['ipaddress'=>request()->ip(), 't_date'=>Carbon::now()->toDateString(), 't_time'=>Carbon::now()->toTimeString()], []];
							$fMail = [[], []];
							$validate = [[['ocid', 'facmode', /*'funcid', 'noofbed',*/ 'aptid'/*, 'clab'*/], ['ocid'=>'No ownership selected.', 'facmode'=>'No Institutional Character selected.',/* 'funcid'=>'No function selected.', 'noofbed'=>'Please specify number of bed(s)',*/'aptid'=>'No application type.'/*, 'clab'=>'Please specify clinical laboratory.'*/]], [['uid', 'appid', 'facid'], ['uid'=>'No user selected.', 'appid'=>'No application selected.', 'facid'=>'Please select Type of facility and service capability.']]];
							if(isset($request->aptid) && $request->aptid == 'IN'){
								array_push($validate[0][0], 'ptcCode');
								$validate[0][1]['ptcCode'] = 'Please provide PTC code';
							}
							$tbl = ['appform', 'x08_ft'];
							$appid = [$request->appid, null]; 
							$where = [[['appid', $request->appid]], [['appid', $request->appid]]]; 
							$numLoop = [1, count(($request->facid ?? ['no']))];

							$msgRet = [];
							for($i = 0; $i < count($tbl); $i++) { if($i == 1) { DB::table($tbl[$i])->where($where[$i])->delete(); }
								for($j = 0; $j < $numLoop[$i]; $j++) {
									$rData = [$request->all(), ['uid'=>$request->uid, 'appid'=>$request->appid, 'facid'=>((isset($request->facid[$j])) ? $request->facid[$j] : NULL)]];
									if(isset($appid[$i])){
										DB::table('chgfil')->where([['appform_id', $appid[$i]]])->delete();
										$notify = $appid[$i];
									}
									$stat = ((isset($appid[$i])) ? FunctionsClientController::fUpdData($rData[$i], $arrData[$i], $arrCheck[$i], $makeHash[$i], $haveAdd[$i], $fMail[$i], $validate[$i], $tbl[$i], $where[$i], true) : FunctionsClientController::fInsData($rData[$i], $arrData[$i], $arrCheck[$i], $makeHash[$i], $haveAdd[$i], $fMail[$i], $validate[$i], $tbl[$i]));
									if(! in_array($stat, $msgRet)) {
										array_push($msgRet, $stat);
									}
								}
								if($stat !== true){
									return json_encode([$stat]);
								}
							 }
							 if($notify){
							 	FunctionsClientController::notifyForChange($notify);
							 }
							return json_encode(FunctionsClientController::procInsCharges($msgRet));
							break;
						case 'fCONApp':
							session()->forget('ambcharge');
							$arrData = [
								[
									'ocid', 
									'classid', 
									'subClassid', 
									/*'funcid',*/ 
									'cap_inv', 
									'lot_area', 
									'noofbed', 
									'hfep_funded', 
									'assignedRgn'
								], 
								['uid', 'appid', 'facid'], 
								['appid', 'type', 'location', 'population'], 
								['appid', 'facilityname', 'location1', 'cat_hos', 'noofbed1', 'license', 'validity', 'date_operation', 'remarks']
							];
							$arrCheck = [[], [], [], []];
							$makeHash = [[], [], [], []];
							$haveAdd = [['ipaddress'=>request()->ip(), 't_date'=>Carbon::now()->toDateString(), 't_time'=>Carbon::now()->toTimeString()], [], [], []];
							$fMail = [[], [], [], []];
							$validate = [
								[
									['ocid', 'cap_inv', 'lot_area', 'noofbed'/*, 'funcid'*/], 
									['ocid'=>'No Ownership selected', 
									'cap_inv'=>'Please input capital Investment', 
									'lot_area'=>'Please specify lot area for hospital', 
									'noofbed'=>'Specify number of bed(s)'/*,
									'funcid' => 'Please specify classification of  hospital'*/]
								], 
								[
									['uid', 'appid', 'facid'], 
									['uid'=>'No user selected.', 'appid'=>'No application selected.', 'facid'=>'Please select Type of facility and service capability.']
								], 
								[
									['location'], 
									['location' => 'Cathchment Population field is required']
								], 
								[
									[], 
									[]
								]
							];
							$tbl = ['appform', 'x08_ft', 'con_catch', (isset($request->facilityname) ? 'con_hospital' : null)];
							// return $tbl;
							$appid = [$request->appid, null, null, null]; 
							$where = [
								[
									['appid', $request->appid]
								], 
								[
									['appid', $request->appid]
								], 
								[
									['appid', $request->appid]
								], 
								[
									['appid', $request->appid]
								]
							]; 
							$numLoop = [
								1, 
								count(($request->facid ?? ['no'])), 
								count($request->type), 
								(isset($request->facilityname) ? count($request->facilityname) : [])
							];
							// return $numLoop;
							$msgRet = [];
							for($i = 0; $i < count($tbl); $i++) { 
								if(isset($tbl[$i])){
									if($i > 0) {
									 DB::table($tbl[$i])->where($where[$i])->delete(); 
									} 
									for($j = 0; $j < $numLoop[$i]; $j++) {
										$arr1 = ((isset($request->facid[$j])) ? ['uid'=>$request->uid, 'appid'=>$request->appid, 'facid'=>$request->facid[$j]] : []);
										$arr2 = ((isset($request->type[$j])) ? ['appid'=>$request->appid, 'type'=>$request->type[$j], 'location'=>$request->location[$j], 'population'=>$request->population[$j]] : []);
										$arr3 = ((isset($request->facilityname[$j])) ? ['appid'=>$request->appid, 'facilityname'=>$request->facilityname[$j], 'location1'=>$request->location1[$j], 'cat_hos'=>$request->cat_hos[$j], 'noofbed1'=>$request->noofbed1[$j], 'license'=>$request->license[$j], 'validity'=>$request->validity[$j], 'date_operation'=>$request->date_operation[$j], 'remarks'=>$request->remarks[$j]] : []);
										$rData = [$request->all(), $arr1, $arr2, $arr3];
										if(isset($appid[$i])){
											$notify = $appid[$i];
											DB::table('chgfil')->where([['appform_id', $appid[$i]]])->delete();
										}
										$stat = ((isset($appid[$i])) ? 
											FunctionsClientController::fUpdData(
													$rData[$i], 
													$arrData[$i], 
													$arrCheck[$i], 
													$makeHash[$i], 
													$haveAdd[$i], 
													$fMail[$i], 
													$validate[$i], 
													$tbl[$i], 
													$where[$i], true) : 
											FunctionsClientController::fInsData(
												$rData[$i], 
												$arrData[$i], 
												$arrCheck[$i], 
												$makeHash[$i], 
												$haveAdd[$i], 
												$fMail[$i], 
												$validate[$i], 
												$tbl[$i]));
										if(! in_array($stat, $msgRet)) {
											array_push($msgRet, $stat);
										}
									} 
								}
							}
							if($notify){
								FunctionsClientController::notifyForChange($notify);
							}
							return json_encode(FunctionsClientController::procInsCharges($msgRet));
							break;
						case 'fUploads':
							$arrData = ['filepath', 'type', 'ltotype', 'app_id', 'fileExten', 'fileSize'];
							$arrCheck = []; $makeHash = []; $haveAdd = ['ipaddress'=>request()->ip(), 't_date'=>Carbon::now()->toDateString(), 't_time'=>Carbon::now()->toTimeString()]; $fMail = [];
							$validate = [['filepath', 'type', 'ltotype', 'app_id'], ['filepath'=>'No filepath specified.', 'type'=>'No type.', 'ltotype'=>'No LTO type', 'app_id'=>'No application selected.']];
							$tbl = 'app_upload'; $retData = "";
							if(isset($request->filepath)) {
								$reData = FunctionsClientController::uploadFile($request->filepath);
				                $rData = ['filepath'=>$reData['fileNameToStore'], 'type'=>$request->type, 'ltotype'=>$request->ltotype, 'app_id'=>$request->appid, 'fileExten'=>$reData['fileExtension'], 'fileSize'=>$reData['fileSize']];
				                $retData = FunctionsClientController::fInsData($rData, $arrData, $arrCheck, $makeHash, $haveAdd, $fMail, $validate, $tbl);
				            }
							return json_encode($retData);
							break;
						case 'getServiceCharge':
							$retArr = [];
							// return $request->all();
							if(isset($request->facid) && isset($request->appid)) {
								// session()->forget('ambcharge');
								$retArr = FunctionsClientController::getServiceCharge($request->facid, $request->hfser_id, $request->facmode, $request->extrahgpid, $request->aptid); 
								$sql = "SELECT 'Application Payment' AS facname, appform_orderofpayment.oop_paid AS amt, '297' AS chgapp_id FROM appform_orderofpayment WHERE appid = '$request->appid'"; 
								$chkOop = DB::select($sql);
								$sessSave = ((count($chkOop) > 0) ? $chkOop : $retArr);
								
								session()->put('payment', [FunctionsClientController::getSessionParamObj("uData", "uid") => [$retArr, $request->appid]]);
							}else{
								// $retArr = FunctionsClientController::getServiceCharge($request->facid, $request->hfser_id, $request->facmode, $request->extrahgpid); 
								$retArr = FunctionsClientController::getServiceCharge($request->facid, $request->hfser_id, $request->facmode, $request->extrahgpid, $request->aptid); 
							}
							return json_encode($retArr);
							break;
						
						case 'getAncillary':  
							$retArr = [];
							if(isset($request->id) && !empty($request->id)) {
								$hfserid = null;
								if(isset($request->from)){
									switch ($request->from) {
										case 1:
											$hfserid = 'LTO';
											break;
										case 2:
											$hfserid = 'PTC';
											break;
										case 3:
											$hfserid = 'CON';
											break;
										case 4:
											$hfserid = 'ATO';
											break;
										case 5:
											$hfserid = 'COR';
											break;
										case 6:
											$hfserid = 'COA';
											break;
									}
								}
								//get all services of add ons, otherwise services of hospital levels if Request has selected value.
								$retArr = FunctionsClientController::getAncillaryServices($request->id,$request->selected,$hfserid); 

							}
							return json_encode($retArr);
							break;
						case 'getApplyLoc':
							$retArr = [];
							if(isset($request->id) && !empty($request->id)) {
								$retArr = FunctionsClientController::getApplyLocation($request->hfer,$request->id); 
							}
							return json_encode($retArr);
							break;
						case 'getChargesPerApplication':
							$retArr1 = [];
							if(isset($request->hgpid) && isset($request->aptid)) {

								//var_dump($request); exit;
								$retArr1 = FunctionsClientController::getChargesPerApplication($request->hgpid, $request->aptid, $request->hfser_id);
								session()->put('appcharge', [FunctionsClientController::getSessionParamObj("uData", "uid") => [$retArr1, $request->appid]]);
							}
							return json_encode($retArr1);
							break;
						case 'getChargesPerAmb':
							$retArr2 = [];
							if(isset($request->ambamt) && isset($request->appid)) {
								if(floatval($request->ambamt) > 0) { $retArr2 = DB::select(DB::raw("SELECT NULL AS chgapp_id, 'Ambulance charge' AS chg_desc, '$request->ambamt' AS amt")); }
								session()->put('ambcharge', [FunctionsClientController::getSessionParamObj("uData", "uid") => [$retArr2, $request->appid]]);
							}else{
								if(floatval($request->ambamt) > 0) { $retArr2 = DB::select(DB::raw("SELECT NULL AS chgapp_id, 'Ambulance charge' AS chg_desc, '$request->ambamt' AS amt")); }
							}
							return $retArr2;
							break;
						case 'getGoAncillary':
							$retArr = [];
							if(isset($request->facid)) {
								
								$retArr = FunctionsClientController::getGoAncillary($request->facid);
							}
							                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
							return json_encode($retArr);
							break;
						default:
							return json_encode([]);
							break;
					}
				}
			} else {
				return json_encode([]);
			}
		// } catch(Exception $e) {
		// 	return json_encode($e);
		// }
	}

	public function viewReport(Request $request,$selected,$appid){

		if(isset($selected) && isset($appid) && in_array(true,AjaxController::isSessionExist(array(['uData']))) && FunctionsClientController::existOnDB('appform',array(['appid',$appid],['uid',session()->get('uData')->uid]))){
			try {

				if($request->isMethod('get')){
					switch ($selected) {
						case 'floorplan':
							$dohC = new DOHController();
							$evalC = new EvaluationController();

							$evaluationData = $dohC->viewhfercresult($request,$appid,(AjaxController::maxRevisionFor($appid) != 0 ? AjaxController::maxRevisionFor($appid) : 1),true);
							
							if(is_array($evaluationData)){
								
								$dataOfEntry = $evalC->FPGenerateReportAssessment($request, $appid, $evaluationData['evaluation']->revision, $evaluationData['evaluation']->HFERC_evalBy, true);
								if($dataOfEntry){
									$evaluationData['dataOfEvaluation'] = true;
									foreach ($dataOfEntry as $key => $value) {
										$evaluationData[$key] = $value;
									}
								}

								//same comments to back office final revision
								$reco = DB::table('assessmentrecommendation')->where([['appid',$appid],['choice','comment'],['revision',$evaluationData['evaluation']->revision], ['evaluatedby',$evaluationData['evaluation']->HFERC_evalBy]])->first();
								$evaluationData['evaluation']->HFERC_comments = $reco->details;

								$evaluationData['canResub'] = !FunctionsClientController::existOnDB('chgfil',array(['appform_id',$appid],['uid',session()->get('uData')->uid],['revision',(AjaxController::maxRevisionFor($appid) > 2 ? AjaxController::maxRevisionFor($appid) : 1)]));
								
								return view('client1.reports.floorplan',$evaluationData);
							} else {
								return redirect('client1/apply')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Forbidden']);
							}
							break;
						
						default:
							# code...
							break;
					}
				} elseif($request->isMethod('post')){
					switch ($selected) {
						case 'floorplan':

							$main = AjaxController::getHighestApplicationFromX08FT($appid);

							if(isset($main) && !FunctionsClientController::existOnDB('chgfil',array(['appform_id',$appid],['uid',session()->get('uData')->uid],['revision',(AjaxController::maxRevisionFor($appid) != 0 ? AjaxController::maxRevisionFor($appid) : 1)]))){

								$data = DB::table('chg_app')
										->join('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
										->join('orderofpayment', 'chg_app.oop_id', '=', 'orderofpayment.oop_id')
										->join('category', 'charges.cat_id', '=', 'category.cat_id')
										->join('apptype', 'chg_app.aptid', '=', 'apptype.aptid')
										->leftJoin('hfaci_serv_type', 'chg_app.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->where([['chg_app.hfser_id', 'PTC'],['category.cat_type','C'],['charges.hgpid',$main->hgpid],['charges.fprevision',1]])
										->orderBy('chg_app.chgopp_seq','asc')
										->first();
								$shouldPay = AjaxController::isRequredToPayPTC((AjaxController::maxRevisionFor($appid) != 0 ? AjaxController::maxRevisionFor($appid) : 1));

								$arrDataChgfil = [$data->chgapp_id, $data->chg_num, $appid, NULL, NULL, NULL, NULL, NULL, NULL, $data->chg_desc, $data->amt, Carbon::now()->toDateString(), Carbon::now()->toTimeString(), request()->ip(), FunctionsClientController::getSessionParamObj("uData", "uid"), (AjaxController::maxRevisionFor($appid) != 0 ? AjaxController::maxRevisionFor($appid) : 1)];

								$arrSaveChgfil = ['chgapp_id', 'chg_num', 'appform_id', 'chgapp_id_pmt', 'orreference', 'deposit', 'other', 'au_id', 'au_date', 'reference', 'amount', 't_date', 't_time', 't_ipaddress', 'uid', 'revision'];

								if(!$shouldPay){
									$arrSaveChgfil = ['chgapp_id', 'chg_num', 'appform_id', 'chgapp_id_pmt', 'orreference', 'deposit', 'other', 'au_id', 'au_date', 'reference', 'amount', 't_date', 't_time', 't_ipaddress', 'uid', 'revision','isPaid'];
									$arrDataChgfil = [NULL, NULL, $appid, NULL, NULL, NULL, NULL, NULL, NULL, 'NO CHARGE', 0, Carbon::now()->toDateString(), Carbon::now()->toTimeString(), request()->ip(), FunctionsClientController::getSessionParamObj("uData", "uid"), (AjaxController::maxRevisionFor($appid) != 0 ? AjaxController::maxRevisionFor($appid) : 1),1];
								}

								$insert = DB::table('chgfil')->insert(array_combine($arrSaveChgfil, $arrDataChgfil));
								if($insert) { 

									if($shouldPay){
										$toUpdate = null;
										DB::table('appform')->where('appid',$appid)->update(['isPayEval' => $toUpdate, 'payEvaldate' => $toUpdate, 'payEvaltime' => $toUpdate, 'payEvalip' => $toUpdate, 'payEvalby' => $toUpdate, 'isCashierApprove' => $toUpdate, 'CashierApproveBy' => $toUpdate, 'CashierApproveDate' => $toUpdate, 'CashierApproveTime' => $toUpdate, 'CashierApproveIp' => $toUpdate, 'isRecoForApproval' => $toUpdate, 'isAcceptedFP' => $toUpdate, 'status' => 'REVF']);
									} else {
										DB::table('hferc_evaluation')->where('appid',$appid)->update(['HFERC_eval' => 2]);
									}

									return redirect('client1/apply/app/showResult/'.$selected.'/'.$appid)->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Success. Please wait for evaluation to complete']);
								
								
								}
							}
							return redirect('client1/apply/app/showResult/'.$selected.'/'.$appid)->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Error. Please try again later']);

							break;
						
						default:
							# code...
							break;
					}
				}

				
			} catch (Exception $e) {
				dd($e);
			}

		} else {
			return redirect('client1')->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Application Not Found']);
		}
	}

	public function generateForCertificate($appid){
		if(isset($appid)){
			$appform = DB::table('appform')->where('appid', $appid)->first();
			$message = "No data";
			if(!is_null($appform)){
				// if($appform->hfser_id == "CON"){
				// 	$retTable = DB::table('appform')->where('appid', $appid)->leftJoin('facmode', 'facmode.facmid', '=', 'appform.facmode')->leftJoin('region', 'region.rgnid', '=', 'appform.rgnid')->leftJoin('province', 'province.provid', '=', 'appform.provid')->leftJoin('city_muni', 'city_muni.cmid', '=', 'appform.cmid')->leftJoin('barangay', 'barangay.brgyid', '=', 'appform.brgyid')->select('appform.appid', 'appform.facilityname', 'appform.owner', 'appform.street_name', 'facmode.facmdesc', 'region.rgn_desc', 'province.provname', 'city_muni.cmname', 'barangay.brgyname', 'appform.hfser_id', 'appform.noofbed', 'appform.t_date')->first(); 
				// 	$coneval = DB::table('con_evaluate')->where('appid', $appid)->first(); 
					
				// 	$serviceType = DB::select("SELECT facname FROM facilitytyp WHERE facilitytyp.facid IN (SELECT facid FROM x08_ft WHERE appid = '$appid')");
					
				// 	if(count($serviceType)) {
				// 		$impArr1 = [];
				// 		foreach($serviceType AS $serviceTypeRow) {
				// 			array_push($impArr1, $serviceTypeRow->facname);
				// 		}
				// 		$serviceId = implode(', ', $impArr1);
				// 	}

				// 	$message = 
				// 		"\nCON No. ". date('Y') . "-".str_pad(((isset($appid)) ? $appid : '_1'), 3, '0', STR_PAD_LEFT).
				// 		"\nFacility Name: ". $retTable->facilityname . " \n".
				// 		"Location: ". $retTable->rgn_desc. ", ". $retTable->provname. ", ". $retTable->cmname. ", ". $retTable->brgyname. ", ". $retTable->street_name . 
				// 		"\nLevel of Hospital: ". $serviceId.
				// 		"\nBed Capacity: ". abs($coneval->ubn). " Bed(s)".
				// 		"\nDate Issued: ". date("F j, Y", strtotime($retTable->t_date)).
				// 		"\nValidity Period: ". date("F j, Y", strtotime($retTable->t_date)). " to ". ((isset($retTable->t_date)) ? date("F j, Y", ((strtotime($retTable->t_date)-(86400*2))+15552000)) : 'Not Specified')
				// 	;
				// }else{
					$message = url('client1/certificates/view/external/').'/'.$appid;
				// }

				
			}


			return self::generateQR($message);
			// return self::generateQR(url('client1/certificates/view/external/').'/'.$appid);
		}
	}

	public static function generateQR($textTOGenerate){
		if(isset($textTOGenerate)){
			// $location = url('ra-idlis/public/img/qrlogo.png');
			$image = \QrCode::format('png')
	                         // ->merge($location, 0.2, true)
	                         ->size(230)->errorCorrection('H')
	                         ->generate($textTOGenerate);
	      	return response($image)->header('Content-type','image/png');
      	}
	}

	public function redirectToApplication($appid){
		if(isset($appid)){
			$data = DB::table('appform')->where('appid',$appid)->first();
			return redirect(url('client1/apply/app/'.$data->hfser_id.'/'.$appid));
		}
	}

}