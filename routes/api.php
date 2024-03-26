<?php

use Illuminate\Http\Request;
use App\Http\Middleware\APIMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//MOBILE API TO Assessement Tool
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/assessment/{session?}', 'DOHController@AssessmentProcessFlowMobile');
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/parts/{appid}/{montype?}', 'DOHController@AssessmentShowPartNewLtoMobile');
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/parts/new/{regfac_id}/{montype?}', 'DOHController@AssessmentShowPartNewRegFacMobile');
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/HeaderOne/{appid}/{part}/{montype?}', 'DOHController@AssessmentShowH1Mobile'); 
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/HeaderOne/regfac/{appid}/{part}/{montype?}', 'DOHController@AssessmentShowH1RegFacMobile');
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/HeaderTwo/{appid}/{headerOne}/{montype?}', 'DOHController@AssessmentShowH2Mobile');
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/HeaderThree/{appid}/{headerTwo}/{montype?}', 'DOHController@AssessmentShowH3Mobile');
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/ShowAssessments/{appid}/{headerThree}/{montype?}', 'DOHController@ShowAssessmentsMobile');
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/ShowAssessments/regfac/{appid}/{headerThree}/{montype?}', 'DOHController@ShowAssessmentsRegFacMobile');
Route::match(['get', 'post'], 'employee/dashboard/mprocessflow/assessment/each/{appid}/{apptype}/{choosen}/{montype?}', 'DOHController@AssessmentOneProcessFlowMobile');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get(
    '/clients', 
    'Client\Api\ClientApiController@index'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/validate-name/',
    'Client\Api\ApplicationApiController@check'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/newfee/service/fee',
    'NewFeeController@getServiceFee'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/validate-name/registered',
    'Client\Api\ApplicationApiController@checkRegistered'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/save',
    'Client\Api\ApplicationApiController@save'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/doc/eval/save',
    'DOHController@saveDocEvalFiles'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/servicefee/save',
    'DOHController@insertServiceFee'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/user/setbanning',
    'DOHController@setBanning'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/cor/save',
    'Client\Api\CorAppController@save'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/upload/proofpayment',
    'Client\Api\NewGeneralController@uploadProofofPay'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/save/renewalopt',
    'Client\Api\NewGeneralController@docOptforRenewal'
); //->middleware([APIMiddleware::class]);


Route::post(
    '/ptc/save/asessment',
    'Client\Api\NewGeneralController@FPSaveAssessments'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/lto/save',
    'Client\Api\LtoAppController@save'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/lto/save_cor',
    'Client\Api\LtoAppController@save_cor'
); 

Route::post(
    '/registered/facility/save',
    'DOHController@submitRegFacilities'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/service/fees',
    'DOHController@getFees'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/con/save',
    'Client\Api\ConAppController@save'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/ato/save',
    'Client\Api\AtoAppController@save'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/ptc/save',
    'Client\Api\PtcAppController@save'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/application/fetch',
    'Client\Api\ApplicationApiController@fetch'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/province/fetch/',
    'Client\Api\ProvinceApiController@fetch'
); //->middleware([APIMiddleware::class]);


Route::post(
    '/get/facids/mons',
    'AjaxController@getFacNameByFacidNew'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/submit/save/monitoring',
    'OthersController@mon_submitNew'
); //->middleware([APIMiddleware::class]);

// Route::post(
//     '/cont/ptc/{appid}',
//     'Client\Api\PtcAppController@contfromCon'
// ); //->middleware([APIMiddleware::class]);

// Route::match(['get', 'post'], '/updApp/{appid}', 'NewClientController@__updApp')->name('client1.updapp');

Route::post(
    '/municipality/fetch/',
    'Client\Api\MunicipalityApiController@fetch'
); //->middleware([APIMiddleware::class]);


Route::post(
    '/request/reeval',
    'NewClientController@reqReEval'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/barangay/fetch/',
    'Client\Api\BarangayApiController@fetch'
); //->middleware([APIMiddleware::class]);

Route::post(
    '/classification/fetch/',
    'Client\Api\ClassificationApiController@fetch'
); //->middleware([APIMiddleware::class]);

// my changes
Route::get(
    '/activitylogs/fetch/',
    'Client\Api\ActivityLogsApiController@fetch'
);

Route::get(
    '/appassessment/fetch/',
    'Client\Api\AppAssessmentApiController@fetch'
);

Route::get(
    '/formhistory/fetch/',
    'Client\Api\AppFormHistApiController@fetch'
);

