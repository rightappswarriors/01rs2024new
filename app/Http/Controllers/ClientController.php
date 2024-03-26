<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Session;
use Exception;
use Illuminate\Support\Str;
use AjaxController;
class ClientController extends Controller {
	public static $facid_cur = true;
	public function __index(Request $request) {
		try {
			// $uData = Session::get('uData');
			$uData = session()->get('uData');
			$bAds = DB::table('barangay')->select('*')->get(); $cAds = DB::table('city_muni')->select('*')->get(); $pAds = DB::table('province')->select('*')->get(); $rAds = DB::table('region')->select('*')->get(); $hAds = DB::table('facilitytyp')->select('*')->get(); $fAds = DB::table('hfaci_grp')->select('*')->get(); $ffAds = DB::table('facmode')->select('*')->get();
			if($request->isMethod('get')){
				if($uData != null) {
					return redirect()->route('client.home');
				} else {
					$sLg = array('cmpLoc'=>['bAds'=>$bAds, 'cAds'=>$cAds, 'pAds'=>$pAds, 'rAds'=>$rAds, 'hAds'=>$hAds, 'fAds'=>$fAds, 'ffAds'=>$ffAds]);
					if((Session::has('errMsg') && Session::has('errAlt'))) {
						$sLg = ['errMsg'=>Session::get('errMsg'), 'errAlt'=>Session::get('errAlt'), 'cmpLoc'=>['bAds'=>$bAds, 'cAds'=>$cAds, 'pAds'=>$pAds, 'rAds'=>$rAds, 'hAds'=>$hAds, 'fAds'=>$fAds, 'ffAds'=>$ffAds]];
						if((Session::has('locHref'))) {
							$sLg = ['errMsg'=>Session::get('errMsg'), 'errAlt'=>Session::get('errAlt'), 'locHref'=>Session::get('locHref'), 'cmpLoc'=>['bAds'=>$bAds, 'cAds'=>$cAds, 'pAds'=>$pAds, 'rAds'=>$rAds, 'hAds'=>$hAds, 'fAds'=>$fAds, 'ffAds'=>$ffAds]];
							Session::forget('locHref');
						}
						Session::forget('errMsg'); Session::forget('errAlt');
					}
					return view('client.login', $sLg);
				}
			} else {	
				// dd($request->all());
				$arrSave = array(); $arrStr = array();
				$arrData = ['uid', 'pwd', 'facilityname', 'facility_type', 'bed_capacity', 'authorizedsignature', 'email', 'contactperson', 'contactpersonno', 'houseno', 'streetname', 'barangay', 'city_muni', 'province', 'zipcode', 'rgnid_address', 'rgnid', 'grpid', 'mapcoordinate', 'ipaddress', 't_date', 't_time', 'fname', 'mname', 'lname', 'contact', 'position', 'def_faci', 'isActive', 'team', 'isAddedBy', 'token', 'facmid'];
				$validateArr = [];
				for($i = 0; $i < count($arrData); $i++) {
					$objStr = 'text'.$i;
					if(isset($request->$objStr)) {
						array_push($arrSave, (($i != 1) ? $request->$objStr : Hash::make($request->$objStr)));
						array_push($validateArr, 'required');
						array_push($arrStr, $arrData[$i]);
					}
				}
				if($arrData[0] != $arrStr[0]) {
					return view('client.login', ['errMsg'=>'Some information(s) are missing!', 'errAlt'=>'danger', 'cmpLoc'=>['bAds'=>$bAds, 'cAds'=>$cAds, 'pAds'=>$pAds, 'rAds'=>$rAds, 'hAds'=>$hAds, 'fAds'=>$fAds, 'ffAds'=>$ffAds]]);
				} else {
					$chkQry = DB::table('x08')->where('uid', '=', $arrSave[0])->select('uid')->get();
					if(count($chkQry) > 0) {
						return view('client.login', ['errMsg'=>'User already exists!', 'errAlt'=>'warning', 'cmpLoc'=>['bAds'=>$bAds, 'cAds'=>$cAds, 'pAds'=>$pAds, 'rAds'=>$rAds, 'hAds'=>$hAds, 'fAds'=>$fAds, 'ffAds'=>$ffAds]]);
					} else {
						$sData = array('name'=>$request->text2,'token'=>$request->text31);
						self::sMailVer($sData, $request);
						if(DB::table('x08')->insert(array_combine($arrStr, $arrSave))) {
							if(isset($request->facid)) {
								if(count($request->facid) > 0) {
									foreach($request->facid AS $facid) {
										DB::table('x08_ft')->insert(['uid'=>$request->text0, 'facid'=>$facid]);
									}
								}
							}
							return view('client.login', ['errMsg'=>'Successfully registered account. Please check your email for verifying this account.', 'errAlt'=>'success', 'cmpLoc'=>['bAds'=>$bAds, 'cAds'=>$cAds, 'pAds'=>$pAds, 'rAds'=>$rAds, 'hAds'=>$hAds, 'fAds'=>$fAds, 'ffAds'=>$ffAds]]);
						} else {
							return view('client.login', ['errMsg'=>'Error on saving entry', 'errAlt'=>'danger', 'cmpLoc'=>['bAds'=>$bAds, 'cAds'=>$cAds, 'pAds'=>$pAds, 'rAds'=>$rAds, 'hAds'=>$hAds, 'fAds'=>$fAds, 'ffAds'=>$ffAds]]);
						}
					}
				}
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured. Index');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.login');
		}
	}
	public function __login(Request $request) {
		try {
			// $uData = Session::get('uData');
			$uData = session()->get('uData');
			if($request->isMethod('get')) {
				if($uData != null) {
					return redirect()->route('client.home');
				} else {
					return redirect()->route('client.login');
				}
			} else {
				$chkQry = DB::table('x08')->where([['uid', $request->uid], ['grpid', 'C']])->select('*')->first();
				if($chkQry != null) {
					$bol_stat = Hash::check($request->pwd, $chkQry->pwd);
					if($bol_stat == true) {
						if($chkQry->token != null) {
							Session::put('errMsg', 'Account not verified. To resend verification, click');
							Session::put('errAlt', 'warning');
							// Session::put('locHref', $chkQry->uid);
							session()->put('locHref', $chkQry->uid);
							return redirect()->route('client.login');
						} else {
							Session::put('uData', $chkQry);
							return redirect()->route('client.home');
						}
					} else {
						Session::put('errMsg', 'Incorrect password.');
						Session::put('errAlt', 'danger');
						return redirect()->route('client.login');
					}
				} else {
					Session::put('errMsg', 'Incorrect username.');
					Session::put('errAlt', 'danger');
					return redirect()->route('client.login');
				}
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured. Login');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.login');
		}
	}
	public function __logout(Request $request) {
		try {
			// $uData = Session::get('uData');
			$uData = session()->get('uData');
			if($uData != null) {
				if($request->isMethod('get')) {
					// Session::forget('uData');
					// Session::flush();
					session()->flush();
					return redirect()->route('client.login');
				} else {
				}
			} else {
				return redirect()->route('client.login');
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured.');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.login');
		}
	}
	public function __home(Request $request) {
		try {
			// $uData = Session::get('uData');
			$uData = session()->get('uData');
			if($request->isMethod('get')) {
				if($uData != null) {
					Session::put('facid_cur', $uData->facility_type);
					$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
					
					$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
					$_retData = ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'facid_cur'=>static::$facid_cur, 'forCurUserFac_'=>DB::select($subFacSql), 'curPage'=>'home', 'lsApl'=>DB::table('appform')->where('uid', '=', $uData->uid)->select('*')->orderBy('t_date', 'desc')->first()];
					if((Session::has('errMsg') && Session::has('errAlt'))) {
						$errMsg = Session::get('errMsg'); $errAlt = Session::get('errAlt');
						Session::forget('errMsg'); Session::forget('errAlt');
						$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
						$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
						$_retData = ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'curPage'=>'home', 'lsApl'=>DB::table('appform')->where('uid', '=', $uData->uid)->select('*')->orderBy('t_date', 'desc')->first(), 'errMsg'=>$errMsg, 'errAlt'=>$errAlt];
					}
					return view('client.home', $_retData);
				} else {
					return redirect()->route('client.login');
				}
			} else {
				if(isset($request->facid_cur)) {
					Session::put('facid_cur', $request->facid_cur);
					return redirect()->route('client.home');
				}
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured. Home');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	public function __rToken(Request $request, $token) {
		try {
			if($request->isMethod('get')) {
				$chkQry = DB::table('x08')->where('token', '=', $token)->select('*')->first();
				if($chkQry != null) {
					DB::table('x08')->where('token', '=', $token)->update(['token'=>NULL]);
					Session::put('errMsg', 'Successfully verified account.');
					Session::put('errAlt', 'success');
					return redirect()->route('client.login');
				} else {
					Session::put('errMsg', 'Error on verifying account. Token must be expired.');
					Session::put('errAlt', 'warning');
					// Session::put('locHref', $chkQry->uid);
					return redirect()->route('client.login');
				}
			} else {
				return redirect()->route('client.login');
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured.');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	public function __rMail(Request $request, $uid) {
		try {
			if($request->isMethod('get')) {
				$nToken = Str::random(40);
				$chkQry = DB::table('x08')->where('uid', '=', $uid)->select('*')->first();
				if($chkQry != null) {
					$dRequest = new \stdClass();
					$dRequest->text2 = $chkQry->facilityname;
					$dRequest->text6 = $chkQry->email;
					$sData = array('name'=>$chkQry->facilityname,'token'=>$nToken);
					self::sMailVer($sData, $dRequest);
					DB::table('x08')->where('uid', '=', $uid)->update(['token'=>$nToken]);
					Session::put('errMsg', 'Successfully sent verification to your account.');
					Session::put('errAlt', 'success');
					return redirect()->route('client.login');
				}
			} else {
				return redirect()->route('client.login');
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured.');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	public function sMailVer($sData, $request) {
		try {
			Mail::send('client.mail', $sData, function($message) use ($request) {
	           	$message->to($request->text6, $request->text2)->subject('Verify Email Account');
	           	$message->from('doholrs@gmail.com','DOH Support');
	        });
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured.');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	// apply
	public function __applyForm(Request $request) {
		try {
			$apdForm = []; // $uData = Session::get('uData');
			$uData = session()->get('uData'); $_today = Carbon::now(); 
			if(isset(static::$facid_cur)) {
				if($uData != null) {
					if($request->isMethod('get')) {
						// Session::forget('apHfd'); Session::forget('apFApt');
						$hfserQry = "SELECT h.hfser_id, h.hfser_desc, a.aptid, a.aptdesc, a.trns_desc FROM (SELECT * FROM hfaci_serv_type WHERE (isSub IS NULL OR isSub = '')) h LEFT JOIN (SELECT a.hfser_id, a.uid, t.trns_desc, ap.aptdesc, ap.aptid FROM (SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE uid = '$uData->uid' GROUP BY hfser_id, uid) a)) a LEFT JOIN trans_status t ON a.status = t.trns_id LEFT JOIN apptype ap ON ap.aptid = a.aptid) a ON a.hfser_id = h.hfser_id ORDER BY h.seq_num ASC";
						$hfserTbl = DB::select($hfserQry);
						$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
						$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
						
						return view('client.apply', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'hfserTbl'=>$hfserTbl]);
					} else {
						if(isset($request->apBtn)) {
							Session::put('apHfd', $request->apHfd);
							// Session::forget('apFApt');
							$apHfd = $request->apHfd; $apApt = $request->apApt; $nApApt = (($apApt == NULL || $apApt == "") ? "SELECT aptid FROM apptype WHERE apt_reqid IS NULL" : "SELECT aptid FROM apptype WHERE COALESCE(apt_reqid, aptid) IN (SELECT aptid FROM apptype WHERE apt_seq <= (SELECT apt_seq FROM apptype WHERE aptid = '$apApt'))");
							$aptSql = "SELECT ap.*, _at.aptid AS _disabled, _ap.ap_count FROM apptype ap LEFT JOIN ($nApApt) _at ON ap.aptid = _at.aptid LEFT JOIN (SELECT _at.aptid, COUNT(aps.appid) AS ap_count FROM (SELECT CONCAT('$uData->uid', '_', '$apHfd', '_', aptid) AS appid, aptid FROM apptype WHERE apt_reqAst = 1) _at LEFT JOIN (SELECT * FROM app_assessment WHERE ((complied IS NOT NULL OR complied != '0')    )) aps ON aps.appid = _at.appid GROUP BY _at.aptid) _ap ON ap.aptid = _ap.aptid ORDER BY ap.apt_seq ASC"; // AND fileName IS NOT NULL
							$aHSql = "SELECT hf.hfser_desc, ap.aptdesc FROM (SELECT hfser_desc FROM hfaci_serv_type WHERE hfser_id = '$apHfd') hf LEFT JOIN (SELECT aptdesc FROM apptype WHERE aptid = '$apApt') ap ON 1=1";
							$pDApf = "SELECT _p.* FROM personnel _p WHERE _p.appid IN (CONCAT('$uData->uid', '_', '$apHfd'))";
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$apAsmtChkSql = "SELECT assessment.* FROM assessment INNER JOIN (SELECT * FROM facassessment WHERE facid = '$uData->facility_type') facassessment ON facassessment.asmt_id = assessment.asmt_id ORDER BY partid, asmt_id ASC"; $apAsmtChk = DB::select($apAsmtChkSql);
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							$anotheraptTbl = DB::select("SELECT hfaci_serv_type.hfser_id, hfaci_serv_type.hfser_desc, (CASE WHEN bool = true THEN appform.appid ELSE false END) AS taken FROM hfaci_serv_type LEFT JOIN (SELECT hfser_id, true AS bool, appid FROM appform WHERE uid = '$uData->uid') appform ON appform.hfser_id = hfaci_serv_type.hfser_id WHERE isSub = '$apHfd'");
							if(count($anotheraptTbl) > 0) {
								$hfserQry = "SELECT h.hfser_id, h.hfser_desc, a.aptid, a.aptdesc, a.trns_desc FROM (SELECT * FROM hfaci_serv_type WHERE isSub = '$apHfd') h LEFT JOIN (SELECT a.hfser_id, a.uid, t.trns_desc, ap.aptdesc, ap.aptid FROM (SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE uid = '$uData->uid' GROUP BY hfser_id, uid) a)) a LEFT JOIN trans_status t ON a.status = t.trns_id LEFT JOIN apptype ap ON ap.aptid = a.aptid) a ON a.hfser_id = h.hfser_id ORDER BY h.seq_num ASC";
								$hfserTbl = DB::select($hfserQry);
								return view('client.apply', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'hfserTbl'=>$hfserTbl]);
							}
							return view('client.apply', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'aptTbl'=>DB::select($aptSql), 'aHTbl'=>DB::select($aHSql), 'pDApf'=>DB::select($pDApf), 'tlAsmtTbl'=>$apAsmtChk, 'anotheraptTbl'=>$anotheraptTbl]);
						} elseif(isset($request->apFApt)) {
							Session::put('apFApt', $request->apFApt); $apFApt = Session::get('apFApt'); $apHfd = Session::get('apHfd'); $apFTblC = DB::table('apptype')->where('aptid', '=', $apFApt)->select('*')->first(); $upApfTbl = []; $drApfTbl = []; $_retData = []; $apAsmtTbl = []; $apAsmtChkSql = "SELECT assessment.* FROM assessment INNER JOIN (SELECT * FROM facassessment WHERE facid = '$uData->facility_type') facassessment ON facassessment.asmt_id = assessment.asmt_id ORDER BY partid, asmt_id ASC"; $apAsmtChk = DB::select($apAsmtChkSql); $app_Id = "";
							$upApfDSql = "SELECT u.* FROM `upload` u INNER JOIN (SELECT * FROM `facility_requirements` fr INNER JOIN (SELECT * FROM `type_facility` WHERE hfser_id = '$apHfd' AND facid = '$uData->facility_type') tf ON fr.typ_id = tf.tyf_id) ru ON u.upid = ru.upid ORDER BY u.updesc ASC"; $upApfNSql = "$upApfDSql";
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$upApfSql_c = "SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE uid = '$uData->uid' AND hfser_id = '$apHfd' AND aptid = '$apFApt' GROUP BY hfser_id, uid) a)"; $upApfSql_cTbl = DB::select($upApfSql_c);
							$upApfSql = "SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE uid = '$uData->uid' AND hfser_id = '$apHfd' AND aptid = '$apFTblC->apt_isUpdateTo' GROUP BY hfser_id, uid) a)"; $upApfTbl = DB::select(((count($upApfSql_cTbl) > 0) ? $upApfSql_c : $upApfSql));
							$_newApid = $uData->uid.'_'.$apHfd.'_'.$apFApt;
							$apAsmtSql = "SELECT * FROM `app_assessment` WHERE (appid = '$_newApid') AND ((complied IS NOT NULL OR complied != '0')   )"; // AND fileName IS NOT NULL
							$apAsmtExt = "SELECT _as.*, _ap.asmt_id AS asmt_ext, _ap.appid, _ap.app_assess_id, _ap.isapproved, _ap.remarks, _ap.t_date, _ap.t_time, _ap.complied, _ap.fileName FROM (SELECT assessment.* FROM assessment INNER JOIN (SELECT * FROM facassessment WHERE facid = '$uData->facility_type') facassessment ON facassessment.asmt_id = assessment.asmt_id ORDER BY partid, asmt_id ASC) _as LEFT JOIN (SELECT * FROM app_assessment WHERE appid = '$_newApid') _ap ON _as.asmt_id = _ap.asmt_id"; // SELECT _as.*, NULL AS asmt_ext, NULL AS appid, NULL AS app_assess_id, NULL AS isapproved, NULL AS remarks, NULL AS t_date, NULL AS t_time, NULL AS draft, NULL AS complied, NULL AS fileName FROM (SELECT * FROM assessment WHERE facid ='$uData->facility_type') _as
							$drApfTbl = [];
							$drApfSql = "SELECT * FROM appform WHERE uid = '$uData->uid' AND hfser_id = '$apHfd' AND aptid IN ('$apFApt')";
							$drApfTbl = DB::select($drApfSql);
							if(count($upApfTbl) > 0) {
								$app_Id = $upApfTbl[0]->appid;
								if($apFTblC->apt_isUpdateTo != NULL) {
									$upApfNSql = "SELECT up.*, ap.filepath, ap.t_date, ap.t_time, ap.evaluation, ap.evaldate, ap.evaltime FROM ($upApfDSql) up LEFT JOIN (SELECT * FROM app_upload WHERE apup_id IN (SELECT aup.apup_id FROM (SELECT MAX(apup_id) AS apup_id, upid FROM app_upload WHERE app_id = '$app_Id' GROUP BY upid) aup)) ap ON up.upid = ap.upid";
								}
							}
							$apAsmtTbl = DB::select($apAsmtSql);
							$newPartTbl = "SELECT * FROM part WHERE partid IN (SELECT _p.partid FROM ($apAsmtExt) _p)";
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							// dd($upApfNSql);
							$_retData = ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'apFTbl'=>[$apFTblC, DB::table('hfaci_serv_type')->where('hfser_id', '=', $apHfd)->select('*')->first()], 'subUser'=>DB::select($subUserSql), 'clTbl'=>DB::table('class')->where(function($query) { $query->whereNull('isSub')->orWhere('isSub', '=', ''); })->select('*')->get(), 'subClTbl'=>DB::table('class')->where(function($query) { $query->whereNotNull('isSub')->orWhere('isSub', '!=', ''); })->select('*')->get(), 'owTbl'=>DB::table('ownership')->select('*')->get(), 'upApfTbl'=>$upApfTbl, 'apUpApfTbl'=>DB::select($upApfNSql), 'drApfTbl'=>$drApfTbl, 'isView'=>false, 'app_Id'=>$_newApid, 'funcTbl'=>DB::table('funcapf')->select('*')->get()];
							// if($apFTblC->apt_reqAst == 1) {
							// 	if(count($apAsmtTbl) < count($apAsmtChk)) {
							// 		$_retData = ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'asmtApply'=>DB::select($apAsmtExt), 'partTbl'=>DB::select($newPartTbl), 'isView'=>false, 'app_Id'=>$_newApid, 'funcTbl'=>DB::table('funcapf')->select('*')->get()];
							// 	}
							// }
							return view('client.apply', $_retData);
						} elseif(isset($request->asmtApt)) {
							Session::put('apFApt', $request->asmtApt); $apFApt = Session::get('apFApt'); $apHfd = Session::get('apHfd'); $apFTblC = DB::table('apptype')->where('aptid', '=', $apFApt)->select('*')->first(); $upApfTbl = []; $drApfTbl = []; $_retData = []; $apAsmtTbl = []; $apAsmtChkSql = "SELECT assessment.* FROM assessment INNER JOIN (SELECT * FROM facassessment WHERE facid = '$uData->facility_type') facassessment ON facassessment.asmt_id = assessment.asmt_id ORDER BY partid, asmt_id ASC"; $apAsmtChk = DB::select($apAsmtChkSql); $app_Id = "";
							$upApfDSql = "SELECT u.* FROM `upload` u INNER JOIN (SELECT * FROM `facility_requirements` fr INNER JOIN (SELECT * FROM `type_facility` WHERE hfser_id = '$apHfd' AND facid = '$uData->facility_type') tf ON fr.typ_id = tf.tyf_id) ru ON u.upid = ru.upid ORDER BY u.updesc ASC"; $upApfNSql = "$upApfDSql";
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$upApfSql_c = "SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE uid = '$uData->uid' AND hfser_id = '$apHfd' AND aptid = '$apFApt'  GROUP BY hfser_id, uid) a)"; $upApfSql_cTbl = DB::select($upApfSql_c);
							$upApfSql = "SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE uid = '$uData->uid' AND hfser_id = '$apHfd' AND aptid = '$apFTblC->apt_isUpdateTo' AND GROUP BY hfser_id, uid) a)"; $upApfTbl = DB::select(((count($upApfSql_cTbl) > 0) ? $upApfSql_c : $upApfSql));
							$_newApid = $uData->uid.'_'.$apHfd.'_'.$apFApt;
							$apAsmtSql = "SELECT * FROM `app_assessment` WHERE (appid = '$_newApid') AND((complied IS NOT NULL OR complied != '0')   )";
							$apAsmtExt = "SELECT _as.*, _ap.asmt_id AS asmt_ext, _ap.appid, _ap.app_assess_id, _ap.isapproved, _ap.remarks, _ap.t_date, _ap.t_time, _ap.complied, _ap.fileName FROM (SELECT assessment.* FROM assessment INNER JOIN (SELECT * FROM facassessment WHERE facid = '$uData->facility_type') facassessment ON facassessment.asmt_id = assessment.asmt_id ORDER BY partid, asmt_id ASC) _as LEFT JOIN (SELECT * FROM app_assessment WHERE appid = '$_newApid') _ap ON _as.asmt_id = _ap.asmt_id";
							$drApfTbl = [];
							$drApfSql = "SELECT * FROM appform WHERE uid = '$uData->uid' AND hfser_id = '$apHfd' AND aptid IN ('$apFApt') ";
							$drApfTbl = DB::select($drApfSql);
							if(count($upApfTbl) > 0) {
								$app_Id = $upApfTbl[0]->appid;
								if($apFTblC->apt_isUpdateTo != NULL) {
									$upApfNSql = "SELECT up.*, ap.filepath, ap.t_date, ap.t_time, ap.evaluation, ap.evaldate, ap.evaltime FROM ($upApfDSql) up LEFT JOIN (SELECT * FROM app_upload WHERE apup_id IN (SELECT aup.apup_id FROM (SELECT MAX(apup_id) AS apup_id, upid FROM app_upload WHERE app_id = '$app_Id' GROUP BY upid) aup)) ap ON up.upid = ap.upid";
								}
							}
							$apAsmtTbl = DB::select($apAsmtSql);
							$newPartTbl = "SELECT * FROM part WHERE partid IN (SELECT _p.partid FROM ($apAsmtExt) _p)";
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							$_retData = ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'apFTbl'=>[$apFTblC, DB::table('hfaci_serv_type')->where('hfser_id', '=', $apHfd)->select('*')->first()], 'subUser'=>DB::select($subUserSql), 'clTbl'=>DB::table('class')->where(function($query) { $query->whereNull('isSub')->orWhere('isSub', '=', ''); })->select('*')->get(), 'subClTbl'=>DB::table('class')->where(function($query) { $query->whereNotNull('isSub')->orWhere('isSub', '!=', ''); })->select('*')->get(), 'owTbl'=>DB::table('ownership')->select('*')->get(), 'upApfTbl'=>$upApfTbl, 'apUpApfTbl'=>DB::select($upApfNSql), 'drApfTbl'=>$drApfTbl, 'isView'=>false, 'app_Id'=>$_newApid, 'funcTbl'=>DB::table('funcapf')->select('*')->get()];
							// if($apFTblC->apt_reqAst == 1) {
							// 	// if(count($apAsmtTbl) < count($apAsmtChk)) {
							// 		$_retData = ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'asmtApply'=>DB::select($apAsmtExt), 'partTbl'=>DB::select($newPartTbl), 'isView'=>false, 'app_Id'=>$_newApid, 'funcTbl'=>DB::table('funcapf')->select('*')->get()];
							// 	// }
							// }
							return view('client.apply', $_retData);
						} elseif(isset($request->__upDraft)) {
							// dd($request->all());
							$apHfd = Session::get('apHfd'); $apFApt = Session::get('apFApt'); $apFTblC = DB::table('apptype')->where('aptid', '=', $apFApt)->select('*')->first(); 
							$arrData = ['uid', 'facilityname', 'serv_capabilities', 'owner', 'email', 'contact', 'rgnid', 'provid', 'cmid', 'brgyid', 'hfser_id', 'facid', 'ocid', 'ocdesc', 'aptid', 'classid', 'classdesc', 'subClassid', 'subClassdesc', 'funcid', 'facmode', 'noofbed', 'draft', 't_date', 't_time', 'ipaddress', 'assignedRgn', 'status'];
							$arrSave = [$uData->uid, $request->facilityname_s, $request->servicecapabilities_s, $request->owner_s, $request->email_s, $request->contact_s, $request->region_s, $request->province_s, $request->city_s, $request->barangay_s, $apHfd, $request->facilitytype_s, $request->owTbl_s, $request->owTbl, $apFApt, $request->clTbl_s, $request->clTbl, $request->subClTbl_s, $request->subClTbl, $request->funcId, $request->facMode, $request->bed_s, $request->drafts, $_today->toDateString(), $_today->toTimeString(), request()->ip(), $uData->rgnid, 'P'];
							$_newApid_s = $uData->uid.'_'.$apHfd.'_'.$apFApt;
							$upApfSql_c = "SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE uid = '$uData->uid' AND hfser_id = '$apHfd' AND aptid = '$apFApt' GROUP BY hfser_id, uid) a)"; $upApfSql_cTbl = DB::select($upApfSql_c);
							$upApfSql = "SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE uid = '$uData->uid' AND hfser_id = '$apHfd' AND aptid = '$apFTblC->apt_isUpdateTo' GROUP BY hfser_id, uid) a)";
							$returnData = "";
							if(DB::table('appform')->insert(array_combine($arrData, $arrSave))) {
								$_curApid = DB::table('appform')->where('uid', '=', $uData->uid)->where('hfser_id', '=', $apHfd)->where('aptid', '=', $apFApt)->orderBy('t_date', 'desc')->orderBy('t_time', 'desc')->select('*')->first();
								// DB::table('app_assessment')->where('appid', '=', $_newApid_s)->update(['appid'=>$_curApid->appid]);
								// dd($request->servicecapabilities_s1);
								if($apHfd == "PTC") {
									DB::table('ptc')->where('appid', $_curApid->appid)->delete();
									$arr_Data = ['appid', 'type', 'propbedcap', 'propstation', 'incbedcapfrom', 'incbedcapto', 'incstationfrom', 'incstationto', 'construction_description'];
									$arr_Save = [$_curApid->appid, $request->type, $request->propbedcap, $request->propstation, $request->incbedcapfrom, $request->incbedcapto, $request->incstationfrom, $request->incstationto, $request->construction_description];
									DB::table('ptc')->insert(array_combine($arr_Data, $arr_Save));
								}
								if(isset($request->servicecapabilities_s1)) {
									if(count($request->servicecapabilities_s1) > 0) {
										$_masterArr = [];
										DB::table('x08_ft')->where('appid', '=', $_curApid->appid)->delete();
										foreach($request->servicecapabilities_s1 AS $service1) {
											$_arrData = ['uid', 'appid', 'facid'];
											$_arrSave = [$uData->uid, $_curApid->appid, $service1];
											array_push($_masterArr, array_combine($_arrData, $_arrSave));
										}
										if(DB::table('x08_ft')->insert($_masterArr)) {
											$upApfDSql = "SELECT u.* FROM `upload` u INNER JOIN (SELECT * FROM `facility_requirements` fr INNER JOIN (SELECT * FROM `type_facility` WHERE hfser_id = '$apHfd' AND facid IN (SELECT hgpid FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE appid = '$_curApid->appid'))) tf ON fr.typ_id = tf.tyf_id) ru ON u.upid = ru.upid ORDER BY u.updesc ASC"; $upApfNSql = "$upApfDSql";
											$upApfTbl = DB::select(((count($upApfSql_cTbl) > 0) ? $upApfSql_c : $upApfSql));
											if(count($upApfTbl) > 0) {
												$app_Id = $upApfTbl[0]->appid;
												$upApfNSql = "SELECT up.*, ap.filepath, ap.t_date, ap.t_time, ap.evaluation, ap.evaldate, ap.evaltime, ap.app_id, ap.fileExten, ap.fileSize, ap.ipaddress FROM ($upApfDSql) up LEFT JOIN (SELECT * FROM app_upload WHERE apup_id IN (SELECT aup.apup_id FROM (SELECT MAX(apup_id) AS apup_id, upid FROM app_upload WHERE app_id = '$app_Id' GROUP BY upid) aup)) ap ON up.upid = ap.upid";
											}
											$upApfNRun = DB::select($upApfNSql);
											$apUpData = ['app_id', 'upid', 'filepath', 'fileExten', 'fileSize', 't_date', 't_time', 'ipaddress'];
											if(count($upApfNRun) > 0) {
												for($i = 0; $i < count($upApfNRun); $i++) {
													$apUpSave = [];
													if(isset($request->upid[$upApfNRun[$i]->upid])) {
														$_file = $request->upid[$upApfNRun[$i]->upid];
														$filename = $_file->getClientOriginalName(); 
										                $filenameOnly = pathinfo($filename,PATHINFO_FILENAME); 
										                $fileExtension = $_file->getClientOriginalExtension();
										                $fileNameToStore = $uData->uid.'_'.(($_curApid != NULL) ? $_curApid->appid : "NEW").''.$upApfNRun[$i]->upid.'.'.$fileExtension;
										                $path = $_file->storeAs('public/uploaded', $fileNameToStore);
										                $fileSize = $_file->getClientSize();
														$apUpSave = [(($_curApid != NULL) ? $_curApid->appid : NULL), $upApfNRun[$i]->upid, $fileNameToStore, $fileExtension, $fileSize, $_today->toDateString(), $_today->toTimeString(), request()->ip()];
													} else {
														if(isset($upApfNRun[$i]->filepath)) {
															if($upApfNRun[$i]->filepath != NULL) {
																$apUpSave = [(($_curApid != NULL) ? $_curApid->appid : NULL), $upApfNRun[$i]->upid, $upApfNRun[$i]->filepath, $upApfNRun[$i]->fileExten, $upApfNRun[$i]->fileSize, $upApfNRun[$i]->t_date, $upApfNRun[$i]->t_time, $upApfNRun[$i]->ipaddress];
															}
														} else {
															$apUpSave = [(($_curApid != NULL) ? $_curApid->appid : NULL), $upApfNRun[$i]->upid, NULL, NULL, NULL, $_today->toDateString(), $_today->toTimeString(), request()->ip()];
														}
													}
													if(count($apUpSave) == count($apUpData)) {
														DB::table('app_upload')->insert(array_combine($apUpData, $apUpSave));
													}
												}
											}
											Session::put('appid', array($uData->uid => $_curApid->appid));
											Session::put('errMsg', "Successfully saved file.");
											Session::put('errAlt', "success");
											return redirect()->route('client.cpayment');
										} else {
											Session::put('errMsg', "Error on saving file.");
											Session::put('errAlt', "danger");
											return redirect()->route('client.home');
										}
									} else {
										Session::put('errMsg', "No Service Capabilities");
										Session::put('errAlt', "danger");
										return redirect()->route('client.home');
									}
								} else {
									Session::put('errMsg', "No Service Capabilities");
									Session::put('errAlt', "warning");
									return redirect()->route('client.home');
								}
							} else {
								Session::put('errMsg', "Error on saving file.");
								Session::put('errAlt', "warning");
								return redirect()->route('client.home');
							}
							return redirect()->route($returnData);
						} elseif(isset($request->drApfApid)) {
							$apHfd = Session::get('apHfd'); $apFApt = Session::get('apFApt'); $apFTblC = DB::table('apptype')->where('aptid', '=', $apFApt)->select('*')->first(); $upApfTbl = []; $drApfTbl = [];
							$upApfDSql = "SELECT u.* FROM `upload` u INNER JOIN (SELECT * FROM `facility_requirements` fr INNER JOIN (SELECT * FROM `type_facility` WHERE hfser_id = '$apHfd' AND facid = '$uData->facility_type') tf ON fr.typ_id = tf.tyf_id) ru ON u.upid = ru.upid ORDER BY u.updesc ASC"; $upApfNSql = "$upApfDSql";
							$upApfSql_c = "SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE appid = '$request->drApfApid' GROUP BY hfser_id, uid) a)";
							$upApfSql_cTbl = DB::select($upApfSql_c);
							$upApfSql = "SELECT * FROM appform WHERE appid IN (SELECT a.appid FROM (SELECT hfser_id, MAX(t_date) AS t_date, uid, MAX(appid) AS appid FROM appform WHERE appid = '$request->drApfApid' GROUP BY hfser_id, uid) a)";
							$upApfTbl = DB::select(((count($upApfSql_cTbl) > 0) ? $upApfSql_c : $upApfSql));
							if(count($upApfTbl) > 0) {
								$app_Id = $upApfTbl[0]->appid;
								$_inApid = "'$apFApt'";
								if(isset($apFTblC->apt_isUpdateTo)) {
									$_inApid = "'$apFTblC->apt_isUpdateTo', '$apFApt'";
								}
								$upApfNSql = "SELECT up.*, ap.filepath, ap.t_date, ap.t_time, ap.evaluation, ap.evaldate, ap.evaltime FROM ($upApfDSql) up LEFT JOIN (SELECT * FROM app_upload WHERE apup_id IN (SELECT aup.apup_id FROM (SELECT MAX(apup_id) AS apup_id, upid FROM app_upload WHERE app_id = '$app_Id' GROUP BY upid) aup)) ap ON up.upid = ap.upid";
								$drApfSql = "SELECT * FROM appform WHERE uid = '$uData->uid' AND hfser_id = '$apHfd' AND aptid IN ($_inApid) appid != '$app_Id'";
								$drApfTbl = DB::select($drApfSql);
							}
							
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							return view('client.apply', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'apFTbl'=>[$apFTblC, DB::table('hfaci_serv_type')->where('hfser_id', '=', $apHfd)->select('*')->first()], 'subUser'=>DB::select($subUserSql), 'clTbl'=>DB::table('class')->where(function($query) { $query->whereNull('isSub')->orWhere('isSub', '=', ''); })->select('*')->get(), 'subClTbl'=>DB::table('class')->where(function($query) { $query->whereNotNull('isSub')->orWhere('isSub', '!=', ''); })->select('*')->get(), 'owTbl'=>DB::table('ownership')->select('*')->get(), 'upApfTbl'=>$upApfTbl, 'apUpApfTbl'=>DB::select($upApfNSql), 'drApfTbl'=>$drApfTbl, 'isView'=>false]);
						} elseif(isset($request->asmtSub)) {
							$apHfd = Session::get('apHfd'); $apFApt = Session::get('apFApt'); $apFTblC = DB::table('apptype')->where('aptid', '=', $apFApt)->select('*')->first(); $apAsmtChkSql = "SELECT assessment.* FROM assessment INNER JOIN (SELECT * FROM facassessment WHERE facid = '$uData->facility_type') facassessment ON facassessment.asmt_id = assessment.asmt_id ORDER BY partid, asmt_id ASC"; $apAsmtChk = DB::select($apAsmtChkSql); $_arrDd = [];
							$arrData = ['appid', 'asmt_id', 'isapproved', 'remarks', 't_date', 't_time', 'fileName', 'draft', 'complied', 'uid'];
							foreach($apAsmtChk AS $apAsmtChkRow) {
								$fileNameToStore = NULL;
								$_complied = ((isset($request->complied[$apAsmtChkRow->asmt_id])) ? $request->complied[$apAsmtChkRow->asmt_id] : NULL);
								if(isset($request->filetype[$apAsmtChkRow->asmt_id])) {
									if(is_string($request->filetype[$apAsmtChkRow->asmt_id])) {
						            	$fileNameToStore = $request->filetype[$apAsmtChkRow->asmt_id];
						            } else {
										$_file = $request->filetype[$apAsmtChkRow->asmt_id];
										$filename = $_file->getClientOriginalName(); 
						                $filenameOnly = pathinfo($filename,PATHINFO_FILENAME); 
						                $fileExtension = $_file->getClientOriginalExtension();
						                $fileNameToStore = $uData->uid.'_ASMT'.$request->asmtSub.'_'.$apAsmtChkRow->asmt_id.'.'.$fileExtension;
						                $path = $_file->storeAs('public/uploaded', $fileNameToStore);
						                $fileSize = $_file->getClientSize();
						            }
								}
								$_remarks = ((isset($request->remarks[$apAsmtChkRow->asmt_id])) ? $request->remarks[$apAsmtChkRow->asmt_id] : NULL);
								$arrSave = [$request->asmtSub, $apAsmtChkRow->asmt_id, NULL, $_remarks, $_today->toDateString(), $_today->toTimeString(), $fileNameToStore, NULL, $_complied, $uData->uid];
								$apAsmtUChk = DB::table('app_assessment')->where('appid', '=', $request->asmtSub)->where('asmt_id', '=', $apAsmtChkRow->asmt_id)->select('*')->first();
								if($apAsmtUChk != NULL) {
									$arrSave = [$request->asmtSub, $apAsmtChkRow->asmt_id, $apAsmtUChk->isapproved, $_remarks, $_today->toDateString(), $_today->toTimeString(), $fileNameToStore, NULL, $_complied, $uData->uid];
									DB::table('app_assessment')->where('appid', '=', $request->asmtSub)->where('asmt_id', '=', $apAsmtChkRow->asmt_id)->update(array_combine($arrData, $arrSave));
								} else {
									DB::table('app_assessment')->insert(array_combine($arrData, $arrSave));
								}
							}
							return redirect()->route('client.apply');
						} elseif(isset($request->fPersonnel)) {
							$apHfd = Session::get('apHfd'); $new_apId = $uData->uid.'_'.$apHfd;
							$arrData = ['lastname', 'firstname', 'middlename', 'gender', 'bod', 'appid'];
							$arrSave = [$request->lastname, $request->firstname, $request->middlename, $request->gender, $request->bod, $new_apId];
							if(DB::table('personnel')->insert(array_combine($arrData, $arrSave))) {
								$_pId = DB::table('personnel')->where('appid', '=', $new_apId)->orderBy('pid', 'desc')->select('*')->first();
								if($_pId != NULL) {
									$arrData_w = ['pid', 'depid', 'secid', 'posid', 'assigndate', 'enddate'];
									$arrSave_w = [$_pId->pid, $request->department, $request->section, $request->position, $request->assigndate, $request->enddate];
									DB::table('personnelwork')->insert(array_combine($arrData_w, $arrSave_w));
									for($i = 0; $i < count($request->plicensetype); $i++) {
										$arrData_e = ['pid', 'plid', 'expiration'];
										$arrSave_e = [$_pId->pid, $request->plicensetype[$i], $request->expiration[$i]];
										DB::table('peligibility')->insert(array_combine($arrData_e, $arrSave_e));
									}
									for($i = 0; $i < count($request->ptrainings_trainingtype); $i++) {
										$arrData_t = ['pid', 'school', 'course', 'datestart', 'datefinish', 'tt_id'];
										$arrSave_t = [$_pId->pid, $request->school[$i], $request->course[$i], $request->datestart[$i], $request->datefinish[$i], $request->ptrainings_trainingtype[$i]];
										DB::table('ptrainings')->insert(array_combine($arrData_t, $arrSave_t));
									}
								}
								$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
								$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
								
								return view('client.apply', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'pDApf_cSendData'=>'return_here']);
							}
						} elseif(isset($request->deleteFPersonnel)) {
							$apHfd = Session::get('apHfd'); $new_apId = $uData->uid.'_'.$apHfd;
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							if(is_array($request->deleteFPersonnel)) {
								foreach($request->deleteFPersonnel AS $deleteFPersonnelRow) {
									DB::table('personnelwork')->where('pid', $deleteFPersonnelRow)->delete();
									DB::table('ptrainings')->where('pid', $deleteFPersonnelRow)->delete();
									DB::table('peligibility')->where('pid', $deleteFPersonnelRow)->delete();
									DB::table('personnel')->where('pid', $deleteFPersonnelRow)->delete();
								}
							}
							return view('client.apply', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'pDApf_cSendData'=>'return_here']);
						} elseif(isset($request->fPsnft)) {
							$apHfd = Session::get('apHfd');
							$pDApf = "SELECT _p.*, _pw.* FROM (SELECT * FROM personnel WHERE appid IN (CONCAT('$uData->uid', '_', '$apHfd'))) _p LEFT JOIN (SELECT personnelwork.*, COALESCE(department.depname, 'No department') AS depname, COALESCE(section.secname, 'No section') AS secname, COALESCE(position.posname, 'No position') AS posname FROM personnelwork LEFT JOIN department ON personnelwork.depid = department.depid LEFT JOIN section ON personnelwork.secid = section.secid LEFT JOIN position ON personnelwork.posid = position.posid) _pw ON _p.pid = _pw.pid";
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							
							return view('client.apply', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'pDApf_c'=>DB::select($pDApf), 'position'=>DB::table('position')->select('*')->get(), 'department'=>DB::table('department')->select('*')->get(), 'section'=>DB::table('section')->select('*')->get(), 'pwork'=>DB::table('pwork')->select('*')->get(), 'plicensetype'=>DB::table('plicensetype')->select('*')->get(), 'ptrainings_trainingtype'=>DB::table('ptrainings_trainingtype')->select('*')->get()]);
						}
					}
				} else {
					return redirect()->route('client.login');
				}
			} else {
				Session::put('errMsg', 'Please choose facility type first!'); Session::put('errAlt', 'warning');
				return redirect()->route('client.home');
			}
		} catch (Exception $e) {
			dd($e);
			Session::put('errMsg', 'An error has occured. Apply');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	//payment
	public function __gPayment(Request $request) {
		try {
			// $uData = Session::get('uData');
			$uData = session()->get('uData'); 
			if(isset(static::$facid_cur)) {
				if($uData != null) {
					if($request->isMethod('get')) {
						// Session::forget('pApt'); Session::forget('pApid'); Session::forget('pOop'); Session::forget('_fPChg'); Session::forget('_fPDesc'); Session::forget('_fPAmt');
						$appCurSql = "SELECT af.appid, af.uid, af.t_date, ts.canapply, ts.trns_desc, hf.hfser_desc, ap.aptdesc, ap.aptid FROM appform af LEFT JOIN hfaci_serv_type hf ON hf.hfser_id = af.hfser_id LEFT JOIN trans_status ts ON af.status = ts.trns_id LEFT JOIN apptype ap ON ap.aptid = af.aptid WHERE af.uid = '$uData->uid' AND ts.allowedpayment NOT IN (0) AND (af.draft IS NULL OR af.draft = '')";
						$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
						$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
						return view('client.payment', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'appCur'=>DB::select($appCurSql), 'gpayment'=>DB::table('chgfil')->where('uid', '=', $uData->uid)->select('*')->orderBy('id', 'DESC')->get()]);
					} else {
						if(isset($request->pAptBtn)) {
							// Session::forget('pOop'); Session::forget('_fPChg'); Session::forget('_fPDesc'); Session::forget('_fPAmt'); 
							Session::put('pApt', $request->pApt); Session::put('pApid', $request->pApid); $pApid = Session::get('pApid');
							$oopCurSql = "SELECT op.oop_id, op.oop_desc, ao.bool_stat FROM orderofpayment op LEFT JOIN (SELECT oop_id, true AS bool_stat FROM appform_orderofpayment WHERE appid = '$pApid') ao ON op.oop_id = ao.oop_id";
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							return view('client.payment', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'oopCur'=>DB::select($oopCurSql)]);
						} elseif(isset($request->pOopBtn)) {
							// Session::forget('_fPChg'); Session::forget('_fPDesc'); Session::forget('_fPAmt');
							Session::put('pOop', $request->pOop);
							$pApt = Session::get('pApt'); $pOop = Session::get('pOop'); $pApid = Session::get('pApid');
							if($pApt != NULL && $pOop != NULL) {
								$oapCurSql = "SELECT ch.chg_code, ch.cat_id, ch.chg_desc, ch.chg_exp, ch.chg_rmks, ca.amt, ca.aptid, ca.oop_id, ca.chgapp_id FROM chg_app ca LEFT JOIN charges ch ON ch.chg_code = ca.chg_code WHERE (ca.aptid = '$pApt' AND ca.oop_id = '$pOop') ORDER BY chg_desc ASC";
								$oapTblSql = "SELECT op.oop_id, op.oop_desc, (ao.oop_total - COALESCE(ao.oop_paid, 0)) AS amt FROM appform_orderofpayment ao LEFT JOIN orderofpayment op ON op.oop_id = ao.oop_id WHERE appid = '$pApid' AND ao.oop_id = '$pOop'";
								$oapNewSql = "SELECT MAX(oop.oop_id) AS oop_id, MAX(oop.oop_desc) AS oop_desc, SUM(oop.amt) AS amt FROM (SELECT op.oop_id, op.oop_desc, ca.amt FROM facoop fc LEFT JOIN orderofpayment op ON op.oop_id = fc.oop_id LEFT JOIN chg_app ca ON ca.chgapp_id = fc.chgapp_id WHERE (fc.facid IN (SELECT hgpid FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE appid = '$pApid')) AND fc.oop_id = '$pOop' AND fc.aptid = '$pApt')) oop";
								$usTblSql = "SELECT ts.trns_desc, ap.aptdesc, hf.hfser_desc, op.oop_desc FROM appform af LEFT JOIN trans_status ts ON ts.trns_id = af.status LEFT JOIN apptype ap ON ap.aptid = af.aptid LEFT JOIN hfaci_serv_type hf ON hf.hfser_id = af.hfser_id LEFT JOIN (SELECT oop_desc FROM orderofpayment WHERE oop_id = '$pOop') op ON 1=1 WHERE appid = '$pApid'";
								$catTblSql = "SELECT cat_id, cat_desc FROM category WHERE cat_id IN (SELECT ch.cat_id FROM chg_app ca LEFT JOIN charges ch ON ch.chg_code = ca.chg_code WHERE (ca.aptid = '$pApt' AND ca.oop_id = '$pOop') ORDER BY chg_desc ASC) ORDER BY cat_id ASC";
								$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
								$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
								$oapTbl = ((count(DB::select($oapTblSql)) > 0) ? ((intval((DB::select($oapTblSql))[0]->amt) == 0) ? DB::select($oapNewSql) : DB::select($oapTblSql)) : DB::select($oapNewSql));
								return view('client.payment', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'oapCur'=>DB::select($oapCurSql), 'oapTbl'=>$oapTbl, 'usTbl'=>DB::select($usTblSql), 'catTbl'=>DB::select($catTblSql)]);
							}
						} elseif(isset($request->_fPSubBtn)) {
							if(Session::has($uData->uid)) {
								Session::forget($uData->uid);
							}
							Session::put($uData->uid, [$request->chgapp_id, $request->desc, $request->amt]);
							$__userPayment = Session::get($uData->uid); $_fPChg = $__userPayment[0]; $_fPDesc = $__userPayment[1]; $_fPAmt = $__userPayment[2];
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							return view('client.payment', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'fPGo'=>['_fPChg'=>$_fPChg, '_fPDesc'=>$_fPDesc, '_fPAmt'=>$_fPAmt]]);
						}
					}
				} else {
					return redirect()->route('client.login');
				}
			} else {
				Session::put('errMsg', 'Please choose facility type first!'); Session::put('errAlt', 'warning');
				return redirect()->route('client.home');
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured. gPayment');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	public function __cPayment(Request $request) {
		try {
			// $uData = Session::get('uData');
			$_today = Carbon::now();
			$uData = session()->get('uData'); 
			if(isset(static::$facid_cur)) {
				if($uData != null) {
					if(Session::has('appid')) {
						$appid = Session::get('appid');
						if(isset($appid[$uData->uid])) {
							$appidNew = $appid[$uData->uid];
							if($request->isMethod('get')) {
								$_allServ = DB::select("SELECT hfaci_grp.hgpdesc, facilitytyp.facname, chg_app.amt FROM serv_chg LEFT JOIN facilitytyp ON serv_chg.facid = facilitytyp.facid LEFT JOIN hfaci_grp ON facilitytyp.hgpid = hfaci_grp.hgpid LEFT JOIN chg_app ON serv_chg.chgapp_id = chg_app.chgapp_id WHERE serv_chg.facid IN (SELECT facid FROM x08_ft WHERE appid = '$appidNew')");
								$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
								$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
								return view('client.servpayment', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'services'=>$_allServ]);
							} else {
								if(isset($request->paymentSubmit)) {
									// dd($request->all()); // 297
									$curUploadId = null; $_modeOfPayment = [$request->mop, 'MOP-008']; $_paymentNow = [($request->amount * -1), $request->total]; $_datas = [];
									if(isset($request->attachfile)) {
										$_file = $request->attachfile;
										$filename = $_file->getClientOriginalName(); 
						                $filenameOnly = pathinfo($filename,PATHINFO_FILENAME); 
						                $fileExtension = $_file->getClientOriginalExtension();
						                $fileNameToStore = $uData->uid.'_'.$request->mop.'_'.$appidNew.'.'.$fileExtension;
						                $path = $_file->storeAs('public/uploaded', $fileNameToStore);
						                $fileSize = $_file->getClientSize();
						                $arr_Data = ['app_id', 'filepath', 'fileExten', 'fileSize', 't_date', 't_time', 'ipaddress'];
						                $arr_Save = [$appidNew, $path, $fileExtension, $fileSize, $_today->toDateString(), $_today->toTimeString(), request()->ip()];
						                if(DB::table('app_upload')->insert(array_combine($arr_Data, $arr_Save))) {
						                	$curUploadId = (DB::table('app_upload')->where('app_id', $appidNew)->first())->apup_id;
						                }
						            }
						            if(isset($request->mop)) {
							            for($i = 0; $i < count($_modeOfPayment); $i++) {
							            	$_chgNumTable = DB::table('chg_app')->where('chg_code', $_modeOfPayment[$i])->first();
							            	$_chgNum = (($_chgNumTable != null) ? $_chgNumTable->chg_num : null);
							            	$_chgAppId = (($_chgNumTable != null) ? $_chgNumTable->chgapp_id : null);
							            	$arrData = ['chgapp_id', 'chg_num', 'appform_id', 'orreference', 'deposit', 'other', 'au_id', 'au_date', 'reference', 'amount', 't_date', 't_time', 't_ipaddress', 'uid', 'sysdate', 'systime'];
							            	$arrSave = [$_chgAppId, $_chgNum, $appidNew, $request->orreference, $request->deposit, $request->other, $curUploadId, $request->pdate, 'APPLICATION PAYMENT', $_paymentNow[$i], $_today->toDateString(), $_today->toTimeString(), request()->ip(), $uData->uid, $_today->toDateString(), $_today->toTimeString()];
							            	array_push($_datas, array_combine($arrData, $arrSave));
							            	if(DB::table('chgfil')->insert(array_combine($arrData, $arrSave))) {
							            		if($_chgNum != null) {
								            		DB::table('chg_app')->where('chgapp_id', $_chgAppId)->update([
								            			'chg_num' => (intval($_chgNum) + 1)
								            		]);
								            	}
								            	DB::table('appform')->where('appid', $appidNew)->update([
								            		'status'=>'PP'
								            	]);
							            	}
							            }
							            // Session::forget();
							            Session::put('errMsg', 'Successfully added payment details');
							            Session::put('errAlt', 'success');
							            return redirect()->route('client.home');
							        } else {
							        	return back();
							        }
						            // dd($_datas);
								}
							}
						} else {
							return redirect()->route('client.home');
						}
					} else {
						return redirect()->route('client.home');
					}
				} else {
					return redirect()->route('client.login');
				}
			} else {
				Session::put('errMsg', 'Please choose facility type first!'); Session::put('errAlt', 'warning');
				return redirect()->route('client.home');
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured. cPayment');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	public function __pPayment(Request $request, $token, $pmt) {
		try {
			// $uData = Session::get('uData');
			$uData = session()->get('uData'); $pApt = Session::get('pApt'); $pOop = Session::get('pOop'); $pApid = Session::get('pApid'); 
			$_today = Carbon::now(); $_sPOop = Session::get('pOop');
			if($uData != null) {
				$__userPayment = Session::get($uData->uid); $_fPChg = $__userPayment[0]; $_fPDesc = $__userPayment[1]; $_fPAmt = $__userPayment[2];
	            if($token != '' && $pmt != '') {
					if($request->isMethod('get')) {
						
					} else {
						if(isset($request->au_file)) {
							$_file = $request->au_file;
							$filename = $_file->getClientOriginalName(); 
			                $filenameOnly = pathinfo($filename,PATHINFO_FILENAME); 
			                $fileExtension = $_file->getClientOriginalExtension();
			                $fileNameToStore = $uData->uid.'_AU_'.date('Y_m_d').'.'.$fileExtension;
			                $path = $_file->storeAs('public/uploaded', $fileNameToStore);
			                $fileSize = $_file->getClientSize();
							$arrData = ['app_id', 'upid', 'filepath', 'fileExten', 'fileSize', 't_date', 't_time', 'ipaddress'];
							$arrSave = [$pApid, NULL, $fileNameToStore, $fileExtension, $fileSize, $_today->toDateString(), $_today->toTimeString(), request()->ip()];
							DB::table('app_upload')->insert(array_combine($arrData, $arrSave));
						}
					}
	            	$arrAll = [];
	            	$arrData = ['chgapp_id', 'chg_num', 'appform_id', 'chgapp_id_pmt', 'au_id', 'au_date', 'reference', 'amount', 't_date', 't_time', 't_ipaddress', 'uid', 'sysdate', 'systime'];
	            	$_nTotal = 0; $_nDesc = ((isset($request->au_ref)) ? $request->au_ref : "Payment");
	            	for($i = 0; $i < count($_fPAmt); $i++) {
	            		$_nChgApp = ((isset($_fPChg[$i])) ? $_fPChg[$i] : '297');
	            		$_chgNum = DB::table('chg_app')->where('chgapp_id', '=', $_nChgApp)->select('chg_num')->first();
	            		$_nTotal = $_nTotal + intval($_fPAmt[$i]);
	            		$curArr = array_combine($arrData, [$_nChgApp, $_chgNum->chg_num, $pApid, NULL, NULL, NULL, $_fPDesc[$i], $_fPAmt[$i], $_today->toDateString(), $_today->toTimeString(), request()->ip(), $uData->uid, $_today->toDateString(), $_today->toTimeString()]);
	            		array_push($arrAll, $curArr);
	            		DB::table('chg_app')->where('chgapp_id', '=', $_nChgApp)->update(['chg_num'=>(intval($_chgNum->chg_num) + 1)]);
	            		if(!isset($_fPChg[$i])) {
	            			$_chkApOopSql = DB::table('appform_orderofpayment')->where('appid', '=', $pApid)->select('*')->first();
	            			$_apOopData = ['appid', 'oop_id', 'oop_subtotal', 'oop_paid', 'oop_remarks', 'oop_total', 'oop_totalword', 'oop_time', 'oop_date', 'oop_ip', 'uid'];
	            			$_apOopSave = [$pApid, $_sPOop, NULL, ((isset($_chkApOopSql)) ? ($_chkApOopSql->oop_paid + $_fPAmt[$i]) : $_fPAmt[$i]), NULL, ((isset($_chkApOopSql)) ? ((($_chkApOopSql->oop_total + $_fPAmt[$i]) > $_chkApOopSql->oop_total) ? ($_chkApOopSql->oop_total + $_fPAmt[$i]) : $_chkApOopSql->oop_total) : $_fPAmt[$i]), NULL, $_today->toTimeString(), $_today->toDateString(), request()->ip(), $uData->uid];
	            			if(isset($_chkApOopSql)) {
	            				DB::table('appform_orderofpayment')->where('appid', '=', $pApid)->update(array_combine($_apOopData, $_apOopSave));
	            			} else {
	            				DB::table('appform_orderofpayment')->insert(array_combine($_apOopData, $_apOopSave));
	            			}
	            		}
	            	}
	            	if($_nTotal > 0) {
	                	$_nChgNum = DB::table('chg_app')->where('chgapp_id', '=', $pmt)->select('chg_num')->first();
	                	$nCurArr = array_combine($arrData, [$pmt, $_nChgNum->chg_num, $pApid, NULL, NULL, NULL, $_nDesc, (((isset($request->au_amount)) ? $request->au_amount : $_nTotal)*-1), $_today->toDateString(), $_today->toTimeString(), request()->ip(), $uData->uid, $_today->toDateString(), $_today->toTimeString()]);
	            		array_push($arrAll, $nCurArr);
	            	}
	        		DB::table('chg_app')->where('chgapp_id', '=', $_nChgApp)->update(['chg_num'=>(intval($_chgNum->chg_num) + 1)]);
	            	for($i = 0; $i < count($arrAll); $i++) {
	            		DB::table('chgfil')->insert($arrAll[$i]);
	            	}
	            	DB::table('appform')->where('appid', '=', $pApid)->update(['status'=>'PP']);
	            	Session::flash('errMsg', 'Successfully saved entry for payment.');
	            	Session::flash('errAlt', 'success');                	
	            	return redirect()->route('client.home');
	            }
			} else {
				return redirect()->route('client.login');
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured. Payment');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	// evaluate
	public function __evaluate(Request $request) {
		try {
			// $uData = Session::get('uData');
			$uData = session()->get('uData'); 
			if(isset(static::$facid_cur)) {
				if($uData != null) {
					if($request->isMethod('get')) {
						// Session::forget('eApid'); Session::forget('eHfd');
						$evTblSql = "SELECT af.appid, af.uid, hf.hfser_id, hf.hfser_desc, ap.aptdesc FROM (SELECT * FROM appform WHERE appid IN (SELECT appid FROM appform WHERE uid = '$uData->uid' ORDER BY t_date, t_time DESC)) af LEFT JOIN hfaci_serv_type hf ON af.hfser_id = hf.hfser_id LEFT JOIN apptype ap ON ap.aptid = af.aptid ORDER BY af.hfser_id ASC";
						$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
						$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
						return view('client.evaluate', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'evTbl'=>DB::select($evTblSql)]);
					} else {
						if(isset($request->eApid)) {
							Session::put('eApid', $request->eApid); Session::put('eHfd', $request->eHfd);
							$eApid = Session::get('eApid'); $eHfd = Session::get('eHfd');
							$eApTblSql = "SELECT up.upid, up.updesc, ap.app_id, ap.evaluation, ap.remarks FROM facility_requirements fr LEFT JOIN type_facility tr ON tr.tyf_id = fr.typ_id LEFT JOIN upload up ON up.upid = fr.upid LEFT JOIN (SELECT upid, app_id, evaluation, remarks FROM app_upload WHERE app_id = '$eApid') ap ON ap.upid = up.upid WHERE (tr.hfser_id = '$eHfd' AND tr.facid IN (SELECT hgpid FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE appid = '$eApid') GROUP BY hgpid)) ORDER BY updesc ASC";
							$eAfTblSql = "SELECT isrecommended, recommendeddate, recommendedtime FROM appform WHERE appid = '$eApid'";
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							return view('client.evaluate', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'eApTbl'=>DB::select($eApTblSql), 'eAfTbl'=>DB::select($eAfTblSql)]);
						}
					}
				} else {
					return redirect()->route('client.login');
				}
			} else {
				Session::put('errMsg', 'Please choose facility type first!'); Session::put('errAlt', 'warning');
				return redirect()->route('client.home');
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured. Evaluate');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	// inspection
	public function __inspection(Request $request) {
		try {
			// $uData = Session::get('uData');
			$uData = session()->get('uData'); 
			if(isset(static::$facid_cur)) {
				if($uData != null) {
					if($request->isMethod('get')) {
						$hfserIdSql = "SELECT _h.*, _a.hfser_id AS hf_null FROM hfaci_serv_type _h LEFT JOIN (SELECT hfser_id FROM appform WHERE uid = '$uData->uid' GROUP BY hfser_id) _a ON _h.hfser_id = _a.hfser_id ORDER BY seq_num ASC";
						$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
						$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
						return view('client.inspection', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'hfserId'=>DB::select($hfserIdSql)]);
					} else {
						if(isset($request->hfserId)) {
							$viewAptid = DB::table('apptype')->select('*')->orderBy('apt_seq', 'asc')->get(); $_arrAll = [];
							$apAsmtChkSql = "SELECT assessment.* FROM assessment INNER JOIN (SELECT * FROM facassessment WHERE facid = '$uData->facility_type') facassessment ON facassessment.asmt_id = assessment.asmt_id ORDER BY partid, asmt_id ASC"; $apAsmtChk = DB::select($apAsmtChkSql);
							array_push($_arrAll, $apAsmtChk);
							if(count($viewAptid) > 0) {
								foreach($viewAptid AS $viewAptidRow) {
									$_newId = $uData->uid.'_'.$request->hfserId.'_'.$viewAptidRow->aptid;
									$_getSql = "SELECT _as.*, _ap.asmt_id AS ifNull, _ap.isapproved FROM ($apAsmtChkSql) _as LEFT JOIN (SELECT asmt_id, MAX(isapproved) AS isapproved FROM app_assessment WHERE appid = '$_newId' GROUP BY asmt_id) _ap ON _as.asmt_id = _ap.asmt_id ORDER BY partid, asmt_id ASC";
									$_cntSql = DB::select($_getSql);
									array_push($_arrAll, $_cntSql);
								}
							}
							$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
							$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
							return view('client.inspection', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'viewInsp'=>DB::table('hfaci_serv_type')->where('hfser_id', '=', $request->hfserId)->select('*')->first(), 'viewAptid'=>$viewAptid, 'asmtTbl'=>$_arrAll]);
						}
					}
				} else {
					return redirect()->route('client.login');
				}
			} else {
				Session::put('errMsg', 'Please choose facility type first!'); Session::put('errAlt', 'warning');
				return redirect()->route('client.home');
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured. Inspection');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	public function __issuance(Request $request) {
		try {
			// $uData = Session::get('uData');
			$uData = session()->get('uData'); 
			if(isset(static::$facid_cur)) {
				if($uData != null) {
					if($request->isMethod('get')) {
						$hfserSql = "SELECT _h.*, _a.hfser_id AS ifNull, _b.hfser_id AS cantapply, _a.appid AS appid FROM hfaci_serv_type _h LEFT JOIN (SELECT hfser_id, MAX(appid) AS appid FROM appform LEFT JOIN trans_status ON trans_status.trns_id = appform.status WHERE uid = '$uData->uid' AND trans_status.isapproved = 1 AND draft IS NULL GROUP BY hfser_id) _a ON _a.hfser_id = _h.hfser_id LEFT JOIN (SELECT hfser_id FROM appform LEFT JOIN trans_status ON trans_status.trns_id = appform.status WHERE uid = '$uData->uid' AND draft IS NULL GROUP BY hfser_id) _b ON _b.hfser_id = _h.hfser_id ORDER BY seq_num ASC";
						$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
						$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
						$_isStatus = "SELECT trans_status.trns_id, trans_status.trns_desc, appform.hfser_id FROM trans_status INNER JOIN (SELECT * FROM appform WHERE appid IN (SELECT MAX(appid) AS appid FROM appform WHERE uid = '$uData->uid' AND draft IS NULL AND hfser_id NOT IN (SELECT hfser_id FROM appform WHERE status IN (SELECT trns_id FROM trans_status WHERE isapproved = 1) AND uid = '$uData->uid') GROUP BY hfser_id)) appform ON trans_status.trns_id = appform.status";
						return view('client.issuance', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'hfserTbl'=>DB::select($hfserSql), 'isStatus'=>DB::select($_isStatus)]);
					} else {
						// if(isset($request->hfserId)) {
						// 	$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
						// 	$_appformSql = "SELECT * FROM appform WHERE appid IN (SELECT MAX(appid) AS appid FROM appform WHERE hfser_id = '$request->hfserId' AND uid = '$uData->uid' AND draft IS NULL AND appform.status IN (SELECT trns_id FROM trans_status WHERE isapproved = 1) GROUP BY hfser_id)";
						// 	$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
						// 	return view('client.issuance', ['curUser'=>$uData, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'hfserIdCur'=>$request->hfserId, 'subUserTbl'=>DB::select($subUserSql), 'sec_name'=>DB::table('m99')->select('sec_name')->first(), 'appform'=>DB::select($_appformSql)]);
						// }
						return redirect()->route('client.home');
					}
				} else {
					return redirect()->route('client.login');
				}
			} else {
				Session::put('errMsg', 'Please choose facility type first!'); Session::put('errAlt', 'warning');
				return redirect()->route('client.home');
			}
		} catch (Exception $e) {
			Session::put('errMsg', 'An error has occured.');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	public function __listing(Request $request) {
		try {
			$uData = session()->get('uData');
			if(isset($uData)) {
				if($request->isMethod('get')) {
					$curUser = session()->get('uData');
					$listing = DB::table('appform')->leftJoin('hfaci_serv_type', 'hfaci_serv_type.hfser_id' ,'=', 'appform.hfser_id')->leftJoin('apptype', 'apptype.aptid' ,'=', 'appform.aptid')->leftJoin('trans_status', 'trans_status.trns_id' ,'=', 'appform.status')->leftJoin('appform_orderofpayment', 'appform_orderofpayment.appid' ,'=', 'appform.appid')->select('appform.facilityname','appform.owner','appform.t_date','hfaci_serv_type.hfser_desc','apptype.aptdesc','appform_orderofpayment.oop_paid','appform_orderofpayment.oop_total', 'trans_status.trns_desc', 'appform.appid')->where('appform.uid',$curUser->uid)->where(function($query) { $query->whereNull('draft'); })->get();

					$payment = DB::select("SELECT reference, chgfil.appform_id, amount, t_date, chgapp.chg_desc FROM chgfil LEFT JOIN (SELECT ca.chgapp_id, ch.chg_desc, ch.chg_code FROM chg_app ca LEFT JOIN charges ch ON ca.chg_code = ch.chg_code) chgapp ON chgfil.chgapp_id = chgapp.chgapp_id WHERE appform_id IN (SELECT appid FROM appform WHERE uid = '$uData->uid')");
					return view('client.listing', compact('curUser', 'listing', 'payment'));
				} else {

				}
			} else {
				return redirect()->route('client.home');
			}
		} catch(Exception $e) {
			Session::put('errMsg', 'An error has occured. Listing');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	public function __byHfser(Request $request, $hfser, $appid) {
		try {
			$uData = session()->get('uData'); 
			if(isset($uData)) {
				$appid = '33';
				$retTable = DB::table('appform')->where('appid', $appid)->leftJoin('facmode', 'facmode.facmid', '=', 'appform.facmode')->leftJoin('region', 'region.rgnid', '=', 'appform.rgnid')->leftJoin('province', 'province.provid', '=', 'appform.provid')->leftJoin('city_muni', 'city_muni.cmid', '=', 'appform.cmid')->leftJoin('barangay', 'barangay.brgyid', '=', 'appform.brgyid')->select('appform.appid', 'appform.facilityname', 'appform.owner', 'facmode.facmdesc', 'region.rgn_desc', 'province.provname', 'city_muni.cmname', 'barangay.brgyname', 'appform.hfser_id', 'appform.noofbed', 'appform.t_date')->first(); $facilityTypeId = "No Facility Type"; $serviceId = "No Service";
				$subUserSql = "SELECT barangay.brgyname, barangay.brgyid, city_muni.cmname, city_muni.cmid, province.provname, province.provid, region.rgn_desc, region.rgnid, facmode.facmdesc, facilitytyp.facname, hfaci_grp.hgpdesc FROM x08 x8 LEFT JOIN barangay ON x8.barangay = barangay.brgyid LEFT JOIN city_muni ON city_muni.cmid = x8.city_muni LEFT JOIN province ON province.provid = x8.province LEFT JOIN region ON region.rgnid = x8.rgnid LEFT JOIN facmode ON facmode.facmid = x8.facility_type LEFT JOIN (SELECT GROUP_CONCAT(facname) AS facname FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE uid = '$uData->uid')) facilitytyp ON 1=1 LEFT JOIN hfaci_grp ON hfaci_grp.hgpid = x8.facility_type WHERE x8.uid = '$uData->uid'";
				$subFacSql = "SELECT facid, facname FROM facilitytyp WHERE facid = '$uData->facility_type'";
				if(isset($retTable)) {
					$facilityType = DB::select("SELECT hgpdesc FROM hfaci_grp LEFT JOIN facilitytyp ON hfaci_grp.hgpid = facilitytyp.hgpid WHERE facilitytyp.facid IN (SELECT facid FROM x08_ft WHERE appid = '$appid')");
					if(count($facilityType)) {
						$impArr = [];
						$i = 0;
						$facname = "No Health Facility";
						foreach($facilityType AS $facilityTypeRow) {

							array_push($impArr, $facilityTypeRow->hgpdesc);
							if($i == 0 ){
								$facname = 	$facilityTypeRow->hgpdesc;
							}
							$i++;
						}
						$facilityTypeId = implode(', ', $impArr);
						
						// $impArr = [];
						// foreach($facilityType AS $facilityTypeRow) {
						// 	array_push($impArr, $facilityTypeRow->hgpdesc);
						// }
						// $facilityTypeId = implode(', ', $impArr);
					}
					$serviceType = DB::select("SELECT facname FROM facilitytyp WHERE facilitytyp.facid IN (SELECT facid FROM x08_ft WHERE appid = '$appid')");
					if(count($serviceType)) {
						$impArr1 = [];
						foreach($serviceType AS $serviceTypeRow) {
							array_push($impArr1, $serviceTypeRow->facname);
						}
						$serviceId = implode(', ', $impArr1);
					}
				}
				if($hfser == "CON") {
					$hfser = "CON1";
				}
				return view('client.certificates.'.$hfser, ['curUser'=>$uData,'facname'=>$facname, 'forCurUser_'=>DB::select($subUserSql), 'forCurUserFac_'=>DB::select($subFacSql), 'facid_cur'=>static::$facid_cur, 'retTable'=>$retTable, 'facilityTypeId'=>$facilityTypeId, 'serviceId'=>$serviceId]);
			} else {
				return redirect()->route('client.home');
			}
		} catch(Exception $e) {
			Session::put('errMsg', 'An error has occured. Listing');
			Session::put('errAlt', 'danger');
			return redirect()->route('client.home');
		}
	}
	public function __rTbl(Request $request, $tbl) {
		try {
			if($request->isMethod('get')) {
				echo json_encode(DB::table($tbl)->select('*')->get());
			} else {
				$_WHERE = []; $_rTable = []; $_rCol = "";
				if(isset($request->rTbl) && isset($request->rId)) {
					if(is_array($request->rTbl) && is_array($request->rId)) {
						if(count($request->rTbl) == count($request->rId)) {
							for($i = 0; $i < count($request->rTbl); $i++) {
								array_push($_WHERE, [$request->rTbl[$i], '=', $request->rId[$i]]);
							}
						} else {
							echo json_encode(["not equal count"]);
						}
					} elseif(is_array($request->rId)) {
						$_rCol = $request->rTbl;
						foreach($request->rId AS $rIdRow) {
							array_push($_WHERE, ((isset($request->rFunc)) ? $rIdRow : [$request->rTbl, '=', $rIdRow]));
						}
					} else {
						array_push($_WHERE, [$request->rTbl, '=', $request->rId]);
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
				echo json_encode($_rTable);
			}
		} catch (Exception $e) {
			echo json_encode($e);
		}
	}
	public function __customQuery(Request $request, $custom) {
		try {
			if(isset($custom)) {
				switch($custom) {
					case 'getPtc':
						$_rTable = [];
						if(isset($request->appid)) {
							$_rTable = DB::table('ptc')->where('appid', $request->appid)->get();
						}
						echo json_encode($_rTable);
						break;
					case 'getFacilityNow':
						$_rTable = [];
						if(isset($request->appid) && isset($request->hfser_id)) {
							$hfaci_custom_one = "SELECT hgpid FROM hfaci_custom_one WHERE hfser_id = '$request->hfser_id'";
							$_rTable = ((count(DB::select($hfaci_custom_one)) > 0) ? DB::select("SELECT * FROM hfaci_grp WHERE hgpid IN ($hfaci_custom_one)") : DB::select("SELECT * FROM hfaci_grp WHERE hgpid IN (SELECT facid FROM type_facility WHERE hfser_id = '$request->hfser_id')"));
						}
						echo json_encode($_rTable);
						break;
					case 'getFacility':
						$_rTable = [];
						if(isset($request->appid)) {
							$_rTable = [DB::select("SELECT hgpid FROM facilitytyp WHERE facid IN (SELECT facid FROM x08_ft WHERE appid = '$request->appid') AND (hgpid IS NOT NULL OR hgpid != '') GROUP BY hgpid"), DB::select("SELECT facid FROM x08_ft WHERE appid = '$request->appid'")];
						}
						echo json_encode($_rTable);
						break;
					case 'getRequirements':
						if(isset($request->aptid) && isset($request->hfser_id) && isset($request->appid) && isset($request->facid)) {
							$aptid = $request->aptid; $hfser_id = $request->hfser_id; $appid = $request->appid; $facid = "";
							if(count($request->facid) > 0) {
								$newFacid = [];
								foreach($request->facid AS $facidRow) {
									array_push($newFacid, "'$facidRow'");
								}
								if(count($newFacid) > 0) {
									$facid = implode(', ', $newFacid);
								}
							}
							$apFTblC = DB::table('apptype')->where('aptid', $aptid)->first();
							$upApfDSql = "SELECT u.* FROM `upload` u INNER JOIN (SELECT * FROM `facility_requirements` fr INNER JOIN (SELECT * FROM `type_facility` WHERE hfser_id = '$hfser_id' AND facid IN ($facid)) tf ON fr.typ_id = tf.tyf_id) ru ON u.upid = ru.upid ORDER BY u.updesc ASC"; $upApfNSql = "$upApfDSql";

							if(isset($apFTblC->apt_isUpdateTo)) {
								$upApfNSql = "SELECT up.*, ap.filepath, ap.t_date, ap.t_time, ap.evaluation, ap.evaldate, ap.evaltime FROM ($upApfDSql) up LEFT JOIN (SELECT * FROM app_upload WHERE apup_id IN (SELECT aup.apup_id FROM (SELECT MAX(apup_id) AS apup_id, upid FROM app_upload WHERE app_id = '$appid' GROUP BY upid) aup)) ap ON up.upid = ap.upid";
							}
							echo json_encode(DB::select($upApfNSql));
						} else {
							echo json_encode([]);
						}
						break;
					case 'getModePayment':
						echo json_encode(DB::table('charges')->where('cat_id', 'PMT')->get());
						break;
					case 'getPersonnelRecord':
						$_rTable = [];
						if(isset($request->hfser_id)) {
							$uData = session()->get('uData');
							if(isset($uData)) {
								$hfser_id = $request->hfser_id; $uid = $uData->uid;
								$_rTable = DB::select("SELECT firstname, middlename, lastname, gender, depname, secname, posname FROM personnel LEFT JOIN (SELECT COALESCE(department.depname, 'No Position') AS depname, COALESCE(position.posname, 'No Position') AS posname, COALESCE(section.secname, 'No Section') AS secname, personnelwork.pid FROM personnelwork LEFT JOIN department ON department.depid = personnelwork.depid LEFT JOIN position ON position.posid = personnelwork.posid LEFT JOIN section ON section.secid = personnelwork.secid) personnelwork ON personnel.pid = personnelwork.pid WHERE appid = CONCAT('$uid', '_', '$hfser_id')");
							}
						}
						echo json_encode($_rTable);
						break;
					case 'getPersonnelReq':
						$_rTable = [];
						$_rTable = ['position'=>DB::select("SELECT * FROM position"), 'department'=>DB::select("SELECT * FROM department"), 'section'=>DB::select("SELECT * FROM section"), 'plicensetype'=>DB::select("SELECT * FROM plicensetype"), 'ptrainings_trainingtype'=>DB::select("SELECT * FROM ptrainings_trainingtype")];
						echo json_encode($_rTable);
						break;
					case 'savePersonnel':
						$_rTable = []; $uData = session()->get('uData');
						if(isset($request->submitPersonnel)) {
							if(isset($uData)) {
								$apHfd = $request->hfser_id; $new_apId = $uData->uid.'_'.$apHfd;
								$arrData = ['lastname', 'firstname', 'middlename', 'gender', 'bod', 'appid'];
								$arrSave = [$request->lastname, $request->firstname, $request->middlename, $request->gender, $request->bod, $new_apId];
								if(DB::table('personnel')->insert(array_combine($arrData, $arrSave))) {
									$_pId = DB::table('personnel')->where('appid', '=', $new_apId)->orderBy('pid', 'desc')->select('*')->first();
									if($_pId != NULL) {
										$arrData_w = ['pid', 'depid', 'secid', 'posid', 'assigndate', 'enddate'];
										$arrSave_w = [$_pId->pid, $request->department, $request->section, $request->position, $request->assigndate, $request->enddate];
										DB::table('personnelwork')->insert(array_combine($arrData_w, $arrSave_w));
										for($i = 0; $i < count($request->plicensetype); $i++) {
											$arrData_e = ['pid', 'plid', 'expiration'];
											$arrSave_e = [$_pId->pid, $request->plicensetype[$i], $request->expiration[$i]];
											DB::table('peligibility')->insert(array_combine($arrData_e, $arrSave_e));
										}
										for($i = 0; $i < count($request->ptrainings_trainingtype); $i++) {
											$arrData_t = ['pid', 'school', 'course', 'datestart', 'datefinish', 'tt_id'];
											$arrSave_t = [$_pId->pid, $request->school[$i], $request->course[$i], $request->datestart[$i], $request->datefinish[$i], $request->ptrainings_trainingtype[$i]];
											DB::table('ptrainings')->insert(array_combine($arrData_t, $arrSave_t));
										}
									}
									$_rTable = DB::select("SELECT firstname, middlename, lastname, gender, depname, secname, posname FROM personnel LEFT JOIN (SELECT COALESCE(department.depname, 'No Position') AS depname, COALESCE(position.posname, 'No Position') AS posname, COALESCE(section.secname, 'No Section') AS secname, personnelwork.pid FROM personnelwork LEFT JOIN department ON department.depid = personnelwork.depid LEFT JOIN position ON position.posid = personnelwork.posid LEFT JOIN section ON section.secid = personnelwork.secid) personnelwork ON personnel.pid = personnelwork.pid WHERE appid = '$new_apId'");
								}
							}
						}
						echo json_encode($_rTable);
						break;
					case 'getServiceCharge':
						$_rTable = [];
						if(isset($request->facid)) {
							$_rTable = DB::table('serv_chg')->leftJoin('facilitytyp', 'facilitytyp.facid', '=', 'serv_chg.facid')->leftJoin('chg_app', 'chg_app.chgapp_id', '=', 'serv_chg.chgapp_id')->whereIn('serv_chg.facid', $request->facid)->select('facilitytyp.facname', 'chg_app.amt')->get();
						}
						echo json_encode($_rTable);
						break;
					default:
						break;
				}
			} else {
				echo json_encode([]);
			}
		} catch(Exception $e) {
			echo json_encode($e);
		}
	}
}