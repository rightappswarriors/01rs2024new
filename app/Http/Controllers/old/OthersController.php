<?php

namespace App\Http\Controllers;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Database\Query\Builder;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Storage;
	use View;
	use Carbon\Carbon;
	use Session;
	use DateTime;
	use DateTimeZone;
	use Maatwebsite\Excel\Facades\Excel;
	use AjaxController;
	use Schema;
	use Mail;
	use Illuminate\Http\File;
use Illuminate\Support\Str;

class OthersController extends Controller
	{

		///////////////////////////////// Lloyd - November162018/////////////////////////////////////////////////////

		public function req_submit(Request $request, $id){
			if ($request->isMethod('post')) {
				$fin_reqs = "";
				$test = "";
				// return dd($request->all());
				// Check if empty
				// $checkReq = $request->except('_token', 'ref_no', 'ot_text', 'name_of_conf_pat', 'date_of_conf_pat', 'btn_sub');
				// foreach ($checkReq as $key => $value) {
				// 	if($value==null) {
				// 		return redirect()->back();
				// 	}
				// }	

				// Checks whether reqs[] is null, if yes, redirects back.
				if($request->reqs == null) {return redirect()->back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please provide your requests.']);}
				// Modifies all reqs[] to be a single string, if <<others>> is checked then also included.
				if(in_array($id, $request->reqs)) {
					$key = array_search($id, $request->reqs);
					foreach ($request->reqs as $req => $r) {
						$fin_reqs.=$r.', ';
					}
					// $fin_reqs=substr($fin_reqs, 0, strlen($fin_reqs)-3);

					// $fin_reqs.=$request->ot_text;
				} else {
					foreach ($request->reqs as $req => $r) {
						$fin_reqs.=$r.', ';
					}
					$fin_reqs=substr($fin_reqs, 0, strlen($fin_reqs)-2);
				}				

				//Gets Faciname
				$name = DB::table('appform')
						->select('facilityname')
						->where('appid', $request->name_of_faci)
						->first();
				

				if($request->facinaturevalue == "false") {
					$name = $request->name_of_faci;
					$type = $request->type_of_faci;
				}
				else {
					$name=$name->facilityname;
					$type=explode("^",$request->type_of_faci)[1];
				}

				//Gets Facitype
				// $type = DB::table('appform')
				// 		->join('x08_ft', 'appform.appid', '=', 'x08_ft.appid')
				// 		->join('facilitytyp', 'x08_ft.facid', '=', 'facilitytyp.facid')
				// 		->select('facilitytyp.facname')
				// 		->first();

				// Query.
				$up = null;
				if($request->reqcompattach){
					$data = $request->input('reqcompattach');
					$fname = $request->file('reqcompattach')->getClientOriginalName();
					$fileExtension = $request->file('reqcompattach')->getClientOriginalExtension();
					$fileNameToStore = (session()->has('employee_login') ? FunctionsClientController::getSessionParamObj("employee_login", "uid") : FunctionsClientController::getSessionParamObj("uData", "uid")).'_'.Str::random(10).'_'.date('Y_m_d_i_s').'.'.$fileExtension;
					$request->file('reqcompattach')->storeAs('public/uploaded', $fileNameToStore);
					$up = $fileNameToStore;
				}



				$x = DB::table('req_ast_form')->insert(
					[/*'ref_no'=>$request->ref_no, */'attachment'=>$up,'source'=>$request->source,'type'=>$request->type, 'name_of_comp'=>$request->name_of_comp, 'age'=>$request->age, 'civ_stat'=>$request->civ_stat, 'address'=>$request->address, 'gender'=>$request->gender, 'contact_no'=>$request->contact_no, 'appid'=>(isset($request->name_of_faci) && is_numeric($request->name_of_faci) ? $request->name_of_faci : null), 'name_of_faci'=>$name, 'type_of_faci'=>$type, 'address_of_faci'=>$request->address_of_faci, 'name_of_conf_pat'=>$request->name_of_conf_pat, 'date_of_conf_pat'=>$request->date_of_conf_pat, 'reqs'=>$fin_reqs, 'comps'=>'', 'signature'=>"", 'details'=>$request->txt_details, 'compEmail' => $request->email,"others"=>$request->ot_text]
				);
				
				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Addded new entry Successfully.']);
			}
		}

		public function req_submitRegFac(Request $request, $id){
			if ($request->isMethod('post')) {
				$fin_reqs = "";
				$test = "";
				// return dd($request->all());
				// Check if empty
				// $checkReq = $request->except('_token', 'ref_no', 'ot_text', 'name_of_conf_pat', 'date_of_conf_pat', 'btn_sub');
				// foreach ($checkReq as $key => $value) {
				// 	if($value==null) {
				// 		return redirect()->back();
				// 	}
				// }	

				// Checks whether reqs[] is null, if yes, redirects back.
				if($request->reqs == null) {return redirect()->back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Please provide your requests.']);}
				// Modifies all reqs[] to be a single string, if <<others>> is checked then also included.
				if(in_array($id, $request->reqs)) {
					$key = array_search($id, $request->reqs);
					foreach ($request->reqs as $req => $r) {
						$fin_reqs.=$r.', ';
					}
					// $fin_reqs=substr($fin_reqs, 0, strlen($fin_reqs)-3);

					// $fin_reqs.=$request->ot_text;
				} else {
					foreach ($request->reqs as $req => $r) {
						$fin_reqs.=$r.', ';
					}
					$fin_reqs=substr($fin_reqs, 0, strlen($fin_reqs)-2);
				}				

				//Gets Faciname
				$name = DB::table('registered_facility')
						->select('facilityname','rgnid')
						->where('regfac_id', $request->name_of_faci)
						->first();
				$regtab = DB::table('registered_facility')
						->select('facilityname','rgnid')
						->where('regfac_id', $request->name_of_faci)
						->first();
				
				// $name = DB::table('appform')
				// 		->select('facilityname')
				// 		->where('appid', $request->name_of_faci)
				// 		->first();
				
						
$employeeData = session('employee_login');
$grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';
				

				if($request->facinaturevalue == "false") {
					$name = $request->name_of_faci;
					$type = $request->type_of_faci;
					$rgnid = $grpid == 'NA' ? $request->rgnid : $employeeData->rgnid;
				}
				else {
					$name=$name->facilityname;
					$type=$request->type_of_faci;
					$rgnid = $regtab->rgnid;
					// $type=explode("^",$request->type_of_faci)[1];
				}

				//Gets Facitype hg
				// $type = DB::table('appform')
				// 		->join('x08_ft', 'appform.appid', '=', 'x08_ft.appid')
				// 		->join('facilitytyp', 'x08_ft.facid', '=', 'facilitytyp.facid')
				// 		->select('facilitytyp.facname')
				// 		->first();

				// Query.
				$up = null;
				if($request->reqcompattach){
					$data = $request->input('reqcompattach');
					$fname = $request->file('reqcompattach')->getClientOriginalName();
					$fileExtension = $request->file('reqcompattach')->getClientOriginalExtension();
					$fileNameToStore = (session()->has('employee_login') ? FunctionsClientController::getSessionParamObj("employee_login", "uid") : FunctionsClientController::getSessionParamObj("uData", "uid")).'_'.Str::random(10).'_'.date('Y_m_d_i_s').'.'.$fileExtension;
					$request->file('reqcompattach')->storeAs('public/uploaded', $fileNameToStore);
					$up = $fileNameToStore;
				}


				$x = DB::table('req_ast_form')->insert(
					[/*'ref_no'=>$request->ref_no, */
						'attachment'=>$up,
						'source'=>$request->source,
						'sourceOthers'=>$request->sourceOther,
						'type'=>$request->type, 
						'name_of_comp'=>$request->name_of_comp, 
						'age'=>$request->age, 
						'civ_stat'=>$request->civ_stat, 
						'address'=>$request->address, 
						'gender'=>$request->gender, 
						'contact_no'=>$request->contact_no, 
						// 'appid'=>(isset($request->name_of_faci) && is_numeric($request->name_of_faci) ? $request->name_of_faci : null), 
						'regfac_id'=>(isset($request->name_of_faci) && is_numeric($request->name_of_faci) ? $request->name_of_faci : null), 
						'name_of_faci'=>$name, 
						'type_of_faci'=>$type, 
						'address_of_faci'=>$request->address_of_faci, 
						'name_of_conf_pat'=>$request->name_of_conf_pat, 
						'date_of_conf_pat'=>$request->date_of_conf_pat, 
						'reqs'=>$fin_reqs, 
						'comps'=>'', 
						'signature'=>"", 
						'details'=>$request->txt_details, 
						'compEmail' => $request->email,
						"others"=>$request->ot_text,
						"rgnid"=>$rgnid
						]
				);
				
				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Addded new entry Successfully.']);
			}
		}

		public static function surv_sub_edit(Request $request, $id, $xid, $xtype)
		{
			$fin_reqs = "";
			$fin_comps = "";
			$test = "";
			// dd($request->all());
			// Modifies all reqs[] to be a single string, if <<others>> is checked then also included.
			if($xtype=="Assistance") {
				// Checks whether reqs[] is null, if yes, redirects back.
				if($request->reqs == null) return redirect()->back();
				if(in_array($id, $request->reqs)) {
					$key = array_search($id, $request->reqs);
					foreach ($request->reqs as $req => $r) {
						$fin_reqs.=$r.', ';
					}
					// $fin_reqs=substr($fin_reqs, 0, strlen($fin_reqs)-3);

					// $fin_reqs.=$request->ot_text;
				} else {
					foreach ($request->reqs as $req => $r) {
						$fin_reqs.=$r.', ';
					}
					$fin_reqs=substr($fin_reqs, 0, strlen($fin_reqs)-2);
				}	
			} else {
				// Checks whether comps[] is null, if yes, replace with an empty array.
				if($request->comps == null) return redirect()->back();
				if(in_array($id, $request->comps)) {
					$key = array_search($id, $request->comps);
					foreach ($request->comps as $com => $r) {
						$fin_comps.=$r.', ';
					}
					// $fin_comps=substr($fin_comps, 0, strlen($fin_comps)-3);
					// $fin_comps.=$request->ot_text;
				} else {
					foreach ($request->comps as $com => $r) {
						$fin_comps.=$r.', ';
					}
					$fin_comps=substr($fin_comps, 0, strlen($fin_comps)-2);
				}	
			}
							

			//Gets Faciname
			$name = DB::table('appform')
					->select('facilityname')
					->where('appid', $request->name_of_faci)
					->first();
			

			if($request->facinaturevalue == "false") {
				$name = $request->name_of_faci;
				$type = $request->type_of_faci;
			}
			else {
				$name=$name->facilityname;
				$type=explode("^",$request->type_of_faci)[1];
			}


			if($xtype=="Assistance") {

				//Gets Facitype
				$type = DB::table('appform')
						->join('x08_ft', 'appform.appid', '=', 'x08_ft.appid')
						->join('facilitytyp', 'x08_ft.facid', '=', 'facilitytyp.facid')
						->select('facilitytyp.facname')
						->first();

				$name = DB::table('appform')
						->select('facilityname')
						->where('appid', $request->name_of_faci)
						->first();

				if($request->facinaturevalue == "false") {
					$name = $request->name_of_faci;
					$type = $request->type_of_faci;
				}
				else {
					$name=$name->facilityname;
					$type=explode("^",$request->type_of_faci)[1];
				}

				$data = [
					"source" => $request->source,
					"type" => $request->type,
					"name_of_comp" => $request->name_of_comp,
					"compEmail" => $request->email,
					"age" => $request->age,
					"civ_stat" => $request->civ_stat,
					"address" => $request->address,
					"gender" => $request->gender,
					"contact_no" => $request->contact_no,
					"appid" => $request->name_of_faci,
					"name_of_faci" => $name,
					"type_of_faci" => $type,
					"address_of_faci" => $request->address_of_faci,
					"name_of_conf_pat" => $request->name_of_conf_pat,
					"date_of_conf_pat"=>$request->date_of_conf_pat,
					"reqs" => $fin_reqs,
					"comps" => "",
					"details" => $request->txt_details,
					"others"=>$request->ot_text,

				];

				$x = DB::table('req_ast_form')->where('ref_no', $request->ref_no_new_new)->update($data);

				// $data["logged_date"] = date('Y-m-d H:i:s');
				// $data["ref_no"] = $request->ref_no_new_new;
				// $y = DB::table('roacomplaintlog')->insertGetId($data);
				// dd($x);
				OthersController::save_to_log($request->ref_no_new_new, 'req_ast_form', 'edit');
			} else {
				//Gets Facitype
				$type = DB::table('appform')
						->join('x08_ft', 'appform.appid', '=', 'x08_ft.appid')
						->join('facilitytyp', 'x08_ft.facid', '=', 'facilitytyp.facid')
						->select('facilitytyp.facname')
						->first();

				$name = DB::table('appform')
						->select('facilityname')
						->where('appid', $request->name_of_faci)
						->first();

				if($request->facinaturevalue == "false") {
					$name = $request->name_of_faci;
					$type = $request->type_of_faci;
				}
				else {
					$name=$name->facilityname;
					$type=explode("^",$request->type_of_faci)[1];
				}

				$data = [
					"source" => $request->source,
					"type" => $request->type,
					"name_of_comp" => $request->name_of_comp,
					"compEmail" => $request->email,
					"age" => $request->age,
					"civ_stat" => $request->civ_stat,
					"address" => $request->address,
					"gender" => $request->gender,
					"contact_no" => $request->contact_no,
					"appid" => $request->name_of_faci,
					"name_of_faci" => $name,
					"type_of_faci" => $type,
					"address_of_faci" => $request->address_of_faci,
					"name_of_conf_pat" => $request->name_of_conf_pat,
					"date_of_conf_pat"=>$request->date_of_conf_pat,
					"reqs" => "",
					"comps" => $fin_comps,
					"details" => $request->txt_details,
					"others"=>$request->ot_text,

				];


				$x = DB::table('complaints_form')->where('ref_no', $request->ref_no_new_new)->update($data);

				// $data["logged_date"] = date('Y-m-d H:i:s');
				// $data["ref_no"] = $request->ref_no_new_new;
				// $y = DB::table('roacomplaintlog')->insertGetId($data);
				// dd($x);

				OthersController::save_to_log($request->ref_no_new_new, 'complaints_form', 'edit');
			}
				
		}


		public static function surv_sub_editRegFac(Request $request, $id, $xid, $xtype)
		{
			$fin_reqs = "";
			$fin_comps = "";
			$test = "";
			// dd($request->all());
			// Modifies all reqs[] to be a single string, if <<others>> is checked then also included.
			if($xtype=="Assistance") {
				// Checks whether reqs[] is null, if yes, redirects back.
				if($request->reqs == null) return redirect()->back();
				if(in_array($id, $request->reqs)) {
					$key = array_search($id, $request->reqs);
					foreach ($request->reqs as $req => $r) {
						$fin_reqs.=$r.', ';
					}
					// $fin_reqs=substr($fin_reqs, 0, strlen($fin_reqs)-3);

					// $fin_reqs.=$request->ot_text;
				} else {
					foreach ($request->reqs as $req => $r) {
						$fin_reqs.=$r.', ';
					}
					$fin_reqs=substr($fin_reqs, 0, strlen($fin_reqs)-2);
				}	
			} else {
				// Checks whether comps[] is null, if yes, replace with an empty array.
				if($request->comps == null) return redirect()->back();
				if(in_array($id, $request->comps)) {
					$key = array_search($id, $request->comps);
					foreach ($request->comps as $com => $r) {
						$fin_comps.=$r.', ';
					}
					// $fin_comps=substr($fin_comps, 0, strlen($fin_comps)-3);
					// $fin_comps.=$request->ot_text;
				} else {
					foreach ($request->comps as $com => $r) {
						$fin_comps.=$r.', ';
					}
					$fin_comps=substr($fin_comps, 0, strlen($fin_comps)-2);
				}	
			}
							

			//Gets Faciname
			// $name = DB::table('appform')
			// 		->select('facilityname')
			// 		->where('appid', $request->name_of_faci)
			// 		->first();
			
			$name = DB::table('registered_facility')
			->select('facilityname')
			->where('regfac_id', $request->name_of_faci)
			->first();

			if($request->facinaturevalue == "false") {
				$name = $request->name_of_faci;
				$type = $request->type_of_faci;
			}
			else {
				$name=$name->facilityname;
				$type=$request->type_of_faci;
				// $type=explode("^",$request->type_of_faci)[1];
			}


			if($xtype=="Assistance") {

				//Gets Facitype
				// $type = DB::table('appform')
				// 		->join('x08_ft', 'appform.appid', '=', 'x08_ft.appid')
				// 		->join('facilitytyp', 'x08_ft.facid', '=', 'facilitytyp.facid')
				// 		->select('facilitytyp.facname')
				// 		->first();

				// $name = DB::table('appform')
				// 		->select('facilityname')
				// 		->where('appid', $request->name_of_faci)
				// 		->first();

				// if($request->facinaturevalue == "false") {
				// 	$name = $request->name_of_faci;
				// 	$type = $request->type_of_faci;
				// }
				// else {
				// 	$name=$name->facilityname;
				// 	$type=explode("^",$request->type_of_faci)[1];
				// }

				$up = null;
				if($request->reqcompattach){
					$data = $request->input('reqcompattach');
					$fname = $request->file('reqcompattach')->getClientOriginalName();
					$fileExtension = $request->file('reqcompattach')->getClientOriginalExtension();
					$fileNameToStore = (session()->has('employee_login') ? FunctionsClientController::getSessionParamObj("employee_login", "uid") : FunctionsClientController::getSessionParamObj("uData", "uid")).'_'.Str::random(10).'_'.date('Y_m_d_i_s').'.'.$fileExtension;
					$request->file('reqcompattach')->storeAs('public/uploaded', $fileNameToStore);
					$up = $fileNameToStore;
				}

				$data = [
					'attachment'=>$up,
					"source" => $request->source,
					"type" => $request->type,
					"name_of_comp" => $request->name_of_comp,
					"compEmail" => $request->email,
					"age" => $request->age,
					"civ_stat" => $request->civ_stat,
					"address" => $request->address,
					"gender" => $request->gender,
					"contact_no" => $request->contact_no,
					"regfac_id" => $request->name_of_faci,
					"name_of_faci" => $name,
					"type_of_faci" => $type,
					"address_of_faci" => $request->address_of_faci,
					"name_of_conf_pat" => $request->name_of_conf_pat,
					"date_of_conf_pat"=>$request->date_of_conf_pat,
					"reqs" => $fin_reqs,
					"comps" => "",
					"details" => $request->txt_details,
					"others"=>$request->ot_text,

				];

				$x = DB::table('req_ast_form')->where('ref_no', $request->ref_no_new_new)->update($data);

				// $data["logged_date"] = date('Y-m-d H:i:s');
				// $data["ref_no"] = $request->ref_no_new_new;
				// $y = DB::table('roacomplaintlog')->insertGetId($data);
				// dd($x);
				OthersController::save_to_log($request->ref_no_new_new, 'req_ast_form', 'edit');
			} else {
				// //Gets Facitype
				// $type = DB::table('appform')
				// 		->join('x08_ft', 'appform.appid', '=', 'x08_ft.appid')
				// 		->join('facilitytyp', 'x08_ft.facid', '=', 'facilitytyp.facid')
				// 		->select('facilitytyp.facname')
				// 		->first();

				// $name = DB::table('appform')
				// 		->select('facilityname')
				// 		->where('appid', $request->name_of_faci)
				// 		->first();

				// if($request->facinaturevalue == "false") {
				// 	$name = $request->name_of_faci;
				// 	$type = $request->type_of_faci;
				// }
				// else {
				// 	$name=$name->facilityname;
				// 	$type=$request->type_of_faci;
				// 	// $type=explode("^",$request->type_of_faci)[1];
				// }

				$data = [
					"source" => $request->source,
					"type" => $request->type,
					"name_of_comp" => $request->name_of_comp,
					"compEmail" => $request->email,
					"age" => $request->age,
					"civ_stat" => $request->civ_stat,
					"address" => $request->address,
					"gender" => $request->gender,
					"contact_no" => $request->contact_no,
					"appid" => $request->name_of_faci,
					"name_of_faci" => $name,
					"type_of_faci" => $type,
					"address_of_faci" => $request->address_of_faci,
					"name_of_conf_pat" => $request->name_of_conf_pat,
					"date_of_conf_pat"=>$request->date_of_conf_pat,
					"reqs" => "",
					"comps" => $fin_comps,
					"details" => $request->txt_details,
					"others"=>$request->ot_text,

				];


				$x = DB::table('complaints_form')->where('ref_no', $request->ref_no_new_new)->update($data);

				// $data["logged_date"] = date('Y-m-d H:i:s');
				// $data["ref_no"] = $request->ref_no_new_new;
				// $y = DB::table('roacomplaintlog')->insertGetId($data);
				// dd($x);

				OthersController::save_to_log($request->ref_no_new_new, 'complaints_form', 'edit');
			}
				
		}

		public static function save_to_log($ref_no, $table, $type)
		{
			$data = (array) DB::table($table)->where('ref_no', $ref_no)->first();
			if(isset($data)){
				$data["action"] = $type;
				unset($data['others']);
				unset($data['action_date']);
				unset($data['deleted']);
				DB::table('roacomplaintlog')->insert($data);
			}
		}

		public static function restoreROAC(Request $r)
		{
			if($r->isMethod('post')) {
				$data = [
					"deleted" => null,
				];
				$table = ($r->restore_type == "Complaints")?"complaints_form":"req_ast_form";
				DB::table($table)->where('ref_no', $r->restore_id)->update($data);
				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Restore Successfully.']);
			} else {
				return redirect()->back();
			}
		}

		public static function surv_sub_actions($ref_no, $table, $x_action, $request)
		{

			// dd($request->all());
			$data = [
				"actions" => $request->select_real_val,
				"action_date" => date('Y-m-d'),
				"staff_name" => $request->staffname,
				"staff_position" => $request->position,
				"action2_text" => $request->action_2_text,
				"action3_text" => $request->action_3_text,
			];

			DB::table($table)->where('ref_no', $ref_no)->update($data);
		}

		public function comp_submit(Request $request, $id){
			if ($request->isMethod('post')) {
				$fin_comps = "";
				// dd($request->all());
				// Check if empty
				// $checkComp = $request->except('_token', 'ref_no', 'ot_text', 'name_of_conf_pat', 'date_of_conf_pat', 'btn_sub');
				// foreach ($checkComp as $key => $value) {
				// 	if($value==null) {
				// 		return redirect()->back();
				// 	}
				// }	
				// Checks whether comps[] is null, if yes, replace with an empty array.
				if($request->comps == null) return redirect()->back();
				// Modifies all comps[] to be a single string, if <<others>> is checked then also included.
				if(in_array($id, $request->comps)) {
					$key = array_search($id, $request->comps);
					foreach ($request->comps as $com => $r) {
						$fin_comps.=$r.', ';
					}
					// $fin_comps=substr($fin_comps, 0, strlen($fin_comps)-3);
					// $fin_comps.=$request->ot_text;
				} else {
					foreach ($request->comps as $com => $r) {
						$fin_comps.=$r.', ';
					}
					$fin_comps=substr($fin_comps, 0, strlen($fin_comps)-2);
				}	

				//Gets Faciname
				// $name = DB::table('appform')
				// 		->select('facilityname')
				// 		->where('appid', $request->name_of_faci)
				// 		->first();
				$name = DB::table('registered_facility')
				->select('facilityname', 'rgnid')
				->where('regfac_id', $request->name_of_faci)
				->first();

				$regtab = DB::table('registered_facility')
				->select('facilityname','rgnid')
				->where('regfac_id', $request->name_of_faci)
				->first();
				// dd($request->all());

				$employeeData = session('employee_login');
				$grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';

				if($request->facinaturevalue == "false") {
					$name = $request->name_of_faci;
					$type = $request->type_of_faci;
					$rgnid = $grpid == 'NA' ? $request->rgnid : $employeeData->rgnid;
				}
				else {
					$name=$name->facilityname;
					$type=$request->type_of_faci;
					$rgnid = $regtab->rgnid;
					// $type=explode("^",$request->type_of_faci)[1];
				}

				//Gets Facitype
				$up = null;
				if($request->reqcompattach){
					$data = $request->input('reqcompattach');
					$fname = $request->file('reqcompattach')->getClientOriginalName();
					$fileExtension = $request->file('reqcompattach')->getClientOriginalExtension();
					$fileNameToStore = (session()->has('employee_login') ? FunctionsClientController::getSessionParamObj("employee_login", "uid") : FunctionsClientController::getSessionParamObj("uData", "uid")).'_'.Str::random(10).'_'.date('Y_m_d_i_s').'.'.$fileExtension;
					$request->file('reqcompattach')->storeAs('public/uploaded', $fileNameToStore);
					$up = $fileNameToStore;
				}

				// dd(($request->name_of_faci ?? null));
				// Query.
			



				DB::table('complaints_form')->insert(
					[/*'ref_no'=>$request->ref_no, */
						'attachment'=>$up,
						'source'=>$request->source,
						'type'=>$request->type, 
						'name_of_comp'=>$request->name_of_comp, 
						'age'=>$request->age, 
						'civ_stat'=>$request->civ_stat, 
						'address'=>$request->address, 
						'gender'=>$request->gender, 
						'contact_no'=>$request->contact_no, 
						'regfac_id'=>(isset($request->name_of_faci) && is_numeric($request->name_of_faci) ? $request->name_of_faci : null),
						// 'appid'=>(is_numeric($request->name_of_faci) ? $request->name_of_faci : null), 
						'name_of_faci'=>$name, 
						'type_of_faci'=>$type, 
						'address_of_faci'=>$request->address_of_faci, 
						'name_of_conf_pat'=>$request->name_of_conf_pat, 
						'date_of_conf_pat'=>$request->date_of_conf_pat, 
						'reqs'=>'', 
						'comps'=>$fin_comps, 
						'signature'=>"",
						'compEmail' => $request->email, 
						'details'=>$request->txt_details, 
						"others"=>$request->ot_text,
						"rgnid"=>$rgnid
						]
				);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);

			}
		}	
		
		public function comp_submitOld(Request $request, $id){
			if ($request->isMethod('post')) {
				$fin_comps = "";
				// dd($request->all());
				// Check if empty
				// $checkComp = $request->except('_token', 'ref_no', 'ot_text', 'name_of_conf_pat', 'date_of_conf_pat', 'btn_sub');
				// foreach ($checkComp as $key => $value) {
				// 	if($value==null) {
				// 		return redirect()->back();
				// 	}
				// }	
				// Checks whether comps[] is null, if yes, replace with an empty array.
				if($request->comps == null) return redirect()->back();
				// Modifies all comps[] to be a single string, if <<others>> is checked then also included.
				if(in_array($id, $request->comps)) {
					$key = array_search($id, $request->comps);
					foreach ($request->comps as $com => $r) {
						$fin_comps.=$r.', ';
					}
					// $fin_comps=substr($fin_comps, 0, strlen($fin_comps)-3);
					// $fin_comps.=$request->ot_text;
				} else {
					foreach ($request->comps as $com => $r) {
						$fin_comps.=$r.', ';
					}
					$fin_comps=substr($fin_comps, 0, strlen($fin_comps)-2);
				}	

				//Gets Faciname
				$name = DB::table('appform')
						->select('facilityname')
						->where('appid', $request->name_of_faci)
						->first();
				// dd($request->all());

				if($request->facinaturevalue == "false") {
					$name = $request->name_of_faci;
					$type = $request->type_of_faci;
				}
				else {
					$name=$name->facilityname;
					$type=explode("^",$request->type_of_faci)[1];
				}

				//Gets Facitype
			

				// dd(($request->name_of_faci ?? null));
				// Query.
				DB::table('complaints_form')->insert(
					[/*'ref_no'=>$request->ref_no, */'source'=>$request->source,'type'=>$request->type, 'name_of_comp'=>$request->name_of_comp, 'age'=>$request->age, 'civ_stat'=>$request->civ_stat, 'address'=>$request->address, 'gender'=>$request->gender, 'contact_no'=>$request->contact_no, 'appid'=>(is_numeric($request->name_of_faci) ? $request->name_of_faci : null), 'name_of_faci'=>$name, 'type_of_faci'=>$type, 'address_of_faci'=>$request->address_of_faci, 'name_of_conf_pat'=>$request->name_of_conf_pat, 'date_of_conf_pat'=>$request->date_of_conf_pat, 'reqs'=>'', 'comps'=>$fin_comps, 'signature'=>"",'compEmail' => $request->email, 'details'=>$request->txt_details, "others"=>$request->ot_text]
				);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);

			}
		}

		public function hasInput(Request $request) {
			if($request->has('_token')) {
		        return count($request->all()) > 1;
		    }
		}

		////////////// December 11, 2018 ///////////////
		public function roacomplaints_manage(Request $request) {
			if($request->isMethod('post')) {
				$reqs = AjaxController::getAllRequestForAssistance();
				$comps = AjaxController::getAllComplaints();
				return view('employee.others.ROAComplaintsManage', ['RequestData'=>$request->all(), 'Reqs'=>$reqs, 'Comps'=>$comps]);
			} else if($request->isMethod('get')) {
				return redirect()->back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Something went wrong. Try again.']);
			}
			
		}

		////////////// December 7, 2018 ///////////////
		public function surv_submit(Request $request) {
			if ($request->isMethod('post')) {
				// dd($request->all());				
				
				//Gets Faciname
				$name = AjaxController::getFacNameByFacidEx($request->e_sappid)[0];

				// dd($name);

				// Query
				DB::table('surv_form')->insert(
					['appid'=>$request->e_sappid, 'date_added'=>$request->e_date, 'name_of_faci'=>$name->facilityname, 'type_of_faci'=>$request->name_of_faci, 'address_of_faci'=>$request->address_of_faci, 'fromWhere' => $request->fromWhere]
				);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);
			}
		}

		public function surv_submitRegFac(Request $request) {
					if ($request->isMethod('post')) {
						// dd($request->all());				
						
						//Gets Faciname
						$name = DB::table('registered_facility')->where('regfac_id', $request->e_sappid)->first();;
						// $name = AjaxController::getFacNameByFacidEx($request->e_sappid)[0];

						// dd($name);

						// Query
						DB::table('surv_form')->insert(
							['regfac_id'=>$request->e_sappid, 
							'date_added'=>$request->e_date, 
							'name_of_faci'=>$name->facilityname, 
							'type_of_faci'=>$request->name_of_faci, 
							'address_of_faci'=>$request->address_of_faci, 
							'fromWhere' => $request->fromWhere]
						);

						return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);
					}
				}

		public function surv_submit_u(Request $r) {
			if ($r->isMethod('post')) {
				$currData = $email = null;			
				// dd([AjaxController::getAddressByLocation($r->u_reg,$r->u_prov,$r->u_cm,$r->u_brgy),$r->address,$r->all()]);
				// Query
				// DB::table('surv_form')->insert(
				// 	['date_added'=>$request->u_sdate, 'name_of_faci'=>$request->u_nameoffaci, 'type_of_faci'=>$request->u_typeoffaci, 'address_of_faci'=>AjaxController::getAddressByLocation($request->u_reg, $request->u_prov, $request->u_cm, $request->u_brgy)]
				// );
				// dd($r->all());
				// dd($r->has('formNeed'));

				if(!$r->has('formNeed')){
				DB::table('appform')->insert(
					['facilityname'=>$r->u_nameoffaci, 'rgnid'=>$r->u_reg, 'provid'=>$r->u_prov, 'cmid'=>$r->u_cm, 'brgyid'=>$r->u_brgy, 't_date'=>date('Y-m-d'), 't_time'=>date('h:i:s'), 'ipaddress'=>request()->ip()]
				);

				$currData = DB::table('appform')
						->where('facilityname', $r->u_nameoffaci)
						->where('rgnid', $r->u_reg)
						->where('provid', $r->u_prov)
						->where('cmid', $r->u_cm)
						->where('brgyid',$r->u_brgy)
						->where('ipaddress', request()->ip())
						->first();
				$currData = $currData->appid;
				}

				if(isset($r->comAppid) && !empty($r->comAppid)){
					$email = DB::table('appform')->where('appid',$r->comAppid)->first();
				}

				DB::table('surv_form')->insert(
					['appid'=>(isset($r->comAppid) ? $r->comAppid : $currData), 
					'date_added'=>date('Y-m-d'), 
					'name_of_faci'=>$r->u_nameoffaci, 
					'address_of_faci'=>(isset($r->address) ? $r->address : AjaxController::getAddressByLocation($r->u_reg,$r->u_prov,$r->u_cm,$r->u_brgy) .' ' .$r->uAddr), 
					'type_of_faci'=>$r->u_typeoffaci, 
					'hasViolation' => 1 ,
					'violation' => $r->complaint, 
					'faciEmail' => (isset($email) ? $email->email : ($r->fromWhere == 'Complaints' ? DB::table('complaints_form')->where('ref_no',$r->compid)->first()->compEmail : null) ), 
					'compid' => $r->compid, 
					'fromWhere' => $r->fromWhere, 
					'rgnid' => $r->u_reg, 
					'status' => 'SFS', 
					'compAddress' => (strtolower($r->fromWhere) == 'unregistered facility' ? json_encode(['reg' => $r->u_reg,'prov' => $r->u_prov, 'cm' => $r->u_cm, 'brgy' => $r->u_brgy]) : '')]
				);

				if(isset($r->compid)){
					$fromComplaints = DB::table('complaints_form')->where('ref_no',$r->compid)->first();
					if(isset($fromComplaints->compEmail)){
						$toData = array('name' => $fromComplaints->name_of_comp, 'faciname' => $fromComplaints->name_of_faci);
						// Mail::send('employee.others.mailForComplaints', $toData, function($msg) use ($fromComplaints) {
						// 	$msg->to($fromComplaints->compEmail);
						// 	$msg->subject('DOHOLRS Surveillance Team');
						// 	$msg->from('doholrs@gmail.com','DOH Surveillance Team');
						// });
						DB::table('complaints_form')->where('ref_no',$r->compid)->update(['isChecked' => 1]);
					}
				}

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);
			}
		}


		public function surv_submit_uRegFac(Request $r) {
			if ($r->isMethod('post')) {
				$currData = $email = null;			
				// dd([AjaxController::getAddressByLocation($r->u_reg,$r->u_prov,$r->u_cm,$r->u_brgy),$r->address,$r->all()]);
				// Query
				// DB::table('surv_form')->insert(
				// 	['date_added'=>$request->u_sdate, 'name_of_faci'=>$request->u_nameoffaci, 'type_of_faci'=>$request->u_typeoffaci, 'address_of_faci'=>AjaxController::getAddressByLocation($request->u_reg, $request->u_prov, $request->u_cm, $request->u_brgy)]
				// );
				// dd($r->all());
				// dd($r->has('formNeed'));

				

				if(isset($r->comAppid) && !empty($r->comAppid)){
					$email = DB::table('appform')->where('appid',$r->comAppid)->first();
				}

				$rn = null;
				if($r->regfac_idcomp){
					$rf = DB::table('registered_facility')->where('regfac_id',$r->regfac_idcomp)->first();
					$rn = $rf->rgnid;
				}

				DB::table('surv_form')->insert(
					['appid'=>(isset($r->comAppid) ? $r->comAppid : $currData), 
					'date_added'=>date('Y-m-d'), 
					'regfac_id'=>$r->regfac_idcomp, 
					'name_of_faci'=>$r->u_nameoffaci, 
					'address_of_faci'=>(isset($r->address) ? $r->address : AjaxController::getAddressByLocation($r->u_reg,$r->u_prov,$r->u_cm,$r->u_brgy) .' ' .$r->uAddr), 
					'type_of_faci'=>$r->u_typeoffaci, 
					'hasViolation' => 1 ,
					'violation' => $r->complaint, 
					'faciEmail' => (isset($email) ? $email->email : ($r->fromWhere == 'Complaints' ? DB::table('complaints_form')->where('ref_no',$r->compid)->first()->compEmail : null) ), 
					'compid' => $r->compid, 
					'rgnid' => $rn, 
					'status' => 'SFS', 
					'fromWhere' => $r->fromWhere, 
					'compAddress' => (strtolower($r->fromWhere) == 'unregistered facility' ? json_encode(['reg' => $r->u_reg,'prov' => $r->u_prov, 'cm' => $r->u_cm, 'brgy' => $r->u_brgy]) : '')
					]
				);

				if(isset($r->compid)){
					$fromComplaints = DB::table('complaints_form')->where('ref_no',$r->compid)->first();
					if(isset($fromComplaints->compEmail)){
						$toData = array('name' => $fromComplaints->name_of_comp, 'faciname' => $fromComplaints->name_of_faci);
						// Mail::send('employee.others.mailForComplaints', $toData, function($msg) use ($fromComplaints) {
						// 	$msg->to($fromComplaints->compEmail);
						// 	$msg->subject('DOHOLRS Surveillance Team');
						// 	$msg->from('doholrs@gmail.com','DOH Surveillance Team');
						// });
						DB::table('complaints_form')->where('ref_no',$r->compid)->update(['isChecked' => 1]);
					}
				}

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);
			}
		}
		public function surv_team(Request $request) {
			if ($request->isMethod('post')) {
				// dd($request->all());

				$date_end = date_create($request->date);
				date_add($date_end, date_interval_create_from_date_string("7 days"));
				$date_end = date_format($date_end, "Y-m-d");
				DB::table('surv_form')->where('survid', '=', $request->atmonid)
				->update(
					['team'=>$request->team, 'date_surveillance'=>$request->date, 'date_surveillance_end'=>$request->dateto]
					// ['team'=>$request->team, 'date_surveillance'=>$request->date, 'date_surveillance_end'=>$date_end]
				);
				return redirect('employee/dashboard/others/surveillance/survact');
				// return redirect()->back()->with('sucMsg', 'Successfully Added a Monitoring Team');
			}
		}

		public function surv_edit(Request $request) {
			if ($request->isMethod('post')) {

				$aw = DB::table('surv_form')
					->where('hfsrbno', $request->hfsrbno)
					->update(
						['name_of_faci'=>$request->edit_name, 'type_of_faci'=>$request->edit_type, 'verdict'=>$request->edit_status, 's_ver_others'=>$request->edit_ver_others]
					);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Edited entry Successfully.']);
			}
		}

		public function surv_delete(Request $request) {
			if ($request->isMethod('post')) {

				$aw = DB::table('surv_form')
					->where('survid', '=', $request->dmonid)
					->delete();

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Deleted entry Successfully.']);
			}
		}

		public function surv_nov(Request $request) {
			if ($request->isMethod('post')) {

				$latestNov = DB::table('surv_form')
					->where('survid', '=', $request->novmonid)
					->first();

				// Update offense
				$offense = (DB::table('surv_form')
					->select('offense')
				    ->where('survid', '=', $request->novmonid)
				    ->first()->offense == "")?1:DB::table('surv_form')
					->select('offense')
				    ->where('survid', '=', $request->novmonid)
				    ->first()->offense+1;

				$AllData = AjaxController::getMembersByTeamIdNotJson($latestNov->team);
				$Uids = AjaxController::getAllUidByFaciName($request->novnameoffaci); // array
				$Signatures = array();
				foreach($Uids as $k => $v) {
					array_push($Signatures, AjaxController::getSignByUid($v->uid));
					// insert notificationlog
					DB::table('notificiationlog')
							->insert(
								['notfdate'=>$request->novdate, 'uid'=>$v->uid, 'loc'=>asset('employee/dashboard/others/novs').'/'.$request->novmonid, 'message'=>
								'The surveillance team has sent you a Notice of Violation. Click to view...', 'status'=>1]
							);
				}

				// insert in nov_issued per uid
				for($i=0; $i<count($Signatures); $i++) {
					DB::table('nov_issued')
						->insert(
							['survid'=>$request->novmonid, 'novdate'=>$request->novdate, 'novauthorizedsign'=>$Signatures[$i]->authorizedsignature, 'novtype'=>$request->novty, 'novnameoffaci'=>$request->novnameoffaci, 'novtypeoffaci'=>$request->novtypeoffaci, 'novdire'=>$request->novdire, 'novteam'=>$request->novteam]
						);	

					$currData = DB::table('nov_issued')
						->where('survid', '=', $request->novmonid)
						->orderBy('novid', 'desc')
						->first();

					if(isset($request->nov_others)) {
						DB::table('nov_issued')
							->where('survid', '=', $currData->novid)
							->update(
								['novdireext'=>$request->nov_others]
							);
					}
				}

				$newData = DB::table('nov_issued')
						->where('survid', '=', $request->novmonid)
						->orderBy('novid', 'asc')
						->get();

				
				$nov_final = "";

				foreach($newData as $k => $v) {
					$nov_final .= $v->novid . ', ';
				}

				$nov_final = substr($nov_final, 0, strlen($nov_final)-2);

				// update mon_form's NOV and offense
				DB::table('surv_form')
						->where('survid', '=', $newData[0]->survid)
						->update(
							['offense'=>$offense, 'hfsrbno'=>$nov_final, 'date_issued'=>$newData[0]->novdate]
						);

				// return view('employee.others.NoticeOfViolation', ['AllData'=>$AllData, 'Nov'=>$nov, 'Request'=>$request->all(), 'Signatures'=>$Signatures]);
				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Filed NOV Successfully.']);
			}
		}

		public function surv_recommendation(Request $request) {
			if($request->isMethod('post')) {
				// dd($request->all());

				// $fileNameToStore = null;
				// if($request->filesup){
				// 	$data = $request->input('filesup');
				// 	$fname = $request->file('filesup')->getClientOriginalName();
				// 	$fileExtension = $request->file('filesup')->getClientOriginalExtension();
				// 	$fileNameToStore = (session()->has('employee_login') ? FunctionsClientController::getSessionParamObj("employee_login", "uid") : FunctionsClientController::getSessionParamObj("uData", "uid")).'_'.Str::random(10).'_'.date('Y_m_d_i_s').'.'.$fileExtension;
				// 	$request->file('filesup')->storeAs('public/uploaded', $fileNameToStore);
				// }
				$chksf = DB::table('surv_form')->where('survid',$request->recmonid)->first();

				$fl = null;
				if($request->has('filesup')){
					$fl = array();

					if(!is_null($chksf)){
						if(!is_null($chksf->supportDoc)){
							$xpd = explode(",",$chksf->supportDoc);
							foreach ($xpd as $fb) {
								array_push($fl,$fb);
							}
						}
					}



					foreach ($request->file('filesup') as $key) {
						$imageRec = FunctionsClientController::uploadFile($key);
						array_push($fl,$imageRec['fileNameToStore']);
					}
				}

				DB::table('surv_form')
				    ->where('survid', '=', $request->recmonid)
				    ->update(['recommendation'=>$request->recrecom, 
					'date_recom'=>$request->recdate, 
					'payment'=>$request->payment, 
					'suspension'=>$request->suspension, 
					's_rec_others'=>$request->others, 
					'verdict'=>$request->recverdict, 
					's_ver_others'=>$request->recothers,
					'status'=>'RS',
					'supportDoc'=>(is_array($fl) ? implode(',',$fl): null )
					// 'supportDoc'=>$fileNameToStore
				]);

				$fromSurv = DB::table('surv_form')->where('survid',$request->recmonid)->select('compid')->first();
				if(isset($fromSurv->compid)){
					$fromComplaints = DB::table('complaints_form')->where('ref_no',$fromSurv->compid)->first();
					// $toData = array('name' => $fromComplaints->name_of_comp, 'faciname' => $fromComplaints->name_of_faci);
					// Mail::send('employee.others.mailForComplaintDone', $toData, function($msg) use ($fromComplaints) {
					// 	$msg->to($fromComplaints->compEmail);
					// 	$msg->subject('DOHOLRS Surveillance Team');
					// 	$msg->from('doholrs@gmail.com','DOH Surveillance Team');
					// });
					DB::table('complaints_form')->where('ref_no',$fromSurv->compid)->update(['isChecked' => 2]);
				}
				$uid = DB::table('surv_form')->where('survid',$request->recmonid)->select('appid')->first();
				if(isset($uid->appid)){
					AjaxController::notifyClient($request->recmonid,AjaxController::getUidFrom($uid->appid),47);
				}

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added recommendation Successfully.']);
			}
		}

		public function surv_attachment(Request $request) {
			if($request->isMethod('post')) {
				$filename = null;
				if($request->hasFile('attfile')) {
					// dd($request->all());
					$files="";
					foreach($request->attfile as $k => $v) {
						$filename = $v->getClientOriginalName();
						$v->storeAs('public/survattfiles/',$request->monid.'^'.$filename);
						$files.='public/survattfiles/'.$request->monid.'^'.$filename.',';
					}

					DB::table('surv_form')
							->where('survid', '=', $request->monid)
							->update(['attached_files'=>$files]);
				}
					// dd($request->all());

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added attachment Successfully.']);
			}
		}

		///////////////////MONITORING///////////////////
		////////////// December 12, 2018 ///////////////
		public function mon_submit(Request $request) {
			// dd($request->all());
			if ($request->isMethod('post')) {
				$allData = AjaxController::getAllFacilitiesByTypeApproved($request->name_of_faci,$request->brgyidVal);
				
				foreach($allData as $key => $value) {	

					// Query
					DB::table('mon_form')->insert(
						['appid'=>$value->appid, 'date_added'=>$request->e_date, /*'appcode'=>$appcode,*/ 'name_of_faci'=>$value->facilityname, 'type_of_faci'=>$value->facid, 'address_of_faci'=>AjaxController::getFacAddrByAppid($value->appid)]
					);
				}

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);
			}
		}

		// Jacky 6-20-2021
		public function mon_submitNew(Request $request) {
			// dd($request->all());
			// if ($request->isMethod('post')) {
				
				$reg =  DB::table('registered_facility')->where('regfac_id', $request->regfac_id)->first();
				
					// Query
					DB::table('mon_form')->insert(
						['regfac_id'=>$request->regfac_id, 
						'date_added'=>$request->e_date, 
						'name_of_faci'=>$reg->facilityname, 
						'type_of_faci'=>$reg->facid, 
						'status'=> 'MNT', 
						'address_of_faci'=> $this->getFacAddrByRegFacId($request->regfac_id)
						]
					);

				// DB::table('mon_form')->insert(
				// 		['regfac_id'=>$request->regfac_id, 'date_added'=>$request->e_date, 'name_of_faci'=>$reg->facilityname, 'type_of_faci'=>$reg->facid, 'address_of_faci'=>$this->getFacAddrByRegFacId($request->regfac_id)]
				// 	);
			
					return response()->json(
						[
							'mssg' => 'Success',	],
						200
					);

				// return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added new entry Successfully.']);
			// }
		}

		public function getFacAddrByRegFacId($id) // Get Facility Name
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


		public function mon_team(Request $request) {
			if ($request->isMethod('post')) {
				// dd($request->all());

				DB::table('mon_form')->where('monid', '=', $request->atmonid)
				->update(
					['team'=>$request->team, 'status'=>'MFM', 'date_monitoring'=>$request->date, 'date_monitoring_end'=>$request->date_end]
				);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added team Successfully.']);
			}
		}

		public function mon_edit(Request $request) {
			if ($request->isMethod('post')) {

				$aw = DB::table('mon_form')
					->where('novid', $request->hfsrbno)
					->update(
						['name_of_faci'=>$request->edit_name, 'type_of_faci'=>$request->edit_type, 'verdict'=>$request->edit_status, 's_ver_others'=>$request->edit_ver_others]
					);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Edited entry Successfully.']);
			}
		}

		public function mon_delete(Request $request) {
			if ($request->isMethod('post')) {

				$aw = DB::table('mon_form')
					->where('monid', '=', $request->dmonid)
					->delete();

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Deleted entry Successfully.']);
			}
		}

		public function mon_nov(Request $request) {
			
			if ($request->isMethod('post')) {

				// Update offense
				// $offense = (DB::table('mon_form')
				// 	->select('offense')
				//     ->where('monid', '=', $request->novmonid)
				//     ->first()->offense == "")?1:DB::table('mon_form')
				// 	->select('offense')
				//     ->where('monid', '=', $request->novmonid)
				//     ->first()->offense+1;


				$offense = DB::table('mon_form')
			    ->where('regfac_id', '=', $request->novappid)
			    ->get();

	// $offense = DB::table('mon_form')
	// 		    ->where('appid', '=', $request->novappid)
	// 		    ->get(); //6-22-2021

				$Uids = AjaxController::getAllUidByRegFac($request->novappid); // array
				// $Uids = AjaxController::getAllUidByAppid($request->novappid); // array 6-22-2021

				// insert notificationlog
				// DB::table('notificiationlog')
				// 		->insert(
				// 			['notfdate'=>$request->novdate, 'uid'=>$Uids->uid, 'loc'=>asset('employee/dashboard/others/nov').'/'.$request->novmonid, 'message'=>
				// 			'The monitoring team has sent you a Notice of Violation. Click to view...', 'status'=>1]
				// 		);

				// insert in nov_issued

				$directions = implode(',', $request->novdire);

				// dd($directions)

				DB::table('nov_issued')
					->insert(
						['monid'=>$request->novmonid, 'novdate'=>$request->novdate, 'novauthorizedsign'=>$Uids->owner, 'novtype'=>$request->novty, 'novnameoffaci'=>$request->novnameoffaci, 'novtypeoffaci'=>$request->novtypeoffaci, 'novdire'=>$directions, 'novteam'=>$request->novteam]
					);	
				
				
				$mytime = Carbon::now();
				$expiry = Carbon::now()->addDays(30);
				
				
				DB::table('compliance_data')
				->where('mon_id', '=', $request->novmonid)
				->update(
					[
					'is_for_compliance'=>1,
					'date_for_compliance' => $mytime,
					'valid_until' => $expiry
					]
				);

				// switch ($request->novdire) {
				// 	case 1:
				// 		AjaxController::notifyClient($request->novmonid,$uid,45,'mon');
				// 		break;
				// }

				$currData = DB::table('nov_issued')
					->where('monid', '=', $request->novmonid)
					->orderBy('novid', 'desc')
					->first();

				if(isset($request->nov_others)) {
					DB::table('nov_issued')
						->where('novid', '=', $currData->novid)
						->update(
							['novdireext'=>$request->nov_others]
						);
				}

				if($currData->novdire == 2) {
					DB::table('mon_form')
						->where('monid', '=', $request->novmonid)
						->update(['isCDO'=>1]);
				} else if($currData->novdire != 2) {
					DB::table('mon_form')
						->where('monid', '=', $request->novmonid)
						->update(['isCDO'=>null]);
				}

				// update mon_form's NOV and offense
				DB::table('mon_form')
						->where('monid', '=', $currData->monid)
						->update(
							['offense'=>$offense->count(), 'novid'=>1, 'status'=>'MFCA', 'date_issued'=>$currData->novdate, 'nov_num'=>$request->nov_num]
						);

				// mail
				$asd = array("name"=>$Uids->owner, "nov"=>$currData->novid);
				$email = $Uids->email;

				//commented on infoadvance's siteground email problem
				// Mail::send('employee.others.testmail', $asd, function($msg) use ($email) {
					// $msg->to("ra.lloydchristophermalinao@gmail.com");
				// 	$msg->to($email);
				// 	$msg->subject('DOHOLRS Notice of Violation');
				// });

				// return view('employee.others.NoticeOfViolation', ['AllData'=>$AllData, 'Nov'=>$nov, 'Request'=>$request->all(), 'Signatures'=>$Signatures]);
				
				
				$data = AjaxController::getAllDataEvaluateOneRegFac($request->novappid);


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
				
				$compliance = DB::table('compliance_data')
				->where('mon_id', '=', $request->novmonid)
				->get();

				$compliance_id = $compliance[0]->compliance_id;

				if(isset($rgappid)){
					$uid = AjaxController::getUidFrom($rgappid);
					AjaxController::notifyClient($compliance_id,$uid,45);
				}

				// if(isset($request->novappid)){
				// 	$uid = AjaxController::getUidFrom($request->novappid);
				// 	AjaxController::notifyClient($request->novmonid,$uid,45);
				// }
				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Filed NOV Successfully.']);
			}
		}

		public function mon_nov_u(Request $request) {
			if ($request->isMethod('post')) {
				// dd($request->all());

				$Uids = AjaxController::getAllUidByAppid($request->novappid); // array
				// dd($Uids);
				// insert in nov_issued
				DB::table('nov_issued')
					->where('monid', '=', $request->novmonid)
					->update(
						['monid'=>$request->novmonid, 'novdate'=>$request->novdate, 'novauthorizedsign'=>$Uids->owner, 'novtype'=>$request->novty, 'novnameoffaci'=>$request->novnameoffaci, 'novtypeoffaci'=>$request->novtypeoffaci, 'novdire'=>$request->novdire, 'novteam'=>$request->novteam]
					);	

				$currData = DB::table('nov_issued')
					->where('monid', '=', $request->novmonid)
					->orderBy('novid', 'desc')
					->first();

				if(isset($request->nov_others)) {
					DB::table('nov_issued')
						->where('novid', '=', $currData->novid)
						->update(
							['novdireext'=>$request->nov_others]
						);
				}

				if($currData->novdire == 2) {
					DB::table('mon_form')
						->where('monid', '=', $request->novmonid)
						->update(['isCDO'=>1]);
				} else if($currData->novdire != 2) {
					DB::table('mon_form')
						->where('monid', '=', $request->novmonid)
						->update(['isCDO'=>null]);
				}

				// update mon_form's NOV and offense
				DB::table('mon_form')
						->where('monid', '=', $currData->monid)
						->update(
							['novid'=>1, 'date_issued'=>$currData->novdate]
						);

				// return view('employee.others.NoticeOfViolation', ['AllData'=>$AllData, 'Nov'=>$nov, 'Request'=>$request->all(), 'Signatures'=>$Signatures]);
				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Filed NOV Successfully.']);
			}
		}

		public function mon_recommendation(Request $request) {
			if($request->isMethod('post')) {
				// dd($request->all());

				DB::table('mon_form')
				    ->where('monid', '=', $request->recmonid)
				    ->update(['recommendation'=>$request->recrecom, 'date_recom'=>$request->recdate, 'payment'=>$request->payment, 'suspension'=>$request->suspension, 's_rec_others'=>$request->others, 'verdict'=>1, 's_ver_others'=>$request->recothers]);

				 if(!empty($request->payment)){
				 	$data = DB::table('chg_app')
							->join('charges', 'chg_app.chg_code', '=', 'charges.chg_code')
							->join('orderofpayment', 'chg_app.oop_id', '=', 'orderofpayment.oop_id')
							->join('category', 'charges.cat_id', '=', 'category.cat_id')
							->join('apptype', 'chg_app.aptid', '=', 'apptype.aptid')
							->leftJoin('hfaci_serv_type', 'chg_app.hfser_id', '=', 'hfaci_serv_type.hfser_id')
							->where([['charges.chg_code', 'MONP'],['charges.fmon',1]])
							->orderBy('chg_app.chgopp_seq','asc')
							->first();
					if(isset($data)){
						$arrDataChgfil = [$data->chgapp_id, $data->chg_num, $request->recappid, NULL, NULL, NULL, NULL, NULL, NULL, $data->chg_desc, $request->payment, Carbon::now()->toDateString(), Carbon::now()->toTimeString(), request()->ip(), FunctionsClientController::getSessionParamObj("uData", "uid"), 1];

						$arrSaveChgfil = ['chgapp_id', 'chg_num', 'appform_id', 'chgapp_id_pmt', 'orreference', 'deposit', 'other', 'au_id', 'au_date', 'reference', 'amount', 't_date', 't_time', 't_ipaddress', 'uid', 'forMon'];
						$insert = DB::table('chgfil')->insert(array_combine($arrSaveChgfil, $arrDataChgfil));
						$toUpdate = null;
						DB::table('appform')->where('appid',$request->recappid)->update(['isPayEval' => $toUpdate, 'payEvaldate' => $toUpdate, 'payEvaltime' => $toUpdate, 'payEvalip' => $toUpdate, 'payEvalby' => $toUpdate, 'isCashierApprove' => $toUpdate, 'CashierApproveBy' => $toUpdate, 'CashierApproveDate' => $toUpdate, 'CashierApproveTime' => $toUpdate, 'CashierApproveIp' => $toUpdate, 'status' => 'REV']);
					}

				 }

				if($request->recrecom == 1) {
					DB::table('mon_form')
						->where('monid', '=', $request->recmonid)
						->update(['isCDO'=>null]);
				}

				// mail
				$Uids = AjaxController::getAllUidByAppid($request->recappid); // array
				$currData = DB::table('nov_issued')
						->where('monid', '=', $request->recmonid)
						->orderBy('novid', 'desc')
						->first();
				$asd = array("name"=>$Uids->owner, "nov"=>$currData->novid);
				$email = $Uids->email;
				Mail::send('employee.others.testmailr', $asd, function($msg) use ($email) {
					// $msg->to("ra.lloydchristophermalinao@gmail.com");
					$msg->to($email);
					$msg->subject('DOHOLRS Notice of Violation');
				});
				$uid = AjaxController::getUidFrom($request->recappid);
				AjaxController::notifyClient($request->recmonid,$uid,46);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added recommendation Successfully.']);
			}
		}

		public function mon_recommendation_u(Request $request) {
			if($request->isMethod('post')) {
				// dd($request->all());

				DB::table('mon_form')
				    ->where('monid', '=', $request->recmonid)
				    ->update(['recommendation'=>$request->recrecom, 'date_recom'=>$request->recdate, 'payment'=>$request->payment, 'suspension'=>$request->suspension, 's_rec_others'=>$request->others, 'verdict'=>$request->recverdict, 's_ver_others'=>$request->recothers]);

				if($request->recrecom == 1) {
					DB::table('mon_form')
						->where('monid', '=', $request->recmonid)
						->update(['isCDO'=>null]);
				}

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added recommendation Successfully.']);
			}
		}

		public function mon_addmonteam(Request $request) {
			if($request->isMethod('post')) {
				DB::table('mon_team')
					->insert(['montname'=>$request->teamname, 'rgnid'=>$request->teamrgn]);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added a new team Successfully.']);
			}
		}

		public function surv_addmonteam(Request $request) {
			if($request->isMethod('post')) {
				DB::table('surv_team')
					->insert(['montname'=>$request->teamname, 'rgnid'=>$request->teamrgn]);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added a new team Successfully.']);
			}
		}

		public function mon_removemonteam(Request $request) {
			if($request->isMethod('post')) {
				DB::table('mon_team')
					->where('montid', '=', $request->xxteamname)
					->delete();
					// ->insert(['montname'=>$request->teamname, 'rgnid'=>$request->teamrgn]);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Deleted a team Successfully.']);
			}
		}

		public function surv_removemonteam(Request $request) {
			if($request->isMethod('post')) {
				DB::table('surv_team')
					->where('montid', '=', $request->xxteamname)
					->delete();
					// ->insert(['montname'=>$request->teamname, 'rgnid'=>$request->teamrgn]);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Deleted a team Successfully.']);
			}
		}

		public function mon_addmonteammember(Request $request) {
			if($request->isMethod('post')) {

					if(DB::table('mon_team_members')->where([['uid',$request->teammember],['montid',$request->xteamid]])->doesntExist()){
					$insertToMon = DB::table('mon_team_members')
						->insertGetId(['uid'=>$request->teammember, 'montid'=>$request->xteamid, 'fname'=>AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->fname, 'mname'=>AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->mname, 'lname'=>AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->lname, 'remarks'=>$request->xtremarks, 'position'=>AjaxController::getPositionByUID($request->teammember)->position]);
					if($insertToMon){

						return json_encode(['uid' => $request->teammember.'^'.$insertToMon, 'fname'=>AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->fname . ' '. AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->mname . ' ' . AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->lname]);
					}

					return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added team member Successfully.']);
				}
				else {
					return 'User Already Exist';
				}
			} 


		}

		public function surv_addmonteammember(Request $request) {
			if($request->isMethod('post')) {

					if(DB::table('surv_team_members')->where([['uid',$request->teammember],['montid',$request->xteamid]])->doesntExist()){
					$insertToMon = DB::table('surv_team_members')
						->insertGetId(['uid'=>$request->teammember, 'montid'=>$request->xteamid, 'fname'=>AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->fname, 'mname'=>AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->mname, 'lname'=>AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->lname, 'remarks'=>$request->xtremarks, 'position'=>AjaxController::getPositionByUID($request->teammember)->position]);
					if($insertToMon){

						return json_encode(['uid' => $request->teammember.'^'.$insertToMon, 'fname'=>AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->fname . ' '. AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->mname . ' ' . AjaxController::getEmployeeFullNameByUid($request->teammember)[0]->lname]);
					}

					return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added team member Successfully.']);
				}
				else {
					return 'User Already Exist';
				}
			} 


		}

		public function mon_remmonteammember(Request $request) {
			if($request->isMethod('post')) {
				// dd($request->all());
				if(strpos($request->teammember, '^') >= 0){
					$request->teammember = substr($request->teammember, strpos($request->teammember, '^')+1);
				}
				DB::table('mon_team_members')
					->where('montmemberid', '=', $request->teammember)
					->delete();
					// ->insert(['uid'=>$request->teammember, 'montid'=>$request->xteamid, 'remarks'=>$request->xremarks]);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Removed a member Successfully.']);
			}
		}

		public function surv_remmonteammember(Request $request) {
			if($request->isMethod('post')) {
				// dd($request->all());
				if(strpos($request->teammember, '^') >= 0){
					$request->teammember = substr($request->teammember, strpos($request->teammember, '^')+1);
				}
				DB::table('surv_team_members')
					->where('montmemberid', '=', $request->teammember)
					->delete();
					// ->insert(['uid'=>$request->teammember, 'montid'=>$request->xteamid, 'remarks'=>$request->xremarks]);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Removed a member Successfully.']);
			}
		}

		public function mon_attachment(Request $request) {
			if($request->isMethod('post')) {
				$filename = null;
				if($request->hasFile('attfile')) {
					// dd($request->attfile);
					$files="";
					foreach($request->attfile as $k => $v) {
						$filename = $v->getClientOriginalName();
						$v->storeAs('public/monattfiles/',$request->monid.'^'.$filename);
						$files.='public/monattfiles/'.$request->monid.'^'.$filename.',';
					}

					DB::table('mon_form')
							->where('monid', '=', $request->monid)
							->update(['attached_files'=>$files]);
				}
					// dd($request->all());

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Added attachment Successfully.']);
			}
		}

		public function mon_update(Request $request) {
			if($request->isMethod('post')) {

				// if($request->asd == 2) $request->asd = null;

				DB::table('mon_form')
					->where('monid', '=', $request->monid)
					->update(['isApproved'=>$request->asd]);


					// here

				// $appid = DB::table('mon_form')->where('monid',$request->monid)->select('appid')->first()->appid;

				// $uid = AjaxController::getUidFrom($appid);
				$uid = AjaxController::getUidFromRegFac(DB::table('mon_form')->where('monid',$request->monid)->select('regfac_id')->first()->regfac_id);
							
				AjaxController::notifyClient($request->monid,$uid,59);

				return redirect()->back()->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Updated Successfully.']);
			}
		}

		public function __entry() {
			// $dataSql = "SELECT appform.*, x08_ft.id FROM `appform` JOIN x08_ft ON x08_ft.appid = appform.appid WHERE isApprove IS NOT NULL";
			// $data = DB::select($dataSql);
			
			// foreach($data as $k => $v) {
			// 	DB::table('licensed')
			// 		->insert([
			// 			'appid'=>$v->appid,
			// 			'x08_ftid'=>$v->id
			// 		]);
			// }
		}
		
	} //End of Class