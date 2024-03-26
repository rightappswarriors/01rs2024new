<?php 
namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	use Illuminate\Support\Facades\Schema;
	use Carbon\Carbon;
	use Illuminate\Support\Str;
	use Mail;
	use Exception;
	use Hash;
	use Storage;
	use Session;
	use DateTime;
	use DateTimeZone;
	use AjaxController;
	// syrel added
	use Cache;
	class DOHController extends Controller
	{

		///////////////////////////////////////////////// GENERAL
		public function login(Request $request) // Login 
		{ 
			if ($request->isMethod('get')) 
			{
				return view('employee.login');
			}
			else if($request->isMethod('post'))
			{
				try 
				{
					$uname = strtoupper($request->uname);
					$pass= $request->pass;
					$m99Settings = AjaxController::getAllSettings();
					$data = DB::table('x08')->where([ ['uid', '=', $uname], ['grpid', '!=', 'C'] ])->select('*')->first();
					if ($data)  // Verifiy USERNAME
					{
						$chck = Hash::check($pass, $data->pwd);
						if ($chck) // Verify PASSWORD
						{
							if ($data->isBanned != 1) // CHECK IF PERMANENTLY BANNED FROM THE SYSTEM
							{
								// $lastTried = Carbon::parse($data->lastTry);
								$now = Carbon::now();
								$tempBanned = ((isset($_checkUser->isTempBanned)) ? Carbon::parse($_checkUser->isTempBanned) : ((isset($_checkUser->lastTry)) ? Carbon::parse($_checkUser->lastTry)->addMinutes($m99->pass_min) : Carbon::now()));
								$CheckTempBanned = $now->greaterThanOrEqualTo($tempBanned);
								// return dd($CheckTempBanned); // !isset($data->isTempBanned) && (
								if ($CheckTempBanned == true)  // CHECK if TEMPORARILY BANNED FROM THE SYSTEM
								{
									if ($data->token == '') // CHECK ACCOUNT if VERIFIED
									{
										if ($data->isActive == 1) // CHECK ACCOUNT if ACTIVE
										{
											$test = DB::table('x08')->where('uid', '=', $data->uid)->update(['tries'=> 0]);
											$employeeData =	DB::table('x08')
				                                ->join('region', 'x08.rgnid', '=', 'region.rgnid')
				                                ->join('x07', 'x08.grpid', '=', 'x07.grp_id')
				                                ->select('x08.*', 'region.rgn_desc', 'x07.grp_desc')
				                                ->where('x08.uid', '=', $data->uid)
				                                ->first();
				                            $x = $employeeData->mname;
						                    if ($x != "") 
						                    {
						                    	$mid = strtoupper($x[0]);
						                    	$mid = $mid.'. ';
						                    } 
						                    else 
						                    {
						                    	$mid = ' ';
						                    }
						                    $rights = DB::table('x06')
						                    			->where('grp_id', '=', $employeeData->grpid)
						                    			->get();
						                    $name = $employeeData->fname.' '.$mid.''.$employeeData->lname;
						                    $employeeData->name = $name;
						                    session()->put('employee_right', $rights);
						                    session()->put('employee_login',$employeeData);
						                    return redirect()->route('eDashboard');
										}
										else // ACCOUNT DEACTIVATED 
										{
											session()->flash('dohUser_login','Account Deactivated, Contact nearest Regional Administrator/National Administrator.');
					                		return back();
										}
									} 
									else // ACCOUNT NOT VERIFIED
									{
										session()->flash('unverified',$data->uid);
		                				return back();
									}
								}
								else // ACCOUNT TEMPORARILY BANNED
								{
									$chec = $tempBanned->diffForHumans($now);
									// return dd($CheckTempBanned);
									session()->flash('dohUser_login','This account is temporarily banned from  logging in the system due to multiple login attemps. Try again '. $chec.'.');
						            return back();
								}
							}
							else // ACCOUNT PERMANENTLY BANNED
							{
								session()->flash('dohUser_login','This account is permanently banned from  logging in the system.');
					            return back();
							}
						}
						else // WRONG PASSWORD
						{
														
      						$getNumTries = DB::table('x08')->where('uid', '=', $data->uid)
       								->select('uid', 'isTempBanned', 'isBanned', 'tries', 'lastTry')
       								->first();

       						if (isset($getNumTries->lastTry) && ($getNumTries->tries > 0)) {
       							$LastCarbon = Carbon::parse($getNumTries->lastTry);
       							$nextDay = $LastCarbon->addDays(1);
       							$now = Carbon::now();
       							$test = $now->greaterThanOrEqualTo($lastTry);
       							if ($test == false) { // 
       								$LeUpdate = DB::table('x08')->where('uid', '=', $data->uid)->update(['tries'=> 0, 'lastTry' => null, 'isTempBanned' => null]);
       								$getNumTries = DB::table('x08')->where('uid', '=', $data->uid)
       								->select('uid', 'isTempBanned', 'isBanned', 'tries', 'lastTry')
       								->first();
       							} 
       						}	
       						// Add Number of Tries
       						$newNumTries = $getNumTries->tries + 1;
							if (($m99Settings->pass_temp > $newNumTries) && ($m99Settings->pass_ban > $newNumTries)) {
								$updateTries = DB::table('x08')->where('uid', '=', $data->uid)->update(['tries'=> $newNumTries, 'lastTry' => Carbon::now()]);
								session()->flash('dohUser_login','Login Failed! Invalid Username/Password, Login Tries = '.$newNumTries);
								
							} else if (($m99Settings->pass_temp == $newNumTries) && ($m99Settings->pass_ban > $newNumTries)) {
								$TimeNow = Carbon::now();
								$TempBan = $TimeNow->addMinutes($m99Settings->pass_min);
								$updateTries = DB::table('x08')->where('uid', '=', $data->uid)->update(['tries'=> $newNumTries, 'isTempBanned' => $TempBan, 'lastTry' => Carbon::now()]);	
								session()->flash('dohUser_login','Login Failed! Invalid Username/Password, Login Tries = '.$newNumTries. ', You have reached the minimum retries, account will be temporarily banned for '.$m99Settings->pass_min. ' minutes.' );
							} else if (($m99Settings->pass_temp < $newNumTries) && ($m99Settings->pass_ban > $newNumTries)) {
								$updateTries = DB::table('x08')->where('uid', '=', $data->uid)->update(['tries'=> $newNumTries, 'lastTry' => Carbon::now()]);
								session()->flash('dohUser_login','Login Failed! Invalid Username/Password, Login Tries = '.$newNumTries.', You already exceeded the minimum retries, account may be permanently ban.');
							} else if (($m99Settings->pass_temp < $newNumTries) && ($m99Settings->pass_ban <= $newNumTries))  {
								session()->flash('dohUser_login',' Login Failed! You have reached the maximum retries , account banned from entering the system.');
								$updateTries = DB::table('x08')->where('uid', '=', $data->uid)->update(['tries'=> $newNumTries, 'isTempBanned' => null, 'isBanned' => 1, 'lastTry' => Carbon::now()]);
							} 
							return back();
       						// Add Number of Tries

							// session()->flash('dohUser_login','Invalid Username/Password');
       						// return back();
                			// Check Tries
                			// $m99Settings // Settings
                			// $test = Carbon::now();
                			// $test2 = $test->addMinutes(30);	
						}
					}
					else // UNKNOWN USERNAME
					{
						session()->flash('dohUser_login','Invalid Username/Password');
                		return back();
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return back();
				}
			}
		}
		public function logout(Request $request) // Logout
		{
			// if ($request->isMethod('post')) 
			// {
				try 
				{
					Session::forget('employee_login');
		      		session()->flash('dohUser_logout','Successfully Logout');
					return redirect()->route('employee');
				} 
				catch (Exception $e) {
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return redirect()->route('employee');
				}
			// }
			// else if ($request->isMethod('get')) {
			// 	try 
			// 	{
			// 		return redirect()->route('employee');
			// 	} 
			// 	catch (Exception $e) 
			// 	{
			// 		AjaxController::SystemLogs($e);
			// 		session()->flash('system_error','ERROR');
			// 		return redirect()->route('employee');
			// 	}
			// }
		} 
		public function forgotPassword(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.forgotpassword');
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return back();
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					//$request->uname; Email
					$checkEmail = DB::table('x08')->where('email', '=', $request->email)->first();
					if (!$checkEmail) 
					{
						return 'NOACCOUNT';
					} 
					else 
					{
						$nToken = Str::random(40);
						DB::table('x08')->where('uid', '=', $checkEmail->uid)->update(['token'=>$nToken]);
						$dataToBeSend = array('token'=>$nToken);
						Mail::send('mail4ForgotPassword', $dataToBeSend, function($message) use ($request) 
						{
							$message->to($request->email, 'User')->subject('Password Recovery Request');
							$message->from('doholrs@gmail.com','DOH Support');
						});
						return 'DONE';
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return back();
				}
			}
		}
		public function forgotChangePassword(Request $request, $token)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::checkTokenforChangePassword($token);
					if (isset($data)) {
						// return dd($data->uid);
						return view('employee.forgotChangePass', ['uid'=>$data->uid]);
					} else {
						session()->flash('dohUser_login','Token unavailable.');
						return redirect()->route('employee');

					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return redirect()->route('employee');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					//Hash::make($request->pass);
					$hashedPass = Hash::make($request->pass);
					// 
					// $oldPass = DB::table('x08')->where('uid', '=', $request->uid)->select('pwd')->first();
					// return $oldPass->pwd;
					$upd = array('pwd' => $hashedPass, 'token' => null); // 
					$data = DB::table('x08')->where('uid', '=', $request->uid)->update($upd);
					if ($data) {
						return 'DONE';
					} else {
						return 'ERROR';
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		public function dashboard(Request $request) // Dashboard
		{
			$countData = $decodedData = $countDecodedData  = null;
			$arrayKeys = $subDesc = array();
			try 
			{	
				$Cur_data = AjaxController::getCurrentUserAllData();
				$data = AjaxController::getAllApplicants($Cur_data['grpid']);
				$dataJson = json_decode($data, true);
				$allID = array();
				foreach ($data as $key) {
					$curAppid = $key->appid;
					array_push($allID, [DB::select("SELECT hgpdesc FROM hfaci_grp WHERE hgpid IN (SELECT hgpid FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE appid = '$curAppid') GROUP BY hgpid)"), DB::select("SELECT facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE appid = '$curAppid')")]);
				}
				// dd($data);
				return view('employee.dashboard', ['BigData'=> $data, 'grpid' => $Cur_data['grpid'], 'subdesc' => $allID ]);
			} 
			catch (Exception $e) 
			{
				dd($e);
				// return $e->getMessage();
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.dashboard');
			}
		}
		public function resend_ver(Request $request, $id) // Resend Verification Code
		{
			try 
			{
				$data = DB::table('x08')->where('uid', '=', $id)->first();
				if ($data) // Check if user is registered
				{
					$name = AjaxController::NameSorter($data->fname, $data->fname, $data->lname);
					$dataToBeSend = array('name'=>$name, 'token'=>$data->token);
					try 
					{
						Mail::send('mail4SystemUsers', $dataToBeSend, function($message) use ($data) 
						{
							$message->to($data->email, $data->facilityname)->subject('Verify Email Account');
							$message->from('doholrs@gmail.com','DOH Support');
						});
						session()->flash('dohUser_logout','Successfully resend email, please check your email to verify your account.');
				      	return redirect()->route('employee');
					} 
					catch (Exception $e) // Error in Sending the Email
					{
						AjaxController::SystemLogs($e);
						session()->flash('dohUser_login','An error occured during resending the email, please contact the system administrator.');
			    		return redirect()->route('employee');	
					}
				} 
				else // Return an error if user is not registered
				{
					session()->flash('dohUser_login','An error occured during resending the email, please contact the system administrator.');
			    	return redirect()->route('employee');	
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('dohUser_login','An error occured during resending the email, please contact the system administrator.');
			    return redirect()->route('employee');	
			}
		}
		public function verify_account(Request $request, $id) // Verify Account
		{
			try 
			{
				$updateData = array('token'=>NULL);
				$table = DB::table("x08")->where("token", "=", $id)->update($updateData);
				if ($table) // Check if x08 is Updated
				{
					session()->flash('dohUser_logout','Successfully verified account');
			        return redirect()->route('employee');
				}
				else // No data is Updated
				{
					AjaxController::SystemLogs("No data has been updated in x08 table upon verifying its account.");
			        session()->flash('dohUser_login',"Account not verified! Error on verifying account. Account may have been verified or email doesn't exists");
			        return redirect()->route('employee');
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('dohUser_login','Account not verified! Error on verifying account. Account may have been verified or email doesnt exists');
			    return redirect()->route('employee');
			}
		}
		public function Notification(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllNotifications();
					// return dd($data);
					return view('employee.others.Notification', ['AllData'=> $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.others.Notification');
				}
			}
		}
		public function getGroupRights(Request $request)
		{
			try 
			{
				$grpid = session()->get('employee_login');
				$rights = DB::table('x06')
	    			->where('grp_id', '=', $grpid->grpid)
	    			->select('mod_id','allow','ad_d','upd','cancel', 'print','view')
	    			->get();
				return response()->json($rights);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				return null;
			}
		}
		///////////////////////////////////////////////// GENERAL
		///////////////////////////////////////////////// MASTER FILE
		////// TEAM
		public function MfTeam(Request $request) // Master File - Team
		{ 
			// dd(Cache::get('mods'));
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllRegion();
					$data2 = AjaxController::getAllTeams();
					return view('employee.masterfile.mfTeam', ['region' => $data, 'team' =>$data2]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfTeam');
				}
			}
			else if($request->isMethod('post')) // Add new Team
			{
				try 
				{
					DB::table('team')->insert(['teamid' => $request->id, 'teamdesc' => $request->name, 'rgnid' => $request->rgn]);
					return 'DONE';
				} 
				catch (Exception $e) {
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// TEAM
		////// MANAGE TEAM
		public function MfManageTeam(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllRegion();
					return view('employee.masterfile.mfManageTeams', ['regions' => $data]); 
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfManageTeams'); 
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$data = array('team' => $request->team);
					$test = DB::table('x08')->where('uid', '=', $request->id)->update($data);
					if ($test) {return 'DONE';}
					else
					{
						AjaxController::SystemLogs('No data has been updated in x08 table. (MfManageTeam)');
						return 'ERROR';
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// MANAGE TEAM
		////// APPLICATION TYPE
		public function AppType(Request $request) // Master File - Application Type
		{
			if ($request->isMethod('get')) 
			{
				try 
				{	
					$data = AjaxController::getAllApplicationType();
					// return dd($data);
					return view('employee.masterfile.mfApplicationType', ['hfstypes'=>$data]);	
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfApplicationType');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('hfaci_serv_type')->insert(['hfser_id' => $request->id, 'hfser_desc' => $request->name, 'seq_num' => $request->seq, 'terms_condi'=>$request->terms]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// APPLICATION TYPE
		////// APPLICATION STATUS
		public function AppStatus(Request $request) // Master File - Application Status
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllApplicationStatus();
					$data1 = AjaxController::getApplicationStatusWithoutRequired();
					$data2 = AjaxController::getApplicationStatusWithoutIsUpdate();
					// return dd($data);
					return view('employee.masterfile.mfApplicationStatus', ['apptype'=>$data, 'Stat' => $data1, 'isUpdate' => $data2]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfApplicationStatus');
				}
			}
			if ($request->isMethod('post')) 
			{ 
				try 
				{
					// HALA ANG ERROR, Palihug ko FIX PLEASE
					$test = DB::table('apptype')->where('aptid', '=', $request->id)->get();
					$NewSeq = 0;
					if (count($test) == 0) { // Check if the Same
						
						if (isset($request->upd)) {
							$test3 = DB::table('apptype')->where('aptid', '=', $request->upd)->first();
							if (isset($test3->apt_seq)) {
								$test4 =  explode('.', $test3->apt_seq);
								if(count($test4) > 1){
									$NewSeq = $test3->apt_seq + 0.1;
								} else {
									$NewSeq1 = $test3->apt_seq + 0.1;
									$NewSeq = $NewSeq1 + 0.1;
									$update = array('apt_seq' => $NewSeq1);
									$test5 = DB::table('apptype')->where('aptid',$test3->aptid)->update($update);
								}
							} 
							
						} else {
							$test2 = DB::table('apptype')->orderBy('apt_seq', 'desc')->first();
							// $NewSeq $test->
							if (isset($test2->apt_seq)) {
								$test5 =  explode('.', $test2->apt_seq);
								$NewSeq =  $test5[0] + 1;
							} else {
								$NewSeq = 1;
							}
							
						}
						// return $NewSeq;
						DB::table('apptype')->insert(['aptid' => $request->id, 'aptdesc' => $request->name, 'apt_reqid' => $request->req, 'apt_isUpdateTo' => $request->upd, 'apt_seq'=>$NewSeq]);
						return "DONE";
					} else {
						return 'SAME';
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// APPLICATION STATUS
		////// CLASS
		public function Class(Request $request) // Master File - Class
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$ownership = AjaxController::getAllOwnership();
					$class = AjaxController::getAllClass();
					// return dd($class);
					return view('employee.masterfile.mfClass', ['own'=> $ownership, 'class'=> $class]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfClass');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$iSREMARKS = ($request->isRemarks == 1) ? $request->cls : null;

					DB::table('class')->insert(['classid' => $request->id, 'classname'=> $request->name, 'ocid' => $request->ocid, 'isSub'=> $iSREMARKS]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';		
				}
			}
		}
		////// CLASS
		////// HOLIDAYS
		public function Holidays(Request $request) // Master File - Holidays
		{
			if ($request->isMethod('get')) {
				try 
				{
					$data = AjaxController::getAllHolidays();
					return view('employee.masterfile.mfHolidays', ['holidays' => $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfHolidays');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$Cur_useData = AjaxController::getCurrentUserAllData();
					$rgn = ($Cur_useData['grpid'] == 'NA') ?  null : $Cur_useData['rgnid'];
					$test = DB::table('holidays')->insert([
							'hdy_id' => $request->code,
							'hdy_date' => $request->dat,
							'hdy_typ' => $request->typ,
							'hdy_desc' => $request->desc,
							'rgnid' => $rgn,
							't_time' => $Cur_useData['time'],
							't_date' => $Cur_useData['date'],
							't_ip' => $Cur_useData['ip'],
							't_added' => $Cur_useData['cur_user'],
						]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// HOLIDAYS
		////// OWNERSHIP
		public function Ownership(Request $request) 
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$ownership = AjaxController::getAllOwnership();;
					return view('employee.masterfile.mfOwnership', ['oShip' => $ownership]);
				}
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfOwnership');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('ownership')->insert(['ocid' => $request->id, 'ocdesc' => $request->name]);
					return 'DONE';
				} catch (Exception $e) {
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// OWNERSHIP
		////// FUNCTION
		public static function Functions(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllFunctions();
					return view('employee.masterfile.mfFunctions', ['functions' => $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfFunctions');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('funcapf')->insert(['funcdesc'=>$request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// FUNCTION
		////// INSTITUTIONAL CHARACTER
		public function InstitutionalCharacter(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllInstitutionalCharacter();
					// return dd($data);
					return view('employee.masterfile.mfInstitutionalCharacter', ['AllData' => $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfInstitutionalCharacter');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('facmode')->insert(['facmdesc'=>$request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// INSTITUTIONAL CHARACTER
		////// FACILITY
		public function Facility(Request $request)
		{
			if ($request->isMethod('get')) {
				try 
				{
					$data = AjaxController::getAllFacilityGroup();
					// return dd($data);
					return view('employee.masterfile.mfFacility', ['fatypes'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfFacility');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('hfaci_grp')->insert(['hgpdesc'=> $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) {
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// FACILITY
		////// SERVICES
		public function Services(Request $request)
		{
			if ($request->isMethod('get')) {
				try 
				{
					$data = AjaxController::getAllServices();
					$data1 = AjaxController::getAllFacilityGroup();
					// return dd($data);
					return view('employee.masterfile.mfServices', ['services'=>$data, 'facility' => $data1]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfServices');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('facilitytyp')->insert(['facid' => $request->id, 'facname'=> $request->name, 'hgpid'=>$request->ocid, 'facmid' => 1]);
					return 'DONE';
				} 
				catch (Exception $e) {
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// SERVICES
		////// MANAGE FACILITY
		public function ManageFacility(Request $request)
		{
			if ($request->isMethod('get')) {
				try 
				{
					$data = AjaxController::getAllApplicationType();
					$data1 = AjaxController::getAllFacilityGroup();
					return view('employee.masterfile.mfManageFacility', ['types'=>$data, 'facilitys'=>$data1]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfManageFacility');
				}
			}
			if ($request->isMethod('post')) {
				try 
				{
					$chckSameData = DB::table('type_facility')->where('hfser_id','=',$request->hfser_id)->where('facid','=',$request->facid)->first();
					if (!$chckSameData) {
							DB::table('type_facility')->insert(['hfser_id'=>$request->hfser_id, 'facid'=>$request->facid]);
							return "DONE";
					} else{
						return "SAME";
					}		
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// MANAGE FACILITY
		////// MANAGE SERVICES
		public function ManageServices(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try // mfManageServices
				{
					return view('employee.masterfile.mfManageServices');
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfManageServices');
				}
			}
		}
		////// MANAGE SERVICES
		////// MANAGE REQUIREMENTS
		public function ManageRequirements(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllApplicationType();
					$data1 = AjaxController::getAllFacilityGroup();
					$data2 = AjaxController::getAllUploads();
					// return dd($data1);
					return view('employee.masterfile.mfManageRequirements', ['types'=>$data, 'facilitys'=>$data1, 'uploads'=>$data2]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfManageRequirements');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$Same = DB::table('facility_requirements')
							->where([
									['typ_id', '=', $request->typ_id],
									['upid', '=', $request->upid]
								])->get();
					if (count($Same) == 0) {
						$test = DB::table('facility_requirements')->insert(['typ_id' => $request->typ_id, 'upid'=> $request->upid]);
						return 'DONE';
					} else { return 'SAME';}
				} 
				catch (Exception $e) {
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// MANAGE REQUIREMENTS
		////// TRANSACTION STATUS
		public function TransactionStatus(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllTransactionStatus();
					// return dd($data);
					return view('employee.masterfile.mfTransaction', ['trans'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfTransaction');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('trans_status')->insert([
							'trns_id' => $request->id,
							'trns_desc' => $request->name,
							'allowedpayment' => $request->allowed,
							'canapply' => $request->apply,
						]);	
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// TRANSACTION STATUS
		////// UPLOADS
		public function Uploads(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllUploads();
					return view('employee.masterfile.mfUploads', ['uploads'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfUploads');
				}
			}
			if ($request->isMethod('post')) 
			{
				try {
					DB::table('upload')->insert(['updesc'=>$request->name,'isRequired'=>$request->required]);
					return 'DONE';
				} catch (Exception $e) {
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// UPLOADS
		////// DEPARTMENT
		public function Department(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllDepartments();
					return view('employee.masterfile.mfDepartment',['depts'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfDepartment');
				}
			}
			if ($request->isMethod('post')) 
			{
				try {
					DB::table('department')->insert(['depid' => $request->id, 'depname' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';	
				}
			}
		}
		////// DEPARTMENT
		////// SECTION
		public function Section(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllDepartments();
					$data1 = AjaxController::getAllSections();
					return view('employee.masterfile.mfSection',['depts'=>$data, 'secs'=>$data1]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfSection');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('section')->insert(['secid' => $request->id, 'secname' => $request->name, 'depid' => $request->depid]);
					return 'DONE';
				} 
				catch (Exception $e) {
					AjaxController::SystemLogs($e);
				  	return 'ERROR';	
				}
			}
		}
		////// SECTION
		////// WORK
		public function Work(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllWorks();
					$data1 = AjaxController::getAllPositions();
					return view('employee.masterfile.mfWork', ['works'=>$data1]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfWork');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					// DB::table('pwork')->insert(['pworkid' => $request->id, 'pworkname' => $request->name]);
					DB::table('position')->insert(['posname' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
				  	return 'ERROR';
				}
			}
		}
		////// WORK 
		////// WORK STATUS
		public function WorkStatus(Request $request)
		{
			if ($request->ismethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllWorkStatus();
					return view('employee.masterfile.mfWorkStatus', ['pwStats'=>$data]);
				}
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfWorkStatus');
				}
			}
			if ($request->ismethod('post')) 
			{
				try {
					DB::table('pwork_status')->insert(['pworksid' => $request->id, 'pworksname' => $request->name]);
					return 'DONE';
				} catch (Exception $e) {
					AjaxController::SystemLogs($e);
				  	return 'ERROR';	
				}
			}
		}
		////// WORK STATUS
		////// LICENSE TYPE
		public function LicenseType(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllLicenseType();
					return view('employee.masterfile.mfLicenseType', ['plitype'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfLicenseType');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('plicensetype')->insert(['plid' => $request->id, 'pldesc' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
				  	return 'ERROR';	
				}
			}
		}
		////// LICENSE TYPE
		////// TRAINING
		public function Training(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllTrainings();
					return view('employee.masterfile.mfTraining', ['train'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfTraining');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('ptrainings_trainingtype')->insert(['tt_id'=>$request->id,'ptdesc'=>$request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// TRAINING
		////// REGIONS
		public function Regions(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllRegion();
					return view('employee.masterfile.mfRegion', ['region'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfRegion');
				}
			}
			if ($request->ismethod('post')) 
			{
				try 
				{
					DB::table('region')->insert(['rgnid' => $request->id, 'rgn_desc' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// REGIONS
		////// PROVINCES
		public function Provinces(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllProvince();
					$data1 = AjaxController::getAllRegion();
					return view('employee.masterfile.mfProvince', ['province'=>$data],['region'=>$data1]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfProvince');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('province')->insert(['rgnid' => $request->id, 'provname' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// PROVINCES
		////// CITY/MUNICIPALITIES
		public function CityMunicipalities(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllRegion();
					$data1 = AjaxController::getAllProvince();
					$data2 = AjaxController::getAllCityMunicipality();
					return view('employee.masterfile.mfCityMunicipality', ['region'=>$data,'province'=>$data1,'cm'=>$data2]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfCityMunicipality');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('city_muni')->insert(['provid' => $request->id, 'cmname' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// CITY/MUNICIPALITIES
		////// BARANGAY
		public function Barangay(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllRegion();
					$data1 = AjaxController::getAllProvince();
					$data2 = AjaxController::getAllCityMunicipality();
					$data3 = AjaxController::getAllBarangay();
					return view('employee.masterfile.mfBarangay',['region'=>$data, 'province'=>$data1, 'cm'=>$data2, 'brgy' => $data3]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfBarangay');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('barangay')->insert(['cmid' => $request->id, 'brgyname' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		} 
		////// BARANGAY
		////// ORDER OF PAYMENT
		public function OrderOfPayment(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllOrderOfPayment();
					return view('employee.masterfile.mfOrderOfPayment',['oops'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfOrderOfPayment');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('orderofpayment')->insert(['oop_id' => $request->id, 'oop_desc' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// ORDER OF PAYMENT
		////// CATEGORY
		public function Category(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllCategory();
					return view('employee.masterfile.mfCategory', ['category'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfCategory');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('category')->insert(['cat_id' => $request->id, 'cat_desc' => $request->name, 'cat_type' => $request->type]);	
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// CATEGORY
		////// CHARGES
		public function Charges(Request $request)
		{
			if ($request->ismethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllChargesWithCategory();
					$data1 = AjaxController::getAllCategory();
					return view('employee.masterfile.mfCharges', ['Chrges'=>$data,'Categorys'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfCharges');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('charges')->insert(['chg_code'=> strtoupper($request->id), 'cat_id' => $request->cat_id, 'chg_desc'=> $request->name, 'chg_exp' => $request->exp,'chg_rmks' => $request->rmk]);
					return 'DONE';		
				} 
				catch (Exception $e) {
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// CHARGES
		////// MANAGE CHARGES
		public function ManageCharges(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllManageCharge();
					$data1 = AjaxController::getAllOrderOfPayment();
					$data2 = AjaxController::getAllCharges();
					$data3 = AjaxController::getAllApplicationStatus();
					$data4 = AjaxController::getAllCategory();
					return view('employee.masterfile.mfManageCharges', ['OOPs'=>$data1, 'Chrgs' => $data2, 'BigData' => $data, 'TotalNumber' => count($data), 'IniRen' => $data3,'Cats' => $data4]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfManageCharges');					
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$data = DB::table('chg_app')->select('chgopp_seq')->where('oop_id', '=', $request->oop_id)->orderBy('chgopp_seq','desc')->first();
					if (!$data) {$data1 = 1;}
					else { $data1 = $data->chgopp_seq + 1;}
					DB::table('chg_app')->insert(['chg_code'=>$request->chg_code,'oop_id'=>$request->oop_id,'chgopp_seq'=>$data1,'amt'=>0,'aptid'=>$request->aptid,'remarks'=>$request->rmk]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// MANAGE CHARGES
		////// MODE OF PAYMENT
		public function ModeofPayment(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllModeOfPayment();
					return view('employee.masterfile.mfModeOfPayment', ['Chgs'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfModeOfPayment');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('charges')->insert(['chg_code' => $request->id, 'cat_id' => 'PMT', 'chg_desc' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// MODE OF PAYMENT
		////// DEFAULT PAYMENT
		public function DefaultPayment(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllDefaultPayment();
					$data1 = AjaxController::getAllFacilityGroup(); // Facility Group
					$data2 = AjaxController::getAllOrderOfPayment();
					$data3 = AjaxController::getAllApplicationStatus();
					$data4 = AjaxController::getAllApplicationType();
					$data5 = AjaxController::getAllPaymentWithCharges();
					// return dd($data);
					return view('employee.masterfile.mfDefaultPayment', ['default'=>$data, 'facilitys' =>$data1, 'OOP' => $data2, 'aptype' => $data3, 'app' => $data4, 'payment' => $data5]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfDefaultPayment');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('facoop')->insert([
						'oop_id'=>$request->oop, 
						'hfser_id'=>$request->hfser_id,
						'facid'=>$request->facid,
						'aptid'=>$request->aptid,
						'chgapp_id'=>$request->chg_app
					]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// DEFAULT PAYMENT
		////// SERVICE CHARGES
		public static function ServiceCharges(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try  // mfServiceCharges
				{
					// $data = AjaxController::getAllServiceChargers();
					$data1 = AjaxController::getAllOrderOfPayment();
					$data2 = AjaxController::getAllFacilityGroup();
					// return dd($data1);
					return view('employee.masterfile.mfServiceCharges', ['oop' =>$data1, 'faci' => $data2]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfServiceCharges');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$test = DB::table('serv_chg')->where('facid', '=', $request->facid)->where('chgapp_id', '=', $request->id)->first();
					if (!$test) {
						DB::table('serv_chg')->insert(['facid' => $request->facid, 'chgapp_id' => $request->id]);
						return 'DONE';
					} else {
						return 'SAME';
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// SERVICE CHARGES
		////// ASSESSMENT CATEGORY
		public function AssessmentCategory(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllAssessmentCategory();
					return view('employee.masterfile.mfAssessmentCategory', ['cat' => $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfAssessmentCategory');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('cat_assess')->insert(['caid'=> $request->id, 'categorydesc' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// ASSESSMENT CATEGORY
		////// ASSESSMENT SUBCATEGORY A
		public function SubCategoryA(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllAssessmentCategory();
					// return dd($data);
					return view('employee.masterfile.mfAssessmentSubCategoryA');
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfAssessmentSubCategoryA');
				}
			}
		}
		////// ASSESSMENT SUBCATEGORY A
		////// ASSESSMENT SUBCATEGORY B
		public function SubCategoryB(Request $request)
		{
			if ($request->isMethoD('get')) 
			{
				try 
				{
					return view('employee.masterfile.mfAssessmentSubCategoryB');
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfAssessmentSubCategoryB');
				}
			}
		}
		////// ASSESSMENT SUBCATEGORY B
		////// ASSESSMENT PART
		public function AssessmentPart(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllAssessmentPart();
					return view('employee.masterfile.mfAssessmentPart', ['parts' => $data]);
				} 
				catch (Exception $e)
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfAssessmentPart');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('part')->insert(['partid' => $request->id, 'partdesc' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// ASSESSMENT PART
		////// ASSESSMENT (Master File)
		public function AssessmentMf(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllAssessmentJoined();
					$data1 = AjaxController::getAllAssessmentPart();
					$data2 = AjaxController::getAllFacilityGroup();
					$data3 = AjaxController::getAllAssessmentCategory();
					return view('employee.masterfile.mfAssessment', ['asments'=>$data, 'parts'=>$data1, 'faci'=>$data2,'cat'=> $data3]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfAssessment');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('assessment')->insert(['asmt_name' => $request->name, 'partid' => $request->partid, 'facid' => $request->faci, 'caid' => $request->caid]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		} 
		////// ASSESSMENT (Master File)
		////// ASSESSMENT 2 (Master File)
		public static function Assessment2MF(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllAssement2();
					$data1 = AjaxController::getAllHeader();
					$data2 = AjaxController::getAllSubDescription();
					// $data3 = AjaxController::getAllAssessmentTitle();
					// , 'parts'=>$data1, 'faci'=>$data2,'cat'=> $data3
					// return dd($data);
					return view('employee.masterfile.mfAssessment2', ['asments'=>$data, 'header' => $data1, 'sdesc'=>$data2]/*, 'title' => $data3]*/);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfAssessment2');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$data = DB::table('asmt2')->where('asmt2_id', '=', $request->id)->first();
					if (!$data) {
						DB::table('asmt2')->insert([
													'asmt2_id' => $request->id, 
													// 'asmt2_title' => $request->title, 
													'asmt2_loc' => $request->header,
													'asmt2_desc' => $request->desc,
													'asmt2sd_id' => $request->sub_desc,
												]);
						return 'DONE';
					} else {
						return 'SAME';
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// ASSESSMENT 2 (Master File)
		//////
		public static function AssessmentSubDesc2MF(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllSubDescription();
					// return dd($data);
					return view('employee.masterfile.mfSubDesc', ['sdesc'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfSubDesc');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('asmt2_sdsc')->insert(['asmt2sd_id' => $request->id, 'asmt2sd_desc' => $request->desc]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// ASSESSMENT Column
		public static function AssessmentColumn(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try // mfAssessmentColumn
				{
					$data = AjaxController::getAllColumn();
					return view('employee.masterfile.mfAssessmentColumn', ['colmn' => $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfAssessmentColumn');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('asmt2_col')->insert(['asmt2c_id' => $request->id, 'asmt2c_desc' => $request->desc, 'asmt2c_type'=> $request->inputype]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// MANAGE ASSESSMENT
		public static function ManageAssessment(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllManageAssessment();
					$data1 = AjaxController::getAllFacilityGroup();
					$data2 = AjaxController::getAllAssessment();
					// return dd($data);
					return view('employee.masterfile.MngAssessment', ['MngAsmt' => $data, 'Facilitys' => $data1, 'Asmt' => $data2]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.MngAssessment');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('facassessment')->insert(['asmt_id'=>$request->asmt_id, 'facid' => $request->hgpid]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// MANAGE ASSESSMENT
		////// MANAGE ASSESSMENT 2
		public static function ManageAssessment2(Request $request) 
		{
			if ($request->isMethod('get')) 
			{
				try //mfManageAssessment2
				{
					$data = AjaxController::getAllApplicationType();
					$data1 = AjaxController::getAllAssement2();
					$data2 = AjaxController::getAllColumn();
					$data3 = AjaxController::getAllAssessmentTitle();
					// return dd($data3);
					return view('employee.masterfile.mfManageAssessment2', ['hfaci_serv_type'=>$data, 'asments' => $data1, 'colmn' => $data2, 'part' => $data3]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfManageAssessment2');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					if (isset($request->facid)) { // With Service
						$test = DB::table('serv_asmt')->where([['facid', '=', $request->facid], ['asmt2_id', '=', $request->asmt2_id], ['hfser_id', '=', $request->hfser_id], ['hgpid', '=', $request->hgpid]])->first();
						if (!isset($test)) // Check if has Duplicate
						{ 
							$data = DB::table('serv_asmt')->where([['facid', '=', $request->facid], ['hfser_id', '=', $request->hfser_id], ['hgpid', '=', $request->hgpid]])->orderBy('srvasmt_seq', 'desc')->first();
							$seq = 0; // Check Numbers
							if (isset($data->srvasmt_seq)) {
								$seq = ((int)$data->srvasmt_seq) + 1;
							} else {
								$seq = 1;
							}

							DB::table('serv_asmt')->insert(['facid'=> $request->facid, 'asmt2_id' => $request->asmt2_id, 'hfser_id' => $request->hfser_id, 'srvasmt_seq' => $seq, 'hgpid' => $request->hgpid, 'hasRemarks' => $request->hasRemarks, 'srvasmt_col' => json_encode($request->clm), 'part' => $request->part]);
							return 'DONE';

						} 
						else
						{
							return 'DUPLICATE';
						}
					}
					else  // Without Service
					{
						$test = DB::table('serv_asmt')->where([['facid', '=', null], ['asmt2_id', '=', $request->asmt2_id], ['hfser_id', '=', $request->hfser_id], ['hgpid', '=', $request->hgpid]])->first();
						if (!isset($test))  // Check if has Duplicate
						{
							$data = DB::table('serv_asmt')->where([['facid', '=', null], ['hfser_id', '=', $request->hfser_id], ['hgpid', '=', $request->hgpid]])->orderBy('srvasmt_seq', 'desc')->first();
							$seq = 0; // Check Numbers
							if (isset($data->srvasmt_seq)) {
								$seq = ((int)$data->srvasmt_seq) + 1;
							} else {
								$seq = 1;
							}
							DB::table('serv_asmt')->insert(['facid'=> null, 'hgpid' => $request->hgpid, 'asmt2_id' => $request->asmt2_id, 'hfser_id' => $request->hfser_id, 'srvasmt_seq' => $seq, 'hasRemarks' => $request->hasRemarks, 'srvasmt_col' => json_encode($request->clm), 'part' => $request->part]);
							return 'DONE';
						}
						else
						{
							return 'DUPLICATE';
						}
					}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// MANAGE ASSESSMENT 2
		////// OTHERS (MASTER FILE)
		////// COMPLAINTS
		public static function Complaints(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllComplaints();
					// return dd($data);
					return view('employee.masterfile.mfComplaints', ['AllData'=> $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfComplaints');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('complaints')->insert(['cmp_desc' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// REQUEST FOR ASSISTANCE
		public static function RequestForAssistance(Request $request)
		{
			if ($request->isMethod('get')) 
			{ 
				try 
				{
					$data = AjaxController::getAllRequestForAssistance();
					return view('employee.masterfile.mfRequestforAssistance', ['AllData'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.mfRequestforAssistance');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('req_ast')->insert(['rq_desc' => $request->name]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// SYSTEM SETTINGS
		public function SystemSetting(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllSettings();
					return view('employee.masterfile.SystemSettings', ['BigData' => $data]);
				} 
				catch (Exception $e) 
				{
					return $e;
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.masterfile.SystemSettings');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$update = array('mtny'=> $request->mtny, 'sec_name' => $request->sec_name, 'app_exp'=>$request->app_exp, 'acc_exp' => $request->acc_exp, 'pass_exp' => $request->pass_exp, 'pass_temp' => $request->pass_temp, 'pass_min' => $request->pass_min, 'pass_ban' => $request->pass_ban);
					$data = DB::table('m99')->where('id', '=', 1)->update($update);
					if ($data) { return 'DONE'; } 
					else 
					{
						AjaxController::SystemLogs('No data updated in m99 table. (SystemSetting)');
						return 'ERROR';
					}	
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// SYSTEM SETTINGS
		///////////////////////////////////////////////// MASTER FILE
		///////////////////////////////////////////////// PROCESS FLOW
		////// VIEW ALL
		public function ViewProcessFlow(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllApplicantsProcessFlow();
					// return dd($data);
					return view('employee.processflow.viewprocessflow', ['LotsOfDatas' => $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.processflow.viewprocessflow');
				}
			}
		}
		////// VIEW ALL
		////// EVALUATE
		public function EvaluateProcessFlow(Request $request)
		{
			try 
			{
				$data = AjaxController::getAllApplicantsProcessFlow();
				return view('employee.processflow.pfevaluate', ['BigData'=>$data]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pfevaluate');
			}
		}
		////// EVALUATE
		////// EVALUATE ONE
		public function EvaluateOneProcessFlow(Request $request, $appid)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$Cur_useData  = AjaxController::getCurrentUserAllData();
					$data = AjaxController::getAllDataEvaluateOne($appid); 
					$data1 = AjaxController::getAllDataEvaluateOneUploads($appid, 0);
					$data2 = AjaxController::getAllDataEvaluateOneUploads($appid, 1);
					$data3 = AjaxController::getAllDataEvaluateOneUploads($appid, 2);
					$data4 = AjaxController::getAllDataEvaluateOneUploads($appid, 3);
					$data5 = AjaxController::getAllDataEvaluateOneUploads($appid, 4);
					$data6 = AjaxController::getAllOrderOfPayment();
					$data7 = AjaxController::getAllDataEvaluateOneUploads($appid, 5);
					$data8 = Carbon::parse($Cur_useData['date']);
					$data9 = Carbon::parse($Cur_useData['date']);
					$data10 = Carbon::parse($Cur_useData['date']);
					$data10 = $data10->addDays(30);
					$data8 = $data8->addDays(1);
					$test = false;
						do {
							// $temp = $data8->toDateString();	
							if ($data8->isWeekday()) { // true
								$temp = $data8->toDateString();
								$check = DB::table('holidays')->where('hdy_date', '=', $temp)->first();
								if ($check) {
									$data8 = $data8->addDays(1);
									$test = false;
								} else {
									$test = true;
								}
							} else { // false
								$data8 = $data8->addDays(1);
								$test = false;
							}
						} while ($test == false);
						// return dd($data);
					return view('employee.processflow.pfevaluteone', ['AppData'=> $data, 'UploadData' => $data1, 'numOfX' => count($data2), 'numOfApp' => count($data3), 'numOfAprv'=> count($data4), 'numOfNull' => count($data5), 'OOPS'=>$data6, 'OPPok' => $data7, 'ActualString' => $data8->toDateString(), 'DateString' => $data8->toFormattedDateString(),'appID' => $appid, 'DateNow' => $data9->toDateString(), 'AfterDay'=> $data10->toDateString()]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.processflow.pfevaluteone');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$addedby = session()->get('employee_login');
					$dt = Carbon::now();
		          	$dateNow = $dt->toDateString();
		          	$timeNow = $dt->toTimeString();
					$updateData = array(
											'evaluation'=>$request->evalYesNo,
											'evaluatedBy' => $addedby->uid,
											'evaltime' => $timeNow, 
											'evaldate' => $dateNow,
											'remarks' => $request->remark,
										);
					DB::table('app_upload')->where('apup_id', '=', $request->appUp_ID)->update($updateData);
					return back();	
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return back();
				}
			}
		}
		////// EVALUATE ONE
		////// ORDER OF PAYMENT
		public function OrderOfPaymentProcessFlow(Request $request)
		{
			try 
			{
				$data = AjaxController::getAllApplicantsProcessFlow();
				return view('employee.processflow.pforderofpayment', ['BigData'=>$data]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pforderofpayment');
			}
		}
		////// ORDER OF PAYMENT
		////// ORDER OF PAYMENT ONE
		public function OrderOfPaymentOneProcessFlow(Request $request, $appid)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllDataEvaluateOne($appid);
					$data1 = AjaxController::getAllDataOrderOfPaymentUploads($appid ,0);
					$data2 = AjaxController::getAllDataOrderOfPaymentUploads($appid ,4);
					$data3 = AjaxController::getAllDataOrderOfPaymentUploads($appid ,2);
					$data4 = AjaxController::getAllOrderOfPayment();
					$data5 = AjaxController::getAllDataOrderOfPaymentUploads($data->aptid ,3);
					// return dd($data2);
					return view('employee.processflow.pforderofpaymentone',['AppData'=>$data, 'Payments' => $data1, 'Sum' => $data2, 'OOPs' =>$data4, 'Chrges' =>$data5, 'APPID' => $appid]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.processflow.pforderofpaymentone');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$Cur_useData = AjaxController::getCurrentUserAllData();
			  		$getData = DB::table('chg_app')->where('chgapp_id', '=', $request->id)->select('chg_num')->first();
			  		$test = DB::table('chgfil')->insert([
			  						'chgapp_id' => $request->id,
			  						'chg_num' => $getData->chg_num,
			  						'appform_id' => $request->appid,
			  						'reference' => $request->desc,
			  						'amount' => $request->amount,
			  						't_date' => $Cur_useData['date'],
			  						't_time' => $Cur_useData['time'],
			  						't_ipaddress' => $Cur_useData['ip'],
			  						'uid' => $Cur_useData['cur_user'],
			  						'sysdate' => $Cur_useData['date'],
			  						'systime' => $Cur_useData['time'],
			  					]);
			  		$upd = array('chg_num'=>(intval($getData->chg_num) + 1));
			  		$test2 = DB::table('chg_app')->where('chgapp_id', '=', $request->id)->update($upd);
			  		return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// ORDER OF PAYMENT ONE
		////// CASHIER
		public function CashierProcessFlow(Request $request)
		{
			try 
			{
				$data = AjaxController::getAllApplicantsProcessFlow();
				$paymentMethod = DB::table('charges')->where('cat_id','PMT')->get();
				$cur_user = AjaxController::getCurrentUserAllData();
				// $aptID = $cur_user['cur_user'];
				return view('employee.processflow.pfcashier', ['BigData'=>$data,'loggedIn'=>$cur_user,'paymentMethod'=>$paymentMethod]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pfcashier');
			}
		}
		////// CASHIER
		////// CASHIER ONE
		public function CashierOneProcessFlow(Request $request, $appid,$aptid)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$paymentMethod = DB::table('charges')->where('cat_id','PMT')->get();
					$cur_user = AjaxController::getCurrentUserAllData();
					$data = AjaxController::getAllDataEvaluateOne($appid);
					$data1 = AjaxController::getAllDataOrderOfPaymentUploads($appid ,0);
					$data2 = AjaxController::getAllDataOrderOfPaymentUploads($appid ,1);
					$data3 = AjaxController::getAllDataOrderOfPaymentUploads($appid ,2);
					$data4 = AjaxController::getAllOrderOfPayment();
					$data5 = AjaxController::getAllDataOrderOfPaymentUploads($data->aptid ,3);
					// dd($data5);
					return view('employee.processflow.pfcashierone', ['AppData'=>$data, 'paymentMethod'=>$paymentMethod, 'loggedIn'=>$cur_user, 'Payments' => $data1, 'Sum' => $data2, 'OOPs' =>$data4, 'Chrges' =>$data5, 'appform_id'=> $appid, 'aptid'=>$aptid]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.processflow.pfcashierone');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$Cur_useData = AjaxController::getCurrentUserAllData();
			  		$getData = DB::table('chg_app')->where('chgapp_id', '=', $request->id)->select('chg_num')->first();
			  		$test = DB::table('chgfil')->insert([
			  						'chgapp_id' => $request->id,
			  						'chg_num' => $getData->chg_num,
			  						'appform_id' => $request->appid,
			  						'reference' => $request->desc,
			  						'amount' => $request->amount,
			  						't_date' => $Cur_useData['date'],
			  						't_time' => $Cur_useData['time'],
			  						't_ipaddress' => $Cur_useData['ip'],
			  						'uid' => $Cur_useData['cur_user'],
			  						'sysdate' => $Cur_useData['date'],
			  						'systime' => $Cur_useData['time'],
			  					]);
			  		$upd = array('chg_num'=>(intval($getData->chg_num) + 1));
			  		$test2 = DB::table('chg_app')->where('chgapp_id', '=', $request->id)->update($upd);
			  		return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// CASHIER ONE
		////// ASSIGNMENT OF TEAM
		public function AssignmentofTeamProcessFlow(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllApplicantsProcessFlow();
					$data1 = AjaxController::getAllRegion();
					return view('employee.processflow.pfassignmentofteam', ['BigData' => $data, 'regions'=> $data1]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.processflow.pfassignmentofteam');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					for ($i=0; $i < count($request->ids) ; $i++) { 
						DB::table('app_team')->insert([
								'appid' => $request->SelectedID,
								'teamid' => $request->teams[$i],
								'uid' => $request->ids[$i],
								'remarks' => $request->rmks[$i],
						]);
					}
					$selected = AjaxController::getUidFrom($request->SelectedID);
					AjaxController::notifyClient($selected, 3);
					return 'DONE';	
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// ASSIGNMENT OF TEAM
		////// ASSESSMENT
		public function AssessmentProcessFlow(Request $request)
		{
			try 
			{
				$data = AjaxController::getAllApplicantsProcessFlow();
				return view('employee.processflow.pfassessment', ['BigData' => $data]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pfassessment');
			}
		}
		////// ASSESSMENT
		////// ASSESSMENT ONE
		/////  syrel redo
		// !@#
		public function AssessmentOneProcessFlow(Request $request, $appid, $apptype, $monType = false)
		{
			$charCombined = $checkExistMon = null;
			$appidReal = $appid;
			$applyType = 'license';
			if ($request->isMethod('get')) 
			{
				if(strtolower($apptype) !== 'mon'){
					$whereClause = [['x08_ft.appid','=',$appid],['serv_asmt.hfser_id', '=',$apptype]];
					$appformFetch = DB::table('appform')->where('appid',$appid)->select('uid','hfser_id','aptid')->get()->first();
					if(!empty($appformFetch)){
						$charCombined = $appformFetch->uid.'_'.$appformFetch->hfser_id.'_'.$appformFetch->aptid;
						if(DB::table('app_assessment')->where('appid',$charCombined)->count() > 0 || $appformFetch->hfser_id != $apptype){
							return redirect('employee/dashboard/processflow/assessment/view/'.$appid.'/'.$apptype);
							dd('Redirecting you to page');
						}
					} else {
						return redirect('employee/dashboard/processflow/assessment/');
						dd('Wrong appid');
					}
				} else {
					$checkExistMon = DB::table('mon_form')->where([['monid',$appid],['type_of_faci',$monType]])->count();
					if($checkExistMon < 1){
						return redirect('employee/dashboard/others/monitoring/inspection');
						dd('wrong monitoring');
					}
					$appformFetch = DB::table('mon_form')->where('monid',$appid)->select('DOHMonitoring')->get()->first();
					if(!empty($appformFetch->DOHMonitoring)){
						return redirect('employee/dashboard/processflow/assessment/view/'.$appid.'/'.$apptype.'/'.$monType);
						dd('Redirecting you to page');
					}
					$applyType = 'mon';
					$appid = DB::table('mon_form')->select('appid')->where('monid','=',$appid)->first()->appid;
					if(empty($appid)){
						return redirect('employee/dashboard/processflow/assessment/'.$appid.'/'.$apptype.'/view');
						dd('Redirecting you to page');
					}
					$whereClause = [['x08_ft.appid','=',$appid],['facilitytyp.facid', '=',$monType]];
				}
				try 
				{

					$asmt2_col = $asmt2_loc = array();
					$joinedData = null;
					$allAccess = $filenames = array();
					$countColoumn = DB::SELECT("SELECT count(*) as 'all' FROM information_schema.columns WHERE table_name = 'asmt2'")[0]->all -1;
					$joinedData = DB::table('x08_ft')
		            ->leftJoin('appform', 'appform.appid', '=', 'x08_ft.appid')
		            ->leftJoin('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
		            ->leftJoin('facilitytyp', 'x08_ft.facid', '=', 'facilitytyp.facid')
		            ->leftJoin('hfaci_grp', 'facilitytyp.hgpid', '=', 'hfaci_grp.hgpid')
		            ->leftJoin('serv_asmt', 'x08_ft.facid', '=', 'serv_asmt.facid')
					->leftJoin('asmt_title', 'serv_asmt.part', '=', 'asmt_title.title_code')
					->leftJoin('asmt2', 'serv_asmt.asmt2_id', '=', 'asmt2.asmt2_id')
					->leftJoin('asmt2_loc', 'asmt2.asmt2_loc', '=', 'asmt2_loc.asmt2l_id')
		            ->leftJoin('asmt2_sdsc', 'asmt2.asmt2sd_id', '=', 'asmt2_sdsc.asmt2sd_id')
		            ->select(
						'appform.appid',
						'appform.uid',
						'appform.hfser_id as appformhfser_id',
						'appform.aptid',
						'appform.facilityname',
						'serv_asmt.*',
						'asmt2_loc.*',
						'facilitytyp.facname',
						'hfaci_serv_type.hfser_desc',
						'hfaci_serv_type.terms_condi',
						'asmt2.*',
						'asmt2_sdsc.asmt2sd_desc',
						'serv_asmt.srvasmt_seq',
						'asmt2_loc.asmt2l_sdesc',
						'asmt_title.filename',
						'serv_asmt.facid as hospitalType',
						'asmt_title.title_name'
					)
		            ->orderBy('asmt_title.title_name','ASC')->orderBy('serv_asmt.srvasmt_seq','ASC')
		            ->where($whereClause)
		            ->get();
		            $joinedData = json_decode($joinedData,true);
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
					$SELECTED = $data->uid.'_'.$data->hfser_id.'_'.$data->aptid;
					return view('employee.processflow.pfassessmentone', ['AppData'=>$data, 'appId'=> $appidReal, 'joinedData'=>$joinedData, 'apptype' => $apptype, 'filenames'=>$filenames, 'monType'=>$applyType]);	
				} 
				catch (Exception $e) 
				{
					// dd('catch');
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

		////// ASSESSMENT ONE
		////// ASSESSMENT ONE VIEW
		// !@#
		public function AssessmentOneViewProcessFlow(Request $request, $appid, $apptype, $monType = false)
		{
			// dd($request->all());
			// dd($request->all());
			$dataToView = $charCompiled = $toDir = $jsonToArray = $noCharCompiled = $selfAssessmentCheck = $jsonToDB = $appform = $table = $selectFromDB = $whereClause = $recordsToCheck = $tableToUpdate = $slug = $fieldsOnUpdate = $allUserDetails = $checkExistMon = null;
			try 
			{
				$allUserDetails = AjaxController::getCurrentUserAllData();
				$exceptData = array('_token','appID','hfser_id','aptid','facilityname','uid','monType');
				if(strtolower($apptype) !== 'mon'){//licensing
					$selectFromDB = array('DOHAssessment');
					if(DB::table('appform')->where('appid',$appid)->count() < 1){
						return redirect('employee/dashboard/processflow/assessment/');
						dd('redirecting you to page');
					}
					if(!empty($request->all())){
						$charCompiled = $request->uid.'_'.$request->hfser_id.'_'.$request->aptid;
					} else {
						$noCharCompiled = DB::table('appform')->where('appid',$appid)->select('uid','hfser_id','aptid')->get()->first();
						$charCompiled = $noCharCompiled->uid.'_'.$noCharCompiled->hfser_id.'_'.$noCharCompiled->aptid;
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
				} else {//monitoring
					$selectFromDB = array('DOHMonitoring');
					$charCompiled = $appid;
					$table = 'mon_form';
					$whereClause = 'monid';
					$fieldsOnUpdate = array(
						'hasViolation'=>1
					);
					$checkExistMon = DB::table('mon_form')->where([['monid',$appid],['type_of_faci',$monType]])->count();
					if($checkExistMon < 1){
						return redirect('employee/dashboard/others/monitoring/inspection');
						dd('wrong monitoring');
					}
				}
				$dataToView = DB::table($table)->where($whereClause,$charCompiled)->select($selectFromDB)->get()->first();
				
				$selectFromDB = implode('', $selectFromDB);
				if(empty($dataToView->$selectFromDB) || $dataToView === null){
					if(!empty($request->all())){
						$recordsToCheck = $request->all();
						$slug = in_array('false',$recordsToCheck,true);
						if($slug){	
							DB::table((strtolower($apptype) !== 'mon') ? 'appform' : 'mon_form')
							->where($whereClause,$appid)							
							->update($fieldsOnUpdate);
						}
						$jsonToDB = json_encode($request->except($exceptData));
						(strtolower($apptype) !== 'mon' ? DB::table($table)->insert([
					    ['appid' => $charCompiled,'t_date' => AjaxController::getCurrentUserAllData()['date'],'t_time' => AjaxController::getCurrentUserAllData()['time'],'assessedby' => AjaxController::getCurrentUserAllData()['cur_user'],'uid' => $request->uid, 'DOHAssessment' => $jsonToDB]
						]) : DB::table($table)->where('monid',$appid)->update(['DOHMonitoring' => $jsonToDB]));
						$dataToView = json_encode($request->except($exceptData));
					} else {
						return redirect('/employee/dashboard/processflow/assessment/');
						dd('ERROR, PLEASE CONTACT ADMIN IMMEDIATELY');
					}
				} else {
					$dataToView = $dataToView->$selectFromDB;
				}
				$dataToView = json_decode($dataToView,true);
				$toDir = explode(',',$dataToView['filename']);
				unset($dataToView['filename']);
				$appform = DB::table('appform')->where('appid',$appid)->get()->first();
				return view('employee.processflow.pfassessmentoneview',['data' => json_encode($dataToView),'file'=>$toDir,'selfCheck'=>$selfAssessmentCheck, 'appform' => $appform]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pfassessmentoneview');
			}
		}
		////// ASSESSMENT ONE VIEW
		////// RECOMMENDATION
		public function RecommendationProcessFlow(Request $request)
		{
			try 
			{
				$data = AjaxController::getAllApplicantsProcessFlow();
				return view('employee.processflow.pfrecommendation', ['BigData'=>$data]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pfrecommendation');
			}
		}
		////// RECOMMENDATION 
		////// RECOMMENDATION ONE
		public function RecommendationOneProcessFlow(Request $request, $appid)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getRecommendationData($appid);
					$data1 = AjaxController::getPreAssessment($data->uid);
					$data2 = AjaxController::getAssignedMembersInTeam4Recommendation($appid);
					// return dd($data);
					return view('employee.processflow.pfrecommendationone', ['AppData'=>$data,'PreAss'=>$data1, 'APPID' => $appid, 'Teams4theApplication' => $data2]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.processflow.pfrecommendationone');
				}
			}
			if ($request->isMethod('post')) {
				try {
						$Cur_useData = AjaxController::getCurrentUserAllData();
						$update = array(
									'isRecoForApproval' => $request->isOk,
									'RecoForApprovalby' => $Cur_useData['cur_user'],
									'RecoForApprovalTime' => $Cur_useData['time'],
									'RecoForApprovalDate' =>$Cur_useData['date'],
									'RecoForApprovalIpAdd' => $Cur_useData['ip']
 								);
						if ($request->isOk == 1) {
							$update['status'] = 'FA';
						} else if ($request->isOk == 0) 
						{
							$update['status'] = 'DND';
						}
						$data = DB::table('appform')->where('appid', '=', $request->id)->update($update);
						$selected = AjaxController::getUidFrom($request->id);
						AjaxController::notifyClient($selected, 5);
						return 'DONE';
				} catch (Exception $e) {
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// RECOMMENDATION ONE
		////// APPROVAL
		public function ApprovalProcessFlow(Request $request)
		{
			try 
			{
				$data = AjaxController::getAllApplicantsProcessFlow();
				return view('employee.processflow.pfapproval', ['BigData'=>$data]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pfapproval');
			}
		}
		////// APPROVAL
		////// APPROVAL ONE
		public function ApprovalOneProcessFlow(Request $request, $appid)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getRecommendationData($appid);
					$data1 = AjaxController::getPreAssessment($data->uid);
					$data2 = AjaxController::getAssignedMembersInTeam4Recommendation($appid);
					return view('employee.processflow.pfapprovalone', ['AppData'=>$data,'PreAss'=>$data1, 'APPID' => $appid, 'Teams4theApplication' => $data2]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.processflow.pfapprovalone');
				}
			}
			if ($request->isMethod('post')) 
			{
				try {
						$ChckPassword = AjaxController::checkPassword($request->pass);
						if ($ChckPassword == true) 
						{
							$Cur_useData = AjaxController::getCurrentUserAllData();
							$status = ($request->isOk == '1') ? 'A' : 'RA';
						 	$data = array(
						 			'isApprove' => $request->isOk,
						 			'approvedBy' => $Cur_useData['cur_user'],
						 			'approvedDate' => $Cur_useData['date'],
						 			'approvedTime' =>  $Cur_useData['time'],
						 			'approvedIpAdd' => $Cur_useData['ip'],
						 			'approvedRemark' => $request->desc,
						 			'status' => $status,
	 					 		);
							$test = DB::table('appform')->where('appid', '=', $request->id)->update($data);
							$selected = AjaxController::getUidFrom($request->id);
							AjaxController::notifyClient($selected, 6);
							if ($test) {
								return 'DONE';
							} else {
								return 'ERROR';
							}
						}
						else
						{
							return 'WRONGPASSWORD';
						}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// APPROVAL ONE
		////// FAILED
		public static function FailedProcessFlow(Request $request)
		{
			try 
			{
				$data = AjaxController::getFailedApplications();
				// return dd($data);
				return view('employee.processflow.pffailed', ['BigData'=>$data]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pffailed');
			}
		}
		////// FAILED
		////// FAILED ONE
		public static function FailedOneProcessFlow(Request $request, $appid)
		{
			try 
			{
					$data = AjaxController::getRecommendationData($appid);
					$data1 = AjaxController::getPreAssessment($data->uid);
					$data2 = AjaxController::getAssignedMembersInTeam4Recommendation($appid);
					// return dd($data);
					return view('employee.processflow.pffailedone', ['AppData'=> $data,'PreAss'=> $data1, 'APPID' => $appid, 'Teams4theApplication' => $data2]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.pffailedone');
			}
		}
		////// FAILED ONE
		///////////////////////////////////////////////// PROCESS FLOW
		///////////////////////////////////////////////// OTHERS
		////// MONITORING
		public function MonitoringOthers(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$allData = AjaxController::getAllMonitoringForm();
					$test = AjaxController::getFacTypeByFacid("BB");
					// dd($allData);
					// dd(AjaxController::getFacTypeByFacid("BB")[0]->facname);
					$allRec = AjaxController::getAllSurveillanceRecommendation();
					$typNameSql = "SELECT * FROM facilitytyp";
					$typName = DB::select($typNameSql);
					// dd($faciName);
					return view('employee.others.Monitoring', ['TypName'=>$typName, 'AllData'=>$allData, 'AllRec'=>$allRec]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error', 'ERROR');
					return view('employee.others.Monitoring')	;
				}
			}	
		}

		public function MonitoringTeamsOthers(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$allDataSql = "SELECT * FROM mon_form WHERE team IS NULL";
					$allData = DB::select($allDataSql);
					$allRec = AjaxController::getAllSurveillanceRecommendation();
					$allTeam = AjaxController::getAllAppTeams();
					return view('employee.others.MonitoringTeams', ['AllData'=>$allData, 'AllRec'=>$allRec, 'AllTeam'=>$allTeam]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error', 'ERROR');
					return view('employee.others.Monitoring')	;
				}
			}	
		}

		public function MonitoringInspectionOthers(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$allDataSql = "SELECT * FROM mon_form WHERE team IS NOT NULL";
					$allData = DB::select($allDataSql);
					return view('employee.others.MonitoringInspection', ['AllData'=>$allData]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error', 'ERROR');
					return view('employee.others.Monitoring')	;
				}
			}	
		}

		public function MonitoringRecommendationOthers(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$allDataSql = "SELECT * FROM mon_form WHERE DOHMonitoring IS NOT NULL";
					$allData = DB::select($allDataSql);
					// $test = AjaxController::getViolationDescById('AST001');
					// dd($test);

					// Getting the violations
					foreach($allData as $key => $value) {
						if($value->DOHMonitoring != "") {
							$arr = json_decode($value->DOHMonitoring, true);
							$violationCount = 0;
							// dd($allData);
							foreach($arr as $k => $v) {

								// violation count
								$length = strlen('comp');
								if(substr($k, 0, $length) === 'comp') {
									if($v != 'true') {
										$violationCount++;
									}
								}
							}

							if($violationCount > 0) {
								// violation table update
								DB::table('mon_form')
												->where('monid', '=', $value->monid)
												->update(['hasViolation'=>1]);

								DB::table('mon_form')
												->where('monid', '=', $value->monid)
												->update(['violation'=>AjaxController::getAllViolationByMonId($value->monid)]);
							}
						}
 					}

 					$allData = DB::select($allDataSql);

					return view('employee.others.MonitoringRecommendation', ['AllData'=>$allData]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error', 'ERROR');
					return view('employee.others.Monitoring')	;
				}
			}	
		}
		////// SURVEILLANCE
		public function SurveillanceOthers(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$allData = AjaxController::getAllSurveillanceForm();
					$allRec = AjaxController::getAllSurveillanceRecommendation();
					// $faciNameSql = "SELECT DISTINCT appform.appid, appform.uid, appform.facilityname FROM x08_ft LEFT JOIN appform ON appform.appid = x08_ft.appid LEFT JOIN facilitytyp ON facilitytyp.facid = x08_ft.facid";
					$faciNameSql = "SELECT appform.appid, appform.uid, appform.facilityname, appform.isApprove FROM appform WHERE isApprove IS NULL";

					$faciName = DB::select($faciNameSql);
					return view('employee.others.Surveillance', ['FacName'=>$faciName, 'AllData'=>$allData, 'AllRec'=>$allRec]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error', 'ERROR');
					return view('employee.others.Surveillance')	;
				}
			}
		}
		////// REQUEST OF ASSISTANCE
		public function RequestAssistanceOthers(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$allDataSql = "(SELECT * from complaints_form where `type` = 'Complaints') UNION (SELECT * from req_ast_form where `type` = 'Request')";
					$allData = DB::select($allDataSql);
					
					$data = AjaxController::getAllRequestForAssistance();
					$data3 = AjaxController::getAllComplaints();
					$data2 = DB::table('complaints_form')->orderBy('ref_no', 'desc')->get();
					$data1 = DB::table('req_ast_form')->orderBy('ref_no', 'desc')->get();

					$faciNameSql = "SELECT DISTINCT appform.appid, appform.uid, appform.facilityname FROM appform WHERE isApprove IS NOT NULL ORDER BY appform.appid ASC";

					$faciName = DB::select($faciNameSql);

					if(count($data1) < 1) {
						$data1 = array("ref_no"=>"0", "name_of_comp"=>"0", "age"=>"0", "civ_stat"=>"0", "address"=>"0", "gender"=>"0", "req_date"=>"0", "contact_no"=>"0", "name_of_faci"=>"0", "type_of_faci"=>"0", "address_of_faci"=>"0", "name_of_conf_pat"=>"0", "date_of_conf_pat"=>"0", "reqs"=>"0", "comps"=>"0", "signature"=>"0");
						$data1 = (object) $data1;
					}					

					if(count($data2) < 1) {
						$data2 = array("ref_no"=>"0", "name_of_comp"=>"0", "age"=>"0", "civ_stat"=>"0", "address"=>"0", "gender"=>"0", "req_date"=>"0", "contact_no"=>"0", "name_of_faci"=>"0", "type_of_faci"=>"0", "address_of_faci"=>"0", "name_of_conf_pat"=>"0", "date_of_conf_pat"=>"0", "reqs"=>"0", "comps"=>"0", "signature"=>"0");
						$data2 = (object) $data2;
					} 

					for($i=0; $i<count($allData); $i++) {
						$rtemp = explode(', ', $allData[$i]->reqs);
						$ctemp = explode(', ', $allData[$i]->comps);

						for($j=0; $j<count($rtemp); $j++) {
							for($k=0; $k<count($data); $k++) {
								if($rtemp[$j] == $data[$k]->rq_id) {
									$rtemp[$j] = $data[$k]->rq_desc;
								}
							}
						}

						for($j=0; $j<count($ctemp); $j++) {
							for($k=0; $k<count($data3); $k++) {
								if($ctemp[$j] == $data3[$k]->cmp_id) {
									$ctemp[$j] = $data3[$k]->cmp_desc;
								}
							}
						}
						$rtemp = implode(', ', $rtemp);
						$ctemp = implode(', ', $ctemp);
						$allData[$i]->reqs = $rtemp;
						$allData[$i]->comps = $ctemp;
					}


					return view('employee.others.RequestAssistance', ['ROAData'=>$data, 'CompData'=>$data3, 'FormData'=>$data1, 'FacName'=>$faciName, 'AllData'=>$allData]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error', 'ERROR');
					return view('employee.others.RequestAssistance');
				}
			}
		}
		////// COMPLAINTS
		public function ComplaintsOthers(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.others.Complaints');
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error', 'ERROR');
					return view('employee.others.Complaints')	;
				}
			}
		}
		///////////////////////////////////////////////// OTHERS
		///////////////////////////////////////////////// MANAGE
		////// GROUP RIGHTS
		public function GroupRightsManage(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllGroups();
					$data1 = AjaxController::getAllModules();
					$data2 = AjaxController::getAllGroupRights();
					// return dd($data2);
					// 'rights'=>$data2,
					return view('employee.manage.mgrouprights', [ 'groups'=>$data, 'modules'=>$data1]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.manage.mgrouprights');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('x07')->insert(['grp_id' => $request->id, 'grp_desc' => $request->name]);
					$test = DB::insert('INSERT INTO x06 (`grp_id`, `mod_id`, `allow`, `ad_d`, `upd`, `cancel`, `print`, `view`) 
								SELECT COALESCE(?), mod_id, COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1)
								FROM x05', [$request->id]);
					if ($test) {
							return "DONE";	
						} else {
							AjaxController::SystemLogs($e);
							return 'ERROR';
						}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';	
				}
			}
		}
		////// GROUP RIGHTS
		////// GROUP
		public static function GroupManage(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllGroups();
					return view('employee.manage.mgroups', ['GR' => $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.manage.mgroups');
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('x07')->insert(['grp_id' => $request->id, 'grp_desc' => $request->name]);
					$test = DB::insert('INSERT INTO x06 (`grp_id`, `mod_id`, `allow`, `ad_d`, `upd`, `cancel`, `print`, `view`) 
								SELECT COALESCE(?), mod_id, COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1), COALESCE(1)
								FROM x05', [$request->id]);
					if ($test) {
							return "DONE";	
						} else {
							AjaxController::SystemLogs($e);
							return 'ERROR';
						}
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';	
				}
			}
		}
		////// GROUP
		////// MODULE
		public static function ModuleManage(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllModules();
					return view('employee.manage.mmodules', ['Mods'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.manage.mmodules');					
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('x05')->insert(['mod_id' => $request->id, 'mod_desc' => $request->name, 'mod_lvl' => $request->lvl, 'mod_l1' => $request->lvl1, 'mod_l2' => $request->lvl2]);
					$data = DB::table('x07')->get();
					if ($data) {
							for ($i=0; $i < count($data) ; $i++) { 
								DB::table('x06')->insert(['grp_id' => $data[$i]->grp_id, 'mod_id' => $request->id, 'allow' => 1, 'ad_d' => 1, 'upd' => 1, 'cancel' => 1, 'print' => 1, 'view' => 1]);
							}
						}
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// MODULE
		////// SYSTEM USERS
		public function SystemUsersManage(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getFilteredUsers();
					$data1 = AjaxController::getFilteredTypes();
					$data2 = AjaxController::getAllRegion();
					$data3 = AjaxController::getAllFacilityGroup();
					$data4 = AjaxController::getAllTeams();
					// return dd($data);
					return view('employee.manage.msystemusers', ['users'=>$data, 'types'=>$data1, 'region'=>$data2, 'facilitys' => $data3, 'team' => $data4]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.manage.msystemusers');
					return $e;
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					$dt = Carbon::now();
		          	$dateNow = $dt->toDateString();
		          	$timeNow = $dt->toTimeString();
					$data['fname'] = $request->fname;
					$data['mname'] = $request->mname;
					$data['lname'] = $request->lname;
					$data['rgnid'] = $request->rgn;
					$data['email'] = $request->email;
					$data['cntno'] = $request->cntno;
					$data['posti'] = $request->posti;
					$data['type'] = $request->typ;
					$data['uname'] = strtoupper($request->uname);
					$data['pass'] = Hash::make($request->pass);
					$data['ip'] = request()->ip();
					$data['token'] = Str::random(40);
					$checkUser = DB::table('x08')
	                    ->where([ ['uid', '=', $data['uname']], ['pwd', '=', $data['pass']] ])
	                    ->select('*')
	                    ->first();
	                $checkEmail = DB::table('x08')->where('email', '=', $data['email'])->first();
	                if ($checkEmail) 
	                {
	                	return 'SAME_EMAIL';
	                } 
	                else 
	                {
	                	if ($checkUser) { // Check if Account Exist
	                    	return 'SAME';
	                    } 
	                    else // Check if Account Exist
	                    { 
	                    	$addedby = session()->get('employee_login');
	                    	$x = $request->mname;
	                    	if ($x != "") {
		                    	$mid = strtoupper($x[0]);
		                    	$mid = $mid.'. ';
		                    } else {
		                    	$mid = ' ';
		                    }
							$name = $request->fname.' '.$mid.''.$request->lname;
	                    	$dataToBeSend = array('name'=>$name, 'token'=>$data['token']);
				            Mail::send('mail4SystemUsers', $dataToBeSend, function($message) use ($request) {
				               $message->to($request->email, $request->facility_name)->subject
				                  ('Verify Email Account');
				               $message->from('doholrs@gmail.com','DOH Support');
				            });
							DB::table('x08')->insert(
				                [
				                    'uid' => $data['uname'],
				                    'pwd' => $data['pass'],
				                    'rgnid' => $data['rgnid'],
				                    'contact' => $data['cntno'],
				                    'position' => $data['posti'],
				                    'email' => $data['email'],
				                    'fname' => $data['fname'],
				                    'mname' => $data['mname'],
				                    'lname' => $data['lname'],
				                    'ipaddress' => $data['ip'],
				                    't_date' => $dateNow,
				                    't_time' =>$timeNow,
				                    'grpid' => $data['type'],
				                    'def_faci' => $request->defaci,
				                    'team' => $request->team,
				                    'isActive' => 1,
				                    'isAddedBy' => $addedby->uid,
				                    'token' => $data['token'],
				                ]
				            );
							return 'DONE';
						}
	                }
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}
		////// SYSTEM USERS
		////// APPLICANT ACCOUNTS
		public static function ApplicantAccountsManage(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllApplicantAccounts();
					return view('employee.manage.mapplicantaccounts', ['users' => $data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.manage.mapplicantaccounts');
				}
			}
		}
		////// APPLICANT ACCOUNTS
		////// SYSTEM LOGS
		public function SystemLogsManage(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$data = AjaxController::getAllSystemLogs();
					return view('employee.manage.msystemlogs', ['results'=>$data]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.manage.msystemlogs');
				}
			}
		}
		////// SYSTEM LOGS
		///////////////////////////////////////////////// MANAGE

		//////CASHIER
		/////////////////////////////////////////////////PROCESS FLOW
		public function cashierActions(Request $request, $appid, $facid)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$paymentMethod = DB::table('charges')->where('cat_id','PMT')->get();
					$cur_user = AjaxController::getCurrentUserAllData();
					$data = AjaxController::getAllDataEvaluateOne($appid);
					$data1 = AjaxController::getAllDataOrderOfPaymentUploads($appid ,0);
					$data2 = AjaxController::getAllDataOrderOfPaymentUploads($appid ,4);
					$data3 = AjaxController::getAllDataOrderOfPaymentUploads($appid ,2);
					$data4 = AjaxController::getAllOrderOfPayment();
					$data5 = AjaxController::getAllDataOrderOfPaymentUploads($data->aptid ,3);
					// return dd($data2);
					return view('employee.processflow.pfcashieractions',['AppData'=>$data, 'Payments' => $data1, 'Sum' => $data2, 'OOPs' =>$data4, 'Chrges' =>$data5, 'APPID' => $appid, 'loggedIn'=>$cur_user, 'appform_id'=> $appid, 'paymentMethod'=>$paymentMethod, 'aptid'=>$facid]);
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					session()->flash('system_error','ERROR');
					return view('employee.processflow.pfcashieractions');
				}
			}

			
			if ($request->isMethod('post')) 
			{
				try 
				{
					$Cur_useData = AjaxController::getCurrentUserAllData();
			  		$getData = DB::table('chg_app')->where('chgapp_id', '=', $request->id)->select('chg_num')->first();
			  		$test = DB::table('chgfil')->insert([
			  						'chgapp_id' => $request->id,
			  						'chg_num' => $getData->chg_num,
			  						'appform_id' => $request->appid,
			  						'reference' => $request->desc,
			  						'amount' => $request->amount,
			  						't_date' => $Cur_useData['date'],
			  						't_time' => $Cur_useData['time'],
			  						't_ipaddress' => $Cur_useData['ip'],
			  						'uid' => $Cur_useData['cur_user'],
			  						'sysdate' => $Cur_useData['date'],
			  						'systime' => $Cur_useData['time'],
			  					]);
			  		$upd = array('chg_num'=>(intval($getData->chg_num) + 1));
			  		$test2 = DB::table('chg_app')->where('chgapp_id', '=', $request->id)->update($upd);
			  		return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e);
					return 'ERROR';
				}
			}
		}

		public function chAction(Request $request){
			if($request->action == 'delete'){
				if(DB::table('chgfil')->where('id',$request->id)->delete()){
					return 'SUCCESS';
				} else {
					return "no";
				}
			} else {
				if($request->action == 'edit'){
					$update = array("ORRef"=>$request->or, "depositNum"=>$request->slip, "otherRef"=>$request->ref,"amount"=>$request->amt);
					if(DB::table('chgfil')->where('id',$request->id)->update($update)){
						return "SUCCESS";
					} else {
						return "ERROR";
					}
				}
			}
		}

		public function savePayment(Request $request)
		{
			// dd($request->all());
			$filename = null;
			if($request->hasFile('attFile')){
				$filename = strtotime('now').$request->attFile->getClientOriginalName();
				$request->attFile->storeAs('public/uploaded/', $filename);
			}
			DB::table('chg_app')->insert([
				'chg_num' => 1,
				'chgopp_seq' => 1,
				'chg_code' => 'MOP-001',
				'amt' => 0,
				'aptid' =>$request->aptid,
				'remarks' => 'Payment'
			]);
			$id = DB::getPdo()->lastInsertId();
			if($id){
				if(DB::table('chgfil')->where('uid',$request->appid)->insert(['amount' => $request->aPaid, 'otherRef'=>$request->otherRef, 'depositNum'=>$request->slipNum, 'ORRef'=>$request->orRef, 'paymentMode'=> $request->mPay, 'attachedFile'=>$filename, 'recievedBy'=>$request->userID, 'paymentDate'=>date("Y-m-d",strtotime($request->pDate)), 'appform_id'=>$request->appform_idSubmit,'reference'=>'Payment','chgapp_id'=>$id])){
					return redirect('employee/dashboard/processflow/actions/'.$request->appform_idSubmit.'/'.$request->aptid);
				}
			}
		}

	}
 ?>