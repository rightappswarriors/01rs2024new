@extends('mainEmployee')
@section('title', 'Decision of recommendation of Approval')
@section('content')
<style>
  a{
    text-decoration: none!important;
  }
</style>

<?php 
  if($request == 'machines'){
    //recommendation
    $reco = $AppData->isrecommendedFDA;
    $recoEvalBy = $AppData->recommendedbyFDA;
    $recoTime = $AppData->recommendedtimeFDA;
    $recoDate = $AppData->recommendeddateFDA;
    $recoIp = $AppData->recommendedippaddrFDA;

    $preApproveTime = $AppData->preApproveTimeFDA;
    $preApproveDate = $AppData->preApproveDateFDA;

    //order of payment
    $oop = $AppData->isPayEvalFDA;
    $oopEvalBy = $AppData->payEvalbyFDA;
    $oopTime = $AppData->payEvaltimeFDA;
    $oopDate = $AppData->payEvaldateFDA;
    $oopIp = $AppData->payEvalipFDA;

    //cashier
    $cashier = $AppData->isCashierApproveFDA;;
    $cashierEvalBy = $AppData->CashierApproveByFDA;
    $cashierTime = $AppData->CashierApproveTimeFDA;
    $cashierDate = $AppData->CashierApproveDateFDA;
    $cashierIp = $AppData->CashierApproveIpFDA;

    //approval
    $approve = $AppData->isApproveFDA;
    $approveEvalBy = $AppData->approvedByFDA;
    $approveTime = $AppData->approvedTimeFDA;
    $approveDate = $AppData->approvedDateFDA;
    $approveIp = $AppData->approvedIpAddFDA;
  } else {
    //recommendation
    $reco = $AppData->isrecommendedFDAPharma;
    $recoEvalBy = $AppData->recommendedbyFDAPharma;
    $recoTime = $AppData->recommendedtimeFDAPharma;
    $recoDate = $AppData->recommendeddateFDAPharma;
    $recoIp = $AppData->recommendedippaddrFDAPharma;

    $approveBy = $AppData->approvedByFDAPharma;
    $approveTime = $AppData->approvedTimeFDAPharma;
    $approveDate = $AppData->approvedDateFDAPharma;

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

<div class="content p-4 {{$AppData->appid}}">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
          @isset($APPID)<input type="text" id="APPID" value="{{$APPID}}" hidden>@endisset
          <input type="" id="token" value="{{ Session::token() }}" hidden>
          <button class="btn btn-primary" onclick="window.history.back();">Back</button>
          Decision of recommendation of Approval 
          
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
                            {{-- @isset($PreAss)<span style="color:green;font-weight: bolder">Already Taken</span>@else<span style="color:red;font-weight: bolder">Not yet taken</span>@endisset --}}
                            <td>@isset($AppData) @if($reco == null) <span style="color:blue;font-weight: bolder">Not Evaluated</span> @elseif($reco == 1)<span style="color:green;font-weight: bolder">Accepted Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($preApproveTime) <span style="color:green;font-weight: bolder">{{date('H:i A', strtotime($preApproveTime))}} </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                           <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($preApproveDate) <span style="color:green;font-weight: bolder">{{date('M d, Y', strtotime($preApproveDate))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($recoEvalBy) <span style="color:green;font-weight: bolder">
                            <!-- <td>isset($AppData->recommendedbyFDA) <span style="color:green;font-weight: bolder"> -->
                            <!-- {{$AppData->recommendedbyFDA}} -->

                            {{$AppData->evalby_pre}}
                            {{$AppData->evalby_fname}}
                            {{$AppData->evalby_lname}}
                            {{$AppData->evalby_suf}}
                            

                             <!-- {{$AppData->recfdaval_pre}}
                            {{$AppData->recfdaval_fname}}
                            {{$AppData->recfdaval_lname}}
                            {{$AppData->recfdaval_suf}} -->
                            
                          </span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                            




                           
                            <!-- <td>@isset($AppData->recommendedbyFDA) <span style="color:green;font-weight: bolder">{{$AppData->recommendedbyFDA}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                            <!-- <td>@isset($AppData->recommendedbyFDA) <span style="color:green;font-weight: bolder">{{$AppData->recommendedbyFDA}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                          </tr> 
                        </tbody>
                      </table>   
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($reco != null)
                        <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/evaluate/') }}/{{$AppData->appid}}/xray'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Pre-Assesment</button>
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
                            <!-- <td>@isset($AppData->recommendeddateFDA) <span style="color:green;font-weight: bolder">{{$AppData->recommendeddateFDA}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                          </tr>
                           <tr>
                            <th scope="row">Date :</th>

                            <!-- <td>@isset($AppData->recommendedtimeFDA) <span style="color:green;font-weight: bolder">{{$AppData->recommendedtimeFDA}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                            <td>@isset($recoDate) <span style="color:green;font-weight: bolder">{{date('M d, Y', strtotime($recoDate))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($recoEvalBy) <span style="color:green;font-weight: bolder">
                            <!-- <td>isset($AppData->recommendedbyFDA) <span style="color:green;font-weight: bolder"> -->
                            <!-- {{$AppData->recommendedbyFDA}} -->

                            {{$AppData->evalby_pre}}
                            {{$AppData->evalby_fname}}
                            {{$AppData->evalby_lname}}
                            {{$AppData->evalby_suf}}
                            

                             <!-- {{$AppData->recfdaval_pre}}
                            {{$AppData->recfdaval_fname}}
                            {{$AppData->recfdaval_lname}}
                            {{$AppData->recfdaval_suf}} -->
                            
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
                  <h3>Cashier Evaluation (RADIATION FACILITY)</h3>
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
                            <td>@isset($AppData->CashierApproveTimeFDA) <span style="color:green;font-weight: bolder">{{date('H:i A', strtotime($AppData->CashierApproveTimeFDA))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->CashierApproveDateFDA) <span style="color:green;font-weight: bolder">{{date('M d, Y', strtotime($AppData->CashierApproveDateFDA))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
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
          </div>
          @endif
          @if($request != 'machines')
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isCashierApprovePharma == null) list-group-item-info @elseif($AppData->isCashierApprovePharma == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isCashierApprovePharma == null) list-group-item-info @elseif($AppData->isCashierApprovePharma == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Cashier Evaluation (Pharmacy)</h3>
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
                            <td>@isset($AppData->CashierApproveByPharma) <span style="color:green;font-weight: bolder">{{$AppData->CashierApproveByPharma}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
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
          @endif
          <br/>
          <!-- <a href="{{url('client1/fdacertificate/29/'.$request)}}" target="_blank"> -->
          <!-- <a href="{{url('client1/createfdacert/'.$AppData->appid.'/'.$request)}}" target="_blank"> -->
          <a href="{{url('client1/createfdacert/'.$AppData->appid.'/'.$request)}}" target="_blank">
           <button style="float: right" class="btn btn-primarys"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Certificate</button>
          </a>
           <br/>
           <br/>
          </div>
        {{--  --}}
        @isset($AppData)
          @if(($AppData->isRecoDecision == 'Return for Correction' || $AppData->isRecoDecisionPhar == 'Return for Correction') || $currentRequest == null)  
          <hr>
          <div class="container">
            <center>
              <button class="btn btn-primarys" onclick="toggleModal(true)" style="background-color: #28a745" data-toggle="modal" data-target="#AccepttGodModal">Decision</button>&nbsp;
              {{-- <button class="btn btn-primarys" onclick="toggleModal(false)" style="background-color: #FF2200" data-toggle="modal" data-target="#AccepttGodModal">COC Denied</button> --}}
            </center>
          </div>
          @endif     
        @endisset
      </div>
      </div>
    </div>
        </div>
    </div>

 

 

  <div class="modal fade" id="AccepttGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <form id="AppFormFinal" enctype="multipart/form-data" data-parsley-validate>
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
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-md-12">
                            <div class="col-md text-center pb-2 pt-3" style="font-size: 20px;">
                              Evaluation Recommendation 
                            </div>
                            <div class="col-md d-flex justify-content-center">
                              <select name="recommendation" class="form-control" required style="width: 100%;">
                                <option disabled hidden selected>Please Select</option>
                                <option value="Recommendation for Approval">Recommendation for Approval</option>
                                <option value="Return for Correction">Return for Correction</option>
                                
                                <!-- <option value="RL">RL</option>
                                <option value="RFD">RFD</option>
                                <option value="RFC">RFC</option> -->

                              </select>
                            </div>
                          </div>
                      </div>
                    </div>
                    
                    <input type="text" id="desc_isAppr" value="" disabled hidden>
                    {{csrf_field()}}
                    {{-- <div class="row">
                      <div class="col-sm-4">Remarks:<span id="descRmk1" style="color:red;font-weight: bolder">*</span> </div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                        <textarea class="form-control" rows="5" id="desc_rmk"></textarea>
                      </div>
                    </div> --}}
                    @if($request != 'machines' && $request != 'pharma')
                    <div class="row">
                        <div class="col-sm-4">Password:<span style="color:red;font-weight: bolder">*</span> </div>
                        <div class="col-sm-8" >
                          <input type="password" class="form-control" rows="5" name="pass"  id="chckpass" data-parsley-required-message="<strong>Password<strong> required." required="">
                        </div>
                    </div>
                    @endif
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

                   

                  
                <hr>
                  <div class="row">
                      <div class="col-sm-6">
                        <button type="submit" id="MODALBTN" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                    </div>
               </div>

             
           </div>
         </div>
       </div>
     </div>
     </form>
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
            }
        });
</script>
@endsection