Route::get(
    '/forminsp/fetch/',
    'Client\Api\AppFormInspApiController@fetch'
);

// No Primary Key Set
// Route::get(
//     '/form_meta/fetch/',
//     'Client\Api\AppFormMetaApiController@fetch'
// );

Route::get(
    '/form_oopdata/fetch/',
    'Client\Api\AppFormOOPDataApiController@fetch'
);

Route::get(
    '/form_orderofpayment/fetch/',
    'Client\Api\AppFormOrderOfPaymentApiController@fetch'
);

Route::get(
    '/apptype/fetch/',
    'Client\Api\AppTypeApiController@fetch'
);

Route::get(
    '/appupload/fetch/',
    'Client\Api\AppUploadApiController@fetch'
);

Route::get(
    '/asmt2/fetch/',
    'Client\Api\Asmt2ApiController@fetch'
);

Route::get(
    '/asmt2Col/fetch/',
    'Client\Api\Asmt2ColApiController@fetch'
);

Route::get(
    '/asmt2Loc/fetch/',
    'Client\Api\Asmt2LocApiController@fetch'
);

Route::get(
    '/asmt2SDSCA/fetch/',
    'Client\Api\Asmt2SDSCApiController@fetch'
);

Route::get(
    '/asmtH1/fetch/',
    'Client\Api\AsmtH1ApiController@fetch'
);

Route::get(
    '/asmtH2/fetch/',
    'Client\Api\AsmtH2ApiController@fetch'
);

Route::get(
    '/asmtH3/fetch/',
    'Client\Api\AsmtH3ApiController@fetch'
);

Route::get(
    '/asmt_title/fetch/',
    'Client\Api\AsmtTitleApiController@fetch'
);


Route::get(
    '/assessed/fetch/',
    'Client\Api\AssessedApiController@fetch'
);

Route::get(
    '/assessed_ptc/fetch/',
    'Client\Api\AssessedPtcApiController@fetch'
);

Route::get(
    '/assessment/fetch/',
    'Client\Api\AssessmentApiController@fetch'
);

Route::get(
    '/assessment_combined/fetch/',
    'Client\Api\AssessmentCombinedApiController@fetch'
);

Route::get(
    '/assessment_combined_dup/fetch/',
    'Client\Api\AssessmentCombinedDuplicateApiController@fetch'
);

Route::get(
    '/assessment_combined_dup_ptc/fetch/',
    'Client\Api\AssessmentCombinedDuplicatePtcApiController@fetch'
);

Route::get(
    '/assessmentrecommendation/fetch/',
    'Client\Api\AssessmentRecommendationApiController@fetch'
);

Route::get(
    '/assessmentrecommendation_hist/fetch/',
    'Client\Api\AssessmentRecommendationHistoryApiController@fetch'
);

Route::get(
    '/assessment_upload/fetch/',
    'Client\Api\AssessmentUploadApiController@fetch'
);

Route::get(
    '/branch/fetch/',
    'Client\Api\BranchApiController@fetch'
);

Route::get(
    '/cat_assess/fetch/',
    'Client\Api\CatAssessApiController@fetch'
);

Route::get(
    '/category/fetch/',
    'Client\Api\CategoryApiController@fetch'
);

Route::get(
    '/cdrr_attachment/fetch/',
    'Client\Api\CdrrAttachmentApiController@fetch'
);

Route::get(
    '/cdrr_hr_otherattachment/fetch/',
    'Client\Api\CdrrHrOtherAttachmentApiController@fetch'
);

Route::get(
    '/cdrr_hr_personnel/fetch/',
    'Client\Api\CdrrHrPersonnelApiController@fetch'
);

Route::get(
    '/cdrr_hr_receipt/fetch/',
    'Client\Api\CdrrHrReceiptApiController@fetch'
);

Route::get(
    '/cdrr_hr_requirement/fetch/',
    'Client\Api\CdrrHrRequirementApiController@fetch'
);

Route::get(
    '/cdrr_hr_requirement/fetch/',
    'Client\Api\CdrrHrRequirementApiController@fetch'
);

Route::get(
    '/cdrr_hr_xrayServCat/fetch/',
    'Client\Api\CdrrHrXrayListApiController@fetch'
);

Route::get(
    '/cdrrPersonnel/fetch/',
    'Client\Api\CdrrPersonnelApiController@fetch'
);

