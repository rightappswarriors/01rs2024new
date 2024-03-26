@extends('mainEmployee')
@section('title', 'Order of Payment Process Flow')
@section('content')
<div class="content p-4">
  <div hidden>
    <datalist id="OrderOfPaymentList">
        @foreach ($charges as $day)
          <option id="{{$day->id}}_OOP" value="{{$day->id}}">{{$day->fchg_desc}}(Range from: {{$day->rangeFrom}}, Range to: rangeTo: {{$day->rangeTo}})</option>
        @endforeach
    </datalist>
    <datalist id="selected">
      @switch (true) 
          @case ($AppData->aptid == 'IN')
              @php $findIn = 'initial_amnt' @endphp
          @break
          @case ($AppData->aptid == 'R')
              @php $findIn = 'renewal_amnt' @endphp
          @default
              @php $findIn = null @endphp 
          @break
      @endswitch
      <input type="hidden" name="select" value="{{$findIn}}">
    </datalist>
    @php
    $selected = (strtolower($request) == 'machines' ? $AppData->isPayEvalFDA : $AppData->isPayEvalFDAPharma);
    @endphp
  </div>
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
          @isset($appid)<input type="text" id="APPID" value="{{$appid}}" hidden>@endisset
          <input type="" id="token" value="{{ Session::token() }}" hidden>
           Order of Payment Evaluation <span class="optnTD" style="display: none;">(Overide Payment Mode)</span>&nbsp;
           <button class="btn btn-primary" onclick="window.history.back();">Back</button>
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
                <h6>@isset($AppData) Status: @if ($selected === null) <span style="color:blue">For Payment Evaluation</span> @elseif($selected == 1)  <span style="color:green">Payment Evaluated</span> @else <span style="color:red">Disapproved Payment</span> @endif @endisset</h6>
              </td>
            </tr>
          </thead>
          </tbody>  
        </table>
        <hr>
        <div class="col d-flex justify-content-end">
          <button type="button" class="btn btn-primary p-3 mb-3" data-toggle="modal" data-target="#showOP">
            <i class="fa fa-print" aria-hidden="true"></i> Print
          </button>
        </div>
        <table class="table" width="100%">
          <thead>
              <tr>
                <th scope="col" style="width:auto;">Payment Description</th>
                <th scope="col" style="width:auto;">MA Value</th>
                <th scope="col" style="width:auto;">Amount</th>
              </tr>
          </thead>
          <tbody id="PaymentTable">

            @foreach($payables as $pay)
              @if(strtolower($pay->uid) != 'system' )

                <tr>
                  {{-- <td>{{$pay->fchg_desc}}</td> --}}
                  <td class="font-weight-bold">{{($pay->uid != $AppData->uid ? 'Altered Payment' : ($pay->MAvalue > 1 ? 'X-ray': 'Pharmacy' ))}}</td>
                  <td>
                    {!!($pay->MAvalue > 1 ? $pay->MAvalue : '<span class="font-weight-bold">NOT AVAILABLE</span>')!!}
                  </td>
                  <td>
                    &#8369; {{number_format($pay->amount, 2)}}
                  </td>
                  <td class="optnTD" style="display:none"><center><button style="background-color: #d40000" class="btn btn-primarys" onclick="showDelete('{{$pay->fda_chgfilid}}')" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-trash" aria-hidden="true"></i></button></center></td>
                  
                  
                </tr>
              @else
                   <tr>
                    <td class="font-weight-bold"><i class="fa fa-question pr-3" data-toggle="tooltip" data-placement="left" title="LRF is inclusive on machine payments"></i>LRF</td>
                    <td>-</td>
                    <td>&#8369; {{number_format($pay->amount,2)}}</td>
                  </tr>
              @endif
            @endforeach

            @isset($Sum)
              <tr style="border-top: double">
                <th scope="row" colspan="2" style="text-align:center; font-size: 23px;">Total Amount</th>
                <th scope="row" style="text-align:left; font-size: 23px;">{{'PHP '.number_format($Sum,2)}}</th>
                <th scope="row" class="optnTD" style="display:none">&nbsp;</th>
              </tr>
            @endisset
          </tbody>
        </table>
        @isset($AppData)
        @if(!isset($selected))
        <br>
        <hr>
        <div class="container">
          <center>
            {{-- <span class="optnTD"><button style="background-color: #82d202" class="btn btn-primarys" data-toggle="modal" data-target="#AccepttGodModal">Accept Payment</button> &nbsp;</span> --}}
            <span class="optnTD"><button style="background-color: #82d202" class="btn btn-primarys" onclick="ShowifApOrReg(1)" data-toggle="modal" data-target="#AccepttGodModal" >Approve</button> &nbsp;</span>
            {{-- <span  class="optnTD"><button style="background-color: #dc3545;" class="btn btn-primarys" onclick="ShowifApOrReg(0)"  data-toggle="modal" data-target="#AccepttGodModal" >Reject</button>&nbsp;</span> --}}
            <span style="display:none" class="optnTD"><button style="background-color: #82d202;" class="btn btn-primarys" onclick="AddPay()" data-toggle="modal" data-target="#AddGodModal">Add</button>&nbsp;</span>
            <span class="optnTD"><button style="background-color: #3557d2" class="btn btn-primarys" id="OvrBtn" onclick="$('.optnTD').toggle();setData(1);">Overide</button></span>
            <span style="display:none" class="optnTD">&nbsp;<button style="background-color: #ff8100;" class="btn btn-primarys" id="CnclBtn" onclick="$('.optnTD').toggle();setData(0);" id="">Cancel Overide</button></span>
          </center>
        </div>
        @endif
        @endisset
      </div>
      </div>
    </div>
