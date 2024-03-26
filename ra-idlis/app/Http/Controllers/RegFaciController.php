<?php

namespace App\Http\Controllers;
use Mail;
use Session;
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
use Illuminate\Support\Facades\Cache;
use FunctionsClientController;
use DOHController;
use App\Models\FACLGroup;
use App\Models\HFACIGroup;
use App\Models\Regions;

use QrCode;
use stdClass;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RegFaciController extends AjaxController
{
	//Filter for report Options
	public static function regfacility_filter (Request $request, $table, $hfser_id="", $nolimit=false)
	{		
		$fo_session_grpid = $request->session()->get('employee_login')->grpid;

		if(empty($request->fo_submit) == false)
		{
			//special fields not included
			$fo_rows = $request->fo_rows;
			$fo_pgno = 	$request->fo_pgno;
			$fo_submit = $request->fo_submit;
			$fo_date_1 = '';
			$fo_date_2 = '';
			
			if($request->fo_submit == "prev")
			{
				if($fo_pgno > 1){  	$fo_pgno--;  }
			}
			else if($request->fo_submit == "next")
			{
				$fo_pgno++;
			}

			if(isset($hfser_id)== false)
			{
				$hfser_id =  $request->hfser_id;
			}

			$arr_fo = array(
				'aptid' => $request->fo_aptid,
				'hfser_id' => $hfser_id,
				'ocid' => $request->fo_ocid,
				'hgpid' => $request->fo_hgpid,
				'status' => $request->fo_status,
				'uid' => $request->fo_uid,
				'rgnid' => $request->fo_rgnid,
				'assignedRgn' => $request->fo_assignedRgn,
				'appid' => $request->fo_appid,
				'facilityname' => $request->fo_facilityname,
				't_date_1' => $request->fo_date_1,
				't_date_2' => $request->fo_date_2,
				'fo_rows' => $request->fo_rows,
				'fo_pgno' => $fo_pgno,
				'fo_submit' => $request->fo_submit,
				'fo_rowscnt' => '0',
				'fo_session_grpid' => $fo_session_grpid
			);
		}
		else
		{
			$fo_rows = "10";
			$fo_pgno = "1";
			$fo_submit = "submit";
			$fo_date_1 =  Date('Y-m-01');
			$fo_date_2 =  Date('Y-m-d');

			$arr_fo = array(
				'aptid' => NULL, 
				'hfser_id' => $hfser_id,
				'ocid' => NULL,
				'hgpid' =>  NULL,
				'status' =>  NULL,
				'uid' => NULL,
				'rgnid' => NULL,
				'assignedRgn' =>  NULL,
				'appid' => NULL,
				'facilityname' => NULL,
				't_date_1' => $fo_date_1,
				't_date_2' => $fo_date_2,

				'fo_rows' => $fo_rows ,
				'fo_pgno' => $fo_pgno,
				'fo_submit' => $fo_submit,
				'fo_rowscnt' => '0',
				'fo_session_grpid' => $fo_session_grpid
			);						
		}				
		
		$data = AjaxController::getAllApplicantionWithFilter($table, $arr_fo, $fo_rows, $fo_pgno-1, $nolimit); 

		$arr_fo['fo_rowscnt']=$data['rowcount'];

		return array('data'=>$data['data'], 'arr_fo'=>$arr_fo);
	}

	public function ExportExcel($exceldata, $filename){
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '4000M');

		try
		{
			$spreadSheet = new Spreadsheet();
			$spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
			$spreadSheet->getActiveSheet()->fromArray($exceldata);
			$Excel_writer = new Xls($spreadSheet);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
			header('Cache-Control: max-age=0');
			ob_end_clean();
			$Excel_writer->save('php://output');
			exit();
		} 
		catch (Exception $e) {
			AjaxController::SystemLogs($e);
			dd($e);
			return;
		}
	}

	public function mfRegFacilities(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.masterfile.registeredfacility_nhfr';
				$title ='Registered Facilities with NHFR';
				$nolimit = false; 
				$hfser = null;
				
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::regfacility_filter($request, 'rpt_license_facilities', $hfser, $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];

						$data_array[] = array("Region","Complete Address","Name of Facility","Type Of Facility","Bed Capacity","Approving Authority","Approving Authority Postion","Owner","Ownership","Class","Subclass","DOH Retained","Telephone No.","Fax No.","Email","Authorization Type","License ID","Date Issued","Remarks");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname.' '.$data_item->zipcode,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->hgpdesc,
								'Bed Capacity' =>$data_item->noofbed,

								'Approving Authority' =>$data_item->approvingauthority,
								'Approving Authority Postion' =>$data_item->approvingauthoritypos,
								'Owner' =>$data_item->owner,
								'Ownership' =>$data_item->ocdesc,
								'Class' =>$data_item->classname,
								'Subclass' =>$data_item->subclassname,
								'DOH Retained' =>$data_item->doh_retained,

								'Telephone No.' =>$data_item->landline,
								'Fax No.' =>$data_item->faxnumber,
								'Email' =>$data_item->email,
								'Authorization Type' =>$data_item->hfser_id,
								'License ID' =>$data_item->license_id,
								
								'Date Issued' =>$data_item->issued_date,
								'Remarks' =>$data_item->approvedRemark
							);
						}
						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					}
				}

				$fo_action = 'employee/dashboard/mf/registered/facility';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>null, 'd_assignedRgn'=>$d_assignedRgn]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.viewprocessflow');
			}
		}
		else 
		{
			return redirect()->route('employee');
		}		
	}

	public static function RegFacilities(Request $request) // Master File - Application Type
	{
		if ($request->isMethod('get')) 
		{
			try 
			{	
				$data = DB::table('registered_facility')
				->join('region', 'region.rgnid', '=', 'registered_facility.rgnid')
				->join('province', 'province.provid', '=', 'registered_facility.provid')
				->join('barangay', 'barangay.brgyid', '=', 'registered_facility.brgyid')
				->join('city_muni', 'city_muni.cmid', '=', 'registered_facility.cmid')
				->leftJoin('hfaci_grp', 'registered_facility.facid', '=', 'hfaci_grp.hgpid')
				->select('registered_facility.*','region.rgn_desc', 'barangay.brgyname', 'province.provname', 'hfaci_grp.hgpdesc', 'city_muni.cmname')
				->get();

				$factype =  DB::table('hfaci_grp')->select('hfaci_grp.*')->get();
				
				$hfser_id = 'LTO';

				$faclArr = [];
				$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
				foreach ($facl_grp as $f) {
					array_push($faclArr, $f->hgpid);
				}
				// return view('employee.masterfile.registeredfacility',['data'=>$data]);	
				return view('employee.masterfile.registeredfacility',['data'=>$data,
					'regions'   => Regions::orderBy('sort')->get(),
					'factype' =>$factype,   
					'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(), 
					'function' => DB::table('funcapf')->get(),
					'_aptid' => ' ',
					'serv_cap' => json_encode(DB::table('facilitytyp')->where('servtype_id', 1)->get()),
				]);	
			} 
			catch (Exception $e) 
			{
				
				return view('employee.masterfile.registeredfacility');	
			}
		}
		else if ($request->isMethod('post')) 
		{

		}
	}

	public static function RegFacilitiesProfile(Request $request) // Master File - Application Type
	{
		if ($request->isMethod('get')) 
		{
			try 
			{	
				$data = DB::table('registered_facility')
				->join('region', 'region.rgnid', '=', 'registered_facility.rgnid')
				->join('province', 'province.provid', '=', 'registered_facility.provid')
				->join('barangay', 'barangay.brgyid', '=', 'registered_facility.brgyid')
				->join('city_muni', 'city_muni.cmid', '=', 'registered_facility.cmid')
				->leftJoin('hfaci_grp', 'registered_facility.facid', '=', 'hfaci_grp.hgpid')
				->select('registered_facility.*','region.rgn_desc', 'barangay.brgyname', 'province.provname', 'hfaci_grp.hgpdesc', 'city_muni.cmname')
				->get();

				$factype =  DB::table('hfaci_grp')->select('hfaci_grp.*')->get();
				
				$hfser_id = 'LTO';

				$faclArr = [];
				$facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
				foreach ($facl_grp as $f) {
					array_push($faclArr, $f->hgpid);
				}
				// return view('employee.masterfile.registeredfacility',['data'=>$data]);	
				return view('employee.masterfile.registeredfacility',
				['data'=>$data,
					'regions'   => Regions::orderBy('sort')->get(),
					'factype' =>$factype,   
					'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->get(), 
					'function' => DB::table('funcapf')->get(),
					'_aptid' => ' ',
					'serv_cap' => json_encode(DB::table('facilitytyp')->where('servtype_id', 1)->get()),
					'pg_title' => 'Facility Profile',
					'fo_action' => '0',
				]);	
			} 
			catch (Exception $e) 
			{
				
				return view('employee.masterfile.registeredfacility');	
			}
		}
		else if ($request->isMethod('post')) 
		{

		}
	}

	public static function get_facilityname_byregfac_id($regfac_id)
	{
		$facilityname = "";
		try
		{
			$data = DB::table('registered_facility')->select('facilityname')->where('regfac_id', '=', $regfac_id)->first();

			$facilityname = $data->facilityname;
		}
		catch (Exception $e) 
		{
			
			return $facility;
		}

		return $facilityname;
	}

	public function assessment(Request $request){
		$dataFromDB = AjaxController::forAssessmentHeaders(array(['asmt_title.serv','<>',null],['hfaci_serv_type.hfser_id','LTO']),array('facilitytyp.facid','facilitytyp.facname','hfaci_serv_type.hfser_id', 'x08_ft.id as xid', 'x08_ft.id as xid'));

		return view('employee.reports.assessment', ['servCap' => $dataFromDB]);
	}

	public function assessmentReportEach(Request $request, $type, $apptype){
		$reports = AjaxController::forAssessmentHeaders(array(['asmt_title.serv','<>',null],['facilitytyp.facid',$type],['assessmentStatus',1],['hfaci_serv_type.hfser_id', $apptype]),array('assessmentcombined.assessmentName','assessmentcombined.assessmentSeq','assessmentcombined.headingText'),3);
		if($reports){
			return view('employee/processflow/pfassessmentgeneratedreport',['reports' => $reports]);
		} else {
			back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Assessment Records not found.']);
		}
	}
	
	public function inspectionPTC(Request $request){
		$dataFromDB = DB::select('SELECT distinct appform.appid, facilityname, hferc_evaluation.revision, appform.hfser_id, appform.rgnid FROM hferc_evaluation join appform on appform.appid = hferc_evaluation.appid join assessmentcombinedduplicateptc on appform.appid = assessmentcombinedduplicateptc.appid join assessmentrecommendation on appform.appid = assessmentrecommendation.appid');
		return view('employee.reports.ptcinspection', ['servCap' => $dataFromDB]);
	}

	public function recommended(Request $request){
		return self::toReturnNotNullEntryField('isRecoForApproval');
	}
	public function approved(Request $request){
		return self::toReturnNotNullEntryField('isApprove');
	}
	public function certificate(Request $request){
		return self::toReturnNotNullEntryField('certificate');
	}

	public static function toReturnNotNullEntryField($field){
		$viewpage = 'employee.reports.recommended';
		switch ($field) {
			case 'isRecoForApproval':
				$link = 'employee/dashboard/processflow/recommendation/{appid}';
				break;
			
			case 'isApprove':
				$link = 'employee/dashboard/processflow/approval/{appid}';
				break;

			case 'certificate':
				$link = 'client1/certificates/{hfser_id}/{appid}';
				$field = 'isApprove';
				$viewpage = 'employee.reports.license.license_certificate';
				break;
		}

		$Cur_useData = AjaxController::getCurrentUserAllData();

		if($Cur_useData['grpid'] == 'RLO'){
			$urgnid = $Cur_useData['rgnid'];
			$dataFromDB = DB::select("SELECT distinct appform.appid, facilityname, appform.hfser_id, appform.rgnid from appform where `$field` IS NOT NULL && appform.rgnid = '$urgnid' order by appid DESC");
	
		}else{
			$dataFromDB = DB::select("SELECT distinct appform.appid, facilityname, appform.hfser_id, appform.rgnid from appform where `$field` IS NOT NULL order by appid DESC");
	
		}

			return view($viewpage, ['servCap' => $dataFromDB, 'link' => $link]);
	}

	/*************** ***********************/
	public function masterfilefees(Request $request, $type, $apptype){
		$reports = AjaxController::forAssessmentHeaders(array(['asmt_title.serv','<>',null],['facilitytyp.facid',$type],['assessmentStatus',1],['hfaci_serv_type.hfser_id', $apptype]),array('assessmentcombined.assessmentName','assessmentcombined.assessmentSeq','assessmentcombined.headingText'),3);
		if($reports){
			return view('employee/processflow/pfassessmentgeneratedreport',['reports' => $reports]);
		} else {
			back()->with('errRet', ['errAlt'=>'danger', 'errMsg'=>'Assessment Records not found.']);
		}
	}

	public function paidapplicant(Request $request){
		$dataFromDB = DB::select('SELECT distinct appform.appid, facilityname, hferc_evaluation.revision, appform.hfser_id, appform.rgnid FROM hferc_evaluation join appform on appform.appid = hferc_evaluation.appid join assessmentcombinedduplicateptc on appform.appid = assessmentcombinedduplicateptc.appid join assessmentrecommendation on appform.appid = assessmentrecommendation.appid');
		return view('employee.reports.cashier.paidapplicantbydate', ['servCap' => $dataFromDB]);
	}
}
