<?php 
	namespace App\Http\Controllers;
	use Illuminate\Support\Facades\Response;
	use Illuminate\Http\Request;
	use Illuminate\Support\Str;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Storage;
	use Carbon\Carbon;
	use Session;
	use DateTime;
	use DateTimeZone;
	use FunctionsClientController;
	// use Hash;
	// syrel added
	use Cache;
	use Agent;
	use OthersController;
use ZipStream\Option\Archive;

	class AjaxController extends Controller
	{
		/////////////// MISC
		public static function getCurrentUserAllData()  // Get All Current User Information
		{
			try 
			{
				if(Session::has('employee_login'))
				{
					$dt = Carbon::now();
			        $dateNow = $dt->toDateString();
			        $timeNow = $dt->toTimeString();
			        $ip =  request()->ip();
			        $employeeData = session('employee_login');
					$uname  = $employeeData->uid;
					$data['date'] = $dateNow;
					$data['time'] = $timeNow;
					$data['ip'] = $ip;
					$data['cur_user'] = $uname;
					$data['grpid'] = $employeeData->grpid;
					$data['rgnid'] = $employeeData->rgnid;
					$data['password'] = $employeeData->pwd;
					$data['fullname'] = $employeeData->fname.' '.$employeeData->mname.' '.$employeeData->lname;
					$data['lastname'] = $employeeData->lname;
					$data['position'] = $employeeData->position;
					$data['is_fda'] = $employeeData->is_fda;

					return $data;
				} else {

					$data['date'] = 'ERROR';
					$data['time'] = 'ERROR';
					$data['ip'] = 'ERROR';
					$data['cur_user'] = 'ERROR';
					$data['grpid'] = 'ERROR';
					$data['rgnid'] = 'ERROR';
					$data['password'] = 'ERROR';
					$data['fullname'] = 'ERROR';
					$data['lastname'] = 'ERROR';
					$data['position'] = 'ERROR';
					$data['is_fda'] = 'ERROR';

					return $data;
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());				
				return 'ERROR';
			}
		}

		//set created date of appform upon first insert
		public static function setAppForm_CreatedDate(String $appid)
		{
			try
			{
				$dateup = new DateTime("now", new DateTimeZone('Asia/Manila'));
				$created_at = $dateup->format('Y-m-d H:i:s');
				DB::table('appform')->where([['appid',  $appid]])->insert(['created_at' => $updated_at]);

				return true;
			}
			catch (Exception $ex) { return false; }
		}
		//set updated date of appform 
		public static function setAppForm_UpdatedDate(String $appid)
		{
			try
			{
				$dateup = new DateTime("now", new DateTimeZone('Asia/Manila'));
				$updated_at = $dateup->format('Y-m-d H:i:s');

				DB::table('appform')->where([['appid',  $appid]])->update(['updated_at' => $updated_at]);

				return true;
			}
			catch (Exception $ex) { return false; }
		}

		public static function SystemLogs($message) // Writes Error Messages to Notepad {location : ra-idlis/storage/app/system/logs}
		{
			$Cur_useData = AjaxController::getCurrentUserAllData();
			$timedate = Carbon::now()->format('YmdHs');
			$name = $timedate.$Cur_useData['cur_user'].'RGN'.$Cur_useData['rgnid'];
			Storage::put('/system/logs/'.$name.'.txt', $message);
		}
		public static function customLog($name = '',$message) // Writes Error Messages to Notepad {location : ra-idlis/storage/app/system/logs}
		{
			$Cur_useData = AjaxController::getCurrentUserAllData();
			$timedate = Carbon::now()->format('YmdHs');
			$name = $name.$timedate;
			Storage::put('/system/inspection/'.$name.'.txt', $message);
		}
		public static function NameSorter($fname, $mname, $lname) // Writes name
		{ 
		      	if ($mname != "") 
		      	{
			    	$mid = strtoupper($mname[0]);
			    	$mid = $mid.'. ';
	       		} 
	       		else 
	       		{
			    	$mid = ' ';
			 	}
				$name = $fname.' '.$mid.''.$lname;
				return $name;
		}

		public static function uploadFileNew($dFile) {

			$retArr = [];

			if(isset($dFile)) {
				$_file = $dFile;
				$filename = $_file->getClientOriginalName(); 
				$filenameOnly = pathinfo($filename,PATHINFO_FILENAME); 
				$fileExtension = $_file->getClientOriginalExtension();
				$fileNameToStore = self::getCurrentUserAllData()['cur_user'].'_'.Str::random(10).'_'.date('Y_m_d_i_s').'.'.$fileExtension;
				$filemMIME = $_file->getMimeType();
				$path = $_file->storeAs('public/uploaded', $fileNameToStore);
				$fileSize = $_file->getClientSize();
				$retArr = ['fileExtension'=>$fileExtension, 'fileNameToStore'=>$fileNameToStore, 'fileSize'=>$fileSize, 'mime'=> $filemMIME, 'path'=> $path];
			}
			return $retArr;
		}		

		public static function DownloadFile($id)
		{
			try 
			{
				// $test = Storage::get('public/uploaded/'.$id);
				$exists = Storage::exists('public/uploaded/'.$id);
				if ($exists) {
					// return Storage::get('public/uploaded/'.$id);
					$pathToFile = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $id );
			        return Response::download($pathToFile);
				}
				else {
					AjaxController::SystemLogs('File'.$id.' does not exist. (DownloadFile)');
					session()->flash('system_error', 'File does not exist.');
					return back();
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());				
				return 'ERROR';
			}
		}
		public static function getHeaderSettings()
		{
			if(!session()->has('directorSettings')){
				$systemSettings = DB::table('m99')->select('dohiso')->where('id',1)->first();	
				session()->put('directorSettings',$systemSettings);
			}
		}
		public static function OpenFile($id)
		{
			try 
			{
				// $test = Storage::get('public/uploaded/'.$id);
				$exists = Storage::exists('public/uploaded/'.$id);
				
				if ($exists) {
					// return Storage::get('public/uploaded/'.$id);
					$pathToFile = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $id );
			        return Response::file($pathToFile);
				}
				else {
					AjaxController::SystemLogs('File'.$id.' does not exist. (DownloadFile)');
					session()->flash('system_error', 'File does not exist.');
					return back();
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());				
				return 'ERROR';
			}
		}
		public static function isExist($id)
		{
			try 
			{
				// $test = Storage::get('public/uploaded/'.$id);
				$exists = Storage::exists('public/uploaded/'.$id);
				if ($exists) {
					return true;
				}
				return false;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());				
				return 'ERROR';
			}
		}
		public static function ChangePassword(Request $request)
		{
			if(session()->has('employee_login') || session()->has('uData')){
				try 
				{
					if(session()->has('employee_login')){
						$Cur_useData = AjaxController::getCurrentUserAllData();
					} else {
						$Cur_useData = session()->get('uData');
						$Cur_useData['password'] = $Cur_useData['pwd'];
						$Cur_useData['cur_user'] = $Cur_useData['uid'];
						$Cur_useData['ip'] = request()->ip();
					}
					// check old password // oldpass
					
					$chck = Hash::check($request->oldpass, $Cur_useData['password']);
					if ($chck) // check if old password is correct
					{ 
						$chckPreviousPasswords = DB::table('x08_pass')->where('uid', '=', $Cur_useData['cur_user'])->get();
						if (count($chckPreviousPasswords) != 0) // Check if there is Previous Account Password
						{
							$checkifHaveifItIsAnOldPassword = 0;
							for ($i=0; $i < count($chckPreviousPasswords) ; $i++) { 
								$chck2 = Hash::check($request->password, $chckPreviousPasswords[$i]->pass);
								if($chck2 == true)
								{
										$checkifHaveifItIsAnOldPassword = 1;
										break;
								}
							}

							if ($checkifHaveifItIsAnOldPassword == 1) { return 'USEDPASSWORD';} 
							else 
							{
								// Insert Previous Password
								DB::table('x08_pass')->insert(['uid'=>$Cur_useData['cur_user'], 'pass'=>$Cur_useData['password'], 'x08p_tdate' => Carbon::now(), 'x08p_ipaddr' => $Cur_useData['ip']]);
								// Update Password
								$data = Hash::make($request->password);
								$update = array('pwd' => $data);
								$test = DB::table('x08')->where('uid', '=', $Cur_useData['cur_user'])->update($update);
								if ($test) {return 'DONE';}
								else
								{
									$data = AjaxController::SystemLogs('No data has been updated in x08 table. (ChangePassword)');
									return 'ERROR';
								}
							}
						} 
						else 
						{
							// Insert Previous Password
							DB::table('x08_pass')->insert(['uid'=>$Cur_useData['cur_user'], 'pass'=>$Cur_useData['password'], 'x08p_tdate' => Carbon::now(), 'x08p_ipaddr' => $Cur_useData['ip']]);
							// Update Password
							$data = Hash::make($request->password);
							$update = array('pwd' => $data);
							$test = DB::table('x08')->where('uid', '=', $Cur_useData['cur_user'])->update($update);
							if ($test) {return 'DONE';}
							else
							{
								$data = AjaxController::SystemLogs('No data has been updated in x08 table. (ChangePassword)');
								return 'ERROR';
							}
						}
					} 
					else 
					{
						return 'WRONGPASS';	
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e->getMessage());				
					return 'ERROR';
				}
			}
		}
		public static function getAllFrom($table,$select = '*'){
			return DB::table($table)->select($select)->get();
		}
		public static function getAllFromWhere($table,$cond = array(), $select = '*'){
			return DB::table($table)->select($select)->where($cond)->get();
		}
		public static function checkTokenforChangePassword($token)
		{
			try 
			{
				$data = DB::table('x08')->where([['token', '=', $token],['grpid', '<>' ,'C']])->first();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());				
				return null;
			}
		}
		public static function getNotificationIDfromCases($hferid,$case,$actionTaken)
		{
			$id = null;
			switch ($hferid) {
				case 'CON':
					switch ($case) {
						case 'eval':
							switch ($actionTaken) {
								case 1:
									$id = 9;
								break;
								case 0:
									$id = 9;
								break;
								case 2:
									$id = 27;
								break;
							}
						break;
						case 'additionalRequirments':
							$id = 49;
						break;

					}
				break;
				case 'LTO':
					switch ($case) {
						case 'eval':
							switch ($actionTaken) {
								case 1:
									$id = 3;
								break;
								case 0:
									$id = 4;
								break;
								case 2:
									$id = 24;
								break;
							}
						break;
						case 'additionalRequirments':
							$id = 76;
						break;
					}
				break;
				case 'FDA':
					switch ($case) {
						case 'eval':
							switch ($actionTaken) {
								case 1:
									$id = 5;
								break;
								case 0:
									$id = 6;
								break;
								case 2:
									$id = 25;
								break;
							}
						break;
						case 'xray':
							switch ($actionTaken) {
								case 1:
									$id = 69;
								break;
								case 0:
									$id = 70;
								break;
								case 2:
									$id = 71;
								break;
							}
						break;
						case 'pharma':
							switch ($actionTaken) {
								case 1:
									$id = 72;
								break;
								case 0:
									$id = 73;
								break;
								case 2:
									$id = 74;
								break;
							}
						break;

					}
				break;
				case 'PTC':
					switch ($case) {
						case 'eval':
							switch ($actionTaken) {
								case 1:
									$id = 13;
								break;
								case 0:
									$id = 14;
								break;
								case 2:
									$id = 29;
								break;
							}
						break;
						case 'additionalRequirments':
							$id = 51;
						break;

					}
				break;
				case 'ATO':
					switch ($case) {
						case 'eval':
							switch ($actionTaken) {
								case 1:
									$id = 7;
								break;
								case 0:
									$id = 8;
								break;
								case 2:
									$id = 26;
								break;
							}
						break;
						case 'additionalRequirments':
							$id = 48;
						break;

					}
				break;
				case 'COR':
					switch ($case) {
						case 'eval':
							switch ($actionTaken) {
								case 1:
									$id = 11;
								break;
								case 0:
									$id = 12;
								break;
								case 2:
									$id = 28;
								break;
							}
						break;
						case 'additionalRequirments':
							$id = 50;
						break;

					}
				break;
				case 'COA':
					switch ($case) {
						case 'eval':
							switch ($actionTaken) {
								case 1:
									$id = 15;
								break;
								case 0:
									$id = 16;
								break;
								case 2:
									$id = 30;
								break;
							}
						break;
						case 'additionalRequirments':
							$id = 52;
						break;

					}
				break;
				
			}
			return $id;
		}
		public static function getNotification(Request $request)
		{
			try 
			{
				$qwe = [];
				$alteredLink = null; $msg_desc = null;
				$SelectedUser = AjaxController::getCurrentUserAllData();
				$totalNotif = $unread = 0;
				$notif = DB::table('notificiationlog')->leftJoin('notification_msg','notification_msg.msg_code','notificiationlog.msg_code')->where('uid',$request->uid)->orderBy('notifdatetime','DESC');
				$notif = (isset($request->notIncluded) ? $notif->whereNotIn('notfid',$request->notIncluded) : $notif->get());
				
				if(count($notif) > 0){
					$totalNotif = count($notif);
					foreach ($notif as $key => $value) {

						$notif[$key]->adjustedmonth = Carbon::parse($value->notifdatetime)->diffForHumans();
						$msg_desc = str_replace('{appid}', $value->appid, $value->msg_desc);
						
						$notif[$key]->msg_desc = $msg_desc;

						if($value->needappid > 0){

							$alteredLink = str_replace('{appid}', $value->appid, $value->msg_loc);

							if(strpos($alteredLink, '{token}') !== false){
								$alteredLink = str_replace('{token}', FunctionsClientController::getToken(), $alteredLink);
							}
							if(strpos($alteredLink, '{uid}') !== false){
								$alteredLink = str_replace('{uid}', $value->uid , $alteredLink);
							}
							$notif[$key]->adjustedlink = asset($alteredLink);
						} else {
							$notif[$key]->adjustedlink = asset($value->msg_loc);
						}
						

						if($value->status == 0){
							$unread +=1;
						}
					}
				}

				return json_encode(array('unread' => $unread,'data' =>$notif, 'totalNotif' => count($notif)));				
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());				
				return 'ERROR';
			}
		}

		public static function getNotificationMessage(Request $request)
		{
			try 
			{
				$qwe = [];
				$alteredLink = null; $msg_desc = null;
				$SelectedUser = AjaxController::getCurrentUserAllData();
				$totalNotif = $unread = 0;
				$notif = DB::table('notificiationlog')->leftJoin('notification_msg','notification_msg.msg_code','notificiationlog.msg_code')->where('uid',$request->uid)->orderBy('notifdatetime','DESC');
				$notif = (isset($request->notIncluded) ? $notif->whereNotIn('notfid',$request->notIncluded) : $notif->get());
				
				if(count($notif) > 0){
					$totalNotif = count($notif);
					foreach ($notif as $key => $value) {

						$notif[$key]->adjustedmonth = Carbon::parse($value->notifdatetime)->diffForHumans();
						$msg_desc = str_replace('{appid}', $value->appid, $value->msg_desc);						
						$notif[$key]->msg_desc = $msg_desc;

						if($value->needappid > 0){

							$alteredLink = str_replace('{appid}', $value->appid, $value->msg_loc);

							if(strpos($alteredLink, '{token}') !== false){
								$alteredLink = str_replace('{token}', FunctionsClientController::getToken(), $alteredLink);
							}
							if(strpos($alteredLink, '{uid}') !== false){
								$alteredLink = str_replace('{uid}', $value->uid , $alteredLink);
							}
							$notif[$key]->adjustedlink = asset($alteredLink);
						} else {
							$notif[$key]->adjustedlink = asset($value->msg_loc);
						}						

						if($value->status == 0){
							$unread +=1;
						}
					}
				}

				return array('unread' => $unread,'data' =>$notif, 'totalNotif' => count($notif));				
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());				
				return 'ERROR';
			}
		}

		public static function updateNotification(Request $request){
			$returnToSender = DB::table('notificiationlog')->where('uid',$request->uid)->update(['status' => 1]);
			return ($returnToSender ? 'done' : 'error');
		}
		public static function notifyClient($appid,$uid, $selected)
		{
			try 
			{
				$cur_data = AjaxController::getCurrentUserAllData();

				$dateup = new DateTime("now", new DateTimeZone('Asia/Manila'));
				$dup = $dateup->format('Y-m-d H:i:s');

				if ($uid != null) {
					DB::table('notificiationlog')->insert([
								'appid' => $appid,
								'uid' => $uid,
								'msg_code' => $selected,
								'notifdatetime' => $dup
								// 'otherLinks' => ($oLink ? $oLink : null)
						]);
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function getUidFrom($apid)
		{
			try {
				$getUid = DB::table('appform')->where('appid', '=', $apid)->first();
				return ($getUid->uid ?? null);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		
		public static function getUidFromRegFac($rid)
		{
			try {
				$data = DB::table('registered_facility')->where('regfac_id', '=', $rid)->first();

				$rgappid = null; 
					
					if(!is_null($data->lto_id)){
						$rgappid = $data->lto_id; 
					}else{
						if(!is_null($data->ptc_id)){
							
							$rgappid = $data->ptc_id; 
						}else{
							if(!is_null($data->con_id)){
								
								$rgappid = $data->con_id; 
							}else{
								if(!is_null($data->ato_id)){
									
									$rgappid = $data->ato_id; 
								}else{
									if(!is_null($data->coa_id)){
										
										$rgappid = $data->coa_id; 
									}else{
										if(!is_null($data->cor_id)){
											
											$rgappid = $data->cor_id; 
										}
									}
								}
								
							}
						}
					}

					$getUid = DB::table('appform')->where('appid', '=', $rgappid)->first();
				return ($getUid->uid ?? null);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function gethfer_id($apid)
		{
			try {
				$getUid = DB::table('appform')->where('appid', '=', $apid)->first();
				return $getUid->hfser_id;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getAllNotifications()
		{
			try 
			{
				$SelectedUser = AjaxController::getCurrentUserAllData();
				$data = DB::table('notificiationlog')->where('uid', '=', $SelectedUser['cur_user'])->orderBy('notifdatetime', 'desc')->toSQL();
				dd($data);
				if (count($data) > 0) 
				{
					for ($i=0; $i < count($data); $i++) 
						{ 
							$now = Carbon::now();
							$difference = $data[$i]->notfdate. ' '. $data[$i]->notftime;
							$newD = Carbon::parse($difference);
							$data[$i]->DifferenceFromHumans = $newD->diffForHumans($now);
							$time = $data[$i]->notftime;
							$newT = Carbon::parse($time);
							$data[$i]->formattedTime = $newT->format('g:i A');
							$date = $data[$i]->notfdate;
							$newD = Carbon::parse($date);
							$data[$i]->formattedDate = $newD->toFormattedDateString();
						}	
				}
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function toggleNotification(Request $request)
		{
			try 
			{
				$data = array('status' => $request->tgl);
				$test = DB::table('notificiationlog')->where('notfid', $request->id)->update($data);
				if ($test) {
					return 'DONE';
				} else {
					AjaxController::SystemLogs('No data has been updated in notificiationlog table. toggleNotification');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function checkPassword($pwd)
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$chck = Hash::check($pwd, $Cur_useData['password']);
				return $chck;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function isPreviousPassword($pwd,$uid)
		{
			try 
			{
				$records = DB::table('pwdHistory')->where('uid',$uid)->get();
				if(count($records) > 0){
					foreach ($records as $key) {
						if(Hash::check($pwd, $key->pwd)){
							return true;
						}
					}
				}
				return false;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		/////////////// FUNCTIONS
		/// ------------------------------------ MASTER FILE
		/////// Applicants
		public static function getAllApplicants($grpid) // Get all Applicants
		{
			try {
					$Cur_useData = AjaxController::getCurrentUserAllData();
					$regID = $Cur_useData['rgnid'];
					switch ($grpid) {
						case 'NA': // NATIONAL ADMINISTRATOR
							// $data = DB::table('appform')
							// 	->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							// 	->join('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
							// 	->join('x08', 'appform.uid', '=', 'x08.uid')
							// 	->join('region', 'appform.assignedRgn', '=', 'region.rgnid')
							// 	->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
							// 	->join('province', 'x08.province', '=', 'province.provid')
							// 	->join('apptype', 'appform.aptid', '=', 'apptype.aptid')
							// 	->join('trans_status', 'appform.status', '=', 'trans_status.trns_id')
							// 	->select('appform.*', 'trans_status.trns_desc', 'apptype.aptdesc', 'hfaci_serv_type.*','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'x08.uid' )
							// 	->where('appform.draft', '=', null)
							// 	->get();
							$data = DB::table('appform')
								->leftJoin('facilitytyp', 'facilitytyp.facid','=','appform.facid')
								->leftJoin('hfaci_grp', 'hfaci_grp.hgpid','=','facilitytyp.hgpid')
								->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
								->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
								->leftJoin('region', 'appform.assignedRgn', '=', 'region.rgnid')
								->leftJoin('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
								->leftJoin('province', 'x08.province', '=', 'province.provid')
								->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
								->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
								->select('appform.*', 'trans_status.trns_desc', 'apptype.aptdesc', 'hfaci_serv_type.*','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'x08.uid' )
								->where([
									['appform.draft', '=', null],
									['appform.hfser_id','<>',null]
								])
								->orderBy('appform.appid','desc')
								// ->where('appid', '=', 87)
								->get();
							break;
						case 'RA': // REGIONAL ADMINISTRATOR
							$data = DB::table('appform')
									->leftJoin('facilitytyp', 'facilitytyp.facid','=','appform.facid')
									->leftJoin('hfaci_grp', 'hfaci_grp.hgpid','=','facilitytyp.hgpid')
									->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
									->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
									->leftJoin('region', 'appform.assignedRgn', '=', 'region.rgnid')
									->leftJoin('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->leftJoin('province', 'x08.province', '=', 'province.provid')
									->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
									->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
									->select('appform.*', 'trans_status.trns_desc', 'apptype.aptdesc', 'hfaci_serv_type.*','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'x08.uid' )
									->where([
										['appform.draft', '=', null], 
										['appform.assignedRgn', '=', $regID], 
										['appform.assignedLO', '=', null],
										['appform.hfser_id','<>',null]
									])
									->orderBy('appform.appid','desc')
									->get();
								break;
						case 'DC': // Division Chief
							$data = DB::table('appform')
									->leftJoin('facilitytyp', 'facilitytyp.facid','=','appform.facid')
									->leftJoin('hfaci_grp', 'hfaci_grp.hgpid','=','facilitytyp.hgpid')
									->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
									->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
									->leftJoin('region', 'appform.assignedRgn', '=', 'region.rgnid')
									->leftJoin('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->leftJoin('province', 'x08.province', '=', 'province.provid')
									->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
									->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
									->select('appform.*', 'trans_status.trns_desc', 'apptype.aptdesc', 'hfaci_serv_type.*','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'x08.uid' )
								->where([
									['appform.draft', '=', 0], 
									['appform.assignedRgn', '=', $regID], 
									['appform.assignedLO', '=', null],
									['appform.hfser_id','<>',null]
								])
								->orderBy('appform.appid','desc')
								->get();
							break;
						case 'CS': // CASHIERING
							$data = DB::table('appform')
								->leftJoin('facilitytyp', 'facilitytyp.facid','=','appform.facid')
									->leftJoin('hfaci_grp', 'hfaci_grp.hgpid','=','facilitytyp.hgpid')
									->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
									->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
									->leftJoin('region', 'appform.assignedRgn', '=', 'region.rgnid')
									->leftJoin('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->leftJoin('province', 'x08.province', '=', 'province.provid')
									->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
									->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
									->select('appform.*', 'trans_status.trns_desc', 'apptype.aptdesc', 'hfaci_serv_type.*','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'x08.uid' )
								->where([
									['appform.draft', '=', null], 
									['appform.status', '=', 'FPE'],
									['appform.hfser_id','<>',null]
								])
								->orderBy('appform.appid','desc')
								->get();
							break;
						default: // OTHERS
							$data = DB::table('appform')
								->leftJoin('facilitytyp', 'facilitytyp.facid','=','appform.facid')
									->leftJoin('hfaci_grp', 'hfaci_grp.hgpid','=','facilitytyp.hgpid')
									->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
									->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
									->leftJoin('region', 'appform.assignedRgn', '=', 'region.rgnid')
									->leftJoin('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->leftJoin('province', 'x08.province', '=', 'province.provid')
									->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
									->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
									->select('appform.*', 'trans_status.trns_desc', 'apptype.aptdesc', 'hfaci_serv_type.*','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'x08.uid')
								->where([
									['appform.draft', '=', 0], 
									['appform.assignedLO', '=', $Cur_useData['cur_user']],
									['appform.hfser_id','<>',null]
								])
								->orderBy('appform.appid','desc')
								->get();
							break;
					}
					// for now fix
					if (count($data) != 0) {
								for ($i=0; $i < count($data); $i++) {
									if (isset($data[$i]->proposedInspectiondate)) {
											/////  Inspection Date & Time
											$time = $data[$i]->proposedInspectiontime;
											$newT = Carbon::parse($time);
											$data[$i]->formattedTimeInspection = $newT->format('g:i A');
											$date = $data[$i]->proposedInspectiondate;
											$newD = Carbon::parse($date); 
											$DateNow = Carbon::parse($Cur_useData['date']);
											$data[$i]->formattedDateInspection = $newD->toFormattedDateString();
											/////  Inspection Date & Time
											/////  Compare Dates
											if ($newD->toDateString() == $Cur_useData['date']) { // Date Today
												$data[$i]->checkInspectDate = 'green';
											}  elseif ( $newD->gt($DateNow) ) { // Overdue
												$data[$i]->checkInspectDate = 'red';
											} else {
												$data[$i]->checkInspectDate = 'black'; // Not Due
											}
											/////  Compare Dates										
									}	
									///// Check Status
									if ($data[$i]->status == 'A') { // APPROVED
										$data[$i]->statColor = 'green';
									} else if ($data[$i]->status == 'FA' || $data[$i]->status == 'FE'  || $data[$i]->status == 'FI'  || $data[$i]->status == 'P'  || $data[$i]->status == 'PP'  ) { // PENDING
										$data[$i]->statColor = 'yellow';
									} else { // REJECTED
										$data[$i]->statColor = 'red';
									}
									///// Check Status
								}
							}
					return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getConCatchFormatted($appid,$displayDone = null)
		{
			$pop = 0;
			$where = [['appid',$appid]];
			// $where = [['appid',$appid],['isfrombackend',$displayDone]];
			$brp = DB::table('con_catch')->where($where)->get();
			$loc = array();
			if(count($brp) > 0){
				foreach ($brp as $key => $value) {
					if(!in_array($value->location, $loc)){
						array_push($loc, $value->location);
					}
				}
			}
			$hosLevel = DB::table('facilitytyp')->where([['hgpid',6],['servtype_id',1]])->get();

			return [$brp,$loc,$hosLevel];
		}
		/////// Applicants
		/////// Teams
		public static function getAllTeams() // Get all Teams
		{	
			try  
			{
				$data = DB::table('team')
						->join('region', 'team.rgnid', '=', 'region.rgnid')
						->get();
				return $data;
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function getAllTeamsCon() // Get all Teams
		{	
			try  
			{
				$data = DB::table('team')
						->join('region', 'team.rgnid', '=', 'region.rgnid')
						->where('team.type','con')
						->get();
				return $data;
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getUsersForCon(Request $request) // Get all Teams
		{	
			try  
			{
				$data = DB::table('x08')
						->where('rgnid',$request->rgnid)
						->whereIn('grpid',['CM','LO','RLO','DC'])
						// ->where('grpid','!=','C')
						// ->where('grpid','=','CM')
						// ->where('grpid','=','LO')
						// ->where('grpid','=','RLO')
						->get();

				return $data;
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public function savePtcAppTeam(Request $request)
		{
			
				try 
				{
					DB::table('appform')->where('appid',$request->appid)->update(['ptcTeam' => $request->team_id]);

					$chk = DB::table('hferc_team')->where('appid',$request->appid)->where('revision',$request->revision)->first();
					if(!is_null($chk)){
						 DB::table('hferc_team')->where('appid',$request->appid)->where('revision',$request->revision)->delete();
					}

					$data = DB::table('ptc_team_members')
					// ->join('x08', 'con_team_members.uid', '=', 'x08.uid')
					->where('ptc_team_members.team_id',$request->team_id)
					->get();


					foreach($data as $m){
						DB::table('hferc_team')->insert(['appid' => $request->appid, 'revision' => $request->revision,'uid' => $m->uid,'pos' => $m->pos,'permittedtoInspect' => 1,'hasInspected' => 0,'ptcm_id' => $m->id]);
						AjaxController::notifyClient($request->appid,$m->uid,41);
						// AjaxController::notifyClient($request->appid,$m->uid,39);
					}


					// hereme
					
					return "DONE";
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return "ERROR";
				}
			
		}

		
		public static function getUsersForPtc(Request $request) // Get all Teams
		{	
			try  
			{
				$data = DB::table('x08')
						->where('rgnid',$request->rgnid)
						->whereIn('grpid',['LO1','LO2','LO4','RLO','NA','DC','01','HFERC','HFSRBLO','LO','LO3','CM'])
						// ->whereIn('grpid',['CM','LO','RLO'])
						// ->where('grpid','!=','C')
						// ->where('grpid','=','CM')
						// ->where('grpid','=','LO')
						// ->where('grpid','=','RLO')
						->get();

				return $data;
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		
		public static function getUsersConteam(Request $request) // Get all Teams
		{	
			try  
			{
				$data = DB::table('con_team_members')
						->join('x08', 'con_team_members.uid', '=', 'x08.uid')
						->where('con_team_members.team_id',$request->team_id)
						->get();

				return $data;
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getUsersPtcteam(Request $request) // Get all Teams
		{	
			try  
			{
				$data = DB::table('ptc_team_members')
						->join('x08', 'ptc_team_members.uid', '=', 'x08.uid')
						->where('ptc_team_members.team_id',$request->team_id)
						->get();

				return $data;
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		
		public static function deleteConTemMem(Request $request) // Get all Teams
		{	
			try  
			{
				
				$getmemT = DB::table('con_team_members')->where('id',$request->id)->first();

				$chk = DB::table('appform')->where('conTeam',$getmemT->team_id)->first();
					
				if(!is_null($chk)){
					$getT =	DB::table('appform')->where('conTeam',$getmemT->team_id)->get();
					
					foreach($getT as $g){
						DB::table('committee_team')->where('appid',$g->appid)->where('uid',$getmemT->uid)->where('pos',$getmemT->pos)->delete();
					}


				}
				
				
				DB::table('con_team_members')->where('id',$request->id)->delete();

				return "DONE";
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function deletePtcTemMem(Request $request) // Get all Teams
		{	
			try  
			{
				
				$getmemT = DB::table('ptc_team_members')->where('id',$request->id)->first();

				$chk = DB::table('appform')->where('ptcTeam',$getmemT->team_id)->first();
					
				if(!is_null($chk)){
					// $getT =	DB::table('appform')->where('ptcTeam',$getmemT->team_id)->get();
					$getT =	DB::table('appform')->join('hferc_team', 'appform.appid', '=',  'hferc_team.appid')
							->where('appform.ptcTeam',$request->team_id)
							->select('appform.appid','hferc_team.revision')
							->groupBy('appform.appid','hferc_team.revision')
							->get();
					
					foreach($getT as $g){
						DB::table('hferc_team')->where('ptcm_id',$request->id)->delete();
						// DB::table('hferc_team')->where('appid',$g->appid)->where('uid',$getmemT->uid)->where('pos',$getmemT->pos)->delete();
					}


				}
				
				
				DB::table('ptc_team_members')->where('id',$request->id)->delete();

				return "DONE";
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		
		public static function updateConTemMem(Request $request) // Get all Teams
		{	
			try  
			{

				$getmemT = DB::table('con_team_members')->where('id',$request->id)->first();


				DB::table('con_team_members')->where('id',$request->id)->update(['pos' => $request->pos]);




				//  $getmemT = DB::table('con_team_members')->where('id',$request->id)->first();

				 $chk = DB::table('appform')->where('conTeam',$getmemT->team_id)->first();
					 
				 if(!is_null($chk)){
					 $getT =	DB::table('appform')->where('conTeam',$getmemT->team_id)->get();
					 
					 foreach($getT as $g){
						DB::table('con_team_members')->where('id',$request->id)->update(['pos' => $request->pos]);
						 DB::table('committee_team')->where('appid',$g->appid)->where('uid',$getmemT->uid)->where('pos',$getmemT->pos)->update(['pos' => $request->pos]);
					 }
 
 
				 }


				return "DONE";
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function updatePtcTemMem(Request $request) // Get all Teams
		{	
			try  
			{

				$getmemT = DB::table('ptc_team_members')->where('id',$request->id)->first();


				DB::table('ptc_team_members')->where('id',$request->id)->update(['pos' => $request->pos]);




				//  $getmemT = DB::table('con_team_members')->where('id',$request->id)->first();

				 $chk = DB::table('appform')->where('ptcTeam',$getmemT->team_id)->first();
					 
				 if(!is_null($chk)){
					//  $getT =	DB::table('appform')->where('conTeam',$getmemT->team_id)->get();
					$getT =	DB::table('appform')->join('hferc_team', 'appform.appid', '=',  'hferc_team.appid')
					->where('appform.ptcTeam',$request->team_id)
					->select('appform.appid','hferc_team.revision')
					// ->groupBy('appform.appid')
					->groupBy('appform.appid','hferc_team.revision')
					->get();
					
					 
					 foreach($getT as $g){
						DB::table('ptc_team_members')->where('id',$request->id)->update(['pos' => $request->pos]);
						 DB::table('hferc_team')
						 ->where('ptcm_id',$request->id)
						 ->update(['pos' => $request->pos]);
						 
						//  DB::table('hferc_team')
						//  ->where('appid',$g->appid)
						//  ->where('uid',$getmemT->uid)
						//  ->where('pos',$getmemT->pos)
						//  ->update(['pos' => $request->pos]);
					 }
 
 
				 }


				return "DONE";
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public function saveConAppTeam(Request $request)
		{
			
				try 
				{
					DB::table('appform')->where('appid',$request->appid)->update(['conTeam' => $request->team_id]);

					$chk = DB::table('committee_team')->where('appid',$request->appid)->first();
					if(!is_null($chk)){
						 DB::table('committee_team')->where('appid',$request->appid)->delete();
					}

					$data = DB::table('con_team_members')
					// ->join('x08', 'con_team_members.uid', '=', 'x08.uid')
					->where('con_team_members.team_id',$request->team_id)
					->get();


					foreach($data as $m){
						DB::table('committee_team')->insert(['appid' => $request->appid,'uid' => $m->uid,'pos' => $m->pos]);
						AjaxController::notifyClient($request->appid,$m->uid,39);
					}


					// hereme
					
					return "DONE";
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return "ERROR";
				}
			
		}

		public static function addconmem(Request $request)
		{
			try {
				
					$mem = json_decode($request->members, true);

					foreach($mem as $m){
						DB::table('con_team_members')->insert(['uid' => $m['uid'],'pos' => $m['pos'], 'team_id' => $request->team_id]);


						$chk = DB::table('appform')->where('conTeam',$request->team_id)->first();
					
						if(!is_null($chk)){
							$getT =	DB::table('appform')->where('conTeam',$request->team_id)->get();
							
							foreach($getT as $g){
								DB::table('committee_team')->insert(['appid' => $g->appid, 'uid' => $m['uid'], 'pos' => $m['pos']]);
							}


						}
						
					}

					



					return 'DONE';
				
			} catch (Exception $e) {
				return $e;
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pfmanageconcomittee');
			}
		}

		public static function addptcmem(Request $request)
		{
			try {
				
					$mem = json_decode($request->members, true);

					foreach($mem as $m){
					// $getId =	DB::table('ptc_team_members')->insert(['uid' => $m['uid'],'pos' => $m['pos'], 'team_id' => $request->team_id]);
					$getId =	DB::table('ptc_team_members')->insertGetId(['uid' => $m['uid'],'pos' => $m['pos'], 'team_id' => $request->team_id]);


						$chk = DB::table('appform')->where('ptcTeam',$request->team_id)->first();
					
						if(!is_null($chk)){
							// $getT =	DB::table('hferc_team')->where('appid',$chk->appid)->groupBy('appid','revision')->get();
							$getT =	DB::table('appform')->join('hferc_team', 'appform.appid', '=',  'hferc_team.appid')
							->where('appform.ptcTeam',$request->team_id)
							->select('appform.appid','hferc_team.revision')
							->groupBy('appform.appid','hferc_team.revision')
							->get();
							
							foreach($getT as $g){
								DB::table('hferc_team')->insert(['revision' => $g->revision,'appid' => $g->appid, 'uid' => $m['uid'], 'pos' => $m['pos'],'permittedtoInspect' => 1,'hasInspected' => 0,'ptcm_id' => $getId]);
							}


						}
						
					}

					



					return 'DONE';
				
			} catch (Exception $e) {
				return $e;
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pfmanageconcomittee');
			}
		}

		public static function isExistonDB($table, $fieldToExclude, $idToExclude, $fields = array(), $data = array(),$stat = true)
		{
			if(count($fields) == count($data)){
				$toDB = array_combine($fields, $data);
				if($stat){
					return DB::table($table)->where($toDB)->whereNotIn($fieldToExclude, [$idToExclude])->get();
				}
				return DB::table($table)->where($toDB)->whereNotIn($fieldToExclude, [$idToExclude])->exists();
			}
			return 'unEqualData';
		}
		public static function saveTeam(Request $request) // Update Team
		{
			try 
			{
				$data = array('teamdesc' => $request->name);
				if (isset($request->seq)) 
				{
					$data['rgnid'] = $request->seq;
				}
				$test = DB::table('team')->where('teamid', '=', $request->id)->update($data);
				if ($test) 
				{
					return 'DONE';
				} 
				else 
				{
					$data = AjaxController::SystemLogs('No data has been updated in team table. (saveTeam)');
			    	return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delTeam(Request $request) // Delete Team
		{
			try 
			{
				$test = DB::table('team')->where('teamid', '=', $request->id)->delete();
				if($test)
				{
					return 'DONE';
				} 
				else 
				{	
					$data = AjaxController::SystemLogs('No data has been deleted in team table. (delTeam)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getMembersInTeam(Request $request)
		{
			try 
			{
				$data = DB::table('x08')
						->join('x07', 'x08.grpid', '=', 'x07.grp_id')
						->where('x08.grpid', '<>', 'C')
						->where('x08.team', '=', $request->id)->get();




				if (count($data) != 0) 
				{
					for ($i=0; $i < count($data) ; $i++) { 
							$x = $data[$i]->mname;
						      	if ($x != "") {
							    	$mid = strtoupper($x[0]);
							    	$mid = $mid.'. ';
					       		 } else {
							    	$mid = ' ';
							 		}
							$data[$i]->wholename = $data[$i]->fname.' '.$mid.''.$data[$i]->lname;
						}
				}
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getMembersInTeamNew(Request $request)
		{
			try 
			{
				$data = DB::table('surv_team')
						->join('surv_team_members', 'surv_team.montid', '=', 'surv_team_members.montid')
						->where('surv_team.montid', '=', $request->id)
						->get();




				if (count($data) != 0) 
				{
					for ($i=0; $i < count($data) ; $i++) { 
							$x = $data[$i]->mname;
						      	if ($x != "") {
							    	$mid = strtoupper($x[0]);
							    	$mid = $mid.'. ';
					       		 } else {
							    	$mid = ' ';
							 		}
							$data[$i]->wholename = $data[$i]->fname.' '.$mid.''.$data[$i]->lname;
						}
				}
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function checkSurvTeam($teamid)
		{
			$employeeData = session('employee_login');

		$chktab =	DB::table('surv_team_members')
			->where('montid',$teamid)
			->where('uid',$employeeData->uid)
			->first();

			$chk = "no";
			if(!is_null($chktab)){
				$chk = "yes";
			}

			return $chk;

		}

public static function checkConmem($appid)
		{
			$employeeData = session('employee_login');

				$chktab =	DB::table('committee_team')
			->where('appid',$appid)
			->where('uid',$employeeData->uid)
			->first();

			$chk = "no";
			if(!is_null($chktab)){
				$chk = "yes";
			}

			return $chk;

		}
		
	public static function checkConmemData($appid)
		{
			$employeeData = session('employee_login');

				$chktab =	DB::table('committee_team')
			->where('appid',$appid)
			->where('uid',$employeeData->uid)
			->first();

			

			return $chktab;

		}


		public static function getMembersInHFERC($appid,$rgn,$order,$revCount)
		{
			$notInclude = array();
			$data = AjaxController::getAllDataEvaluateOne($appid);

			$dataInDB = DB::table('hferc_team')
						->leftjoin('x08','x08.uid', '=','hferc_team.uid')
						->leftjoin('x07', 'x08.grpid', '=', 'x07.grp_id')->select('*')->where([['hferc_team.appid',$appid],['hferc_team.revision',$revCount]])->distinct()->get();
			
			/*if(count($dataInDB) > 0){
				foreach ($dataInDB as $value) {
					if(!in_array($value->uid, $notInclude)){
						array_push($notInclude, $value->uid);
					}
				}
			}
		
			$rgn = FunctionsClientController::isFacilityFor($appid);
			
			switch ($order) {
				case 1:
				// not in list - all users except above
					$data = DB::table('x08')
							->join('x07', 'x08.grpid', '=', 'x07.grp_id')
							//->where([['x08.isBanned',0],['x08.rgnid',$rgn]])
							//->whereIn('x08.grpid',['LO1','LO2','LO4','RLO','NA','DC','01','HFERC','HFSRBLO','LO','LO3','CM'])
							->whereNotIn('x08.uid',$notInclude)
							->get();
					break;
				case 2:
				// in list
					$data = DB::table('x08')
							->leftjoin('x07', 'x08.grpid', '=', 'x07.grp_id')
							->leftjoin('hferc_team','x08.uid','hferc_team.uid')
							//->where([['x08.isBanned',0], ['hferc_team.appid',$appid],['hferc_team.revision',$revCount]])
							//	->where([['x08.isBanned',0],['x08.rgnid',$rgn], ['hferc_team.appid',$appid],['hferc_team.revision',$revCount]])
							//->whereIn('x08.grpid',['LO1','LO2','LO4','RLO','NA','DC','01','HFERC','HFSRBLO','LO','LO3','CM'])
							->whereIn('x08.uid',$notInclude)
							->distinct()
							->get();
					break;	
			}
			
			return $data;*/
			//dd( $dataInDB);
			return $dataInDB;
		}

		public static function getMembersIncommittee($appid,$rgn,$order)
		{
			$notInclude = array();
			$dataInDB = DB::table('committee_team')->select('uid')->where('appid',$appid)->get();
			if(count($dataInDB) > 0){
				foreach ($dataInDB as $value) {
					if(!in_array($value->uid, $notInclude)){
						array_push($notInclude, $value->uid);
					}
				}
			}
			switch ($order) {
				case 1:
					$data = DB::table('x08')
							->join('x07', 'x08.grpid', '=', 'x07.grp_id')
							->where([['x08.grpid', 'CM'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->orWhere([['x08.grpid', 'LO'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->orWhere([['x08.grpid', 'LO1'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->orWhere([['x08.grpid', 'LO2'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->orWhere([['x08.grpid', 'LO3'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->orWhere([['x08.grpid', 'LO4'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->orWhere([['x08.grpid', 'NA'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->orWhere([['x08.grpid', '01'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->orWhere([['x08.grpid', 'RLO'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->orWhere([['x08.grpid', 'DC'],['x08.isBanned',0],['x08.rgnid',$rgn]])
							->whereNotIn('x08.uid',$notInclude)
							->get();
					break;
				case 2:
					$data = DB::table('x08')
							->join('x07', 'x08.grpid', '=', 'x07.grp_id')
							->join('committee_team','x08.uid','committee_team.uid')
							->where([['x08.grpid', 'CM'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->orWhere([['x08.grpid', 'LO'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->orWhere([['x08.grpid', 'LO1'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->orWhere([['x08.grpid', 'LO2'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->orWhere([['x08.grpid', 'LO3'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->orWhere([['x08.grpid', 'LO4'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->orWhere([['x08.grpid', 'NA'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->orWhere([['x08.grpid', '01'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->orWhere([['x08.grpid', 'RLO'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->orWhere([['x08.grpid', 'DC'],['x08.isBanned',0],['x08.rgnid',$rgn], ['committee_team.appid',$appid]])
							->whereIn('x08.uid',$notInclude)
							->get();
					break;
				
			}
			
			return $data;
		}
		public static function getEmployeeWithoutTeam(Request $request)
		{
			try{
				$data = DB::table('x08')
						->join('x07', 'x08.grpid', '=', 'x07.grp_id')
						->where('x08.grpid', '<>', 'C')
						->where('x08.grpid', '<>', 'NA')
						->where('x08.rgnid', '=', $request->rgn)
						->where('x08.team', '=', null)->get();
				if (count($data) != 0) 
				{
					for ($i=0; $i < count($data) ; $i++) { 
							$x = $data[$i]->mname;
						      	if ($x != "") {
							    	$mid = strtoupper($x[0]);
							    	$mid = $mid.'. ';
					       		 } else {
							    	$mid = ' ';
							 		}
							$data[$i]->wholename = $data[$i]->fname.' '.$mid.''.$data[$i]->lname;
						}
				}
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delMemberInTeam(Request $request)
		{
			try 
				{
					$data = array('team' => null);
					$test = DB::table('x08')->where('uid', '=', $request->id)->update($data);
					if ($test) {return 'DONE';}
					else
					{
						AjaxController::SystemLogs('No data has been updated in x08 table. (delMemberInTeam)');
						return 'ERROR';
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e->getMessage());
					return 'ERROR';
				}
		}
		/////// Teams
		/////// Client Announcement
		public static function getAllClientAnnouncement() // Get All Application Type (With Ascending)
		{
			try 
			{
				$data = DB::table('announcement')->orderBy('id', 'asc')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveClientAnnouncement(Request $request) // Update Client Annoucement Type
		{
			try 
			{
			
				 return 'DONE';
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delClientAnnouncement(Request $request) // Delete Client Annoucement Type
		{
			try 
			{
				$test = null;
				if ($test) {
					return 'DONE';
				} else {
					AjaxController::SystemLogs('No data has been deleted on table. ');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Application Type
		public static function getAllApplicationType() // Get All Application Type (With Ascending)
		{
			try 
			{
				$data = DB::table('hfaci_serv_type')->orderBy('hfser_desc', 'asc')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveAppType(Request $request) // Update Application Type
		{
			try 
			{
				$updateData = array('hfser_desc'=>$request->name, 'terms_condi' => $request->terms);

				if ($request->seq != '') { $updateData['seq_num'] = $request->seq;}

				$test = DB::table('hfaci_serv_type')->where('hfser_id', $request->id)->update($updateData);
				return 'DONE';
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delAppType(Request $request) // Delete Application Type
		{
			try 
			{
				$test = DB::table('hfaci_serv_type')->where('hfser_id', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					AjaxController::SystemLogs('No data has been deleted in hfaci_serv_type table. (delAppType)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Application Status
		public static function getAllApplicationStatus() // Get All Application Status
		{
			try 
			{
				$data = DB::table('apptype')->orderBy('apt_seq', 'asc')->get();
				if ($data) {
					for ($i=0; $i < count($data); $i++) { 
						if (isset($data[$i]->apt_reqid)) { // Required
							$test = DB::table('apptype')->where('aptid', '=', $data[$i]->apt_reqid)->first();
							if ($test) {
								$data[$i]->apt_req_name = $test->aptdesc;
							} else {
								$data[$i]->apt_req_name = null;
							}	
						} else {
							$data[$i]->apt_req_name = null;
						}

						if (isset($data[$i]->apt_isUpdateTo)) { // Update
							$test1 = DB::table('apptype')->where('aptid', '=', $data[$i]->apt_isUpdateTo)->first();
							if ($test1) {
								$data[$i]->apt_upd_name = $test1->aptdesc;
							} else {
								$data[$i]->apt_upd_name = null;
							}	
						} else {
							$data[$i]->apt_upd_name = null;
						}
					}
				}
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;	
			}
		}
		public static function getApplicationStatusWithoutRequired()
		{
			try 
			{
				$data = DB::table('apptype')->where('apt_reqid', '=', null)->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;	
			}
		}
		public static function getApplicationStatusWithoutIsUpdate()
		{
			try 
			{
				$data = DB::table('apptype')->where('apt_isUpdateTo', '=', null)->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;	
			}
		}
		public static function saveAppStatus(Request $request) // Update Application Status
		{
			try 
			{
				$updateData = array('aptdesc' => $request->name);
				$test = DB::table('apptype')->where('aptid',$request->id)->update($updateData);
				if ($test) { return 'DONE';} 
				else 
				{
					$data = AjaxController::SystemLogs('No data has been updated in apptype table. (saveAppStatus)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delAppStatus(Request $request) // Delete Application Status
		{
			try 
			{
				$test = DB::table('apptype')->where('aptid', '=', $request->id)->delete();
				if ($test) { return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in apptype table. (delAppStatus)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Application Status
		/////// Class
		public static function getAllClass() // Get All Class
		{
			try 
			{
				$data = DB::table('class')->get();
				if ($data) {
					for ($i=0; $i < count($data) ; $i++) { 
						if ($data[$i]->isSub != null) {
							$test = DB::table('class')->where('classid', '=', $data[$i]->isSub)->first();
							if ($test) {
								$data[$i]->SubName = $test->classname;
							} else {
								$data[$i]->SubName = null;
							}
						} else {
							$data[$i]->SubName = null;
						}
					}
				}
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveClass(Request $request) // Update Class
		{
			try 
			{
				$iSREMARKS = ($request->isRemarks == 1) ? $request->cls : null;
				$updateData = array('classname' => $request->name, 'isSub' => $iSREMARKS);
				$test = DB::table('class')->where('classid',$request->id)->update($updateData);
				if ($test) { return 'DONE';}
				else 
				{
					AjaxController::SystemLogs('No data has been updated in class table. (saveClass)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delClass(Request $request)
		{
			try 
			{
				$test = DB::table('class')->where('classid', '=', $request->id)->delete();
				if ($test) { return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in class table. (delClass)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Class
		/////// Holidays
		public static function getAllHolidays() // Get All Holidays
		{
			try 
			{
				$data = DB::table('holidays')->orderBy('hdy_date', 'asc')->get();
				if ($data) {
					for ($i=0; $i < count($data) ; $i++) { 
						$date = $data[$i]->hdy_date;
						$newD = Carbon::parse($date);
						$data[$i]->formattedDate = $newD->toFormattedDateString();
					}
				}
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getHolidaysEvent(Request $request, $selected) // Get Filtered Holidays for Calendar
		{
			try 
			{
				$selectedData = ($selected == '2') ? 'Special' : 'Regular';
				$data = DB::table('holidays')->where('hdy_typ', '=', $selectedData)->get();
				if ($data) {
					for ($i=0; $i < count($data); $i++) { 
						$data[$i]->title = $data[$i]->hdy_desc;
						$data[$i]->start = $data[$i]->hdy_date;
					}
					return $data;
				}
				return $data;
			} 
			catch (Exception $e)
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveHoliday(Request $request) // Update Holiday
		{
			try 
			{
				$data = array('hdy_desc'=>$request->desc);
				if ($request->typ != '') {
					$data['hdy_typ'] = $request->typ;
				}
				if ($request->dt) {
					$data['hdy_date'] = $request->dt;
				}
				$test = DB::table('holidays')->where('hdy_id', '=', $request->code)->update($data);
				if ($test) {return 'DONE';} 
				else 
				{
					$data = AjaxController::SystemLogs('No data has been updated in holidays table. (saveHoliday)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delHoliday(Request $request) // Delete Holiday
		{
			try 
			{
				$test = DB::table('holidays')->where('hdy_id', '=', $request->id)->delete();
				if ($test) { return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in holidays table. (delHoliday)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Holidays
		/////// Ownership
		public static function getAllOwnership() // Get All Ownership
		{
			try 
			{
				$data = DB::table('ownership')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function saveOwnership(Request $request) // Update Ownership
		{
			try 
			{
				$updateData = array('ocdesc'=>$request->name);
				$test = DB::table('ownership')->where('ocid',$request->id)->update($updateData);
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been ownership in class table. (saveOwnership)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delOwnership(Request $request)
		{
			try 
			{
				$test = DB::table('ownership')->where('ocid', '=', $request->id)->delete();
				if ($test) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in ownership table. (delOwnership)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Ownership
		/////// Functions
		public static function getAllFunctions()
		{
			try 
			{
				$data = DB::table('funcapf')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;	
			}
		}
		public static function saveFunctions(Request $request)
		{
			try 
			{
				$updateData = array('funcdesc' => $request->name);
				$test = DB::table('funcapf')->where('funcid',$request->id)->update($updateData);
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in funcapf table. (saveFunctions)');
					return 'ERROR';
				}	
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delFunctions(Request $request)
		{
			try 
			{
				$test = DB::table('funcapf')->where('funcid', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in funcapf table. (delFunctions)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Functions
		/////// Facility
		public static function getAllFacilityGroup()
		{
			try 
			{
				$data = DB::table('hfaci_grp')
				->orderBy('hgpdesc', 'asc')
				->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function getForAmbulanceList($tojson = false, $select = '*')
		{
			try 
			{
				$data = DB::table('forAmbulance')
				->join('hfaci_grp','hfaci_grp.hgpid','forAmbulance.hgpid')
				->select($select)
				->get();
				
				return ($tojson ? json_encode($data) : $data);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function facilityPayment()
		{
			try {
				return DB::table('chg_applyto')->get();
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function applyLocation()
		{
			try {
				return DB::table('chg_faci')->get();
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function saveFacility(Request $request) // Update facility
		{
			try 
			{
				$updateData = array('hgpdesc' => $request->name, 
									'ftr_msg_ptc' => $request->edit_ptc,
									'ftr_msg_lto' => $request->edit_lto,
									'ftr_msg_coa' => $request->edit_coa,
									'ftr_msg_ato' => $request->edit_ato,
									'ftr_msg_cor' => $request->edit_cor,
									'status' => $request->edit_status
							);

				$test = DB::table('hfaci_grp')->where('hgpid',$request->id)->update($updateData);

				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in hfaci_grp table. (saveFacility)');
					return 'ERROR';
				}	
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delFacility(Request $request)
		{
			try 
			{
				$test = DB::table('hfaci_grp')->where('hgpid', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in hfaci_grp table. (delFacility)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Facility
		/////// Services
	//almost the same with FunctionsClientController: getAncillaryServices()
		public static function getAllServices() // Get All Facility Filtered
		{
			try 
			{
				$data = DB::table('facilitytyp')
						->leftJoin('hfaci_grp','hfaci_grp.hgpid','facilitytyp.hgpid')
						->leftJoin('serv_type','serv_type.servtype_id','facilitytyp.servtype_id')
						->select('facilitytyp.*','hfaci_grp.hgpid','hfaci_grp.hgpdesc','serv_type.servtype_id','serv_type.facid as servid','serv_type.grp_name','serv_type.seq','serv_type.anc_name','assignrgn')
						->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveService(Request $request) // Update service
		{
			try 
			{
				$updateData = array('facname' => $request->name, 'hgpid'=>$request->faci, 'assignrgn' => $request->office, 'status' => $request->status);
				
				$test = DB::table('facilitytyp')->where('facid',$request->id)->update($updateData);

				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in facilitytyp table. (saveService)');
					return 'ERROR';
				}	
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delService(Request $request)
		{
			try 
			{
				$test = DB::table('facilitytyp')->where('facid', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in facilitytyp table. (delService)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Services
		/////// Institutional Character
		public static function getAllInstitutionalCharacter() // Get All Data for Institutional Character
		{
			try 
			{
				$data = DB::table('facmode')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function saveInstitutionalCharacter(Request $request)
		{
			try 
			{
				$data = array('facmdesc'=>$request->name);
				$test = DB::table('facmode')->where('facmid', '=', $request->id)->update($data);
				if ($test) 
				{
					return 'DONE';
				} 
				else
				{
					AjaxController::SystemLogs('No data has been updated in facmode table. (saveInstitutionalCharacter)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delInstitutionalCharacter(Request $request)
		{
			try 
			{
				$test = DB::table('facmode')->where('facmid', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} 
				else {
					AjaxController::SystemLogs('No data has been updated in facmode table. (saveInstitutionalCharacter)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Institutional Character
		/////// Manage Facility
		public static function getAllManageFacility(Request $request) // Get All Data for Manage Facilities
		{
			try 
			{
				$data = DB::table('type_facility')
							->join('hfaci_serv_type', 'type_facility.hfser_id','=','hfaci_serv_type.hfser_id')
							->join('hfaci_grp', 'type_facility.facid', '=', 'hfaci_grp.hgpid')
							->select('type_facility.*', 'hfaci_serv_type.*', 'hfaci_grp.*')
							->where('type_facility.hfser_id', '=', $request->hfser_id)
							->get();
				if (count($data) != 0) {
					return $data;
				} else {
					return "NONE";
				}
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getAllFacilities(Request $request) // Get All Data for Manage Facilities
		{
			try 
			{
				$data = DB::table('facl_grp')
							->join('hfaci_serv_type', 'facl_grp.hfser_id','=','hfaci_serv_type.hfser_id')
							->join('hfaci_grp', 'facl_grp.hgpid', '=', 'hfaci_grp.hgpid')
							->select('facl_grp.*', 'hfaci_serv_type.*', 'hfaci_grp.*')
							->where('facl_grp.hfser_id', '=', $request->hfser_id)
							->get();
				if (count($data) != 0) {
					return $data;
				} else {
					return "NONE";
				}
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllPaymentLocation(Request $request) // Get All Data for Manage Facilities
		{
			try 
			{
				$data = DB::table('chg_loc')
							->join('chg_faci','chg_loc.paymentLoc','chg_faci.applylocid')
							->join('chg_applyto','chg_loc.applyLoc','chg_applyto.applytoid')
							->join('facilitytyp','chg_loc.hgpid','facilitytyp.facid')
							->where('chg_loc.hfser_id', '=', $request->hfser_id)
							->get();
				if (count($data) != 0) {
					return $data;
				} else {
					return "NONE";
				}
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delManageFacility(Request $request) // Delete Mange Facility with its Requirements
		{
			try 
			{
				$test = DB::table('type_facility')->where('tyf_id', '=', $request->id)->delete();
				$test1 = DB::table('facility_requirements')->where('typ_id', '=', $request->id)->delete();
				if ($test) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in type_facility and facility_requirements tables. (delManageFacility)');
					return 'ERROR';	
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delFacilities(Request $request) // Delete Mange Facility with its Requirements
		{
			try 
			{
				$test = DB::table('facl_grp')->where('id', '=', $request->id)->delete();
				if ($test) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in facl_grp');
					return 'ERROR';	
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function delFacilitiesWithOthers(Request $request) // Delete Mange Facility with its Requirements
		{
			try 
			{
				$test = DB::table('chg_loc')->where('id', '=', $request->id)->delete();
				if ($test) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in chg_loc');
					return 'ERROR';	
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getFacilitiesOneAppType(Request $request) 
		{
			try 
			{
				$data = DB::table('type_facility')->join('hfaci_grp', 'type_facility.facid', '=', 'hfaci_grp.hgpid')->where('type_facility.hfser_id', '=', $request->id)->orderBy('hfaci_grp.hgpdesc', 'asc')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getServicesOneFacility(Request $request)
		{
			// herehere
			try 
			{
				$test = ($request->part_id != null) ? $request->part_id : 1;
				$data = DB::table('serv_chg')
						->leftJoin('facmode', 'serv_chg.facmid', '=', 'facmode.facmid')
						->leftJoin('facilitytyp', 'serv_chg.facid', '=', 'facilitytyp.facid')
						->leftJoin('hfaci_serv_type', 'hfaci_serv_type.hfser_id', '=', 'serv_chg.hfser_id')
						->leftJoin('chg_app', 'serv_chg.chgapp_id', '=', 'chg_app.chgapp_id')
						->leftJoin('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
						->where('serv_chg.hfser_id', '=', $request->id)
						->get();
				// $data = DB::table('facilitytyp')->where(/*[[*/'hgpid', '=', $request->id/*], ['part_id', '=', $test]]*/)->get();
				// dd($data);
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getServicesOneFacility2(Request $request)
		{
			try
			{
				$data = DB::table('facilitytyp')->join('hfaci_grp', 'facilitytyp.hgpid', '=', 'hfaci_grp.hgpid')
							->where('hfaci_grp.hgpid', '=', $request->id)
							->get();
				return $data;
			}
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Manage Facility
		/////// Manage Requirements
		public static function getRequirementsFiltered(Request $request) // Get All Requirements (Filtered by Application Type)
		{
			try 
			{
				$Requirements = DB::table('facility_requirements')
							->join('upload','facility_requirements.upid','=','upload.upid')
							->select('facility_requirements.*','upload.*')
							->where('facility_requirements.typ_id', '=', $request->tyf_id)
							->get();

				if (count($Requirements) != 0) { return $Requirements;} 
				else { return "NONE";}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delRequirements(Request $request) // Delete Requirements
		{
			try 
			{
				$test = DB::table('facility_requirements')->where('fr_id', '=', $request->id)->delete();
				if ($test) { return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in facility_requirements table. (delRequirements)');
					return 'ERROR';	
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Manage Requirements
		/////// Transaction Status
		public static function getAllTransactionStatus() // Get All Transaction Status
		{
			try 
			{
				$data = DB::table('trans_status')->get();
				if (isset($data)) 
				{
					for ($i=0; $i < count($data) ; $i++) 
						{ 
							
							switch ($data[$i]->canapply) {
								case 0:
									$data[$i]->apply = 'Pending';
									break;
								case 1:
									$data[$i]->apply = 'Yes';
									break;
								case 2:
									$data[$i]->apply = 'No';
									break;
								default:
									$data[$i]->apply = '';
									break;
							}
						}	
				}
				return $data;

			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveTransactionStatus(Request $request) // Update Transaction Status
		{
			try 
			{
				$data = array('trns_desc'=>$request->name,'allowedpayment'=>$request->allow, 'canapply' => $request->apply,'allowedlegend' => $request->legend);
				// return $request->all();
				if($request->legend == 1){
					$data['color'] = $request->color;
				}
				    $test = DB::table('trans_status')->where('trns_id', '=', $request->id)->update($data);
				    if ($test) { return 'DONE';} 
				    else {
				    	AjaxController::SystemLogs('No data has been updated in trans_status table. (saveTransactionStatus)');
				    	return 'ERROR';
				    }
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delTransactionStatus(Request $request)
		{
			try 
			{
				$test = DB::table('trans_status')->where('trns_id', '=', $request->id)->delete();
				if ($test) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in trans_status table. (delTransactionStatus)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Transaction Status
		/////// Upload
		public static function getAllUploads() // Get All Uploads
		{
			try 
			{
				$data = DB::table('upload')->orderBy('updesc', 'asc')->get();
				return $data;	
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveUpload(Request $request) // Update Upload
		{
			try 
			{
				$updateData = array('updesc'=>$request->name, 'isRequired' => $request->isRequiredNow, 'office' => $request->office);
				$test = DB::table('upload')->where('upid',$request->id)->update($updateData);
				if ($test) { return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in upload table. (saveUpload)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delUpload(Request $request) // Delete Upload
		{
			try 
			{
				$test = DB::table('upload')->where('upid', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in upload table. (delUpload)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Upload
		/////// Department
		public static function getAllDepartments() // Get All Departments
		{
			try 
			{
				$data = DB::table('department')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveDepartment(Request $request) // Update Department
		{
			try 
			{
				$updateData = array('depname'=>$request->name);
				$test = DB::table('department')->where('depid',$request->id)->update($updateData);
				if ($test) { return 'DONE';	} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in department table. (saveDepartment)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delDepartment(Request $request)
		{
			try 
			{
				$test = DB::table('department')->where('depid', '=', $request->id)->delete();
				if ($test) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in department table. (delDepartment)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Department
		/////// Section
		public static function getAllSections()
		{
			try 
			{
				$data = DB::table('section')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveSection(Request $request) // Update Section
		{
			try 
			{
				$updateData = array('secname'=>$request->name);
				$test = DB::table('section')->where('secid', $request->id)->update($updateData);
				if ($test) { return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in section table. (saveSection)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function delSection(Request $request) // Delete Section
		{
			try 
			{
				$test = DB::table('section')->where('secid', '=', $request->id)->delete();
				if ($test) { return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in section table. (delSection)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Section
		/////// Work
		public static function getAllWorks() // Get All Works
		{
			try 
			{
				$data = DB::table('pwork')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveWork(Request $request) // Update Work
		{
			try 
			{
				$updateData = array('pworkname'=>$request->name);
				$test = DB::table('pwork')->where('pworkid', $request->id)->update($updateData);
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been updated in pwork table. (saveWork)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delWork(Request $request)
		{
			try 
			{
				$test = DB::table('pwork')->where('pworkid', '=', $request->id)->delete();
				if ($test) { return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in pwork table. (delWork)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Work
		/////// Position
		public static function getAllPositions()
		{
			try 
			{
				$data = DB::table('position')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function savePosition(Request $request)
		{
			try 
			{

				$updateData = array(
					'groupRequired' => intval($request->req),
					'posname'=>$request->name,
				);

				$test = DB::table('position')->where('posid', $request->id)->update($updateData);

				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been updated in position table. (savePosition)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delPosition(Request $request)
		{
			try 
			{
				$test = DB::table('position')->where('posid', '=', $request->id)->delete();
				if ($test) { return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in position table. (delWork)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Position
		/////// Work Status
		public static function getAllWorkStatus() // Get All Work Status
		{
			try 
			{
				$data = DB::table('pwork_status')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveWorkStatus(Request $request) // Update Work Status
		{
			try 
			{
				$updateData = array('pworksname'=>$request->name);
				$test = DB::table('pwork_status')->where('pworksid', $request->id)->update($updateData);
				if ($test) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been updated in pwork_status table. (saveWorkStatus)');
					return 'ERROR'; 
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delWorkStatus(Request $request) // Delete Work Status
		{
			try 
			{
				$test = DB::table('pwork_status')->where('pworksid', '=', $request->id)->delete();
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been deleted in pwork_status table. (delWorkStatus)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Work Status
		/////// License Type
		public static function getAllLicenseType() // Get All License Type
		{
			try 
			{
				$data = DB::table('plicensetype')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveLicenseType(Request $request) // Update License Type
		{
			try 
			{
				$updateData = array('pldesc'=>$request->name);
				$test = DB::table('plicensetype')->where('plid',$request->id)->update($updateData);
				if ($test) { return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been ownership in plicensetype table. (saveLicenseType)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delLicenseType(Request $request) // Delete License Type
		{
			try 
			{
				$test = DB::table('plicensetype')->where('plid', '=', $request->id)->delete();
				if ($test) { return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in plicensetype table. (delLicenseType)');
					return 'ERROR';
				}			
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// License Type
		/////// Training
		public static function getAllTrainings() // Get All Trainings
		{
			try 
			{
				$data =  DB::table('ptrainings_trainingtype')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveTraining(Request $request) // Update Trainings
		{
			try 
			{
				$updateData = array('ptdesc'=>$request->name);
				$test = DB::table('ptrainings_trainingtype')->where('tt_id',$request->id)->update($updateData);
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been ownership in ptrainings_trainingtype table. (saveTraining)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delTraining(Request $request)
		{
			try 
			{
				$test = DB::table('ptrainings_trainingtype')->where('tt_id', '=', $request->id)->delete();
				if ($test) {
					return 'DONE';
				} else {
					AjaxController::SystemLogs('No data has been deleted in ptrainings_trainingtype table. (delTraining)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Training
		/////// Regions
		public static function getAllRegion($hasConditionFlag = false) // Get all Region
		{
			try 
			{
				$data = DB::table('region')->get();
				if($hasConditionFlag && self::getCurrentUserAllData()['cur_user'] != 'ADMIN'){
					foreach ($data as $key => $value) {
						if($value->rgnid != self::getCurrentUserAllData()['rgnid']){
							unset($data[$key]);
						}
					}
				}
				return $data;	
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getAllRegionGen($hasConditionFlag = false) // Get all Region
		{
			try 
			{
				$data = DB::table('region')->get();
				// if($hasConditionFlag && self::getCurrentUserAllData()['cur_user'] != 'ADMIN' && self::getCurrentUserAllData()['cur_user'] != 'DC'){
					foreach ($data as $key => $value) {
						if($value->rgnid != self::getCurrentUserAllData()['rgnid']){
							unset($data[$key]);
						}
					}
				// }
				return $data;	
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllBranch($sel) // Get all Region
		{
			try 
			{
				$rec = array();
				$records = DB::table('branch')->select('regionid')->get();
				foreach ($records as $key) {
					if(!in_array($key->regionid, $rec)){
						array_push($rec, $key->regionid);
					}
				}

				if($sel == 1){
					$data = DB::table('region')->leftJoin('branch','region.rgnid','branch.regionid')->whereNotIn('rgnid',$rec)->get();
				} else {
					$data = DB::table('branch')->leftJoin('region','branch.regionid','region.rgnid')->get();
				}
				return $data;	
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveRegion(Request $request) // Update Region
		{
			try 
			{
				$updateData = array(
					'rgn_desc' => $request->name,
					/*'director' => $request->director, */
					'office' => $request->office,
					'address' => $request->address,
					'iso_desc' => $request->iso_desc,
					'sort' => $request->director
				);
				$test = DB::table('region')->where('rgnid',$request->id)->update($updateData);
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been updated in region table. (saveRegion)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delRegion(Request $request)
		{
			try 
			{
				$test = DB::table('region')->where('rgnid', '=', $request->id)->delete();
				if ($test) {return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been deleted in region table. (delRegion)');
					return 'ERROR';
				}
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Regions
		/////// Provinces
		public static function getAllProvince() // Get All Provinces
		{
			try 
			{
				$data = DB::table('province')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveProvince(Request $request) // Update Province
		{
			try 
			{
				$updateData = array('provname' => $request->name);
				$test = DB::table('province')->where('provid',$request->id)->update($updateData);
				if ($test) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been updated in province table. (saveProvince)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delProvince(Request $request)
		{
			try 
			{
				$test = DB::table('province')->where('provid', '=', $request->id)->delete();
				if ($test) {return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in province table. (delProvince)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Provinces
		/////// City/Municipality
		public static function getAllCityMunicipality() // Get All City/Municipalities
		{
			try 
			{
				$data = DB::table('city_muni')->get();
				return $data;
			} 
			catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveCityMunicipality(Request $request) // Update City/Municipality
		{
			try 
			{
				$updateData = array('cmname'=>$request->name);
				$test = DB::table('city_muni')->where('cmid',$request->id)->update($updateData);
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in city_muni table. (saveCityMunicipality)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delcitymunicipality(Request $request) // Delete City/Municipality
		{
			try 
			{
				$test = DB::table('city_muni')->where('cmid', '=', $request->id)->delete();
				if ($test) {return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in city_muni table. (delcitymunicipality)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		/////// City/Municipality
		/////// Barangay
		public static function getAllBarangay() // Get All Barangay
		{
			try 
			{
				$data = DB::table('barangay')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getBarangayFiltered(Request $request) // Get All Barangay under selected City/Municipality
		{
			try 
			{
				$data = DB::table('barangay')->where('cmid',$request->id)->get();
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getBarangayFiltered1(Request $request, $cmid) // Get All Barangay under selected City/Municipality
		{
			try 
			{
				$data = DB::table('barangay')->where('cmid',$cmid)->get();
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveBarangay(Request $request) // Update Barangay
		{
			try 
			{
				$updateData = array('brgyname'=>$request->name);
				$test = DB::table('barangay')->where('brgyid',$request->id)->update($updateData);
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been updated in barangay table. (saveBarangay)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delBarangay(Request $request) // Delete Barangay
		{
			try 
			{
				$test = DB::table('barangay')->where('brgyid', '=', $request->id)->delete();
				if ($test) {return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in barangay table. (delBarangay)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Barangay
		/////// Order of Payment
		public static function getAllOrderOfPayment()
		{
			try 
			{
				$data = DB::table('orderofpayment')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveOrderOfPayment(Request $request) // Update Order of Payment
		{
			try 
			{
				$updateData = array('oop_desc'=>$request->name);
				$test = DB::table('orderofpayment')->where('oop_id',$request->id)->update($updateData);
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been updated in orderofpayment table. (saveOrderOfPayment)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		

		public static function saveSurcharge(Request $request) // Update Order of Payment
		{
			try 
			{
				$updateData = array(
					'description'=>$request->desc,
					'percentage'=>$request->percentage * -1,
					'date_start'=>$request->date_start,
					'date_end'=>$request->date_end,
					'type'=>$request->type,
					'status'=>$request->status,
				);

				$test = DB::table('application_discount')->where('id',$request->id)->update($updateData);
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been updated.');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}


		public static function saveDiscount(Request $request) // Update Order of Payment
		{
			try 
			{
				$updateData = array(
					'description'=>$request->desc,
					'percentage'=>$request->percentage,
					'date_start'=>$request->date_start,
					'date_end'=>$request->date_end,
					'type'=>$request->type,
					'status'=>$request->status,
				);

				$test = DB::table('application_discount')->where('id',$request->id)->update($updateData);
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been updated in application_discount table. (saveDiscount)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		
		public static function saveProfession(Request $request) // Update Order of Payment
		{
			try 
			{
				$updateData = array(
					'description'=>$request->description,
				);

				$test = DB::table('profession')->where('id',$request->id)->update($updateData);
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been updated in profession table. (saveDiscount)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}



		public static function delOrderOfPayment(Request $request) // Delete Order of Payment
		{
			try 
			{
				$test = DB::table('orderofpayment')->where('oop_id', '=', $request->id)->delete();
				if ($test) {return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in orderofpayment table. (delOrderOfPayment)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function delSurcharge(Request $request) // Delete Order of Payment
		{
			try 
			{
				$test = DB::table('application_discount')->where('id', '=', $request->id)->delete();
				if ($test) {return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted.');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function delDiscount(Request $request) // Delete Order of Payment
		{
			try 
			{
				$test = DB::table('application_discount')->where('id', '=', $request->id)->delete();
				if ($test) {return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in application discount table. (delDiscount)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function delProfession(Request $request) // Delete Order of Payment
		{
			try 
			{
				$test = DB::table('profession')->where('id', '=', $request->id)->delete();
				if ($test) {return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in Profession table. (delDiscount)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Order of Payment
		/////// Payment Category
		public static function getAllCategory() // Get All Category
		{
			try 
			{
				$data = DB::table('category')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveCategory(Request $request) // update Category
		{
			try 
			{
				$data = array('cat_desc'=>$request->name);
				if ($request->type != '') 
				{
					$data['cat_type'] = $request->type;
				}
				$test = DB::table('category')->where('cat_id', '=', $request->id)->update($data);
				if ($test) { return 'DONE'; } 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in category table. (saveCategory)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delCategory(Request $request) // Delete Category
		{
			try 
			{
				$test = DB::table('category')->where('cat_id', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in category table. (delCategory)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Payment Category 
		/////// Charges
		public static function getAllChargesWithCategory() // Get All Charges (with Category)
		{
			try 
			{
				$data = DB::table('charges')->join('category', 'charges.cat_id', '=', 'category.cat_id')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllChargeFees() // Get All Charges (with Category)
		{
			try 
			{
				$data = DB::table('chargefees')
				//->join('category', 'charges.cat_id', '=', 'category.cat_id')
				->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllCharges() // Get All Charges
		{
			try 
			{
				$data = DB::table('charges')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function saveCharge(Request $request) // Update Charge
		{
			try 
			{
				try {
					$updateData = array('chg_desc'=>$request->desc,'chg_exp'=>$request->exp,'chg_rmks'=>$request->rmk, 'fprevision' => $request->revision, 'hgpid' => $request->hgpid);
					$test = DB::table('charges')->where('chg_code', $request->code)->update($updateData);
					if ($test) { return 'DONE';} 
					else {
						dd($test );
						AjaxController::SystemLogs('No data has been modified in charges table. (saveCharge)');
						return 'ERROR';
					}
				} catch (Exception $e) {
					return $e;
				}
				
			} 
			catch (Exception $e) 
			{
				dd($e);
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delCharge(Request $request) // Delete Charge
		{
			try 
			{
				$test = DB::table('charges')->where('chg_code', '=', $request->id)->delete();
				if ($test) {return 'DONE';}
				else {
					AjaxController::SystemLogs('No data has been deleted in charges table. (delCharge)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Charges
		/////// Manage Charges
		public static function getAllManageCharge() // Get All Data for Manage Charges
		{
			try 
			{
				$data = $data = DB::table('chg_app')
								->join('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
								->join('orderofpayment', 'chg_app.oop_id', '=', 'orderofpayment.oop_id')
								->join('apptype', 'chg_app.aptid', '=', 'apptype.aptid')
								->leftJoin('hfaci_serv_type', 'hfaci_serv_type.hfser_id', '=', 'chg_app.hfser_id')
								// ->join('chg_app', 'chg_oop.chgapp_id', '=', 'chg_app.chgapp_id')
								// ->where('chg_oop.oop_id', '=', $request->id)
								->orderBy('chg_app.oop_id','asc')
								->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function ManageChargesOOPFiltered(Request $request) // Get all manage charges filtered by order of payment
		{
			try 
			{
				$data = DB::table('chg_app')
					->join('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
					->join('orderofpayment', 'chg_app.oop_id', '=', 'orderofpayment.oop_id')
					// ->join('chg_app', 'chg_app.chgapp_id', '=', 'chg_app.chgapp_id')
					->join('category', 'charges.cat_id', '=', 'category.cat_id')
					->join('apptype', 'chg_app.aptid', '=', 'apptype.aptid')
					->leftJoin('hfaci_serv_type', 'chg_app.hfser_id', '=', 'hfaci_serv_type.hfser_id')
					//->where('chg_app.oop_id', '=', $request->id)
					->orderBy('chg_app.chgopp_seq','asc')
					->get();
				if ($data) { return response()->json(['data'=>$data,'TotalNumber'=>count($data)]);} 
				else {
					AjaxController::SystemLogs('No data has been fetch from chg_app table. (ManageChargesOOPFiltered)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveManageChargesAmount(Request $request) // Update Amount
		{
			try 
			{
				$data = array('amt'=>$request->amt,'remarks'=> $request->rmk);
				$test = DB::table('chg_app')->where('chgapp_id','=', $request->id)->update($data);
				return 'DONE';
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delManagCharges(Request $request) // Delete Manage Charges
		{
			try 
			{
				$data = DB::table('chg_app')->where('chgapp_id', '=', $request->id)->first();
				$test1 = DB::table('chg_app')->where('chgapp_id','=', $request->id)->delete();
				$data2 = DB::table('chg_app')->where('oop_id', '=', $request->oop_id)->orderBy('chgopp_seq', 'asc')->get();

				for ($i=0,$s=1; $i < count($data2); $i++,$s++) { 
					DB::table('chg_app')->where('chgapp_id', '=', $data2[$i]->chgapp_id)->update(['chgopp_seq'=>$s]);
				}
				if ($test1) {return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in chg_oop and chg_app tables. (delManagCharges)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveManageChargesRearrange(Request $request)
		{
			try 
			{
				$newSeq = null;
				if ($request->type == 'up') {
					$newSeq = $request->seq_num - 1;
				} else if ($request->type == 'down' ) {
					$newSeq = $request->seq_num + 1;
				}
				$oldSeq = $request->seq_num;
				$data = DB::table('chg_app')->where([['oop_id','=', $request->oop_id],['chgopp_seq', '=', $newSeq]])->first();
				// return dd($data);
				$update = array('chgopp_seq'=>$oldSeq);
				$test1 = DB::table('chg_app')->where('chgapp_id','=',$data->chgapp_id)->update($update);
				$update2 = array('chgopp_seq'=>$newSeq);
				$test2 = DB::table('chg_app')->where('chgapp_id','=',$request->chgopp_id)->update($update2);
				if ($test1 && $test2) {return 'DONE';} 
				else {
					$data = AjaxController::SystemLogs('No data has been modfied in chg_app table. (saveManageChargesRearrange)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}		
		/////// Manage Charges
		/////// Mode of Payment
		public static function getAllModeOfPayment() // Get All Mode of Payment
		{
			try 
			{
				$data = DB::table('charges')->where('cat_id', '=', 'PMT')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllUACS()
		{
			try 
			{
				$data = DB::table('m04')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function FDACharges()
		{
			try 
			{
				$data = DB::table('fdarange')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function FDAXray()
		{
			try 
			{
				$data = DB::table('fdaRange')
				->leftJoin('apptype','fdaRange.type','apptype.aptid')
				->select('fdaRange.id','fdaRange.rangeFrom','fdaRange.rangeTo','fdaRange.price','fdaRange.type','apptype.aptid','apptype.aptdesc')
				->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}


		public static function saveModeOfPayment(Request $request) // Update Mode of Payment
		{
			try 
			{
				$data = array('chg_desc'=>$request->name, 'forWhom' => $request->forWhom);
				$test = DB::table('charges')->where('chg_code', '=', $request->id)->update($data);
				if ($test) { return 'DONE';} 
			    else {
			    	AjaxController::SystemLogs('No data has been updated in charges table. (saveModeOfPayment)');
			    	return 'ERROR';
			    }
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Mode of Payment
		/////// Default Payment
		public static function getAllDefaultPayment()
		{
			try 
			{
				$data = DB::table('facoop')
							->join('chg_app', 'facoop.chgapp_id', '=', 'chg_app.chgapp_id')
							->join('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
							->join('hfaci_grp', 'facoop.facid', '=', 'hfaci_grp.hgpid')
							->join('orderofpayment', 'facoop.oop_id', '=', 'orderofpayment.oop_id')
							->join('hfaci_serv_type', 'facoop.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							->join('apptype', 'facoop.aptid', '=', 'apptype.aptid')
							->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function getAllPaymentWithCharges()
		{
			try 
			{
				$data = DB::table('chg_app')
						->join('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
						->join('category', 'charges.cat_id', '=', 'category.cat_id')
						->where('category.cat_id', '=', 'PMT')
						->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;	
			}
		}
		public static function delDefaultPayment(Request $request)
		{
			try 
			{
				$test = DB::table('facoop')->where('id', '=', $request->id)->delete();
				if ($test){ return 'DONE';} 
				else {	
					AjaxController::SystemLogs('No data has been deleted in facoop table. (delDefaultPayment)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Default Payment
		/////// Service Charges
		public static function getServiceCharges(Request $request)
		{
			// herehere
			try 
			{
				$data = DB::table('serv_chg')
							->leftJoin('facilitytyp', 'serv_chg.facid', '=', 'facilitytyp.facid')
							->leftJoin('chg_app', 'serv_chg.chgapp_id', '=', 'chg_app.chgapp_id')
							->leftJoin('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
							->where('serv_chg.facid', '=', $request->id)
							->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delServiceCharges(Request $request) 
		{
			try 
			{
				$test = DB::table('serv_chg')->where('id', '=', $request->id)->delete();
				if ($test){ return 'DONE';} 
				else {	
					AjaxController::SystemLogs('No data has been deleted in serv_chg table. (delServiceCharges)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Service Charges
		/////// Assessment Category
		public static function getAllAssessmentCategory() // Get All Assessment Category
		{
			try 
			{
				$data = DB::table('cat_assess')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function saveAssessmentCategory(Request $request) // Update Assessment Category
		{
			try 
			{
				$data = array('categorydesc' => $request->name);
				$test = DB::table('cat_assess')->where('caid', '=', $request->id)->update($data);
				if ($test) { return 'DONE'; } 
				else {
					AjaxController::SystemLogs('No data has been updated in cat_assess table. (saveAssessmentCategory)');
			    	return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delAssessmentCategory(Request $request) // Delete Assessment Category
		{
			try 
			{
				$test = DB::table('cat_assess')->where('caid', '=', $request->id)->delete();
				if ($test){ return 'DONE';} 
				else {	
					AjaxController::SystemLogs('No data has been deleted in cat_assess table. (delAssessmentCategory)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Assessment Category
		/////// Assessment Part
		public static function getAllAssessmentPart() // Get All Assessment Part
		{
			try 
			{
				$data = DB::table('part')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveAssessmentPart(Request $request) // Update Assessment
		{
			try 
			{
				$updateData = array('partdesc'=>$request->name);
				$test = DB::table('part')->where('partid', $request->id)->update($updateData);
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in part table. (saveAssessmentPart)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delAssessmentPart(Request $request) // Delete Assessment Part
		{
			try 
			{
				$test = DB::table('part')->where('partid', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been deleted in part table. (delAssessmentPart)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Assessment Part
		/////// Assessment
		public static function getAllAssessment()
		{
			try 
			{
				$data = DB::table('assessment')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getAllAssessmentJoined() // Get All Assessment Joined
		{
			try 
			{
				$data = DB::table('assessment')
						->join('cat_assess', 'assessment.caid', '=', 'cat_assess.caid')
						->join('hfaci_grp', 'assessment.facid', '=', 'hfaci_grp.hgpid')
						->join('part', 'assessment.partid', '=', 'part.partid')
						->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getAllAssessment2(Request $request)
		{
			try 
			{
				$data = DB::table('assessment')
						->join('cat_assess', 'assessment.caid', '=', 'cat_assess.caid')
						->join('hfaci_grp', 'assessment.facid', '=', 'hfaci_grp.hgpid')
						->join('part', 'assessment.partid', '=', 'part.partid')
						->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getFilteredAssessment(Request $request)
		{
			try 
			{
				switch ($request->selected) {
					case '1': // FAcility
						$data = DB::table('assessment')
							->join('cat_assess', 'assessment.caid', '=', 'cat_assess.caid')
							->join('hfaci_grp', 'assessment.facid', '=', 'hfaci_grp.hgpid')
							->join('part', 'assessment.partid', '=', 'part.partid')
							->where('assessment.facid' , '=', $request->id)
							->get();
						break;
					case '2':
						$data = DB::table('assessment')
							->join('cat_assess', 'assessment.caid', '=', 'cat_assess.caid')
							->join('hfaci_grp', 'assessment.facid', '=', 'hfaci_grp.hgpid')
							->join('part', 'assessment.partid', '=', 'part.partid')
							->where('assessment.partid' , '=', $request->id)
							->get();
						break;
					case '3':
						$data = DB::table('assessment')
							->join('cat_assess', 'assessment.caid', '=', 'cat_assess.caid')
							->join('hfaci_grp', 'assessment.facid', '=', 'hfaci_grp.hgpid')
							->join('part', 'assessment.partid', '=', 'part.partid')
							->where('assessment.caid' , '=', $request->id)
							->get();
						break;
					default:
						$data = 'NODATA';
						break;
				}
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function saveAssessment(Request $request) // Update Assessment
		{
			try 
			{
				$updateData = array('asmt_name'=>$request->name);
				if (isset($request->faci)) { $updateData['facid'] = $request->faci;} 
				if (isset($request->cat)) { $updateData['caid'] = $request->cat;} 
				if (isset($request->part)){ $updateData['partid'] = $request->part;}
				$test = DB::table('assessment')->where('asmt_id', $request->id)->update($updateData);
				if ($test) {return 'DONE';}
				else 
				{
					AjaxController::SystemLogs('No data has been updated in assessment table. (saveAssessment)');
					return 'ERROR';
				}	
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delAssessment(Request $request) // Delete Assessment
		{
			try 
			{
				$test = DB::table('assessment')->where('asmt_id', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in assessment table. (delAssessment)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Assessment
		/////// Assessment 2
		public static function getAllAssement2()
		{
			try 
			{
				$data = DB::table('asmt2')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function saveAssessment2(Request $request)
		{
			try 
			{
				$updateData = array('asmt2_desc' => $request->name, 'asmt2sd_id'=>$request->subDesc, 'asmt2_loc'=>$request->header);
				$test = DB::table('asmt2')->where('asmt2_id', $request->id)->update($updateData);
				if ($test) {return 'DONE';}
				else 
				{
					AjaxController::SystemLogs('No data has been updated in asmt2 table. (saveAssessment2)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delAssessment2(Request $request)
		{
			try 
			{
				$test = DB::table('asmt2')->where('asmt2_id', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in asmt2 table. (delAssessment2)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function dupAssessment2(Request $request)
		{
			try 
			{
				$test = DB::table('asmt2')->where('asmt2_id', '=', $request->id)->get();
				if ($test) {
					return $test;
				} 
				else 
				{
					AjaxController::SystemLogs('No data has been duplicated in asmt2 table. (dupAssessment2	)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getAllHeader()
		{
			try 
			{
				$data = DB::table('asmt2_loc')->orderBy('asmt2l_desc', 'asc')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function getSingleAssessment2(Request $request)
		{
			try 
			{
				$data = DB::table('asmt2_sdsc')->where('asmt2sd_id', $request->id)->first();
				return response()->json($data);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getAllAsmt2(Request $request)
		{
			try
			{
				// $data = DB::table('serv_asmt')
				// 	->join('hfaci_serv_type', 'serv_asmt.hfser_id', '=', 'hfaci_serv_type.hfser_id')
				// 	->join('facilitytyp', 'serv_asmt.facid', '=', 'facilitytyp.facid')
				// 	->join('hfaci_grp', 'facilitytyp.hgpid', '=', 'hfaci_grp.hgpid')
				// 	->join('asmt2', 'serv_asmt.asmt2_id', '=', 'asmt2.asmt2_id')
				// 	->leftJoin('asmt_title', 'serv_asmt.part', '=', 'asmt_title.title_code')
				// 	// ->join('asmt2_sdsc', 'asmt2.asmt2sd_id', '=', 'asmt2_sdsc.asmt2sd_id')
				// 	->join('asmt2_loc', 'asmt2.asmt2_loc', '=', 'asmt2_loc.asmt2l_id')
				// 	->where([['serv_asmt.hfser_id', '=', $request->hfser_id], ['serv_asmt.facid', '=', $request->facid], 
				// 		['serv_asmt.part_id', '=', $request->getAllAsmt2]])
				// 	->orderBy('srvasmt_seq', 'asc')
				// 	->get();
				$data = DB::table('serv_asmt')
					->join('hfaci_serv_type', 'serv_asmt.hfser_id', '=', 'hfaci_serv_type.hfser_id')
					->join('facilitytyp', 'serv_asmt.facid', '=', 'facilitytyp.facid')
					->join('hfaci_grp', 'facilitytyp.hgpid', '=', 'hfaci_grp.hgpid')
					->join('asmt2', 'serv_asmt.asmt2_id', '=', 'asmt2.asmt2_id')
					->leftJoin('asmt_title', 'serv_asmt.part', '=', 'asmt_title.title_code')
					// ->join('asmt2_sdsc', 'asmt2.asmt2sd_id', '=', 'asmt2_sdsc.asmt2sd_id')
					->join('asmt2_loc', 'asmt2.asmt2_loc', '=', 'asmt2_loc.asmt2l_id')
					->where([['serv_asmt.hfser_id', '=', $request->hfser_id], ['serv_asmt.facid', '=', $request->facid], 
						['serv_asmt.part_id', '=', $request->part_id]])
					->orderBy('srvasmt_seq', 'asc')
					->get();
				return $data;
			}
			catch (Exception $e)
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}

		}
		public static function getAssessmentOneFacility(Request $request)
		{
			try 
			{
				$data = DB::table('serv_asmt')
					->join('hfaci_serv_type', 'serv_asmt.hfser_id', '=', 'hfaci_serv_type.hfser_id')
					->join('hfaci_grp', 'serv_asmt.hgpid', '=', 'hfaci_grp.hgpid')
					->join('asmt2', 'serv_asmt.asmt2_id', '=', 'asmt2.asmt2_id')
					->leftJoin('asmt_title', 'serv_asmt.part', '=', 'asmt_title.title_code')
					// ->join('asmt2_sdsc', 'asmt2.asmt2sd_id', '=', 'asmt2_sdsc.asmt2sd_id')
					->join('asmt2_loc', 'asmt2.asmt2_loc', '=', 'asmt2_loc.asmt2l_id')
					->where([['serv_asmt.hfser_id', '=', $request->hfser_id], ['serv_asmt.hgpid', '=', $request->id], ['serv_asmt.facid', '=', null]])
					->orderBy('srvasmt_seq', 'asc')
					->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delMngAsmt2(Request $request)
		{
			try 
			{
				$test = DB::table('serv_asmt')->where('srvasmt_id', '=', $request->id)->delete();
				if ($test) {
					if (isset($request->facid)) {
						$data = DB::table('serv_asmt')->where([['hfser_id', '=', $request->hfser_id], ['facid', '=', $request->facid], ['hgpid', '=', $request->hgpid]])->orderBy('srvasmt_seq', 'asc')->get();
					} else {
						$data = DB::table('serv_asmt')->where([['hfser_id', '=', $request->hfser_id], ['facid', '=', null], ['hgpid', '=', $request->hgpid]])->orderBy('srvasmt_seq', 'asc')->get();
					}

					if (count($data) != 0) {
						$x = 1;
						for ($i=0; $i < count($data); $i++) { 
							DB::table('serv_asmt')->where('srvasmt_id', '=', $data[$i]->srvasmt_id)->update(['srvasmt_seq'=> $x]);
							$x++;
						}
					}
					return 'DONE';
				} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in serv_asmt table. (delMngAsmt2)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function rearrangeManageAssessment(Request $request)
		{
			try 
			{
				$newSeq = null;
				if ($request->type == 'up') {
					$newSeq = $request->seq - 1;
				} else if ($request->type == 'down' ) {
					$newSeq = $request->seq + 1;
				}
				$oldSeq = $request->seq;
				$data = DB::table('serv_asmt')->where([['srvasmt_seq', '=', $newSeq],  ['hfser_id', '=', $request->hfser_id], ['facid', '=', $request->facid]])->first(); // ,['srvasmt_seq', '=', $newSeq], ['hfser_id', '=', $request->hfser_id]]
				// return dd($newSeq);
				$update = array('srvasmt_seq'=>$oldSeq);
				$test1 = DB::table('serv_asmt')->where('srvasmt_id','=',$data->srvasmt_id)->update($update);
				$update2 = array('srvasmt_seq'=>$newSeq);
				$test2 = DB::table('serv_asmt')->where('srvasmt_id','=',$request->id)->update($update2);
				if ($test1 && $test2) {return 'DONE';} 
				else {
					$data = AjaxController::SystemLogs('No data has been modfied in chg_app table. (saveManageChargesRearrange)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Assessment 2 
		/////// Assessment Sub-Description 2 
		public static function getAllSubDescription() //
		{
			try 
			{
				$data = DB::table('asmt2_sdsc')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function saveAsmtSubDesc2(Request $request)
		{
			try 
			{
				$updateData = array('asmt2sd_desc' => $request->desc);
				$test = DB::table('asmt2_sdsc')->where('asmt2sd_id', $request->id)->update($updateData);
				if ($test) {return 'DONE';}
				else 
				{
					AjaxController::SystemLogs('No data has been updated in asmt2_sdsc table. (saveAsmtSubDesc2)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delAsmtSubDesc2(Request $request)
		{
			try 
			{
				$test = DB::table('asmt2_sdsc')->where('asmt2sd_id', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in asmt2_sdsc table. (delAsmtSubDesc2)');
					return 'ERROR';
				}
			}
			catch (Exception $e)
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Assessment Sub-Description 2
		/////// Assessment Title
		public static function getAllAssessmentTitle()
		{
			try 
			{
				$data = DB::table('asmt_title')->orderBy('title_name', 'asc')->get();
				return $data;	
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		/////// Assessment Title
		/////// Assessment Column
		public static function getAllColumn()
		{
			try 
			{
				$data = DB::table('asmt2_col')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function saveAssessmentColumn(Request $request)
		{
			try 
			{
				$updateData = array('asmt2c_desc' => $request->desc, 'asmt2c_type' => $request->inputype);
				$test = DB::table('asmt2_col')->where('asmt2c_id', $request->id)->update($updateData);
				if ($test) {return 'DONE';}
				else 
				{
					AjaxController::SystemLogs('No data has been updated in asmt2_col table. (saveAssessmentColumn)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delAssessmentColumn(Request $request)
		{
			try 
			{
				$test = DB::table('asmt2_col')->where('asmt2c_id', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in asmt2_col table. (delAssessmentColumn)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Assessment Column
		/////// Manage Assessment
		public static function getAllManageAssessment()
		{
			try 
			{
				$data = DB::table('facassessment')
							->join('assessment', 'facassessment.asmt_id', '=', 'assessment.asmt_id')
							->join('hfaci_grp', 'facassessment.facid', '=', 'hfaci_grp.hgpid')
							->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function delManageAssessment(Request $request)
		{
			try 
			{
				$test = DB::table('facassessment')->where('id', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in facassessment table. (delManageAssessment)');
					return 'ERROR';
				}
			} 	
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Manage Assessment
		/////// Manage Assessment 2
		public static function getSingleAsmt2(Request $request)
		{
			try 
			{
				$data = DB::table('asmt2')
							// ->join('asmt_title', 'asmt2.asmt2_title', '=', 'asmt_title.title_code')
							->join('asmt2_loc', 'asmt2.asmt2_loc', '=', 'asmt2_loc.asmt2l_id')
							->where('asmt2.asmt2_id', '=', $request->id)->first();
				if (isset($data)) {
					$get = DB::table('asmt2_sdsc')->where('asmt2sd_id', '=', $data->asmt2sd_id)->first();
					if (isset($get)) {
						$data->asmt2sd_desc = $get->asmt2sd_desc;
					} else {
						$data->asmt2sd_desc = null;
					}
				}

				return response()->json($data);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Manage Assessment 2
		/////// Complaints
		public static function getAllComplaints()
		{
			try 
			{
				$data = DB::table('complaints')->get();
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function getAllComplaintsForm() // Get All Complaints Form
		///////////// Lloyd - Nov 21, 2018 ///////////////
		{
			try {
				$data = DB::table('complaints_form')->get();
				$list = DB::table('complaints')->get();
				$comps = array();
				$IDs = array();

				// gets comps list	
				foreach ($list as $key => $value) {
					$comps[] = $value;
				}

				// translate
				foreach ($data as $key => $value) {
					// gets comps IDs
					$temp = array();
					$temp = explode(', ', $value->comps); // explodes to array
					for($i=0; $i<count($temp); $i++) { // transform codes into actual desc
						if(is_numeric($temp[$i])) {
							for ($j=0; $j<count($comps) ; $j++) { 
								if($temp[$i] == $comps[$j]->cmp_id){
									$temp[$i] = $comps[$j]->cmp_desc;
								}
							}
						} /*else {
							$temp[$i] = "Others: ".$temp[$i];
						}*/
					}
					$data[$key]->comps = $temp;
					// $data[$key]->comps = implode(", ", $temp);
				}
				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function saveComplaint(Request $request)
		{
			try 
			{
				$updateData = array('cmp_desc'=>$request->name);
				$test = DB::table('complaints')->where('cmp_id', $request->id)->update($updateData);
				if ($test) {return 'DONE';}
				else 
				{
					AjaxController::SystemLogs('No data has been updated in complaints table. (saveComplaint)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delComplaint(Request $request)
		{
			try 
			{
				$test = DB::table('complaints')->where('cmp_id', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in complaints table. (delComplaint)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Complaints
		/////// Request for Assistance
		public static function getAllRequestForAssistance() // Get All Request For Assistance 
		{
			try 
			{
				$data = DB::table('req_ast')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		
		public static function checkmonid($id) // 
		{
			try 
			{

				$data = DB::table('mon_form')->where('monid', $id)->first();


				return !is_null($data) ? 'yes' : 'no';
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}

		public static function getAllRequestForAssistanceForm() // Get All Request For Assistance Form
		{
			///////////////// Lloyd - Nov 21, 2018 ///////////////
			try {
				$data = DB::table('req_ast_form')->get();
				$list = DB::table('req_ast')->get();
				$reqs = array();
				$IDs = array();

				// gets reqs list	
				foreach ($list as $key => $value) {
					$reqs[] = $value;
				}

				// translate
				foreach ($data as $key => $value) {
					// gets reqs IDs
					$temp = array();
					$temp = explode(', ', $value->reqs); // explodes to array
					for($i=0; $i<count($temp); $i++) { // transform codes into actual desc
						if(is_numeric($temp[$i])) {
							for ($j=0; $j<count($reqs) ; $j++) { 
								if($temp[$i] == $reqs[$j]->rq_id){
									$temp[$i] = $reqs[$j]->rq_desc;
								}
							}
						} else {
							$temp[$i] = "Others: ".$temp[$i];
						}
					}
					$data[$key]->reqs = $temp;
					// $data[$key]->reqs = implode(", ", $temp);
				}
				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function saveRequestForAssistance(Request $request) // Update Request for Assistance
		{
			try 
			{
				$updateData = array('rq_desc'=>$request->name);
				$test = DB::table('req_ast')->where('rq_id', $request->id)->update($updateData);
				if ($test) {return 'DONE';}
				else 
				{
					AjaxController::SystemLogs('No data has been updated in req_ast table. (saveRequestForAssistance)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function delRequestForAssistance(Request $request)
		{
			try 
			{
				$test = DB::table('req_ast')->where('rq_id', '=', $request->id)->delete();
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in req_ast table. (delRequestForAssistance)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Surveillance
		public static function getAllSurveillanceForm() {
			///////////////// Lloyd - Dec 7, 2018 ///////////////
			try {

				$Cur_useData = AjaxController::getCurrentUserAllData();

				if($Cur_useData['grpid'] == 'NA' || $Cur_useData['rgnid'] == 'HFSRB'){
					$data = DB::table('surv_form')
					->leftJoin('appform','appform.appid','surv_form.appid')
					->leftJoin('facilitytyp','facilitytyp.facid','surv_form.type_of_faci')
					->leftJoin('verdict','surv_form.verdict','verdict.vid')
					->select('surv_form.*','surv_form.status as survStat', 'appform.*', 'facilitytyp.*', 'verdict.vdesc')
					->get();
				}else{

					$data = DB::table('surv_form')
					->leftJoin('appform','appform.appid','surv_form.appid')
					->leftJoin('facilitytyp','facilitytyp.facid','surv_form.type_of_faci')
					->leftJoin('verdict','surv_form.verdict','verdict.vid')
					->where('surv_form.rgnid', $Cur_useData['rgnid'])
					->select('surv_form.*','surv_form.status as survStat', 'appform.*', 'facilitytyp.*', 'verdict.vdesc')
					->get();

				}
				
				
				
				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
	public static function getAllSurveillanceFormRegFac() {
			///////////////// jacky - Jun 24, 2021 ///////////////
			try {


				$Cur_useData = AjaxController::getCurrentUserAllData();

				if($Cur_useData['grpid'] == 'NA' || $Cur_useData['rgnid'] == 'HFSRB'){
					$data = DB::table('surv_form')
					->leftJoin('registered_facility','registered_facility.regfac_id','surv_form.regfac_id')
					->leftJoin('hfaci_grp','hfaci_grp.hgpid','surv_form.type_of_faci')
					->leftJoin('verdict','surv_form.verdict','verdict.vid')
					->get();
				}else{
					$data = DB::table('surv_form')
					->leftJoin('registered_facility','registered_facility.regfac_id','surv_form.regfac_id')
					->leftJoin('hfaci_grp','hfaci_grp.hgpid','surv_form.type_of_faci')
					->leftJoin('verdict','surv_form.verdict','verdict.vid')
					->where('surv_form.rgnid',$Cur_useData['rgnid'] )
					->get();
				}

				// 	$data = DB::table('surv_form')
				// ->leftJoin('registered_facility','registered_facility.regfac_id','surv_form.regfac_id')
				// ->leftJoin('hfaci_grp','hfaci_grp.hgpid','surv_form.type_of_faci')
				// ->get();
				
				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}

		/////// Monitoring
		public static function getAllMonitoringForm() {
			///////////////// Lloyd - Dec 12, 2018 ///////////////
							// Jacky was here 6-21-2021
			try {
				$Cur_useData = AjaxController::getCurrentUserAllData();

				if($Cur_useData['grpid'] == 'NA' || $Cur_useData['rgnid'] == 'HFSRB'){
					$data = DB::table('mon_form')
					->select('hfaci_grp.hgpdesc', 'trans_status.trns_desc', 'mon_form.*', 'registered_facility.*')
					->leftJoin('registered_facility','mon_form.regfac_id','=','registered_facility.regfac_id')
					->leftJoin('hfaci_grp','mon_form.type_of_faci','=','hfaci_grp.hgpid')
					->leftJoin('trans_status','mon_form.status','=','trans_status.trns_id')
					->get();
				}else{
					$data = DB::table('mon_form')
					->select('hfaci_grp.hgpdesc', 'trans_status.trns_desc', 'mon_form.*', 'registered_facility.*')
					->leftJoin('registered_facility','mon_form.regfac_id','=','registered_facility.regfac_id')
					->leftJoin('hfaci_grp','mon_form.type_of_faci','=','hfaci_grp.hgpid')
					->leftJoin('trans_status','mon_form.status','=','trans_status.trns_id')
					->where('registered_facility.rgnid', $Cur_useData['rgnid'])
					->get();
				}
			
				// $data = DB::table('mon_form')->join('registered_facility','mon_form.regfac_id','registered_facility.regfac_id')->get();
				// $data = DB::table('mon_form')->join('appform','appform.appid','mon_form.appid')->get(); 6-21-2021
				
				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}

		public static function getMonitoringFormByMonid($monid) {
			///////////////// Lloyd - Dec 12, 2018 ///////////////
			try {
				$data = DB::table('mon_form')
						->where('monid', '=', $monid)
						->first();
				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}

		public static function getSurveillanceFormByMonid($survid) {
			///////////////// Lloyd - Dec 12, 2018 ///////////////
			try {
				$data = DB::table('surv_form')
						->where('survid', '=', $survid)
						->first();
				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}


		/////// System Settings
		public static function getAllSettings() // Get All Settings
		{
			try 
			{
				$data = DB::table('m99')->first();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// System Settings
		/// ------------------------------------ PROCESS FLOW
		/////// View All Process Flow
		public static function getForComplianceApplication()
		{
			$complianceData = DB::table('compliance_data')
			->where('is_for_compliance', 1)
			->where('is_monitoring', 0)
			->leftjoin('appform','appform.appid','compliance_data.app_id')
			->get();
			
			return $complianceData;
		}

		public static function getComplianceDetails($complianceId){
			$complianceData = DB::table('compliance_item')
			->where('compliance_item.compliance_id', $complianceId)
			->leftjoin('compliance_data','compliance_data.compliance_id','compliance_item.compliance_id')
			// ->where('compliance_data.is_for_compliance', 0)
			->leftjoin('assessmentcombinedduplicate','assessmentcombinedduplicate.dupID','compliance_item.assesment_id')
			->leftjoin('asmt_h1','asmt_h1.asmtH1ID','assessmentcombinedduplicate.asmtH1ID_FK')
			->leftjoin('asmt_h2','asmt_h2.asmtH2ID','assessmentcombinedduplicate.asmtH2ID_FK')
			->leftjoin('asmt_h3','asmt_h3.asmtH3ID','assessmentcombinedduplicate.asmtH3ID_FK')
			->get();
			
			return $complianceData;
		}

		public static function getComplianceDetailsByAppId($appid){
			$complianceData = DB::table('compliance_data')
			->where('compliance_data.app_id', $appid)
			// ->leftjoin('compliance_item', 'compliance_item.compliance_id','compliance_data.compliance_id')
			// ->where('compliance_data.is_for_compliance', 0)
			// ->leftjoin('assessmentcombinedduplicate','assessmentcombinedduplicate.dupID','compliance_item.assesment_id')
			// ->leftjoin('asmt_h1','asmt_h1.asmtH1ID','assessmentcombinedduplicate.asmtH1ID_FK')
			// ->leftjoin('asmt_h2','asmt_h2.asmtH2ID','assessmentcombinedduplicate.asmtH2ID_FK')
			// ->leftjoin('asmt_h3','asmt_h3.asmtH3ID','assessmentcombinedduplicate.asmtH3ID_FK')
			->get();
			
			return $complianceData;
		}


		public static function getComplianceAttachment($complianceId){
			$complianceData = DB::table('compliance_attachment')
			->where('compliance_attachment.compliance_id', $complianceId)
			->leftjoin('compliance_data','compliance_data.compliance_id','compliance_attachment.compliance_id')
			->leftjoin('x08','x08.uid','compliance_attachment.user_id')
			->orderBy('attachment_id', 'DESC')
			->get();
			
			return $complianceData;
		}

		public static function getComplianceRemarks($complianceId){
			$complianceData = DB::table('compliance_remarks')
			->where('compliance_remarks.compliance_id', $complianceId)
			->leftjoin('compliance_data','compliance_data.compliance_id','compliance_remarks.compliance_id')
			->leftjoin('x08','x08.uid','compliance_remarks.user_id')
			->orderBy('remarks_id', 'DESC')
			->get();
			
			return $complianceData;
		}

		public static function getAllApplicantsProcessFlow()
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				// dd($Cur_useData);
				switch ($Cur_useData['grpid']) {
					case 'NA':			
							$anotherData = DB::table('appform')
							->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
							->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
							->leftJoin('region', 'appform.rgnid', '=', 'region.rgnid')
							->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
							->leftJoin('province', 'appform.provid', '=', 'province.provid')
							->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
							->leftJoin('barangay', 'appform.brgyid', '=' , 'barangay.brgyid')
							->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
							->leftJoin('class', 'appform.classid', '=', 'class.classid')
							->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
							->leftjoin('ptc','ptc.appid','appform.appid')
							->leftjoin('region AS asrgn','appform.assignedRgn', '=', 'asrgn.rgnid')
							->select('appform.*', 'hfaci_serv_type.*', 'ptc.propbedcap as pbedcap','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid as aprgnid', 'appform.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid', 'asrgn.rgn_desc AS asrgn_desc')
							//->where('appform.draft', '=', null)
							->orderBy('appform.appid','desc')
							->distinct()
							->get();
							
						break;
					case 'FDA':
							$anotherData = DB::table('appform')
							->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
							->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
							->leftJoin('region', 'appform.rgnid', '=', 'region.rgnid')
							->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
							->leftJoin('province', 'appform.provid', '=', 'province.provid')
							->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
							->leftJoin('barangay', 'appform.brgyid', '=' , 'barangay.brgyid')
							->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
							->leftJoin('class', 'appform.classid', '=', 'class.classid')
							->leftJoin('trans_status', 'appform.FDAstatus', '=', 'trans_status.trns_id')
							->leftjoin('ptc','ptc.appid','appform.appid')
							->leftjoin('region AS asrgn','appform.assignedRgn', '=', 'asrgn.rgnid')
							->select('appform.*', 'hfaci_serv_type.*', 'ptc.propbedcap as pbedcap','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid as aprgnid', 'appform.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid', 'asrgn.rgn_desc AS asrgn_desc')
							->where([['appform.hfser_id','LTO'], ['appform.hfser_id','COA'], ['appform.hfser_id','ATO'], ['appform.hfser_id','COR'],['appform.noofsatellite', '>', 0]]) //7-2-2021
							->orderBy('appform.appid','desc')
							->get();
							break;

					/*case 'LO':
						$anotherData = DB::table('appform')
							->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
							->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
							->leftJoin('region', 'appform.rgnid', '=', 'region.rgnid')
							->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
							->leftJoin('province', 'appform.provid', '=', 'province.provid')
							->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
							->leftJoin('barangay', 'appform.brgyid', '=' , 'barangay.brgyid')
							->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
							->leftJoin('class', 'appform.classid', '=', 'class.classid')
							->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
							->leftjoin('ptc','ptc.appid','appform.appid')
							->leftjoin('region AS asrgn','appform.assignedRgn', '=', 'asrgn.rgnid')
							->select('appform.*', 'hfaci_serv_type.*', 'ptc.propbedcap as pbedcap','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid as aprgnid', 'appform.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid', 'asrgn.rgn_desc AS asrgn_desc')
							// ->where('appform.assignedLO', '=', $Cur_useData['cur_user'])
							->where('appform.assignedRgn', '=', $Cur_useData['rgnid']) //bring back after
							->orderBy('appform.appid','desc')
							->orderBy('appform.t_date','desc')
						
							->get();
							break;
							
					case 'RLO':
						$anotherData = DB::table('appform')
							->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
							->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
							->leftJoin('region', 'appform.rgnid', '=', 'region.rgnid')
							->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
							->leftJoin('province', 'appform.provid', '=', 'province.provid')
							->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
							->leftJoin('barangay', 'appform.brgyid', '=' , 'barangay.brgyid')
							->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
							->leftJoin('class', 'appform.classid', '=', 'class.classid')
							->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
							->leftjoin('ptc','ptc.appid','appform.appid')
							->leftjoin('region AS asrgn','appform.assignedRgn', '=', 'asrgn.rgnid')
							->select('appform.*', 'hfaci_serv_type.*', 'ptc.propbedcap as pbedcap','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid as aprgnid', 'appform.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid', 'asrgn.rgn_desc AS asrgn_desc')
							// ->where('appform.assignedLO', '=', $Cur_useData['cur_user'])
							->where('appform.assignedRgn', '=', $Cur_useData['rgnid']) //bring back after
							->orderBy('appform.appid','desc')
							->orderBy('appform.t_date','desc')
						
							->get();
							
							//dd($anotherData);
							break;*/
							
					case 'HFERC':
						$anotherData = DB::table('appform')
							->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
							->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
							->leftJoin('region', 'appform.rgnid', '=', 'region.rgnid')
							->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
							->leftJoin('province', 'appform.provid', '=', 'province.provid')
							->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
							->leftJoin('barangay', 'appform.brgyid', '=' , 'barangay.brgyid')
							->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
							->leftJoin('class', 'appform.classid', '=', 'class.classid')
							->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
							->leftjoin('hferc_evaluation','hferc_evaluation.appid','appform.appid')
							->leftjoin('ptc','ptc.appid','appform.appid')
							->leftjoin('region AS asrgn','appform.assignedRgn', '=', 'asrgn.rgnid')
							->join('hferc_team', 'appform.appid', '=', 'appform.appid')
							->select('appform.*', 'hfaci_serv_type.*', 'ptc.propbedcap as pbedcap','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid as aprgnid', 'appform.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid', 'asrgn.rgn_desc AS asrgn_desc')
							->orderBy('appform.appid','desc')
							
							->distinct()
							->get();
							break;
					default:								
						$anotherData = DB::table('appform');
							$anotherData->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id');
							$anotherData->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid');
							$anotherData->leftJoin('x08', 'appform.uid', '=', 'x08.uid');
							$anotherData->leftJoin('region', 'appform.rgnid', '=', 'region.rgnid');
							$anotherData->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid');
							$anotherData->leftJoin('province', 'appform.provid', '=', 'province.provid');
							$anotherData->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid');
							$anotherData->leftJoin('barangay', 'appform.brgyid', '=' , 'barangay.brgyid');
							$anotherData->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid');
							$anotherData->leftJoin('class', 'appform.classid', '=', 'class.classid');
							$anotherData->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id');
							$anotherData->leftjoin('ptc','ptc.appid','appform.appid');							
							$anotherData->leftjoin('region AS asrgn','appform.assignedRgn', '=', 'asrgn.rgnid');
							$anotherData->select('appform.*', 'ptc.propbedcap as pbedcap', 'hfaci_serv_type.*','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid as aprgnid', 'appform.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid', 'asrgn.rgn_desc AS asrgn_desc');
														
							if($Cur_useData['is_fda'] == 1){
								if($Cur_useData['rgnid'] && $Cur_useData['rgnid'] != 'FDA'){
									$anotherData->where('appform.rgnid', '=', $Cur_useData['rgnid']); //bring back after
								}
							} else {
								$anotherData->where('appform.assignedRgn', '=', $Cur_useData['rgnid']);
							}

							$anotherData->orderBy('appform.appid','desc');
							$anotherData = $anotherData->get();

						break;
				}
				for ($i=0; $i < count($anotherData); $i++) {
					/////  Applied
					$time = $anotherData[$i]->t_time;
					$newT = Carbon::parse($time);
					$anotherData[$i]->formattedTime = $newT->format('g:i A');
					$date = $anotherData[$i]->t_date;

					if($date){
						$newD = Carbon::parse($date);
						$anotherData[$i]->formattedDate = $newD->toFormattedDateString();
					} else {
						$anotherData[$i]->formattedDate = 'N/A';
					}					
					
					//updated
					$time = $anotherData[$i]->updated_at;
					$newT = Carbon::parse($time);
					$anotherData[$i]->formattedUpatedTime = $newT->format('g:i A');
					$date = $anotherData[$i]->updated_at;
					$newD = Carbon::parse($date);
					$anotherData[$i]->formattedUpdatedDate = $newD->toFormattedDateString();				
					
					/////  Applied
					/////  Evaluated
					$time = $anotherData[$i]->recommendedtime;
					$newT = Carbon::parse($time);
					$anotherData[$i]->formattedTimeEval = ($anotherData[$i]->recommendedtime === null)? null : $newT->format('g:i A');
					$date = $anotherData[$i]->recommendeddate;
					$newD = Carbon::parse($date);
					$anotherData[$i]->formattedDateEval = ($anotherData[$i]->recommendeddate === null)? null : $newD->toFormattedDateString();
					////////
					$time = $anotherData[$i]->proposedInspectiontime;
					$newT = Carbon::parse($time);
					$anotherData[$i]->formattedTimePropEval = ($anotherData[$i]->proposedInspectiontime === null)? null : $newT->format('g:i A');
					$date = $anotherData[$i]->proposedInspectiondate;
					$newD = Carbon::parse($date);
					$anotherData[$i]->formattedDatePropEval = ($anotherData[$i]->proposedInspectiondate === null)? null : $newD->toFormattedDateString();
					///////
					$EvaluateBy = DB::table('x08')->where('uid', '=', $anotherData[$i]->recommendedby)->first();
					if ($EvaluateBy) { // Has recommended By
						if ($EvaluateBy->grpid == 'NA') {
							$anotherData[$i]->recommendedbyName = 'System Administrator';
						} else {
							$x = $EvaluateBy->mname;
					      	if ($x != "") {
						    	$mid = strtoupper($x[0]);
						    	$mid = $mid.'. ';
				       		 } else {
						    	$mid = ' ';
						 		}
							$anotherData[$i]->recommendedbyName = $EvaluateBy->fname.' '.$mid.''.$EvaluateBy->lname;
						}
					} else {
						$anotherData[$i]->recommendedbyName = null;
					}
					// $Rgn = DB::table('region')->where('rgnid', '=', $anotherData[$i]->assignedRgn)->first();
					// $anotherData[$i]->RgnEvaluated = ($anotherData[$i]->assignedRgn !== null) ? $Rgn->rgn_desc : null;
					/////  Evaluated
					/////  Inspection
					// $time = $anotherData[$i]->recommendedtime;
					// $newT = Carbon::parse($time);
					// $anotherData[$i]->formattedTimeEval = ($anotherData[$i]->recommendedtime === null)? null : $newT->format('g:i A');
					// $date = $anotherData[$i]->recommendeddate;
					// $newD = Carbon::parse($date);
					// $anotherData[$i]->formattedDateEval = ($anotherData[$i]->recommendeddate === null)? null : $newD->toFormattedDateString();
					/////  Inspection
				    ///// Status
				    ///// Status
				    ///
				    $data = DB::table('app_team')->where('appid', '=', $anotherData[$i]->appid)->get();
					if (count($data) != 0) {
						$anotherData[$i]->hasAssessors = 'T';
					} else {
						$anotherData[$i]->hasAssessors = 'F';
					}
				}
				
				//dd($anotherData);
				return $anotherData;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllRegisteredFacilityDetailsByRegFacID($viewtype="", $regfac_id="", $facilityname="")
		{
			$rowcount = 0;
			$Cur_useData = AjaxController::getCurrentUserAllData();
			$uid = $Cur_useData['cur_user'];
			
			//try 
			//{
				switch ($viewtype) 
				{
					default:							
						$anotherData = DB::table($viewtype);
						break;
				}

				$t_date_1 = NULL;
				$t_date_2 = NULL;

				if(isset($regfac_id) )
				{  
					$anotherData = $anotherData->where('regfac_id', '=', $regfac_id);
				}
				else if( isset($facilityname) )
				{  
					$anotherData = $anotherData->where('facilityname', '=', $facilityname);
				}				
				
				$data = $anotherData->get();

				return $data;
			/*} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}*/
		}

		public static function getAllRegisteredFacilityListWithFilter($viewtype="", $filter=array(), $limit=10, $fo_pgno = 1, $nolimit=false)
		{
			$rowcount = 0;
			$Cur_useData = AjaxController::getCurrentUserAllData();
			$uid = $Cur_useData['cur_user'];
			
			//try 
			//{
				switch ($viewtype) 
				{
					case 'view_registered_facility_for_change':			
						$anotherData = DB::table('view_registered_facility_for_change');
						break;

					default:							
						$anotherData = DB::table($viewtype);
						break;
				}

				
				//conditions area
				if($Cur_useData['is_fda'] == 1){
					if($Cur_useData['rgnid'] && $Cur_useData['rgnid'] != 'FDA'){
						$anotherData->where('rgnid', '=', $Cur_useData['rgnid']); //bring back after
					}
				} else {
					if($Cur_useData['grpid'] != "NA")
					{
						$anotherData->where('assignedRgn', '=', $Cur_useData['rgnid']);
					}
				}
				$t_date_1 = NULL;
				$t_date_2 = NULL;
				
				//Filter Area
				foreach($filter  as $fo => $foval)
				{
					if($fo == 'regfac_id' && isset($foval) )
					{  
						$anotherData->where($fo, 'LIKE', '%' .$foval. '%');
					}
					else if($fo == 'appid' && isset($foval) )
					{  
						$anotherData->where($fo, 'LIKE', '%' .$foval. '%');
					}
					else if( $fo == 'facilityname' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 't_date_1' && isset($foval) )
					{  
						$t_date_1 = $foval;
					}
					else if( $fo == 't_date_2' && isset($foval) && isset($t_date_1))
					{  
						$t_date_2 = $foval;
						$anotherData->whereBetween('t_date', [$t_date_1, $t_date_2]);
					}
					else if($fo != 'fo_rows' && $fo != 'fo_pgno' && $fo != 'fo_submit' && $fo != 'fo_rowscnt' && $fo != 'fo_session_grpid' && isset($foval)) 
					{ 						
						$anotherData->where($fo, '=', $foval);
					}
				}				
				//Limit and Offset
				$rowcount = $anotherData->count();

				if($nolimit == false)
				{
					$anotherData->OFFSET($fo_pgno*$limit);
					$anotherData->LIMIT($limit);
				}		
				
				$data = $anotherData->get();

				return array('data'=>$data, 'rowcount'=>$rowcount);
			/*} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}*/
		}

		public static function getAllApplicantionWithFilter($viewtype="", $filter=array(), $limit=10, $fo_pgno = 1, $nolimit=false)
		{
			$rowcount = 0;
			$Cur_useData = AjaxController::getCurrentUserAllData();
			$uid = $Cur_useData['cur_user'];
			
			try 
			{
				switch ($viewtype) 
				{
					case 'app_facility_for_assessment':			
						$anotherData = DB::table('app_facility_for_assessment');

						if($Cur_useData['grpid'] != "NA")
						{
							$anotherData->where('uid', '=', $Cur_useData['cur_user']);
						}

						break;

					case 'app_evaluation_tool':
						if($Cur_useData['grpid'] == "NA") {	$anotherData = DB::table('app_evaluation_tool_admin'); 	}
						else 
						{ 	
							$anotherData = DB::table('app_evaluation_tool');
							//$anotherData->where('(SELECT COUNT(*) FROM hferc_team WHERE uid=\'$uid\')', '>', '0');
							//dd( $Cur_useData['cur_user']);
							/*$anotherData = DB::table('app_evaluation_tool')->select('*')->whereIn('appid',function ($query) 
							{
								$query->select('appid')->from('hferc_team')->where('uid','=', $Cur_useData['cur_user'])->distinct()->get();				
							});*/
						}
						break;

					case 'app_committee_assignment':						
						if($Cur_useData['grpid'] == "NA") {  $anotherData = DB::table('app_committee_assignment_admin'); }
						else  {  $anotherData = DB::table('app_committee_assignment');  }
						break;

					case 'app_con_evaluation':					
						if($Cur_useData['grpid'] == "NA")  { $anotherData = DB::table('app_con_evaluation_admin');  }
						else { 	$anotherData = DB::table('app_con_evaluation');  }
						break;
					
					case 'applist':			
						$anotherData = DB::table('applist');	
						break;

					default:							
						$anotherData = DB::table($viewtype);
						break;
				}
				
				//conditions area
				if($Cur_useData['is_fda'] == 1){
					if($Cur_useData['rgnid'] && $Cur_useData['rgnid'] != 'FDA'){
						$anotherData->where('rgnid', '=', $Cur_useData['rgnid']); //bring back after
					}
				} else {
					if($Cur_useData['grpid'] != "NA")
					{
						$anotherData->where('assignedRgn', '=', $Cur_useData['rgnid']);
					}
				}
				$t_date_1 = NULL;
				$t_date_2 = NULL;
				
				//Filter Area
				foreach($filter  as $fo => $foval)
				{
					if($fo == 'appid' && isset($foval) )
					{  
						$anotherData->where($fo, 'LIKE', '%' .$foval. '%');
					}
					else if( $fo == 'facilityname' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 't_date_1' && isset($foval) )
					{  
						$t_date_1 = $foval;
					}
					else if( $fo == 't_date_2' && isset($foval) && isset($t_date_1))
					{  
						$t_date_2 = $foval;
						$anotherData->whereBetween('t_date', [$t_date_1, $t_date_2]);
					}
					else if($fo != 'fo_rows' && $fo != 'fo_pgno' && $fo != 'fo_submit' && $fo != 'fo_rowscnt' && $fo != 'fo_session_grpid' && isset($foval)) 
					{ 						
						$anotherData->where($fo, '=', $foval);
					}
				}				
				//Limit and Offset
				$rowcount = $anotherData->count();

				if($nolimit == false)
				{
					$anotherData->OFFSET($fo_pgno*$limit);
					$anotherData->LIMIT($limit);
				}		
				
				$data = $anotherData->get();

				return array('data'=>$data, 'rowcount'=>$rowcount);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllApplicantionWithFilterFDA($viewtype="", $filter=array(), $limit=10, $fo_pgno = 1, $nolimit=false)
		{
			$rowcount = 0;
			$Cur_useData = AjaxController::getCurrentUserAllData();
			$uid = $Cur_useData['cur_user'];
			
			try 
			{
				switch ($viewtype) 
				{					
					case 'applist':			
						$anotherData = DB::table('applist');	
						break;

					default:							
						$anotherData = DB::table($viewtype);
						break;
				}
				
				//conditions area
				if($Cur_useData['is_fda'] == 1){
					if($Cur_useData['rgnid'] && $Cur_useData['rgnid'] != 'FDA'){
						$anotherData->where('rgnid', '=', $Cur_useData['rgnid']); //bring back after
					}
				} else {
					if($Cur_useData['grpid'] != "NA")
					{
						$anotherData->where('assignedRgn', '=', $Cur_useData['rgnid']);
					}
				}
				$t_date_1 = NULL;
				$t_date_2 = NULL;
				
				//Filter Area
				foreach($filter  as $fo => $foval)
				{
					if($fo == 'appid' && isset($foval) )
					{  
						$anotherData->where($fo, 'LIKE', '%' .$foval. '%');
					}
					else if( $fo == 'facilityname' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 'proofpaystatMach' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 'proofpaystatPhar' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 't_date_1' && isset($foval) )
					{  
						$t_date_1 = $foval;
					}
					else if( $fo == 't_date_2' && isset($foval) && isset($t_date_1))
					{  
						$t_date_2 = $foval;
						$anotherData->whereBetween('t_date', [$t_date_1, $t_date_2]);
					}
					else if($fo != 'fo_rows' && $fo != 'fo_pgno' && $fo != 'fo_submit' && $fo != 'fo_rowscnt' && $fo != 'fo_session_grpid' && isset($foval)) 
					{ 						
						$anotherData->where($fo, '=', $foval);
					}
				}
				
				//Limit and Offset
				$rowcount = $anotherData->count();

				if($nolimit == false)
				{
					$anotherData->OFFSET($fo_pgno*$limit);
					$anotherData->LIMIT($limit);
				}				
				
				$data = $anotherData->get();

				return array('data'=>$data, 'rowcount'=>$rowcount);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAll_RegisteredFacility_WithFilter($viewtype="", $filter=array(), $limit=10, $fo_pgno = 1, $nolimit=false)
		{
			$rowcount = 0;
			$Cur_useData = AjaxController::getCurrentUserAllData();
			$uid = $Cur_useData['cur_user'];
			try 
			{
				switch ($viewtype) 
				{
					//License Modules and DOH Cashier
					case 'view_registered_facility':			
						$anotherData = DB::table('view_registered_facility');	
						break;

					default:								
						$anotherData = DB::table('view_registered_facility');
						break;
				}

				//Filter Area
				foreach($filter  as $fo => $foval)
				{
					if($fo == 'regfac_id' && isset($foval) )
					{  
						$anotherData->where($fo, 'LIKE', '%' .$foval. '%');
					}
					else if($fo == 'nhfcode' && isset($foval) )
					{  
						$anotherData->where($fo, 'LIKE', '%' .$foval. '%');
					}
					else if( $fo == 'facilityname' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if($fo != 'fo_rows' && $fo != 'fo_pgno' && $fo != 'fo_submit' && $fo != 'fo_rowscnt' && $fo != 'fo_session_grpid' && isset($foval)) 
					{ 						
						$anotherData->where($fo, '=', $foval);
					}
				}
				
				//Limit and Offset
				$rowcount = $anotherData->count();

				if($nolimit == false)
				{
					$anotherData->OFFSET($fo_pgno*$limit);
					$anotherData->LIMIT($limit);
				}				
				
				$data = $anotherData->distinct()->get();

				return array('data'=>$data, 'rowcount'=>$rowcount);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAll_RegisteredPersonnel_WithFilter($viewtype="", $filter=array(), $limit=10, $fo_pgno = 1, $nolimit=false)
		{
			$rowcount = 0;
			$Cur_useData = AjaxController::getCurrentUserAllData();
			$uid = $Cur_useData['cur_user'];
			try 
			{
				switch ($viewtype) 
				{
					//License Modules and DOH Cashier
					case 'reg_hfsrbannexa':			
						$anotherData = DB::table('reg_hfsrbannexa');	
						break;

					default:								
						$anotherData = DB::table($viewtype);
						break;
				}

				//Filter Area
				foreach($filter  as $fo => $foval)
				{
					if($fo == 'regfac_id' && isset($foval) )
					{  
						$anotherData->where($fo, 'LIKE', '%' .$foval. '%');
					}
					else if( $fo == 'surname' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 'firstname' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 'middlename' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 'prcno' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 'employement' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 'pos' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 'prof' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if( $fo == 'status' && isset($foval) )
					{  
						$anotherData->where(''.$fo.'', 'LIKE', '%' .strtolower($foval). '%');
					}
					else if($fo != 'fo_rows' && $fo != 'fo_pgno' && $fo != 'fo_submit' && $fo != 'fo_rowscnt' && $fo != 'fo_session_grpid' && isset($foval)) 
					{ 						
						$anotherData->where($fo, '=', $foval);
					}
				}
				
				//Limit and Offset
				$rowcount = $anotherData->count();

				if($nolimit == false)
				{
					$anotherData->OFFSET($fo_pgno*$limit);
					$anotherData->LIMIT($limit);
				}				
				
				$data = $anotherData->distinct()->get();

				return array('data'=>$data, 'rowcount'=>$rowcount);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllApplicantsFDA()
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				//dd($Cur_useData);
				switch ($Cur_useData['grpid']) {
					case 'NA':			
							$anotherData = DB::table('appform')
							->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
							->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
							->leftJoin('region', 'appform.rgnid', '=', 'region.rgnid')
							->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
							->leftJoin('province', 'appform.provid', '=', 'province.provid')
							->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
							->leftJoin('barangay', 'appform.brgyid', '=' , 'barangay.brgyid')
							->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
							->leftJoin('class', 'appform.classid', '=', 'class.classid')
							->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
							->leftjoin('ptc','ptc.appid','appform.appid')
							->leftjoin('region AS asrgn','appform.assignedRgn', '=', 'asrgn.rgnid')
							->select('appform.*', 'hfaci_serv_type.*', 'ptc.propbedcap as pbedcap','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid as aprgnid', 'appform.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid', 'asrgn.rgn_desc AS asrgn_desc')
							//->where('appform.draft', '=', null)
							->orderBy('appform.appid','desc')
							->distinct()
							->get();
							
						break;
						default:	
							$anotherData = DB::table('appform')
							->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
							->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
							->leftJoin('region', 'appform.rgnid', '=', 'region.rgnid')
							->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
							->leftJoin('province', 'appform.provid', '=', 'province.provid')
							->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
							->leftJoin('barangay', 'appform.brgyid', '=' , 'barangay.brgyid')
							->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
							->leftJoin('class', 'appform.classid', '=', 'class.classid')
							->leftJoin('trans_status', 'appform.FDAstatus', '=', 'trans_status.trns_id')
							->leftjoin('ptc','ptc.appid','appform.appid')
							->leftjoin('region AS asrgn','appform.assignedRgn', '=', 'asrgn.rgnid')
							->select('appform.*', 'hfaci_serv_type.*', 'ptc.propbedcap as pbedcap','region.rgn_desc', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid as aprgnid', 'appform.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc', 'x08.uid', 'asrgn.rgn_desc AS asrgn_desc')
							->where([['appform.hfser_id','LTO'], ['appform.hfser_id','COA'], ['appform.hfser_id','ATO'], ['appform.hfser_id','COR'],['appform.noofsatellite', '>', 0]]);
							
							if($Cur_useData['rgnid']){
								$anotherData->where('appform.assignedRgn', '=', $Cur_useData['rgnid']); //bring back after
							}

							$anotherData->orderBy('appform.appid','desc');
							$anotherData = $anotherData->get();

						break;
				}
				for ($i=0; $i < count($anotherData); $i++) {
					/////  Applied
					$time = $anotherData[$i]->t_time;
					$newT = Carbon::parse($time);
					$anotherData[$i]->formattedTime = $newT->format('g:i A');
					$date = $anotherData[$i]->t_date;

					if($date){
						$newD = Carbon::parse($date);
						$anotherData[$i]->formattedDate = $newD->toFormattedDateString();
					} else {
						$anotherData[$i]->formattedDate = 'N/A';
					}					
					
					//updated
					$time = $anotherData[$i]->updated_at;
					$newT = Carbon::parse($time);
					$anotherData[$i]->formattedUpatedTime = $newT->format('g:i A');
					$date = $anotherData[$i]->updated_at;
					$newD = Carbon::parse($date);
					$anotherData[$i]->formattedUpdatedDate = $newD->toFormattedDateString();
				}
				
				//dd($anotherData);
				return $anotherData;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		/////// View All Process Flow
		public static function getAllDataEvaluateOne($appid) // Get All Information on Single Application
		{
			try 
			{
				$data = DB::table('appform')
						->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
						->leftJoin('barangay', 'appform.brgyid', '=', 'barangay.brgyid')
						->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
						->leftJoin('province', 'appform.provid', '=', 'province.provid')
						->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id') 
						->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
						->leftJoin('facmode', 'appform.facmode', '=', 'facmode.facmid')
						->select('appform.*', 'appform.street_name', 'appform.street_name as streetname', 'x08.zipcode' ,'barangay.brgyname', 'city_muni.cmname', 'province.provname', 'appform.recommendedtime', 'appform.recommendeddate', 'hfaci_serv_type.*', 'appform.aptid', 'appform.status', 'trans_status.trns_desc', 'facmode.facmdesc', 'appform.street_number')
						->where('appform.appid', '=', $appid)
						->first();
				
				if (isset($data) && ($data->recommendedtime !== null && $data->recommendeddate !== null)) {
						$newT = Carbon::parse($data->proposedInspectiontime);
						$data->formattedPropTime = $newT->format('g:i A');
						$newD = Carbon::parse($data->proposedInspectiondate);
						$data->formattedPropDate = $newD->toFormattedDateString();
					}

				//$data = DB::table('applist_details')->where('appid', '=', $appid)->first();

				return $data;
			
				
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		// outdated query
		public static function getAllDataEvaluateOneRegFac($regfac_id) // Get All Information on Single Application
		{
			try 
			{
				$data = DB::table('registered_facility')
						// ->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
						->leftJoin('barangay', 'registered_facility.brgyid', '=', 'barangay.brgyid')
						->leftJoin('city_muni', 'registered_facility.cmid', '=', 'city_muni.cmid')
						->leftJoin('province', 'registered_facility.provid', '=', 'province.provid')
						->leftJoin('facmode', 'registered_facility.facmode', '=', 'facmode.facmid')
						->select('registered_facility.*', 'registered_facility.street_name', 'registered_facility.street_name as streetname' ,'barangay.brgyname', 'city_muni.cmname', 'province.provname','facmode.facmdesc', 'registered_facility.street_number')
						// ->select('appform.*', 'appform.street_name', 'appform.street_name as streetname', 'x08.zipcode' ,'barangay.brgyname', 'city_muni.cmname', 'province.provname', 'appform.recommendedtime', 'appform.recommendeddate', 'hfaci_serv_type.*', 'appform.aptid', 'appform.status', 'trans_status.trns_desc', 'facmode.facmdesc', 'appform.street_number')
						->where('registered_facility.regfac_id', '=', $regfac_id)
						->first();			
				
				return $data;				
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}

		// Get the latest appid
		public static function getLatestAppIDbyRegFac_ID($regfac_id) 
		{
			try	
			{
				if(empty($regfac_id))
				{ return null; }

				$data = DB::SELECT ("SELECT *, appid AS con_id, appid AS ptc_id, appid AS lto_id, appid AS coa_id, appid AS cor_id, appform.street_name as streetname, barangay.brgyname, city_muni.cmname, province.provname, facmode.facmdesc 
				FROM appform LEFT JOIN barangay ON appform.brgyid=barangay.brgyid 
				LEFT JOIN city_muni ON appform.cmid=city_muni.cmid 
				LEFT JOIN province ON province.provid=appform.provid 
				LEFT JOIN facmode ON appform.facmode=facmode.facmid 
				WHERE regfac_id='$regfac_id' AND status='A' 
				ORDER BY appid DESC LIMIT 1;");

				if(is_array($data))
				{
					return $data[0];
				}
				else{ return null;} 
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}

		public static function getAllRequirementsLTO($appid){
			$annexa = DB::table('hfsrbannexa')->where('appid',$appid)->get();
			$annexb = DB::table('hfsrbannexb')->where('appid',$appid)->get();
			// $annexc = DB::table('hfsrbannexc')->where('appid',$appid)->get();
			// $annexd = DB::table('hfsrbannexd')->where('appid',$appid)->get();
			// $annexf = DB::table('hfsrbannexf')->where('appid',$appid)->get();
			// $annexh = DB::table('hfsrbannexh')->where('appid',$appid)->get();
			// $annexi = DB::table('hfsrbannexi')->where('appid',$appid)->get();
			return [
				[asset('client1/apply/hfsrb/view/annexa/'),' LIST OF PERSONNEL (Annex A)', $annexa, 'hfsrbannexa'],
				[asset('client1/apply/hfsrb/view/annexb/'),' LIST OF EQUIPMENT/ INSTRUMENT (Annex B)', $annexb, 'hfsrbannexb'],
				// [asset('client1/apply/hfsrb/view/annexc/'),'LIST OF EQUIPMENT, REAGENT, LABORATORY WARE AND MATERIALS FOR SPECIFIC TEST (Annex C)' , $annexc, 'hfsrbannexc'],
				// [asset('client1/apply/hfsrb/view/annexd/'),'LIST OF PRODUCTS (Annex D)', $annexd, 'hfsrbannexd'],
				// [asset('client1/apply/hfsrb/view/annexf/'), 'LIST OF PERSONNEL FOR DIAGNOSTIC RADIOLOGY AND RADIATION SERVICES (Annex F)', $annexf, 'hfsrbannexf'],
				// [asset('client1/apply/hfsrb/view/annexh/'), 'LIST OF EQUIPMENT, LABORATORY WARE AND MATERIALS (Annex H)', $annexh, 'hfsrbannexh'],
				// [asset('client1/apply/hfsrb/view/annexi/'), 'LIST OF TESTING MATERIALS (Annex I)', $annexi, 'hfsrbannexi']
			];
			
		}

		public static function getCdrrPersonnellistById()
		{
			return DB::table('cdrrpersonnel')->join('hfsrbannexa', 'cdrrpersonnel.hfsrbannexaID', '=', 'hfsrbannexa.id')
				->join('position','position.posid','hfsrbannexa.prof')
				->select('cdrrpersonnel.*', 'position.posname', 'hfsrbannexa.profession', 'hfsrbannexa.dob', 'hfsrbannexa.prcno', 'hfsrbannexa.validityPeriodTo as validity')
				->where('cdrrpersonnel.appid',$appid)->get();
		}

		public static function getRequirementsFDA($appid){
			$cocp = DB::table('fda_coc')->where('appid',$appid)->where('fda_type', 'Pharmacy')->get();
			$cocr = DB::table('fda_coc')->where('appid',$appid)->where('fda_type', 'Radiology')->get();
			$personnelCDRR = DB::table('cdrrpersonnel')->where('appid',$appid)->get();
			$personnelCDRRHR = DB::table('cdrrhrpersonnel')->where('appid',$appid)->get();
			$xrayservcatCDRRHR = DB::table('cdrrhrxrayservcat')->where('appid',$appid)->get();
			$xraylistCDRRHR = DB::table('cdrrhrxraylist')->where('appid',$appid)->get();
			$otherattachCDRR = DB::table('cdrrattachment')->where('appid',$appid)->get();
			$otherattachCDRRHR = DB::table('cdrrhrotherattachment')->where('appid',$appid)->get();
			return [
				[asset('client1/apply/fda/CDRR/view/coc/'), 'OR/Proof of Payment (Pharmacy)', $cocp, 'fda_coc','CDRR'],
				[asset('client1/apply/fda/CDRRHR/view/coc/'), 'COC (Radiology)', $cocr, 'fda_coc','CDRRHR'],
				[asset('client1/apply/fda/CDRR/view/personnel/'), 'LIST OF PERSONNEL (Pharmacy)', $personnelCDRR, 'cdrrpersonnel','CDRR'],
				[asset('client1/apply/fda/CDRRHR/view/personnel/'), 'LIST OF PERSONNEL (Machines)', $personnelCDRRHR, 'cdrrhrpersonnel','CDRRHR'],
				[asset('client1/apply/fda/CDRRHR/view/xrayservcat/'), 'X-RAY SERVICE CATEGORY', $xrayservcatCDRRHR, 'cdrrhrxrayservcat','CDRRHR'],
				[asset('client1/apply/fda/CDRRHR/view/xraymachines'), 'LIST OF X-RAY MACHINES', $xraylistCDRRHR, 'cdrrhrxraylist','CDRRHR'],
				[asset('client1/apply/fda/CDRR/view/otherattachment'), 'OTHER ATTACHMENTS (Pharmacy)', $otherattachCDRR, 'cdrrattachment','CDRR'],
				[asset('client1/apply/fda/CDRRHR/view/otherattachments'), 'OTHER ATTACHMENTS(Machines)', $otherattachCDRRHR, 'cdrrhrotherattachment', 'CDRRHR']
			];
		}

		public static function getAllDataEvaluateOneUploads($appid, $selected, $office = "hfsrb") // Get All Uploaded data
		{
			try 
			{
				switch ($selected) {
					case 0:
					 $data = DB::select("SELECT appform.appid, app_upload.*, upload.updesc, upload.office, app_upload.upDescRemarks FROM app_upload INNER JOIN appform ON app_upload.app_id = appform.appid LEFT JOIN upload ON app_upload.upid = upload.upid WHERE appform.appid = '$appid' AND upload.office = '$office' ");
						// $data = DB::table('appform') // Uploaded
							// // ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
							// ->join('upload', 'app_upload.upid', '=', 'upload.upid')
							// ->select('appform.appid', 'appform.facid', 'app_upload.*', 'upload.updesc')
							// ->where('appform.appid', '=', $appid)
							// ->get();
						if (count($data)) {
							for ($i=0; $i < count($data); $i++) { 
								$newT = Carbon::parse($data[$i]->t_time);
								$data[$i]->formattedUploadTime = $newT->format('g:i A');
								$newD = Carbon::parse($data[$i]->t_date);
								$data[$i]->formattedUploadDate = $newD->toFormattedDateString();
							}
						}
						break;
					case 1:
					$data = DB::select("SELECT appform.appid, app_upload.*, upload.updesc FROM app_upload INNER JOIN appform ON app_upload.app_id = appform.appid LEFT JOIN upload ON app_upload.upid = upload.upid WHERE appform.appid = '$appid' AND app_upload.evaluation = 0");
						// $data = DB::table('appform') // Rejected Applications
							// ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
							// ->join('upload', 'app_upload.upid', '=', 'upload.upid')
							// ->select('appform.appid', 'app_upload.*', 'upload.updesc')
							// ->where('appform.appid', '=', $appid)
							// ->where('app_upload.evaluation', '=', 0)
							// ->get();
						break;
					case 2:
					$data = DB::select("SELECT appform.appid, app_upload.*, upload.updesc FROM app_upload INNER JOIN appform ON app_upload.app_id = appform.appid LEFT JOIN upload ON app_upload.upid = upload.upid WHERE appform.appid = '$appid'");
						// $data = DB::table('appform') // Applications
							// ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
							// ->join('upload', 'app_upload.upid', '=', 'upload.upid')
							// ->select('appform.appid', 'app_upload.*', 'upload.updesc')
							// ->where('appform.appid', '=', $appid)
							// ->get();	
						break;
					case 3:
					$data = DB::select("SELECT appform.appid, app_upload.*, upload.updesc FROM app_upload INNER JOIN appform ON app_upload.app_id = appform.appid LEFT JOIN upload ON app_upload.upid = upload.upid WHERE appform.appid = '$appid' AND app_upload.evaluation = 1");
						// $data = DB::table('appform') // Approved Applications
							// ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
							// ->join('upload', 'app_upload.upid', '=', 'upload.upid')
							// ->select('appform.appid', 'app_upload.*', 'upload.updesc')
							// ->where('appform.appid', '=', $appid)
							// ->where('app_upload.evaluation', '=', 1)
							// ->get();
						break;
					case 4:
					$data = DB::select("SELECT appform.appid, app_upload.*, upload.updesc FROM app_upload INNER JOIN appform ON app_upload.app_id = appform.appid LEFT JOIN upload ON app_upload.upid = upload.upid WHERE appform.appid = '$appid' AND app_upload.evaluation IS NULL");
						// $data = DB::table('appform') // Not yet Approved/Rejected Applications
							// ->join('app_upload', 'appform.appid', '=', 'app_upload.app_id')
							// ->join('upload', 'app_upload.upid', '=', 'upload.upid')
							// ->select('appform.appid', 'app_upload.*', 'upload.updesc')
							// ->where('appform.appid', '=', $appid)
							// ->where('app_upload.evaluation', '=', null)
							// ->get();
						break;
					case 5:
						$data =  DB::table('appform_orderofpayment')->where('appid', '=', $appid)->first();
						break;
					default:
							$data = null;
						break;
				}
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function getSingleDownloadDetails(Request $request)
		{
			try 
			{
				$data = DB::table('app_upload')
					->join('x08', 'app_upload.evaluatedby', '=', 'x08.uid' )
					->select('app_upload.*', 'x08.fname', 'x08.mname', 'x08.lname', 'x08.grpid')
					->where('app_upload.apup_id', '=', $request->apup_id)
					->first();
				if (!$data) {
					return 'NONE';
				} else {
					$newT = Carbon::parse($data->evaltime);
					$data->formattedEvalTime = $newT->format('g:i A');
					$newD = Carbon::parse($data->evaldate);
					$data->formatteEvalDate = $newD->toFormattedDateString();
					return response()->json($data);
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'NONE';
			}
		}
		public static function JudgeApplication(Request $request)
		{
			try 
			{
				if($request->has('apid')){
					$appform = DB::table('appform')->where('appid',$request->apid)->first();
					$clienthfser_id = $appform->hfser_id;
					$Cur_useData = AjaxController::getCurrentUserAllData();
					$settings = AjaxController::getAllSettings();
					$selected = AjaxController::getUidFrom($request->apid);

					if ($request->selected == 0)  // Rejected
					{
						$updateData = array(
											'isrecommended'=>0,
											'recommendedby' => $Cur_useData['cur_user'],
											'recommendedtime' => $Cur_useData['time'],
											'recommendeddate' =>  $Cur_useData['date'],
											'recommendedippaddr' =>$Cur_useData['ip'],
											'status' => 'RE',
											'isReadyForInspec' => 0
										);
					}
					// Approved Documentary Evaluation
					else if ($request->selected == 1)  
					{
						$stat = null;
						
						switch ($clienthfser_id) {
							case 'LTO':
								$curStat = DB::table('appform')->where('appid',$request->apid)->select('status')->first()->status;
								if($appform->aptid == 'R'){
									$stat = 'FR';
								} else {
									$stat = 'FI';
								}
								break;
							case 'COA':
								$curStat = DB::table('appform')->where('appid',$request->apid)->select('status')->first()->status;
								if($appform->aptid == 'R'){
									$stat = 'FR';
								} else {
									$stat = 'FI';
								}
								break;
							case 'ATO':
								$curStat = DB::table('appform')->where('appid',$request->apid)->select('status')->first()->status;
								if($appform->aptid == 'R'){
									$stat = 'FR';
								} else {
									$stat = 'FI';
								}
								break;
							case 'COR':
								$curStat = DB::table('appform')->where('appid',$request->apid)->select('status')->first()->status;
								if($appform->aptid == 'R'){
									$stat = 'FR';
								} else {
									$stat = 'FI';
								}
								break;
							case 'PTC':
								if(DB::table('appform')->where([['appid',$request->apid],['isAcceptedFP','<>',1]])->doesntExist()){
									$stat = 'FPPR';
								} else {
									$stat = 'FPE';
								}
								break;
							
							default:
								$stat = 'FPE';
								break;

						}
						$hfser = DB::table('appform')->where('appid',$request->apid)->select('hfser_id')->first()->hfser_id;

						if(strtolower($hfser) == 'lto' || strtolower($hfser) == 'coa' || strtolower($hfser) == 'ato' || strtolower($hfser) == 'cor'){
							if($appform->aptid == 'R'){
								$newstat = 'FR';
							} else {
								$newstat = 'FI';
							}
						} else {
							$newstat = 'P';
						}

						$updateData = array(
							'isrecommended'=>1,
							'recommendedby' => $Cur_useData['cur_user'],
							'recommendedtime' => $Cur_useData['time'],
							'recommendeddate' =>  $Cur_useData['date'],
							'recommendedippaddr' =>$Cur_useData['ip'],
							'isPayEval' => 1,
							'payEvalby' => $Cur_useData['cur_user'],
							'payEvaldate' => $Cur_useData['date'],
							'payEvaltime' => $Cur_useData['time'],
							'payEvalip'=> $Cur_useData['ip'],
							'status' => $newstat,
							'isReadyForInspec' => 1
							// 'FDAStatMach' => 'For Evaluation'
						);
					}
					// Revised Documentary Evaluation
					else if ($request->selected == 2)  
					{
						$getTimeChck = DB::table('appform')->where('appid', '=', $request->apid)->first();
						$chkUpd = $getTimeChck->no_chklist + 1;
						if ($chkUpd > $settings->no_tries) {
							return 'MAX';
						}
						$updateData = array(
											'isrecommended'=> 2,
											'recommendedby' => $Cur_useData['cur_user'],
											'recommendedtime' => $Cur_useData['time'],
											'recommendeddate' =>  $Cur_useData['date'],
											'recommendedippaddr' =>$Cur_useData['ip'],
											'no_chklist' => $chkUpd,
											'status' => 'REV',
											'isReadyForInspec' => 0
											// 'FDAStatMach' => 'Evaluated, but for Revision'
										);
					}
					
					$userInf = DB::table('appform')->select('hfser_id','uid')->where('appid',$request->apid)->first();
					$idForNotify = self::getNotificationIDfromCases($userInf->hfser_id,'eval',$updateData['isrecommended']);
					
					//FDA
					if(isset($request->requestFor) && strtolower($request->requestFor) != 'hfsrb')
					{
						$suffix = '';

						if(strtolower($request->requestFor) == 'pharma'){
							$suffix = 'pharma';
						}
						$idForNotify = self::getNotificationIDfromCases('FDA','eval',$request->selected);
						$updateData = array(
							'ispreassessed'.$suffix =>$request->selected,
							'ispreassessedby'.$suffix => $Cur_useData['cur_user'],
							'ispreassessedtime'.$suffix => $Cur_useData['time'],
							'ispreassesseddate'.$suffix =>  $Cur_useData['date'],
							'ispreassessedip'.$suffix =>$Cur_useData['ip'],
							'FDAstatus' => $updateData['status']
						);
						$curappf = DB::table('appform')->where('appid',$request->apid)->first();

						if($request->selected == 2){
							$updateData['isReadyForInspecFDA'] = 0;

							if(strtolower($request->requestFor) == 'pharma'){
								$updateData['FDAStatPhar'] = "Evaluated, but for Revision";
								$updateData['pharDocNeedRev'] = 1;
								$updateData['pharDocRevcount'] = $curappf->pharDocRevcount + 1;
							}else{
								$updateData['FDAStatMach'] = "Evaluated, but for Revision";
								$updateData['machDocNeedRev'] = 1;
								$updateData['machDocRevcount'] = $curappf->machDocRevcount + 1;
							}
						}

						if( $request->selected ==  1){
							if($request->coc == 1){
								// dito yung approve 
								if(strtolower($request->requestFor) == 'pharma'){

									$updateData['isApproveFDAPharma'] = 1;
									$updateData['approvedByFDAPharma'] = $Cur_useData['cur_user'];  
									$updateData['approvedDateFDAPharma'] = $Cur_useData['date'];
									$updateData['approvedTimeFDAPharma'] = $Cur_useData['time'];// Time
									$updateData['approvedIpAddFDAPharma'] = $Cur_useData['ip'];//IP ADDRESS
									$updateData['approvedRemarkFDAPharma'] = '';  //empty
									$updateData['FDAStatPhar'] = 'COC Still Valid';


						
									// $updateData['FDAstatus'] = 'A';
									
									// $updateData['FDAStatPhar'] = "For Inspection";
								}elseif(strtolower($request->requestFor) == 'xray'){
				
									// $updateData['FDAstatus'] = 'A';
									$updateData['isApproveFDA'] = 1;
									$updateData['approvedByFDA'] = $Cur_useData['cur_user'];  
									$updateData['approvedDateFDA'] = $Cur_useData['date']; // Date
									$updateData['approvedTimeFDA'] = $Cur_useData['time'];  // Time
									$updateData['approvedIpAddFDA'] = $Cur_useData['ip']; //IP ADDRESS
									$updateData['approvedRemarkFDA'] = '';
									$updateData['FDAStatMach'] = 'COC Still Valid';
								}
	
							} else {
								$updateData['isReadyForInspecFDA'] = 1;
	
								if(strtolower($request->requestFor) == 'pharma'){
									$updateData['FDAStatPhar'] = "For Payment";
									// $updateData['FDAStatPhar'] = "For Inspection";
								}else{
									$updateData['FDAStatMach'] = "For Payment";
									// $updateData['FDAStatMach'] = "For Inspection";
								}
							}
						}
										
					}
					if(isset($request->isCoa) && !isset($appform->coaflag)){
						$updateData = array(
							'coaflag' => json_encode($updateData)
						);
					}
					$test = DB::table('appform')->where('appid', '=', $request->apid)->update($updateData);

					try {
						if ($test) {
							AjaxController::notifyClient($request->apid,$userInf->uid,$idForNotify);
							return 'DONE';
						} 
						else {
							$data = AjaxController::SystemLogs('No data has been modified in appform table. (JudgeApplication)');
							// return 'ERROR';
						}
					} catch (Exception $e) {
						return json_encode($e);
					}
						
				} else {
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				return json_encode($e);
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
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

		public static function JudgeApplicationFDA(Request $request)
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$settings = AjaxController::getAllSettings();
				$selected = AjaxController::getUidFrom($request->apid);
				if ($request->selected == 0)  // Rejected
				{
					$updateData = array(
										'isrecommendedFDA'=>0,
										'recommendedbyFDA' => $Cur_useData['cur_user'],
										'recommendedtimeFDA' => $Cur_useData['time'],
										'recommendeddateFDA' =>  $Cur_useData['date'],
										'recommendedippaddrFDA' =>$Cur_useData['ip'],
										'FDAstatus' => 'RE',
									);
				}
				else if ($request->selected == 1)  // Approved
				{
					$updateData = array(
										'isrecommendedFDA'=>1,
										'recommendedbyFDA' => $Cur_useData['cur_user'],
										'recommendedtimeFDA' => $Cur_useData['time'],
										'recommendeddateFDA' =>  $Cur_useData['date'],
										'recommendedippaddrFDA' =>$Cur_useData['ip'],
										'FDAstatus'=> 'FPE'
									);
				}
				else if ($request->selected == 2)  // Revised
				{
					$getTimeChck = DB::table('appform')->where('appid', '=', $request->apid)->first();
					$chkUpd = $getTimeChck->no_chklist + 1;
					if ($chkUpd > $settings->no_tries) {
						return 'MAX';
					}
					$updateData = array(
										'isrecommendedFDA'=> 2,
										'recommendedbyFDA' => $Cur_useData['cur_user'],
										'recommendedtimeFDA' => $Cur_useData['time'],
										'recommendeddateFDA' =>  $Cur_useData['date'],
										'recommendedippaddrFDA' =>$Cur_useData['ip'],
										'no_chklistFDA' => $chkUpd,
										'FDAstatus' => 'REV',
										'isReadyForInspecFDA' => 0
									);
					DB::table('appform')->where('appid',$request->apid)->update(['isReadyForInspecFDA' => NULL]);
				}
				
				$test = DB::table('appform')->where('appid', '=', $request->apid)->update($updateData);
					if ($test) {
						$userInf = DB::table('appform')->select('hfser_id','uid')->where('appid',$request->apid)->first();
						$idForNotify = self::getNotificationIDfromCases('FDA','eval',$updateData['isrecommendedFDA']);
						AjaxController::notifyClient($request->apid,$userInf->uid,$idForNotify);
						return 'DONE';
					} 
					else {
						$data = AjaxController::SystemLogs('No data has been modified in appform table. (JudgeApplication)');
						return 'ERROR';
					}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Evaluate One
		/////// Order of Payment One
		public static function getAllDataOrderOfPaymentUploads($appid, $selected)
		{
			try 
			{
				switch ($selected) 
				{
					case 0:
						$data = DB::table('chgfil')
										->join('chg_app', 'chgfil.chgapp_id', '=', 'chg_app.chgapp_id')
										->join('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
										->join('category', 'charges.cat_id', '=', 'category.cat_id')
										->join('m04','chgfil.m04ID_FK','m04.m04IDA')
										// ->join('orderofpayment', 'chg_app.oop_id', '=', 'orderofpayment.oop_id')
										->where('chgfil.appform_id', '=', $appid)
										// ->orderBy('chg_app.oop_id','asc')
										->get();
						if (isset($data)) {
							for ($i=0; $i < count($data); $i++) { 
									$getOOP = DB::table('orderofpayment')
												->select('oop_desc')
												->where('oop_id', '=', $data[$i]->oop_id)->first();
									if ($getOOP) {
										$data[$i]->oop_desc = $getOOP->oop_desc; 
									} else {
										$data[$i]->oop_desc = ''; 
									}
							}
						}
						break;
					case 1:
						$data = DB::table('chgfil')->where('appform_id', '=', $appid)->sum('amount');
						break;
					case 2 :
						$data = DB::table('chgfil')
										->join('chg_app', 'chgfil.chgapp_id', '=', 'chg_app.chgapp_id')
										->select('chg_app.oop_id')
										->where('chgfil.appform_id', '=', $appid)->distinct()->get();
						break;
					case 3:
						$data = DB::table('chg_app')
									->join('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
									->where('chg_app.aptid', '=', $appid)
									->orderBy('chg_app.oop_id','asc')
									->orderBy('chg_app.chgopp_seq', 'asc')
									->get();
						for ($i=0; $i < count($data); $i++) { 
							$data[$i]->formattedAmt = 'PHP '.number_format($data[$i]->amt,2);
						}
						break;
					case 4:
						$data = (
								DB::table('chgfil')
								->where('reference','<>','Payment')
								->where('appform_id',$appid)
								->get()
								->sum('amount')
								-
								DB::table('chgfil')
								->where('reference','Payment')
								->where('appform_id',$appid)
								->get()
								->sum('amount')
								);
						break;
					case 5:
						$data = DB::table('chgfil')
										->leftjoin('chg_app', 'chgfil.chgapp_id', '=', 'chg_app.chgapp_id')
										->leftjoin('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
										->leftjoin('category', 'charges.cat_id', '=', 'category.cat_id')
										->leftjoin('m04','chgfil.m04ID_FK','m04.m04IDA')
										->where([['chgfil.appform_id', '=', $appid],['chgfil.amount','<>',NULL]])
										->get();
										
						if (isset($data)) {
							for ($i=0; $i < count($data); $i++) { 
								$getOOP = DB::table('orderofpayment')
											->select('oop_desc')
											->where('oop_id', '=', $data[$i]->oop_id)->first();
								if ($getOOP) {
									$data[$i]->oop_desc = $getOOP->oop_desc; 
								} else {
									$data[$i]->oop_desc = ''; 
								}
							}
						}
						break;
					default:
						$data = null;
						break;
				}

				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		public static function DeleteChargeOrderofPayment(Request $request)
		{
			try 
			{
				// $getData = DB::table('chgfil')->where('id', '=', $request->id)->first();
				// return dd($request);
				// return 'TEST';
				$test = DB::table('chgfil')->where('id', '=', $request->id)->delete();
				// $updateData = array('chg_num'=>$getData->chg_num);
				// $test2 = DB::table('chg_app')->where('chgapp_id', '=', $getData->chgapp_id)->update($updateData);
				if (isset($test)) { return 'DONE';} //&& $test2
				else {
					$data = AjaxController::SystemLogs('No data has been deleted in chgfil tables. (DeleteChargeOrderofPayment)'); //and chg_app 
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}

		public static function DeleteChargeOrderofPaymentFDA(Request $request)
		{
			try 
			{
				$test = DB::table('fda_chgfil')->where('fda_chgfilid', '=', $request->id)->delete();
				if (isset($test)) { return 'DONE';}
				else {
					$data = AjaxController::SystemLogs('No data has been deleted in chgfil tables. (DeleteChargeOrderofPayment)'); //and chg_app 
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}

		
		public static function getAllSurcharge() {
			try 
			{
				$data = DB::table('application_discount')->where('percentage','<','0.00')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllDiscount() {
			try 
			{
				$data = DB::table('application_discount')->where('percentage','>=','0.00')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		//joined with position
		public static function getAllProfession(){
			try 
			{
				$data = DB::table('profession')->join('position', 'profession.position_id', '=', 'position.posid')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		//get profession only
		public static function getAllProfessionOnly(){
			try 
			{
				$data = DB::table('profession')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}


		public static function getAllPosition(){
			try 
			{
				//Arrange by FDA TYPE NULL is on last group
				$data = DB::table('position')
								->select('posid', 'fda_type', 'posname', 'groupRequired')
								->orderByRaw("ISNULL(fda_type) asc")
								->orderBy('fda_type','asc')
								->orderBy('posname','asc')
								->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}



		public static function AcceptOrderOfPaymentProcessFlow(Request $request)
		{
			try 
			{
				if($request->has('id')){
					$Cur_useData = AjaxController::getCurrentUserAllData();
					// APPROVE and disapprove 
					if ($request->selected == 0) 
					{
						$hfser = DB::table('appform')->where('appid',$request->id)->select('hfser_id')->first()->hfser_id;
						$data = array(
										'isPayEval' => $request->AoR,
										'payEvalby' => $Cur_useData['cur_user'],
										'payEvaldate' => $Cur_useData['date'],
										'payEvaltime' => $Cur_useData['time'],
										'payEvalip'=> $Cur_useData['ip'],
										'status' => ($request->AoR == 1 ? (strtolower($hfser) == 'ptc' ? 'FPPR' : 'CE') : 'FPER')
								);
						$test = DB::table('appform')->where('appid', '=', $request->id)->update($data);
						$selected = AjaxController::getUidFrom($request->id);
						if ($test) {
							AjaxController::notifyClient($request->id,$selected,($request->AoR == 1 ? 17 : 18));
							return 'DONE';
						} else{
							AjaxController::SystemLogs('No data has been updated in appform table. (AcceptOrderOfPaymentProcessFlow)');
							return 'ERROR';
						}	
					}

					else if ($request->selected == 1) 
					{
							$data = array(
											'isCashierApprove' => $request->AoR,
											'CashierApproveBy' => $Cur_useData['cur_user'],
											'CashierApproveDate' => $Cur_useData['date'],
											'CashierApproveTime' => $Cur_useData['time'],
											'CashierApproveIp'=> $Cur_useData['ip']
									);
							$test = DB::table('appform')->where('appid', '=', $request->id)->update($data);
							$selected = AjaxController::getUidFrom($request->id);
							AjaxController::notifyClient($selected, 2);
							if ($test) {
								return 'DONE';
							} else{
								AjaxController::SystemLogs('No data has been updated in appform table. (AcceptOrderOfPaymentProcessFlow)');
								return 'ERROR';
							}
					}

				} else {
					return 'ERROR';
				}

			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}

		public static function AcceptOrderOfPaymentProcessFlowFDAMachines(Request $request)
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				if ($request->selected == 0) 
				{
					$data = array(
									'isPayEvalFDA' => $request->AoR,
									'payEvalbyFDA' => $Cur_useData['cur_user'],
									'payEvaldateFDA' => $Cur_useData['date'],
									'payEvaltimeFDA' => $Cur_useData['time'],
									'payEvalipFDA'=> $Cur_useData['ip'],
									'FDAstatus' => ($request->AoR == 1 ? 'CE' : 'FPER')
							);
					$test = DB::table('appform')->where('appid', '=', $request->id)->update($data);
					if ($test) {
						$selected = AjaxController::getUidFrom($request->id);
						AjaxController::notifyClient($request->id,$selected,($request->AoR == 1 ? 34 : 35));
						return 'DONE';
					} else{
						AjaxController::SystemLogs('No data has been updated in appform table. (AcceptOrderOfPaymentProcessFlow)');
						return 'ERROR';
					}	
				}
				else if ($request->selected == 1) 
				{
						$data = array(
										'isCashierApproveFDA' => $request->AoR,
										'CashierApproveByFDA' => $Cur_useData['cur_user'],
										'CashierApproveDateFDA' => $Cur_useData['date'],
										'CashierApproveTimeFDA' => $Cur_useData['time'],
										'CashierApproveIpFDA'=> $Cur_useData['ip']
								);
						$test = DB::table('appform')->where('appid', '=', $request->id)->update($data);
						if ($test) {
							$selected = AjaxController::getUidFrom($request->id);
							AjaxController::notifyClient($request->id,$selected, 36);
							return 'DONE';
						} else{
							AjaxController::SystemLogs('No data has been updated in appform table. (AcceptOrderOfPaymentProcessFlow)');
							return 'ERROR';
						}
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}


		public static function AcceptOrderOfPaymentProcessFlowFDAPharma(Request $request)
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				if ($request->selected == 0) 
				{
					$data = array(
									'isPayEvalFDAPharma' => $request->AoR,
									'payEvalbyFDAPharma' => $Cur_useData['cur_user'],
									'payEvaldateFDAPharma' => $Cur_useData['date'],
									'payEvaltimeFDAPharma' => $Cur_useData['time'],
									'payEvalipFDAPharma'=> $Cur_useData['ip'],
									'FDAstatus' => ($request->AoR == 1 ? 'CE' : 'FPER')
							);
					$test = DB::table('appform')->where('appid', '=', $request->id)->update($data);
					if ($test) {
						$selected = AjaxController::getUidFrom($request->id);
						AjaxController::notifyClient($request->id,$selected,($request->AoR == 1 ? 34 : 35));
						return 'DONE';
					} else{
						AjaxController::SystemLogs('No data has been updated in appform table. (AcceptOrderOfPaymentProcessFlow)');
						return 'ERROR';
					}	
				}
				else if ($request->selected == 1) 
				{
						$data = array(
										'isCashierApproveFDA' => $request->AoR,
										'CashierApproveByFDA' => $Cur_useData['cur_user'],
										'CashierApproveDateFDA' => $Cur_useData['date'],
										'CashierApproveTimeFDA' => $Cur_useData['time'],
										'CashierApproveIpFDA'=> $Cur_useData['ip']
								);
						$test = DB::table('appform')->where('appid', '=', $request->id)->update($data);
						if ($test) {
							$selected = AjaxController::getUidFrom($request->id);
							AjaxController::notifyClient($request->id,$selected, 36);
							return 'DONE';
						} else{
							AjaxController::SystemLogs('No data has been updated in appform table. (AcceptOrderOfPaymentProcessFlow)');
							return 'ERROR';
						}
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		/////// Order of Payment One
		/////// Assignment of Team
		public static function getTeamInRegion(Request $request) // Get Teams in the Region
		{
			try 
			{
				$data = DB::table('team')->where('rgnid', '=', $request->rgn)->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function getMembersInRegionWithoutTeam(Request $request)
		{
			try 
			{
				$assignedRgn = (DB::table('appform')->select('assignedRgn')->where('appid',$request->id)->first()->assignedRgn ?? $request->rgn);
				$query = 	"SELECT x08.uid, x08.fname, x08.mname, x08.lname, x08.position, x08.team, x07.grp_desc
						  	FROM x08 LEFT JOIN  x07 ON x08.grpid = x07.grp_id 
							WHERE x08.grpid <> 'C' AND x08.team IS null AND x08.rgnid = '$assignedRgn' AND  x08.uid NOT IN (SELECT uid FROM app_team WHERE appid = '$request->id') AND x08.grpid IN ('LO1','LO2','LO4','RLO','DC','01','HFERC','HFSRBLO','LO','LO3','CM') ";
				$data = DB::select($query);			
					if ($data) {
						for ($i=0; $i < count($data) ; $i++) { 
							$x = $data[$i]->mname;
						      	if ($x != "") {
							    	$mid = strtoupper($x[0]);
							    	$mid = $mid.'. ';
					       		 } else {
							    	$mid = ' ';
							 		}
							$data[$i]->wholename = $data[$i]->fname.' '.$mid.''.$data[$i]->lname;
							if (!isset($data[$i]->position)) {
								$data[$i]->position = 'Not Available';
							}
						}
					} 
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function getMembersInRegion(Request $request)
		{
			try 
			{
				// $data = DB::table('x08')
				// 				->join('x07', 'x08.grpid', '=', 'x07.grp_id')
				// 				->select('x08.uid', 'x08.fname', 'x08.mname', 'x08.lname', 'x08.position', 'x08.team', 'x07.grp_desc')
				// 				->where('x08.team', '=', $request->teamid)
				// 				->get();

				$check = DB::table('appform')->select('assignedRgn')->where('appid',$request->id)->first()->assignedRgn;

				if($check == 'hfsrb'){
					$query = 	"SELECT x08.uid, x08.fname, x08.mname, x08.lname, x08.position, x08.team, x07.grp_desc
					FROM x08 LEFT JOIN  x07 ON x08.grpid = x07.grp_id 
				  WHERE x08.team = '$request->teamid' AND  x08.uid NOT IN (SELECT uid FROM app_team WHERE teamid = '$request->teamid' AND appid = '$request->id')";
  
				}else{
					$query = 	"SELECT x08.uid, x08.fname, x08.mname, x08.lname, x08.position, x08.team, x07.grp_desc
					FROM x08 LEFT JOIN  x07 ON x08.grpid = x07.grp_id 
				  WHERE x08.team = '$request->teamid' AND  x08.uid NOT IN (SELECT uid FROM app_team WHERE teamid = '$request->teamid' AND appid = '$request->id')";
  
				}


				// $data = DB::table('x08')
				// 				->join('x07', 'x08.grpid', '=', 'x07.grp_id')
				// 				->select('x08.uid', 'x08.fname', 'x08.mname', 'x08.lname', 'x08.position', 'x08.team', 'x07.grp_desc')
				// 				->where('x08.team', '=', $request->teamid)
				// 				->get();
					$data = DB::select($query);			
					if ($data) {
						for ($i=0; $i < count($data) ; $i++) { 
							$x = $data[$i]->mname;
						      	if ($x != "") {
							    	$mid = strtoupper($x[0]);
							    	$mid = $mid.'. ';
					       		 } else {
							    	$mid = ' ';
							 		}
							$data[$i]->wholename = $data[$i]->fname.' '.$mid.''.$data[$i]->lname;
							if (!isset($data[$i]->position)) {
								$data[$i]->position = 'Not Available';
							}
						}
					} 
					return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function getAssignedMembersInTeam(Request $request)
		{
			try 
			{
				$data = DB::table('app_team')
							->join('x08', 'app_team.uid', '=' , 'x08.uid' )
							->select('app_team.*', 'x08.fname', 'x08.mname', 'x08.lname')
							->where('app_team.appid', '=', $request->appid)->get();
					if (count($data) != 0) {
						for ($i=0; $i < count($data) ; $i++) { 
							$x = $data[$i]->mname;
						      	if ($x != "") {
							    	$mid = strtoupper($x[0]);
							    	$mid = $mid.'. ';
					       		 } else {
							    	$mid = ' ';
							 		}
							$data[$i]->wholename = $data[$i]->fname.' '.$mid.''.$data[$i]->lname;
						}
						return $data;
					} else {
						return 'NONE';
					}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}

		public static function getAssignedMembersInTeamChecker($param)
		{
			$data = DB::table('app_team')
			->join('x08', 'app_team.uid', '=' , 'x08.uid' )
			->select('app_team.*', 'x08.fname', 'x08.mname', 'x08.lname')
			->where('app_team.appid', '=', $param->appid)->get();
			if (count($data) != 0) {
				for ($i=0; $i < count($data) ; $i++) { 
					$x = $data[$i]->mname;
						if ($x != "") {
							$mid = strtoupper($x[0]);
							$mid = $mid.'. ';
							} else {
							$mid = ' ';
							}
					$data[$i]->wholename = $data[$i]->fname.' '.$mid.''.$data[$i]->lname;
				}
			}

			return $data;
		}
		public static function delAssignedMemberInTeam(Request $request)
		{
			try 
			{
				// return $request->all();
				$test = DB::table('app_team')->where('apptid', '=', $request->id)->delete();

					if ($test) {
						// $selected = self::getUidFrom($request->id);
						AjaxController::notifyClient($request->id,$request->usid,38);
						return 'DONE';
					} else {
						$data = AjaxController::SystemLogs('No data has been deleted in app_team table. (delAssignedMemberInTeam)');
						// return 'ERROR';	
					}
			} 
			catch (Exception $e) 
			{
				return $e;
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		//
		public static function saveAssignedMembersInTeam(Request $request)
		{
			try 
			{
				if (count($request->rmk) != 0) 
				{
					for ($i=0; $i < count($request->rmk) ; $i++) { 
						$data = array('remarks' => $request->rmk[$i]);
						$test = DB::table('app_team')->where('apptid', '=', $request->ids[$i])->update($data);
					}
				}
				return 'DONE';
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function getApplicationAssessment($uid, $selected)
		{
			try 
			{
				switch ($selected) {
					case 0: // 3
							$data = DB::table('app_assessment')
								->join('assessment', 'app_assessment.asmt_id', '=', 'assessment.asmt_id')
								->join('cat_assess', 'assessment.caid', '=', 'cat_assess.caid')
								->where('app_assessment.appid', '=', $uid)->get();
						break;
					case 1: // 4
							$data = DB::table('app_assessment')
								->join('assessment', 'app_assessment.asmt_id', '=', 'assessment.asmt_id')
								// ->join('cat_assess', 'assessment.caid', '=', 'cat_assess.caid')
								->where('app_assessment.appid', '=', $uid)->distinct()->get(['caid']);
							if ($data) {
								for($i = 0; $i < count($data); $i++){
									$test = DB::table('cat_assess')->where('caid', '=', $data[$i]->caid)->first();
									$data[$i]->categorydesc = $test->categorydesc;
								}
							}
						break;
					case 2:
							$data = DB::table('app_assessment')
									->join('assessment', 'app_assessment.asmt_id', '=', 'assessment.asmt_id')
									->where('app_assessment.appid', '=', $uid)->distinct()->get(['partid']);
							if ($data) {
								for($i = 0; $i < count($data); $i++){
									$test = DB::table('part')->where('partid', '=', $data[$i]->partid)->first();
									$data[$i]->partdesc = $test->partdesc;
								}
							}
						break;
					default:
						$data = null;
						break;
				}
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}
		/////// Assignment of Team
		/////// Recommendation One
		/*public static function getRecommendationData($appid)
		{
			//try{
				$data0 = DB::table('appform')
					->join('x08', 'appform.uid', '=', 'x08.uid')
					->leftJoin('x08 AS comeval', 'appform.concommittee_evalby', '=', 'comeval.uid')
					->leftJoin('x08 AS cashval', 'appform.CashierApproveByFDA', '=', 'cashval.uid')
					->leftJoin('x08 AS recfdaval', 'appform.recommendedbyFDA', '=', 'recfdaval.uid')
					->leftJoin('x08 AS recbyfda', 'appform.RecobyFDA', '=', 'recbyfda.uid')
					->leftJoin('x08 AS recbyfdaphar', 'appform.RecobyFDAPhar', '=', 'recbyfdaphar.uid')
					->leftJoin('x08 AS recbyfdaph', 'appform.CashierApproveByPharma', '=', 'recbyfdaph.uid')
					->leftJoin('x08 AS evalby', 'appform.recommendedby', '=', 'evalby.uid')
					->leftJoin('x08 AS FDApreassesedby', 'appform.ispreassessedby', '=', 'FDApreassesedby.uid')
					->leftJoin('x08 AS FDAPharmapreassesedby', 'appform.ispreassessedbypharma', '=', 'FDAPharmapreassesedby.uid')
					->leftJoin('x07', 'comeval.grpid', '=', 'x07.grp_id')
					->leftJoin('barangay', 'appform.brgyid', '=', 'barangay.brgyid')
					->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
					->leftJoin('province', 'appform.provid', '=', 'province.provid')
					->leftjoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
					->select('appform.*', 'appform.street_number',  'x08.*',

					'comeval.fname as com_fname',  
					'comeval.pre as com_pre',  
					'comeval.suf as com_suf',  
					'comeval.mname as com_mname', 
					'comeval.lname as com_lname', 

					'cashval.fname as cash_fname',  
					'cashval.pre as cash_pre',  
					'cashval.suf as cash_suf',  
					'cashval.mname as cash_mname', 
					'cashval.lname as cash_lname', 

					'FDApreassesedby.pre as preassesedbyFDA_pre',  
					'FDApreassesedby.fname as preassesedbyFDA_fname',  
					'FDApreassesedby.mname as preassesedbyFDA_mname', 
					'FDApreassesedby.lname as preassesedbyFDA_lname',  
					'FDApreassesedby.suf as preassesedbyFDA_suf',  

					'FDAPharmapreassesedby.pre as preassesedbyFDAPharma_pre',  
					'FDAPharmapreassesedby.fname as preassesedbyFDAPharma_fname', 
					'FDAPharmapreassesedby.mname as preassesedbyFDAPharma_mname', 
					'FDAPharmapreassesedby.lname as preassesedbyFDAPharma_lname',  
					'FDAPharmapreassesedby.suf as preassesedbyFDAPharma_suf',  

					'recfdaval.fname as recfdaval_fname',  
					'recfdaval.pre as recfdaval_pre',  
					'recfdaval.suf as recfdaval_suf',  
					'recfdaval.mname as recfdaval_mname', 
					'recfdaval.lname as recfdaval_lname',   
						
					'evalby.fname as evalby_fname',  
					'evalby.pre as evalby_pre',  
					'evalby.suf as evalby_suf',  
					'evalby.mname as evalby_mname', 
					'evalby.lname as evalby_lname', 

					'recbyfda.fname as recbyfda_fname',  
					'recbyfda.pre as recbyfdal_pre',  
					'recbyfda.suf as recbyfda_suf',  
					'recbyfda.mname as recbyfda_mname', 
					'recbyfda.lname as recbyfda_lname',  

					'recbyfdaphar.fname as recbyfdaphar_fname',  
					'recbyfdaphar.pre as recbyfdalphar_pre',  
					'recbyfdaphar.suf as recbyfdaphar_suf',  
					'recbyfdaphar.mname as recbyfdaphar_mname', 
					'recbyfdaphar.lname as recbyfdaphar_lname',  

					'recbyfdaph.fname as recbyfdaph_fname',  
					'recbyfdaph.pre as recbyfdaph_pre',  
					'recbyfdaph.suf as recbyfdaph_suf',  
					'recbyfdaph.mname as recbyfdaph_mname', 
					'recbyfdaph.lname as recbyfdaph_lname',  
						
					'x07.grp_desc', 
					'barangay.brgyname', 
					'city_muni.cmname',
					'province.provname',
					'trans_status.trns_desc') //, 'type_facility.*'
					->where('appform.appid', '=', $appid)
					// , 'type_facility.*', 'orderofpayment.*'
					// ->where('type_facility.facid', '=', 'appform.facid')
					->first();
					
					if($data0 != null)
					{							
						/////  Evaluation
						if ($data0->isrecommended != null) {
							$time1 = $data0->recommendedtime;
							$newT1 = Carbon::parse($time1);
							$data0->formmatedEvalTime = $newT1->format('g:i A');
							$date1 = $data0->recommendeddate;
							$newD1 = Carbon::parse($date1);
							$data0->formmatedEvalDate = $newD1->toFormattedDateString();
							$getEval = DB::table('x08')->where('uid', '=', $data0->recommendedby)->first();
							if ($getEval) {
								if ($getEval->grpid == 'NA') {
									$data0->Evaluator = 'System Administrator';
								} else {
										if ($getEval->mname != "") {
										$mid = strtoupper($getEval->mname);
										$mid = $mid.'. ';
									} else {
										$mid = ' ';
										}
									$data0->Evaluator = $getEval->pre . ' ' .$getEval->fname.' '.$mid.''.$getEval->lname . ' ' . $getEval->suf;
								}
							} else {
								$data0->Evaluator = 'Not Available';
							}
						}
						/////  Evaluation	/////  Assessment
						if ($data0->isInspected != null) {
							$time1 = $data0->inspectedtime;
							$newT1 = Carbon::parse($time1);
							$data0->formmatedAssessTime = $newT1->format('g:i A');
							$date1 = $data0->inspecteddate;
							$newD1 = Carbon::parse($date1);
							$data0->formmatedAssessDate = $newD1->toFormattedDateString();
							$getAssessor = DB::table('x08')->where('uid', '=', $data0->inspectedby)->first();
							if ($getAssessor) {
								if ($getAssessor->grpid == 'NA') {
									$data0->Assessor = 'System Administrator';
								} else {
										if ($getAssessor->mname != "") {
										$mid = strtoupper($getAssessor->mname);
										$mid = $mid.'. ';
									} else {
										$mid = ' ';
										}
									$data0->Assessor = $getAssessor->pre . ' ' .$getAssessor->fname.' '.$mid.''.$getAssessor->lname . ' ' .$getAssessor->suf;
								}
							} else {
								$data0->Assessor = 'Not Available';
							}
						}
						/////  Assessment /////  Payment Evaluation
						if ($data0->isPayEval != null) {
							$time1 = $data0->payEvaltime;
							$newT1 = Carbon::parse($time1);
							$data0->formmatedPayEvalTime = $newT1->format('g:i A');
							$date1 = $data0->payEvaldate;
							$newD1 = Carbon::parse($date1);
							$data0->formmatedPayEvalDate = $newD1->toFormattedDateString();
							$getPayEvaluator = DB::table('x08')->where('uid', '=', $data0->payEvalby)->first();
							if ($getPayEvaluator) {
								if ($getPayEvaluator->grpid == 'NA') {
									$data0->PayEvaluator = 'System Administrator';
								} else {
										if ($getPayEvaluator->mname != "") {
										$mid = strtoupper($getPayEvaluator->mname);
										$mid = $mid.'. ';
									} else {
										$mid = ' ';
										}
									$data0->PayEvaluator = $getPayEvaluator->pre . ' ' .$getPayEvaluator->fname.' '.$mid.''.$getPayEvaluator->lname . ' ' .$getPayEvaluator->suf;
								}
							} else {
								$data0->PayEvaluator = 'Not Available';
							}
						}
						/////  Payment Evaluation /////  Cashier Evaluation
						if ($data0->isCashierApprove != null) {
							$time1 = $data0->CashierApproveTime;
							$newT1 = Carbon::parse($time1);
							$data0->FCashierApproveTime = $newT1->format('g:i A');
							$date1 = $data0->CashierApproveDate;
							$newD1 = Carbon::parse($date1);
							$data0->FCashierApproveDate = $newD1->toFormattedDateString();
							$getCashierEvaluator = DB::table('x08')->where('uid', '=', $data0->CashierApproveBy)->first();
							if ($getCashierEvaluator) {
								if ($getCashierEvaluator->grpid == 'NA') {
									$data0->CashierEvaluator = 'System Administrator';
								} else {
									if (!empty($getCashierEvaluator->mname)) {
										$mid = strtoupper($getCashierEvaluator->mname);
										$mid = $mid.'. ';
									} else {
										$mid = ' ';
										}
									$data0->CashierEvaluator = $getCashierEvaluator->pre . ' ' .$getCashierEvaluator->fname.' '.$mid.''.$getCashierEvaluator->lname .  ' ' .$getCashierEvaluator->suf;
									
								}
							} else {
								$data0->CashierEvaluator = 'Not Available';
							}
						}
						/////  Cashier Evaluation	///// 	RECOMMENDATION
						if ($data0->isRecoForApproval !== null) {
							$time1 = $data0->RecoForApprovalTime;
							$newT1 = Carbon::parse($time1);
							$data0->fRecoForApprovalTime = $newT1->format('g:i A');
							$date1 = $data0->RecoForApprovalDate;
							$newD1 = Carbon::parse($date1);
							$data0->fRecoForApprovalDate = $newD1->toFormattedDateString();
							$getRecommender = DB::table('x08')->where('uid', '=', $data0->RecoForApprovalby)->first();
							
							if ($getRecommender) {
								if ($getRecommender->grpid == 'NA') {
									$data0->RecommedationEvaluator = 'System Administrator';
								} else {
									if ($getRecommender->mname != "") {
										$mid = strtoupper($getRecommender->mname);
										$mid = $mid.'. ';
									} else {
										$mid = ' ';
										}
									$data0->RecommedationEvaluator = $getRecommender->pre . ' ' .$getRecommender->fname.' '.$mid.''.$getRecommender->lname. ' ' . $getRecommender->suf;
								}
							} else {
								$data0->RecommedationEvaluator = 'Not Available' ;
							}
						}
						/////   RECOMMENDATION	/////   APPROVAL
						if (isset($data0->isApprove)) {
							$time1 = $data0->approvedTime;
							$newT1 = Carbon::parse($time1);
							$data0->FapprovedTime = $newT1->format('g:i A');
							$date1 = $data0->approvedDate;
							$newD1 = Carbon::parse($date1);
							$data0->FapprovedDate = $newD1->toFormattedDateString();
							$getApprover = DB::table('x08')->where('uid', '=', $data0->approvedBy)->first();

							if ($getApprover) {
								if ($getApprover->grpid == 'NA') {
									$data0->AprovalApprover = 'System Administrator';
								} else {
									if ($getApprover->mname != "") {
										$mid = strtoupper($getApprover->mname);
										$mid = $mid.'. ';
									} else {
										$mid = ' ';
										}
									$data0->AprovalApprover = $getApprover->fname.' '.$mid.''.$getApprover->lname;
								}
							} else {
								$data0->AprovalApprover = 'Not Available' ;
							}
						}
						/////   FDA
						if (isset($data0->isApproveFDA)) {
							$time1 = $data0->approvedTimeFDA;
							$newT1 = Carbon::parse($time1);
							$data0->FDAapprovedTime = $newT1->format('g:i A');
							$date1 = $data0->approvedDateFDA;
							$newD1 = Carbon::parse($date1);
							$data0->FDAapprovedDate = $newD1->toFormattedDateString();
							$getApprover = DB::table('x08')->where('uid', '=', $data0->approvedByFDA)->first();

							if ($getApprover) {
								if ($getApprover->grpid == 'NA') {
									$data0->FDAAprovalApprover = 'System Administrator';
								} else {
									if ($getApprover->mname != "") {
										$mid = strtoupper($getApprover->mname);
										$mid = $mid.'. ';
									} else {
										$mid = ' ';
										}
									$data0->FDAAprovalApprover = $getApprover->fname.' '.$mid.''.$getApprover->lname;
								}
							} else {
								$data0->FDAAprovalApprover = 'Not Available' ;
							}
						}

						if (isset($data0->isApproveFDAPharma)) {
							$time1 = $data0->approvedTimeFDAPharma;
							$newT1 = Carbon::parse($time1);
							$data0->FDAapprovedTimePharma = $newT1->format('g:i A');
							$date1 = $data0->approvedDateFDAPharma;
							$newD1 = Carbon::parse($date1);
							$data0->FDAapprovedDatePharma = $newD1->toFormattedDateString();
							$getApprover = DB::table('x08')->where('uid', '=', $data0->approvedByFDAPharma)->first();

							if ($getApprover) {
								if ($getApprover->grpid == 'NA') {
									$data0->FDAAprovalApproverPharma = 'System Administrator';
								} else {
									if ($getApprover->mname != "") {
										$mid = strtoupper($getApprover->mname);
										$mid = $mid.'. ';
									} else {
										$mid = ' ';
									}
									$data0->FDAAprovalApproverPharma = $getApprover->fname.' '.$mid.''.$getApprover->lname;
								}
							} else {
								$data0->FDAAprovalApproverPharma = 'Not Available' ;
							}
						}						
					}

				return $data0;
			/*} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}*/

		public static function getRecommendationData($appid)
		{
			try 
			{
				return DB::table('viewAppStaffRecommender')->where('appid', '=', $appid)->first();	
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getPreAssessment($uid)
		{
			try 
			{
				/////  Pre Assessment
						$data1 = DB::table('app_assessment') // Pre-Assessmment
							->join('assessment', 'app_assessment.asmt_id', '=', 'assessment.asmt_id')
							->where([['app_assessment.draft', '=', '0'], ['app_assessment.uid', '=', $uid]])
							/// ['app_assessment.t_date', '=', null], ['app_assessment.t_time', '=', null]
							->first();
							// if ($data1->sa_ttime != null) 
							// {
							// 	$time = $data1->sa_ttime;
							// 	$newT = Carbon::parse($time);
							// 	$data1->formattedTime = $newT->format('g:i A');
							// }
							// if ($data1->sa_tdate!= null) {
							// 	$date = $data1->sa_tdate;
							// 	$newD = Carbon::parse($date);
							// 	$data1->formattedDate = $newD->toFormattedDateString();
							// }
					return $data1;	
				/////  Pre Assessment
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}
		public static function getAssignedMembersInTeam4Recommendation($appid)
		{
			try 
			{
				$data = DB::table('app_team')
							->join('x08', 'app_team.uid', '=' , 'x08.uid' )
							->select('app_team.*', 'x08.fname', 'x08.mname', 'x08.lname')
							->where('app_team.appid', '=', $appid)->get();
					if (count($data) != 0) {
						for ($i=0; $i < count($data) ; $i++) { 
							$x = $data[$i]->mname;
						      	if ($x != "") {
							    	$mid = strtoupper($x[0]);
							    	$mid = $mid.'. ';
					       		 } else {
							    	$mid = ' ';
							 		}
							$data[$i]->fullname = $data[$i]->fname.' '.$mid.''.$data[$i]->lname;
						}
						return $data;
					} else {
						return null;
					}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		/////// Recommendation One
		/////// Failed Applications
		public static function getFailedApplications()
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
							if ($Cur_useData['grpid'] == 'NA') 
							{
								$anotherData = DB::table('appform')
										->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
										->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
										->leftJoin('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->leftJoin('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->leftJoin('province', 'x08.province', '=', 'province.provid')
										->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->leftJoin('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->leftJoin('class', 'appform.classid', '=', 'class.classid')
										->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc')
										->where('appform.draft', '=', null)
										->where('appform.isrecommended', 0)
										->orWhere('appform.isInspected', 0)
										->orWhere('isPayEval', 0)
										->orWhere('isCashierApprove', 0)
										->orWhere('isRecoForApproval', 0)
										->orWhere('isApprove', 0)
										->get();
							} else if ($Cur_useData['grpid'] == 'FDA' || $Cur_useData['grpid'] == 'LO') 
							{
								$anotherData = DB::table('appform')
										->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
										->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
										->leftJoin('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->leftJoin('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->leftJoin('province', 'x08.province', '=', 'province.provid')
										->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->leftJoin('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->leftJoin('class', 'appform.classid', '=', 'class.classid')
										->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc')
										->where('appform.assignedLO', '=', $Cur_useData['cur_user'])
										->where('appform.draft', '=', null)
										// ->where([['status', '=', 'RA'], ['status', '=', 'RI'], ['status', '=', 'RE']])
										->where('appform.isrecommended', 0)
										->orWhere('appform.isInspected', 0)
										->orWhere('isPayEval', 0)
										->orWhere('isCashierApprove', 0)
										->orWhere('isRecoForApproval', 0)
										->orWhere('isApprove', 0)
										->get();
							} 
							else
							{
								$anotherData = DB::table('appform')
										->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
										->leftJoin('hfaci_grp', 'appform.facid', '=', 'hfaci_grp.hgpid')
										->leftJoin('x08', 'appform.uid', '=', 'x08.uid')
										->leftJoin('region', 'appform.assignedRgn', '=', 'region.rgnid')
										->leftJoin('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
										->leftJoin('province', 'x08.province', '=', 'province.provid')
										->leftJoin('apptype', 'appform.aptid', '=', 'apptype.aptid')
										->leftJoin('barangay', 'x08.barangay', '=' , 'barangay.brgyid')
										->leftJoin('ownership', 'appform.ocid', '=', 'ownership.ocid')
										->leftJoin('class', 'appform.classid', '=', 'class.classid')
										->leftJoin('trans_status', 'appform.status', '=', 'trans_status.trns_id')
										->select('appform.*', 'hfaci_serv_type.*','region.rgn_desc', 'x08.facilityname', 'x08.authorizedsignature', 'x08.email', 'x08.streetname', 'x08.barangay', 'x08.city_muni', 'x08.province', 'x08.zipcode', 'x08.rgnid', 'hfaci_grp.hgpdesc', 'city_muni.cmname', 'apptype.aptdesc', 'province.provname', 'barangay.brgyname', 'ownership.ocdesc', 'class.classname', 'trans_status.trns_desc')
										->where('appform.assignedLO', '=', $Cur_useData['cur_user'])
										->where('appform.draft', '=', null)
										// ->where([['status', '=', 'RA'], ['status', '=', 'RI'], ['status', '=', 'RE']])
										->where('appform.isrecommended', 0)
										->orWhere('appform.isInspected', 0)
										->orWhere('isPayEval', 0)
										->orWhere('isCashierApprove', 0)
										->orWhere('isRecoForApproval', 0)
										->orWhere('isApprove', 0)
										->get();
							}
								for ($i=0; $i < count($anotherData); $i++) {
									$time = $anotherData[$i]->t_time;
									$newT = Carbon::parse($time);
									$anotherData[$i]->formattedTime = $newT->format('g:i A');
									$date = $anotherData[$i]->t_date;
									$newD = Carbon::parse($date);
									$anotherData[$i]->formattedDate = $newD->toFormattedDateString();
									// ->diffForHumans()
								}
					return $anotherData;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}
		/////// Failed Applications
		/////// Group Rights
		public static function getAllGroupRights() // Get All Group Rights
		{
			try 
			{
				$data = DB::table('x06')
					// ->join('orders', 'users.id', '=', 'orders.user_id')
									->join('x05', 'x06.mod_id','=','x05.mod_id')
									->join('x07', 'x06.grp_id', '=', 'x07.grp_id')
									->select('x06.*', 'x05.*', 'x07.*')
									->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}
		public static function getRightsOnSingleGroup(Request $request) // Get Rights on Single Group
		{
			try 
			{
				$data = DB::table('x06')
								->join('x05', 'x06.mod_id','=','x05.mod_id')
								->join('x07', 'x06.grp_id', '=', 'x07.grp_id')
								->select('x06.*', 'x05.*', 'x07.*')
								->distinct('mod_id')
								->where('x06.grp_id', '=', $request->grp_id)
								->get();
				if ($data) {
					for ($i=0; $i < count($data); $i++) 
					{ 
						$temp = DB::table('x05')->where([['mod_lvl', '=', '2'], ['mod_l1', '=', $data[$i]->mod_id]])->get();
						$data[$i]->hasLevel2 = (count($temp) != 0 ? 1 : null);

						$temp = DB::table('x05')->where([['mod_lvl', '=', '3'], ['mod_l2', '=', $data[$i]->mod_id]])->get();
						$data[$i]->hasLevel3 = (count($temp) != 0 ? 1 : null);
					}
					return $data;
				} else {
					return "NONE";
				}
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function saveRightsOnSingleGroup(Request $request)
		{
			try 
			{

				if($request->laType == 'allow')
				{
					$updateData = array('allow' =>$request->stat, 'ad_d'=> intval($request->stat), 'upd'=>intval($request->stat), 'cancel'=>intval($request->stat), 'print'=>intval($request->stat), 'view'=>intval($request->stat)); 
				}
				else {
					$updateData = array($request->laType => intval($request->stat));
				}
				
				if(isset($request->mod_lvl)) // Check Module
				{
					//Check Module Level
					if ($request->mod_lvl == 1)  // Level 1
					{  
						$test = DB::table('x06')->where('x06_id', '=',intval($request->x06_id))->update($updateData);
						$lvl2 = DB::table('x05')->where('mod_l1', '=', $request->id)->get();
						if (count($lvl2) != 0) {
							for ($i=0; $i < count($lvl2) ; $i++) { 
								DB::table('x06')->where('mod_id', '=',$lvl2[$i]->mod_id)->where('grp_id', '=', $request->grp_id)->update($updateData);
								$lvl3 = DB::table('x05')->where('mod_l2', '=',$lvl2[$i]->mod_id)->get();
								if (count($lvl3) != 0) {
									for ($i=0; $i < count($lvl3) ; $i++) { 
										DB::table('x06')->where('mod_id', '=',$lvl3[$i]->mod_id)->where('grp_id', '=', $request->grp_id)->update($updateData);
									}
								}

							}
						}
						return 'DONE';
					} 
					else if ($request->mod_lvl == 2) // Level 2
					{ 
						$test = DB::table('x06')->where('x06_id', '=',intval($request->x06_id))->update($updateData);
						$lvl3 = DB::table('x05')->where('mod_l2', '=', $request->id)->get();
						if (count($lvl3) != 0) {
							for ($i=0; $i < count($lvl3) ; $i++) { 
								DB::table('x06')->where('mod_id', '=',$lvl3[$i]->mod_id)->where('grp_id', '=', $request->grp_id)->update($updateData);
							}
						}
						return 'DONE';
					}
					 else if ($request->mod_lvl == 3) // Level 3
					{ 
						$test = DB::table('x06')->where('x06_id', '=',intval($request->x06_id))->update($updateData);
						if ($test) {
							return 'DONE';
						} else {return 'ERROR';}
					}

				} else {
					return 'ERROR';
				}




				// if (isset($request->laType)) {
				// 	if ($request->laType == 'allow') {
				// 		$updateData = array(
				// 				'allow' 	=> 	$request->stat,
				// 				'ad_d'		=>	$request->stat,
				// 				'upd'		=>	$request->stat,
				// 				'cancel'	=>	$request->stat,
				// 				'print' 	=>	$request->stat,
				// 				'view' 		=>	$request->stat
				// 			);
				// 		$test = DB::table('x06')->where('x06_id', $request->id)->update($updateData);
				// 		if ($test) {return 'DONE';} 
				// 		else {
				// 			AjaxController::SystemLogs('No data has been updated in x06 table. (saveRightsOnSingleGroup)');
				// 			return 'ERROR';
				// 		}
				// 	} else {
				// 		$nameArray = '';
				// 	}
				// }

				// OLD
				// $updateData = array(
				// 		'allow' 	=> 	$request->alwChk,
				// 		'ad_d'		=>	$request->addChk,
				// 		'upd'		=>	$request->updChk,
				// 		'cancel'	=>	$request->cnlChk,
				// 		'print' 	=>	$request->prtChk,
				// 		'view' 		=>	$request->vwChk
				// 	);
				// $test = DB::table('x06')->where('x06_id', $request->id)->update($updateData);
				// if ($test) {return 'DONE';} 
				// else {
				// 	AjaxController::SystemLogs('No data has been updated in x06 table. (saveRightsOnSingleGroup)');
				// 	return 'ERROR';
				// }
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		/////// Group Rights
		/////// Groups
		public static function getAllGroups()
		{
			try 
			{
				$data = DB::table('x07')->select('*')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}
		public static function saveGroupMange(Request $request) // Update
		{
			try 
			{
				$update = array('grp_desc'=>$request->name,'type'=>$request->type);
				$test = DB::table('x07')->where('grp_id', $request->id)->update($update);
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in x07 table. (saveGroupMange)');
					return 'ERROR';
				}
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function delGroupMange(Request $request)
		{
			try 
			{
				$test = DB::table('x07')->where('grp_id', '=', $request->id)->delete();
				$test1 = DB::table('x06')->where('grp_id', '=', $request->id)->delete();
				if ($test && $test1) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in x07 and x06 tables. (delGroupMange)');
					return 'ERROR';	
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		/////// Groups
		/////// Module
		public static function getAllModules()
		{
			try 
			{
				$data = DB::table('x05')->select('*')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}
		public static function saveModuleMange(Request $request)
		{
			try 
			{
				$update = array('mod_desc'=>$request->name);
				$test = DB::table('x05')->where('mod_id', $request->id)->update($update);
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been updated in x05 table. (saveModuleMange)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function delModuleMange(Request $request)
		{
			try 
			{
				$test = DB::table('x05')->where('mod_id', '=', $request->id)->delete();
				$test1 = DB::table('x06')->where('mod_id', '=', $request->id)->delete();
				if ($test && $test1) { return 'DONE';} 
				else {
					AjaxController::SystemLogs('No data has been deleted in x05 and x06 tables. (delModuleMange)');
					return [$test,$test1];	
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function getModuleLevel1(Request $request)
		{
			try 
			{
				$data = DB::table('x05')->where('mod_lvl', '=', "1")->get();
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function getModuleLevel2(Request $request)
		{
			try 
			{
				$data = DB::table('x05')->where([['mod_lvl', '=', "2"], ['mod_l1', '=', $request->mod_l1]])->get();
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		public static function getModuleLevel3(Request $request)
		{
			try 
			{
				$data = DB::table('x05')->where([['mod_lvl', '=', "3"], ['mod_l2', '=', $request->mod_l2]])->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}
		/////// Modules
		/////// System Users
		public static function getFilteredUsers()
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				if ($Cur_useData['grpid'] == 'NA'  || $Cur_useData['rgnid'] == 'HFSRB') 
				{
					$data1 = DB::table('x08')
						->join('region', 'x08.rgnid', '=', 'region.rgnid')
						->join('x07', 'x08.grpid', '=', 'x07.grp_id')
						->where([['x08.grpid', '<>', 'NA'], ['x08.grpid', '<>', 'C'], ['x08.is_fda', '=', '0']])
						->get();
				}
				else
				{
					$data1 = DB::table('x08')
						->join('region', 'x08.rgnid', '=', 'region.rgnid')
						->join('x07', 'x08.grpid', '=', 'x07.grp_id')
						->where([['x08.grpid', '<>', 'NA'], ['x08.grpid', '<>', 'C'], ['region.rgnid', '=', $Cur_useData['rgnid']], ['x08.is_fda', '=', '0']])
						->get();
				}
				if (isset($data1)) {
						for ($i=0; $i < count($data1); $i++) { 
							if (isset($data1[$i]->team)) {
									$test = DB::table('team')->where('teamid', '=', $data1[$i]->team)->first();
									if (isset($test)) {
										$data1[$i]->teamid = $test->teamid;
										$data1[$i]->teamdesc = $test->teamdesc;
									}else {
										$data1[$i]->teamdesc = 'NONE';
										$data1[$i]->teamid = null;
									}
							} else {
									$data1[$i]->teamdesc = 'NONE';
							}
							if (isset($data1[$i]->def_faci)) {
									$test2 = DB::table('facilitytyp')->where('facid', '=', $data1[$i]->def_faci)->first();
									if (isset($test2)) {
										$data1[$i]->facid = $test2->facid;
										$data1[$i]->facidesc = $test2->facname;
									} else {
										$data1[$i]->facidesc = 'NONE';
										$data1[$i]->facid = null;
									}
							} else {
								$data1[$i]->facidesc = 'NONE';
							}
						}
					}
				return $data1;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}

		public static function getFilteredUsersFDA()
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				if ($Cur_useData['grpid'] == 'NA'  || $Cur_useData['rgnid'] == 'HFSRB') 
				{
					$data1 = DB::table('x08')
						->join('region', 'x08.rgnid', '=', 'region.rgnid')
						->join('x07', 'x08.grpid', '=', 'x07.grp_id')
						->where([['x08.grpid', '<>', 'NA'], ['x08.grpid', '<>', 'C'], ['x08.is_fda', '=', '1']])
						->get();
				}
				else
				{
					$data1 = DB::table('x08')
						->join('region', 'x08.rgnid', '=', 'region.rgnid')
						->join('x07', 'x08.grpid', '=', 'x07.grp_id')
						->where([['x08.grpid', '<>', 'NA'], ['x08.grpid', '<>', 'C'], ['region.rgnid', '=', $Cur_useData['rgnid']], ['x08.is_fda', '=', '1']])
						->get();
				}
				if (isset($data1)) {
						for ($i=0; $i < count($data1); $i++) { 
							if (isset($data1[$i]->team)) {
									$test = DB::table('team')->where('teamid', '=', $data1[$i]->team)->first();
									if (isset($test)) {
										$data1[$i]->teamid = $test->teamid;
										$data1[$i]->teamdesc = $test->teamdesc;
									}else {
										$data1[$i]->teamdesc = 'NONE';
										$data1[$i]->teamid = null;
									}
							} else {
									$data1[$i]->teamdesc = 'NONE';
							}
							if (isset($data1[$i]->def_faci)) {
									$test2 = DB::table('facilitytyp')->where('facid', '=', $data1[$i]->def_faci)->first();
									if (isset($test2)) {
										$data1[$i]->facid = $test2->facid;
										$data1[$i]->facidesc = $test2->facname;
									} else {
										$data1[$i]->facidesc = 'NONE';
										$data1[$i]->facid = null;
									}
							} else {
								$data1[$i]->facidesc = 'NONE';
							}
						}
					}
				return $data1;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}

		public static function getFilteredUsersClient()
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				// if ($Cur_useData['grpid'] == 'NA') 
				// {
					$data1 = DB::table('x08')
						// ->join('region', 'x08.rgnid', '=', 'region.rgnid')
						->join('x07', 'x08.grpid', '=', 'x07.grp_id')
						->where([ ['x08.grpid', '=', 'C']])
						->get();
				// }
				// else
				// {
				// 	$data1 = DB::table('x08')
				// 		->join('region', 'x08.rgnid', '=', 'region.rgnid')
				// 		->join('x07', 'x08.grpid', '=', 'x07.grp_id')
				// 		->where([['x08.grpid', '<>', 'NA'], ['x08.grpid', '<>', 'C'], ['region.rgnid', '=', $Cur_useData['rgnid']]])
				// 		->get();
				// }
				if (isset($data1)) {
						for ($i=0; $i < count($data1); $i++) { 
							if (isset($data1[$i]->team)) {
									$test = DB::table('team')->where('teamid', '=', $data1[$i]->team)->first();
									if (isset($test)) {
										$data1[$i]->teamid = $test->teamid;
										$data1[$i]->teamdesc = $test->teamdesc;
									}else {
										$data1[$i]->teamdesc = 'NONE';
										$data1[$i]->teamid = null;
									}
							} else {
									$data1[$i]->teamdesc = 'NONE';
							}
							if (isset($data1[$i]->def_faci)) {
									$test2 = DB::table('facilitytyp')->where('facid', '=', $data1[$i]->def_faci)->first();
									if (isset($test2)) {
										$data1[$i]->facid = $test2->facid;
										$data1[$i]->facidesc = $test2->facname;
									} else {
										$data1[$i]->facidesc = 'NONE';
										$data1[$i]->facid = null;
									}
							} else {
								$data1[$i]->facidesc = 'NONE';
							}
						}
					}
				return $data1;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}


		public static function getFilteredTypes()
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				if ($Cur_useData['grpid'] == 'NA' || $Cur_useData['rgnid'] == 'HFSRB') 
				{
					$data3 = DB::table('x07')	
									->where([['grp_id', '<>', 'C'],['grp_id', '<>', 'NA'], ['type', '=', 'DOH']])
									->orderBy('grp_id','desc')
									->get();
				}
				else
				{
					$data3 = DB::table('x07')	
									->where([['grp_id', '<>', 'C'],['grp_id', '<>', 'NA'], ['grp_id', '<>', 'RA'], ['type', '=', 'DOH']])
									->orderBy('grp_id','desc')
									->get();
				}
				return $data3;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}

		public static function getFilteredTypesFDA()
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				if ($Cur_useData['grpid'] == 'NA' || $Cur_useData['rgnid'] == 'HFSRB') 
				{
					$data3 = DB::table('x07')	
									->where([['grp_id', '<>', 'C'],['grp_id', '<>', 'NA'], ['type', '=', 'FDA']])
									->orderBy('grp_id','desc')
									->get();
				}
				else
				{
					$data3 = DB::table('x07')	
									->where([['grp_id', '<>', 'C'],['grp_id', '<>', 'NA'], ['grp_id', '<>', 'RA'], ['type', '=', 'FDA']])
									->orderBy('grp_id','desc')
									->get();
				}
				return $data3;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}
		public static function SaveIFActive(Request $request)
		{
			try {
				$currentState = ($request->isActive == 1 ? 0 : 1);
				$updateData = array('isActive'=> $currentState);
				$test = DB::table('x08')
					->where('uid', $request->id)
					->update($updateData);
				if ($test) {
					return 'DONE';
				} else {
					AjaxController::SystemLogs('No data has been updated in x08 table. (SaveIFActive)');
					return 'ERROR';
				}
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		public static function SaveUserManage(Request $request)
		{
			try 
			{
				$data = array (
								'pre' => $request->pre,
								'fname' => $request->fname,
								'mname' => $request->mname,
								'lname' => $request->lname,
								'suf' => $request->suf,
								'position' => $request->posi,
								'email' => $request->email,
								'contact' => $request->contno,
							);
					if (isset($request->rgn)) {
						$data['rgnid'] = $request->rgn;
					}
					if (isset($request->typ)) {
						$data['grpid'] = $request->typ;
					}
					if (isset($request->team)) {
						$data['team'] = $request->team;
					}
					if (isset($request->editpass)) {
						$data['pwd'] = Hash::make(($request->editpass));
					}
					// return $data['rgnid'];
					$test = DB::table('x08')->where('uid', '=', $request->id)->update($data);
					// email, rgnid, grpid, fname, mname, lname,contact, position 
					if ($test) {
						return 'DONE';
					} else {
						AjaxController::SystemLogs('No data has been updated in x08 table. (SaveUserManage)');
						return 'ERROR';
					}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		
		public static function SaveUserManageFDA(Request $request)
		{
			try 
			{
				$data = array (
								'pre' => $request->pre,
								'fname' => $request->fname,
								'mname' => $request->mname,
								'lname' => $request->lname,
								'suf' => $request->suf,
								'position' => $request->posi,
								'email' => $request->email,
								'contact' => $request->contno,
								'is_fda' => '1',
							);
					if (isset($request->rgn)) {
						$data['rgnid'] = $request->rgn;
					}
					if (isset($request->typ)) {
						$data['grpid'] = $request->typ;
					}
					if (isset($request->team)) {
						$data['team'] = $request->team;
					}
					if (isset($request->editpass)) {
						$data['pwd'] = Hash::make(($request->editpass));
					}
					// return $data['rgnid'];
					$test = DB::table('x08')->where('uid', '=', $request->id)->update($data);
					// email, rgnid, grpid, fname, mname, lname,contact, position 
					if ($test) {
						return 'DONE';
					} else {
						AjaxController::SystemLogs('No data has been updated in x08 table. (SaveUserManage)');
						return 'ERROR';
					}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function SaveUserManagePass(Request $request)
		{
			try 
			{
				// $data = array ();
				
				// 	if (isset($request->editpass)) {
				// 		$data['pwd'] = Hash::make(($request->editpass));
				// 	}
					$update = array('pwd'=>Hash::make(($request->editpass)));
					// return $data['rgnid'];
					$test = DB::table('x08')->where('uid', '=', $request->id)->update($update);
					// email, rgnid, grpid, fname, mname, lname,contact, position 
					if ($test) {
						return 'DONE';
					} else {
						AjaxController::SystemLogs('No data has been updated in x08 table. (SaveUserManage)');
						return 'ERROR';
					}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}
		/////// System Users
		/////// Applicant Accounts
		public static function getAllApplicantAccounts()
		{
			try 
			{
				$Cur_useData = AjaxController::getCurrentUserAllData();
				if ($Cur_useData['grpid'] == 'NA' || $Cur_useData['rgnid'] == 'HFSRB') {
						$data1 = DB::table('x08')->join('region', 'x08.rgnid', '=', 'region.rgnid')
									->join('x07', 'x08.grpid', '=', 'x07.grp_id')
									->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
									->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->join('province', 'x08.province', '=', 'province.provid')
									->where('x08.grpid', '=', 'C')
									->get();					
								}
					else if($Cur_useData['grpid'] == 'FDA' || $Cur_useData['grpid'] == 'LO') {
						$data1 = DB::table('x08')->join('region', 'x08.rgnid', '=', 'region.rgnid')
									->join('x07', 'x08.grpid', '=', 'x07.grp_id')
									->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
									->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->join('province', 'x08.province', '=', 'province.provid')
									->join('appform', 'x08.uid', '=', 'appform.uid')
									->where('x08.grpid', '=', 'C')
									->where('appform.assignedLO', '=', $Cur_useData['cur_user'])
									->get();	
					}
					else {
						$data1 = DB::table('x08')->join('region', 'x08.rgnid', '=', 'region.rgnid')
									->join('x07', 'x08.grpid', '=', 'x07.grp_id')
									->join('barangay', 'x08.barangay', '=', 'barangay.brgyid')
									->join('city_muni', 'x08.city_muni', '=', 'city_muni.cmid')
									->join('province', 'x08.province', '=', 'province.provid')
									->where('x08.grpid', '=', 'C')
									->where('x08.rgnid', '=', $Cur_useData['rgnid'])
									->get();
					}
					return $data1;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		/////// Applicant Accounts
		/////// System Logs
		public static function getAllSystemLogs()
		{
			try 
			{
				$data = Storage::allFiles('/system/logs');
					$result = array();
					for ($i=0; $i < count($data) ; $i++) { 
						// $data[$i];
						$lastmodified = Storage::lastModified($data[$i]);
						$lastmodified = DateTime::createFromFormat("U", $lastmodified);
						$lastmodified->setTimezone(new DateTimeZone('Asia/Manila'));
						$lastmodifiedString = $lastmodified->format('Y-m-d H:i:s');
						$lastmodifiedDate = $lastmodified->format('Y-m-d');
						$lastmodifiedTime = $lastmodified->format('H:i:s'); 
						$newT = Carbon::parse($lastmodifiedTime);
					 	$formattedTime = $newT->format('g:i A');
						$newD = Carbon::parse($lastmodifiedDate);
						$formattedDate = $newD->toFormattedDateString();
						$count = strlen($data[$i]);
						$filename = substr($data[$i],12, $count);
						$count2 = strlen($filename);
						$uid = substr($filename,12, -9);
						$code = substr($filename,0, 12);
						$UserFile = DB::table('x08')
										->join('region', 'x08.rgnid', '=', 'region.rgnid')
										->where('uid', '=', $uid)
										->first();
						if ($UserFile) {
							if ($UserFile->grpid == 'NA') {
								$name = 'System Administrator';
							} else {
								$x = $UserFile->mname;
						      	if ($x != "") {
							    	$mid = strtoupper($x[0]);
							    	$mid = $mid.'. ';
					       		 } else {
							    	$mid = ' ';
							 		}
								$name = $UserFile->fname.' '.$mid.''.$UserFile->lname;
							}
							$rgn = $UserFile->rgn_desc;
						} else {
							$name = 'Not Available';
							$rgn = 'Not Available';
						}
						/////
						$result[] = array(
								'filepath'=> $data[$i],
								// 'size'=> Storage::size($data[$i]),
								'content' => Storage::get($data[$i]),
								'datetime' => $lastmodifiedString,
								// 'date' =>  $lastmodifiedDate, ///Storage::lastModified($data[$i]),
								// 'time' => $lastmodifiedTime,
								'formmatedDate' =>  $formattedDate,
								'formattedTime' => $formattedTime,
								'filename'=>$filename,
								'uid' => $uid,
								'name'=> $name,
								'region'=> $rgn,
								'code' => $code,
							);
					}
					return $result;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return null;
			}
		}
		/////// System Logs
		/////////////// FUNCTIONS
		
		////////////////////////////////////////////////// Others, Lloyd  //////////////////////////////////////////////////
		// Dec 7, 2018 //
		public static function getAppTeamByAppId(Request $request) // Get AppTeam
		{
			try 
			{
				$sql = "SELECT appform.appid, app_team.teamid, app_team.uid FROM app_team LEFT JOIN appform ON appform.appid = app_team.appid"; // ari naka
				$teamData = DB::select($sql);

				return response()->json($teamData);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		// Dec 10, 2018 //

		public static function getFacNameByFacid(Request $request, $facid,$brgyid = null) // Get Facility Name
		{
			try 
			{
				$toQuery = (isset($brgyid) ? 'AND appform.cmid = '.'\''. $brgyid.'\'' : '');
				$sql = "SELECT DISTINCT appform.appid,facilityname, appform.brgyid from licensed join appform on appform.appid = licensed.appid join x08_ft on x08_ft.appid = appform.appid where (appform.hfser_id in ('LTO','COA') AND x08_ft.facid = '$facid' AND appform.isapprove = 1 $toQuery)";

				// SELECT x08_ft.appid, facilitytyp.facname, x08_ft.facid, x08_ft.uid, appform.facilityname FROM x08_ft LEFT JOIN facilitytyp ON facilitytyp.facid = x08_ft.facid LEFT JOIN appform ON appform.appid = x08_ft.appid WHERE x08_ft.facid = '$facid' AND appform.isApprove AND appform.hfser_id = 'LTO' IS NOT NULL

					
				// $sql = "SELECT x08_ft.appid, facilitytyp.facname, x08_ft.facid, x08_ft.uid, appform.facilityname FROM licensed LEFT JOIN appform ON appform.appid = licensed.appid LEFT JOIN x08_ft ON x08_ft.id = licensed.x08_ftid LEFT JOIN facilitytyp ON x08_ft.facid = facilitytyp.facid WHERE x08_ft.facid = '$facid'";
				 // AND hfser_id = 'LTO'


				// $sql = "SELECT DISTINCT licensed.appid, x08_ft.facid, appform.facilityname FROM `licensed` LEFT JOIN x08_ft ON x08_ft.appid = licensed.appid LEFT JOIN appform ON appform.appid = licensed.appid WHERE x08_ft.facid = '$facid'";

				$facName = DB::select($sql);

				return response()->json($facName);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getFacNameByFacidNew(Request $request) // Get Facility Name
		{
			try 
			{
				$facs = DB::table('registered_facility')
				->where('cmid', $request->cmid)
				->where('facid', $request->facid)
				->get();

			
				

				return response()->json($facs);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getFacNameNotApprovedByFacid(Request $request, $facid) // Get Facility Name
		{
			try 
			{
				$sql = "SELECT x08_ft.appid, facilitytyp.facname, x08_ft.facid, x08_ft.uid, appform.facilityname FROM x08_ft LEFT JOIN facilitytyp ON facilitytyp.facid = x08_ft.facid LEFT JOIN appform ON appform.appid = x08_ft.appid WHERE x08_ft.facid = '$facid' AND appform.isApprove IS NULL";
				$facName = DB::select($sql);

				return response()->json($facName);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getFacNameNotApprovedByFacidRegFac(Request $request, $facid) // Get Facility Name
		{
			try 
			{
				$sql = "SELECT * FROM registered_facility 
				WHERE registered_facility.facid = '$facid'";

				$facName = DB::select($sql);

				return response()->json($facName);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getFacTypeByAppId(Request $request, $appid) // Get Facility Type
		{
			try 
			{
				$sql = "SELECT facilitytyp.facname, x08_ft.facid, x08_ft.uid FROM x08_ft LEFT JOIN facilitytyp ON facilitytyp.facid = x08_ft.facid WHERE x08_ft.appid = $appid";
				$facType = DB::select($sql);

				return response()->json($facType);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getFacTypeByAppIdNotJSON($appid) // Get Facility Type
		{
			try 
			{
				$sql = "SELECT facilitytyp.facname, x08_ft.facid, x08_ft.uid FROM x08_ft LEFT JOIN facilitytyp ON facilitytyp.facid = x08_ft.facid WHERE x08_ft.appid = $appid";
				$facType = DB::select($sql);
				// dd($facType);	
				return $facType;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getFacNameByAppId($appid) {
			try {
			 	$data = DB::table('appform')
			 			->where('appid', '=', $appid)
			 			->select('facilityname')
			 			->first();

			 	return $data;
			 } catch (Exception $e) {
			 	AjaxController::SystemLogs($e->getMessage());
			 } 
				return 'ERROR';
		}

		public static function getFacTypeByFacid($facid) // Get Facility Type
		{
			try 
			{
				$sql = "SELECT * FROM facilitytyp WHERE facid = '$facid'";
				$facType = DB::select($sql);

				return $facType;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		public static function getHgpByFacid($facid) // Get Facility Type
		{
			try 
			{
				$sql = "SELECT * FROM hfaci_grp WHERE hgpid = '$facid'";
				$facType = DB::select($sql);

				return $facType;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getHgpdescByFacid($facid) // Get Facility Type
		{
			$hgpdesc = "";

			try 
			{
				$sql = "SELECT hgpdesc FROM hfaci_grp WHERE hgpid = '$facid'";
				$facType = DB::select($sql);

				foreach($facType as $c){
					
					$hgpdesc = $c->hgpdesc;
	
				}

				return $hgpdesc;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllFacAddr(Request $request) // Get Facility Address
		{
			try 
			{
				$sql = "SELECT appform.appid, barangay.brgyname, city_muni.cmname, province.provname, region.rgn_desc FROM appform LEFT JOIN barangay ON barangay.brgyid = appform.brgyid LEFT JOIN city_muni ON city_muni.cmid = appform.cmid LEFT JOIN province ON province.provid = appform.provid LEFT JOIN region ON region.rgnid = appform.rgnid";
				$facAddr = DB::select($sql);

				return response()->json($facAddr);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
	public static function getAllFacAddrRegFac(Request $request) // Get Facility Address
		{
			try 
			{
				$sql = "SELECT appform.appid, 
				barangay.brgyname, 
				city_muni.cmname, 
				province.provname, 
				region.rgn_desc FROM appform 
				LEFT JOIN barangay ON barangay.brgyid = appform.brgyid 
				LEFT JOIN city_muni ON city_muni.cmid = appform.cmid 
				LEFT JOIN province ON province.provid = appform.provid 
				LEFT JOIN region ON region.rgnid = appform.rgnid";
				
				$facAddr = DB::select($sql);

				return response()->json($facAddr);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		// Dec 12, 2018 //
		public static function getAllSurveillanceRecommendation()
		{
			try 
			{
				$data = DB::table('surv_rec')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getSurveillanceRecommendation($id)
		{
			try 
			{
				$data = DB::table('surv_rec')->where('rec_id', '=', $id)->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllAppTeams()
		{	
			try  
			{
				$data = DB::table('app_team')
						->get();
				return $data;
			} 
			catch (Exception $e) 
			{	
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getAppTeamByApptid($apptid) // Get Facility Type
		{
			try 
			{
				$sql = "SELECT * FROM app_team WHERE apptid = '$apptid'";
				$apptId = DB::select($sql);

				return $apptId;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getTransStatusById($id)
		{
			try 
			{
				$sql = "SELECT * FROM trans_status WHERE trns_id = '$id'";
				$transStatus = DB::select($sql);
				
				return $transStatus;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllViolationByMonId($monid) {
			try {
				$data = DB::table('mon_form')->where('monid', '=', $monid)->first()->DOHMonitoring;
				$data = json_decode($data, true);
				$mergedata = call_user_func_array("array_merge", $data);
				// dd($mergedata);
				$violations = array();
				foreach($mergedata as $key => $value) {
					$start = explode('/', $key)[0];
					$length = strlen('comp');
					if(substr($key, strlen($start)+1, $length) === 'comp') {
						if($value == 'false') {
							$violation = explode('/', $key)[1];
							$violation = substr($violation, $length);
							array_push($violations, $violation);
						}
					}
				}

				$violations = implode(', ', $violations);
				return $violations;
			} catch(Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllViolationBySurvId($survid) {
			try {
				$data = DB::table('surv_form')->where('survid', '=', $survid)->first()->DOHSurveillance;
				$data = json_decode($data, true);
				$mergedata = call_user_func_array("array_merge", $data);
				// dd($mergedata);
				$violations = array();
				foreach($mergedata as $key => $value) {
					$start = explode('/', $key)[0];
					$length = strlen('comp');
					if(substr($key, strlen($start)+1, $length) === 'comp') {
						if($value == 'false') {
							$violation = explode('/', $key)[1];
							$violation = substr($violation, $length);
							array_push($violations, $violation);
						}
					}
				}

				$violations = implode(', ', $violations);
				return $violations;
			} catch(Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getViolationDescById($id) {
			try {
				$arr = explode(', ', $id);
				$finalData = "";

				foreach($arr as $key => $value) {
					$data = DB::table('asmt2')
							->where('asmt2_id', '=', $value)
							->first();
							
					$finalData .= $data->asmt2_desc . '^ ';
				}
				$finalData = substr($finalData, 0, strlen($finalData)-2);
				
				return $finalData;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllServiceType(){
			return DB::table('serv_type')->get();
		}

		public static function getRemarksByAst(/*Request $request, */$ast, $monid) // Get AppTeam
		{
			try 
			{
				$data = DB::table('mon_form')->where('monid', '=', $monid)->first();
				$data = json_decode($data->DOHMonitoring, true);
				$mergedata = call_user_func_array("array_merge", $data);
				$remarks = array();

				foreach($mergedata as $key => $value) {
					$start = explode('/', $key)[0];
					$length = strlen('remarks');
					if(substr($key, strlen($start)+1, $length) === 'remarks') {
						$astcode = explode('/', $key)[1];
						// dd($astcode);
						$astcode = substr($astcode, $length);
						if($ast == $astcode) {
							array_push($remarks, $value);
						}
					}
				}
				// dd($remarks);

				$remarks = implode(', ', $remarks);

				return response()->json($remarks);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getRemarksByAstSurveillance(Request $request, $ast, $survid) // Get AppTeam
		{
			try 
			{
				$data = DB::table('surv_form')->where('survid', '=', $survid)->first();
				$data = json_decode($data->DOHSurveillance, true);
				$mergedata = call_user_func_array("array_merge", $data);
				$remarks = array();

				foreach($mergedata as $key => $value) {
					$start = explode('/', $key)[0];
					$length = strlen('remarks');
					if(substr($key, strlen($start)+1, $length) === 'remarks') {
						$astcode = explode('/', $key)[1];
						// dd($astcode);
						$astcode = substr($astcode, $length);
						if($ast == $astcode) {
							array_push($remarks, $value);
						}
					}
				}
				// dd($remarks);

				$remarks = implode(', ', $remarks);

				return response()->json($remarks);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public function getSurvAct(Request $req){
			if($req->isMethod('post')){
				$db = DB::table('surv_form')->where('survid',$req->survid)->leftJoin('x08','x08.uid','surv_form.issuedBy')->first();
				return json_encode($db);
			}
		}

		public function getMonAct(Request $req){
			if($req->isMethod('post')){
				$db = DB::table('mon_form')->where('monid',$req->survid)->first();
				return json_encode($db);
			}
		}

		public function getComplaint(Request $req){
			if($req->isMethod('post')){
				$ar = array();
				$fac = null;
				$db = DB::table('complaints_form')->where('ref_no',$req->refno)->first();
				$reg1 = null ;
				if(!is_null($db->regfac_id)){
					$reg = DB::table('registered_facility')->where('regfac_id',$db->regfac_id)->first();
					$db->typefacid_id = $reg->facid;
					$reg1 = 1 ;
				}


				$comps = explode(',',$db->comps);
				foreach($comps as $comp){
					array_push($ar,(!empty(DB::table('complaints')->where('cmp_id',$comp)->first()) ? DB::table('complaints')->where('cmp_id',$comp)->first()->cmp_desc : $comp));
				}
				$db->properVio = implode(',', $ar);


			

				if($db->type_of_faci == "Hospital"){
				if($reg1){
					if(!is_null($reg->lto_id)){
						$fac = 	DB::table('x08_ft')->where('appid',$reg->lto_id)->orderBy('id', 'ASC')->first()->facid;
					}
				}
				}else{
					$fac = DB::table('facilitytyp')->where('facname',$db->type_of_faci)->select('facid')->first()->facid;
				}


				$db->facid = $fac;
				return json_encode($db);
			}
		}

		public static function getSubDescByAst(Request $request, $ast) {
			try 
			{
				$sql = "SELECT asmt2_sdsc.asmt2sd_desc FROM asmt2_sdsc LEFT JOIN asmt2 ON asmt2_sdsc.asmt2sd_id = asmt2.asmt2sd_id WHERE asmt2.asmt2_id = '$ast'";
				$sqlData = DB::select($sql);
				return response()->json($sqlData);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getRecommendation(Request $request, $id) {
			try 
			{
				$sql = "SELECT * FROM surv_rec WHERE rec_id = '$id'";
				$sqlData = DB::select($sql);
				return response()->json($sqlData);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getMembersByTeamId(Request $request, $id) {
			try 
			{
				$sql = "SELECT fname, mname, lname FROM x08 WHERE team = '$id'";
				$sqlData = DB::select($sql);
				return response()->json($sqlData);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getMembersByTeamIdNotJson($id) {
			try 
			{
				// $sql = "SELECT uid FROM x08 WHERE team = '$id'";
				// $sqlData = DB::select($sql);
				$data = DB::table('x08')
						->where('team', '=', $id)
						->get();
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getEmployeeWithoutTeamOthers() {
			try {

				$data = DB::table('x08')
						->select('fname', 'mname', 'lname', 'team', 'position', 'uid')
						->whereNull('team')
						->get();
				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getEmployeeWithTeamOthers() {
			try {

				$data = DB::table('x08')
						->select('fname', 'mname', 'lname', 'team', 'position', 'uid')
						->whereNotNull('team')
						->get();

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getEmployeeFullNameByUid($uid) {
			try {

				$data = DB::table('x08')
						->select('fname', 'mname', 'lname', 'team', 'position')
						->where('uid', '=', $uid)
						->get();

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllNovDirections() {
			try {

				$data = DB::table('nov')->orderBy('orderDisplay','ASC')->get();

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getNovDirection(Request $request, $id) {
			try 
			{
				$data = DB::table('nov')->where('novid_directions', '=', $id)->get();
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getNovDirectionEx($id) {
			try 
			{
				$novdireindex = DB::table('nov_issued')->where('novid', '=', $id)->first();
				$novdire = DB::table('nov')->where('novid_directions', '=', $novdireindex->novdire)->first();
				return $novdire;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllUidByAppid($appid) {
			try {

				$data = DB::table('appform')
							->where('appid', '=', $appid)
							->select('uid', 'email', 'owner', 'rgnid')
							->distinct()
							->first();

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}
		
public static function getAllUidByRegFac($regfac_id) {
			try {

				$data = DB::table('registered_facility')
							->where('regfac_id', '=', $regfac_id)
							->select( 'email', 'owner', 'rgnid')
							->distinct()
							->first();

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}



		public static function getSignByUid($uid) {
			try {

				$data = DB::table('x08')
							->where('uid', '=', $uid)
							->select('authorizedsignature')
							->first();

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllNovIssuedByMonid($monid) {
			try {
				$data = DB::table('nov_issued')
							->where('monid', '=', $monid)
							->get();

				return ($data);
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getAllNovIssuedBySurvid($survid) {
			try {
				$data = DB::table('nov_issued')
							->where('survid', '=', $survid)
							->get();

				return ($data);
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getLOEByNov($novid) {
			try {
				$data = DB::table('loe')
							->where('novid', '=', $novid)
							->first();

				return ($data);
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getNovIssuedByNov($monid) {
			try {
				$data = DB::table('mon_form')->join('nov_issued','nov_issued.monid','mon_form.monid')->leftJoin('assessmentrecommendation','assessmentrecommendation.appid','mon_form.appid')->where('mon_form.monid', '=', $monid)->first();
				// $data = DB::table('nov_issued')
				// 			->where('novid', '=', $novid)
				// 			->first();

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getAllVerdict() {
			try {
				$data = DB::table('verdict')
				->orderBy('vid', 'DESC')
							->get();

				return ($data);
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getVerdict(Request $request, $vid) {
			try 
			{
				$data = DB::table('verdict')->where('vid', '=', $vid)->get();
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAttachMon($monid) {
			try {
				$data = DB::table('mon_form')
							->where('monid', '=', $monid)
							->select('attached_files')
							->first();

				return ($data);
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getAttachSurv($survid) {
			try {
				$data = DB::table('surv_form')
							->where('survid', '=', $survid)
							->select('attached_files')
							->first();

				return ($data);
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getAllFacilitiesByTypeApproved($type,$brgyid) {
			try {
				// dd(AjaxController::getFacNameByFacidEx($type)[0]->facilityname);
				// if(AjaxController::getFacNameByFacidEx($type) != null) {
					// $data = DB::table('licensed')
					// 			->leftJoin('x08_ft', 'x08_ft.appid', '=', 'licensed.appid')
					// 			->leftJoin('appform', 'appform.appid', '=', 'licensed.appid')
					// 			->distinct()
					// 			->select('licensed.appid, x08_ft.facid, appform.facilityname')
					// 			->where('x08_ft.facid', '=', $type)
					// 			->get();
				
					$toQuery = (isset($brgyid) ? 'AND appform.brgyid = '.'\''. $brgyid.'\'' : '');

					$data = DB::select("SELECT DISTINCT appform.appid,facilityname, appform.brgyid, x08_ft.facid from licensed join appform on appform.appid = licensed.appid join x08_ft on x08_ft.appid = appform.appid where appform.hfser_id IN('LTO','COA') AND x08_ft.facid = '$type' AND appform.isapprove = 1 $toQuery");


					// $data = DB::table('appform')
					// 			->join('x08_ft', 'x08_ft.appid', '=', 'appform.appid')
					// 			->where('x08_ft.facid', '=', /*AjaxController::getFacNameByFacidEx($type)[0]->facilityname*/ $type)
					// 			->where('isApprove', '=', 1)
					// 			->where('hfser_id', '=', 'LTO')
					// 			->select('appform.appid', 'appform.facilityname', 'x08_ft.facid', 'appform.uid', 'isApprove')
					// 			->get();
					// $data = DB::table('licensed')
					// 			->leftjoin('x08_ft', 'x08_ft.id', '=', 'licensed.x08_ftid')
					// 			->leftjoin('appform', 'appform.appid', '=', 'licensed.appid')
					// 			->where('x08_ft.facid', '=', $type)
					// 			->where('appform.isApprove', '=', 1)
					// 			->where('appform.hfser_id', '=', 'LTO')
					// 			->select('appform.appid', 'appform.facilityname', 'x08_ft.facid', 'appform.uid', 'appform.facilityname', 'owner', 'isApprove', 'appform.rgnid', 'appform.hfser_id')
					// 			->get();
				// } else {
				// 	$data = null;
				// }

				return ($data);
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';	
			}
		}

		public static function getFacNameByFacidEx($facid) // Get Facility Name
		{
			try 
			{
				// $sql = "SELECT x08_ft.facid, appform.facilityname FROM x08_ft LEFT JOIN facilitytyp ON facilitytyp.facid = x08_ft.facid LEFT JOIN appform ON appform.appid = x08_ft.appid WHERE x08_ft.facid = '$facid' AND appform.isApprove IS NOT NULL";
				$sql = "SELECT appform.facilityname FROM appform WHERE appid='$facid'";
				$facName = DB::select($sql);
				// dd($facName);

				return $facName;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getFacAddrByAppid($appid) // Get Facility Name
		{
			try 
			{
				$data = DB::table('appform')
						->where('appid', '=', $appid)
						->join('region', 'region.rgnid', '=', 'appform.rgnid')
						->join('province', 'province.provid', '=', 'appform.provid')
						->join('city_muni', 'city_muni.cmid', '=', 'appform.cmid')
						->join('barangay', 'barangay.brgyid', '=', 'appform.brgyid')
						->select('rgn_desc', 'provname', 'cmname', 'brgyname')
						->first();

				$newData = $data->brgyname.' '.$data->cmname.' '.$data->provname.' '.$data->rgn_desc;
				// dd($newData);

				return $newData;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getFacAddrByRegFacId($id) // Get Facility Name
		{
			try 
			{
				$data = DB::table('registered_facility')
						->where('regfac_id', '=', $id)
						->join('region', 'region.rgnid', '=', 'registered_facility.rgnid')
						->join('province', 'province.provid', '=', 'registered_facility.provid')
						->join('city_muni', 'city_muni.cmid', '=', 'registered_facility.cmid')
						->join('barangay', 'barangay.brgyid', '=', 'registered_facility.brgyid')
						->select('rgn_desc', 'provname', 'cmname', 'brgyname')
						->first();

				$newData = $data->brgyname.' '.$data->cmname.' '.$data->provname.' '.$data->rgn_desc;
				// dd($newData);

				return $newData;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllFacilityType() // Get Facility Name
		{
			try 
			{
				$data = DB::table('facilitytyp')
						->get();

				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getProvincesByRegionUnreg(Request $request, $rgnid) {
			try 
			{
				$data = DB::table('province')->where('rgnid', '=', $rgnid)->get();
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getProvincesByProvinceUnreg(Request $request, $provid) {
			try 
			{
				$data = DB::table('city_muni')->where('provid', '=', $provid)->get();
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getProvincesByCMUnreg(Request $request, $cmid) {
			try 
			{
				$data = DB::table('barangay')->where('cmid', '=', $cmid)->get();
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAddressByLocation($rgnid, $provid, $cmid, $brgyid) // Get Facility Name
		{
			try 
			{
				$data1 = DB::table('region')->where('rgnid', '=', $rgnid)->first();
				$data2 = DB::table('province')->where('provid', '=', $provid)->first();
				$data3 = DB::table('city_muni')->where('cmid', '=', $cmid)->first();
				$data4 = DB::table('barangay')->where('brgyid', '=', $brgyid)->first();

				$address = $data4->brgyname.' '.$data3->cmname.' '.$data2->provname.' '.$data1->rgn_desc;

				return $address;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getNovidById($id=0, $type) {
			try {
				if($type=="M") {
					$data = DB::table('nov_issued')
							->where('monid', '=', $id)
							->first();

					return $data;

				} else {
					$data = DB::table('nov_issued')
							->where('survid', '=', $id)
							->first();
					return $data;
				}
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getVerdictById($id) {
			try {
				$data = DB::table('verdict')
						->select('vdesc')
						->where('vid', '=', $id)
						->first();

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllMonTeam() {
			if(session()->has('employee_login')){
				try {
					$data = DB::table('mon_team')
					->get();

					if(AjaxController::getCurrentUserAllData()['cur_user'] != 'ADMIN'){
						if(AjaxController::getCurrentUserAllData()['rgnid'] != 'HFSRB'){
							$data = DB::table('mon_team')->where('rgnid',AjaxController::getCurrentUserAllData()['rgnid'])
								->get();
						}
					}

					return $data;
				} catch (Exception $e) {
					AjaxController::SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}

		public static function getAllSurvTeam() {
			if(session()->has('employee_login')){
				try {
					$data = DB::table('surv_team')
					->get();

					if(AjaxController::getCurrentUserAllData()['cur_user'] != 'ADMIN'){
						if(AjaxController::getCurrentUserAllData()['rgnid'] != 'HFSRB'){
							$data = DB::table('surv_team')->where('rgnid',AjaxController::getCurrentUserAllData()['rgnid'])
								->get();
						}
					}

					return $data;
				} catch (Exception $e) {
					AjaxController::SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}

		public static function getRegionById($rgnid) {
			try {
				$data = DB::table('region')
						->where('rgnid', '=', $rgnid)
						->first();

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getRegionByAppId($appid) {
			try {
				$data = DB::table('appform')
						->select('rgnid')
						->where('appid', '=', $appid)
						->first();

				$data = DB::table('region')
						->select('rgn_desc')
						->where('rgnid', $data->rgnid)
						->first()
						->rgn_desc;

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllMonTeamMembers($montid = null) {
			try {
				$data = DB::table('mon_team_members');
				if(isset($montid)){
					$data = $data->where('montid',$montid);
				}

				return $data->get();
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllSurvTeamMembers($montid = null) {
			try {
				$data = DB::table('surv_team_members');
				if(isset($montid)){
					$data = $data->where('montid',$montid);
				}

				return $data->get();
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllX08($rgnid = null) {
			try {
				$data = DB::table('x08')
						->whereIn('grpid',['LO3','LO4','RLO']);
				if(isset($rgnid)){
					$data = $data->where('rgnid',$rgnid);
				}

						// dd($data);

				return $data->get();
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getTeamMemberRemarks(Request $request, $montmemberid) {
			try 
			{
				$data = DB::table('mon_team_members')->where('montmemberid', '=', $montmemberid)->first();
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getTeamMemberRemarksSurv(Request $request, $montmemberid) {
			try 
			{
				$data = DB::table('surv_team_members')->where('montmemberid', '=', $montmemberid)->first();
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getMonTeamByRegionJSON(Request $request, $rgnid) {
			try {
				$data = DB::table('mon_team')
						->where('rgnid', '=', $rgnid)
						->get();

				return response()->json($data);
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getSurvTeamByRegionJSON(Request $request, $rgnid) {
			try {
				$data = DB::table('surv_team')
						->where('rgnid', '=', $rgnid)
						->get();

				return response()->json($data);
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getMembersByNewTeamId(Request $request, $id) {
			try 
			{
				$data = DB::table('mon_team_members')
						->where('montid', '=', $id)
						->get();
 
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getMembersByNewTeamIdSurv(Request $request, $id) {
			try 
			{
				$data = DB::table('surv_team_members')
						->where('montid', '=', $id)
						->get();
 
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getTeamByTeamId($id) {
			try {
				$data = DB::table('mon_team')
						->where('montid', '=', $id)
						->first();

						// dd($data);

				return $data;
			} catch (Exception $e) {
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getMembersByNewTeamIdNotJSON($id) {
			try 
			{
				$data = DB::table('mon_team_members')
						->where('montid', '=', $id)
						->get();
 
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getPositionByUID($id) {
			try 
			{
				$data = DB::table('x08')
						->where('uid', '=', $id)
						->select('position')
						->first();
 
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAppCodeByAppid($appid) {
			try 
			{
				$data = DB::table('appform')
						->where('appid', $appid)
						->first();
				return (isset($data) ? $data->hfser_id . 'R' . $data->rgnid . '-' . $data->appid : null);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		////////////////////////////////////////////////// End of Others, Lloyd  //////////////////////////////////////////////////

		public function print(Request $request)
		{
			if($request->isMethod('POST')){
				header('Content-Type: application/pdf');
				$pdf = \App::make('snappy.pdf.wrapper');
                $pdf->setOption('encoding', 'UTF-8');
                $pdf->setOption('page-size', 'A3');
				$pdf->setOption("footer-right", "Page [page] of [topage]");
                $pdf->setOption("footer-left", "Generated: ". Date('F j, Y h:i A',strtotime('now')));
                $pdf->loadHTML($request->html);
 				// return $pdf->download($request->filename.'.pdf');
 				return $pdf->inline();
			} else {
				return 'Forbidden';
			}
		}

		public static function canViewFDAOOP($appid){
			if(!empty($appid)){
				$data = AjaxController::getAllDataEvaluateOne($appid);
				// 1st machine, 2nd pharmacy
				return [DB::table('cdrrhrxraylist')->where('appid',$appid)->exists(),(isset($data->noofmain) || isset($data->noofsatellite) ? true: false)];
			}
		}



		public static function canProcessNextStepFDA($appid,$moduleForMachine,$moduleForPharma){
			if(!empty($appid) && !empty($moduleForMachine) && !empty($moduleForPharma)){
				$data = AjaxController::getAllDataEvaluateOne($appid);
				$forMachine = self::canViewFDAOOP($appid)[0];
				$forPharma = self::canViewFDAOOP($appid)[1];


				if($forMachine){

					if(strtolower($data->hfser_id) == 'lto' && (AjaxController::canViewFDAOOP($data->appid)[0] || AjaxController::canViewFDAOOP($data->appid)[1]) ){
                          if( ($data->$moduleForMachine != 1 && AjaxController::canViewFDAOOP($data->appid)[0]) || ($data->$moduleForPharma != 1 && AjaxController::canViewFDAOOP($data->appid)[1]) ){
                        	return false;
                          }
	                }

				}

			}
			return true;
		}

		// public static function fdaCashierFields($appid){
		// 	$data = self::canViewFDAOOP($appid);
		// 	$appform = AjaxController::getAllDataEvaluateOne($appid);
		// 	$toReturn = [];

		// 	if($data[0]){
		// 		array_push($toReturn, $appform->isCashierApproveFDA);
		// 	}

		// 	if($data[1]){
		// 		array_push($toReturn, $appform->isCashierApprovePharma);
		// 	}
		// 	return $toReturn;

		// }

		public function activityLog(Request $request)
		{
			$curUser = AjaxController::getCurrentUserAllData();
			if(!DB::table('activitylogs')->insert([
				['mod_id' => $request->mod_id, 'act' => $request->activity, 'ipaddress' => $curUser['ip'], 'uid' => $curUser['cur_user']]
			])){
				return 'error';
			}
				return 'done';
				// return $request->activity;
		}

		////////////////////////////////////////////////// lloyd client1  //////////////////////////////////////////////////

		public static function getAllProfessions() {
			try 
			{
				$data = DB::table('pwork')
						->get();
 
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllEmploymentStatus() {
			try 
			{
				$data = DB::table('pwork_status')
						->get();
 
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAllAnnexA() {
			try 
			{
				$data = DB::table('hfsrbannexa')
						->get();
 
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function getAnnexAById(Request $request, $id) {
			try 
			{
				$data = DB::table('hfsrbannexa')
						->where('id', '=', $id)
						->get();
 
				return response()->json($data);
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		////////////////////////////////////////// new lloyd ///////////////////////////////////////////////////
		public static function submitRequest(Request $request) {
			try 
			{
				return response()->json($request->all());
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage());
				return 'ERROR';
			}
		}

		public static function filterString($string,$toFind){
			if(isset($string) && isset($toFind)){
				$str = null;
				$ret = array();
				$strLeng = strlen($string);
				for ($i=0; $i < $strLeng; $i++) { 
					if(substr($string, $i,1) != $toFind){
						$str .= substr($string, $i,1);
					} else {
						array_push($ret, $str);
						$str = null;
					}	
				}
				array_push($ret, $str);
				return $ret;
			}
		}


		public static function isPasswordExpired($uid){
			if(!empty($uid)){
				$m99 = self::getAllFrom('m99')[0];
				$data = DB::table('x08')->where('uid',$uid)->first();
				$debunk = self::filterString($m99->pass_exp,'-');
				$onExpiry = Carbon::parse((isset($data->lastChangePassDate) ? $data->lastChangePassDate :$data->t_date))->addYear($debunk[0])->addMonths($debunk[1])->addDays($debunk[2]);
				if($onExpiry->lt(Carbon::now())){
					return true;
				}
			}
			return false;
		}

		public static function processExpired($uid,$oldpass,$newpass)
		{
			try {
				$pwd = DB::table('x08')->where('uid',$uid)->select('pwd')->first()->pwd;
				$chck = Hash::check($oldpass, $pwd);
				if($chck && !self::isPreviousPassword($newpass,$uid) && !Hash::check($newpass, $pwd)){
					$hashedPass = Hash::make($newpass);
					$upd = array('pwd' => $hashedPass, 'lastChangePassDate' => Date('Y-m-d'), 'lastChangePassTime' => Date('H:i:s',strtotime('now')));
					DB::table('pwdHistory')->insert(['uid' => $uid, 'pwd' => $pwd, 'ip' => Request()->ip() ]);
					$data = DB::table('x08')->where('uid', '=', $uid)->update($upd);
					if ($data) {
						if(session()->has('employee_login') || session()->has('uData')){
							if(session()->has('employee_login')){
								session()->forget('employee_login');
							}
							if(session()->has('uData')){
								session()->forget('uData');
							}
						}
						return 'DONE';
					} else {
						return 'ERROR';
					}
				} else if(!$chck) {
					return 'Incorrect Password! Please try again';
				} else {
					return 'Password cannot be same with older or current password!';
				}
			} 
			catch (Exception $e) 
			{
				return json_encode($e);
				self::SystemLogs($e);
				return 'ERROR';
			}
		}

	public static function getHeads($whereClause = array(), $select = array()){
		$joinedData = DB::table('x08_ft')
        ->leftJoin('facilitytyp', 'x08_ft.facid', '=', 'facilitytyp.facid')
        ->leftJoin('serv_type','facilitytyp.servtype_id','serv_type.servtype_id')
        ->leftJoin('serv_asmt', 'x08_ft.facid', '=', 'serv_asmt.facid')
		->leftJoin('asmt_title', 'serv_asmt.part', '=', 'asmt_title.title_code')
		->leftJoin('asmt2', 'serv_asmt.asmt2_id', '=', 'asmt2.asmt2_id')
		->leftJoin('asmt2_loc', 'asmt2.asmt2_loc', '=', 'asmt2_loc.asmt2l_id')
        ->select(
			$select
		)
        ->orderBy('asmt_title.title_name','ASC')->orderBy('serv_asmt.srvasmt_seq','ASC')
        ->where($whereClause)
        ->distinct()
        ->get();
        return $joinedData;
	}

	public static function arrangeAssessment($testArray = array()){
		$testFinalArray = array();
		$sortArray = array(); 
		foreach ($testArray as $key => $value) {
			$testHere = $testArray[$key];
			ksort($testHere,SORT_NATURAL);
			array_push($testFinalArray, $testHere);
		}
		return call_user_func_array("array_merge", $testFinalArray);
	}

	public static function filterAssessmentData($string,$toFind,$stopAt){
		$part = null;
		$findSeq = strpos($string,$toFind);
		if($findSeq !== false) {
			$findSeq +=strlen($toFind);
			while(substr($string,$findSeq,strlen($stopAt)) !== $stopAt){
				$part = $part.substr($string,$findSeq,1);
				$findSeq +=1;
			}
		}
		return $part;
	}


	public static function forAssessmentMasterfileCombined($case,$where = true,$select = '*', $orderBy = 'ASC', $limit = false){
		if(session()->has('employee_login')){
			switch ($case) {
				case 2:
					$test = DB::table('asmt_h3')->join('asmt_h2','asmt_h2.asmtH2ID','asmt_h3.asmtH2ID_FK')->join('asmt_h1','asmt_h1.asmtH1ID','asmt_h2.asmtH1ID_FK')->join('asmt_title','asmt_title.title_code','asmt_h1.partID')->join('facilitytyp','facilitytyp.facid','asmt_title.serv')->select($select)->where($where);
					break;
				
				default:
					$test = DB::table('assessmentcombined')->join('asmt_h3','asmt_h3.asmtH3ID','assessmentcombined.asmtH3ID_FK')->join('asmt_h2','asmt_h2.asmtH2ID','asmt_h3.asmtH2ID_FK')->join('asmt_h1','asmt_h1.asmtH1ID','asmt_h2.asmtH1ID_FK')->join('asmt_title','asmt_title.title_code','asmt_h1.partID')->join('facilitytyp','facilitytyp.facid','asmt_title.serv')->leftjoin('x08','x08.uid','assessmentcombined.uid')->select($select)->where($where)->orderBy('assessmentcombined.asmtComb',$orderBy);
					break;
			}
			if($limit){
				$test->limit($limit);
			}
			return $test->get();
		}
		return false;
	}

	public static function forAssessmentHeaders($whereClause = array(),$select = '*',$case = 'default'){
		if(session()->has('employee_login') || Agent::isMobile() || session()->has('uData')){
			switch ($case) {


				case(1):
				return DB::table('x08_ft')->join('appform','appform.appid','x08_ft.appid')->join('facilitytyp','facilitytyp.facid','x08_ft.facid')->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')->join('asmt_title','asmt_title.serv','facilitytyp.facid')->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')->join('assessmentcombined','assessmentcombined.asmtH3ID_FK','asmt_h3.asmtH3ID')->where($whereClause)->select($select)->distinct()->get();
					break;

				case(2):
				return DB::table('x08_ft')->join('appform','appform.appid','x08_ft.appid')->join('facilitytyp','facilitytyp.facid','x08_ft.facid')->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')->join('asmt_title','asmt_title.serv','facilitytyp.facid')->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')->join('assessmentcombined','assessmentcombined.asmtH3ID_FK','asmt_h3.asmtH3ID')->where($whereClause)->orderBy('assessmentSeq','ASC')->select($select)->distinct()->get();
					break;

				case(3):
				return DB::table('asmt_title')->join('facilitytyp','facilitytyp.facid','asmt_title.serv')->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')->join('hfaci_serv_type','hfaci_serv_type.hfser_id','asmt_h1.apptype')->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')->join('assessmentcombined','assessmentcombined.asmtH3ID_FK','asmt_h3.asmtH3ID')->where($whereClause)->orderBy('assessmentSeq','ASC')->select($select)->distinct()->get();
					break;

				
				default:
					// return DB::table('x08_ft')
					// ->join('appform','appform.appid','x08_ft.appid')
					// ->join('facilitytyp','facilitytyp.facid','x08_ft.facid')
					// ->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')
					// ->join('asmt_title','asmt_title.serv','facilitytyp.facid')
					// ->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')
					// ->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')
					// ->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')
					// ->where($whereClause)
					// ->select($select)
					// // ->groupBy('x08_ft.id')
					// ->get();
					return DB::table('x08_ft')->join('appform','appform.appid','x08_ft.appid')->join('facilitytyp','facilitytyp.facid','x08_ft.facid')->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')->join('asmt_title','asmt_title.serv','facilitytyp.facid')->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')->where($whereClause)->select($select)->distinct()->get();
					break;
			}
		}
		return false;
	}
	public static function forAssessmentHeadersDup($whereClause = array(),$select = '*',$case = 'default'){
		if(session()->has('employee_login') || Agent::isMobile() || session()->has('uData')){
			switch ($case) {


				case(1):
				return DB::table('x08_ft')->join('appform','appform.appid','x08_ft.appid')->join('facilitytyp','facilitytyp.facid','x08_ft.facid')->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')->join('asmt_title','asmt_title.serv','facilitytyp.facid')->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')->join('assessmentcombined','assessmentcombined.asmtH3ID_FK','asmt_h3.asmtH3ID')->where($whereClause)->select($select)->distinct()->get();
					break;

				case(2):
				return DB::table('x08_ft')->join('appform','appform.appid','x08_ft.appid')->join('facilitytyp','facilitytyp.facid','x08_ft.facid')->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')->join('asmt_title','asmt_title.serv','facilitytyp.facid')->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')->join('assessmentcombined','assessmentcombined.asmtH3ID_FK','asmt_h3.asmtH3ID')->where($whereClause)->orderBy('assessmentSeq','ASC')->select($select)->distinct()->get();
					break;

				case(3):
				return DB::table('asmt_title')->join('facilitytyp','facilitytyp.facid','asmt_title.serv')->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')->join('hfaci_serv_type','hfaci_serv_type.hfser_id','asmt_h1.apptype')->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')->join('assessmentcombined','assessmentcombined.asmtH3ID_FK','asmt_h3.asmtH3ID')->where($whereClause)->orderBy('assessmentSeq','ASC')->select($select)->distinct()->get();
					break;

				
				default:
					// return DB::table('x08_ft')
					// ->join('appform','appform.appid','x08_ft.appid')
					// ->join('facilitytyp','facilitytyp.facid','x08_ft.facid')
					// ->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')
					// ->join('asmt_title','asmt_title.serv','facilitytyp.facid')
					// ->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')
					// ->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')
					// ->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')
					// ->where($whereClause)
					// ->select($select)
					// // ->groupBy('x08_ft.id')
					// ->get();
					return DB::table('x08_ft')
					->join('appform','appform.appid','x08_ft.appid')
					->join('facilitytyp','facilitytyp.facid','x08_ft.facid')
					->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')
					->join('asmt_title','asmt_title.serv','facilitytyp.facid')
					->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')
					->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')
					->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')
					->leftJoin('assessmentcombinedduplicate','appform.appid','assessmentcombinedduplicate.appid')
					->where($whereClause)
					->select($select)
					->distinct()
					->get();
					break;
			}
		}
		return false;
	}

	public static function forAssessmentHeadersRegFac($whereClause = array(),$select = '*',$case = 'default'){
		if(session()->has('employee_login') || Agent::isMobile() || session()->has('uData')){
		
			switch ($case) {
					case(2):
						return DB::table('registered_facility')
						// ->join('appform','appform.appid','x08_ft.appid')
						->join('facilitytyp','facilitytyp.hgpid','registered_facility.facid')
						// ->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')
						->join('asmt_title','asmt_title.serv','facilitytyp.facid')
						->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')
						->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')
						->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')
						->join('assessmentcombined','assessmentcombined.asmtH3ID_FK','asmt_h3.asmtH3ID')
						->where($whereClause)
						->orderBy('assessmentSeq','ASC')
						->select($select)
						->distinct()
						->get();
					break;

					default:
						return DB::table('registered_facility')
						// ->join('appform','appform.appid','x08_ft.appid')
						->join('facilitytyp','facilitytyp.hgpid','registered_facility.facid')
						// ->join('hfaci_serv_type','hfaci_serv_type.hfser_id','appform.hfser_id')
						->join('asmt_title','asmt_title.serv','facilitytyp.facid')
						->join('asmt_h1','asmt_h1.partID','asmt_title.title_code')
						->join('asmt_h2','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')
						->join('asmt_h3','asmt_h3.asmtH2ID_FK','asmt_h2.asmtH2ID')
						->where($whereClause)
						->select($select)
						->distinct()
						->get();
					break;
				}		
		
		}
		return false;
	}

	// public static function forDoneHeaders($appid,$monid,$selfAssess,$isPtc = false){
	// 	$h1 = $h2 = $h3 = array();
	// 	$monid = ($monid ? $monid : null);
	// 	$selfAssess = ($selfAssess ? 1 : null);
	// 	if(!$isPtc){
	// 		$table = 'assessmentcombinedduplicate';
	// 		$whereClause = [['appid',$appid],['monid',$monid],['selfassess',$selfAssess]];
	// 	} else {
	// 		$table = 'assessmentcombinedduplicateptc';
	// 		$whereClause = [['appid',$appid],['evaluatedBy',session()->get('employee_login')->uid]];
	// 	}
	// 	$db = DB::table($table)->where($whereClause)->select('asmtH3ID_FK','asmtH2ID_FK','asmtH1ID_FK')->distinct()->get();
	// 	foreach ($db as $key => $value) {
	// 		for ($i=0; $i < 4; $i++) { 
				
	// 		}
	// 		if(!in_array($value->asmtH1ID_FK, $h1)){
	// 			array_push($h1, $value->asmtH1ID_FK);
	// 		}
	// 		if(!in_array($value->asmtH2ID_FK, $h2)){
	// 			array_push($h2, $value->asmtH2ID_FK);
	// 		}
	// 		if(!in_array($value->asmtH3ID_FK, $h3)){
	// 			array_push($h3, $value->asmtH3ID_FK);
	// 		}
	// 	}
	// 	$retArray = [
	// 		'h1' => $h1,
	// 		'h2' => $h2,
	// 		'h3' => $h3
	// 	];
	// 	return $retArray;
	// }

	public static function forDoneHeaders($appid,$monid,$selfAssess,$isPtc = false,$revision = null){
		$h1 = $h2 = $h3 = $h4 = array();
		$monid = ($monid ? $monid : null);
		$selfAssess = ($selfAssess ? 1 : null);

		if(!$isPtc){
			$table = 'assessmentcombinedduplicate';
			$whereClause = [['appid',$appid],['monid',$monid],['selfassess',$selfAssess]];
		} else {
			$table = 'assessmentcombinedduplicateptc';
			$whereClause = [['appid',$appid],['evaluatedBy',session()->get('employee_login')->uid],['revision',$revision]];
		}
		$db = DB::table($table)->where($whereClause)->select('asmtH3ID_FK','asmtH2ID_FK','asmtH1ID_FK','partID')->distinct()->get();
		
		foreach ($db as $key => $value) {
			for ($i=0; $i < 4; $i++) { 
				
			}
			if(!in_array($value->asmtH1ID_FK, $h1)){
				array_push($h1, $value->asmtH1ID_FK);
			}
			if(!in_array($value->asmtH2ID_FK, $h2)){
				array_push($h2, $value->asmtH2ID_FK);
			}
			if(!in_array($value->asmtH3ID_FK, $h3)){
				array_push($h3, $value->asmtH3ID_FK);
			}
			if(!in_array($value->partID, $h4)){
				array_push($h4, $value->partID);
			}
		}
		$retArray = [
			'h1' => $h1,
			'h2' => $h2,
			'h3' => $h3,
			'h4' => $h4
		];
		return $retArray;
	}
public static function forDoneHeadersNew($appid,$monid,$selfAssess,$isPtc = false,$revision = null){
		$h1 = $h2 = $h3 = $h4= $h5 = array();
		$monid = ($monid ? $monid : null);
		$selfAssess = ($selfAssess ? 1 : null);
		if(!$isPtc){
			$table = 'assessmentcombinedduplicate';
			$whereClause = [['appid',$appid],['monid',$monid],['selfassess',$selfAssess]];
		} else {
			$table = 'assessmentcombinedduplicateptc';
			$whereClause = [['appid',$appid],['evaluatedBy',session()->get('employee_login')->uid],['revision',$revision]];
		}
		$db = DB::table($table)->where($whereClause)->select('asmtH3ID_FK','asmtH2ID_FK','asmtH1ID_FK','partID','x08_id')->distinct()->get();
		foreach ($db as $key => $value) {
			for ($i=0; $i < 4; $i++) { 
				
			}
			if(!in_array($value->asmtH1ID_FK, $h1)){
				array_push($h1, $value->asmtH1ID_FK);
			}
			if(!in_array($value->asmtH2ID_FK, $h2)){
				array_push($h2, $value->asmtH2ID_FK);
			}
			if(!in_array($value->asmtH3ID_FK, $h3)){
				array_push($h3, $value->asmtH3ID_FK);
			}
			if(!in_array($value->partID, $h4)){
				array_push($h4, $value->partID);
			}
			if(!in_array($value->x08_id, $h5)){
				array_push($h5, $value->x08_id);
			}
		}
		$retArray = [
			'h1' => $h1,
			'h2' => $h2,
			'h3' => $h3,
			'h4' => $h4,
			'h5' => $h5
		];
		return $retArray;
	}

	public static function forDoneHeadersNewMon($appid,$monid,$selfAssess,$isPtc = false,$revision = null){
		$h1 = $h2 = $h3 = $h4= $h5 = array();
		$monid = ($monid ? $monid : null);
		$selfAssess = ($selfAssess ? 1 : null);
		// if(!$isPtc){
		// 	$table = 'assessmentcombinedduplicate';
		// 	$whereClause = [['appid',$appid],['monid',$monid],['selfassess',$selfAssess]];
		// } else {
		// 	$table = 'assessmentcombinedduplicateptc';
		// 	$whereClause = [['appid',$appid],['evaluatedBy',session()->get('employee_login')->uid],['revision',$revision]];
		// }

		$whereClause = [['assessmentcombinedduplicate.appid',$appid],['monid',$monid]];
		$db = DB::table('assessmentcombinedduplicate')
		// ->join('asmt_h1', 'asmt_h1.partID', '=', 'assessmentcombinedduplicate.partID')
		->where($whereClause)
		->select('assessmentcombinedduplicate.pid')
		->groupBy('assessmentcombinedduplicate.pid')
		->get();

		// $whereClause = [['assessmentcombinedduplicate.appid',$appid],['monid',$monid]];
		// $db = DB::table('assessmentcombinedduplicate')
		// ->join('asmt_h1', 'asmt_h1.partID', '=', 'assessmentcombinedduplicate.partID')
		// ->where($whereClause)
		// ->select('asmt_h1.asmtH1ID')
		// ->groupBy('asmt_h1.asmtH1ID')
		// ->get();

		// foreach ($db as $key => $value) {
		// 	for ($i=0; $i < 4; $i++) { 
				
		// 	}
		// 	if(!in_array($value->asmtH1ID, $h1)){
		// 		array_push($h1, $value->asmtH1ID);
		// 	}
		// }
		foreach ($db as $key => $value) {
			for ($i=0; $i < 4; $i++) { 
				
			}
			if(!in_array($value->pid, $h1)){
				array_push($h1, $value->pid);
			}
		}
		$retArray = [
			'h1' => $h1,

		];
		return $retArray;
	}

	public static function sendTo($isSelfAssessment,$isMobile,$requests,$view,$data = array()){
		return ($isSelfAssessment ? $data : ($isMobile && array_key_exists('isMobile', $requests) ? response()->json( $data ) : view($view,$data)) );
		/*
		if($isSelfAssessment ? $data : ($isMobile && array_key_exists('isMobile', $request)))
		{
			header('Content-Type: application/json');
			response()->json( $data );
		} else {
			view($view, $data);
		}*/
	}

	public static function createMobileSessionIfMobile(Request $request){
		try {
		    //Agent::isMobile() && 
			if(array_key_exists('isMobile', $request->all()) && array_key_exists('uid', $request->all())){
				$sessionForMobile = new DOHController;
				$sessionForMobile->sessionForMobile($request->uid);
			}
		} catch (Exception $e) {
			self::SystemLogs($e);
		}
		
	}

	public static function createMobileSessionIfMobileNEW(Request $request){
		try {
		    //Agent::isMobile() && 
			//if(array_key_exists('isMobile', $request->all()) && array_key_exists('uid', $request->all())){
				$sessionForMobile = new DOHController;
				$sessionForMobile->sessionForMobile($request->uid);
			//}
		} catch (Exception $e) {
			self::SystemLogs($e);
		}
		
	}

	public static function assessedDone($cond,$appid,$monid = null,$selfAssess = null, $isPtc = false){
		$arrayToSend = array();

		if(isset($cond)){

			$arrAssessd = array();
			$monid = ($monid ? $monid : null);
			$selfAssess = ($selfAssess ? $selfAssess : null);

			if(!$isPtc){
				switch ($cond) {
					case 1:
						$forLoop = 'asmtH2ID';
						$assesed = db::table('assessed')->join('asmt_h2','asmt_h2.asmtH2ID','assessed.headerid')->where([['assessed.appid', $appid],['headerlvl',3],['monid',$monid],['selfAssess',$selfAssess]])->select($forLoop)->get();
						break;
					
					case 2:
						$forLoop = 'asmtH1ID';
						$assesed = db::table('assessed')->join('asmt_h1','asmt_h1.asmtH1ID','assessed.headerid')->where([['assessed.appid', $appid],['headerlvl',2],['monid',$monid],['selfAssess',$selfAssess]])->select($forLoop)->get();
						break;

					// case 3:
					// 	$forLoop = 'partID';
					// 	$assesed = db::table('assessed')->join('asmt_h1','asmt_h1.partID','assessed.headerid')->where([['assessed.appid', $appid],['headerlvl',1],['monid',$monid],['selfAssess',$selfAssess]])->select($forLoop)->get();
					// 	break;
					case 3:
						$forLoop = 'partID';
						$assesed = db::table('assessed')->join('asmt_h1','asmt_h1.partID','assessed.headerid')->where([['assessed.appid', $appid],['headerlvl',3],['monid',$monid],['selfAssess',$selfAssess]])->select($forLoop)->get();
						break;
				}
			} else {
				switch ($cond) {
					case 1:
						$forLoop = 'asmtH2ID';
						$assesed = db::table('assessedptc')->join('asmt_h2','asmt_h2.asmtH2ID','assessedptc.headerid')->where([['assessedptc.appid', $appid],['headerlvl',3],['uid',session()->get('employee_login')->uid]])->select($forLoop)->get();
						break;
					
					case 2:
						$forLoop = 'asmtH1ID';
						$assesed = db::table('assessedptc')->join('asmt_h1','asmt_h1.asmtH1ID','assessedptc.headerid')->where([['assessedptc.appid', $appid],['headerlvl',2],['uid',session()->get('employee_login')->uid]])->select($forLoop)->get();
						break;

					case 3:
						$forLoop = 'partID';
						$assesed = db::table('assessedptc')->join('asmt_h1','asmt_h1.partID','assessedptc.headerid')->where([['assessedptc.appid', $appid],['headerlvl',1],['uid',session()->get('employee_login')->uid]])->select($forLoop)->get();
						break;
				}
			}
			foreach ($assesed as $key => $value) {
				if(!in_array($value->$forLoop, $arrAssessd)){
					array_push($arrAssessd, $value->$forLoop);
				}
			}
		}
		return $arrAssessd;
	}

	public static function logAssessed($headerLvl,$appid,$id,$monid,$selfAssess, $isPtc = false){

		if(!$isPtc){
			$table = 'assessed';
			$whereClause = [['appid',$appid],['headerid',$id],['headerlvl',$headerLvl],['monid',$monid],['selfAssess',$selfAssess]];
			$insertClause = ['headerlvl' => $headerLvl, 'headerid' =>$id, 'appid' => $appid, 'monid' => $monid, 'selfAssess' => $selfAssess];
		} else {
			$table = 'assessedptc';
			$whereClause = [['appid',$appid],['headerid',$id],['headerlvl',$headerLvl],['uid',session()->get('employee_login')->uid]];
			$insertClause = ['headerlvl' => $headerLvl, 'headerid' =>$id, 'appid' => $appid, 'uid' => session()->get('employee_login')->uid];	
		}
		if( DB::table($table)->where($whereClause)->doesntExist() ){

			$test = DB::table($table)->insert($insertClause);
			if($test){
				return 'done';
			}	
		}
		return 'error';
	}

	/////////////////// LLOYD COMEBACK ////////////////////
	public static function getAllViolationsNew($monid) // Get Facility Type
	{
		try 
		{
			$data = DB::table('assessmentcombinedduplicate')
					->where('monid', $monid)
					->where('evaluation', '0')
					->get();
			$violations = "";
			// dd($data[0]->assessmentName);

			for($i=0; $i<count($data); $i++){
				$violations .= $data[$i]->h2name;
				if($i<count($data)-1)  $violations .= ", ";
			}
			// dd($violations);
			return $violations;
		}
		catch (Exception $e) 
		{
			AjaxController::SystemLogs($e->getMessage());
			return 'ERROR';
		}
	}

	public static function getAllViolationsKeyNew($monid) // Get Facility Type
	{
		try 
		{
			$data = DB::table('assessmentcombinedduplicate')
					->where('monid', $monid)
					->where('evaluation', '0')
					->get();
			$violations = "";
			// dd($data[0]->assessmentName);

			for($i=0; $i<count($data); $i++){
				$violations .= $data[$i]->dupID;
				if($i<count($data)-1)  $violations .= ", ";
			}
			// dd($violations);
			return $violations;
		}
		catch (Exception $e) 
		{
			AjaxController::SystemLogs($e->getMessage());
			return 'ERROR';
		}
	}

	public static function getViolationsNew(Request $r)
	{
		try {
			$data = DB::table('assessmentcombinedduplicate')
					->where('dupID', $r->dupId)
					->first();
			$data = [$data->assessmentHead, $data->remarks, $data->assessmentName];
			return $data;
		} catch (Exception $e) {
			AjaxController::SystemLogs($e->getMessage());
			return 'ERROR';
		}
	}

	public static function isSessionExist(array $session){
		try {
			$arrRet = array();
			$toPush = false;
			
			if(is_array($session) && count($session) > 0){

				foreach ($session as $key) {
					$toPush = (session()->has($key) ? true : false);
					array_push($arrRet, $toPush);
				}

			}
			return $arrRet;
			
		} catch (Exception $e) {
			AjaxController::SystemLogs($e->getMessage());
			return 'ERROR';
		}
	}

	public static function isRequestForFDA($request){
		$selection = array('machines','pharma');
		$selected = null;

		if(!in_array($request, $selection)){
			$selected = 'machines';
		} else {
			$selected = strtolower($request);
		}
		
		return $selected;
	}


	public static function maxRevisionFor($appid,$otherCondition = [],$getAll = false){
		$whereClause = [['appid',$appid]];
		if(count($otherCondition) > 0){
			array_push($whereClause, $otherCondition);
		}
		// return 1;
	
		return ($getAll ? DB::table('hferc_evaluation')->where($whereClause)->first() : (DB::table('hferc_evaluation')->where($whereClause)->max('revision') ?? 0));
		// return ($getAll ? DB::table('hferc_evaluation')->where($whereClause)->orderBy('revision','DESC')->first() : (DB::table('hferc_evaluation')->where($whereClause)->max('revision') ?? 0));
	}

	public static function mobileMaxRevision(Request $request, $appid){
		if(isset($appid)){
			$arrRet = [
				'nextCount' => (self::maxRevisionFor($appid)+1),
				'appid' => $appid
			];
			return response()->json(self::sendTo(false,true,$request->all(),'employee.processflow.pfassessmentShowPart',$arrRet));
		}
		return null;
	}

	public static function getHighestApplicationFromX08FT($appid){
		if(!empty($appid)){

			$check =  DB::table('x08_ft')->join('facilitytyp','x08_ft.facid','facilitytyp.facid')->join('hfaci_grp','facilitytyp.hgpid','hfaci_grp.hgpid')
			->where([['x08_ft.appid',$appid]])
			->orderBy('x08_ft.id', 'ASC')
			->get();

			$st = 1;
			
			foreach($check as $c){
				if($c->hgpid == 6 && !is_null($c->specified)){
					$st = $c->servtype_id;
				}

				if($c->hgpid == 34){
					$st = $c->servtype_id;
				}

			}			
			
			return DB::table('x08_ft')->join('facilitytyp','x08_ft.facid','facilitytyp.facid')->join('hfaci_grp','facilitytyp.hgpid','hfaci_grp.hgpid')->where([['x08_ft.appid',$appid],['facilitytyp.servtype_id',$st]])
			->orderBy('x08_ft.id', 'ASC')->first();
			// return DB::table('x08_ft')->join('facilitytyp','x08_ft.facid','facilitytyp.facid')->join('hfaci_grp','facilitytyp.hgpid','hfaci_grp.hgpid')->where([['x08_ft.appid',$appid],['facilitytyp.servtype_id',1]])->first();
		}
	}

	public static function getFacilitytypeFromHighestApplicationFromX08FT($appid){
		if(!empty($appid)){
			return ( isset( self::getHighestApplicationFromX08FT($appid)->hgpid ) ? DB::table('hfaci_grp')->where('hgpid',self::getHighestApplicationFromX08FT($appid)->hgpid)->first() : null);
		}
	}
	//All authorization except CON and PTC
	public static function getAuthorizationTypeExceptCONPTC($appid){
		$hfser_id="";
		$data = DB::select("SELECT facl_grp.hfser_id FROM x08_ft LEFT JOIN facilitytyp ON x08_ft.facid=facilitytyp.facid LEFT JOIN facl_grp ON facl_grp.hgpid=facilitytyp.hgpid WHERE x08_ft.appid!='NULL' AND facl_grp.hfser_id!='PTC' AND facl_grp.hfser_id!='CON' AND x08_ft.appid='$appid' ORDER BY ABS(appid)");		
		
		if(count($data)){
			foreach($data AS $each){
				$hfser_id = $each->hfser_id;
			}
		}
		return $hfser_id;
	}

	//All authorization except CON and PTC
	public static function getAuthorizationTypeByAppID($appid){
		$hfser_id="";
		$data = DB::select("SELECT hfser_id FROM appform WHERE appid='$appid' ");		
		
		if(count($data)){
			foreach($data AS $each){
				$hfser_id = $each->hfser_id;
			}
		}
		return $hfser_id;
	}

	public static function deleteUploadedOnPublic($filename){
		if(Storage::exists('public/uploaded/'.$filename)){
			unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploaded' . DIRECTORY_SEPARATOR . $filename ));
		}
		return true;
	}

	public static function isRequredToPayPTC($revision){
		if(!empty($revision) && $revision > 2 && ($revision % 2 != 0)){
			return true;
		}
		return false;
	}

	public static function getRegionNameOrHFSRB()
	{

	}

	public static function actionsForROA(Request $request, $action){
		$x_action = explode('^', $action)[0];
		if(isset($request->ref_noDelete) || isset($request->ref_noResolve) || isset($request->ref_no_new_new) || isset($request->refno)){
			$table = strtolower($request->type) == 'complaints' ? 'complaints_form' : 'req_ast_form';
			switch ($x_action) {
				case 'delete':
					// OthersController::save_to_log($request->ref_noDelete, $table, $x_action);
					OthersController::save_to_log($request->ref_noDelete, $table, $x_action);
					if(DB::table($table)->where('ref_no',$request->ref_noDelete)->update(["deleted"=>true])){
					// if(DB::table($table)->where('ref_no',$request->ref_noDelete)->delete()){
						
						return back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Deleted Successfully.']);
					}
					break;

				case 'resolve':
					// OthersController::save_to_log($request->ref_noResolve, $table, $x_action);
					if(DB::table($table)->where('ref_no',$request->ref_noResolve)->update(['isResolved' => 1, 'resolveuid' => session()->get('employee_login')->uid, 'resolveDate' => date("Y-m-d H:i:s",strtotime('now')), 'resolveIP' => $request->ip()])){
						OthersController::save_to_log($request->ref_noResolve, $table, $x_action);
						return back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Action completed Successfully. ']);
					}
				
					break;

				case 'edit':
				try {
					OthersController::surv_sub_editRegFac($request, explode('^', $action)[1], $request->ref_noResolve, $request->type);//6-24-2021
					// OthersController::surv_sub_edit($request, explode('^', $action)[1], $request->ref_noResolve, $request->type);
					return back();
				} catch (Exception $e) {
					return back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'']);
				}
					
					break;

				case 'actions':
				try{
					// dd($request->all());
					OthersController::surv_sub_actions($request->refno, $table, $x_action, $request);
					return back();
				} catch (Exception $e) {
					dd($e);
				}
					break;

				default:
					# code...
					break;
			}
		}
		return back()->with('errRet', ['errAlt'=>'error', 'errMsg'=>'Unknown error occured. Please try again later.']);
	}

	public static function getHistoryLogs(Request $r)
	{
		try {
			// $table = ($r->type == "Complaints")?"complaints_form":"req_ast_form";
			$data = DB::table('roacomplaintlog')->where('type', $r->type)->where('ref_no', $r->ref_no)->get();
			$data1 = AjaxController::getAllRequestForAssistance();
			$data2 = AjaxController::getAllComplaints();

			for($i=0; $i<count($data); $i++) {
				$rtemp = explode(', ', $data[$i]->reqs);
				$ctemp = explode(', ', $data[$i]->comps);

				$data[$i]->x_reqs = rtrim($data[$i]->reqs, ', ');
				$data[$i]->x_comps = rtrim($data[$i]->comps, ', ');

				for($j=0; $j<count($rtemp); $j++) {
					for($k=0; $k<count($data1); $k++) {
						if($rtemp[$j] == $data1[$k]->rq_id) {
							$rtemp[$j] = $data1[$k]->rq_desc;
						}
					}
				}

				for($j=0; $j<count($ctemp); $j++) {
					for($k=0; $k<count($data2); $k++) {
						if($ctemp[$j] == $data2[$k]->cmp_id) {
							$ctemp[$j] = $data2[$k]->cmp_desc;
						}
					}
				}
				$rtemp = implode(', ', $rtemp);
				$ctemp = implode(', ', $ctemp);
				$data[$i]->reqs = $rtemp;
				$data[$i]->comps = $ctemp;
			}

			return $data;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}


	public static function getFacilityAddress($appid){
		if(isset($appid) && !empty($appid) && FunctionsClientController::existOnDB('appform',[['appid',$appid]])){
			$appData = DB::table('appform')
			->leftJoin('barangay', 'appform.brgyid', '=' , 'barangay.brgyid')
			->leftJoin('city_muni', 'appform.cmid', '=', 'city_muni.cmid')
			->leftJoin('region', 'appform.rgnid', '=', 'region.rgnid')
			->leftJoin('province', 'appform.provid', '=', 'province.provid')
			->where('appid',$appid)
			->first();
			return trim(ucwords($appData->street_number . ' ' . $appData->street_name . ' ' . $appData->brgyname . ' ' . $appData->provname . ' ' . $appData->cmname)); 
		}
	}

	public static function translateOperator($var1, $op, $var2){
		switch ($op) {
	        case "==":  return $var1 == $var2;
	        case "!=": return $var1 != $var2;
	        case ">=": return $var1 >= $var2;
	        case "<=": return $var1 <= $var2;
	        case ">":  return $var1 >  $var2;
	        case "<":  return $var1 <  $var2;
	        case "in_array":  return in_array($var1, $var2);
	    default:       return false;
	    }   
	}

	public static function filterApplicantData($data, $arrFilter){
		$arrToReturn = [];
		

		foreach ($data as $key => $value) {
			$arrResetEveryTurn = [];
			// dd($value);

			foreach ($arrFilter as $keyArr => $valueArr) {
				$object = $valueArr[0];
				array_push($arrResetEveryTurn, self::translateOperator($value->$object,$valueArr[1],$valueArr[2]) );
			}

			if(!in_array(false, $arrResetEveryTurn)){
				array_push($arrToReturn, $value);
			}
		}

		foreach ($arrToReturn as $key => $value) {

			if(session()->get('employee_login')->uid != 'ADMIN'){
				$members = AjaxController::getAssignedMembersInTeamChecker($value);

				if(is_null($members)){
					unset($arrToReturn[$key]);
				} 

				$ids = array();
				foreach ($members as $mkey => $mvalue) {
					$ids[] = $mvalue->uid;
				}

				if(!in_array(session()->get('employee_login')->uid, $ids)){
					unset($arrToReturn[$key]);
				}
			}
			if(!in_array($value->trns_desc, array('On Process', 'For Final Recommendation'))){
				unset($arrToReturn[$key]);
			}
		}

		
		return json_decode(json_encode($arrToReturn));
	}


	public static function nhfrFunctions($appid){
		if(isset($appid) && !empty($appid) && FunctionsClientController::isExistonDB('appform',[['appid',$appid]])){
			$appData = DB::table('appform')->where('appid',$appid)->first();
			$areaCode = json_decode($appData->areacode);
			/* initialize the soapclient class */
			$server = new SoapClient('http://192.168.137.170/nhfr/webservice/index.php?wsdl'); 
			/* Initialize the parameters needed in a form of an array */
			$submittedparam = array(
			"username" => 'RO1', //un and password are not given
			"password" => 'RO1',
			"SPEED_Code" => '',
			"PhilHealth_Code" => '',
			"LTO_Code" => $appData->licenseNo,
			"hfhudname" => $appData->facilityname,
			"factype" => (self::getFacilitytypeFromHighestApplicationFromX08FT($appid)->hgpid ?? null),
			"ownercode" => ($appData->ocid == 'P' ? 'PR' : 'GO'),
			"OSC_Government" => $appData->classid,
			"OSC_Private" => $appData->classid,
			"fhudaddress" => self::getFacilityAddress($appid),
			"hfhbldgname" => '',
			"regcode" => $appData->rgnid,
			"provcode" => $appData->provid,
			"ctymuncode" => $appData->cmid,
			"bgycode" => $appData->brgyid,
			"zipcode" => $appData->zipcode,
			"fhudtelno1" => $appData->areacode[0] . '' . $appData->landline,
			"fhudtelno2" => '',
			"mobile_number" => $appData->contact,
			"mobile_number2" => '',
			"fhudfaxno" => $appData->areacode[1] . '' . $appData->faxnumber,
			"fhudemail" => $appData->email,
			"fhudemail_2" => '',
			"fhudwebsite" => '',
			"head_lname" => '', //left blank, ask for full name and cannot be parsed
			"head_fname" => '',
			"head_mname" => '',
			"fhudheadpos" => '',
			"north_coord" => '', // coords not set
			"east_coord" => '',
			"servcapcode" => 'qweqweqw',
			"bedcap" => $appData->noofbed,
			"comments" => '');
			header('Content-Type: text/xml');
			/* call the function with the array as parameter */
			$returnFromNhfr = $server->addfacility($submittedparam);

			if(isset($returnFromNhfr) && substr($returnFromNhfr, 0, 5) == "<?xml"){
				return simplexml_load_string($returnFromNhfr);
			}
		}
		return null;
	}

	public static function transferRegion($currentAssigned, $toWhere, $appid){
		$toUpdate = [
			'fromwhere' => strtolower($currentAssigned),
			'towhere' => strtolower($toWhere),
			'uid' => session()->get('employee_login')->uid,
			'original' => (DB::table('regiontransfer')->where('appid',$appid)->exists() ? FALSE : TRUE),
			'appid' => $appid
		];
		DB::table('regiontransfer')->insert($toUpdate);
		if(DB::table('appform')->where('appid',$appid)->update(['assignedRgn' => strtolower($toWhere)])){
			return true;
		}
		return false;
	}

	public static function createDataForInspection(Request $request,$appid,$revision,$h3,$uid = null, $agent){
		$isMon = $isSelfAssess = false;
		if(isset($appid) && isset($revision) && in_array(true, AjaxController::isSessionExist(['employee_login'])) && FunctionsClientController::isExistOnAppform($appid) && FunctionsClientController::existOnDB('asmt_title',[['title_code',$h3]]) && !FunctionsClientController::existOnDB('assessmentcombinedduplicateptc',[['partID',$h3],['appid',$appid],['evaluatedBy',session()->get('employee_login')->uid],['revision',$revision]])){
			try {
				$arrH3ID = array();
				$remarks = null;
				$data = AjaxController::getAllDataEvaluateOne($appid);
				$whereClause = array(['assessmentcombined.assessmentStatus',1],['appform.appid',$appid],['asmt_h1.apptype',$data->hfser_id],['asmt_title.title_code',$h3]);
				$toSelect = array('assessmentcombined.asmtComb as id','assessmentcombined.assessmentName as description','assessmentcombined.asmtH3ID_FK as h3Header','assessmentcombined.headingText as otherHeading', 'assessmentcombined.assessmentSeq as sequence','asmt_h3.asmtH2ID_FK as idForBack','asmt_title.title_name as h1HeadBack','asmt_title.title_code as h1HeadID','asmt_h1.h1name as h2HeadBack','asmt_h1.partID as h2HeadID','asmt_h2.h2name as h3HeadBack','asmt_h2.asmtH2ID as h3HeadID','asmt_h3.h3name as h4HeadBack','asmt_h3.asmtH3ID as h4HeadID', 'asmt_h1.asmtH1ID as h1idReal', 'asmt_h2.asmtH2ID as h2idReal', 'asmt_h3.asmtH3ID as h3idReal', 'assessmentcombined.subFor', 'assessmentcombined.isAlign', 'asmt_title.title_code as partidReal', 'asmt_h2.isdisplay');
				$headData = AjaxController::forAssessmentHeaders($whereClause,$toSelect,2);
				if (isset($uid)){
					foreach ($headData as $key => $value) {
						$fromDB = DB::table('assessmentcombinedduplicateptc')->select('evaluation','remarks')->where([['evaluatedBy',$uid],['appid',$appid],['asmtComb_FK',$value->id],['revision',$revision]])->first();
						if(isset($fromDB->evaluation) && $fromDB->evaluation != null){
							$arrH3ID[$value->id]['evaluation'] = ($fromDB->evaluation ?? null);
							$arrH3ID[$value->id]['remarks'] = ($fromDB->remarks ?? null);
						}
					}
					$remarks = DB::table('assessmentrecommendation')->where([['appid',$appid],['choice','comment'],['evaluatedby',$uid]])->first();
				}
				// $lvl1Check = $lvl2Check = $arrLvl1Data = $arrLvl2Data = array();
				// foreach ($headData as $key => $value) {
				// 	if(!in_array($value->h1idReal, $lvl1Check)){
				// 		array_push($lvl1Check, $value->h1idReal);
				// 	}
				// 	$arrLvl1Data[$value->h1idReal][] = $value;
				// }
				// foreach ($arrLvl1Data as $keysOfLvl1 => $lvl1Data) {
				// 	foreach ($lvl1Data as $insideData) {
				// 		if(!in_array($insideData->h2idReal, $lvl2Check)){
				// 			array_push($lvl2Check, $insideData->h2idReal);
				// 		}
				// 		$arrLvl2Data[$insideData->h2idReal] = $lvl1Data;
				// 	}
				// }

				// dd($arrLvl1Data,$arrLvl2Data);
				$getFacType = DB::table('appform')
				->join('hfaci_grp', 'appform.hgpid','=', 'hfaci_grp.hgpid')
				->select('hfaci_grp.hgpdesc')
				->where([['appid', $appid]])->first()->hgpdesc;


				$toViewArr = [
					'data' => $data,
					'getFacType' => $getFacType,
					'ptcTable' => DB::table('ptc')->where('appid',$appid)->first(),
					'head' => $headData,
					'address' => url('employee/dashboard/processflow/HeaderThree/'.$appid.'/'),
					'part' => $headData[0]->h4HeadID ?? null,
					'isMon' => $isMon,
					'toSaveUrl' => url('employee/dashboard/processflow/floorPlan/SaveAssessments/'.$revision.'/'.($uid ?? '')),
					'crumb' => (isset($headData[0]) ? [array('id' => $headData[0]->h1HeadID,'desc' => $headData[0]->h1HeadBack, 'beforeAddress' => 'MAIN')/*,array('id' => $headData[0]->h2HeadID,'desc' => $headData[0]->h2HeadBack, 'beforeAddress' => 'HeaderOne'),array('id' => $headData[0]->h3HeadID,'desc' => $headData[0]->h3HeadBack,'beforeAddress' => 'HeaderTwo') ,array('id' => $headData[0]->idForBack,'desc' => $headData[0]->h4HeadBack,'beforeAddress' => 'HeaderThree')*/] : []),
					'evalFromOthers' => $arrH3ID,
					'commentsFromOthers' => $remarks,
					'isOtherUid' => $uid,
					'revision' => $revision,
					'isPtc' => true
				];
				return self::sendTo($isSelfAssess,$agent,$request->all(),'employee.processflow.pfassessmentShowAssessmentPTC',$toViewArr);
			} catch (Exception $e) {
				return $e;
			}

		} else {
			return ($isSelfAssess ? false  : redirect('employee/dashboard/processflow/floorPlan/parts/'.$appid.'/'.$revision)->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Sub Category does not exist or has been assessed.']));
		}
	
	}

	public static function listForMonitoringAssessment(Request $request){
        
        if(isset($request->uid)) {
		    self::createMobileSessionIfMobile($request);
        }
        
		if(in_array(true, AjaxController::isSessionExist(['employee_login']))){
			// 6-21-2021
			// $allDataSql = (session()->get("employee_login")->uid == 'ADMIN' ? "SELECT * FROM mon_form join appform on appform.appid = mon_form.appid join mon_team on mon_team.montid = mon_form.team WHERE team IS NOT NULL" : "SELECT mon_form.type_of_faci, mon_form.date_added, mon_form.novid, mon_team_members.uid ,monid, date_monitoring, date_monitoring_end, name_of_faci, isApproved, isFinePaid, recommendation, assessmentStatus, team, mon_form.appid, name_of_faci FROM mon_form join appform on appform.appid = mon_form.appid join mon_team on mon_team.montid = mon_form.team join mon_team_members on mon_team_members.montid = mon_form.team WHERE team IS NOT NULL and mon_team_members.uid = '".session()->get('employee_login')->uid."'");
			$allDataSql = (session()->get("employee_login")->uid == 'ADMIN' ? 
			"SELECT * FROM mon_form
			 join registered_facility on registered_facility.regfac_id = mon_form.regfac_id 
			 join mon_team on mon_team.montid = mon_form.team WHERE team IS NOT NULL" 
			 : 
			 "SELECT DISTINCT mon_form.type_of_faci,
			  mon_form.date_added, 
			  mon_form.novid, 
			  mon_team_members.uid ,
			  monid, 
			  date_monitoring,
			  date_monitoring_end, 
			  name_of_faci, 
			  isApproved, 
			  isFinePaid, 
			  recommendation, 
			  assessmentStatus, 
			  team, 
			  mon_form.appid, 
			  name_of_faci,
			  status,
			  registered_facility.regfac_id 
			  
			  FROM mon_form 
			  
			  join registered_facility on registered_facility.regfac_id = mon_form.regfac_id 
			  join mon_team on mon_team.montid = mon_form.team 
			  join mon_team_members on mon_team_members.montid = mon_form.team
			  
			 WHERE team IS NOT NULL and mon_team_members.uid = '".session()->get('employee_login')->uid."'  ");
		
			return DB::select($allDataSql);
		}
		return 'no data';
	}

	public static function listForMonitoringAssessmentNew(Request $request){
        
        if(isset($request->uid)) {
		    self::createMobileSessionIfMobile($request);
        }
        
		if(in_array(true, AjaxController::isSessionExist(['employee_login']))){
			// 6-21-2021
			// $allDataSql = (session()->get("employee_login")->uid == 'ADMIN' ? "SELECT * FROM mon_form join appform on appform.appid = mon_form.appid join mon_team on mon_team.montid = mon_form.team WHERE team IS NOT NULL" : "SELECT mon_form.type_of_faci, mon_form.date_added, mon_form.novid, mon_team_members.uid ,monid, date_monitoring, date_monitoring_end, name_of_faci, isApproved, isFinePaid, recommendation, assessmentStatus, team, mon_form.appid, name_of_faci FROM mon_form join appform on appform.appid = mon_form.appid join mon_team on mon_team.montid = mon_form.team join mon_team_members on mon_team_members.montid = mon_form.team WHERE team IS NOT NULL and mon_team_members.uid = '".session()->get('employee_login')->uid."'");
			/*$allDataSql = (session()->get("employee_login")->uid == 'ADMIN' ? 
			"SELECT * FROM mon_form
			 join registered_facility on registered_facility.regfac_id = mon_form.regfac_id 
			 join mon_team on mon_team.montid = mon_form.team WHERE team IS NOT NULL and status = 'MFM'" 
			 : 
			 "SELECT DISTINCT mon_form.type_of_faci,
			  mon_form.date_added, 
			  mon_form.novid, 
			  mon_team_members.uid ,
			  monid, 
			  date_monitoring,
			  date_monitoring_end, 
			  name_of_faci, 
			  isApproved, 
			  isFinePaid, 
			  recommendation, 
			  assessmentStatus, 
			  team, 
			  mon_form.appid, 
			  name_of_faci,
			  status,
			  registered_facility.regfac_id 
			  
			  FROM mon_form 
			  
			  join registered_facility on registered_facility.regfac_id = mon_form.regfac_id 
			  join mon_team on mon_team.montid = mon_form.team 
			  join mon_team_members on mon_team_members.montid = mon_form.team
			  
			 WHERE team IS NOT NULL and status = 'MFM' and mon_team_members.uid = '".session()->get('employee_login')->uid."'  ");*/
			 $allDataSql = (session()->get("employee_login")->uid == 'ADMIN' ?
			 "SELECT DISTINCT mon_form.type_of_faci, mon_form.date_added, mon_form.novid, mon_team_members.uid , monid, date_monitoring, date_monitoring_end, name_of_faci, mon_form.isApproved, isFinePaid, recommendation,  assessmentStatus, team, mon_form.appid,  name_of_faci, status, registered_facility.regfac_id, trans_status.trns_desc			 
			 FROM mon_form 			  
			 join registered_facility on registered_facility.regfac_id = mon_form.regfac_id 
			 join mon_team on mon_team.montid = mon_form.team 
			 join mon_team_members on mon_team_members.montid = mon_form.team
			 LEFT JOIN trans_status ON mon_form.status=trans_status.trns_id
			 WHERE team IS NOT NULL and status = 'MFM'  "
			 : 
			 "SELECT DISTINCT mon_form.type_of_faci, mon_form.date_added, mon_form.novid, mon_team_members.uid , monid, date_monitoring, date_monitoring_end, name_of_faci, mon_form.isApproved, isFinePaid, recommendation,  assessmentStatus, team, mon_form.appid,  name_of_faci, status, registered_facility.regfac_id, trans_status.trns_desc			 
			 FROM mon_form 			  
			 join registered_facility on registered_facility.regfac_id = mon_form.regfac_id 
			 join mon_team on mon_team.montid = mon_form.team 
			 join mon_team_members on mon_team_members.montid = mon_form.team
			 LEFT JOIN trans_status ON mon_form.status=trans_status.trns_id
			 WHERE team IS NOT NULL and status = 'MFM' and mon_team_members.uid = '".session()->get('employee_login')->uid."'  ");

		
			return DB::select($allDataSql);
		}
		return 'no data';
	}

	public static function listsofapproved(array $list, string $selected, string $default){
		return (in_array($selected, $list) ? $selected : $default);
	}
	public static function convertObjectToRequestClass($object){
    	$toReturn = null;
    	if(isset($object)){
    		$toReturn = new \Illuminate\Http\Request($object);
    		foreach ($object as $key => $value) {
    			$toReturn[$key] = $value;
    		}
    	}
    	return $toReturn;
    }

	public static function get_archiveloc()
	{
		$archive_loc = null;	
		$employeeData = session('employee_login');

		$data = DB::table('branch')->select('archive_loc')->where('regionid',$employeeData->rgnid)->first();
		$archive_loc = ($data->archive_loc ?? null);

		return str_replace("\\\\", "\\", $archive_loc);
	}

} // end of class