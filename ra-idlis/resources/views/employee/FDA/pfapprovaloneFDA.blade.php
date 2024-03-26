@extends('mainEmployee')
@section('title', 'Approval/Issuance Process Flow')
@section('content')
<style>
  a{
    text-decoration: none!important;
  }
</style>

<?php 
  if($request == 'machines'){
    //preassessment
    $preass = $AppData->ispreassessed;
    $preAssBy = '('. $AppData->ispreassessedby .') '. $AppData->preassesedbyFDA_pre .' '. $AppData->preassesedbyFDA_fname .' '. $AppData->preassesedbyFDA_mname .' '. $AppData->preassesedbyFDA_lname .' '. $AppData->preassesedbyFDA_suf;
    $preassTime = $AppData->ispreassessedtime;
    $preassDate = $AppData->ispreassesseddate;
    $preassIp = $AppData->ispreassessedip;

    //recommendation
    $reco = $AppData->isrecommendedFDA;
    $recoEvalBy = '('. $AppData->recommendedbyFDA .') '. $AppData->recbyfdal_pre .' '. $AppData->recbyfda_fname .' '. $AppData->recbyfda_mname .' '. $AppData->recbyfda_lname .' '. $AppData->recbyfda_suf;
    $recoTime = $AppData->recommendedtimeFDA;
    $recoDate = $AppData->recommendeddateFDA;
    $recoIp = $AppData->recommendedippaddrFDA;


    //order of payment
    $oop = $AppData->isPayEvalFDA;
    $oopEvalBy = $AppData->payEvalbyFDA;
    $oopTime = $AppData->payEvaltimeFDA;
    $oopDate = $AppData->payEvaldateFDA;
    $oopIp = $AppData->payEvalipFDA;

    $preApproveTime = $AppData->preApproveTimeFDA;
    $preApproveDate = $AppData->preApproveDateFDA;


    //cashier
    $cashier = $AppData->isCashierApproveFDA;;
    $cashierEvalBy = $AppData->CashierApproveByFDA;
    $cashierTime = $AppData->CashierApproveTimeFDA;
    $cashierDate = $AppData->CashierApproveDateFDA;
    $cashierIp = $AppData->CashierApproveIpFDA;


    //recommendation for approval
    $recommendation = $AppData->isRecoFDA;
    $recommendationJudge = $AppData->isRecoDecision;
    $recommendationEvalBy = $AppData->RecobyFDA;
    $recommendationTime = $AppData->RecotimeFDA;
    $recommendationDate = $AppData->RecodateFDA;
    $recommendationIp = $AppData->RecoippaddrFDA;

    //approval
    $approve = $AppData->isApproveFDA;
    $approveEvalBy = $AppData->approvedByFDA;
    $approveTime = $AppData->approvedTimeFDA;
    $approveDate = $AppData->approvedDateFDA;
    $approveIp = $AppData->approvedIpAddFDA;
  } else {
    //preassessment
    $preass = $AppData->ispreassessedpharma;
    $preAssBy = '('. $AppData->ispreassessedbypharma .') '. $AppData->preassesedbyFDAPharma_pre .' '. $AppData->preassesedbyFDAPharma_fname .' '. $AppData->preassesedbyFDAPharma_mname .' '. $AppData->preassesedbyFDAPharma_lname .' '. $AppData->preassesedbyFDAPharma_suf;
    $preassTime = $AppData->ispreassessedtimepharma;
    $preassDate = $AppData->ispreassesseddatepharma;
    $preassIp = $AppData->ispreassessedippharma;

    //recommendation
    $reco = $AppData->isrecommendedFDAPharma;
    $recoEvalBy = '('. $AppData->recommendedbyFDAPharma .') '. $AppData->recbyfdalphar_pre .' '. $AppData->recbyfdaphar_fname .' '. $AppData->recbyfdaphar_mname .' '. $AppData->recbyfdaphar_lname .' '. $AppData->recbyfdaphar_suf;
    $recoTime = $AppData->recommendedtimeFDAPharma;
    $recoDate = $AppData->recommendeddateFDAPharma;
    $recoIp = $AppData->recommendedippaddrFDAPharma;

    $recommendationPhar = $AppData->isRecoFDAPhar;
    $recommendationJudgePhar = $AppData->isRecoDecisionPhar;
    $recommendationEvalByPhar = $AppData->RecobyFDAPhar;
    $recommendationTimePhar = $AppData->RecotimeFDAPhar;
    $recommendationDatePhar = $AppData->RecodateFDAPhar;
    $recommendationIpPhar = $AppData->RecoippaddrFDAPhar;

    $preApproveTime = $AppData->preApproveTimeFDAPharma;
    $preApproveDate = $AppData->preApproveDateFDAPharma;

    //order of payment
    $oop = $AppData->isPayEvalFDAPharma;
    $oopEvalBy = $AppData->payEvalbyFDAPharma;
    $oopTime = $AppData->payEvaltimeFDAPharma;
    $oopDate = $AppData->payEvaldateFDAPharma;
    $oopIp = $AppData->payEvalipFDAPharma;




    //cashier
    $cashier = $AppData->isCashierApprovePharma;
    $cashierEvalBy = $AppData->CashierApproveByPharma;
    $cashierTime = $AppData->CashierApproveTimePharma;
    $cashierDate = $AppData->CashierApproveDatePharma;
    $cashierIp = $AppData->CashierApproveIpPharma;



    //approval
    $approve = $AppData->isApproveFDAPharma;
    $approveEvalBy = $AppData->approvedByFDAPharma;
    $approveTime = $AppData->approvedTimeFDAPharma;
    $approveDate = $AppData->approvedDateFDAPharma;
    $approveIp = $AppData->approvedIpAddFDAPharma;
  }

