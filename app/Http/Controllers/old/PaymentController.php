<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
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
use Agent;
use App\Http\Controllers\Client\Api\NewGeneralController;
use App\Models\FACLGroup;
use App\Models\HFACIGroup;
use App\Models\Regions;
use App\Models\RegisteredFacility;
use FunctionsClientController;
use EvaluationController;

class PaymentController extends DOHController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            return $next($request);
        });
        $this->agent = Agent::isMobile();
    }


    public static function ChargeFees(Request $request)
		{
			if(session()->has('employee_login')){

				if ($request->ismethod('get')) 
				{
					try 
					{
						$datalist = AjaxController::getAllChargeFees();
						$dataCategory = AjaxController::getAllCategory();
						$dataFacility = AjaxController::getAllFacilityGroup();
						$allapptye = AjaxController::getAllApplicationType();
                        
						$dataOwnership = AjaxController::getAllOwnership();
						$allHosplevel =(DB::select("SELECT * FROM serv_type WHERE grp_name = 'HOSPITAL'"));
						$allclass =(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')"));
            $allsubclass =(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')"));
						$dataUACS = AjaxController::getAllUACS();

						return view('employee.masterfile.mfChargeFees', ['list'=>$datalist,'Categorys'=>$dataCategory,'Facility'=>$dataFacility, 'AppType'=>$allapptye, 'allclass'=>$allclass, 'allsubclass'=>$allsubclass, 'listOwnership'=>$dataOwnership,'allHosplevel'=>$allHosplevel,'listUACS'=>$dataUACS]);

					} 
					catch (Exception $e) 
					{
						AjaxController::SystemLogs($e);
						session()->flash('system_error','ERROR');
						return view('employee.masterfile.mfChargeFees');
					}
				}

				if ($request->isMethod('post')) 
				{
					try 
					{
						DB::table('chargefees')->insert(['chgf_code'=> strtoupper($request->id), 'cat_id' => $request->cat_id, 'chgf_desc'=> $request->name, 'chg_exp' => $request->exp,'chg_rmks' => $request->rmk,'hgpid' => $request->hgpid, 'fprevision' => $request->isAssess]);
						return 'DONE';		
					} 
					catch (Exception $e) {
						return $e;
						AjaxController::SystemLogs($e);
						return 'ERROR';
					}
				}
			}
			else {
				return redirect()->route('employee');
			}
		}


}
?>