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
use FunctionsClientController;

class LloydClientController extends Controller {
	
	public function annexAAdd(Request $request, $fname,$mname,$lname,$sex,$dob,$prof,$spec,$prcno,$status, $appid){
		if ($request->isMethod('post')) {
			// dd($request->all());

			DB::table('hfsrbannexa')
				->insert(['surname'=>$request->add_lname,'firstname'=>$request->add_fname,'middlename'=>$request->add_mname,'prof'=>$request->add_profession,'prcno'=>$request->add_prcno,'speciality'=>$request->add_specialty,'dob'=>$request->add_bdate,'sex'=>$request->add_sex,'employement'=>$request->add_status,'appid'=>$request->appid]);

			return redirect()->back()->with('sucMsg', 'Success');
		} else {
			$data = DB::table('hfsrbannexa')
				->insertGetId(['surname'=>$lname,'firstname'=>$fname,'middlename'=>$mname,'prof'=>$prof,'prcno'=>$prcno,'speciality'=>$spec,'dob'=>$dob,'sex'=>$sex,'employement'=>$status,'appid'=>$appid]);
			$row = array($fname,$mname,$lname,$sex,$dob,$prof,$spec,$prcno,$status,$appid);

			return response()->json(['data'=>$data, 'row'=>$row]);
		}
	}

	public function annexAEdit(Request $request){
		if ($request->isMethod('post')) {
			// dd($request->all());

			DB::table('hfsrbannexa')
				->where('id', '=', $request->id)
				->update(['surname'=>$request->add_lname,'firstname'=>$request->add_fname,'middlename'=>$request->add_mname,'prof'=>$request->add_profession,'prcno'=>$request->add_prcno,'speciality'=>$request->add_specialty,'dob'=>$request->add_bdate,'sex'=>$request->add_sex,'employement'=>$request->add_status,'appid'=>$request->appid]);

			return redirect()->back()->with('sucMsg', 'Success');
		}
	}

	public function annexADelete(Request $request){
		if ($request->isMethod('post')) {
			// dd($request->all());

			DB::table('hfsrbannexa')
				->where('id', '=', $request->id)
				->delete();

			return redirect()->back()->with('sucMsg', 'Success');
		}
	}
}