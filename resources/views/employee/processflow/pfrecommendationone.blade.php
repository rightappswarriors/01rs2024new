@extends('mainEmployee')
@section('title', 'Recommendation Process Flow')
@section('content')
<div class="content p-4">
    <div class="card">
      @php $count = 0; @endphp
        <div class="card-header bg-white font-weight-bold">
          @isset($APPID)<input type="text" id="APPID" value="{{$APPID}}" hidden>@endisset
          <input type="" id="token" value="{{ Session::token() }}" hidden>
           Recommendation of Application
           <button class="btn btn-primary" onclick="window.history.back();">Back</button>
        </div>
        <div class="card-body">
          <table class="table table-borderless">
          <thead>
            <tr>
             
              <td width="100%">
                @if(isset($apdat))
                <h2>{{strtoupper($apdat->facilityname)}} </h2>
                <h4>{{$apdat->hfser_id}}R{{$apdat->rgnid}}-{{$apdat->appid}} </h4>
                @endif
                 <span>
                  <label>Process Type:&nbsp;</label>
                  <span class="font-weight-bold">@if($apdat->aptid == 'R'){{'Renewal'}}@elseif($apdat->aptid == 'IN'){{'Initial New'}}@elseif($apdat->aptid == 'IC'){{'Initial Change'}} @else {{'Unidentified'}} @endif
                  @if(isset($apdat->hfser_id)){{' '.$apdat->hfser_id}}@endif
                  </span>
                </span>
                <!-- <h2>@isset($AppData) {{$AppData->facilityname}} @endisset </h2> -->
                <h5>@isset($AppData) {{
                    $AppData->street_number?  strtoupper($AppData->street_number).',' : ' '
                  }}
                  {{
                    $AppData->streetname?  strtoupper($AppData->streetname).',': ' '
                  }} 
             
             {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} @endisset</h5>
             
                <h6>@isset($AppData) Status: @if ($AppData->isRecoForApproval === null) <span style="color:blue">For Recommendation Evaluation</span> @elseif($AppData->isRecoForApproval == 1)  <span style="color:green">Recommended for Approval</span> @else <span style="color:red">Disapproved for Approval</span> @endif @endisset</h6>
              @if($AppData->requestReeval == '1') <h6 style="color:blue">For Re-evaluation</h6> @endif
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
                      <button class="btn btn-primarys" onclick="window.location.href='{{asset('/employee/dashboard/lps/preassessment/')}}/{{$AppData->uid}}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i><span>&nbsp;View Pre-Assessment</span></button>
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
                            <td>@isset($AppData) @if($AppData->isrecommended == null) <span style="color:blue;font-weight: bolder">Not Evaluated</span> @elseif($AppData->isrecommended == 1)<span style="color:green;font-weight: bolder">Documentary Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Evaluation</span>@endif @endisset</td>
                            <!-- <td>@isset($AppData) @if($AppData->isrecommended == null) <span style="color:blue;font-weight: bolder">Not Evaluated</span> @elseif($AppData->isrecommended == 1)<span style="color:green;font-weight: bolder">Accepted Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Evaluation</span>@endif @endisset</td> -->
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->formmatedEvalTime) <span style="color:green;font-weight: bolder">{{$AppData->formmatedEvalTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->formmatedEvalDate) <span style="color:green;font-weight: bolder">{{$AppData->formmatedEvalDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Encoded by:</th>
                            <!-- <th scope="row">Evaluated by:</th> -->
                            <td>@isset($AppData->Evaluator) <span style="color:green;font-weight: bolder">{{$AppData->Evaluator}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>   
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isrecommended != null)
                        <button class="btn btn-primarys" onclick="window.location.href='{{ asset('/employee/dashboard/processflow/evaluate') }}/{{$AppData->appid}}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Evaluation</button>
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
            <!-- <div class="card-header @isset($AppData) @if($AppData->isPayEval == null) list-group-item-info @elseif($AppData->isPayEval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isPayEval == null) list-group-item-info @elseif($AppData->isPayEval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Order of Payment Evaluation</h3>
                </button>
              </div>
            </div> -->
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <!-- <div id="collapseTwo"  class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
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
            </div> -->
            {{-- END BODY --}}
          </div>
          {{-- /////////////////// --}}
          {{-- /////////////////// --}}
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->isCashierApprove == null) list-group-item-info @elseif($AppData->isCashierApprove == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isCashierApprove == null) list-group-item-info @elseif($AppData->isCashierApprove == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Cashier Evaluation</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseThree"  class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->isCashierApprove == null) <span style="color:blue;font-weight: bolder">Not Evaluated Payment</span> @elseif($AppData->isCashierApprove == 1)<span style="color:green;font-weight: bolder">Payment Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Payment Evaluation</span>@endif @endisset</td>
                            <!-- <td>@isset($AppData) @if($AppData->isCashierApprove == null) <span style="color:blue;font-weight: bolder">Not Evaluated Payment</span> @elseif($AppData->isCashierApprove == 1)<span style="color:green;font-weight: bolder">Accepted Payment Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Payment Evaluation</span>@endif @endisset</td> -->
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->CashierApproveTime) <span style="color:green;font-weight: bolder">{{$AppData->subClassid != 'ND' ||  $AppData->hfser_id != 'LTO'?     $AppData->FCashierApproveTime :  'Not Available'}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->CashierApproveDate) <span style="color:green;font-weight: bolder">{{$AppData->subClassid != 'ND'  ||  $AppData->hfser_id != 'LTO' ?  $AppData->FCashierApproveDate:  'Not Available' }}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Encoded by:</th>
                            <!-- <th scope="row">Evaluated by:</th> -->
                            <td>@isset($AppData->CashierApproveBy) <span style="color:green;font-weight: bolder">{{$AppData->subClassid != 'ND'  ||  $AppData->hfser_id != 'LTO' ? $AppData->CashierEvaluator:  'Not Available'}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                  
                    <center>
                      @isset($AppData)
                        @if($AppData->CashierApproveBy != null)
                          @if($AppData->subClassid != 'ND'  ||  $AppData->hfser_id != 'LTO')
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/actions') }}/{{$AppData->appid}}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Cashier Evaluation</button>
                          @else
                          <button disabled class="btn btn-primarys">No Evaluation Available</button>
                          @endif
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
          {{-- hferc eval --}}
          @if(isset($AppData))
          @if(strtolower($AppData->hfser_id) == 'ptc' && isset($otherDetails->HFERC_eval))
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($otherDetails->HFERC_eval == null) list-group-item-info @elseif($otherDetails->HFERC_eval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingThree" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($otherDetails->HFERC_eval == null) list-group-item-info @elseif($otherDetails->HFERC_eval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>HFERC Evaluation</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseSeven"  class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($otherDetails->HFERC_eval == null) <span style="color:blue;font-weight: bolder">Not Evaluated HFERC</span> @elseif($otherDetails->HFERC_eval == 1)<span style="color:green;font-weight: bolder">Recommended for Approval</span>@else<span style="color:red;font-weight: bolder">Recommended for Disapproval</span>@endif @endisset</td>
                          </tr>
                          {{-- <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($otherDetails->HFERC_evalTime) <span style="color:green;font-weight: bolder">{{$otherDetails->HFERC_evalTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr> --}}
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($otherDetails->HFERC_evalDate) <span style="color:green;font-weight: bolder">{{Date('g:i A',strtotime($otherDetails->HFERC_evalDate))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($otherDetails->HFERC_evalDate) <span style="color:green;font-weight: bolder">{{Date('M j, Y',strtotime($otherDetails->HFERC_evalDate))}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($otherDetails->HFERC_evalBy) <span style="color:green;font-weight: bolder">{{$otherDetails->pre . ' ' .$otherDetails->fname . ' ' .$otherDetails->lname . ' ' . $otherDetails->suf}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Remarks :</th>
                            <td>@isset($otherDetails->HFERC_comments)<span style="color:green;font-weight: bolder">{{$otherDetails->HFERC_comments}}</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->CashierApproveBy != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/view/hfercevaluation/') }}/{{$AppData->appid}}/{{AjaxController::maxRevisionFor($AppData->appid)}}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View HFERC Evaluation</button>
                          <!-- <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/view/hfercevaluation/') }}/{{$AppData->appid}}/{{$otherDetails->revision}}'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View HFERC Evaluation</button> -->
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
          @endif

          @if(isset($AppData))
          @if(strtolower($AppData->hfser_id) == 'con' )
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($AppData) @if($AppData->concommittee_eval == null) list-group-item-info @elseif($AppData->concommittee_eval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingThree" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->concommittee_eval == null) list-group-item-info @elseif($AppData->concommittee_eval == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>CON Committee Evaluation</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseFive"  class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->concommittee_eval == null) <span style="color:blue;font-weight: bolder">Not Evaluated</span> @elseif($AppData->concommittee_eval == 1)<span style="color:green;font-weight: bolder">Accepted CON Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved CON Evaluation</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->concommittee_evaltime) <span style="color:green;font-weight: bolder">{{\Carbon\Carbon::parse($AppData->concommittee_evaltime)->format('g:i A')}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->concommittee_evaldate) <span style="color:green;font-weight: bolder">{{\Carbon\Carbon::parse($AppData->concommittee_evaldate)->toFormattedDateString()}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Encoded by:</th>
                            <!-- <th scope="row">Evaluated by:</th> -->
                            <td>@isset($AppData->concommittee_evalby) <span style="color:green;font-weight: bolder">{{$AppData->com_pre}} {{$AppData->com_fname}} {{$AppData->com_mname}} {{$AppData->com_lname}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                            <!-- <td>@isset($AppData->concommittee_evalby) <span style="color:green;font-weight: bolder">{{$AppData->grp_desc}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td> -->
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->concommittee_eval != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/view/conevalution/') }}/{{$AppData->appid}}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View CON Committee Evaluation</button>
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
          @endif







          {{-- /////////////////// --}}
          {{-- /////////////////// --}}
          <div class="card">
            {{-- START HEAD --}}
            @if((strtolower($AppData->hfser_id) == 'lto' || strtolower($AppData->hfser_id) == 'coa') && $AppData->aptid != 'R')
            <div class="card-header @isset($AppData) @if($AppData->isInspected == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingOne" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isInspected == null) list-group-item-info @elseif($AppData->isrecommended == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Assessment</h3>
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
                            <td><span class="text-default" style="color:green;font-weight: bolder">
                              @isset($otherDetails->choice)
                              @switch($otherDetails->choice)
                                @case('issuance')
                                  {{-- <div class="container">For Licensing Process:</div> --}}
                                  For Issuance of License to Operate with Validity date from <strong><u>{{$otherDetails->valfrom}}</u></strong> to  <strong><u>{{$otherDetails->valto}}</u></strong>
                                @break
                                @case('compliance')
                                  
                                    Issuance depends upon compliance to the recommendations given and submission of the following within <strong><u>{{$otherDetails->days}}</u></strong> days from the date of inspection:
                                  

                                @case('non')
                                  @isset($otherDetails->details)
                                  
                                    <strong><u>{{$otherDetails->details}}</u></strong>
                                  
                                  @endisset
                                @break
                              @endswitch
                              @endisset
                            </span></td>
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
                            <td>@isset($otherDetails->evaluatedby) <span style="color:green;font-weight: bolder">{{$otherDetails->fname}}  {{$otherDetails->lname}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table> 
                  </div>
                  <div class="col-sm-7">
                    <center>
                      @isset($AppData)
                        @if($AppData->isInspected != null)
                          <button class="btn btn-primarys" onclick="window.location.href='{{asset('employee/dashboard/processflow/parts')}}/{{$AppData->appid}}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Assessment</button>
                          @else
                          &nbsp;
                        @endif
                      @endisset
                    </center>
                  </div>
                </div>
                <div class="row">
                	<div class="col-sm-12">
                		<center><button class="btn btn-primarys" data-toggle="collapse" data-target="#SelectedTeamMembers" aria-expanded="false" aria-controls="SelectedTeamMembers"><i class="fa fa-eye" aria-hidden="true" ></i>&nbsp;View Team</button></center>
                	</div>
                	<div class="col-sm-12 collapse table-responsive" id="SelectedTeamMembers">
                		<div class="card card-body">
                			<table class="table">
	                			<thead>
	                				<tr>
	                					<td scope="col">Name</td>
	                					<td scope="col" class="text-center">Remarks</td>
	                				</tr>
	                			</thead>
	                			<tbody>
	                				@isset ($Teams4theApplication)
	                					@foreach ($Teams4theApplication as $t)
	                						<tr>
	                							<td style="font-weight: bold">{{$t->fullname}}</td>
	                							<td class="text-center">{{$t->remarks}}</td>
	                						</tr>
	                					@endforeach
									@else
										<tr>
											<td colspan="2">
												<center>NO DATA </center>
											</td>
										</tr>
	                				@endisset
	                			</tbody>
	                		</table>
                		</div>
                	</div>
                </div>
              </div>
            </div>
            @endif
            {{-- END BODY --}}
          </div>

                 
          @if(isset($complianceDetails[0]) && $AppData->aptid != 'R')             
          <div class="card">
            {{-- START HEAD --}}
            <div class="card-header @isset($complianceDetails) @if($complianceDetails[0]->is_for_compliance == 1) list-group-item-info @elseif($complianceDetails[0]->is_for_compliance  == 2) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($complianceDetails) @if($complianceDetails[0]->is_for_compliance == 1)list-group-item-info @elseif($complianceDetails[0]->is_for_compliance  == 2) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>Compliance Evaluation</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             {{-- START BODY --}}
            <div id="collapseThree"  class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($complianceDetails[0]->is_for_compliance == 1) <span style="color:blue;font-weight: bolder">For Compliance</span> @elseif($complianceDetails[0]->is_for_compliance == 2)<span style="color:green;font-weight: bolder">Complied</span>@else<span style="color:red;font-weight: bolder">Not Inspected</span>@endif @endisset</td>
                            <!-- <td>@isset($AppData) @if($AppData->isCashierApprove == null) <span style="color:blue;font-weight: bolder">Not Evaluated Payment</span> @elseif($AppData->isCashierApprove == 1)<span style="color:green;font-weight: bolder">Accepted Payment Evaluation</span>@else<span style="color:red;font-weight: bolder">Disapproved Payment Evaluation</span>@endif @endisset</td> -->
                          </tr>

                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($complianceDetails[0]->last_update) <span style="color:green;font-weight: bolder">{{$complianceDetails[0]->last_update ?  date('h:i A', strtotime($complianceDetails[0]->last_update)) :  'Not Available'}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>


                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($complianceDetails[0]->last_update) <span style="color:green;font-weight: bolder">{{$complianceDetails[0]->last_update ?   date('M d, Y', strtotime($complianceDetails[0]->last_update)) :  'Not Available'}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($complianceDetails[0]->evaluatedby) <span style="color:green;font-weight: bolder">{{$complianceDetails[0]->evaluatedby ?  $complianceDetails[0]->evaluatedby:  'Not Available'}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                        </tbody>
                      </table>  
                  </div>
                  <div class="col-sm-7">
                  
                    <center>
                      @isset($AppData)
                        @if($complianceDetails[0]->is_for_compliance != null)
                          @if($complianceDetails[0]->is_for_compliance == 2)
                          <button class="btn btn-primarys" onclick="window.location.href='{{ asset('employee/dashboard/processflow/compliancedetails') }}/{{$complianceDetails[0]->compliance_id }}?from=rec'"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Compliance Evaluation</button>
                          @else
                          <button disabled class="btn btn-primarys">No Evaluation Available</button>
                          @endif
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


          @if((strtolower($AppData->hfser_id) == 'lto' || strtolower($AppData->hfser_id) == 'coa') && isset($canView[1]) && $canView[1])
          {{-- fda start --}}



   

          <div class="card">
            {{-- START HEAD --}}
            @if($AppData->isApproveFDA != 1)

              @php $count++ @endphp
            @endif
            <div class="card-header @isset($AppData) @if($AppData->isApproveFDA == null) list-group-item-info @elseif($AppData->isApproveFDA == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingFive" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isApproveFDA == null) list-group-item-info @elseif($AppData->isApproveFDA == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>FDA Radiation Facility</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             
             {{-- START BODY --}}
            <div id="collapseFour"  class="collapse show" aria-labelledby="headingFive" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->isApproveFDA == null) <span style="color:blue;font-weight: bolder">Not Inspected</span> @elseif($AppData->isApproveFDA == 1)<span style="color:green;font-weight: bolder">Approved</span>@else<span style="color:red;font-weight: bolder">COC Denied</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">FDA Status :</th>
                            <td>@isset($AppData) @if($AppData->FDAStatMach == null) <span style="color:blue;font-weight: bolder">Not Inspected</span> @elseif($AppData->FDAStatMach)<span style="color:green;font-weight: bolder">{{$AppData->FDAStatMach}}</span>@else<span style="color:red;font-weight: bolder">COC Denied</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->FDAapprovedDate) <span style="color:green;font-weight: bolder">{{$AppData->FDAapprovedDate}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->FDAapprovedTime) <span style="color:green;font-weight: bolder">{{$AppData->FDAapprovedTime}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->FDAAprovalApprover) <span style="color:green;font-weight: bolder">{{$AppData->FDAAprovalApprover}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          @if($AppData->isApproveFDA != null && $AppData->FDAStatMach != 'COC Still Valid')
                          <tr>
                            <th scope="row">Certificate:</th>
                            <td><a href="{{url('client1/fdacertificate/'.$AppData->appid.'/machines')}}"><i class="fa fa-file"></i> Click to Download</a></td>
                          </tr>
                          @endif
                          {{-- <tr>
                            <th scope="row">File Uploads:</th>
                            <td>
                              <div class="row" style="color:green;">
                              @if(isset($AppData->pharUp) || isset($AppData->xrayUp))
                              <div class="col">
                                <div class="row">
                                  <div class="col font-weight-bold">Pharmacy COC/RL Upload</div>
                                  <div class="col text-center">
                                    <a target="_blank" class="btn btn-primary mt-3" href="{{ route('OpenFile', $AppData->pharUp)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                              </div>
                              @if(isset($AppData->xrayUp))
                              <div class="col">
                                <div class="row">
                                  <div class="col font-weight-bold">Radiological Equipment COC/RL Upload</div>
                                  <div class="col text-center">
                                    <a target="_blank" class="btn btn-primary mt-3" href="{{ route('OpenFile', $AppData->xrayUp)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                              </div>
                              @endif
                              @endif
                              </div>
                            </td>
                          </tr> --}}
                        </tbody>
                      </table> 
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          {{-- fda end --}}
          @endif

          
          @if((strtolower($AppData->hfser_id) == 'lto' || strtolower($AppData->hfser_id) == 'coa' ) && isset($AppData->noofmain) )
          <!-- if(strtolower($AppData->hfser_id) == 'lto' || strtolower($AppData->hfser_id) == 'coa' && isset($canView[0]) && $canView[0]) -->
          {{-- fda start --}}
          <div class="card">
            {{-- START HEAD --}}
            @if($AppData->isApproveFDAPharma != 1)
              @php $count++ @endphp
            @endif
            <div class="card-header @isset($AppData) @if($AppData->isApproveFDAPharma == null) list-group-item-info @elseif($AppData->isApproveFDAPharma == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" id="headingFive" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne" style="">
              <div class="mb-0">
                <button class="btn btn-link @isset($AppData) @if($AppData->isApproveFDAPharma == null) list-group-item-info @elseif($AppData->isApproveFDAPharma == 1) list-group-item-success  @else list-group-item-danger @endif @endisset" type="button" style="text-decoration:none">
                  <h3>FDA Pharmacy</h3>
                </button>
              </div>
            </div>
             {{-- END HEAD --}}
             
             {{-- START BODY --}}
            <div id="collapseFour"  class="collapse show" aria-labelledby="headingFive" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                      <table class="table table-borderless table-sm">
                        <thead><tr><th width="40%"></th><th width="60%"></th></tr></thead>
                        <tbody>
                          <tr>
                            <th scope="row">Status :</th>
                            <td>@isset($AppData) @if($AppData->isApproveFDAPharma == null) <span style="color:blue;font-weight: bolder">Not Inspected</span> @elseif($AppData->isApproveFDAPharma == 1)<span style="color:green;font-weight: bolder">Approved</span>@else<span style="color:red;font-weight: bolder">COC Denied</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">FDA Status :</th>
                            <td>@isset($AppData) @if($AppData->FDAStatPhar == null) <span style="color:blue;font-weight: bolder">Not Inspected</span> @elseif($AppData->FDAStatPhar)<span style="color:green;font-weight: bolder">{{$AppData->FDAStatPhar}}</span>@else<span style="color:red;font-weight: bolder">COC Denied</span>@endif @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Date :</th>
                            <td>@isset($AppData->FDAapprovedDatePharma) <span style="color:green;font-weight: bolder">{{$AppData->FDAapprovedDatePharma}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Time :</th>
                            <td>@isset($AppData->FDAapprovedTimePharma) <span style="color:green;font-weight: bolder">{{$AppData->FDAapprovedTimePharma}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          <tr>
                            <th scope="row">Evaluated by:</th>
                            <td>@isset($AppData->FDAAprovalApproverPharma) <span style="color:green;font-weight: bolder">{{$AppData->FDAAprovalApproverPharma}}</span> @else <span style="color:red;font-weight: bolder">Not Available</span> @endisset</td>
                          </tr>
                          @if($AppData->isApproveFDAPharma != null && $AppData->FDAStatPhar != 'COC Still Valid')
                          <tr>
                            <th scope="row">Certificate:</th>
                            <td><a href="{{url('client1/fdacertificate/'.$AppData->appid.'/pharma')}}"><i class="fa fa-file"></i> Click to Download</a></td>
                          </tr>
                          @endif
                          {{-- <tr>
                            <th scope="row">File Uploads:</th>
                            <td>
                              <div class="row" style="color:green;">
                              @if(isset($AppData->pharUp) || isset($AppData->xrayUp))
                              <div class="col">
                                <div class="row">
                                  <div class="col font-weight-bold">Pharmacy COC/RL Upload</div>
                                  <div class="col text-center">
                                    <a target="_blank" class="btn btn-primary mt-3" href="{{ route('OpenFile', $AppData->pharUp)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                              </div>
                              @if(isset($AppData->xrayUp))
                              <div class="col">
                                <div class="row">
                                  <div class="col font-weight-bold">Radiological Equipment COC/RL Upload</div>
                                  <div class="col text-center">
                                    <a target="_blank" class="btn btn-primary mt-3" href="{{ route('OpenFile', $AppData->xrayUp)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                              </div>
                              @endif
                              @endif
                              </div>
                            </td>
                          </tr> --}}
                        </tbody>
                      </table> 
                  </div>
                </div>
              </div>
            </div>
            {{-- END BODY --}}
          </div>
          {{-- fda end --}}
          @endif
          {{-- /////////////////// --}}
          </div>
        </div>

        @isset($AppData)
          @if($AppData->status == "FR"  || $AppData->aptid == 'R' || $apdat->hfser_id == 'PTC')
            
            <hr>
            <div class="container">
              @if($count <= 0 || !isset($AppData->isRecoForApproval))
              <center>
            
                <button class="btn btn-primarys" onclick="toggleModal(true)" style="background-color: #28a745" data-toggle="modal" data-target="#AccepttGodModal">Approve</button>&nbsp;
                <button class="btn btn-primarys" onclick="toggleModal(false)" style="background-color: #FF2200" data-toggle="modal" data-target="#AccepttGodModal">Disapprove</button>
            
              </center>
              @else 
              <h4 class="text-center">Nothing to recommend yet because either of the following reasons:</h4>
              <ul class="text-center">
                  <li>Probably there is no evaluations nor assessment yet.</li>
                  <li>Application already recommended.</li>
              </ul>
              @endif
            </div>  
          @else
            <h4 class="text-center">Nothing to recommend yet because either of the following reasons:</h4>
            <ul class="text-center">
              <li>Application forwarded is not for recommendation yet.</li>
              <li>Application forwarded is not a renewal process nor PTC.</li>
            </ul>
          @endif     
        @endisset
      </div>
      </div>
    </div>
</div>
  <div class="modal fade" id="AccepttGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Recommendation of Application</strong></h5>
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
                      <div class="col-sm-4 required req">Remarks:<span id="descRmk1" style="color:red;font-weight: bolder">*</span> </div>
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
                $('#keyWord').append('recommend');

                $('#descRmk1').hide();
                $('#desc_rmk').removeAttr('required');
                $('#desc_rmk').removeAttr('data-parsley-required-message');

                $('#desc_isAppr').removeAttr('value');
                $('#desc_isAppr').attr('value','1');
                // $('#MODALBTN').attr('onclick','AcceptNow(true);');
            } else { // Fa
                $('#keyWord').empty();
                $('#keyWord').append('not recommend');

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
                          $("#AccepttGodModal").modal('toggle');
                          Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Recommended this application to approval.',
                          }).then(() => {
                            window.location.href = '{{ asset('employee/dashboard/processflow/pfrecommendationone') }}';
                          });
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