<?php

namespace App\Http\Controllers\Client;

use Session;
use App\Http\Controllers\Controller;
use FunctionsClientController;
use App\Models\ApplicationForm;
use App\Models\Regions;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Barangay;
use App\Models\HFACIGroup;
use App\Models\FACLGroup;
use Carbon\Carbon;
use AjaxController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class ClientDashboardController extends Controller
{

    public function index()
    {
        $user_data = session()->get('uData');
        $data = [
            'user' => $user_data
        ];
        return view('dashboard.client.home', $data);
    }

    public function apply()
    {
        $user_data = session()->get('uData');
        $data = [
            'user' => $user_data
        ];
        return view('dashboard.client.apply', $data);
    }

    public function newApplication()
    {
        $user_data = session()->get('uData');
        $nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
        $hfser_id = 'CON';

        $data = [
            'grpid'              => 'C',
            'nameofcomp'              => $nameofcomp,
            'fAddress'              => [],
            'serv_cap' => json_encode(DB::table('facilitytyp')->where('servtype_id', 1)->get()),
            'user' => $user_data,
            'appFacName' => FunctionsClientController::getDistinctByFacilityNameRegFac(),
            // 'appFacName' => FunctionsClientController::getDistinctByFacilityName(),
            'regions'   => Regions::orderBy('sort')->get(),
            'hfser' =>  $hfser_id,
            'condet' =>  [[], []],
            'apptypenew'=> 'IN'

        ];
        // dd($data);
        return view('dashboard.client.newapplication', $data);
    }

    public function permitToConstruct()
    {
        $user_data = session()->get('uData');
        $nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
        $hfser_id = 'PTC';

        $faclArr = [];
        $facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
        
        foreach ($facl_grp as $f) {
            array_push($faclArr, $f->hgpid);
        }

        $data = [
            'grpid'              => 'C',
            'nameofcomp' =>  $nameofcomp,
            'ptc'              => [],
            'fAddress'              => [],
            'user'                  => $user_data,
            'serv_cap' => json_encode(DB::table('facilitytyp')->where('servtype_id', 1)->get()),
            'appFacName'            => FunctionsClientController::getDistinctByFacilityNameRegFac(),
            // 'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
            'regions'               => Regions::orderBy('sort')->get(),
            'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->where('status','=','1')->get(),
            //mychanges
            'hfser' =>  $hfser_id,
            'apptypenew'=> 'IN'
        ];
        // dd($hfaci_service_type);
        // dd($faclArr);
        //dd($data);
        return view('dashboard.client.permit-to-construct', $data);
    }

    public function authorityToOperate()
    {
        $user_data = session()->get('uData');
        $nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
        $hfser_id = 'ATO';

        $faclArr = [];
        $facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
        foreach ($facl_grp as $f) {
            array_push($faclArr, $f->hgpid);
        }

        $data = [
            'grpid'              => 'C',
            'nameofcomp' =>  $nameofcomp,
            'fAddress'              => [],
            'serv_cap' => json_encode(DB::table('facilitytyp')->where('servtype_id', 1)->get()),
            'user'                  => $user_data,
            'appFacName'            => FunctionsClientController::getDistinctByFacilityNameRegFac(),
            // 'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
            'regions'               => Regions::orderBy('sort')->get(),
            'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->where('status','=','1')->get(),
            'hfser' =>  $hfser_id,
            'apptypenew'=> 'IN'
        ];
        // dd($hfaci_service_type);
        return view('dashboard.client.authority-to-operate', $data);
    }

    public function certificateOfAccreditation()
    {
        $user_data = session()->get('uData');
        $nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
        $hfser_id = 'COA';
        $faclArr = [];
        $facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();

        foreach ($facl_grp as $f) {
            array_push($faclArr, $f->hgpid);
        }

        $data = [
            'grpid'              => 'C',
            'nameofcomp' =>  $nameofcomp,
            'user'                  => $user_data,
            'fAddress'              => [],
            'appFacName'            => FunctionsClientController::getDistinctByFacilityNameRegFac(),
            // 'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
            'regions'               => Regions::orderBy('sort')->get(),
            'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->where('status','=','1')->get(),
            'hfser' =>  $hfser_id,
            'serv_cap' => json_encode(DB::table('facilitytyp')->where('servtype_id', 1)->get()),
            'apptypenew'=> 'IN'
        ];
        // dd($hfaci_service_type);
        return view('dashboard.client.certificate-of-accreditation', $data);
    }

    public function certificateOfRegistration()
    {
        $user_data = session()->get('uData');
        $nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
        $hfser_id = 'COR';

        $faclArr = [];
        $facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();
        foreach ($facl_grp as $f) {
            array_push($faclArr, $f->hgpid);
        }

        $data = [
            'grpid'              => 'C',
            'nameofcomp' =>  $nameofcomp,
            'user'                  => $user_data,
            'serv_cap'              =>json_encode(DB::table('facilitytyp')->where([['servtype_id',1],['forSpecialty',0]])->get()),
            'fAddress'              => [],
            'appFacName'            => FunctionsClientController::getDistinctByFacilityNameRegFac(),
            // 'appFacName'            => FunctionsClientController::getDistinctByFacilityName(),
            'regions'               => Regions::orderBy('sort')->get(),
            'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->where('status','=','1')->get(),
            'hfser' =>  $hfser_id,
            'apptypenew'=> 'IN'
        ];
        // dd($hfaci_service_type);
        return view('dashboard.client.certificate-of-registration', $data);
    }

    public function licenseToOperate()
    {
        $appid = null;
        $hideExtensions = null;
        $aptid = null;

        $hfLocs =
            [
                'client1/apply/app/LTO/' . $appid,
                'client1/apply/app/LTO/' . $appid . '/hfsrb',
                'client1/apply/app/LTO/' . $appid . '/fda'
            ];

        $user_data = session()->get('uData');
        $nameofcomp = DB::table('x08')->where([['uid', $user_data->uid]])->first()->nameofcompany;
        $hfser_id = 'LTO';

        $faclArr = [];
        $facl_grp = FACLGroup::where('hfser_id', $hfser_id)->select('hgpid')->get();

        foreach ($facl_grp as $f) {
            array_push($faclArr, $f->hgpid);
        }

        $proceesedAmb = [];
        foreach (AjaxController::getForAmbulanceList(false, 'forAmbulance.hgpid') as $key => $value) {
            array_push($proceesedAmb, $value->hgpid);
        }

        $data = [
            'grpid'              => 'C',
            'nameofcomp' =>  $nameofcomp,
            'user'                  => $user_data,
            'appFacName'            => FunctionsClientController::getDistinctByFacilityNameRegFac(),
            'regions'               => Regions::orderBy('sort')->get(),
            'hfaci_service_type'    => HFACIGroup::whereIn('hgpid', $faclArr)->where('status','=','1')->get(),
            'hfser' =>  $hfser_id,
            'userInf' => FunctionsClientController::getUserDetails(),
            'serv_cap' => json_encode(DB::table('facilitytyp')->where('servtype_id', 1)->get()),
            'apptype' => DB::table('apptype')->get(),
            'ownership' => DB::table('ownership')->get(),
            'class' => json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NULL OR isSub = '')")),
            'subclass' => json_encode(DB::select("SELECT * FROM class WHERE (isSub IS NOT NULL OR isSub != '')")),
            'function' => DB::table('funcapf')->get(),
            'facmode' => DB::table('facmode')->get(),
            'fAddress' => [],
            'servfac' => json_encode([]),
            'ptcdet' => json_encode([]),
            'cToken' => FunctionsClientController::getToken(),
            'addresses' => [],
            'hfer' => null,
            'hideExtensions' => $hideExtensions,
            'ambcharges' => DB::table('chg_app')->whereIn('chgapp_id', ['284', '472'])->get(),
            'aptid' => null,
            'group' => json_encode(DB::table('facilitytyp')->where('servtype_id', '>', 1)->whereNotNull('grphrz_name')->get()),
            'forAmbulance' => json_encode($proceesedAmb),
            'apptypenew'=> 'IN'
        ];


        if(isset($_GET['type']) && $_GET['type'] == 'r') {
            $data['discounts'] =  DB::table('application_discount')
            ->where('date_start', '<', Carbon::now())
            ->where('date_end', '>', Carbon::now())
            ->where('type', 'Renewal')
            ->get();
        } else {
            $data['discounts'] =  DB::table('application_discount')
            ->where('date_start', '<', Carbon::now())
            ->where('date_end', '>', Carbon::now())
            ->where('type', 'Initial')
            ->get();
        }

        return view('dashboard.client.license-to-operate', $data);
    }

    public function requirement()
    {
        return view('dashboard.client.requirement.submission-of-requirement');
    }
}
