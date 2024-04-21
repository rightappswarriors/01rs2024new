<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AjaxController;
use DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ReportsController extends Controller
{
	//Filter for report Options
	public static function application_filter (Request $request, $table, $hfser_id="", $nolimit=false)
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
				$hfser_id =  $request->fo_hfser_id;
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

	public static function registered_facility_filter (Request $request, $table,  $nolimit=false)
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

			$arr_fo = array(
				'nhfcode' => $request->fo_nhfcode,
				'regfac_id' => $request->fo_regfac_id,
				'ocid' => $request->fo_ocid,
				'hgpid' => $request->fo_hgpid,
				'uid' => $request->fo_uid,
				'rgnid' => $request->fo_rgnid,
				'assignedRgn' => $request->fo_assignedRgn,
				'facilityname' => $request->fo_facilityname,
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
				'nhfcode' => NULL,
				'regfac_id' => NULL,
				'ocid' => NULL,
				'hgpid' =>  NULL,
				'uid' => NULL,
				'rgnid' => NULL,
				'assignedRgn' =>  NULL,
				'facilityname' => NULL,
				'fo_rows' => $fo_rows ,
				'fo_pgno' => $fo_pgno,
				'fo_submit' => $fo_submit,
				'fo_rowscnt' => '0',
				'fo_session_grpid' => $fo_session_grpid
			);						
		}				
		
		$data = AjaxController::getAll_RegisteredFacility_WithFilter($table, $arr_fo, $fo_rows, $fo_pgno-1, $nolimit); 

		$arr_fo['fo_rowscnt']=$data['rowcount'];

		return array('data'=>$data['data'], 'arr_fo'=>$arr_fo);
	}

	public static function registered_personnel_filter (Request $request, $table,  $nolimit=false)
	{		
		$fo_session_grpid = $request->session()->get('employee_login')->grpid;

		if(empty($request->fo_submit) == false)
		{
			//special fields not included
			$fo_rows = $request->fo_rows;
			$fo_pgno = 	$request->fo_pgno;
			$fo_submit = $request->fo_submit;
			
			if($request->fo_submit == "prev")
			{
				if($fo_pgno > 1){  	$fo_pgno--;  }
			}
			else if($request->fo_submit == "next")
			{
				$fo_pgno++;
			}

			$arr_fo = array(
				'regfac_id' => $request->fo_regfac_id,
				'surname' => $request->fo_surname,
				'firstname' => $request->fo_firstname,
				'middlename' => $request->fo_middlename,
				'prof' => $request->fo_prof,
				'prcno' => $request->fo_prcno,
				'employement' => $request->fo_employement,
				'pos' => $request->fo_pos,
				'status' => $request->fo_status,
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

			$arr_fo = array(
				'regfac_id' => NULL,
				'surname' => NULL,
				'firstname' => NULL,
				'middlename' => NULL,
				'prof' => NULL,
				'prcno' => NULL,
				'employement' => NULL,
				'pos' => NULL,
				'status' => NULL,
				'fo_rows' => $fo_rows ,
				'fo_pgno' => $fo_pgno,
				'fo_submit' => $fo_submit,
				'fo_rowscnt' => '0',
				'fo_session_grpid' => $fo_session_grpid
			);						
		}				
		
		$data = AjaxController::getAll_RegisteredPersonnel_WithFilter($table, $arr_fo, $fo_rows, $fo_pgno-1, $nolimit); 

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

	public function applistByhfser(Request $request, $hfser="")
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.applist.application_list';
				$title = 'Application Ledger'; 
				$nolimit = false; 
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$pg_rpt_rights = "";

				/*$d_assignedRgn = $request->fo_assignedRgn

				if($Cur_useData['grpid'] != 'NA')
				{
					//$d_assignedRgn = $Cur_useData['rgnid'];
				}

				//$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $request->fo_assignedRgn;// $d_assignedRgn;*/

				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				if($hfser == "CON"){ $pg_rpt_rights = "RAR001"; }
				elseif($hfser == "PTC"){ $pg_rpt_rights = "RAR002"; }
				elseif($hfser == "LTO"){ $pg_rpt_rights = "RAR003"; }
				elseif($hfser == "COA"){ $pg_rpt_rights = "RAR004"; }
				elseif($hfser == "ATO"){ $pg_rpt_rights = "RAR005"; }
				elseif($hfser == "COR"){ $pg_rpt_rights = "RAR006"; }
				else{ $pg_rpt_rights = "RAR007"; }
				 
				$data = SELF::application_filter($request, 'view_app_status_summary', $hfser, $nolimit);

				if (isset($hfser)) {$title = $hfser.'  Application Report';}
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];
						$data_array[] = array("Region","City, Province","Complete Address","Process","Type","App ID","Name of Facility","Type Of Facility","Date Applied","uid","Ownership","Class" ,"Bed Capacity","Approving Authority","Approving Authority Postion","Status");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'City, Province' =>$data_item->cmname.', '.$data_item->provname,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '.$data_item->zipcode,
								'Process' =>$data_item->aptdesc,
								'Type' =>$data_item->hfser_desc,
								'App ID' =>$data_item->appid,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->hgpdesc,
								'Date Applied' =>$data_item->formattedDate,
								'uid' =>$data_item->uid,
								'Ownership' =>$data_item->ocdesc,
								'Class' =>$data_item->classname,
								'Bed Capacity' =>$data_item->noofbed,
								'Approving Authority' =>$data_item->approvingauthority,
								'Approving Authority Postion' =>$data_item->approvingauthoritypos,
								'Status' =>$data_item->trns_desc
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}

				$fo_action = 'employee/reports/applist/'.$hfser;

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_assignedRgn'=>$d_assignedRgn, 'pg_rpt_rights'=> $pg_rpt_rights]);
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
	
	public function logsheetptc(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			//try 
			//{
				$arrType = array();
				$viewpage = 'employee.reports.evaluation.logsheetptc';
				$title ='Log Sheet Permit to Construct Report';
				$nolimit = false; 
				$hfser = "PTC";
				$Cur_useData = AjaxController::getCurrentUserAllData();
				
				
				/*$d_assignedRgn = null;

				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn; */

				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::application_filter($request, 'rpt_evaluation_ptc_logsheet', $hfser, $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];
						$data_array[] = array("Region","Complete Address","Process","Type","App ID","Name of Facility","Type Of Facility","Date Applied", "Ownership","Class" ,"Contruction Type","Evaluation Status","PTC No.","Approved Date", "Payment", "Recommended By", "Evaluation Date");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname. ', '.$data_item->zipcode,
								'Process' =>$data_item->aptdesc,
								'Type' =>$data_item->hfser_desc,
								'App ID' =>$data_item->appid,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->hgpdesc,
								'Date Applied' =>$data_item->formattedDate,
								'Ownership' =>$data_item->ocdesc,
								'Class' =>$data_item->classname,
								'Contruction Type' => $data_item->ptctype_desc,
								'Evaluation Status' =>$data_item->trns_desc,
								'PTC No.' =>$data_item->ptc_id,
								'Approved Date' =>$data_item->formattedDateApprove,
								'Payment' =>$data_item->payment,
								'Recommended By' =>'('.$data_item->recommendedby.')'. $data_item->recommendedbyName,
								'Evaluation Date' =>$data_item->formattedDateEval
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}

				$fo_action = 'employee/reports/ptcevaluation/logsheetptc';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_assignedRgn'=>$d_assignedRgn]);
			/*} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view('employee.processflow.viewprocessflow');
			}*/
		}
		else 
		{
			return redirect()->route('employee');
		}		
	}

	public function hospitalinspection(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			
			$fo_action = 'employee/reports/inspection/hospitalinspection';

			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.inspection.hospitalinspection';
				$title ='Inspection of Hospital Log Sheet Report';
				$nolimit = false; 
				$hfser = "LTO";
				$Cur_useData = AjaxController::getCurrentUserAllData();
				
				/*$d_assignedRgn = null;

				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;*/

				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}
				$request->fo_hgpid = '6';
				$data['arr_fo']['fo_hgpid']='6';
				$data = SELF::application_filter($request, 'rpt_inspection_logsheet', $hfser, $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];
						$data_array[] = array("Region","Complete Address", "Application Code","Name of Facility","Type Of Facility","Institutional Character","Date Applied","Date Inspected","Type of Application","Remarks","Date Complied","Date Forwarded to Process Owner","Date Release to Records","Team Leader","Status");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname.' '.$data_item->zipcode,
								'Application Code' =>$data_item->appid,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->hgpdesc,
								'Institutional Character' =>$data_item->facmdesc,
								'Date Applied' =>$data_item->formattedDate,
								'Date Inspected' =>$data_item->formattedDateInspect,
								'Type of Application' =>$data_item->aptid.'/'.$data_item->hfser_id.'/'. $data_item->ocdesc.'/'.$data_item->classname.'/ No.Of Bed='.$data_item->noofbed.'/ No.Of Dialysis='.$data_item->noofbed,
								'Remarks' =>$data_item->inspectorRemarks,
								'Date Complied' =>'',
								'Date Forwarded to Process Owner' =>'',
								'Date Release to Records' =>'',
								'Team Leader' =>$data_item->inspectorName,
								'Status' =>$data_item->trns_desc
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>'6', 'd_assignedRgn'=>$d_assignedRgn]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view($fo_action);
			}
		}
		else 
		{
			return redirect()->route('employee');
		}		
	}

	public function aspinspection(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.inspection.aspinspection';
				$title ='Ambulance Service Provider Log Sheet Report';
				$nolimit = false;
				$hfser = "LTO";
				$Cur_useData = AjaxController::getCurrentUserAllData();
				
				/*$d_assignedRgn = null;

				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn; */

				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}
				
				$request->fo_hgpid = '34';
				$data['arr_fo']['fo_hgpid']='34';

				$data = SELF::application_filter($request, 'rpt_inspection_logsheet', $hfser, $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];
						$data_array[] = array("Region","Complete Address", "Application Code","Name of Facility","Type Of Facility","Institutional Character","Date Applied","Date Inspected","Type of Application","Remarks","Date Complied","Date Forwarded to Process Owner","Date Release to Records","Team Leader","Status");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname.' '.$data_item->zipcode,
								'Application Code' =>$data_item->appid,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->hgpdesc,
								'Institutional Character' =>$data_item->facmdesc,
								'Date Applied' =>$data_item->formattedDate,
								'Date Inspected' =>$data_item->formattedDateInspect,
								'Type of Application' =>$data_item->aptid.'/'.$data_item->hfser_id.'/'. $data_item->ocdesc.'/'.$data_item->classname.'/ No.Of Bed='.$data_item->noofbed.'/ No.Of Dialysis='.$data_item->noofbed,
								'Remarks' =>$data_item->inspectorRemarks,
								'Date Complied' =>'',
								'Date Forwarded to Process Owner' =>'',
								'Date Release to Records' =>'',
								'Team Leader' =>$data_item->inspectorName,
								'Status' =>$data_item->trns_desc
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}

				$fo_action = 'employee/reports/inspection/aspinspection';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>'34', 'd_assignedRgn'=>$d_assignedRgn]);
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

	public function generalinspection(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.inspection.generalinspection';
				$fo_action = 'employee/reports/inspection/generalinspection';
				$title ='General Inspection Log Sheet Report';
				$nolimit = false; 
				$hfser = null;

				$Cur_useData = AjaxController::getCurrentUserAllData();
				
				/*$d_assignedRgn = null;

				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn; */

				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}
				
				$data = SELF::application_filter($request, 'rpt_inspection_logsheet', $hfser, $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];
						$data_array[] = array("Region","Complete Address", "Application Code","Name of Facility","Type Of Facility","Institutional Character","Tel.No.","Fax.No.","Email Address","Head Of Facility","Head of Facility Position","Head of Facility Position","Payment","Date Applied","Date Inspected","Type of Application","Remarks","Team Leader","Status");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname.' '.$data_item->zipcode,
								'Application Code' =>$data_item->appid,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->hgpdesc,
								'Institutional Character' =>$data_item->facmdesc,
								'Tel.No.' =>$data_item->landline,
								'Fax.No.' =>$data_item->faxnumber,
								'Email Address' =>$data_item->email,
								'Head Of Facility' =>$data_item->approvingauthority,
								'Head of Facility Position' =>$data_item->approvingauthoritypos,
								'Payment' =>$data_item->payment,
								'Owner' =>$data_item->owner,
								'Payment' =>$data_item->payment,
								'Date Applied' =>$data_item->formattedDate,
								'Date Inspected' =>$data_item->formattedDateInspect,
								'Type of Application' =>$data_item->aptid.'/'.$data_item->hfser_id.'/'. $data_item->ocdesc.'/'.$data_item->classname.'/ No.Of Bed='.$data_item->noofbed.'/ No.Of Dialysis='.$data_item->noofbed,
								'Remarks' =>$data_item->inspectorRemarks,
								'Team Leader' =>$data_item->inspectorName,
								'Status' =>$data_item->trns_desc
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}


				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=> null, 'd_assignedRgn'=>$d_assignedRgn]);
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

	public function certificate_list_edit(Request $request, $isEdit=false)
	{
		if(session()->has('employee_login'))
		{
			return self::certificate_list( $request, true);		
		}
		else 
		{
			return redirect()->route('employee');
		}
	}

	public function certificate_list(Request $request, $isEdit=false)
	{
		if(session()->has('employee_login'))
		{
			try 
			{
				$result = "";

				$arrType = array();
				$viewpage = 'employee.reports.license.license_certificate';
				$title ='View Certificates (List of Facilities with Certificates)';
				$fo_action = 'employee/reports/license/Certificates/facilities';
				$nolimit = false; 
				$hfser = null;
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				if($isEdit)
				{ 
					$title = 'Edit Issued Certificate Number'; 
					$fo_action = 'employee/reports/license/Certificates/edit';
				
					if ($request->isMethod('post')) {
						$hfser_id =  $request->hfser_id;
						$request->fo_submit = "submit";
						//dd($request);

						DB::table('appform')->where('appid', '=', $request->appid)->update([
							'licenseNo' => $request->licenseNo, 
							'approvedDate' 	=> $request->approvedDate, 
							'signatoryname' => $request->signatoryname, 
							'signatorypos'	=> $request->signatorypos]);

						if($hfser_id == "LTO")
						{
							DB::table('registered_facility')->where('regfac_id', '=', $request->regfac_id)->update([
								'lto_id' 		=> $request->licenseNo, 
								'lto_approveddate' 	=> $request->approvedDate
							]);
						}
						else if($hfser_id == "ATO")
						{
							DB::table('registered_facility')->where('regfac_id', '=', $request->regfac_id)->update([
								'ato_id' => $request->licenseNo, 
								'ato_approveddate' 	=> $request->approvedDate
							]);
						}
						else if($hfser_id == "COA")
						{
							DB::table('registered_facility')->where('regfac_id', '=', $request->regfac_id)->update([
								'coa_id' => $request->licenseNo, 
								'coa_approveddate' 	=> $request->approvedDate
							]);
						}
						else if($hfser_id == "COR")
						{
							DB::table('registered_facility')->where('regfac_id', '=', $request->regfac_id)->update([
								'cor_id' => $request->licenseNo, 
								'cor_approveddate' 	=> $request->approvedDate
							]);
						}
						else if($hfser_id == "PTC")
						{
							DB::table('registered_facility')->where('regfac_id', '=', $request->regfac_id)->update([
								'ptc_id' => $request->licenseNo, 
								'ptc_approveddate' 	=> $request->approvedDate
							]);
						}
					}
				}

				/*if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
					$request->fo_assignedRgn = $d_assignedRgn;
					$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;
				}
				else if(isset($request->fo_assignedRgn) == true)
				{
					$data['arr_fo']['fo_assignedRgn']  = $request->fo_assignedRgn;
				}	 */

				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;	
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::application_filter($request, 'rpt_license_facilities', $hfser, $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];
						$data_array[] = array("Region","Complete Address","Name of Facility","Type Of Facility","Approving Authority","Approving Authority Postion","Owner","Ownership","Class","Subclass","DOH Retained","Telephone No.","Fax No.","Email","Authorization Type","License ID","Date Issued","Certificate Signatory", "Certificate Signatory Position", "Remarks", "Certificate URL");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname.' '.$data_item->zipcode,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->hgpdesc,

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
								'License ID' =>$data_item->licenseNo,
								
								'Date Issued' =>$data_item->formattedDateApprove,
								'Certificate Signatory' => $data_item->signatoryname,
								'Certificate Signatory Position' => $data_item->signatorypos,
								'Remarks' =>$data_item->approvedRemark,
								'Certificate URL' =>asset('client1/certificates/'.$data_item->hfser_id.'/'.$data_item->appid)
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}


				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_assignedRgn'=>$d_assignedRgn, 'isEdit' => $isEdit]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return redirect()->route('employee');
			}		
		}
		else 
		{
			return redirect()->route('employee');
		}
	}

	public function license_facilities(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.license.license_facilities';
				$title ='Licensed Facilities Report';
				$nolimit = false; 
				$hfser = null;				
				$Cur_useData = AjaxController::getCurrentUserAllData();		
				/*
				$d_assignedRgn = null;
				
				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
					$request->fo_assignedRgn = $d_assignedRgn;
					$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;
				}
				else if(isset($request->fo_assignedRgn) == true)
				{
					$data['arr_fo']['fo_assignedRgn']  = $request->fo_assignedRgn;
					$d_assignedRgn = null;
				}	*/
				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
					$hfser = $request->fo_facilityname;
				}

				$data = SELF::application_filter($request, 'rpt_license_facilities', $hfser, $nolimit);
				
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

				$fo_action = 'employee/reports/license/facilities';

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

	public function license_infirmary(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.license.license_facilities';
				$title ='List Of Licensed/No Renewal Infirmary Facilities';
				$nolimit = false; 
				$hfser = null;

				$request->fo_hgpid = '17';
				$data['arr_fo']['fo_hgpid']='17';

				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				/*if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
					$request->fo_assignedRgn = $d_assignedRgn;
					$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;
				}
				else if(isset($request->fo_assignedRgn) == true)
				{
					$data['arr_fo']['fo_assignedRgn']  = $request->fo_assignedRgn;
					$d_assignedRgn = null;
				}	*/

				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
					$hfser = $request->fo_facilityname;
				}

				$data = SELF::application_filter($request, 'rpt_license_facilities', $hfser, $nolimit);
				
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

				$fo_action = 'employee/reports/license/infirmary';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>'17',  'd_assignedRgn'=>$d_assignedRgn]);
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

	public function license_birthing(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.license.license_birthing';
				$title ='List Of Licensed/No Renewal LTO Birthing Facilities';
				$nolimit = false; 
				$hfser = null;
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				/*if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
					$request->fo_assignedRgn = $d_assignedRgn;
					$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;
				}
				else if(isset($request->fo_assignedRgn) == true)
				{
					$data['arr_fo']['fo_assignedRgn']  = $request->fo_assignedRgn;
					$d_assignedRgn = null;
				}	*/

				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				$request->fo_hgpid = '18';
				$data['arr_fo']['fo_hgpid']='18';

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
					$hfser = $request->fo_facilityname;
				}

				$data = SELF::application_filter($request, 'rpt_license_facilities', $hfser, $nolimit);
				
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

				$fo_action = 'employee/reports/license/birthing';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>'18', 'd_assignedRgn'=>$d_assignedRgn]);
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

	public function license_ldwa(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.license.license_ldwa';
				$title ='List Of Accredited Laboratories For Drinking Water Analysis';
				$nolimit = false; 
				$hfser = null;
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				/*if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
					$request->fo_assignedRgn = $d_assignedRgn;
					$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;
				}
				else if(isset($request->fo_assignedRgn) == true)
				{
					$data['arr_fo']['fo_assignedRgn']  = $request->fo_assignedRgn;
					$d_assignedRgn = null;
				}	*/

				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;
				
				$request->fo_hgpid = '11';
				$data['arr_fo']['fo_hgpid']='11';

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
					$hfser = $request->fo_facilityname;
				}

				$data = SELF::application_filter($request, 'rpt_license_facilities', $hfser, $nolimit);
				
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

				$fo_action = 'employee/reports/license/ldwa';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>'11', 'd_assignedRgn'=>$d_assignedRgn]);
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

	public function license_psychiatric(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.license.license_psychiatric';
				$title ='List Of Licensed/No Issuance LTO Psychiatric Care Facilities';
				$nolimit = false; 
				$hfser = null;
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				/*if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
					$request->fo_assignedRgn = $d_assignedRgn;
					$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;
				}
				else if(isset($request->fo_assignedRgn) == true)
				{
					$data['arr_fo']['fo_assignedRgn']  = $request->fo_assignedRgn;
					$d_assignedRgn = null;
				}	*/

				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;
				
				$request->fo_hgpid = '7';
				$data['arr_fo']['fo_hgpid']='7';

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
					$hfser = $request->fo_facilityname;
				}

				$data = SELF::application_filter($request, 'rpt_license_facilities', $hfser, $nolimit);
				
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

				$fo_action = 'employee/reports/license/psychiatric';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>'7', 'd_assignedRgn'=>$d_assignedRgn]);
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

	/************** Not yet done*****************/
	public function nonissuance_applist(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.nonissuance.nonissuance_applist';
				$title ='Non Issuance Applications Report';
				$nolimit = false; 
				$hfser = null;
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				/*if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;*/

				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::application_filter($request, 'rpt_nonissuance_facilities', $hfser, $nolimit);
				
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
								'Authorization Applied' =>$data_item->hfser_id,
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

				$fo_action = 'employee/reports/nonissuance/applist';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_assignedRgn'=>$d_assignedRgn]);
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

	public function nonissuance_ldwa(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.nonissuance.nonissuance_ldwa';
				$title ='No Issuance Report of Accredited Laboratories For Drinking Water Analysis';
				$nolimit = false; 
				$hfser = null;
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				/*if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;*/

				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::application_filter($request, 'rpt_nonissuance_facilities', $hfser, $nolimit);
				
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
								'Authorization Applied' =>$data_item->hfser_id,
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

				$fo_action = 'employee/reports/nonissuance/ldwa';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>'11','d_assignedRgn'=>$d_assignedRgn]);
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

	public function paidapplicantbydate(Request $request)
	{
		if(session()->has('employee_login'))
		{	

			$fo_action = 'employee/reports/cashier/paidapplicantbydate';		
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.cashier.paidapplicantbydate';
				$title ='Listing of Paid Application';
				$nolimit = false; 
				$hfser = null;
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				/*
				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn; */

				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::application_filter($request, 'rpt_cashier_summary', $hfser, $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];
						$data_array[] = array("Region","Complete Address","Process","Type","App ID","Name of Facility","Type Of Facility","Ownership","Class" ,"Payment Date","Cashier","Is HFEP","HFEP Funded","Payment Amount","Payment Status","Transaction Status");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname.' '.$data_item->zipcode,
								'Process' =>$data_item->aptdesc,
								'Type' =>$data_item->hfser_desc,
								'App ID' =>$data_item->appid,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->hgpdesc,
								'Ownership' =>$data_item->ocdesc,
								'Class' =>$data_item->classname,
								'Payment Date' =>$data_item->CashierApproveformattedDate,
								'Cashier' =>$data_item->CashierApproveBy,
								'IS HFEP' =>$data_item->ishfep,
								'HFEP Funded' =>$data_item->hfep_funded,
								'Total Payments' =>$data_item->totalpayment,
								'Payment Status' =>$data_item->paymentstatus,
								'Transaction Status' =>$data_item->trns_desc
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_assignedRgn'=>$d_assignedRgn]);
			} 
			catch (Exception $e)
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return view($fo_action);
			}
		}
		else 
		{
			return redirect()->route('employee');
		}		
	}


	public function listOf_Registeredfacilities(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.ndhrhis.byregisteredfacilities';
				$title ='Registered Facilities Report';
				$nolimit = false; 
				$viewtype = 0;
				
				$Cur_useData = AjaxController::getCurrentUserAllData();
				$d_assignedRgn = null;

				/*
				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn; */

				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::registered_facility_filter($request, 'view_registered_facility', $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];

						$data_array[] = array("Region","Complete Address","NHFR Code","Registered Facility ID","Name of Facility","Type Of Facility","Bed Capacity","Approving Authority","Approving Authority Postion","Owner","Ownership","Class","Telephone No.","Fax No.","Email");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname.' '.$data_item->zipcode,
								'NHFR Code' =>$data_item->nhfcode,
								'Registered Facility ID' =>$data_item->regfac_id,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->facilitytype,
								'Bed Capacity' =>$data_item->noofbed,

								'Approving Authority' =>$data_item->approvingauthority,
								'Approving Authority Postion' =>$data_item->approvingauthoritypos,
								'Owner' =>$data_item->owner,
								'Ownership' =>$data_item->ocdesc,
								'Class' =>$data_item->classname,

								'Telephone No.' =>$data_item->landline,
								'Fax No.' =>$data_item->faxnumber,
								'Email' =>$data_item->email
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}
				
				$fo_action = 'employee/reports/ndhrhis/byregisteredfacilities';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>null, 'd_assignedRgn'=>$d_assignedRgn, 'viewtype'=>$viewtype]);
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

	public function ndhrhis_byregisteredfacilities(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.ndhrhis.byregisteredfacilities';
				$title ='Registered Facilities Report';
				$nolimit = false; 
				$viewtype = 1;
				
				$Cur_useData = AjaxController::getCurrentUserAllData();
				/*$d_assignedRgn = null;

				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;*/
				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::registered_facility_filter($request, 'view_registered_facility', $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];

						$data_array[] = array("Region","Complete Address","NHFR Code","Registered Facility ID","Name of Facility","Type Of Facility","Bed Capacity","Approving Authority","Approving Authority Postion","Owner","Ownership","Class","Telephone No.","Fax No.","Email");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname.' '.$data_item->zipcode,
								'NHFR Code' =>$data_item->nhfcode,
								'Registered Facility ID' =>$data_item->regfac_id,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->facilitytype,
								'Bed Capacity' =>$data_item->noofbed,

								'Approving Authority' =>$data_item->approvingauthority,
								'Approving Authority Postion' =>$data_item->approvingauthoritypos,
								'Owner' =>$data_item->owner,
								'Ownership' =>$data_item->ocdesc,
								'Class' =>$data_item->classname,

								'Telephone No.' =>$data_item->landline,
								'Fax No.' =>$data_item->faxnumber,
								'Email' =>$data_item->email
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}
				
				$fo_action = 'employee/reports/ndhrhis/byregisteredfacilities';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_hgpid'=>null, 'd_assignedRgn'=>$d_assignedRgn, 'viewtype'=>$viewtype]);
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

	public function annexa_list(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.regfacilities.annexa_personnellist';
				$title ='List of Personnel Report by Registered Facility Report';
				$nolimit = false; 
				$regfac_id = $request->regfac_id;
				$facilityname = NULL;

				if(isset($regfac_id))
				{
					$facilityname = RegFaciController::get_facilityname_byregfac_id($regfac_id);
				}
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::registered_personnel_filter($request, 'view_reg_annexa_personnel', $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];

						$data_array[] = array("Prefix","First Name","Middle Name","Surname","Suffix","Profession","PRC No.","Validity Period To","Specialty","Date Of Birth","Sex","Employment Status","Position","Designation","Area","Qual","Email","Tin","Main Rad.","Main Pharma","Main Rad and Pharma","Chief Rad.Tech","X-ray Tech","Status","Remarks");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								
								'Prefix'=>$data_item->prefix,
								'First Name'=>$data_item->firstname,
								'Middle Name'=>$data_item->middlename,
								'Surname'=>$data_item->surname,
								'Suffix'=>$data_item->suffix,
								'Profession'=>$data_item->profession_official,
								'PRC No.'=>$data_item->prcno,
								'Validity Period To'=>$data_item->validityPeriodTo,
								'Specialty'=>$data_item->speciality,
								'Date Of Birth'=>$data_item->dob,
								'Sex'=>$data_item->sex,
								'Employment Status'=>$data_item->employement,
								'Position'=>$data_item->pos,
								'Designation'=>$data_item->designation,
								'Area'=>$data_item->area,
								'Qual'=>$data_item->qual,
								'Email'=>$data_item->email,
								'Tin'=>$data_item->tin,
								'Main Rad. Officer'=>$data_item->isMainRadio,
								'Main Pharma Officer'=>$data_item->ismainpo,
								'Main Rad and Pharma'=>$data_item->isMainRadioPharma,
								'Chief Rad.Tech'=>$data_item->isChiefRadTech,
								'Head of X-ray Tech'=>$data_item->isXrayTech,
								'Status'=>$data_item->status,
								'Remarks'=>$data_item->remarks
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}

				$user = AjaxController::getAllRegisteredFacilityDetailsByRegFacID('view_registered_facility', $regfac_id);				
				$data_rfa = DB::table('reg_facility_archive')
							->select('recordtype.rectype_desc', 'reg_facility_archive.*')
							->leftJoin('recordtype','reg_facility_archive.rectype_id','=','recordtype.rectype_id')
							->where('reg_facility_archive.regfac_id','=',$regfac_id)
							->get();
				$user = $user[0];
				
				$fo_action = 'employee/regfacility/annexa/' . $regfac_id;

				return view($viewpage, [
					'pg_title'=>$title, 
					'actiontab' => 'personnel',
					'user' => $user,
					'data' => $data_rfa,
					'LotsOfDatas' => $data['data'], 
					'arr_fo'=>$data['arr_fo'], 
					'fo_action'=>$fo_action, 
					'pg_regfac_id'=>$regfac_id, 
					'pg_facilityname'=>$facilityname
				]);
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

	public function ndhrhis_byregisteredfacilities_annexa(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.ndhrhis.byregisteredfacilities_annexa';
				$title ='List of Personnel Report by Registered Facility Report';
				$nolimit = false; 
				$regfac_id = $request->regfac_id;
				$facilityname = NULL;

				if(isset($regfac_id))
				{
					$facilityname = RegFaciController::get_facilityname_byregfac_id($regfac_id);
				}
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::registered_personnel_filter($request, 'view_reg_annexa_personnel', $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];

						$data_array[] = array("Prefix","First Name","Middle Name","Surname","Suffix","Profession","PRC No.","Validity Period To","Specialty","Date Of Birth","Sex","Employment Status","Position","Designation","Area","Qual","Email","Tin","Main Rad.","Main Pharma","Main Rad and Pharma","Chief Rad.Tech","X-ray Tech","Status","Remarks");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								
								'Prefix'=>$data_item->prefix,
								'First Name'=>$data_item->firstname,
								'Middle Name'=>$data_item->middlename,
								'Surname'=>$data_item->surname,
								'Suffix'=>$data_item->suffix,
								'Profession'=>$data_item->profession_official,
								'PRC No.'=>$data_item->prcno,
								'Validity Period To'=>$data_item->validityPeriodTo,
								'Specialty'=>$data_item->speciality,
								'Date Of Birth'=>$data_item->dob,
								'Sex'=>$data_item->sex,
								'Employment Status'=>$data_item->employement,
								'Position'=>$data_item->pos,
								'Designation'=>$data_item->designation,
								'Area'=>$data_item->area,
								'Qual'=>$data_item->qual,
								'Email'=>$data_item->email,
								'Tin'=>$data_item->tin,
								'Main Rad. Officer'=>$data_item->isMainRadio,
								'Main Pharma Officer'=>$data_item->ismainpo,
								'Main Rad and Pharma'=>$data_item->isMainRadioPharma,
								'Chief Rad.Tech'=>$data_item->isChiefRadTech,
								'Head of X-ray Tech'=>$data_item->isXrayTech,
								'Status'=>$data_item->status,
								'Remarks'=>$data_item->remarks
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}
				
				$fo_action = 'employee/regfacility/annexa/' . $regfac_id;

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'fo_action'=>$fo_action, 'pg_title'=>$title, 'pg_regfac_id'=>$regfac_id, 'pg_facilityname'=>$facilityname]);
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
	
	/*public function inspectionPTC(Request $request){
		$dataFromDB = DB::select('SELECT distinct appform.appid, facilityname, hferc_evaluation.revision, appform.hfser_id, appform.rgnid FROM hferc_evaluation join appform on appform.appid = hferc_evaluation.appid join assessmentcombinedduplicateptc on appform.appid = assessmentcombinedduplicateptc.appid join assessmentrecommendation on appform.appid = assessmentrecommendation.appid');

		return view('employee.reports.ptcinspection', ['servCap' => $dataFromDB]);
	}*/

	public function inspectionPTC(Request $request)
	{
		if(session()->has('employee_login'))
		{			
			try 
			{
				$arrType = array();
				$viewpage = 'employee.reports.ptcinspection';
				$title ='Evaluation Report (Checklist)';
				$nolimit = false; 
				$hfser = "PTC";
				$Cur_useData = AjaxController::getCurrentUserAllData();
				/*$d_assignedRgn = null;

				if($Cur_useData['grpid'] != 'NA')
				{
					$d_assignedRgn = $Cur_useData['rgnid'];
				}

				$request->fo_assignedRgn = $d_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn; */
				
				$d_assignedRgn = $request->fo_assignedRgn;
				$data['arr_fo']['fo_assignedRgn'] = $d_assignedRgn;

				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$nolimit = true; //true if for export
					}
				}

				$data = SELF::application_filter($request, 'rpt_evaluation_ptc_checklist', $hfser, $nolimit);
				
				if(empty($request->fo_submit) == false)
				{
					if($request->fo_submit == 'csv') 
					{ 
						$tbl = $data['data'];
						$data_array[] = array("Region","Complete Address","Type","App ID","Name of Facility","Type Of Facility","Date Applied", "Ownership","Class" ,"Contruction Type","Evaluation Status","Approved Date",  "Recommended By", "Evaluation Date", "Review");

						foreach($data['data']  as $data_item)
						{
							$data_array[] = array(
								'Region' =>$data_item->rgn_desc,
								'Complete Address' =>$data_item->street_number.' '.$data_item->street_name.' '.$data_item->brgyname. ', '. $data_item->cmname.', '.$data_item->provname. ', '.$data_item->zipcode,
								'Type' =>$data_item->hfser_desc,
								'App ID' =>$data_item->appid,
								'Name of Facility' =>$data_item->facilityname,
								'Type Of Facility' =>$data_item->hgpdesc,
								'Date Applied' =>$data_item->formattedDate,
								'Ownership' =>$data_item->ocdesc,
								'Class' =>$data_item->classname,
								'Contruction Type' => $data_item->ptctype_desc,
								'Evaluation Status' =>$data_item->trns_desc,
								'Approved Date' =>$data_item->formattedDateApprove,
								'Recommended By' =>'('.$data_item->recommendedby.')'. $data_item->recommendedbyName,
								'Evaluation Date' =>$data_item->formattedDateEval,
								'Review' =>$data_item->revision
							);
						}

						$this->ExportExcel($data_array, $title);
						$data['data'] = array();
						$data['arr_fo']= array();
					} 	
				}

				$fo_action = 'employee/reports/ptcevaluation/checklist';

				return view($viewpage, ['LotsOfDatas' => $data['data'], 'arr_fo'=>$data['arr_fo'], 'hfser_id' => $hfser, 'fo_action'=>$fo_action, 'pg_title'=>$title, 'd_assignedRgn'=>$d_assignedRgn]);
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e);
				session()->flash('system_error','ERROR');
				return redirect()->route('employee');
			}
		}
		else 
		{
			return redirect()->route('employee');
		}		
	}

	public function recommended(Request $request){
		return self::toReturnNotNullEntryField('isRecoForApproval');
	}
	public function approved(Request $request){
		return self::toReturnNotNullEntryField('isApprove');
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

		if($Cur_useData['grpid'] != 'NA'){
			$urgnid = $Cur_useData['rgnid'];

			$dataFromDB = DB::select("SELECT distinct appform.appid, facilityname, appform.hfser_id, appform.rgnid, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.mailingAddress, 
			appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, region.rgn_desc, appform.zipcode from appform LEFT JOIN barangay ON appform.brgyid=barangay.brgyid LEFT JOIN city_muni ON appform.cmid=city_muni.cmid LEFT JOIN province ON appform.provid=province.provid LEFT JOIN region ON appform.rgnid=region.rgnid 
			LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid where `$field` IS NOT NULL AND (appform.assignedRgn = '$urgnid' OR appform.rgnid = '$urgnid' )order by appid DESC");
	
		}else{
			$dataFromDB = DB::select("SELECT distinct appform.appid, facilityname, appform.hfser_id, appform.rgnid, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.mailingAddress, 
			appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, region.rgn_desc, appform.zipcode from appform LEFT JOIN barangay ON appform.brgyid=barangay.brgyid LEFT JOIN city_muni ON appform.cmid=city_muni.cmid LEFT JOIN province ON appform.provid=province.provid LEFT JOIN region ON appform.rgnid=region.rgnid 
			LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid where `$field` IS NOT NULL order by appid DESC");
	
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
