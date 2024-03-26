@extends('mainEmployee')
@section('title', 'Fail Process Flow')
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
          @isset($APPID)<input type="text" id="APPID" value="{{$APPID}}" hidden>@endisset
          <input type="" id="token" value="{{ Session::token() }}" hidden>
           Information of Application
           <button class="btn btn-primary" onclick="window.history.back();">Back</button>
        </div>
        <div class="card-body">
          <table class="table table-borderless">
          <thead>
            <tr>
              <td width="100%">
                <h2>@isset($AppData) {{$AppData->facilityname}} @endisset</h2>
                <h5>@isset($AppData) {{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} @endisset</h5>
                <h6>
                  @isset($AppData) Status: 
                    <span style="color:red"><strong>Disapproved Application</strong></span> 
                  @endisset
                </h6>
              </td>
            </tr>
          </thead>
          </tbody>  
        </table>
        <hr>
        <div class="container">
        {{--  --}}
        <div class="accordion" id="accordionExample">
          {{-- PRE-ASSESSMENT --}}
          {{-- <div class="card"> --}}
            {{-- START HEAD --}}
            {{-- <div class="card-header @isset($PreAss) list-group-item-success @else list-group-item-danger @endisset" id="headingzero" data-toggle="collapse" data-target="#collapseZero" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($PreAss) list-group-item-success @else list-group-item-danger @endisset" type="button" style="text-decoration:none">
                  <h3>Pre-Assessment</h3>
                </button>
              </div>
            </div> --}}
            {{-- END HEAD --}}
            {{-- START BODY --}}
            {{-- <div id="collapseZero"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($PreAss)<span style="color:green;font-weight: bolder">Already Taken</span>@else<span style="color:red;font-weight: bolder">Not yet taken</span>@endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($PreAss)<span style="color:green;font-weight: bolder">{{$PreAss->formattedDate}}</span>@else<span style="color:red;font-weight: bolder">Not Available</span>@endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($PreAss)<span style="color:green;font-weight: bolder">{{$PreAss->formattedTime}}</span>@else<span style="color:red;font-weight: bolder">Not Available</span>@endisset</td>
                          </tr>
                        </tbody>
                      </table>              
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @if(isset($PreAss) && isset($AppData))
                      <button class="btn btn-primarys" onclick="window.location.href='{{asset('/employee/dashboard/lps/preassessment/')}}/{{$AppData->uid}}'"><i class="fa fa-eye" aria-hidden="true"></i><span>&nbsp;View Pre-Assessment</span></button>
                      @else
                      &nbsp;
                      @endif($PreAss)
                    </center>
                  </div>
                </div>
              </div>
            </div> --}}
          {{-- END BODY --}}
          {{-- </div> --}}
          {{-- PRE-ASSESSMENT --}}
          {{-- /////////////////// --}}
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isrecommended == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isrecommended == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Evaluation</h3>
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
                            <td>@isset($AppData) @if($AppData->isrecommended == null) <span style="color:blue;font-weight: bolder">Not Evaluated</span> @elseif($AppData->isrecommended == 1)<span style="color:green;font-weight: bolder">Accepted Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->formmatedEvalDate) <span style="color:green;font-weight: bolder">{{$AppData->formmatedEvalDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->formmatedEvalTime) <span style="color:green;font-weight: bolder">{{$AppData->formmatedEvalTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->Evaluator) <span style="color:green;font-weight: bolder">{{$AppData->Evaluator}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>   
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isrecommended != null)
                        <button class="btn btn-primarys" onclick="window.location.href='{{ asset('/employee/dashboard/processflow/evaluate') }}/{{$AppData->appid}}'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Evaluation</button>
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
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isPayEval == null) list-group-item-info @elseif($AppData->isPayEval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isPayEval == null) list-group-item-info @elseif($AppData->isPayEval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Order of Payment Evaluation</h3>
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
                            <td>@isset($AppData) @if($AppData->isPayEval == null) <span style="color:blue;font-weight: bolder">Not Evaluated Payment</span> @elseif($AppData->isPayEval == 1)<span style="color:green;font-weight: bolder">Accepted Payment Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Payment Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->formmatedPayEvalTime) <span style="color:green;font-weight: bolder">{{$AppData->formmatedPayEvalTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->formmatedPayEvalDate) <span style="color:green;font-weight: bolder">{{$AppData->formmatedPayEvalDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->PayEvaluator) <span style="color:green;font-weight: bolder">{{$AppData->PayEvaluator}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isPayEval != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('/employee/dashboard/processflow/orderofpayment') }}/{{$AppData->appid}}'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Payment Evaluation</button>
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
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isCashierApprove == null) list-group-item-info @elseif($AppData->isCashierApprove == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isCashierApprove == null) list-group-item-info @elseif($AppData->isCashierApprove == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Cashier Evaluation</h3>
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
                            <td>@isset($AppData) @if($AppData->isCashierApprove == null) <span style="color:blue;font-weight: bolder">Not Evaluated Payment</span> @elseif($AppData->isCashierApprove == 1)<span style="color:green;font-weight: bolder">Accepted Payment Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Payment Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->CashierApproveTime) <span style="color:green;font-weight: bolder">{{$AppData->CashierApproveTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->CashierApproveDate) <span style="color:green;font-weight: bolder">{{$AppData->CashierApproveDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->CashierApproveBy) <span style="color:green;font-weight: bolder">{{$AppData->CashierApproveBy}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isPayEval != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('/employee/dashboard/processflow/cashier') }}/{{$AppData->appid}}'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Cashier Evaluation</button>
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
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isInspected == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isInspected == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Assessment</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseTwo"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->isInspected == null) <span style="color:blue;font-weight: bolder">Not Inspected</span> @elseif($AppData->isInspected == 1)<span style="color:green;font-weight: bolder">Accepted Assessment</span>@else<span style="color:red;font-weight: bolder">Disapproved Assessment</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->formmatedAssessDate) <span style="color:green;font-weight: bolder">{{$AppData->formmatedAssessDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->formmatedAssessTime) <span style="color:green;font-weight: bolder">{{$AppData->formmatedAssessTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->Assessor) <span style="color:green;font-weight: bolder">{{$AppData->Assessor}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table> 
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isInspected != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{asset('/employee/dashboard/processflow/assess')}}/{{$AppData->uid}}/{{$AppData->appid}}/view'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Assessment</button>
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
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isCashierApprove == null) list-group-item-info @elseif($AppData->isCashierApprove == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isCashierApprove == null) list-group-item-info @elseif($AppData->isCashierApprove == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Recommendation for Approval</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseThree"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-7">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->isRecoForApproval == null) <span style="color:blue;font-weight: bolder">Not Evaluated for Recommendation</span> @elseif($AppData->isRecoForApproval == 1)<span style="color:green;font-weight: bolder">Recommeded for Approval</span>@else<span style="color:red;font-weight: bolder">Not Recommended for Approval</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->RecoForApprovalTime) <span style="color:green;font-weight: bolder">{{$AppData->fRecoForApprovalTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->RecoForApprovalDate) <span style="color:green;font-weight: bolder">{{$AppData->fRecoForApprovalDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Recommended by:</th>
                            <td>@isset($AppData->RecoForApprovalby) <span style="color:green;font-weight: bolder">{{$AppData->RecommedationEvaluator}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-5">
                    <center>
                      {{-- @isset($AppData)
                        @if($AppData->isPayEval != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('/employee/dashboard/lps/cashier') }}/{{$AppData->appid}}'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Cashier Evaluation</button>
                        @else
                          &nbsp;
                        @endif
                      @endisset --}}
                    </center>
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          {{-- /////////////////// --}}
          {{-- /////////////////// --}}
          <div class="card">
            {{-- START HEAD --}}

            <div class="card-header @isset($AppData) @if($AppData->isApprove === null) list-group-item-info @elseif($AppData->isApprove === 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isApprove === null) list-group-item-info @elseif($AppData->isApprove === 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Approval/Issuance</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseThree"  class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-7">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->isApprove === null) <span style="color:blue;font-weight: bolder">Not Evaluated for Approval</span> @elseif($AppData->isApprove === 1)<span style="color:green;font-weight: bolder">Approved</span>@else<span style="color:red;font-weight: bolder">Disapproved Application</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->FapprovedTime) <span style="color:green;font-weight: bolder">{{$AppData->FapprovedTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->FapprovedDate) <span style="color:green;font-weight: bolder">{{$AppData->FapprovedDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->AprovalApprover) <span style="color:green;font-weight: bolder">{{$AppData->AprovalApprover}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          {{-- /////////////////// --}}
          </div>
        </div>
        {{--  --}}
        {{-- @isset($AppData)
          @if($AppData->isApprove == null)  
          <hr>
          <div class="container">
            <center>
              <button class="btn btn-primarys" onclick="toggleModal(true)" style="background-color: #28a745" data-toggle="modal" data-target="#AccepttGodModal">Approve</button>&nbsp;
              <button class="btn btn-primarys" onclick="toggleModal(false)" style="background-color: #FF2200" data-toggle="modal" data-target="#AccepttGodModal">Reject</button>
            </center>
          </div>
          @endif     
        @endisset --}}
      </div>
      </div>
    </div>
        </div>
    </div>
  <div class="modal fade" id="AccepttGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                  <form id="AppFormFinal" data-parsley-validate>
                    <input type="text" id="desc_isAppr" value="" disabled hidden>
                    <div class="row">
                      <div class="col-sm-4">Remarks:<span id="descRmk1" style="color:red;font-weight: bolder">*</span> </div>
                      <div class="col-sm-8">
                        <textarea class="form-control" rows="5" id="desc_rmk"></textarea>
                      </div>
                    </div>
                  
                <hr>
                  <div class="row">
                      <div class="col-sm-6">
                        <button type="submit" id="MODALBTN" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                        </form>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<script type="text/javascript">
	$(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip();});
        function toggleModal(test){
            if (test) { // Tr
                $('#keyWord').empty();
                $('#keyWord').append('approve');

                $('#descRmk1').hide();
                $('#desc_rmk').removeAttr('required');
                $('#desc_rmk').removeAttr('data-parsley-required-message');

                $('#desc_isAppr').removeAttr('value');
                $('#desc_isAppr').attr('value','1');
                // $('#MODALBTN').attr('onclick','AcceptNow(true);');
            } else { // Fa
                $('#keyWord').empty();
                $('#keyWord').append('reject');

                $('#descRmk1').show();
                $('#desc_rmk').removeAttr('required');
                $('#desc_rmk').removeAttr('data-parsley-required-message');
                $('#desc_rmk').attr('required', '');
                $('#desc_rmk').attr('data-parsley-required-message', '<strong>Remarks</strong> required');

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
                $.ajax({
                  method : 'POST',
                  data : {
                        _token : $('#token').val(),
                        isOk : $('#desc_isAppr').val(),
                        desc : $('#desc_rmk').val(),
                        id : $('#APPID').val(),

                  }, success : function(data){
                      if (data == 'DONE') {
                          alert('Success');
                          window.location.href = '{{ asset('employee/dashboard/processflow/approval') }}';
                      } else if (data == 'ERROR'){
                        $('#AccErrorAlert').show(100);  
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