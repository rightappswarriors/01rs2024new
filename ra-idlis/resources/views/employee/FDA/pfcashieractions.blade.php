@extends('mainEmployee')
@section('title', 'Cashiering')
@section('content')
<div class="content p-4">
  <div hidden>
    <input type="hidden" id="currentPage" value="FD010">
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
      <input type="hidden" value="{{$appid}}" name="appform_id">
        <div class="card-header bg-white font-weight-bold">

          <div class="row">
            <div class="col-md-6">

                @isset($appid)<input type="text" id="APPID" value="{{$appid}}" hidden>@endisset
                <input type="" id="token" value="{{ Session::token() }}" hidden>
              
                @if(app('request')->input('from') == 'rec')
                <button class="btn btn-primary" onclick="window.history.back();">Back</button>&nbsp;
                @else
                <a class="btn btn-primary" href="{{asset('employee/dashboard/processflow/FDA/cashier')}}">Back</a>
                @endif
                <h4 class="col-md" style="display:inline;">Cashier Evaluation (RADIATION FACILITY) <span class="optnTD" style="display: none;">(Overide Payment Mode)</span></h4>&nbsp;
                
            </div>
            <div class="col-md-6">
              <input style="float: right; font-size:28px; text-align:center; width: 300px; background-color: {{$AppData->proofpaystatMach == 'posted' ? '#BDE5F8' : 'orange'}}"  class="form-control" type="text" disabled value="{{$AppData->proofpaystatMach == 'posting' ? 'For Posting' : ( $AppData->proofpaystatMach == 'posted' ? 'Posted' : 'For Payment')}}">
            </div>
          </div>

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
                <h6>@isset($AppData) Status: @if ($AppData->isCashierApproveFDA === null) <span style="color:blue">For Payment Evaluation</span> @elseif($AppData->isCashierApproveFDA == 1)  <span style="color:green">Payment Evaluated</span> @else <span style="color:red">Disapproved Payment</span> @endif @endisset</h6>
                <h4><span class="text-danger">NOTE:</span> This cashier is for <span class="text-danger">X-Ray MACHINES</span> only. </h4>
              </td>
            </tr>
          </thead>

          <tbody>
          </tbody>  
        </table>
        <hr>
        <div class="container-fluid border mb-3">
            <div class="row" style="padding: 1%">
              @if($AppData->isCashierApproveFDA != 1)

             <!-- if(count($payables) <= 0) -->
                  <!-- <button type="button" onclick="insert()" data-toggle="modal" data-target="#bd-example-modal-sm" class="btn btn-primary p-2 m-1">
                    <i class="fa fa-plus" aria-hidden="true"></i> Accept Payment
                  </button> -->
                <!-- endif  -->
                @if($AppData->ispayProofFilenMach == 1 )
                 
                 <a target="_blank" href="{{ route('OpenFile', $AppData->payProofFilenMach) }}" >
                 <button style="float: right;" type="button" class="btn btn-primary p-2 m-1">
                 </i> View Proof of Payment
                 </button>
                 </a>
                 <!-- <button class="btn btn-success p-2 m-1" data-toggle="modal" data-target="#evaluatePayment"> <i class="fa fa-check" aria-hidden="true"></i> Confirm Payment </button> -->
                 <!-- <button class="btn btn-success p-2 m-1" data-toggle="modal" data-target="#evaluatePayment"> <i class="fa fa-check" aria-hidden="true"></i> Confirm Payment</button> -->
            
                 @else
                 <button style="float: right;" onclick="alert('Please wait for the proof of payment.')" type="button" class="btn btn-warning p-2 m-1">
                 </i> No proof of payment attached yet
                 </button>
                 @endif



              @endif
              @if($AppData->isCashierApproveFDA == 1)
              <a target="_blank" href="{{ route('OpenFile', $AppData->payProofFilenMach) }}" >
                  <button style="float: right;" type="button" class="btn btn-primary p-2 m-1">
                  </i> View Proof of Payment
                  </button>
                  </a>

              {{-- <button type="button" onclick="window.location.href='{{asset('employee/dashboard/processflow/FDA/printor/').'/'.$appid}}'" class="btn btn-primary p-2 m-1">
                <i class="fa fa-print" aria-hidden="true"></i> Print Official Receipt
              </button> --}}
              @endif
              @if($Sum <= 0 && empty($AppData->isCashierApproveFDA))
              <!-- <button class="btn btn-success p-2 m-1" data-toggle="modal" data-target="#evaluatePayment"> <i class="fa fa-check" aria-hidden="true"></i> Confirm Payment</button> -->
              @endif

             
                          
              <div class="col d-flex justify-content-end">
              <button type="button" class="btn btn-primary p-2 m-1" data-toggle="modal" data-target="#showOP">
                <i class="fa fa-eye" aria-hidden="true"></i> View Order of Payment 
              </button>
              </div>
            </div>
          </div>
        <br/>
        @if($Remarks)
            <div class="row mt-1">
              <div class="col-md">
                <button type="button" data-toggle="modal" data-target="#addRemarks" class="btn btn-primary p-2 m-1">
                  <i class="fa fa-note" aria-hidden="true"></i> Show Remarks
                </button>
              </div>
            </div>
            @else 
            <div class="row mt-1">
              <div class="col-md">
                <button type="button" data-toggle="modal" data-target="#addRemarks" class="btn btn-primary p-2 m-1">
                  <i class="fa fa-note" aria-hidden="true"></i> Add Remarks
                </button>
              </div>
            </div>
            @endif
            <div class="modal fade" id="addRemarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body" style=" background-color: #272b30;color: white;">

              @if($Remarks)
              <h5 class="modal-title text-center"><strong>Update Remarks</strong></h5>
            @else 
            <h5 class="modal-title text-center"><strong>Add Remarks</strong></h5>
            @endif
            
              
                <hr>
                <div class="container">
                  <form method="POST" action="{{asset('employee/dashboard/cashierremarksrf')}}" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <input type="hidden" name="appid" value="{{$appid}}">
                      <input type="hidden" name="appform_idSubmit" value="">
                      <div class="container lead">Remarks</div><br>
                      <div class="container">
                  
                        <div class="row">
                          <div class="col-12">
                            <textarea class="form-control" required="" name="cr_remark" rows="10">{{$Remarks}}</textarea>
                          </div>
                        </div>
                        

                        <div class="row mt-5 mb-5">
                          <div class="col-6">
                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                          </div>
                          <div class="col-6">
                            <button class="btn btn-danger btn-block" type="button" onclick="$('#addRemarks').modal('hide')">Cancel</button>
                          </div>
                        </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
        <div style="padding-top: .4%; width: 20%;">

        <select required class="form-control" style="width: 100%; " id="postAct" name="postAct"  @if (isset($AppData->proofpaystatMach)) @if ($AppData->proofpaystatMach ==  'posted' )  disabled="disabled" @endif @endif >
            <option value="">Select Status</option>
            <option  value="posting"  @if (isset($AppData->proofpaystatMach)) @if ($AppData->proofpaystatMach ==  'posting' )  selected @endif @endif>For Posting</option>
            <option  value="posted"  @if (isset($AppData->proofpaystatMach)) @if ($AppData->proofpaystatMach ==  'posted' )  selected @endif @endif>Posted</option>
            <option  value="insufficient"  @if (isset($AppData->proofpaystatMach)) @if ($AppData->proofpaystatMach ==  'insufficient' )  selected @endif @endif>Insufficient Payment</option>
        </select>
        
        @if(!empty($AppData->isCashierApproveFDA))
         <input type="hidden" id="typestat" value="update" />
         @else
         <input type="hidden" id="typestat" value="new" />
        @endif
       

        </div>
        
        @php $canevaluatePayment = true; @endphp

        @if (isset($AppData->proofpaystatMach)) 
            @if ($AppData->proofpaystatMach ==  'posted' )   
                @php $canevaluatePayment = false; @endphp <br/>
            @endif 
        @endif

        @if($canevaluatePayment)
            <button class="btn btn-primary p-2 m-1" data-toggle="modal" data-target="#evaluatePayment">Confirm Status</button>
        @endif

          <!-- <div class="row pt-3">
            <div class="col text-left">
              <span class="pl-1 h2">Payments</span>
            </div>
            <div class="col h3 text-right">
              Amount to be paid: <span class="font-weight-bold">{{'PHP '.number_format($Sum,2)}}</span>
            </div>
          </div>
        <table class="table" width="100%">
          <thead>
              <tr>
                <th scope="col" style="text-align:center;width:auto;">Payment Date:</th>
                <th scope="col" style="text-align:left;width:auto;">OR Reference:</th>
                {{-- <th scope="col" style="text-align:center;width:auto;">Deposit Slip Number:</th> --}}
                <th scope="col" style="text-align:left;width:auto;">Other References/Oncall Slip No</th>
                <th scope="col" style="text-align:left;width:auto;">Amount Paid:</th>
                <th scope="col" style="text-align:left;width:auto;">Action</th>
                <th scope="col" class="optnTD" style="text-align:center;display:none;width:auto;">Option</th>
              </tr>
          </thead>
          <tbody id="PaymentTable">
            @isset($payables)
              @foreach ($payables as $element)
                  <tr>
                    <th scope="row" style="text-align:center">{{(!empty($element->paymentDate) ? Date('F j, Y',strtotime($element->paymentDate)) : '-' )}}</th>
                    <td>{{$element->ORRef}}</td>
                    <td>{{$element->otherRef}}</td>
                    <td class="font-weight-bold">&#8369; {{number_format($element->amount,2)}}</td>
                    <td>
                      @if($AppData->isCashierApproveFDA != 1)
                      <center>
                      <span class="FD010_update">
                        <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#GodModal" onclick="showData('{{$element->fda_chgfilid}}','{{$element->ORRef}}','{{$element->otherRef}}','{{$element->otherRef}}','{{$element->amount}}')">
                          <i class="fa fa-fw fa-edit"></i>
                        </button>
                      </span>&nbsp;
                        {{-- <span class="FD010_cancel">
                          <button type="button" class="btn btn-danger" onclick="showDelete('{{$element->fda_chgfilid}}');">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                          </button>
                        </span> --}}
                      </center>
                      @endif
                    </td>
                  </tr>
              @endforeach
            @endisset
          </tbody>
        </table> -->
        
        @isset($AppData)
        @if(!isset($AppData->isCashierApproveFDA))
        <br>
        <hr
        @endif
        @endisset
      </div>
      </div>
    </div>
