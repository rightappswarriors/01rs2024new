<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// syrel added
use Illuminate\Support\Facades\DB;
use Session;
use Cache;
use Redirect;
class Controller extends BaseController
{
	// private $currentURL;

	// public function __construct()
	// {
	// 	$this->currentURL = url()->full();

	// 	$this->middleware(function ($request, $next) {
	//         if(stripos($this->currentURL, '/employee/') && Session::get('employee_login') == NULL)
	//         {
	//             return Redirect::to('employee');
	//         } else {
	//             return $next($request);
	//         }
	//     });
	//     // $this->activityLog();
	// }

	// public function activityLog()
	// {
	// 	$mods = $timeToExpire = null;
	// 	$cacheData = array();
	// 	if(!Cache::has('mods')){
	// 		$timeToExpire = now()->addMinutes(1);
	// 		$mods = DB::table('x05')->get();
	// 		Cache::put('mods',$mods,$timeToExpire);
	// 	}

	// 	if(!empty(Cache::get('mods'))){
	// 		$getUserData = AjaxController::getCurrentUserAllData();
	// 		print_r($getUserData);
	// 		$cacheData = Cache::get('mods');
	// 		foreach ($cacheData as $data) {
	// 			if(stripos($this->currentURL, $data->links)){
	// 				echo $data->links;
	// 			}
	// 		}
	// 	}
	// }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