Route::get(
    '/cdrrReceipt/fetch/',
    'Client\Api\CdrrReceiptApiController@fetch'
);

Route::get(
    '/charge/fetch/',
    'Client\Api\ChargeApiController@fetch'
);

Route::get(
    '/chgApp/fetch/',
    'Client\Api\ChgAppApiController@fetch'
);

Route::get(
    '/chgAppTo/fetch/',
    'Client\Api\ChgApplyToApiController@fetch'
);

Route::get(
    '/chgFaci/fetch/',
    'Client\Api\ChgFaciApiController@fetch'
);

Route::get(
    '/chgFil/fetch/',
    'Client\Api\ChgFilApiController@fetch'
);

Route::get(
    '/chgLoc/fetch/',
    'Client\Api\ChgLocApiController@fetch'
);

Route::get(
    '/committeeTeam/fetch/',
    'Client\Api\CommitteeTeamApiController@fetch'
);

Route::get(
    '/complaintsForm/fetch/',
    'Client\Api\ComplaintsFormApiController@fetch'
);

Route::get(
    '/conCatch/fetch/',
    'Client\Api\CONCatchApiController@fetch'
);

Route::get(
    '/conEvalSave/fetch/',
    'Client\Api\CONEvalSaveApiController@fetch'
);

Route::get(
    '/conEvaluate/fetch/',
    'Client\Api\CONEvaluateApiController@fetch'
);

Route::get(
    '/conHospital/fetch/',
    'Client\Api\CONHospitalApiController@fetch'
);

Route::get(
    '/department/fetch/',
    'Client\Api\DepartmentApiController@fetch'
);

Route::get(
    '/emailNotif/fetch/',
    'Client\Api\EmailNotifyApiController@fetch'
);

Route::get(
    '/facAssessment/fetch/',
    'Client\Api\FacAssessmentApiController@fetch'
);

Route::get(
    '/facAssessment/fetch/',
    'Client\Api\FacAssessmentApiController@fetch'
);

Route::get(
    '/facilityRequirement/fetch/',
    'Client\Api\FacilityRequirementApiController@fetch'
);

Route::get(
    '/facilityType/fetch/',
    'Client\Api\FacilityTypeApiController@fetch'
);

Route::get(
    '/facilityTypUpload/fetch/',
    'Client\Api\FacilityTypUploadApiController@fetch'
);

Route::get(
    '/FACLGroup/fetch/',
    'Client\Api\FACLGroupApiController@fetch'
);

Route::get(
    '/facMode/fetch/',
    'Client\Api\FacModeApiController@fetch'
);

Route::get(
    '/fac_oop/fetch/',
    'Client\Api\FacOOPApiController@fetch'
);

Route::get(
    '/fdaCert/fetch/',
    'Client\Api\FDACertApiController@fetch'
);

Route::get(
    '/fdaChgFil/fetch/',
    'Client\Api\FDACertApiController@fetch'
);

Route::get(
    '/fdaEvaluation/fetch/',
    'Client\Api\FDAEvaluationApiController@fetch'
);

Route::get(
    '/fdaEvaluation_hist/fetch/',
    'Client\Api\FDAEvaluationHistoryApiController@fetch'
);

Route::get(
    '/fdaMonitoring/fetch/',
    'Client\Api\FDAMonitoringApiController@fetch'
);

Route::get(
    '/fdaMonitoringFiles/fetch/',
    'Client\Api\FDAMonitoringFilesApiController@fetch'
);

Route::get(
    '/fdaPharmacyCharges/fetch/',
    'Client\Api\FDAPharmacyChargesApiController@fetch'
);

Route::get(
    '/fdaRange/fetch/',
    'Client\Api\FDARangeApiController@fetch'
);

Route::get(
    '/fdaXrayCat/fetch/',
    'Client\Api\FDAXrayCatApiController@fetch'
);

Route::get(
    '/fdaXrayLoc/fetch/',
    'Client\Api\FDAXrayLocationApiController@fetch'
);

Route::get(
    '/fdaXrayMach/fetch/',
    'Client\Api\FDAXrayMachApiController@fetch'
);

Route::get(
    '/fdaXrayServ/fetch/',
    'Client\Api\FDAXrayServApiController@fetch'
);

Route::get(
    '/forAmbulance/fetch/',
    'Client\Api\ForAmbulanceApiController@fetch'
);

Route::get(
    '/fromMobileInspec/fetch/',
    'Client\Api\FromMobileInspectionApiController@fetch'
);