</div>
<div class="modal fade" id="showOP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
        <div class="modal-body">
          <h4 class="modal-title text-center"><strong>Machines Order of Payment</strong></h4>     
            <div class="row text-center mt-3">
              @if($canView[0])
              <div class="col-md">
                <a target="_blank" class="p-5 btn btn-primary" href="{{asset('client1/printPaymentFDA')}}/{{FunctionsClientController::getToken()}}/{{$appid}}">X-Ray Machines</a>
              </div>
              @endif
            </div>
        </div>
        <div class="modal-footer">
         <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
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
              <form method="POST" action="{{asset('employee/dashboard/FDA/cashier')}}" enctype="multipart/form-data">
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
                    <input type="hidden" name="for" value="cdrrhr">
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
                    <div class="row">
                      <div class="col-6 pt-2">OR Number:</div>
                      <div class="col-6">
                        <input type="number" required="" name="orRef" class="form-control">
                      </div>
                    </div>
                  {{--   <div class="row">
                      <div class="col-6 pt-2">Deposit Slip Number:</div>
                      <div class="col-6">
                        <input type="text" name="slipNum" class="form-control">
                      </div>
                    </div> --}}
                    <div class="row">
                      <div class="col-6 pt-2">Other Reference:</div>
                      <div class="col-6">
                        <input type="text" name="otherRef" class="form-control">
                      </div>
                    </div>
                    {{-- <div class="row">
                      <div class="col-6 pt-2">Attached File:</div>
                      <div class="col-6">
                        <input type="file" name="attFile" class="form-control">
                      </div>
                    </div> --}}
                    <div class="row">
                      <div class="col-6 pt-2">Amount Paid:</div>
                      <div class="col-6">
                        <input type="number" required="" name="aPaid" class="form-control">
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
    <div class="modal-content"> 
        <div class="modal-body text-center" style="background-color: #272b30;color: white;">
          <h4 class="modal-title text-center"><strong>Evaluation</strong></h4>
            <hr>
            <span id="evaluatePaymentBody ">
              Are you sure you want to confirm this payments?
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


