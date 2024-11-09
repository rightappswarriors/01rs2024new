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
	use Maatwebsite\Excel\Facades\Excel;
	use Schema;
	use AjaxController;

	class data {
		public $region;
		public $province;
		public $cm;
		public $brgy;
	}

	class AssessmentController extends Controller
	{
		public function hospital1(Request $request) {
			// DB::table('app_assessment')->insert([
			//     ['appid' => $char,'t_date' => AjaxController::getCurrentUserAllData()['date'],'t_time' => AjaxController::getCurrentUserAllData()['time'],'assessedby' => AjaxController::getCurrentUserAllData()['cur_user'],'uid' => $request->uid,'temporaryDataStore' => json_encode($request->except('_token','hfser_id','aptid','uid','appID','facilityname'))]
			// ]);
			return view('employee.assessment.hospitallevel1',['data' => json_encode($request->except('_token','appID','hfser_id','aptid','facilityname','uid','filename'))]);
			// dd(array_values($request->except('_token','appID','hfser_id','aptid','facilityname','uid')));
		}


		// syrel
		public function hospital2() {
			return view('employee.assessment.hospitallevel2');
		}

		public function hospital3() {
			return view('employee.assessment.hospitallevel3');
		}

		public function nursingservice() {
			return view('employee.assessment.nursingservice');
		}

		public function physicalplant() {
			return view('employee.assessment.physicalplant');
		}

		public function dialysisclinic() {
			$region = AjaxController::getAllRegion();
			$province = AjaxController::getAllProvince();
			$cm = AjaxController::getAllCityMunicipality();
			// $brgy = AjaxController::getAllBarangay();

			$data = new data();
			$data->region = $region;
			$data->province = $province;
			$data->cm = $cm;
			// $data->brgy = $brgy;
			// return dd($data);
			return view('employee.assessment.dialysisclinic', ['data'=>$data]);
		}

		public function ambsurclinic() {
			$region = AjaxController::getAllRegion();
			$province = AjaxController::getAllProvince();
			$cm = AjaxController::getAllCityMunicipality();

			$data = new data();
			$data->region = $region;
			$data->province = $province;
			$data->cm = $cm;
			return view('employee.assessment.ambsurclinic', ['data'=>$data]);
		}

		public function mat()
		{
        	// $data = Excel::load('storage/app/assessment/SAMPOL.xlsx', function($reader) {})->get();
        	// dd($data->toArray());

			// dd($request->title);
        	return view('employee.samplemat');

   //      	$__tableHead = $data->getHeading(); $__tableName = "sample";
   //      	$items = $data;
   //      	$__newName = []; $__newValue = [];
   //      	$__newRow = [];
   //      	if(isset($__tableName) && !empty($__tableName)) {
   //      		$_tCreate = false;
	  //       	if(!Schema::hasTable($__tableName)) {
	  //       		if(is_array($__tableHead)) {
		 //        		Schema::create($__tableName, function($table) use ($__tableHead) {
		 //        			$table->increments('id');
		 //        			for($i = 0; $i < count($__tableHead); $i++) {
		 //        				$table->text($__tableHead[$i]);
		 //        			}
		 //        		});
		 //        	}
	  //       	}
	        	
	  //       	if(Schema::hasTable($__tableName)) {
		 //        	for($i = 0; $i < count($items); $i++) {
			// 			foreach($items[$i] AS $name => $value) {
			// 				array_push($__newName, $name); array_push($__newValue, $value);
			// 			}
			// 			array_push($__newRow, array_combine($__newName, $__newValue));
			// 		}
			// 		DB::table($__tableName)->insert($__newRow);
			// 	}
			// }
		}

		public function preview(Request $request)
		{

			$value = false;
			$file = $request->logo;
			$mime = $file->getMimeType();
			$extension = $file->getClientOriginalExtension();
			$counter = 0;

			if(Session::has('status')){
				$request->session()->forget('status');
			}

			$accepted_mime = array(
				'word' => [
					'mime' => [
						'msword',
						'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
						'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
					],
					'extension' => [
						'docx',
						'dotx',
						'doc'
					]
				],
				'excel'=>[
					'mime' => [
						'application/vnd.ms-excel',
						'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
						'application/vnd.openxmlformats-officedocument.spreadsheetml.template'
					],
					'extension' => [
						'xls',
						'xlsx'
					]
				],
				'csv'=>[
					'mime' => [
						'application/text',
						'application/csv'
					],
					'extension' => [
						'csv'
					]
				]
			);

			foreach ($accepted_mime as $data) {
				if(in_array($mime,$data['mime']) && in_array($extension,$data['extension'])){
					$value = true;
				}
			}

			if($value === true){
				$timeNow = strtotime(Carbon::now());
				$filenameOnly = $file->storeAs('/public/uploaded',$timeNow.'.'.$extension);
				$data = Excel::load('/storage/app/public/uploaded/'.$timeNow.'.'.$extension, function($reader) {})->get()->toArray();
				foreach ($data[1] as $records) {
					DB::table('practice_table')->insert(
					    ['yesNo' => $records['complied'], 'remarks' => $records['remarks']]
					);
				}
				$request->session()->flash('status', 'Success!');
				$request->session()->flash('data', $data);
			} else {
				$request->session()->flash('status', 'Please Upload a valid file!');
			}

			return view('employee.samplemat',compact('data'));
		}
		
		public function samples(Request $request)
		{	
			$allAccess = array();
			$countColoumn = DB::SELECT("SELECT count(*) as 'all' FROM information_schema.columns WHERE table_name = 'asmt2'")[0]->all -1;
			$index = 0;
			$joinedData = DB::table('appform')
			->where('appform.appid', '=', '30')
            ->join('serv_asmt', 'appform.serv_capabilities', '=', 'serv_asmt.facid')
            ->join('facilitytyp', 'appform.serv_capabilities', '=', 'facilitytyp.facid')
            ->join('hfaci_serv_type', 'appform.hfser_id', '=', 'hfaci_serv_type.hfser_id')
            ->join('type_facility', 'appform.hfser_id', '=', 'type_facility.hfser_id')
            ->join('asmt2', 'asmt2.asmt2_id', '=', 'serv_asmt.asmt2_id')
            ->join('asmt2_sdsc', 'asmt2_sdsc.asmt2sd_id', '=', 'asmt2.asmt2sd_id')
            ->join('asmt2_loc', 'asmt2_loc.asmt2l_id', '=', 'asmt2.asmt2_loc')
            ->orderBy('serv_asmt.srvasmt_seq','asc')->get();
            $joinedData = json_decode($joinedData,true);
            foreach ($joinedData as $data) {
	            if($countColoumn){
	            	for ($i=2; $i <= $countColoumn ; $i++) {
	            		$actualHeader = 'header_lvl'.$i;
	            		if(Schema::hasColumn('asmt2_loc', $actualHeader))
						{	
							if($data[$actualHeader] !== NULL){
								$newData = DB::table('asmt2_loc')->where('asmt2l_id',$data[$actualHeader])->select('asmt2l_desc')->get()->toArray()[0]->asmt2l_desc;
								$joinedData[$index][$actualHeader.'value'] = $newData;
							}
						}
	            	}
	            }
	            $index +=1;
            }
            // dd($joinedData);
            return view('employee.assessment.assessment',compact('joinedData')); 
		}


		//////////////////////ADD HEADER AREA
		public static function getAllHeaders()
		{
			try 
			{
				$data = DB::table('asmt2_loc')->get();
				return $data;
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return null;
			}
		}

		public static function getHeaders(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					$Mods = DB::table('asmt2_loc')->get();
					return view('employee.masterfile.mfAssessmentHeader',compact('Mods'));
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e->getMessage());
					session()->flash('system_error','ERROR');
					return view('employee.manage.mmodules');					
				}
			}
			if ($request->isMethod('post')) 
			{
				try 
				{
					DB::table('asmt2_loc')->insert(['asmt2l_id' => strtoupper($request->id), 'asmt2l_desc' => $request->name, 'asmt2l_sdesc'=> $request->subDesc ,'header_lvl' => $request->lvl, 'header_lvl1' => $request->lvl1, 'header_lvl2' => $request->lvl2, 'header_lvl3' => $request->lvl3, 'header_lvl4' => $request->lvl4]);
					return 'DONE';
				} 
				catch (Exception $e) 
				{
					AjaxController::SystemLogs($e->getMessage());
					return 'ERROR';
				}
			}
		}

		public static function getlvlFilter(Request $request)
		{
			try 
			{
				$data = DB::table('asmt2_loc')->where('header_lvl', '=', $request->modlvl)->get();
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}

		public static function getlvlFilterFromLevel(Request $request)
		{
			try 
			{
				if($request->getData){
					$data = DB::table('asmt2_loc')->where([
						['header_lvl','=',$request->headerLevel],
						['header_lvl'.$request->level, '=', $request->code],
					])->get();
				} else {
				$data = DB::table('asmt2_loc')->where([['header_lvl'.$request->level, '=', $request->modlvl], ['header_lvl', '=', ($request->level+1)]])->get();
				}
				return $data;
			}
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}

		public static function saveHeader(Request $request)
		{
			try 
			{
				if($request->action != 'edit'){
					$test = DB::table('asmt2_loc')->where('asmt2l_id', '=', $request->id)->delete();
				} else {
					$update = array('asmt2l_desc'=>$request->name,'asmt2l_sdesc'=>$request->desc);
					$test = DB::table('asmt2_loc')->where('asmt2l_id', $request->id)->update($update);
				}
				if ($test) {return 'DONE';} 
				else 
				{
					AjaxController::SystemLogs('No data has been changed on asmt2_loc table. (saveHeader)');
					return 'ERROR';
				}
			} 
			catch (Exception $e) 
			{
				AjaxController::SystemLogs($e->getMessage);
				return 'ERROR';
			}
		}


		/////header one

		public function headerOne(Request $request)
		{
			if($request->isMethod('get')){
				$allData = [
					'allData' => DB::table('asmt_h1')->join('asmt_title','asmt_title.title_code','asmt_h1.partID')->join('hfaci_serv_type','hfaci_serv_type.hfser_id','asmt_h1.apptype')->get(),
					'part' => DB::table('asmt_title')->where([['asmt_title.serv','<>',null]])->get(),
					'apptype' => AjaxController::getAllApplicationType()
				];
				// dd($allData);
				return view('employee.masterfile.mfAssessmentHeaderOne',$allData);
			} else {
				if($request->isMethod('post')){
					try {
						$table = 'asmt_h1';
						switch ($request->action) {
							case 'add':
								$test = DB::table($table)->insert(
							    	['h1name' => $request->id, 'partID' => $request->serv, 'apptype' => $request->apptype]
								);
								break;
							case 'delete':
								$test = DB::table($table)->where('asmtH1ID',$request->id)->delete();
								break;
							case 'edit':
								$test = DB::table($table)->where('asmtH1ID',$request->id)->update(['h1name' => $request->name, 'partID' => $request->serv, 'apptype' => $request->apptype]);
								break;
							case 'copy':
								$newlvl1Id = DB::table($table)->insertGetId(
							    	['h1name' => $request->name, 'partID' => $request->serv, 'apptype' => $request->apptype]
								);
								$all = DB::table('asmt_h2')->where('asmtH1ID_FK',/*lvl1id*/$request->id)->get();
								foreach ($all as $key) {
									$newidLvl2 = DB::table('asmt_h2')->insertGetId(['h2name' => $key->h2name, 'isAssess' => $key->isAssess, 'asmtH1ID_FK' => $newlvl1Id]);
									$getOnLvlv3 = DB::table('asmt_h3')->where('asmtH2ID_FK',$key->asmtH2ID)->get();
									foreach ($getOnLvlv3 as $forlvl3) {
										$newidLvl3IDDB = DB::table('asmt_h3')->insertGetId(['h3name' => $forlvl3->h3name, 'asmtH2ID_FK' => $newidLvl2]);
										$getAssessmentCombine = DB::table('assessmentcombined')->where('asmtH3ID_FK',$forlvl3->asmtH3ID)->orderBy('assessmentSeq','ASC')->get();
										foreach ($getAssessmentCombine as $forAssessmentCombine) {
											$lastSeq = DB::table('assessmentcombined')->max('assessmentSeq');
											$assessmentNewId = DB::table('assessmentcombined')->insertGetId(['assessmentName' => $forAssessmentCombine->assessmentName, 'assessmentStatus' => $forAssessmentCombine->assessmentStatus, 'assessmentSeq' => $lastSeq +1, 'asmtH3ID_FK' => $newidLvl3IDDB, 'headingText' => $forAssessmentCombine->headingText, 'subFor' => $forAssessmentCombine->subFor, 'isAlign' => $forAssessmentCombine->isAlign, 'deletedBy' => $forAssessmentCombine->deletedBy]);
										}
									}
								}
								// return $assessmentNewId;
								$test = true;
									
						}
						return ($test?'DONE':'ERROR');
					} catch (Exception $e) {
						// return json_encode($e);
						AjaxController::SystemLogs($e->getMessage);
						return 'ERROR';
					}
					
				}
			}
			
		}


		/////header two

		public function headerTwo(Request $request)
		{
			if($request->isMethod('get')){
				$allData = [
					'allData' => DB::table('asmt_h2')->Join('asmt_h1','asmt_h1.asmtH1ID','asmt_h2.asmtH1ID_FK')->get(),
					'part' => AjaxController::getAllFromWhere('asmt_h1')
				];
				// dd($allData);
				return view('employee.masterfile.mfAssessmentHeaderTwo',$allData);
			} else {
				if($request->isMethod('post')){
					try {
						$table = 'asmt_h2';
						switch ($request->action) {
							case 'add':
								$test = DB::table($table)->insert(
							    	['h2name' => $request->id, 'asmtH1ID_FK' => $request->serv, 'isdisplay' => $request->isAssess]
								);
								break;
							case 'delete':
								$test = DB::table($table)->where('asmtH2ID',$request->id)->delete();
								break;
							case 'edit':
								$test = DB::table($table)->where('asmtH2ID',$request->id)->update(['h2name' => $request->name, 'asmtH1ID_FK' => $request->serv, 'isdisplay' => $request->isAssess]);
								break;
						}
						return ($test?'DONE':'ERROR');
					} catch (Exception $e) {
						// return json_encode($e);
						AjaxController::SystemLogs($e->getMessage);
						return 'ERROR';
					}
					
				}
			}
			
		}


		public function headerThree(Request $request)
		{
			if($request->isMethod('get')){
				$allData = [
					'allData' => DB::table('asmt_h3')->Join('asmt_h2','asmt_h2.asmtH2ID','asmt_h3.asmtH2ID_FK')->get(),
					'part' => DB::table('asmt_h2')->Join('asmt_h1','asmt_h2.asmtH1ID_FK','asmt_h1.asmtH1ID')->get()
				];
				return view('employee.masterfile.mfAssessmentHeaderThree',$allData);
			} else {
				if($request->isMethod('post')){
					try {
						$table = 'asmt_h3';
						switch ($request->action) {
							case 'add':
								$test = DB::table($table)->insert(
							    	['h3name' => $request->id, 'asmtH2ID_FK' => $request->serv]
								);
								break;
							case 'delete':
								$test = DB::table($table)->where('asmtH3ID',$request->id)->delete();
								break;
							case 'edit':
								$test = DB::table($table)->where('asmtH3ID',$request->id)->update(['h3name' => $request->name, 'asmtH2ID_FK' => $request->serv]);
								break;
						}
						return ($test?'DONE':'ERROR');
					} catch (Exception $e) {
						// return json_encode($e);
						AjaxController::SystemLogs($e->getMessage);
						return 'ERROR';
					}
					
				}
			}
		}

		// public function headerFour(Request $request)
		// {
		// 	if($request->isMethod('get')){
		// 		$allData = [
		// 			'allData' => DB::table('asmt_h4')->leftJoin('asmt_h3','asmt_h3.asmtH3ID','asmt_h4.asmtH2ID_FK')->get(),
		// 			'part' => DB::table('asmt_h3')->leftJoin('asmt_h1','asmt_h3.asmtH1ID_FK','asmt_h1.asmtH1ID')->get()
		// 		];
		// 		return view('employee.masterfile.mfAssessmentHeaderThree',$allData);
		// 	} else {
		// 		if($request->isMethod('post')){
		// 			try {
		// 				$table = 'asmt_h4';
		// 				switch ($request->action) {
		// 					case 'add':
		// 						$test = DB::table($table)->insert(
		// 					    	['h4name' => $request->id, 'asmtH3ID_FK' => $request->serv]
		// 						);
		// 						break;
		// 					case 'delete':
		// 						$test = DB::table($table)->where('asmtH4ID',$request->id)->delete();
		// 						break;
		// 					case 'edit':
		// 						$test = DB::table($table)->where('asmtH4ID',$request->id)->update(['h4name' => $request->name, 'asmtH3ID_FK' => $request->serv]);
		// 						break;
		// 				}
		// 				return ($test?'DONE':'ERROR');
		// 			} catch (Exception $e) {
		// 				// return json_encode($e);
		// 				AjaxController::SystemLogs($e->getMessage);
		// 				return 'ERROR';
		// 			}
					
		// 		}
		// 	}
		// }

		public function assessmentCombine(Request $request, $limit = 50)
		{
			$limit = (is_numeric($limit) ? $limit : false);
			if($request->isMethod('get')){
				$allData = [
					'allData' => AjaxController::forAssessmentMasterfileCombined(false,[['assessmentStatus',1]],'*','DESC', $limit),
					'part' => [AjaxController::getAllFromWhere('asmt_h1'),AjaxController::getAllFromWhere('asmt_h2'),AjaxController::getAllFromWhere('asmt_h3')]
				];
				return view('employee.masterfile.mfAssessmentConnect',$allData);
			} else {
				if($request->isMethod('post')){
					try {
						$table = 'assessmentcombined';
						switch ($request->action) {
							case 'add':
								$seq = DB::table($table)->max('assessmentSeq');
								$seqNum = (isset($seq) ? $seq + 1 : 1);
								$test = DB::table($table)->insertGetId(
							    	['assessmentName' => $request->id, 'asmtH3ID_FK' => $request->serv, 'headingText' => $request->txtHead ,'assessmentSeq' => $seqNum, 'subFor' => $request->sub, 'isAlign' => $request->aligned, 'uid' => session()->get('employee_login')->uid]
								);
								return AjaxController::forAssessmentMasterfileCombined(false,[['asmtComb',$test]],'*','DESC');
								break;
							case 'delete':
								$uData = AjaxController::getCurrentUserAllData();
								$test = DB::table($table)->where('asmtComb',$request->id)->update(['assessmentStatus' => 0, 'deletedBy' => $uData['cur_user']]);
								break;
							case 'edit':
								$test = DB::table($table)->where('asmtComb',$request->id)->update(['assessmentName' => $request->name, 'headingText' => $request->txtHead, 'asmtH3ID_FK' => $request->serv, 'isAlign' => $request->aligned]);
								break;
							case 'getCombined':
								$test = AjaxController::forAssessmentMasterfileCombined(2,array(['asmt_h3.asmtH3ID',$request->id]));
								return $test;
								break;
							case 'getExtraDetails':
								$test = DB::table($table)->select('headingText','assessmentName')->where('asmtComb',$request->id)->first();
								return json_encode($test);
								break;
							case 'rearrange':
								$test = DB::table($table)->select('asmtComb','headingText','assessmentName','assessmentSeq','h3name')->join('asmt_h3','asmt_h3.asmtH3ID','assessmentcombined.asmtH3ID_FK')->where('assessmentStatus',1)->orderBy('asmtComb','DESC');
								if($limit){
									$test->limit($limit);
								}
								return json_encode($test->get());
								break;
							case 'arrange':
								$targetIDToMoveInto = $request->id; //should add .1 on assessmentseq
								$idToMove = $request->currentID; //id to sort

								$dataOfTargetIDToMove = DB::table($table)->where('asmtComb',$targetIDToMoveInto)->first();
								$test = DB::table($table)->where('asmtComb',$idToMove)->update(['assessmentSeq' => $dataOfTargetIDToMove->assessmentSeq + ((int)($dataOfTargetIDToMove->assessmentSeq + .1) > (int)$dataOfTargetIDToMove->assessmentSeq ? 1.1: .1)]);
								
								// $test = DB::table($table)->select('assessmentSeq')->where('asmtComb',$request->id)->first();
								// DB::table($table)->where('asmtComb',$request->currentID)->update(['assessmentSeq' => $test->assessmentSeq + 1]);
								// break;
						}
						return ($test?'DONE':'ERROR');
					} catch (Exception $e) {
						// return json_encode($e);
						AjaxController::SystemLogs($e->getMessage);
						return 'ERROR';
					}
					
				}
			}
			
		}

		public function assessmentOrder(){
			if(session()->has('employee_login') && AjaxController::getCurrentUserAllData()['grpid'] == 'NA'){
				$allData = DB::table('assessmentcombined')->orderBy('assessmentSeq','ASC')->orderBy('asmtComb','ASC')->get();
				if(count($allData) > 0){
					$count = 1;
					foreach ($allData as $key) {
						DB::table('assessmentcombined')->where('asmtComb',$key->asmtComb)->update(['assessmentSeq' => $count]);
						$count++;
					}
					return redirect('employee')->with('errRet', ['errAlt'=>'success', 'errMsg'=>'Done']);

				}
			}
			return redirect('employee');
		}


		public function assessmentRegister(Request $request){
			return json_encode(AjaxController::logAssessed($request->level,$request->appid,$request->id,$request->monid,null,$request->isPtc)); 
		}



		/////////////////////////TITLE AREA

		public function title(Request $request)
		{
			if($request->isMethod('get')){
				$allData = [
					'allData' => DB::table('asmt_title')->leftJoin('facilitytyp','facilitytyp.facid','asmt_title.serv')->get(),
					'serv' => AjaxController::getAllFrom('facilitytyp')
				];
				return view('employee.masterfile.mfAssessmentTitle',$allData);
			} else {
				if($request->isMethod('post')){
					try {
						$table = 'asmt_title';
						switch ($request->action) {
							case 'add':
								$titleCode = preg_replace('/\s+/', '', $request->id);
								$test = DB::table($table)->insert(
							    	['title_code' => $titleCode, 'title_name' => $request->name, 'filename' => $request->view, 'serv' => $request->serv]
								);
								break;
							case 'delete':
								$test = DB::table($table)->where('title_code',$request->id)->delete();
								break;
							case 'edit':
								$test = DB::table($table)->where('title_code',$request->id)->update(['title_name'=>$request->name, 'filename' => $request->filename, 'serv' => $request->serv]);
								break;
						}
						return ($test?'DONE':'ERROR');
					} catch (Exception $e) {
						AjaxController::SystemLogs($e->getMessage);
						return 'ERROR';
					}
					
				}
			}
			
		}
		public static function dentallaboratory(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.assessment.dentallaboratory');
				} 
				catch (Exception $e) 
				{
					return "ERROR";
				}
			}
		}

		// end syrel line


		////////////////////////// BERZY ////////////////
		public static function drugTestingLab(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.assessment.drugTestingLab');
				} 
				catch (Exception $e) 
				{
					return "ERROR";
				}
			}
		}

		public static function birthingHome(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.assessment.birthingHome');
				} 
				catch (Exception $e) 
				{
					return "ERROR";
				}
			}
		}
		public static function acuteChronicCare(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.assessment.acuteChronicCare');
				} 
				catch (Exception $e) 
				{
					return "ERROR";
				}
			}
		}
		public static function ambSurgOmfs(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.assessment.ambSurgOmfs');
				} 
				catch (Exception $e) 
				{
					return "ERROR";
				}
			}
		}
		public static function genClinicLab(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.assessment.gencliniclab');
				} 
				catch (Exception $e) 
				{
					return "ERROR";
				}
			}
		}
		public static function custodialPsychiatric(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.assessment.custodialPsychiatric');
				} 
				catch (Exception $e) 
				{
					return "ERROR";
				}
			}
		}
		public static function landAmbulance(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.assessment.landAmbulance');
				} 
				catch (Exception $e) 
				{
					return "ERROR";
				}
			}
		}
		public static function drinkingWater(Request $request)
		{
			if ($request->isMethod('get')) 
			{
				try 
				{
					return view('employee.assessment.drinkingWater');
				} 
				catch (Exception $e) 
				{
					return "ERROR";
				}
			}
		}
	}