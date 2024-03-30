<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AjaxController;
use DB;

class ReportsControllerFDA extends ReportsController
{
    //

	public function xrayAppList(Request $request){
		try 
		{
			$clientChoice = 'machines';
			$clientChoice = AjaxController::isRequestForFDA($clientChoice);
			$data = AjaxController::getAllApplicantsProcessFlow();
			
			return view('employee.reportsFDA.rpt_applicationxray', ['BigData'=>$data,'request' => $clientChoice]);
		} 
		catch (Exception $e) 
		{
			AjaxController::SystemLogs($e);
			session()->flash('system_error','ERROR');
			return view('employee.reportsFDA.rpt_applicationxray');
		}
	}

	public function pharmaAppList(Request $request){
		try 
		{
			$clientChoice = 'pharma';
			$clientChoice = AjaxController::isRequestForFDA($clientChoice);
			$data = AjaxController::getAllApplicantsProcessFlow();
			
			return view('employee.reportsFDA.rpt_applicationxray', ['BigData'=>$data,'request' => $clientChoice]);
		} 
		catch (Exception $e) 
		{
			AjaxController::SystemLogs($e);
			session()->flash('system_error','ERROR');
			return view('employee.reportsFDA.rpt_applicationxray');
		}
	}

}