<script type="text/javascript">

   function insert() {
      $('input[name=appform_idSubmit]').val($('input[name=appform_id]').val());  
    }

  function seq(){
    var val = document.getElementById("postAct").value;
    var ts = document.getElementById("typestat").value;

    console.log("val")
    console.log(val)
    console.log("typestat")
    console.log(ts)

    if(val == ""){
      alert("Please select status")
    }else{
      $.ajax({
        type: 'POST',
        data: {_token:$('#token').val(),action:'evalute', appid:'{{$appid}}', postact: val,typestat: ts },
        success: function(data){
          if(data == 'DONE'){
            Swal.fire({
              type: 'success',
              title: 'Success',
              text: 'Successfully changed the status to evaluated.',
            }).then(() => {
              location.reload();
            });
          } else {
            alert('Error! Please try again later');
          }
        }
      })
    }

   
    
  }

  function showData(id, or, slip,ref,amt){
    $('#EditBody').empty();
    $('#EditBody').append(
      '<input type="hidden" id="id" class="form-control" ata-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" value="'+id+'" required>' +
        '<div class="col-sm-7">OR Reference:</div>' +
        '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
          '<input type="text" id="or" class="form-control" ata-parsley-required-message="<strong>*</strong>OR <strong>Required</strong>" value="'+or+'" required>' +
        '</div>' 
        +          
        '<div class="col-sm-6">OR Reference</div>' +
        '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
           '<input type="text" id="slip" class="form-control" ata-parsley-required-message="<strong>*</strong>Deposit Slip <strong>Required</strong>" value="'+slip+'" required>' +
        '</div>' +
        '<div class="col-sm-6">Other Reference</div>' +
        '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
           '<input type="text" id="ref" class="form-control" ata-parsley-required-message="<strong>*</strong>Reference <strong>Required</strong>" value="'+ref+'" required>' +
        '</div>' +
        '<div class="col-sm-6">Amount Paid</div>' +
        '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
           '<input type="text" id="amt" class="form-control" ata-parsley-required-message="<strong>*</strong>Amount <strong>Required</strong>" value="'+Math.abs(amt)+'" required>' +
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

            //  console.log("received")
             $.ajax({
                url: '{{asset('employee/cashier/FDA/actions')}}',
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

    function showDelete(id){
      var r = confirm("Are you sure you want to void this payment?");
      if (r == true) {
         $.ajax({
            url: '{{asset('employee/cashier/FDA/actions')}}',
            method: 'POST',
            data: {_token: $("#token").val(), 'id': id, 'action':'delete'},
            success: function(data){
              if(data == 'SUCCESS'){
                alert('Voided Successfully');
                location.reload();
              }
            }
         });
      } else {
          txt = "You pressed Cancel!";
      }
    }
</script>
@endsection