?>

<div class="content p-4">
  
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
          @isset($APPID)<input type="text" id="APPID" value="{{$APPID}}" hidden>@endisset
          <input type="" id="token" value="{{ Session::token() }}" hidden>
          <button class="btn btn-primary" onclick="window.location.href='{{ asset('employee/dashboard/processflow/FDA/approval') }}/@if($request == 'machines'){{'machines'}}@else{{'pharma'}}@endif'">&nbsp;Back</button>
          Approval/Issuance Certificate 
        </div>
        <div class="card-body">
        <table class="table table-borderless">
          <thead>
            <tr>
              <td width="100%">
                <h2>@isset($AppData) {{$AppData->facilityname}} @endisset</h2>
                <h5>@isset($AppData) 
                {{
                    $AppData->street_number?  strtoupper($AppData->street_number).',' : ' '
                  }}
                  {{
                    $AppData->streetname?  strtoupper($AppData->streetname).',': ' '
                  }} 
             
             {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}}
                 {{-- {{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} --}}
                   @endisset</h5>
                <h6>@isset($AppData) Status: @if ($currentRequest === null) <span style="color:blue">For Approval</span> @elseif($currentRequest == 1)  <span style="color:green">Approve Application</span> @else <span style="color:red">Disapproved Application</span> @endif @endisset</h6>
              </td>
            </tr>
          </thead>
          </tbody>  
        </table>
        <hr>
        <div class="container">
        {{--  --}}
        <div class="accordion" id="accordionExample">
        <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($reco == null) list-group-item-info @elseif($reco == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($reco == null) list-group-item-info @elseif($reco == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Pre Assesment</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseOne"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($preass == null) <span style="color:blue;font-weight: bolder">Not Evaluated</span> @elseif($preass == 1)<span style="color:green;font-weight: bolder">Accepted Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($preassTime) <span style="color:green;font-weight: bolder">{{date('H:i A', strtotime($preassTime))}} </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                           <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($preassDate) <span style="color:green;font-weight: bolder">{{date('M d, Y', strtotime($preassDate))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($preAssBy) <span style="color:green;font-weight: bolder">
                            {{$preAssBy}}
                            </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>   

                          </tr> 
                        </tbody>
                      </table>   
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($reco != null)
                        <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/evaluate/') }}/{{$AppData->appid}}/@if($request == 'machines'){{'xray'}}@else{{'pharma'}}@endif'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Pre-Assesment</button>
                        @else
                        &nbsp;
                        @endif
                        @endisset
                    </center>
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($reco == null) list-group-item-info @elseif($reco == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($reco == null) list-group-item-info @elseif($reco == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Inspection</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseOne"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            {{-- @isset($PreAss)<span style="color:green;font-weight: bolder">Already Taken</span>@else<span style="color:red;font-weight: bolder">Not yet taken</span>@endisset --}}
                            <td>@isset($AppData) @if($reco == null) <span style="color:blue;font-weight: bolder">Not Evaluated</span> @elseif($reco == 1)<span style="color:green;font-weight: bolder">Accepted Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($recoTime) <span style="color:green;font-weight: bolder">{{date('H:i A', strtotime($recoTime))}} </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                           <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($recoDate) <span style="color:green;font-weight: bolder">{{date('M d, Y', strtotime($recoDate))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>                          
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($recoEvalBy) <span style="color:green;font-weight: bolder">
                            
                            {{$recoEvalBy}}        
                            </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr> 
                        </tbody>
                      </table>   
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($reco != null)
                        <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/evaluate/FDA/') }}/{{$AppData->appid}}/{{$request}}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Evaluation</button>
                        @else
                        &nbsp;
                        @endif
                        @endisset
                    </center>
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          {{-- /////////////////// --}}
          {{-- /////////////////// --}}
         {{--  <div class="card">
            <div class="card-header @isset($AppData) @if($oop == null) list-group-item-info @elseif($oop == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($oop == null) list-group-item-info @elseif($oop == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Order of Payment Evaluation</h3>
                </button>
              </div>
            </div>
            <div id="collapseTwo"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($oop == null) <span style="color:blue;font-weight: bolder">Not Evaluated Payment</span> @elseif($oop == 1)<span style="color:green;font-weight: bolder">Accepted Payment Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Payment Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->payEvaltimeFDA) <span style="color:green;font-weight: bolder">{{$AppData->payEvaltimeFDA}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->payEvaldateFDA) <span style="color:green;font-weight: bolder">{{$AppData->payEvaldateFDA}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->payEvalbyFDA) <span style="color:green;font-weight: bolder">{{$AppData->payEvalbyFDA}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($oop != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/FDA/'.$request.'/orderofpayment') }}/{{$AppData->appid}}'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Payment Evaluation</button>
                        @else
                          &nbsp;
                        @endif
                      @endisset
                    </center>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          {{-- /////////////////// --}}
          {{-- /////////////////// --}}
          @if($canView[1])
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($cashier == null) list-group-item-info @elseif($cashier == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($cashier == null) list-group-item-info @elseif($cashier == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Cashier Evaluation (Radiation Facility) </h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseThree"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($cashier == null) <span style="color:blue;font-weight: bolder">Not Evaluated Payment</span> @elseif($cashier == 1)<span style="color:green;font-weight: bolder">Accepted Payment Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Payment Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->CashierApproveTimeFDA) <span style="color:green;font-weight: bolder">{{Date('g:i A',strtotime($AppData->CashierApproveTimeFDA))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->CashierApproveDateFDA) <span style="color:green;font-weight: bolder">{{Date('F d, Y',strtotime($AppData->CashierApproveDateFDA))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->CashierApproveByFDA) <span style="color:green;font-weight: bolder">
                            <!-- {{$AppData->CashierApproveByFDA}} -->
                            {{$AppData->cash_pre}}
                            {{$AppData->cash_fname}}
                            {{$AppData->cash_lname}}
                            {{$AppData->cash_suf}}
                            



                          </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                            <!-- <td>@isset($AppData->CashierApproveByFDA) <span style="color:green;font-weight: bolder">{{$AppData->CashierApproveByFDA}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($oop != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/FDA/actions') }}/{{$AppData->appid}}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Cashier Evaluation</button>
                        @else
                          &nbsp;
                        @endif
                      @endisset
                    </center>
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}

            <div class="card-header @isset($AppData) @if($cashier == null) list-group-item-info @elseif($cashier == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($cashier == null) list-group-item-info @elseif($cashier == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Recommendation for Approval (Radiation Facility)</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseThree"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Recommendation :</th>
                            <td>@isset($AppData) @if($recommendation == null) <span style="color:blue;font-weight: bolder">No Recommendation</span> @else<span style="color:green;font-weight: bolder">{{$recommendationJudge}}</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($recommendationTime) <span style="color:green;font-weight: bolder">{{Date('g:i A',strtotime($recommendationTime))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($recommendationDate) <span style="color:green;font-weight: bolder">{{Date('F d, Y',strtotime($recommendationDate))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->CashierApproveByFDA) <span style="color:green;font-weight: bolder">
                            <!-- {{$AppData->CashierApproveByFDA}} -->
                            {{$AppData->recbyfdal_pre}}
                            {{$AppData->recbyfda_fname}}
                            {{$AppData->recbyfda_lname}}
                            {{$AppData->recbyfda_suf}}
                            



                          </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                            <!-- <td>@isset($recommendationEvalBy) <span style="color:green;font-weight: bolder">{{$recommendationEvalBy}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                            




                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                    <center>

                    @if(!$canjudge)
                      <button type="button" onclick="$('#AccepttGodModal').modal('hide')" class="btn btn-primary" data-toggle="modal" data-target="#showCOCRLoption">Issue COC/RL</button>
                      @else
               

                      <button class="btn btn-primarys" onclick="window.open('{{url('client1/fdacertificate/new/'.$AppData->appid.'/'.$request)}}', '_blank');"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Certification</button>
                      @endif
                 
                    </center>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
          @if($request != 'machines')
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isCashierApprovePharma == null) list-group-item-info @elseif($AppData->isCashierApprovePharma == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isCashierApprovePharma == null) list-group-item-info @elseif($AppData->isCashierApprovePharma == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Cashier Evaluation (Pharmacy) </h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseFour"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->isCashierApprovePharma == null) <span style="color:blue;font-weight: bolder">Not Evaluated Payment</span> @elseif($AppData->isCashierApprovePharma == 1)<span style="color:green;font-weight: bolder">Accepted Payment Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Payment Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->CashierApproveTimePharma) <span style="color:green;font-weight: bolder">{{date('H:i A', strtotime($AppData->CashierApproveTimePharma))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->CashierApproveDatePharma) <span style="color:green;font-weight: bolder">{{date('M d, Y', strtotime($AppData->CashierApproveDatePharma))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <!-- <td>@isset($AppData->CashierApproveByPharma) <span style="color:green;font-weight: bolder">{{$AppData->CashierApproveByPharma}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                            <td>@isset($AppData->CashierApproveByPharma) <span style="color:green;font-weight: bolder">
                            <!-- {{$AppData->CashierApproveByFDA}} -->
                            <!-- {{$AppData->recbyfdaph_pre}}
                            {{$AppData->recbyfdaph_fname}}
                            {{$AppData->recbyfdaph_lname}}
                            {{$AppData->recbyfdaph_suf}} -->
                            {{$AppData->CashierApproveByPharma}}
                            



                          </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                            <!-- <td>@isset($recommendationEvalBy) <span style="color:green;font-weight: bolder">{{$recommendationEvalBy}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                            




                          </tr>
                          



                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isCashierApprovePharma != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/FDA/pharma/actions') }}/{{$AppData->appid}}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Cashier Evaluation</button>
                        @else
                          &nbsp;
                        @endif
                      @endisset
                    </center>
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          <div class="card">
          <div class="card-header @isset($AppData) @if($cashier == null) list-group-item-info @elseif($cashier == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($cashier == null) list-group-item-info @elseif($cashier == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Recommendation for Approval (Pharmacy)</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseThree"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Recommendation :</th>
                            <td>@isset($AppData) @if($recommendationPhar == null) <span style="color:blue;font-weight: bolder">No Recommendation</span> @else<span style="color:green;font-weight: bolder">{{$recommendationJudgePhar}}</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($recommendationTimePhar) <span style="color:green;font-weight: bolder">{{Date('g:i A',strtotime($recommendationTimePhar))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($recommendationDatePhar) <span style="color:green;font-weight: bolder">{{Date('F d, Y',strtotime($recommendationDatePhar))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($recommendationEvalByPhar) <span style="color:green;font-weight: bolder">
                            <!-- {{$AppData->CashierApproveByFDA}} -->
                            <!-- {{$AppData->recbyfdalphar_pre}}
                            {{$AppData->recbyfdaphar_fname}}
                            {{$AppData->recbyfdaphar_lname}}
                            {{$AppData->recbyfdaphar_suf}} -->
                            {{$recommendationEvalByPhar}}
                            



                          </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                            <!-- <td>@isset($recommendationEvalBy) <span style="color:green;font-weight: bolder">{{$recommendationEvalBy}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                            




                          </tr>
                        </tbody>
                      </table>  
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
         
        </div>
        {{--  --}}
        @isset($AppData)
          @if($currentRequest == null)  
          <hr>
          <div class="container">
            <center>
              <button class="btn btn-primarys" onclick="toggleModal(true)" style="background-color: #28a745" data-toggle="modal" data-target="#AccepttGodModal">Approval</button>&nbsp;
              <button class="btn btn-primarys" onclick="toggleModal(false)" style="background-color: #FF2200" data-toggle="modal" data-target="#RFD">Disapproval</button>
            </center>
          </div>
          @endif     
        @endisset
      </div>
      </div>
    </div>
        </div>
    </div>

  <div class="modal fade" id="rlinput" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">

        <form id="rl">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Recommendation Letter</strong></h5>
            <hr>
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AccErrorAlert" role="alert">
              <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
              <button type="button" class="close" onclick="$('#AccErrorAlert').hide(1000);" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>

            
              <div class="container pt-3 pb-3">
                <input type="hidden" name="cert" value="rl">
                {{csrf_field()}}
                @if($request == 'pharma')
                <div class="row pt-3">
                  <div class="col-sm-12 lead">Are you sure you want to apply RL on this Facility?</div>
                </div>
                {{-- <div class="row pt-3">
                    <div class="col-sm-6">Warehouse Address: </div>
                    <div class="col-sm-6" >
                      <input type="text" class="form-control" rows="5" name="waAR" id="waAR">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-6">Phamacist:<span style="color:red;font-weight: bolder">*</span> </div>
                    <div class="col-sm-6" >
                      <input type="text" class="form-control" rows="5" name="rlAR" id="rlAR" data-parsley-required-message="<strong>Phamacist<strong> required." required="">
                    </div>
                </div> --}}
                @else
                <div class="row pt-3">
                    <div class="col-sm-6" >RL Number: <span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" class="form-control" required="" rows="5" name="pRLNo" id="pRLNo">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-6" >DTN number: <span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" class="form-control" required="" rows="5" name="pdtnNo" id="pdtnNo">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-6">Head of Facility:<span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" required="" class="form-control" rows="5" name="rlMhof" id="rlMhof">
                    </div>
                </div>
                {{-- <div class="row pt-3">
                    <div class="col-sm-6">Chief Radiologic Technologist:<span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" required="" class="form-control" rows="5" name="rlMcrt" id="rlMcrt">
                    </div>
                </div> --}}
                <div class="row pt-3">
                    <div class="col-sm-6">Radiation Protection Officer:<span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" required="" class="form-control" rows="5" name="rlMrpo" id="rlMrpo">
                    </div>
                </div>

                @endif
              </div> 

            <div class="row pt-3">
              <div class="col-sm-6">
                  <button type="submit" id="rlsubmit" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
              </div> 
              <div class="col-sm-6">
                <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>

 

  <div class="modal fade" id="showCOCRLoption" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>COC/RL</strong></h5>
          <hr>
          <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AccErrorAlert" role="alert">
            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
            <button type="button" class="close" onclick="$('#AccErrorAlert').hide(1000);" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-5 text-center">
                <button class="btn btn-primary p-4" data-toggle="modal" data-target="#rlinput" onclick="$('#showCOCRLoption').modal('hide')">
                  Issue RL
                </button>
              </div>
              <div class="col-md-2 text-center pt-4">OR</div>
              <div class="col-md-5 text-center">
                <button class="btn btn-primary p-4" data-toggle="modal" data-target="#cocinput" onclick="$('#showCOCRLoption').modal('hide')">
                  Issue COC 
                </button>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="RFD" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form method="POST" id="rfdfield">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Set as Disapproved (RFD) </strong></h5>
          <hr>
          <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AccErrorAlert" role="alert">
            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
            <button type="button" class="close" onclick="$('#AccErrorAlert').hide(1000);" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="container">
            <div class="row text-center">
              <div class="col-sm-12 lead">Are you sure you want to disapprove on this Facility?</div>
            </div>
          </div> 
          <input type="hidden" name="verd" value="RFD">
          <input type="hidden" name="isOk" value="2">
          {{csrf_field()}}
        </div>
        <div class="modal-footer" style="background-color: #272b30;color: white;">
          <button type="submit" id="MODALBTNverd" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
        </div>
      </div>
    </div>
    </form>
  </div>

  <div class="modal fade" id="AccepttGodModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Approval/Issuance of Application</strong></h5>
              <hr>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AccErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AccErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
              <div class="container">
                    <div class="col-sm-12"> 
                      <p>Are you sure that you want to <span id="keyWord"></span> this application?</p>
                      <p>Clicking Yes means you reviewed and checked the application.</p>
                    </div>
                    <form id="AppFormFinal" enctype="multipart/form-data" data-parsley-validate>
                    <input type="text" id="desc_isAppr" value="" disabled hidden>
                    {{csrf_field()}}
                    {{-- <div class="row">
                      <div class="col-sm-4">Remarks:<span id="descRmk1" style="color:red;font-weight: bolder">*</span> </div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                        <textarea class="form-control" rows="5" id="desc_rmk"></textarea>
                      </div>
                    </div> --}}
                    
                    <div class="row" hidden>
                        <div class="col-sm-4">Password:<span style="color:red;font-weight: bolder">*</span> </div>
                        <div class="col-sm-8" >
                          <input type="password" class="form-control" rows="5" name="pass"  id="chckpass" >
                        </div>
                    </div>
                    @if($canView[0])
                    {{-- <div class="row pt-3">
                       <div class="col-sm-4">Pharmacy Validity Date:<span style="color:red;font-weight: bolder">*</span> </div>
                        <div class="col-sm-8" >
                          <input type="date" class="form-control" rows="5" name="phar" id="phar" data-parsley-required-message="<strong>Pharmacy Validity Date<strong> required." required="">
                        </div>
                    </div> --}}
                   {{--  <div class="row pt-3">
                       <div class="col-sm-4">Pharmacy COC/RL:<span style="color:red;font-weight: bolder">*</span> </div>
                        <div class="col-sm-8" >
                          <input type="text" class="form-control" rows="5" name="pharCOC" id="pharCOC" data-parsley-required-message="<strong>Pharmacy COC/RL<strong> required." required="">
                        </div>
                    </div>
                    <div class="row pt-3">
                       <div class="col-sm-4">Upload COC/RL for Pharmacy:<span style="color:red;font-weight: bolder">*</span> </div>
                        <div class="col-sm-8" >
                          <input type="file" class="form-control" rows="5" name="pharCOCUP" id="pharCOCUP" data-parsley-required-message="<strong>Upload COC/RL for Pharmacy<strong> required." required="">
                        </div>
                    </div> --}}
                    @endif
                    @if($canView[1])
                    <div class="row pt-3">
                       {{-- <div class="col-sm-4">X-Ray Validity Date:<span style="color:red;font-weight: bolder">*</span> </div>
                        <div class="col-sm-8" >
                          <input type="date" class="form-control" rows="5" name="xray" id="xray" data-parsley-required-message="<strong>X-Ray Validity Date<strong> required." required="">
                        </div> --}}
                    </div>
                    {{-- <div class="row pt-3">
                       <div class="col-sm-4">Machine COC/RL:<span style="color:red;font-weight: bolder">*</span> </div>
                        <div class="col-sm-8" >
                          <input type="text" class="form-control" name="xrayCOC" rows="5" id="xrayCOC" data-parsley-required-message="<strong>Machine COC/RL<strong> required." required="">
                        </div>
                    </div>
                    <div class="row pt-3">
                       <div class="col-sm-4">Upload COC/RL for Machine:<span style="color:red;font-weight: bolder">*</span> </div>
                        <div class="col-sm-8" >
                          <input type="file" class="form-control" rows="5" name="xrayCOCUP" id="xrayCOCUP" data-parsley-required-message="<strong>Upload COC/RL for Machine<strong> required." required="">
                        </div>
                    </div> --}}
                    @endif

                    {{-- <div class="row pt-3">
                       <div class="col-sm-4">COC/RL:<span style="color:red;font-weight: bolder">*</span> </div>
                        <div class="col-sm-8" id="acceptCert">
                          

                        </div>
                    </div> --}}

                  
                <hr>
                  <div class="row">
                      <div class="col-sm-6">
                        <button type="submit" id="MODALBTN" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                    </div>
               </div>

             </form>
           </div>
         </div>
       </div>
     </div>
   </div>

   <div class="modal fade" id="cocinput" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <form id="coc">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Certificate of Compliance</strong></h5>
            <hr>
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AccErrorAlert" role="alert">
              <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
              <button type="button" class="close" onclick="$('#AccErrorAlert').hide(1000);" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>

            
              <div class="container pt-3 pb-3">
                <input type="hidden" name="cert" value="coc">
                {{csrf_field()}}

                @if($request == 'pharma')
                <div class="row pt-3">
                    <div class="col-sm-12 lead">Are you sure you want to apply COC on this Facility?</div>
                </div>
                {{-- <div class="row pt-3">
                    <div class="col-sm-6">Warehouse Address:</div>
                    <div class="col-sm-6" >
                      <input type="text" class="form-control" rows="5" name="cocWA" id="cocWA">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-sm-6">Authorized Representative:<span style="color:red;font-weight: bolder">*</span> </div>
                    <div class="col-sm-6" >
                      <input type="text" class="form-control" rows="5" name="cocAR" id="cocAR" data-parsley-required-message="<strong>Authorized Representative<strong> required." required="">
                    </div>
                </div> --}}
                @else
                <div class="row pt-3">
                    <div class="col-sm-12">Are you sure you want to proceed on issuing COC on this facility?</div>
                </div>
                {{-- <div class="row pt-3">
                    <div class="col-sm-6">Authorization Status:<span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" required="" class="form-control" rows="5" name="cocMas" id="cocMas">
                    </div>
                </div> --}}
               {{--  <div class="row pt-3">
                    <div class="col-sm-6">COC Number:<span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" required="" class="form-control" rows="5" name="cocMcoc" id="cocMcoc">
                    </div>
                </div> --}}
                {{-- <div class="row pt-3">
                    <div class="col-sm-6">Head of Facility:<span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" required="" class="form-control" rows="5" name="cocMhof" id="cocMhof">
                    </div>
                </div> --}}
                {{-- <div class="row pt-3">
                    <div class="col-sm-6">Chief Radiologic Technologist:<span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" required="" class="form-control" rows="5" name="cocMcrt" id="cocMcrt">
                    </div>
                </div> --}}
                {{-- <div class="row pt-3">
                    <div class="col-sm-6">Radiation Protection Officer:<span style="color:red;font-weight: bolder">*</span></div>
                    <div class="col-sm-6" >
                      <input type="text" required="" class="form-control" rows="5" name="cocMrpo" id="cocMrpo">
                    </div>
                </div> --}}
                @endif

              </div> 

            <div class="row pt-3">
              <div class="col-sm-6">
                  <button type="submit" id="cocsubmit" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
              </div> 
              <div class="col-sm-6">
                <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript">
	$(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip();});
        function toggleModal(test){
            if (test) { // Tr
                $('#keyWord').empty();
                $('#keyWord').append('approve');

                // $('#descRmk1').hide();
                // $('#desc_rmk').removeAttr('required');
                // $('#desc_rmk').removeAttr('data-parsley-required-message');

                $('#desc_isAppr').removeAttr('value');
                $('#desc_isAppr').attr('value','1');
                // $('#MODALBTN').attr('onclick','AcceptNow(true);');
            } else { // Fa
                $('#keyWord').empty();
                $('#keyWord').append('reject');

                // $('#descRmk1').show();
                // $('#desc_rmk').removeAttr('required');
                // $('#desc_rmk').removeAttr('data-parsley-required-message');
                // $('#desc_rmk').attr('required', '');
                // $('#desc_rmk').attr('data-parsley-required-message', '<strong>Remarks</strong> required');

                $('#desc_isAppr').removeAttr('value');
                $('#desc_isAppr').attr('value','0');
                // $('#MODALBTN').attr('onclick','AcceptNow(false);');
            }
        }
    $("#rl,#coc").submit(function(event) {
      event.preventDefault();
      $.ajax({
        method: 'POST',
        data: $(this).serialize(),
        success: function(a){
          if(a == 'true'){

            if(($("#rlinput").data('bs.modal') || {})._isShown){
              $("#rlinput").modal('hide');
            } else if(($("#cocinput").data('bs.modal') || {})._isShown){
              $("#cocinput").modal('hide');
            }

            $("#acceptCert").empty().append(
              '<div class="text-center text-success">'+
                '<i class="fa fa-check-circle" aria-hidden="true"> Already Issued Certificate</i><br>'+
                '<a href="{{url('client1/fdacertificate/'.$AppData->appid.'/'.$request)}}" target="_blank">View Certificate</a>'+
              '</div>'
              );
            $("#AccepttGodModal").modal('show');
          } else {
            alert('something went wrong. Please try again later');
          }
        }
      })
    });

    $('#rfdfield').on('submit', function(event) {
      event.preventDefault();
      let data = $(this).serialize();
      console.log(data);
     $.ajax({
        method : 'POST',
        data : data, 
        success : function(data){
            if (data == 'DONE') {
              Swal.fire({
                type: 'success',
                title: 'Success',
                text: 'Success.',
              }).then(() => {
                location.reload();
              });
            } else if (data == 'ERROR'){
              $('#AccErrorAlert').show(100);  
            } else if(data == 'WRONGPASSWORD'){
              Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Wrong Password. Please try again.',
              }).then(() => {
              });
            } else {
              Swal.fire({
                type: 'error',
                title: 'COC/RL',
                text: data
              })
            }
        }, error : function(a,b,c){ 
            console.log(c);
            $('#AccErrorAlert').show(100);
        },

      });
    });

    $('#AppFormFinal').on('submit',function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()){	
                let data = new FormData(this);
                data.append('id',$('#APPID').val());
                data.append('isOk',$('#desc_isAppr').val());
                data.append('desc',$('#desc_rmk').val());
                $.ajax({
                  method : 'POST',
                  data : data, 
                  cache: false,
                  contentType: false,
                  processData: false,
                  success : function(data){
                      if (data == 'DONE') {
                        Swal.fire({
                          type: 'success',
                          title: 'Success',
                          text: 'Success.',
                        }).then(() => {
                          location.reload();
                        });
                      } else if (data == 'ERROR'){
                        $('#AccErrorAlert').show(100);  
                      } else if(data == 'WRONGPASSWORD'){
                        Swal.fire({
                          type: 'error',
                          title: 'Error',
                          text: 'Wrong Password. Please try again.',
                        }).then(() => {
                        });
                      } else {
                        Swal.fire({
                          type: 'error',
                          title: 'COC/RL',
                          text: data
                        })
                      }
                  }, error : function(a,b,c){ 
                      console.log(c);
                      $('#AccErrorAlert').show(100);
                  },

                });
            } else {
              alert('Please check for all requirements');
            }
        });
</script>
@endsection