Route::get(
    '/funCapF/fetch/',
    'Client\Api\FunCapFApiController@fetch'
);

Route::get(
    '/hfaci_customOne/fetch/',
    'Client\Api\HFACICustomOneApiController@fetch'
);

Route::get(
    '/hfaci_group/fetch/',
    'Client\Api\HFACIGroupApiController@fetch'
);

Route::get(
    '/hfaci_servType/fetch/',
    'Client\Api\HFACIServTypeApiController@fetch'
);

Route::get(
    '/hferceEval/fetch/',
    'Client\Api\HFERCEvaluationApiController@fetch'
);

Route::get(
    '/hferceTeam/fetch/',
    'Client\Api\HFERCTeamApiController@fetch'
);

Route::get(
    '/hfsrbannedxa/fetch/',
    'Client\Api\HFSRBannexaApiController@fetch'
);

Route::get(
    '/hfsrbannedxb/fetch/',
    'Client\Api\HFSRBannexbApiController@fetch'
);

Route::get(
    '/hfsrbannedxc/fetch/',
    'Client\Api\HFSRBannexcApiController@fetch'
);

Route::get(
    '/hfsrbannedxd/fetch/',
    'Client\Api\HFSRBannexdApiController@fetch'
);

Route::get(
    '/hfsrbannedxf/fetch/',
    'Client\Api\HFSRBannexfApiController@fetch'
);

Route::get(
    '/hfsrbannedxh/fetch/',
    'Client\Api\HFSRBannexhApiController@fetch'
);

Route::get(
    '/hfsrbannedxi/fetch/',
    'Client\Api\HFSRBannexiApiController@fetch'
);

Route::get(
    '/holiday/fetch/',
    'Client\Api\HolidayApiController@fetch'
);

Route::get(
    '/licensed/fetch/',
    'Client\Api\LicensedApiController@fetch'
);

Route::get(
    '/leo/fetch/',
    'Client\Api\LoeApiController@fetch'
);

Route::get(
    '/lto/fetch/',
    'Client\Api\LtoApiController@fetch'
);

Route::get(
    '/m04/fetch/',
    'Client\Api\M04ApiController@fetch'
);

Route::get(
    '/M99/fetch/',
    'Client\Api\M99ApiController@fetch'
);

Route::get(
    '/modeofpayment/fetch/',
    'Client\Api\ModeOfPaymentApiController@fetch'
);

Route::get(
    '/monForm/fetch/',
    'Client\Api\MonFormApiController@fetch'
);

Route::get(
    '/monTeam/fetch/',
    'Client\Api\MonTeamApiController@fetch'
);

Route::get(
    '/monTeamMembers/fetch/',
    'Client\Api\MonTeamMembersApiController@fetch'
);

Route::get(
    '/notificationlog/fetch/',
    'Client\Api\NotificationLogApiController@fetch'
);

Route::get(
    '/notification_msg/fetch/',
    'Client\Api\NotificationMsgApiController@fetch'
);

Route::get(
    '/nov/fetch/',
    'Client\Api\NovApiController@fetch'
);

Route::get(
    '/novissued/fetch/',
    'Client\Api\NovIssuedApiController@fetch'
);

Route::get(
    '/novissued_s/fetch/',
    'Client\Api\NovIssuedSApiController@fetch'
);

Route::get(
    '/orderofpayment/fetch/',
    'Client\Api\OrderOfPaymentApiController@fetch'
);

Route::get(
    '/ownership/fetch/',
    'Client\Api\OwnershipApiController@fetch'
);

Route::get(
    '/part/fetch/',
    'Client\Api\PartApiController@fetch'
);

Route::get(
    '/peligibility/fetch/',
    'Client\Api\PeligibilityApiController@fetch'
);

Route::get(
    '/personnel/fetch/',
    'Client\Api\PersonnelApiController@fetch'
);

Route::get(
    '/personnel_work/fetch/',
    'Client\Api\PersonnelWorkApiController@fetch'
);

Route::get(
    '/plicensedType/fetch/',
    'Client\Api\PLicenseTypeApiController@fetch'
);

Route::get(
    '/position/fetch/',
    'Client\Api\PositionApiController@fetch'
);

Route::get(
    '/prepart/fetch/',
    'Client\Api\PrepartApiController@fetch'
);

Route::get(
    '/province/fetch/',
    'Client\Api\ProvinceApiController@fetch'
);

Route::get(
    '/ptc/fetch/',
    'Client\Api\PTCApiController@fetch'
);

