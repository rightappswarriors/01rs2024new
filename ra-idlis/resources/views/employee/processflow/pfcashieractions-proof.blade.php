@extends('mainEmployee')
@section('title', 'Cashiering')
@section('content')
<div class="content p-4">
  <div hidden>
    @isset($OOPs)
      <datalist id="OrderOfPaymentList">
          @foreach ($OOPs as $day)
            <option id="{{$day->oop_id}}_OOP" value="{{$day->oop_id}}">{{$day->oop_desc}}</option>
          @endforeach
      </datalist>
    @endisset
    @if (isset($OOPs) && isset($Chrges))
    {{-- {{dd($OOPs)}} --}}
        @foreach ($OOPs as $O)
          <datalist id="{{$O->oop_id}}_List">
            @foreach ($Chrges as $C)
              @if ($C->oop_id == $O->oop_id)
                <option value="{{$C->chgapp_id}}" id="{{$C->chgapp_id}}_CHG" code="{{$C->chg_code}}" amt="{{$C->amt}}" frmAMT="{{$C->formattedAmt}}">{{$C->chg_desc}} {{$C->chg_rmks}}</option>
              @endif
            @endforeach
          </datalist>
        @endforeach
    @endif
  </div>
    <div class="card">
      <input type="hidden" value="{{$appform_id}}" name="appform_id">
        <div class="card-header bg-white font-weight-bold">
          @isset($APPID)<input type="text" id="APPID" value="{{$APPID}}" hidden>@endisset
          <input type="" id="token" value="{{ Session::token() }}" hidden>
           Cashier Evaluation <span class="optnTD" style="display: none;">(Overide Payment Mode)</span>&nbsp;
           <button class="btn btn-primary" onclick="window.history.back();">Back</button>
           <input style="float: right; width: 10%; background-color: {{$AppData->proofpaystat == 'posted' ? '#BDE5F8' : 'orange'}}"  class="form-control" type="text" disabled value="{{$AppData->proofpaystat == 'posting' ? 'For Posting' : ( $AppData->proofpaystat == 'posted' ? 'Posted' : 'No Proof')}}">
        </div>
     
        <div class="card-body">
          <table class="table table-borderless">
          <thead>
            <tr>
              <td width="100%">
                <h2>@isset($AppData) {{$AppData->facilityname}} @endisset</h2>
                <h5>@isset($AppData) {{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} @endisset</h5>
                <h5>
                  Code: <span class="font-weight-bold">{{$code}}</span>
                </h5>
                <h6>@isset($AppData) Status: @if ($AppData->isCashierApprove === null) <span style="color:blue">For Payment Evaluation</span> @elseif($AppData->isCashierApprove == 1)  <span style="color:green">Payment Evaluated</span> @else <span style="color:red">Disapproved Payment</span> @endif @endisset</h6>
              </td>
            </tr>
          </thead>
          </tbody>  
        </table>
        <hr>
        <div class="container-fluid border mb-3">
            <div class="row">
                
              @if($AppData->isCashierApprove != 1)
                @if($canAdd)
              
                  <!-- <button type="button" onclick="insert()" data-toggle="modal" data-target="#bd-example-modal-sm" class="btn btn-primary p-2 m-1">
                    <i class="fa fa-plus" aria-hidden="true"></i> Accept Payment
                  </button> -->

                  

                  @if($AppData->isPayProofFilen == 1 )
                 
                  <a target="_blank" href="{{ route('OpenFile', $AppData->payProofFilen) }}" >
                  <button style="float: right;" type="button" class="btn btn-primary p-2 m-1">
                  </i> View Proof of Payment
                  </button>
                  </a>
                  <button class="btn btn-success p-2 m-1" data-toggle="modal" data-target="#evaluatePayment"> <i class="fa fa-check" aria-hidden="true"></i> Confirm Payment </button>
                  
                  @else
                  <button style="float: right;" onclick="alert('Please wait for the proof of payment.')" type="button" class="btn btn-warning p-2 m-1">
                  </i> No proof of payment attached yet
                  </button>
                  @endif
                @endif
              @endif
              @if($AppData->isCashierApprove == 1)
              <!-- <button type="button" onclick="window.location.href='{{asset('employee/dashboard/processflow/printor/').'/'.$APPID}}'" class="btn btn-primary p-2 m-1">
                <i class="fa fa-print" aria-hidden="true"></i> Print Official Receipt
              </button> -->
              <a target="_blank" href="{{ route('OpenFile', $AppData->payProofFilen) }}" >
                  <button style="float: right;" type="button" class="btn btn-primary p-2 m-1">
                  </i> View Proof of Payment
                  </button>
                  </a>
              @endif
              @if($Sum <= 0 && empty($AppData->isCashierApprove))
              <!-- <button class="btn btn-success p-2 m-1" data-toggle="modal" data-target="#evaluatePayment"> <i class="fa fa-check" aria-hidden="true"></i> Confirm Payment</button> -->
              @endif
            </div>
          </div>
            <div class="row mt-3">
              <div class="col-md">
                Selected payment method: <span class="font-weight-bold">{{isset($uChoosen->chg_desc) ? $uChoosen->chg_desc : 'No Selection'}}</span>
              </div>
            </div>
            @isset($uChoosen)
            <div class="row mt-1">
              <div class="col-md">
                <button type="button" data-toggle="modal" data-target="#userSide" class="btn btn-primary p-2 m-1">
                  <i class="fa fa-eye" aria-hidden="true"></i> Show Details
                </button>
              </div>
            </div>
            @endisset
          
    {{-- Start Removal 
          <div class="row pt-5">
            <div class="col text-left">
              <span class="pl-1 h2">Payment</span>
            </div>
            <div class="col h3 text-right">
              Amount to be paid: <span class="font-weight-bold">{{'PHP '.number_format($Sum,2)}}</span>
            </div>
          </div>
        <table class="table" width="100%">
          <thead>
              <tr>
                <th scope="col" style="text-align:center;width:auto;">Payment accepted by:</th>
                <th scope="col" style="text-align:center;width:auto;">Payment Date:</th>
                <th scope="col" style="text-align:left;width:auto;">Mode of Payment:</th>
                <th scope="col" style="text-align:left;width:auto;">Nature of Collection:</th>
                <th scope="col" style="text-align:center;width:auto;">OR Number:</th>
                {{-- <th scope="col" style="text-align:center;width:auto;">Deposit Slip Number:</th> --}}
                {{--<th scope="col" style="text-align:left;width:auto;">Other Reference:</th>--}}
                <th scope="col" style="text-align:left;width:auto;">Drawee Bank:</th>
                <th scope="col" style="text-align:left;width:auto;">Number:</th>
                <th scope="col" style="text-align:left;width:auto;">Uploaded File</th>
                <th scope="col" style="text-align:left;width:auto;">Amount Paid:</th>
                <th scope="col" style="text-align:left;width:auto;">Action</th>
                <th scope="col" class="optnTD" style="text-align:center;display:none;width:auto;">Option</th>
              </tr>
          </thead>
          <tbody id="PaymentTable">
            @isset($Payments)
              @if($paymentRec > 0)

                @foreach ($Payments as $element)
                  @if($element->cat_id == 'PMT')
                    <tr>
                      <th scope="row" style="text-align:center;cursor: pointer;"><span data-toggle="tooltip" title="{{$element->oop_desc}}">{{$element->recievedBy}}</span></th>
                      <th scope="row" style="text-align:center">{{(!empty($element->paymentDate) ? Date('F j, Y',strtotime($element->paymentDate)) : '-' )}}</th>
                      <td>{{$element->chg_desc}}</td>
                      <td>{{$element->m04Desc}}</td>
                      <td>{{$element->ORRef}}</td>
                      {{-- <td>{{$element->depositNum}}</td> --}}
                      {{-- <td>{{$element->otherRef}}</td> --}}
                      <td>
                        {{($element->draweeBank ?? 'No Drawee Bank')}}
                      </td>
                      <td>
                        {{($element->number ?? 'No Number')}}
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md">
                            @if(!empty($element->attachedFile))
                            <a class="p-3" target="_blank" href="{{ route('OpenFile', $element->attachedFile)}}"><i class="fa fa-file" style="font-size: 30px;" aria-hidden="true"></i></a>
                            @else
                            No File Uploaded
                            @endif
                          </div>
                        </div>
                      </td>
                      {{-- <td class="text-center">@isset($element->cat_type)@if($element->cat_type == "P") {{date("F j, Y", strtotime($element->paymentDate))}}@endif @endisset</td> --}}
                      {{-- <td class="text-center">@isset($element->cat_type)@if($element->cat_type == "P") {{$element->chg_desc}} @endif @endisset</td> --}}
                      <td style="text-align:left">{!!($element->reference != 'Payment'? 'PHP '.number_format(abs($element->amount)) : '<strong>-PHP '.number_format(abs($element->amount))."</strong")!!}</td>
                      {{-- <td class="optnTD" style="display:none"><center><button style="background-color: #d40000" class="btn btn-primarys" onclick="showDelete({{$element->id}}, '{{$element->chg_code}} - {{$element->reference}}')"><i class="fa fa-trash" aria-hidden="true"></i></button></center></td> --}}
                      <td>
                        <div class="row">
                        @if($AppData->isCashierApprove != 1)
                        <div class="col-md-6">
                          <span class="">
                            <button type="button" class="btn btn-outline-warning text-center" data-toggle="modal" data-target="#GodModal" onclick="showData('{{$element->id}}','{{$element->ORRef}}'/*,'{{$element->otherRef}}'*/,'{{$element->amount}}')">
                              <i class="fa fa-fw fa-edit"></i>
                            </button>
                          </span>
                        </div>
                        {{-- <div class="col-md-6">
                          <span class="AT002_cancel">
                            <button type="button" class="btn btn-danger" onclick="showDelete('{{$element->id}}');">
                              <i class="fa fa-ban" aria-hidden="true"></i>
                            </button>
                          </span>
                        </div> --}}
                        @endif
                        </div>
                      </td>
                    </tr>
                  @endif
                @endforeach
              @else
                <tr>
                  <td class="text-center font-weight-bold" colspan="7">No Payment Records</td>
                </tr>
              @endif


            @endisset
          </tbody>
        </table>
     
        <div class="container-fluid h3 text-left mt-5 pb-1">
          Order of Payments
        </div>
         <table class="table" width="100%">
          <thead>
              <tr>
                <th scope="col" style="text-align:center;width:auto;">Description</th>
                <th scope="col" style="text-align:center;width:auto;">Nature of Collection</th>
                <th scope="col" style="text-align:center;width:auto;">Account Code</th>
                {{-- <th scope="col" style="text-align:center;width:auto;">OOP Code</th> --}}
                {{-- <th scope="col" style="text-align:center;width:auto;">Charge Code</th> --}}
                
                {{-- <th scope="col" style="text-align:center;width:auto;">Payment Date/Time</th>
                <th scope="col" style="text-align:center;width:auto;">Payment Mode</th> --}}
                <th scope="col" style="text-align:left;width:auto;">Amount</th>
              </tr>
          </thead>
          <tbody>
            @isset($Payments)
              @foreach ($Payments as $element)
                @if($element->cat_id !== 'PMT')
                 <tr class="text-center">
                  <td class="text-center font-weight-bold">{{$element->reference}}</td>
                  <td class="text-center font-weight-bold">{{$AppData->hfser_id}}</td>
                  <td>{{isset($element->m04ID) ? $element->m04ID : 'Not Yet Defined'}}</td>
                  {{-- <td class="text-center">{{isset($element->m04Desc) ? $element->m04ID : 'Not Yet Defined'}}</td> --}}
                  {{-- <th scope="row" style="text-align:center;cursor: pointer;"><span data-toggle="tooltip" title="{{$element->oop_desc}}">{{$element->oop_id}}</span></th> --}}
                  {{-- <th scope="row" style="text-align:center">{{$element->chg_code}}</th> --}}
                  
                  {{-- <td class="text-center">@isset($element->cat_type)@if($element->cat_type == "P") {{Date("F j, Y", strtotime($element->t_date))}}, {{date("g:i a", strtotime($element->t_time))}} @endif @endisset</td> --}}
                  {{-- <td class="text-center">@isset($element->cat_type)@if($element->cat_type == "P") {{$element->chg_desc}} @endif @endisset</td> --}}
                  <td style="text-align:left">{!!($element->reference != 'Payment'? 'PHP '.number_format(abs($element->amount)) : '<strong>-PHP '.number_format(abs($element->amount))."</strong")!!}</td>
                  {{-- <td class="optnTD" style="display:none"><center><button style="background-color: #d40000" class="btn btn-primarys" onclick="showDelete({{$element->id}}, '{{$element->chg_code}} - {{$element->reference}}')" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-trash" aria-hidden="true"></i></button></center></td> --}}
                </tr>
                @endif
              @endforeach
            @endisset
          </tbody>
        </table> 
        @isset($AppData)
        @if(!isset($AppData->isCashierApprove))
        <br>
        <hr
        @endif

    

        @endisset
      </div>
      </div>
    </div>
</div>
<div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Edit Payment</strong></h5>
          <hr>
          <div class="container">
                <form id="EditNow" data-parsley-validate>
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
                <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                    <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <span id="EditBody">
                </span>
                <div class="row">
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                  </div> 
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                  </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="AccepttGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong> <span id="AppRegTitle">&nbsp;</span> </strong></h5>
              <hr>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AccErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AccErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
              <div class="col-sm-12">
                    <div class="col-sm-12 text-justify"> 
                      <p>Are you sure that you want to certify that this payment evaluation is to be <span id="AppRegTest"></span>?</p>
                      <p>Clicking Yes means you reviewed and checked the application.</p>
                    </div>
                    <form id="ApprRejRmk" data-parsley-validate>
                    @isset($APPID)
                      <input type="text" id="SelectedAPPID" value="{{$APPID}}" hidden="">
                    @endisset
                    <div class="row" hidden>
                        <div class="col-sm-4">Remarks:</div>
                        <div class="col-sm-8"><textarea rows="3" id="RmkTest" class="form-control"></textarea></div>
                    </div>
                  </form>
                <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" id="AppRegBtn" onclick="" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
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
<div class="modal fade" id="AddGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Add Payment</strong></h5>
              <hr>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
              <div class="">
                <form id="addRgn" data-parsley-validate>
                  {{ csrf_field() }}
                  <span class="container" id="AddModSpan" style="width: 100%">
                  </span>
                </form>
                <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" onclick="$('#addRgn').submit()" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add</button>
                    </div> 
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                    </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="modal fade" id="bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Add Payment</strong></h5>
            <hr>
            <div class="container">
              <form method="POST" action="{{asset('employee/dashboard/cashier')}}" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <input type="hidden" name="aptid" value="{{!empty($aptid)? $aptid :""}}">
                  <input type="hidden" name="appform_idSubmit" value="">
                  <div class="container lead">Payment</div><br>
                  <div class="container">
                   {{--  <div class="row">
                      <div class="col-6 pt-2">User ID:</div>
                      <div class="col-6">
                        <input type="text" readonly value="{{$loggedIn['cur_user']}}" name="userID" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 pt-2">Payment Date:</div>
                      <div class="col-6">
                        <input type="hidden" name="appid">
                        <input type="date" name="pDate" value="{{$loggedIn['date']}}" class="form-control">
                      </div>
                    </div> --}}
                    <div class="row">
                      <div class="col-6 pt-2">Mode of Payment:</div>
                      <div class="col-6">
                        <select required class="form-control" name="mPay">
                          <option value="">Select one</option>
                          @foreach($paymentMethod as $meth)
                            <option value="{{$meth->chg_code}}">{{$meth->chg_desc}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    {{-- <div class="row forCheck" hidden>
                      <div class="col-6 pt-2">Attached File:</div>
                      <div class="col">
                        <input type="file" name="attFile" class="form-control">
                        <input type="text" name="otherFile" class="form-control" hidden>
                      </div>
                      @isset($uChoosen->attachedFile)
                      <div class="col-3">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" onchange="same()" id="customCheck">
                          <label class="custom-control-label" for="customCheck">Use attached file</label>
                        </div>
                      </div>
                      @endisset
                    </div> --}}
                    <div class="row forCheck" hidden>
                      <div class="col-6 pt-2">Drawee Bank: <br> <small class="text-danger">NOTE: Please provide branch of selected Bank (e.g Landbank, sample branch)</small></div>
                      <div class="col-6 mt-3">
                        <input type="text" name="drawee" class="form-control">
                      </div>
                    </div>
                    <div class="row forCheckandforMO">
                      <div class="col-6 pt-2">Number:</div>
                      <div class="col-6">
                        <input type="number" name="number" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 pt-2">OR Number:</div>
                      <div class="col-6">
                        <input type="number" required=""  name="orRef" class="form-control">
                      </div>
                    </div>
                    

                  {{--   <div class="row">
                      <div class="col-6 pt-2">Deposit Slip Number:</div>
                      <div class="col-6">
                        <input type="text" name="slipNum" class="form-control">
                      </div>
                    </div> --}}
                   {{--  <div class="row">
                      <div class="col-6 pt-2">Other Reference:</div>
                      <div class="col-6">
                        <input type="text" name="otherRef" class="form-control">
                      </div>
                    </div> --}}
                    <div class="row">
                      <div class="col-6 pt-2">Amount Paid:</div>
                      <div class="col-6">
                        <input type="number" value="{{$Sum}}" required="" name="aPaid" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 pt-2">Nature of Payment:</div>
                      <div class="col-6">
                        <select name="uacs" id="UACS_data" class="form-control" required="">
                          <option value="">Please Select</option>
                           @foreach($uacs as $uacs_data)
                              <option value={{$uacs_data->m04IDA}}>{{$uacs_data->m04Desc . "(".$uacs_data->m04ID.")"}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="row mt-5 mb-5">
                      <div class="col-6">
                        <button class="btn btn-primary btn-block" type="submit">Submit</button>
                      </div>
                      <div class="col-6">
                        <button class="btn btn-danger btn-block" type="button" onclick="$('#bd-example-modal-sm').modal('hide')">Cancel</button>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>

<div class="modal fade" id="evaluatePayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: #272b30;color: white;"> 
        <div class="modal-body text-center">
          <h4 class="modal-title text-center"><strong>Evaluation</strong></h4>
            <hr>
            <span id="evaluatePaymentBody ">
              Are you sure you want to confirm this payment?
            </span>
            <hr>            
              <div class="row">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col">
                    <button type="button" onclick="seq()" data-dismiss="modal" class="btn btn-outline-primary form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Confirm</button>
                  </div>
                  <div class="col">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
                  </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
  </div>
</div>

@isset($uChoosen)
<div class="modal fade" id="userSide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: #272b30;color: white;"> 
        <div class="modal-body text-center">
          <h4 class="modal-title text-center"><strong>User Inputs</strong></h4>         
            <div class="row mt-5 border-top">
              <div class="col-md mt-3" style="font-size: 20px;">User Upload</div>
              <div class="col-md mt-3">
                @isset($uChoosen->attachedFile)
                <a class="p-3" target="_blank" href="{{ route('OpenFile', $uChoosen->attachedFile)}}"><i class="fa fa-file" style="font-size: 30px;" aria-hidden="true"></i></a>
                @else
                NOT SET
                @endisset
              </div>
            </div>
            <div class="row mt-5 border-top">
              <div class="col-md mt-3" style="font-size: 20px;">Bank</div>
              <div class="col-md mt-3">
                 {{isset($uChoosen->draweeBank) ? $uChoosen->draweeBank : 'NOT SET'}}
              </div>
            </div>
            <div class="row mt-5 border-top">
              <div class="col-md mt-3" style="font-size: 20px;">Number</div>
              <div class="col-md mt-3">
                {{isset($uChoosen->number) ? $uChoosen->number : 'NOT SET'}}
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endisset


<script type="text/javascript">

  @isset($uChoosen)
  $(function(){
    $('select[name=mPay]').val('{{$uChoosen->paymentMode}}').trigger('change');
    $('input[name=drawee]').val('{{$uChoosen->draweeBank}}').trigger('change');
    $('input[name=number]').val('{{$uChoosen->number}}').trigger('change');
  })

  function same(){
    if($("input[name=attFile]").is(':visible')){
      $("input[name=attFile]").hide();
      $("input[name=otherFile]").val('{{$uChoosen->attachedFile}}');
    } else {
      $("input[name=attFile]").show();
      $("input[name=otherFile]").val('');
    }
    // otherFile
  }
  @endisset

   function insert() {
      $('input[name=appform_idSubmit]').val($('input[name=appform_id]').val());  
    }

  function seq(){
    $.ajax({
      type: 'POST',
      data: {_token:$('#token').val(),action:'evalute', appid:'{{$APPID}}'},
      success: function(data){
        if(data == 'DONE'){
          alert('Successfully changed the status to evaluated');
          location.reload();
        } else {
          alert('Error! Please try again later');
        }
      }
    })
    
  }

  function showData(id, or/*,ref*/,amt){
    $('#EditBody').empty();
    $('#EditBody').append(
      '<input type="hidden" id="id" class="form-control" ata-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" value="'+id+'" required>' +
        '<div class="col-sm-7">OR Reference:</div>' +
        '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
          '<input type="text" id="or" class="form-control" ata-parsley-required-message="<strong>*</strong>OR <strong>Required</strong>" value="'+or+'" required>' +
        '</div>' 
        +          
        // '<div class="col-sm-6">Other Reference</div>' +
        // '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
        //    '<input type="text" id="ref" class="form-control" ata-parsley-required-message="<strong>*</strong>Reference <strong>Required</strong>" value="'+ref+'" required>' +
        // '</div>' +
        '<div class="col-sm-6">Amount Paid</div>' +
        '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
           '<input type="text" id="amt" class="form-control" ata-parsley-required-message="<strong>*</strong>Amount <strong>Required</strong>" value="'+amt+'" required>' +
        '</div>'
      );
  }

    $('#EditNow').on('submit',function(event){
        event.preventDefault();
          var form = $(this);
          form.parsley().validate();
           if (form.parsley().isValid()) {
             var x = $('#or').val();
             var y = $('#slip').val();
             var z = $('#ref').val();
             var a = $('#amt').val();
             var b = $('#id').val();
             $.ajax({
                url: '{{asset('employee/cashier/actions')}}',
                method: 'POST',
                data : {_token:$('#token').val(),or:x,slip:y,ref:z,amt:a,id:b,action:"edit"},
                success: function(data){
                    if (data == "SUCCESS") {
                        alert('Successfully Edited Payment');
                        location.reload();
                    } else if (data == 'ERROR') {
                        $('#EditErrorAlert').show(100);
                    }
                }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    $('#EditErrorAlert').show(100);
                }
             });
           }
      });
    $("select[name=mPay]").change(function(event) {
      if($(this).val() == 'MOP-001'){
        $('.forCheckandforMO').attr('hidden',true);
        $("input[name=number]").removeAttr('required');
      } else {
        $('.forCheckandforMO').removeAttr('hidden')
        $("input[name=number]").attr('required',true);
      }
      if($(this).val() == 'MOP-009'){
        $('.forCheck').removeAttr('hidden')
        $("input[name=attFile]","input[name=drawee]","input[name=number]").attr('required',true);
      } else {
        $('.forCheck').attr('hidden',true)
        $("input[name=attFile]","input[name=drawee]","input[name=number]").removeAttr('required');
      }
       if($(this).val() == 'MOP-010' || $(this).val() == 'MOP-011'){
        $('.forMO').removeAttr('hidden')
        $("input[name=number]").attr('required',true);
      } else {
        $('.forMO').attr('hidden',true)
        $("input[name=number]").removeAttr('required');
      }
    });
    

    // function showDelete(id){
    //   var r = confirm("Are you sure you want to void this payment?");
    //   if (r == true) {
    //      $.ajax({
    //         url: '{{asset('employee/cashier/actions')}}',
    //         method: 'POST',
    //         data: {_token: $("#token").val(), 'id': id, 'action':'delete'},
    //         success: function(data){
    //           if(data == 'SUCCESS'){
    //             alert('Voided Successfully');
    //             window.location.href = '{{asset('employee/dashboard/processflow/actions')}}/{{$appform_id}}/{{!empty($aptid) ? $aptid : ""}}'
    //           }
    //         }
    //      });
    //   } else {
    //       txt = "You pressed Cancel!";
    //   }
    // }
</script>
@endsection