</div>
<div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Delete Charge</strong></h5>
              <hr>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
              <div class="container">
                <span id="DelModSpan">
                </span>
                <hr>
                    <div class="row">
                      <div class="col-sm-6">
                      <button type="button" onclick="deleteNow();" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
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
                    @isset($appid)
                      <input type="text" id="SelectedAPPID" value="{{$appid}}" hidden="">
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
<div class="modal fade" id="ShowDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
        <div class="modal-body">
          <h4 class="modal-title text-center"><strong>Details</strong></h4>
            <hr>
            <span id="ShowDetailsModalBody"></span>
            <hr>            
              <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-4">
                </div> 
                <div class="col-sm-4">
                  <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
                </div>
              </div>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="showOP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
        <div class="modal-body">
          <h4 class="modal-title text-center"><strong>Select order of payment you want to display</strong></h4>     
            <div class="row text-center mt-3">
              @if($canView[0])
              <div class="col-md">
                <a target="_blank" class="p-5 btn btn-primary" href="{{asset('client1/printPaymentFDA')}}/{{FunctionsClientController::getToken()}}/{{$appid}}">Radiology Equipments</a>
              </div>
              @endif
              @if($canView[1])
              <div class="col-md">
                <a target="_blank" class="p-5 btn btn-primary" href="{{asset('client1/printPaymentFDACDRR')}}/{{FunctionsClientController::getToken()}}/{{$appid}}">Pharmacies</a>
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
<script type="text/javascript">
	var OverideMode = 0,AprvRejVar = 0;
        $(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip();});
        function setData(data){
          OverideMode = data;
        }
    function showDelete (id){
            $('#DelModSpan').empty();
            $('#DelModSpan').append(
                '<div class="col-sm-12"> Are you sure you want to delete this entry ?' +
                  // <input type="text" id="edit_desc2" class="form-control"  style="margin:0 0 .8em 0;" required>
                '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
                '</div>'
              );
        }
    function AddPay(){
          $('#AddModSpan').empty();
          $('#AddModSpan').append(
                '<div class="row">' +
                  '<div class="col-sm-4">Order of Payment:</div>' +
                  '<div class="col-sm-8" style="margin:0 0 .8em 0;">' +
                    '<input type="text" id="selectOOP" data-parsley-required-message="*<strong>Order of Payment</strong> required" list="OrderOfPaymentList" onchange="getChrges();" class="form-control"  required>' +
                  '</div>' +
                '</div>' +
                '<div class="row">' +
                  '<div class="col-sm-4">Amount</div>' +
                  '<div class="col-sm-8" style="margin:0 0 .8em 0;">' +
                    '<input type="text" id="selectAMOUNT" class="form-control" disabled value="">' +
                  '</div>' +
                '</div>'
            );
        }
    function getChrges(){
          var selectOOP = $('#selectOOP').val();
          var selected = $("input[name='select']").val();
          $.ajax({
            method: "POST",
            data: {_token: $("input[name=_token]").val(), getCharge: 'charges', id: selectOOP, selected: selected},
            success: function(a){
              $("#selectAMOUNT").val(a);
            }
          })
        }
    function getAmount(){
          $('#selectAMOUNT').attr('value','');
          var selectedID = $('#selectCharge').val();
          if (selectedID != '') {
            var amount = $('#' +selectedID + '_CHG').attr('frmamt');
            $('#selectAMOUNT').attr('value',amount);
          }
        }
    function ShowifApOrReg(AppOrReje){
          if (AppOrReje == 1) { // Appproved
              $('#AppRegTitle').text('Approve');
              $('#AppRegBtn').attr('onclick','AprvRej(1)');
              $('#AppRegTest').text('approve');
          } else { // Reject
              $('#AppRegTitle').text('Disapprove');
              $('#AppRegBtn').attr('onclick','AprvRej(0)');
              $('#AppRegTest').text('disapprove ');
          }
        }
    function AprvRej(ApOrRe){
          AprvRejVar = ApOrRe;
          $('#ApprRejRmk').submit();
        }
    $('#addRgn').on('submit', function(event){
            event.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()) {
              let id = $("#selectOOP").val();
              let amount = $("#selectAMOUNT").val();
              $.ajax({
                method: "POST",
                data: {_token: $("input[name=_token]").val(),id: id, amount: amount, getCharge: 'newpayment'},
                success: function(a){
                  if(a == 'done'){
                  Swal.fire({
                    type: 'success',
                    title: 'Success',
                    text: 'Successfully added new payment.',
                  }).then(() => {
                    location.reload();
                  });
                  }
                }
              })
            }
        });
   	function deleteNow(){
            $.ajax({
                url : '{{ asset('employee/dashboard/processflow/orderofpayment/deleteCharge/FDA') }}',
                method : 'POST',
                data: {_token:$('#token').val(),id :$('#toBeDeletedID').val()},
                success : function(data){
                  if (data == 'DONE') {
                      $('#DelGodModal').modal('toggle');
                      Swal.fire({
                        type: 'success',
                        title: 'Success',
                        text: 'Successfully deleted a charge.',
                      }).then(() => {
                        location.reload();
                      });
                  } else if (data == 'ERROR') {
                      $('#DelErrorAlert').show(100);
                  }
                },
                error : function(XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#DelErrorAlert').show(100);
                }
            });
        }
    $('#ApprRejRmk').on('submit', function(e){
          e.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
              $.ajax({
                url : '{{ asset('employee/dashboard/processflow/orderofpayment/FDA/accept_orderofpayment/'.$request) }}',
                method : 'POST',
                data : {_token:$('#token').val(), id: $('#SelectedAPPID').val(),  AoR : AprvRejVar, selected : 0},
                success : function(data){
                  if (data == 'ERROR') {
                    $('#AccErrorAlert').show(100);
                  } else if(data == 'DONE') {
                    Swal.fire({
                      type: 'success',
                      title: 'Success',
                      text: 'Successfully evaluated application.',
                    }).then(() => {
                      window.location.href = "{{ asset('employee/dashboard/processflow/evaluate/FDA/'.$request) }}";
                    });
                      // location.reload();
                  }
                },
                error : function(a,b,c){
                    console.log(c);
                    $('#AccErrorAlert').show(100);
                }
              });
          }
        });
</script>
@endsection