Route::get(
    '/ptcEvaluation/fetch/',
    'Client\Api\PTCEvaluationApiController@fetch'
);

Route::get(
    '/p_training/fetch/',
    'Client\Api\PTrainingApiController@fetch'
);

Route::get(
    '/p_training_trainings/fetch/',
    'Client\Api\PTrainingsTrainingTypeApiController@fetch'
);

Route::get(
    '/pwdHistory/fetch/',
    'Client\Api\PWDHistoryApiController@fetch'
);

Route::get(
    '/p_work/fetch/',
    'Client\Api\PWorkApiController@fetch'
);

Route::get(
    '/p_workStatus/fetch/',
    'Client\Api\PWorkStatusApiController@fetch'
);

Route::get(
    '/radoholrstblCtnt/fetch/',
    'Client\Api\RadoholrstblCtntApiController@fetch'
);

Route::get(
    '/radoholrstblHdr/fetch/',
    'Client\Api\RadoholrstblHdrApiController@fetch'
);

Route::get(
    '/radoholrstblHf/fetch/',
    'Client\Api\RadoholrstblHfApiController@fetch'
);

Route::get(
    '/reAssessHist/fetch/',
    'Client\Api\ReAssessHistApiController@fetch'
);

Route::get(
    '/regions/fetch/',
    'Client\Api\RegionApiController@fetchAll'
);

Route::get(
    '/regionTransfer/fetch/',
    'Client\Api\RegionTransferApiController@fetch'
);

Route::get(
    '/reqAst/fetch/',
    'Client\Api\ReqAstApiController@fetch'
);

Route::get(
    '/reqAstForm/fetch/',
    'Client\Api\ReqAstFormApiController@fetch'
);

Route::get(
    '/roa_ComplaintAction/fetch/',
    'Client\Api\ROAComplaintActionApiController@fetch'
);

Route::get(
    '/roa_ComplaintActionLog/fetch/',
    'Client\Api\ROAComplaintLogApiController@fetch'
);

Route::get(
    '/section/fetch/',
    'Client\Api\SectionApiController@fetch'
);

Route::get(
    '/servAsmt/fetch/',
    'Client\Api\ServAsmtApiController@fetch'
);

Route::get(
    '/servChg/fetch/',
    'Client\Api\ServChgApiController@fetch'
);

Route::get(
    '/servType/fetch/',
    'Client\Api\ServTypeApiController@fetch'
);

Route::get(
    '/survRec/fetch/',
    'Client\Api\SurvRecApiController@fetch'
);

Route::get(
    '/survTeam/fetch/',
    'Client\Api\SurvTeamApiController@fetch'
);

Route::get(
    '/survTeamMember/fetch/',
    'Client\Api\SurvTeamMemberApiController@fetch'
);

Route::get(
    '/tableHistory/fetch/',
    'Client\Api\TableHistoryApiController@fetch'
);

Route::get(
    '/team/fetch/',
    'Client\Api\TeamApiController@fetch'
);

Route::get(
    '/technicalFindingsHist/fetch/',
    'Client\Api\TechnicalFindingsHistApiController@fetch'
);

Route::get(
    '/transStatus/fetch/',
    'Client\Api\TransStatusApiController@fetch'
);

Route::get(
    '/typeFacility/fetch/',
    'Client\Api\TypeFacilityApiController@fetch'
);

Route::get(
    '/upload/fetch/',
    'Client\Api\UploadApiController@fetch'
);

Route::get(
    '/verdict/fetch/',
    'Client\Api\VerdictApiController@fetch'
);

Route::get(
    '/x05/fetch/',
    'Client\Api\x05ApiController@fetch'
);

Route::get(
    '/x06/fetch/',
    'Client\Api\x06ApiController@fetch'
);

Route::get(
    '/x07/fetch/',
    'Client\Api\x07ApiController@fetch'
);

Route::get(
    '/x08/fetch/',
    'Client\Api\x08ApiController@fetch'
);

Route::get(
    '/x08Ft/fetch/',
    'Client\Api\x08FtApiController@fetch'
);

Route::get(
    '/x08Pass/fetch/',
    'Client\Api\x08PassApiController@fetch'
);

Route::get(
    '/xrayFacility/fetch/',
    'Client\Api\XrayFacilityApiController@fetch'
);

Route::get(
    '/xrayFacilityLevel/fetch/',
    'Client\Api\XrayFacilityLevelApiController@fetch'
);
